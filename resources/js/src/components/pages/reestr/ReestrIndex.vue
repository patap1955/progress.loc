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
                                Реестр исполнительных производств
                            </h1>
                            <div class="main__header-top-buttons">
                                <div class="main__header-top-buttons-item">
                                    <button class="button button-default">Поля таблицы</button>
                                </div>
                                <div class="main__header-top-buttons-item">
                                    <button class="button button-default">
                                        <svg viewBox="0 0 16 16">
                                            <path d="M9 15H7a1 1 0 010-2h2a1 1 0 010 2zM11 11H5a1 1 0 010-2h6a1 1 0 010 2zM13 7H3a1 1 0 010-2h10a1 1 0 010 2zM15 3H1a1 1 0 010-2h14a1 1 0 010 2z" fill="#64748b"></path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="main__header-top-buttons-item">
                                    <button class="button button-primary">&#10010; Поля таблицы</button>
                                </div>
                            </div>
                        </div>
                        <div class="main__header-bottom">
                            <div class="main__header-bottom-item">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Поиск" aria-label="Поиск">
                                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                                </form>
                            </div>
                            <div class="main__header-bottom-item">
                                <button class="button button-delete button-light" @click="deleteReestr()">
                                    <svg class="c3wll c7n6y cgmrc cm474" viewBox="0 0 16 16">
                                        <path d="M5 7h2v6H5V7zm4 0h2v6H9V7zm3-6v2h4v2h-1v10c0 .6-.4 1-1 1H2c-.6 0-1-.4-1-1V5H0V3h4V1c0-.6.4-1 1-1h6c.6 0 1 .4 1 1zM6 2v1h4V2H6zm7 3H3v9h10V5z"></path>
                                    </svg>
                                    Удалить реестр
                                </button>
                            </div>
                            <div class="main__header-bottom-item">
                                <button @click="checkReestr()" class="button button-default button-light">
                                    <svg class="text-slate-500 dark:text-slate-400 c3wll c7n6y cgmrc cm474" viewBox="0 0 16 16">
                                        <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z"></path>
                                        <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z"></path>
                                    </svg>
                                    Проверить реестр
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="main__content">
                        <div class="reestrList">
                            <div class="cardReestr">
                                <div class="card-header">
                                    <h3 class="card-header-title">Всего записей <span>{{ countReesrs }}</span></h3>
                                </div>
                                <div class="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead class="table__thead">
                                            <tr class="table__thead-tr">
                                                <th id="reestrsCheckboxAll" class="table__thead-tr-th" scope="col">
                                                 <input v-model="checkedAllReestr" class="table__thead-tr-checkbox" type="checkbox" :checked="isChecked">
                                                </th>
                                                <th v-for="key in getReestr.headers" class="table__thead-tr-th" scope="col">{{ key }}</th>
                                            </tr>
                                            </thead>
                                            <tbody class="table__tbody">
                                            <tr v-for="(item, index) in getReestr.data" :key="index" class="table__tbody-tr">
                                                <th class="table__tbody-tr-th" scope="row">
<!--                                                    <input id="reestr-checked" :data-reestr="item.id" class="table__thead-tr-checkbox" type="checkbox" :checked="checkedAllReestr">-->
                                                    <CheckboxComponent :checked-reestr="checkedAllReestr" :reestr-id="item.id" />
                                                </th>
                                                <td v-for="res in getReestrParse(item)" class="table__tbody-tr-th">{{ res }}</td>
                                            </tr>

                                            </tbody>
                                        </table>
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
        </div>
    </div>
</template>

<script>
import Header from "@/components/layouts/Header.vue";
import Sitebar from "@/components/layouts/Sitebar.vue";
import axios from "axios";
import CheckboxComponent from "@/components/UI/CheckboxComponent.vue";
import "toastr/toastr.js"


export default {
    name: "ReestrIndex",
    components: {CheckboxComponent, Sitebar, Header},

    data () {
        return {
            loaded: false,
            reestr: [],
            checked: false,
            checkedAllReestr: false,
            reestrSearch: [],
            isChecked: false,
        }
    },
    mounted() {
        this.queryReestr()
    },
    updated() {
        this.updateReestrsSearch
    },

    methods: {
        queryReestr() {
            this.$store.dispatch('queryReestr')
        },
        getReestrParse(data) {
            const newRes = JSON.parse(data.line)
            // newRes[3] = newRes[3].split("&quot;").join("")
            return newRes;
        },
        deleteReestr() {
            this.loaded = true
            axios.get('/api/admin/reestr/delete')
                .then(res => {
                    this.reestr = []
                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    this.loaded = false
                })
        },
        checkReestr() {
            const reestrs = this.$store.getters.getReestrsId;

            if (reestrs.length > 0) {
                axios.post('/api/admin/search-reestrs', {
                    data: reestrs[0]
                }).then(res => {
                    this.setSender(1)
                }).catch(err => {
                    console.log(err.response)
                })
            } else {
                console.log('Вы ни чего не выбрали для поиска')
            }
        },
        setSender(index) {
            const reestrs = this.$store.getters.getReestrsId;
            setTimeout(() => {
                axios.post('/api/admin/search-reestrs', {
                    data: reestrs[index]
                }).then(res => {
                    console.log(res)
                    if (index + 1 !== reestrs.length) this.setSender(index + 1)
                }).catch(err => {
                    console.log(err.response)
                })
            }, 15000)
        },
    },
    computed: {
        getReestr() {
            return this.$store.getters.getReestr
        },
        updateReestrsSearch() {
            this.reestrSearch = this.$store.getters.getReestrsId.length > 0 ? this.$store.getters.getReestrsId : null
        },
        countReesrs() {
            return  Object.keys(this.getReestr.data).length
        }

    }
}
</script>

<style scoped lang="scss">
    .reestrList {
        position: relative;
        overflow: auto;
        max-height: 60vh;
        width: 100%;
        background: #fff;
    }
    .cardReestr {
        overflow: auto;
    }
</style>
