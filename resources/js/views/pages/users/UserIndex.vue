<script>
import UserService from "@/service/UserService.js";
const userService = new UserService();
export default {
    name: "UserIndex",
    data() {
        return {
            users: [],
            user: null,
        }
    },
    created() {
        this.getAllUsers();
        this.authUser();
    },
    methods: {
        getAllUsers() {
            userService.getAllUsers().then((data) => {this.users = data});
        },
        authUser() {
            this.user = JSON.parse(localStorage.getItem('user'))
        },
        deleteUser(id, position) {
            this.$confirm.require({
                group: 'positioned',
                message: 'Вы уверены, что хотите продолжить?',
                header: 'Подтверждение',
                icon: 'pi pi-info-circle',
                position: position,
                rejectClass: 'p-button-secondary p-button-text',
                acceptClass: 'p-button-text',
                rejectLabel: 'Отменить',
                acceptLabel: 'Подтвердить',
                accept: () => {
                    userService.deleteUser(id).then((data) => {
                        this.users = data.data
                        this.$toast.add({
                            severity: 'success',
                            summary: 'Успех',
                            detail: 'Пользователь успешно удален!!!',
                            life: 5000
                        });
                    });
                },
                reject: () => {
                    this.$toast.add({ severity: 'error', summary: 'Отмена', detail: 'Удаление отменено', life: 5000 });
                }
            });
        },
    }
}
</script>

<template>
    <Toast />
    <ConfirmDialog group="positioned"></ConfirmDialog>
    <div class="card">
        <DataTable :value="users" tableStyle="min-width: 50rem">
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">Список пользователей</span>
                </div>
            </template>
            <Column field="name" header="Имя"></Column>
            <Column field="email" header="Email"></Column>
            <Column field="role" header="Роль">
                <template #body="slotProps">
                    {{ slotProps.data.role.name }}
                </template>
            </Column>
            <Column header="Действие">
                <template #body="slotProps">
                    <router-link :to="'/users/edit/' + slotProps.data.id" class="p-button p-component mr-3">
                        <span class="p-button-icon p-button-icon-left pi pi-pencil" data-pc-section="icon"></span>
                        Редактировать
                    </router-link>
                    <Button v-if="user.id !== slotProps.data.id" icon="pi pi-trash" label="Удалить" severity="danger" @click="deleteUser(slotProps.data.id, 'top')" />
<!--                    <Button v-if="user.id !== slotProps.data.id" icon="pi pi-times" severity="danger" rounded aria-label="Удалить" @click="deleteUser(slotProps.data.id, 'top')"/>-->
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped lang="scss">

</style>
