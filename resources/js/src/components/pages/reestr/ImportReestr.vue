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
                                Добавить запись в реестр🐻
                            </h1>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="reestr">
                            <div class="reestr__form">
                                <div class="reestr__grid">
                                    <div class="form-group">
                                        <label for="formGroupExampleInput" class="form-label">Импорт из  excel фала</label>
                                        <input v-on:change="addReestr()" ref="file" type="file" name="file" class="form-control" id="formGroupExampleInput" placeholder="Столбец1">
                                    </div>
                                </div>
                                <p v-if="message" class="mt-3" style="color: red; font-size: 16px">{{ message }}</p>
                            </div>
                            <div class="">
<!--                                <button @click.prevent="importReestr()" class="btn btn-success mt-3">Скачать реестр</button>-->
                                <a href="/api/admin/reestr-export" @click="importReestr()" class="btn btn-success mt-3">Скачать реестр</a>
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
import download from "downloadjs"

export default {
    name: "ImportReestr",
    components: {Sitebar, Header},
    data() {
        return {
            file: '',
            message: false,
            loaded: false,
        }
    },
    methods: {
        addReestr() {
            this.loaded = true
            this.file = this.$refs.file.files[0];
            const formData = new FormData();
            formData.append('file', this.file);
            axios.post('/api/admin/reestr-import',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(res => {
                console.log(res)
                this.message = res.data.message
            }).catch(error => {
                console.log(error.response)
            }).finally(() => {
                this.loaded = false
            })
        },
        importReestr() {
            this.loaded = true
            axios.get('/api/admin/reestr-export')
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    this.loaded = false
                })
        }
    }
}
</script>

<style scoped>

</style>
