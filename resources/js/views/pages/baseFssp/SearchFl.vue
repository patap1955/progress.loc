<script>
import axios from "axios";
import SearchResult from "@/views/ui/SearchResult.vue";

export default {
    components: {SearchResult},
    data() {
        return {
            last_name: null,
            first_name: null,
            patronymic: null,
            region: null,
            date: null,
            regions: null,
            result: { error: null, data: [] },
            loaded: false,
        }
    },
    mounted() {
        this.getRegions()
    },
    methods: {
        getRegions() {
            axios.get('/api/regions')
                .then(res => {
                    this.regions = res.data
                }).catch(error => {
                console.log(error.response)
            })
        },
        getResultsSearch() {
            this.loaded = true
            axios.get('/api/search-by-fl', {
                params: {
                    last_name: this.last_name,
                    first_name: this.first_name,
                    patronymic: this.patronymic,
                    region: this.region.id,
                    date: this.date,
                }
            })
                .then(res => {
                    this.result = res.data
                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    this.loaded = false
                });
        },
    },
}
</script>

<template>
    <div className="card reestr">
        <div class="reestr__header">
            <h2>Поиск по данным ФЛ</h2>
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
                            <label for="name2">Фамилия*</label>
                            <InputText v-model="last_name" id="name2" type="text" placeholder="Фамилия*" required/>
                        </div>
                        <div class="field col">
                            <label for="name">Имя*</label>
                            <InputText v-model="first_name" id="name" type="text" placeholder="Имя" />
                        </div>
                    </div>
                </div>
                <div class="p-fluid mt-3">
                    <div class="formgrid grid">
                        <div class="field col">
                            <label for="name">Отчество*</label>
                            <InputText v-model="patronymic" id="name" type="text" placeholder="Отчество" />
                        </div>
                        <div class="field col">
                            <label for="region">Регион *</label>
                            <Dropdown id="region" v-model="region" :options="regions" optionLabel="name" placeholder="Регион *"></Dropdown>
                        </div>
                    </div>
                </div>
                <div class="p-fluid mt-3">
                    <div class="formgrid grid">
                        <div class="field col">
                            <label for="name">Дата рождения*</label>
<!--                            <InputText v-model="date" id="name" type="text" placeholder="Дата рождения" />-->
                            <InputMask id="basic" v-model="date" placeholder="01.01.2000" mask="99.99.9999" slotChar="dd/mm/yyyy" />
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
