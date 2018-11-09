<template>
    <nav id="menu">
        <div class="card mb-3">
            <div class="card-header">
                <router-link class="col-12 btn btn-link"
                             to="/page/home"
                >
                    <span>home</span>
                </router-link>
            </div>
        </div>
        <div class="card mb-3"
             v-for="(value, key) in menu"
        >
            <div class="card-header"
                 @click="toggle(key)"
            >
                {{ key }}
            </div>
            <div class="card-body row"
                :class="key"
                v-show="isOpen(key)"
            >
                <router-link v-for="name in value"
                             :key="name"
                             class="btn btn-link"
                             :class="{
                                    'col-12': key === 'category',
                                    'col-6': key === 'tags',
                                }"
                             :to="getPage(key, name)"
                >
                    <span>{{ name }}</span>
                </router-link>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header"
                 @click="toggle('pages')"
            >
                alphabetical
            </div>
            <div class="pages card-body row"
                 v-show="isOpen('pages')"
            >
                <router-link v-for="letter in letters"
                             :key="letter"
                             class="col-4 btn btn-link"

                             :to="getPage('pages', letter)"
                >
                    <span> {{ letter }}</span>
                </router-link>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <router-link class="col-12 btn btn-link"
                             :to="getPage('pages', 'all')"
                >
                    <span>all</span>
                </router-link>
            </div>
        </div>
    </nav>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'cat-tag',
        data() {
            return {
                letters: ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
                open: 'pages',
                menu: {},
            };
        },
        methods: {
            isOpen(name) {
                return name === this.open;
            },
            toggle(name) {
                this.open = name;
            },
            getPage(type , name) {
                return `/menu/${type}/${name}`
            }
        },
        mounted() {
            axios.get('/menu').then((response) => {
                this.menu = response.data;
            }).catch((error)  => {

            });
        }
    }
</script>