<script>
import RoleService from "@/service/RoleService.js";

const roleService = new RoleService();
export default {
    name: "RoleEdit",
    data() {
        return {
            role: {}
        }
    },
    created() {
        this.getRole();
    },
    methods: {
        getRole() {
            roleService.getRole(this.$route.params.id).then((data) => {
                this.role = data
            })
        },
        updateRole() {
            roleService.updateRole(this.role).then((data) => {
                this.role = data.data
                this.$toast.add({
                    severity: 'success',
                    summary: 'Успех',
                    detail: 'Роль успешно отредактированна!!!',
                    life: 5000
                });
            })
        }
    }
}
</script>

<template>
    <Toast />
    <div class="card">
        <h2>Редактирование роли: {{ role.name }}</h2>

        <div class="mt-4">
            <div class="p-fluid">
                <div class="formgrid grid">
                    <div class="field col-3">
                        <label for="roleName">Имя</label>
                        <InputText v-model="role.name" id="roleName" type="text" :value="role.name"/>
                    </div>
                    <div class="field col-3">
                        <label for="roleSlug">Фамилия</label>
                        <InputText v-model="role.slug" id="roleSlug" type="text" :value="role.slug"/>
                    </div>
                </div>
            </div>
            <Button class="mt-3" label="Редактировать" @click="updateRole"/>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
