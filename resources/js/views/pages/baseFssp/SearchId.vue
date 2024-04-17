<script>
import axios from "axios";
import SearchResult from "@/views/ui/SearchResult.vue";
export default {
    name: "SearchById",
    components: {SearchResult},
    data () {
        return {
            id_number: null,
            region:    null,
            id_type:   null,
            id_issuer: null,
            regions:   null,
            docs:      null,
            doc:       null,
            result:    { error: null, data: [] },
            loaded:    false,
        }
    },
    mounted() {
        this.getRegions()
        this.getDocs()
    },
    methods: {
        getResultsSearch() {
            this.loaded = true
            axios.get('/api/search-by-id', {
                params: {
                    region: this.region.id,
                    id_type: this.id_type.id,
                    id_number: this.id_number,
                    id_issuer: this.id_issuer

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
        getDocs() {
            axios.get('/api/docs')
                .then(res => {
                    this.docs = res.data
                }).catch(error => {
                console.log(error.response)
            })
        },
    }
}
</script>

<template>
    <div className="card reestr">
        <div class="reestr__header">
            <h2>Поиск по номеру исполнительного документа</h2>
<!--            <div class="reestr__header-buttons">-->
<!--                <Button type="button" label="Загрузить реестр" icon="pi pi-plus" severity="info" />-->
<!--                <a href="/api/reestr-export" class="p-button p-component">-->
<!--                    <span class="p-button-icon p-button-icon-left pi pi-download" data-pc-section="icon"></span>-->
<!--                    Скачать реестр-->
<!--                </a>-->
<!--            </div>-->
        </div>
        <div class="grid mt-5">
            <div class="col-12 md:col-8">
                <div class="p-fluid">
                    <div class="formgrid grid">
                        <div class="field col">
                            <label for="name2">Исполнительный документ*</label>
                            <InputText v-model="id_number" id="name2" type="text" placeholder="Исполнительный документ*" required/>
                        </div>
                        <div class="field col">
                            <label for="name">Орган, выдавший документ</label>
                            <InputText v-model="id_issuer" id="name" type="text" placeholder="Орган, выдавший документ" />
                        </div>
                    </div>
                </div>
                <div class="p-fluid mt-3">
                    <div class="formgrid grid">
                        <div class="field col">
                            <label for="region">Регион *</label>
                            <Dropdown id="region" v-model="region" :options="regions" optionLabel="name" placeholder="Регион *"></Dropdown>
                        </div>
                        <div class="field col">
                            <label for="docs">Тип документа, при наличии</label>
<!--                            <Dropdown id="region" v-model="doc" :options="docs" optionLabel="title" placeholder="Тип документа, при наличии"></Dropdown>-->
                            <Dropdown id="docs" v-model="id_type" :options="docs" optionLabel="title" placeholder="Тип документа, при наличии"></Dropdown>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <Button class="ml-3" type="button" label="Поиск по реестру" icon="pi pi-search" severity="info" @click="getResultsSearch"/>
                </div>
            </div>
        </div>
        <h3 v-if="result.error == false && result.data.length > 0">По Вашему запросу нашлось - {{ result.data.length }} </h3>
        <h3 v-else-if="result.error == false && result.data.length == 0">По Вашему запросу ни чего не нашлось</h3>
        <h3 v-else-if="result.error == true">Произошла ошибка при запросе. Попробуйте через 2 минуты повторить запрос </h3>
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
    </div>
    <SearchResult class="mt-5" :result="result"></SearchResult>
</template>

<style scoped lang="scss">

</style>
