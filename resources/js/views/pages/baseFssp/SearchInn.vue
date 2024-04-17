<script>
// import axios from
import axios from "axios";
import SearchResult from "@/views/ui/SearchResult.vue";
export default {
    components: {SearchResult},
    data() {
        return {
            value:  null,
            result: { error: null, data: [] },
            loaded: false,
        }
    },
    methods: {
        search() {
            this.loaded = true
            axios.get('/api/search-by-inn', {
                params: {
                    value: this.value
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
    }
}
</script>

<template>
    <div className="card reestr">
        <div class="reestr__header">
            <h2>Поиск по ИНН</h2>
<!--            <div class="reestr__header-buttons">-->
<!--                <Button type="button" label="Загрузить реестр" icon="pi pi-plus" severity="info" />-->
<!--                &lt;!&ndash;                    <Button type="button" label="Скачать реестр" icon="pi pi-download" @click="importReestr"/>&ndash;&gt;-->
<!--                <a href="/api/reestr-export" class="p-button p-component">-->
<!--                    <span class="p-button-icon p-button-icon-left pi pi-download" data-pc-section="icon"></span>-->
<!--                    Скачать реестр-->
<!--                </a>-->
<!--            </div>-->
        </div>
        <div class="reestr__ip mt-5">
            <FloatLabel>
                <InputText id="username" v-model="value" required/>
                <label for="username">Номер ИП</label>
                <Button class="ml-3" type="button" label="Поиск по реестру" icon="pi pi-search" severity="info" @click="search"/>
            </FloatLabel>
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
