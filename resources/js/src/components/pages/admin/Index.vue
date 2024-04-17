<template>
<!--    <a @click.prevent="logout" href="#">Выйти</a>-->
    <div class="wrapper">
        <Sitebar/>
        <div class="content">
            <Header />
            <div class="containers">

            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";
import Sitebar from "@/components/layouts/Sitebar.vue";
import Header from "@/components/layouts/Header.vue";
export default {
    name: "Home",
    components: {Header, Sitebar},

    data () {
        return {

        }
    },

    mounted() {
        this.getData();
    },

    methods: {
        getData() {
            axios.get('/api/admin').then(res => {

            })
        },
    },
}
</script>

