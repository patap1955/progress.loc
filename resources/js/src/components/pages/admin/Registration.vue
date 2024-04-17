<template>
    <div class="auth">
        <div class="auth__icon">
            <Image class="auth__icon-img" img="favicon.png" />
<!--            <img class="auth__icon-img" src="/assets/images/template/favicon.png">-->
        </div>
        <div class="auth__wrapper">
            <div class="auth__wrapper-container">
                <h1 class="auth__wrapper-title">Регистрация 🐻</h1>
                <form class="auth__wrapper-form">
                    <div class="auth__wrapper-form-grid">
                        <label>Email</label>
                        <input v-model="email" type="email" name="email" required>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Ваше имя</label>
                        <input v-model="name" type="email" name="name" required>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Роль</label>
                        <select v-model="role_id" name="role_id">
                            <option value="10">Модератор</option>
                            <option value="11">Менеджер</option>
                            <option value="12">Юрист</option>
                        </select>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Пароль</label>
                        <input v-model="password" type="password" name="password" required>
                    </div>
                    <div class="auth__wrapper-form-grid">
                        <label>Повторите пароль</label>
                        <input v-model="password_confirmation" type="password" name="password_confirmation" required>
                    </div>
                    <div class="auth__wrapper-form-flex">
                        <div class="auth__wrapper-form-button">
                            <button @click.prevent="register" class="button button-primary" type="submit">Регистрация</button>
                        </div>
                    </div>
                </form>
                <div class="auth__wrapper-info">
                    <p class="auth__wrapper-info-text">У Вас уже ессть учетная запись? <router-link class="auth__wrapper-info-text-link" to="/login">Войти</router-link></p>
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
    name: "Registration",
    components: {Image},

    data () {
        return {
            email: null,
            name: null,
            password: null,
            role_id: null,
            password_confirmation: null,
        }
    },

    methods: {
        register () {

            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    email: this.email,
                    name: this.name,
                    role_id: this.role_id,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                })
                    .then(res => {
                        localStorage.setItem('x-xsrf-token', res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'admin.home'})
                        console.log(res)
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
