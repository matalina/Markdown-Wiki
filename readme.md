# Markdown Wiki

An SPA wiki with markdown formatting and yaml front matter meta data.

After making any changes to the wiki folder `php artisan wiki:index` must be run.

## Convention over configuration for files
 
* Files are saved in the wiki directory of the project
* All file and directory names should be lower case and only contain `a-z 0-9 - _`
* All files should have  `.md` extension
* You must include a `home.md` file in the wiki directory
* index and title meta data are required if you wish to index a page to link on other pages (ie: home does not have an index, and is only reachable though page title)

If running the app in a directory not on a root (sub)domain, make sure to update the url in `resources\js\constants.js` this is used to direct the ajax calls to the api.

## YAML Front Matter
```yaml
title: Title of the Article
index: comma separated string of words that will link to this page
category: 
    - category 1
    - category 2
tags: 
    - tag 1
    - tag 2
other: single line data    
```

# Releases

v1.0.0 - Initial release.
 
* Local Storage only
* Infinite directory structure and markdown files
* Convention must be preserved in order to get the files
* Meta data category, tags, title and index are default meta data, users can add single line data in additional yaml front matter to be rendered.
* Automatic interlinking to first mention of an indexed page.

# To Do List
- [ ] Objects/Arrays as Meta data front matter yaml
- [ ] Do not link to self
- [ ] Different storage mechanisms to be used (Dropbox, Google Drive, Github)
- [ ] Create a git pull hook to run artisan indexing command

