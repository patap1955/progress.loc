<template>
    <div class="auth">
        <div class="auth__icon">
            <Image class="auth__icon-img" img="favicon.png" />
<!--            <img class="auth__icon-img" src="/assets/images/template/favicon.png">-->
        </div>
        <div class="auth__wrapper">
            <div class="auth__wrapper-container">
                <h1 class="auth__wrapper-title">Добро пожаловать! 🐻</h1>
                <form class="auth__wrapper-form">
                    <div class="auth__wrapper-form-grid">
                        <label>Email</label>
                        <input v-model="email" type="email" name="email" required>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Пароль</label>
                        <input v-model="password" type="password" name="password" required>
                    </div>
                    <div class="auth__wrapper-form-flex">
                        <div class="auth__wrapper-form-link"><a href="#">Забыли пароль?</a></div>
                        <div class="auth__wrapper-form-button">
                            <button @click.prevent="login" class="button button-primary" type="submit">Войти</button>
                        </div>
                    </div>
                </form>
                <div class="auth__wrapper-info">
                    <p class="auth__wrapper-info-text">
                        Еще не зарегистрированы?
                        <router-link class="auth__wrapper-info-text-link" to="/registration">Регистрация</router-link>
                    </p>
                    <div class="auth__wrapper-info-warning">
                        <p>&#10004; Данный сервис используется исключительно в демонстрационных целях.</p>
                    </div>
                </div>
            </div>

        </div>
        <div class="auth__images">
            <div class="auth__images-rel">
                <Image img="auth-image.png" />
            </div>
            <div class="auth__images-abs">
                <Image img="auth-decoration.png" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Image from "@/components/UI/Image.vue";
export default {
    name: "Home",
    components: {Image},

    data () {
        return {
            email: null,
            password: null,
        }
    },

    methods: {
        login () {

            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                })
                    .then(res => {
                        localStorage.setItem('x-xsrf-token', res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'admin.home'})
                        const data = JSON.parse(res.config.data)
                        axios.post('/api/admin/user/' + data.email)
                            .then(response => {
                                localStorage.setItem('token-user', JSON.stringify(response.data.data))
                                // this.$store.dispatch('setUser', response.data.data)
                            })
                            .catch(err => {
                                console.log(err.response)
                            })
                    })
                    .catch(err => {
                        console.log(err.response)
                    });
            }).catch(err => {
                console.log(err.response)
            });
        }
    },
}
</script>

<style scoped>

</style>
