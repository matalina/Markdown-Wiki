<template>
    <div>
        <h1>
            Pages:
            <small>{{ type }} - {{ name }}</small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-md-3"
                 v-for="(title, path) in pages"
            >
                <router-link :to="getPage(path)">
                    {{ title }}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                type: this.$route.params.type,
                name: this.$route.params.name,
                pages: {},
            }
        },
        methods: {
            getPage(path) {
                return `/page/${path}`
            },
            getPages() {
                let url = `/menu/${this.type}/${this.name}`;
                axios.get(url).then((response) => {
                    this.pages = response.data;
                }).catch((error) => {

                });
            }
        },
        beforeRouteUpdate(to,from,next) {
            next();
            this.type = this.$route.params.type;
            this.name = this.$route.params.name;

            this.getPages();
        },
        mounted() {
            this.type = this.$route.params.type;
            this.name = this.$route.params.name;

            this.getPages();
        }
    }
</script>