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
                                Поиск по данным Юредического лица 🐻
                            </h1>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="search">
                            <div class="search__form">
                                <div class="search__form-id">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Наименование*</label>
                                        <input v-model="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Наименование организации">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Адрес</label>
                                        <input v-model="address" type="text" class="form-control" id="formGroupExampleInput" placeholder="Адрес организации">
                                    </div>
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Регион *</label>
                                        <select v-model="region" class="form-select" aria-label="Пример выбора по умолчанию">
                                            <option value="77" selected="selected">Москва</option>
                                            <option value="78">Санкт-Петербург</option>
                                            <option v-for="item in regions" :key="item.id" :value="item.id">{{ item.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form__button" style="margin-top: 16px">
                                    <button @click="getResultsSearch()" class="button button-primary">
                                        <svg class="ml-3 mr-2 c1bvt cc44c ciz4v czgoy c3wll c7n6y cgmrc cm474" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"></path>
                                            <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"></path>
                                        </svg>
                                        Найти
                                    </button>
                                </div>
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
import Sitebar from "@/components/layouts/Sitebar.vue";
import Header from "@/components/layouts/Header.vue";
import axios from "axios";
import SearchResult from "@/components/pages/search/SearchResult.vue";

export default {
    name: "SearchByUl",
    components: {SearchResult, Header, Sitebar},
    data() {
        return {
            name: null,
            address: null,
            region: null,
            loaded: false,
            regions: null,
            result: { error: null },
        }
    },
    mounted() {
        this.getRegions()
    },
    // watch: {
    //     $route: 'getRegions'
    // },
    methods: {
        getResultsSearch() {
            this.loaded = true
            axios.get('/api/admin/search-by-ul', {
                params: {
                    name: this.name,
                    address: this.address,
                    region: this.region,
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
        },
        getRegions() {
            axios.get('/api/regions')
                .then(res => {
                    this.regions = res.data
                }).catch(error => {
                console.log(error.response)
            })
        },
    }
}
</script>

<style scoped>

</style>
