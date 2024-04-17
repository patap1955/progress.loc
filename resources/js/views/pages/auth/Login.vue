<script>
import axios from "axios";

export default {
    data () {
        return {
            email: null,
            password: null,
            validationErrors:{},
            processing: false,
            checked: false,
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', {
                    email: this.email,
                    password: this.password,
                })
                    .then(res => {
                        localStorage.setItem('x-xsrf-token', res.config.headers['X-XSRF-TOKEN'])
                        const data = JSON.parse(res.config.data)
                        axios.get('/api/user/' + data.email)
                            .then(response => {
                                console.log(response)
                                localStorage.setItem('user', JSON.stringify(response.data.data))
                                this.$router.push({name: 'reestr'})
                            })
                            .catch(err => {
                                console.log(err.response)
                            })
                    })
                    .catch(err => {
                        console.log(err.response)
                    })
                    .finally(() => {
                        // this.processing = false
                    });
            }).catch(err => {
                console.log(err.response)
            });
        },
    },
}

</script>

<template>
    <div class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="flex flex-column align-items-center justify-content-center">
<!--            <img :src="logoUrl" alt="Sakai logo" class="mb-5 w-6rem flex-shrink-0" />-->
            <div style="border-radius: 56px; padding: 0.3rem; background: linear-gradient(180deg, var(--primary-color) 10%, rgba(33, 150, 243, 0) 30%)">
                <div class="w-full surface-card py-8 px-5 sm:px-8" style="border-radius: 53px">
                    <div class="text-center mb-5">
<!--                        <img src="/demo/images/login/avatar.png" alt="Image" height="50" class="mb-3" />-->
                        <div class="text-900 text-3xl font-medium mb-3">Добро пожаловать</div>
                        <span class="text-600 font-medium">Авторизация</span>
                    </div>

                    <div>
                        <label for="email1" class="block text-900 text-xl font-medium mb-2">Email</label>
                        <InputText id="email1" type="text" placeholder="Введите email" class="w-full md:w-30rem mb-5" style="padding: 1rem" v-model="email" />

                        <label for="password1" class="block text-900 font-medium text-xl mb-2">Пароль</label>
                        <Password id="password1" v-model="password" placeholder="Введите gfhjkm" :toggleMask="true" class="w-full mb-3" inputClass="w-full" :inputStyle="{ padding: '1rem' }"></Password>

                        <div class="flex align-items-center justify-content-between mb-5 gap-5">
                            <a class="font-medium no-underline ml-2 text-right cursor-pointer" style="color: var(--primary-color)">Востановить пароль?</a>
                        </div>
                        <Button label="Вход" class="w-full p-3 text-xl" @click="login"></Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <AppConfig simple />
</template>

<style scoped>
.pi-eye {
    transform: scale(1.6);
    margin-right: 1rem;
}

.pi-eye-slash {
    transform: scale(1.6);
    margin-right: 1rem;
}
</style>
