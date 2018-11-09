<template>
    <main>
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
        methods: {
            markdown(string) {
                return md.render(string);
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