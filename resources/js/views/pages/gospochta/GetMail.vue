<script>
import axios from "axios";
export default {
    name: "GetMail",
    data() {
        return {
            mail: null
        }
    },
    mounted() {
        this.getMail()
    },
    methods: {
        getMail() {
            axios.post('/api/get-mail')
                .then(res => {
                    this.mail = res.data
                })
                .catch(err => {
                    console.log(err)
                })
        }
    }
}
</script>

<template>
    <div class="card">
        {{ mail }}
    </div>
</template>

<style scoped lang="scss">

</style>
