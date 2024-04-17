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
                                Поиск по номеру исполнительного производства 🐻
                            </h1>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="search">
                            <SearchLiveForm type="ip_number"></SearchLiveForm>
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
import SearchLiveForm from "@/components/pages/search/SearchLiveForm.vue";

export default {
    name: "SearchByIp",
    components: {SearchLiveForm, Sitebar, Header}
}
</script>

<style scoped>

</style>
