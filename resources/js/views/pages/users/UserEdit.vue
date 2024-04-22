<script>
import UserService from "@/service/UserService.js";
import RoleService from "@/service/RoleService.js";

const userService = new UserService();
const roleService = new RoleService();
export default {
    name: "UserEdit",
    data() {
        return {
            user: [],
            roles: [],
            selectedRole: null,
            password: "",
            passwordVert: "",

        }
    },
    created() {
        this.getUser();
        this.getAllRoles();
    },
    mounted() {

    },
    methods: {
        getUser() {
            userService.getUser(this.$route.params.id).then((data) => {this.user = data.data});
        },
        getAllRoles() {
            roleService.getAllRoles().then((data) => {this.roles = data});
        },
        updateUser() {
            if (this.password === "") {
                this.axiosPostUser();
            } else {
                if (this.password === this.passwordVert) {
                    if (this.user.name === "") {
                        this.$toast.add({
                            severity: 'warn',
                            summary: 'Предупреждение',
                            detail: 'Заполните поле Имя',
                            life: 5000
                        });
                    }
                    if (this.user.email === "") {
                        this.$toast.add({
                            severity: 'warn',
                            summary: 'Предупреждение',
                            detail: 'Заполните поле Email',
                            life: 5000
                        });
                    }

                    if (this.user.name !== "" && this.user.email !== "") {
                        this.axiosPostUser();
                    }
                } else {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: 'Введеные пароли не совпадают!!!',
                        life: 5000
                    });
                }
            }
        },
        axiosPostUser() {
            let user = this.user;
            user.role_id = this.user.role.id
            if (this.password !== "") user.password = this.password
            userService.updateUser(user).then(res => {
                if (res.data.error === false) {
                    this.user = res.data.user
                    this.$toast.add({
                        severity: 'success',
                        summary: 'Успех',
                        detail: 'Пользователь успешно изменен',
                        life: 5000
                    });
                } else {
                    console.log(res)
                }

            }).catch(err => {
                if (err.response.data.errors.email) {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: err.response.data.errors.email[0],
                        life: 5000
                    });
                }
                console.log(err.response.data)
            });
        }
    }
}
</script>

<template>
    <Toast />
    <div class="card">
        <h2>Редактирование пользователя: {{ user.email }}</h2>
<!--        {{ console.log(selectedRole) }}-->
        <div class="mt-5">
            <div class="p-fluid">
                <div class="formgrid grid">
                    <div class="field col">
                        <label for="name2">Имя</label>
                        <InputText v-model="user.name" id="name2" type="text" :value="user.name"/>
                    </div>
                    <div class="field col">
                        <label for="email2">Фамилия</label>
                        <InputText v-model="user.surname" id="email2" type="text" :value="user.surname"/>
                    </div>
                    <div class="field col">
                        <label for="email2">Отчество</label>
                        <InputText v-model="user.lastname" id="email2" type="text" :value="user.lastname"/>
                    </div>
                </div>
                <div class="formgrid grid">
                    <div class="field col-3">
                        <label for="name2">Email</label>
                        <InputText v-model="user.email" id="name2" type="text" :value="user.email"/>
                    </div>
                    <div class="field col-3">
                        <label for="email2">Роль</label>
                        <Dropdown v-model="user.role" :options="roles" optionLabel="name" placeholder="Выбрать роль" class="w-full md:w-14rem" />
                    </div>
                </div>
                <div class="formgrid grid">
                    <div class="field col-3">
                        <label for="name2">Пароль</label>
                        <Password v-model="password" toggleMask />
                    </div>
                    <div class="field col-3">
                        <label for="email2">Подтвердите пароль</label>
                        <Password v-model="passwordVert" :feedback="false" toggleMask />
                    </div>
                </div>
            </div>
            <Button class="mt-3" label="Изменить" @click="updateUser"/>
        </div>
    </div>
</template>

<style scoped>

</style>
