<?php

namespace App\Console\Commands;

use App\Category;
use App\Index;
use App\Page;
use App\Tag;
use Illuminate\Console\Command;
use Illuminate\Validation\Rules\In;
use \Storage;

class IndexWiki extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wiki:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index the wiki files for search and wiki links';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $storage = Storage::disk('wiki');

        foreach($storage->allFiles() as $path) {
            $file = $storage->get($path);

            $data = parseFile($file);

            $checksum = md5($file);

            $page = $this->page($path, $checksum, $data);

            if(isset($data['meta']['category'])) {
                $this->category($data, $page);
            }

            if(isset($data['meta']['tags'])) {
                $this->tag($data, $page);
            }

            if(isset($data['meta']['index'])) {
                $this->indices($data, $page);
            }
        }
    }

    protected function page($path, $checksum, $data)
    {
        $page = Page::where('location', '=', $path)->first();

        if ($page != null) {
            if (!$page->check($checksum)) {
                $page->checksum = $checksum;
                $page->title = $data['meta']['title'];
                $page->save();
            }
        } else {
            $page = Page::create([
                'location' => $path,
                'title' => $data['meta']['title'],
                'checksum' => $checksum,
            ]);
        }
        return $page;
    }

    protected function category($data, $page): void
    {
        $categories = [];
        foreach ($data['meta']['category'] as $cat) {
            $category = Category::updateOrCreate(['category' => strtolower($cat)], ['category' => strtolower($cat)]);
            $categories[] = $category->id;
        }
        $page->categories()->sync($categories);
    }

    protected function tag($data, $page): void
    {
        $tags = [];
        foreach ($data['meta']['tags'] as $t) {
            $tag = Tag::updateOrCreate(['tag' => strtolower($t)], ['tag' => strtolower($t)]);
            $tags[] = $tag->id;
        }
        $page->tags()->sync($tags);
    }

    protected function indices($data, $page): void
    {
        $index_tags = explode(',', $data['meta']['index']);
        foreach ($index_tags as $index) {
            $i = Index::where('index', '=', $index)->first();

            if ($i == null) {
                $i = Index::create([
                    'index' => $index,
                    'page_id' => $page->id,
                ]);
            } else {
                $i->page_id = $page->id;
                $i->save();
            }
        }

        $indices = Index::where('page_id', '=', $page->id)->get();
        foreach ($indices as $i) {
            if (!in_array($i->index, $index_tags)) {
                $i->delete();
            }
        }
    }
}
