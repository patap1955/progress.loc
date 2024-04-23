<script>
import RoleService from "@/service/RoleService.js";

const roleService = new RoleService();
export default {
    name: "RoleAdd",
    data() {
        return {
            role: {
                name: "",
                slug: ""
            }
        }
    },
    methods: {
        addRole() {
            roleService.addRole(this.role).then((data) => {
                this.$toast.add({
                    severity: 'success',
                    summary: 'Успех',
                    detail: 'Роль успешно добавлена!!!',
                    life: 5000
                });
            }).catch(err => {
                console.log(err)
            })
        }
    }
}
</script>

<template>
    <Toast />
    <div class="card">
        <h2>Добавление роли: {{ role.name }}</h2>

        <div class="mt-4">
            <div class="p-fluid">
                <div class="formgrid grid">
                    <div class="field col-4">
                        <label for="roleName">Имя роли</label>
                        <InputText v-model="role.name" id="roleName" type="text"/>
                    </div>
                    <div class="field col-6">
                        <label for="roleSlug">Символьная ссылка</label>
                        <InputText v-model="role.slug" id="roleSlug" type="text"/>
                        <span>только латинские буквы и вместо пробелов - или _</span>
                    </div>
                </div>
            </div>
            <Button class="mt-3" label="Добавить" @click="addRole"/>
        </div>
    </div>
</template>

<style scoped lang="scss">

</style>
