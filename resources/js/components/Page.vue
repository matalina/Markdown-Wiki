<template>
    <main>
        <hr/>
        <div class="meta-data d-flex flex-wrap">
            <router-link v-for="category in meta.category"
                         :key="category"
                         :to="getMetaPage('category', category)"
                         class="p-2 mb-3 bg-white mr-2 flex-fill text-muted"
                         v-show="meta.category !== undefined"
            >
                <i class="fas fa-folder fa-fw text-dark"></i>
                <strong>category</strong>: {{ category }}
            </router-link>
            <router-link v-for="tags in meta.tags"
                         :key="tags"
                         :to="getMetaPage('tags', tags)"
                         class="p-2 mb-3 bg-white mr-2 flex-fill text-muted"
                         v-show="meta.tags !== undefined"
            >
                <i class="fas fa-tag fa-fw text-dark"></i>
                <strong>tag</strong>: {{ tags }}
            </router-link>
            <div class="p-2 mb-3 bg-white mr-2 flex-fill text-muted"
                 v-for="(value, key) in usermeta"
            >
                <i class="fas fa-asterisk fa-fw text-dark"></i>
                <strong>{{ key }}</strong>: {{ value}}
            </div>
        </div>
        <div class="row">


        </div>
        <hr/>
        <div v-html="markdown(content)"></div>
    </main>
</template>

<script>
    import axios from 'axios';

    const MarkdownIt = require('markdown-it'),
        md = new MarkdownIt({
            html: true,
            xhtmlOut: true,
            breaks: true,
            linkify: true,
        });

    export default {
        data() {
            return {
                path: '/',
                meta: {},
                content: '',
            };
        },
        computed: {
            'usermeta': function() {
                let meta = {};

                for(let key in this.meta){
                    if(key !== 'category'
                        && key !== 'tags'
                        && key !== 'title'
                        && key !== 'index'
                    ) {
                        meta[key] = this.meta[key];
                    }
                }

                return meta;
            }
        },
        methods: {
            markdown(string) {
                return md.render(string);
            },
            getMetaPage(type, name) {
                return `/menu/${type}/${name}`
            },
            getPage() {
                let url = `page/${this.path}`;

                if(this.path === '/') {
                    url = 'page/home';
                }

                axios.get(url).then((response) => {
                    this.meta = response.data.meta;
                    this.content = response.data.content;
                }).catch((error) => {

                });
            }
        },
        beforeRouteUpdate(to,from,next) {
            next();
            if(this.$route.params[0] === undefined) {
                this.path = '/';
            }
            else {
                this.path = this.$route.params[0];
            }

            this.getPage();
        },
        mounted() {
            if(this.$route.params[0] === undefined) {
                this.path = '/';
            }
            else {
                this.path = this.$route.params[0];
            }

            this.getPage();
        }
    }
</script>