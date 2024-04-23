<script>
import RoleService from "@/service/RoleService.js";

const roleService = new RoleService();
export default {
    name: "RolesIndex",
    data() {
      return {
          roles: [],
      }
    },
    created() {
        this.getAllRoles();
    },
    methods: {
        getAllRoles() {
            roleService.getAllRoles().then((data) => {this.roles = data})
        }
    }
}
</script>

<template>
    <div class="card">
        <h2>Все роли</h2>

        <div class="mt-5 mb-5">
            <router-link to="/settings/role/add" class="p-button p-component mr-3">
                Добавить роль
            </router-link>
        </div>

        <DataTable :value="roles" tableStyle="min-width: 50rem">
            <template #header>
                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                    <span class="text-xl text-900 font-bold">Список ролей</span>
                </div>
            </template>
            <Column field="name" header="Имя"></Column>
            <Column field="slug" header="Символьная ссылка"></Column>
            <Column header="Действие">
                <template #body="slotProps">
                    <router-link :to="'/settings/role/edit/' + slotProps.data.id" class="p-button p-component mr-3">
                        <span class="p-button-icon p-button-icon-left pi pi-pencil" data-pc-section="icon"></span>
                        Редактировать
                    </router-link>
<!--                    <Button v-if="user.id !== slotProps.data.id" icon="pi pi-trash" label="Удалить" severity="danger" @click="deleteUser(slotProps.data.id, 'top')" />-->
                </template>
            </Column>
        </DataTable>
        <div class="mt-5 mb-5">
            <router-link to="/settings/role/add" class="p-button p-component mr-3">
                <span class="" data-pc-section="icon"></span>
                Добавить роль
            </router-link>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
