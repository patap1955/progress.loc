<template>
    <div class="wrapper">
        <Sitebar/>
        <div class="content">
            <Header />
            <div class="containers">
                <div class="main">
                    <div class="main__header">
                        <div class="main__header-top">
                            <h1 class="main__header-top-title">
                                Поиск по ИНН 🐻
                            </h1>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="search">
                            <div class="search__form-ip">
                                <input v-model="value" type="search" class="form-control" id="formGroupExampleInput" placeholder="Поиск">
                                <button @click="getResultsSearch()" class="button button-primary">
                                    <svg class="ml-3 mr-2 c1bvt cc44c ciz4v czgoy c3wll c7n6y cgmrc cm474" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"></path>
                                        <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"></path>
                                    </svg>
                                    Найти
                                </button>
                            </div>
                            <div v-if="loaded">
                                <loader
                                    name="spinning"
                                    loadingText="Поиск"
                                    textColor="#ffffff" textSize="16"
                                    textWeight="500" object="#ff9633"
                                    color1="#ffffff" color2="#17fd3d" size="5"
                                    speed="2" bg="#343a40" objectbg="#999793"
                                    opacity="80" :disableScrolling="true"
                                ></loader>
                            </div>
                            <div v-if="result.error" class="search__result">
                                <p class="search__result-error">{{ result.message }}</p>
                            </div>
                            <SearchResult :result="result"></SearchResult>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Header from "@/components/layouts/Header.vue";
import Sitebar from "@/components/layouts/Sitebar.vue";
import axios from "axios";
import SearchResult from "@/components/pages/search/SearchResult.vue";

export default {
    name: "SearchByInn",
    components: {SearchResult, Sitebar, Header},
    data() {
        return {
            value: null,
            result: { error: null },
            loaded: false,
        }
    },
    methods: {
        getResultsSearch() {
            this.loaded = true
            axios.get('/api/admin/search-by-inn', {
                params: {
                    key: this.type,
                    value: this.value
                }
            })
                .then(res => {
                    console.log(res.data)
                    this.result = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    this.loaded = false
                });
        }
    }
}
</script>

<style scoped>

</style>
