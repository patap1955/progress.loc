<template>
    <div class="sitebar">
        <div class="sitebar__logo">
            <router-link to="/admin">
                <Image img="favicon.png" />
<!--                <img class="sitebar__logo-img" src="/assets/images/template/favicon.png">-->
            </router-link>
        </div>
<!--        <div class="sitebar__nav">-->
<!--            <h3 class="sitebar__title">Меню</h3>-->
<!--            <ul class="sitebar__nav-list">-->
<!--                <li class="sitebar__nav-item">-->
<!--                        <span class="sitebar__nav-item-title">-->
<!--                            <svg class="sitebar__nav-item-svg" viewBox="0 0 24 24">-->
<!--                                <path class="" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" fill="#A5B4FCFF"></path>-->
<!--                                <path class="" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" fill="#4F46E5FF"></path>-->
<!--                                <path class="" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" fill="#6366F1FF"></path>-->
<!--                            </svg>-->
<!--                            <span class="sitebar__nav-item-text">Реестр ИП</span>-->
<!--                        </span>-->
<!--                    <ul class="sitebar__nav-list sitebar__nav-list-sub">-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/reestr">Рееестр</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/reestr-add">Новая запись</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/reestr-import">Импорт в реестр</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/">Скачать рееестр</router-link>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="sitebar__nav-item">-->
<!--                        <span class="sitebar__nav-item-title">-->
<!--                            <svg class="sitebar__nav-item-svg" viewBox="0 0 24 24">-->
<!--                                <path class="ccazs c3wll" d="M4.418 19.612A9.092 9.092 0 0 1 2.59 17.03L.475 19.14c-.848.85-.536 2.395.743 3.673a4.413 4.413 0 0 0 1.677 1.082c.253.086.519.131.787.135.45.011.886-.16 1.208-.474L7 21.44a8.962 8.962 0 0 1-2.582-1.828Z" fill="#334155FF"></path>-->
<!--                                <path class="c6w4h c3wll" d="M10.034 13.997a11.011 11.011 0 0 1-2.551-3.862L4.595 13.02a2.513 2.513 0 0 0-.4 2.645 6.668 6.668 0 0 0 1.64 2.532 5.525 5.525 0 0 0 3.643 1.824 2.1 2.1 0 0 0 1.534-.587l2.883-2.882a11.156 11.156 0 0 1-3.861-2.556Z" fill="#475569FF"></path>-->
<!--                                <path class="czgoy c3wll" d="M21.554 2.471A8.958 8.958 0 0 0 18.167.276a3.105 3.105 0 0 0-3.295.467L9.715 5.888c-1.41 1.408-.665 4.275 1.733 6.668a8.958 8.958 0 0 0 3.387 2.196c.459.157.94.24 1.425.246a2.559 2.559 0 0 0 1.87-.715l5.156-5.146c1.415-1.406.666-4.273-1.732-6.666Zm.318 5.257c-.148.147-.594.2-1.256-.018A7.037 7.037 0 0 1 18.016 6c-1.73-1.728-2.104-3.475-1.73-3.845a.671.671 0 0 1 .465-.129c.27.008.536.057.79.146a7.07 7.07 0 0 1 2.6 1.711c1.73 1.73 2.105 3.472 1.73 3.846Z" fill="#94A3B8FF"></path>-->
<!--                            </svg>-->
<!--                            <span class="sitebar__nav-item-text">База ФССП</span>-->
<!--                        </span>-->
<!--                    <ul class="sitebar__nav-list sitebar__nav-list-sub">-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/search-ip">Поиск по номеру ИП</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/search-id">Поиск по номеру ИД</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/search-inn">Поиск по ИНН</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/search-fl">Поиск по данным ФЛ</router-link>-->
<!--                        </li>-->
<!--                        <li class="sitebar__nav-item sitebar__nav-item-sub">-->
<!--                            <router-link to="/admin/search-ul">Поиск по данным ЮЛ</router-link>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->



        <PanelMenu :model="items">
            <template #item="{ item, root, active, props, hasSubmenu }" :aria-expanded="true">
                    <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
                        <a class="flex items-center cursor-pointer text-slate-400 py-1 ml-5" :href="href" @click.prevent="test(navigate, $event)">
                            <span class="ml-3 text-color">{{ item.label }}</span>
                        </a>
                    </router-link>
                    <a v-else class="flex items-center cursor-pointer text-white py-1 mt-2" >
                        <span v-html="item.icon"></span>
                        <span class="ml-2">{{ item.label }}</span>
                    </a>
            </template>
        </PanelMenu>



    </div>
