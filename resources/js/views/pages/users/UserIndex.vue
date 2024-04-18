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

    </div>
</template>

<style scoped lang="scss">

</style>
