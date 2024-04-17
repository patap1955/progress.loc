<template>
    <div v-if="!result.error" class="search__result">
        <div v-for="(res, index) in result.data" :key="index" class="searchResult">
            <div class="searchResult__list">
                <div v-for="(item, index) in res" :key="index" class="searchResult__item">
                    <p class="searchResult__item-key">{{ item.title }}</p>
                    <p v-if="item.data != ''" class="searchResult__item-value" v-html="item.data"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SearchResult",
    props: {
        result: {
            type: Object,
            required: true
        }
    },
    mounted() {
        console.log(this.result.data)
    }
}
</script>

<style scoped lang="scss">
.search__result {
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    row-gap: 30px;
}
.searchResult {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    &__list {
        display: flex;
        flex-direction: column;
        row-gap: 25px;
    }

    &__item {
        display: grid;
        grid-template-columns: 30% 70%;
        column-gap: 50px;
    }

}
</style>