</template>
<script>
import axios from "axios";
import {read} from "@popperjs/core";
import Image from "@/components/UI/Image.vue";
import PanelMenu from 'primevue/panelmenu';

export default {
    name: "Sitebar",
    components: {Image, PanelMenu},
    data () {
        return {
            state: false,
            senders: null,
            expandedKeys: false,
            items: [
                {
                    label: 'Реестр ИП',
                    icon: '<svg class="sitebar__nav-item-svg" viewBox="0 0 24 24">\n' +
                        '                        <path class="" d="M13 15l11-7L11.504.136a1 1 0 00-1.019.007L0 7l13 8z" fill="#A5B4FCFF"></path>\n' +
                        '                        <path class="" d="M13 15L0 7v9c0 .355.189.685.496.864L13 24v-9z" fill="#4F46E5FF"></path>\n' +
                        '                        <path class="" d="M13 15.047V24l10.573-7.181A.999.999 0 0024 16V8l-11 7.047z" fill="#6366F1FF"></path>\n' +
                        '                    </svg>',
                    isActive: true,
                    items: [
                        {
                            label: 'Реестр',
                            route: this.$router.resolve({name: 'admin.reestr',}),
                        },
                        {
                            label: 'Новая запись',
                            route: this.$router.resolve({name: 'admin.reestr.add',}),
                        },
                        {
                            label: 'Импорт в реестр',
                            route: this.$router.resolve({name: 'admin.reestr.import',}),
                        },
                        {
                            label: 'Скачать реестр',
                            route: this.$router.resolve({name: 'admin.reestr',}),
                        }
                    ]
                },
                {
                    label: 'База ФССП',
                    icon: '<svg class="sitebar__nav-item-svg" viewBox="0 0 24 24"><path class="ccazs c3wll" d="M4.418 19.612A9.092 9.092 0 0 1 2.59 17.03L.475 19.14c-.848.85-.536 2.395.743 3.673a4.413 4.413 0 0 0 1.677 1.082c.253.086.519.131.787.135.45.011.886-.16 1.208-.474L7 21.44a8.962 8.962 0 0 1-2.582-1.828Z" fill="#334155FF"></path><path class="c6w4h c3wll" d="M10.034 13.997a11.011 11.011 0 0 1-2.551-3.862L4.595 13.02a2.513 2.513 0 0 0-.4 2.645 6.668 6.668 0 0 0 1.64 2.532 5.525 5.525 0 0 0 3.643 1.824 2.1 2.1 0 0 0 1.534-.587l2.883-2.882a11.156 11.156 0 0 1-3.861-2.556Z" fill="#475569FF"></path><path class="czgoy c3wll" d="M21.554 2.471A8.958 8.958 0 0 0 18.167.276a3.105 3.105 0 0 0-3.295.467L9.715 5.888c-1.41 1.408-.665 4.275 1.733 6.668a8.958 8.958 0 0 0 3.387 2.196c.459.157.94.24 1.425.246a2.559 2.559 0 0 0 1.87-.715l5.156-5.146c1.415-1.406.666-4.273-1.732-6.666Zm.318 5.257c-.148.147-.594.2-1.256-.018A7.037 7.037 0 0 1 18.016 6c-1.73-1.728-2.104-3.475-1.73-3.845a.671.671 0 0 1 .465-.129c.27.008.536.057.79.146a7.07 7.07 0 0 1 2.6 1.711c1.73 1.73 2.105 3.472 1.73 3.846Z" fill="#94A3B8FF"></path></svg>',
                    isActive: false,
                    items: [
                        {
                            label: 'Поиск по номеру ИП',
                            route: this.$router.resolve({name: 'admin.search.ip',}),
                        },
                        {
                            label: 'Поиск по номеру ИД',
                            route: this.$router.resolve({name: 'admin.search.id',}),
                        },
                        {
                            label: 'Поиск по ИНН',
                            route: this.$router.resolve({name: 'admin.search.inn',}),
                        },
                        {
                            label: 'Поиск по данным ФЛ',
                            route: this.$router.resolve({name: 'admin.search.fl',}),
                        },
                        {
                            label: 'Поиск по данным ЮЛ',
                            route: this.$router.resolve({name: 'admin.search.ul',}),
                        }
                    ]
                },
            ]
        }
    },
    mounted() {
        // this.getSenders();
    },
    updated() {

    },

    methods: {
        test(navigate, state) {
            navigate();
            console.log(state)
            // return state
        },
        testActive(active) {
            console.log(active)
        }
        // getSenders() {
        //     axios.get('/api/admin/senders').then(response => {
        //         this.senders = response.data
        //     })
        // }
    }
}
</script>
