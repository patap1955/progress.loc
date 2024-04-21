<script>
import RoleService from "@/service/RoleService.js";
import UserService from "@/service/UserService.js";

const roleService = new RoleService();
const userService = new UserService();
export default {
    name: "UserAdd",
    data() {
        return {
            user: {
                name: null,
                surname: null,
                lastname: null,
                email: null,
                role: null,
                password: null,
            },
            roles: [],
            selectedRole: null,
            passwordVert: null,
            errors: null,
        }
    },
    mounted() {
        this.getAllRoles();
    },
    methods: {
        getAllRoles() {
            roleService.getAllRoles().then((data) => {this.roles = data});
        },
        addUser() {
            if (this.user.password === this.passwordVert && this.user.password !== null && this.user.password !== "")  {
                let error = false;
                if (this.user.name === null || this.user.name === "") {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: 'Заполните поле с Имя!!!',
                        life: 5000
                    });
                } else if (this.user.email === null || this.user.email === "") {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: 'Заполните поле с Email!!!',
                        life: 5000
                    });
                } else if(this.user.role === null) {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: 'Выберите роль для пользователя!!!',
                        life: 5000
                    });
                } else {
                    let user = this.user;
                    user.role_id = this.user.role.id
                    userService.addUser(user).then(res => {
                        this.$toast.add({
                            severity: 'success',
                            summary: 'Успех',
                            detail: 'Пользователь успешно добавлен!!!',
                            life: 5000
                        });
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
                    })
                }
            } else {
                this.$toast.add({
                    severity: 'warn',
                    summary: 'Предупреждение',
                    detail: 'Введеные пароли не совпадают!!!',
                    life: 5000
                });
            }
        },
    },
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
                        <InputText v-model="user.email" id="name2" type="text" :value="user.email" />
                    </div>
                    <div class="field col-3">
                        <label for="email2">Роль</label>
                        <Dropdown v-model="user.role" :options="roles" optionLabel="name" placeholder="Выбрать роль" class="w-full md:w-14rem" />
                    </div>
                </div>
                <div class="formgrid grid">
                    <div class="field col-3">
                        <label for="name2">Пароль</label>
                        <Password v-model="user.password" toggleMask />
                    </div>
                    <div class="field col-3">
                        <label for="email2">Подтвердите пароль</label>
                        <Password v-model="passwordVert" :feedback="false" toggleMask />
                    </div>
                </div>
            </div>
            <Button class="mt-3" label="Добавить пользователя" @click="addUser"/>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
