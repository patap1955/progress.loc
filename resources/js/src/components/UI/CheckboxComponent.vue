<template>
<!--    <input @click="checkedChange(this.$el)" class="table__thead-tr-checkbox" type="checkbox" :checked="checkedReestr">-->
<!--    <input @click="checkedChange(this.$el)" class="table__thead-tr-checkbox" type="checkbox" :checked="checkedReestr">-->
    <input @click="checkedChange(this.$el)"  class="table__thead-tr-checkbox" type="checkbox" :checked="checkedReestr">
</template>

<script>
export default {
    name: "CheckboxComponent",
    data() {
        return {
            isChecked: false,
        }
    },
    props : {
        checkedReestr: {
            type: Boolean,
            required:true
        },
        reestrId: {
            type: Number,
            required: true
        }
    },
    mounted() {
        this.isChecked = this.checkedReestr
    },
    updated() {
        this.updatedReestrs();
    },
    methods: {
        updatedReestrs() {
            this.isChecked = this.checkedReestr

            if (this.isChecked) {
                this.$store.dispatch('setAddReestr', this.reestrId);
            } else {
                this.$store.dispatch('setDeleteReestr', this.reestrId);
            }
        },
        checkedChange() {
            this.isChecked = !this.isChecked
            console.log(this.isChecked)
            if (this.isChecked) {
                this.$store.dispatch('setAddReestr', this.reestrId);
            } else {
                this.$store.dispatch('setDeleteReestr', this.reestrId);
            }
        }
    },
}
</script>

<style scoped>

</style>
