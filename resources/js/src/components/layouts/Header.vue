<template>
        <div class="header">
            <div @click.prevent="toggleHidden" class="header__user">
                <div class="header__user-info">
                    <Image class="sitebar__logo-img" img="favicon.png" />
                    <p class="header__user-name">{{ getUser.name }}</p>
                    <svg class="header__user-svg" viewBox="0 0 12 12">
                        <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"></path>
                    </svg>
                </div>
                <div id="headerUserHidden" class="header__user-info-hidden">
                    <div class="header__user-hidden">
                        <div class="header__user-hidden-info">
                            <p>{{ getUser.name }}</p>
                            <span>{{ getUser.role.name }}</span>
                        </div>
                        <a @click.prevent="logout" href="#" class="header__user-hidden-info">Выход</a>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import axios from "axios";
import Image from "@/components/UI/Image.vue";
export default {
    name: "Header",
    components: {Image},

    data () {
        return {
            user: {},
        }
    },

    // created() {
    //     this.user = this.getUser
    // },

    mounted() {
        this.user = this.getUser
    },

    methods: {
        logout() {
            axios.post('/logout').then(res => {
                localStorage.removeItem('x-xsrf-token')
                localStorage.removeItem('user')
                this.$router.push({name: 'login'})
            })
        },
        toggleHidden () {
            const headerUserHidden = document.getElementById('headerUserHidden')
            headerUserHidden.classList.toggle('active')
        },
        getUser() {
            console.log(JSON.parse(localStorage.getItem('user')))
            return JSON.parse(localStorage.getItem('user'))
        }
    },
    computed: {
        getUser() {
            return JSON.parse(localStorage.getItem('user'))
        }
    }
}
</script>


