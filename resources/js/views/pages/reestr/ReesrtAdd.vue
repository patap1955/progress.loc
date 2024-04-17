<template>
    <Toast />
    <div className="card ">
        <div class="reestr">
            <div class="reestr__header">
                <h2>Добавление записи в реестр</h2>

            </div>
            <div class="reestr__form mt-7">
                <div class="col-12 md:col-6">
                    <div class="p-fluid">
                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="number_ip">Номер ИП</label>
                                <InputText v-model="number_ip" id="number_ip" type="text" />
                            </div>
                            <div class="field col">
                                <label for="number_id">Номер ИД</label>
                                <InputText v-model="number_id" id="number_id" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="p-fluid">
                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="fio">ФИО</label>
                                <InputText v-model="fio" id="fio" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="p-fluid">
                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="birthdate">Дата рождения*</label>
                                <InputMask id="birthdate" v-model="birthdate" placeholder="01.01.2000" mask="99.99.9999" slotChar="дд/мм/гггг" />
                            </div>
                            <div class="field col">
                                <label for="number_inn">ИНН</label>
                                <InputText v-model="number_inn" id="number_inn" type="text" />
                            </div>
                        </div>
                    </div>
                    <div class="p-fluid">
                        <div class="formgrid grid">
                            <div class="field col">
                                <label for="region">Регион *</label>
                                <Dropdown id="region" v-model="region" :options="regions" optionLabel="name" placeholder="Регион *"></Dropdown>
                            </div>
                        </div>
                    </div>
                    <Button label="Добавить запись" @click="addReestr" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            region: null,
            regions: null,
            number_ip: null,
            number_id: null,
            fio: null,
            birthdate: null,
            number_inn: null,
        }
    },
    mounted() {
        this.getRegions()
    },
    methods: {
        getRegions() {
            axios.get('/api/regions')
                .then(res => {
                    this.regions = res.data
                }).catch(error => {
                console.log(error.response)
            })
        },
        addReestr() {
            if (this.number_id !== null && this.region !== null) {
                axios.post('/api/reestr-add', {
                    region:     this.region.id,
                    number_ip:  this.number_ip,
                    number_id:  this.number_id,
                    fio:        this.fio,
                    birthdate:  this.birthdate,
                    number_inn: this.number_id,

                }).then(res => {
                    console.log(res)
                    if (!res.error) {
                        this.$toast.add(
                            {
                                severity: 'success',
                                summary: 'Успех',
                                detail: 'Запись в реестр успешно добавлена',
                                life: 3000
                            });
                        } else {
                        this.$toast.add(
                            {
                                severity: 'error',
                                summary: 'Ошибка',
                                detail: 'Произошла ошибка при записи',
                                life: 3000
                            });
                    }
                    }).catch(err => {
                    console.log(err)
                })
            } else {
                this.$toast.add(
                    {
                        severity: 'warn',
                        summary: 'Предупреждение',
                        detail: 'Заполните поле Номер ИД',
                        life: 5000
                    });
            }
        },
    },
    // name: "ReesrtAdd",
    // components: {}
}
</script>

<style scoped>

</style>
