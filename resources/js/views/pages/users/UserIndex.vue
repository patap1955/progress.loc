<script>
import UserService from "@/service/UserService.js";
const userService = new UserService();
export default {
    name: "UserIndex",
    data() {
        return {
            users: []
        }
    },
    created() {
        this.getAllUsers();
    },
    methods: {
        getAllUsers() {
            userService.getAllUsers().then((data) => {this.users = data});
        },
    }
}
</script>

<template>
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
                    <Button icon="pi pi-times" severity="danger" rounded aria-label="Удалить" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<style scoped lang="scss">

</style>
