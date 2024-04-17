<script>
import axios from "axios";

import ReestrServices from "@/service/ReestrServices.js";
import { FilterMatchMode, FilterOperator } from 'primevue/api';

const reestrServices = new ReestrServices()

export default {
    name: "ReestrIndex",

    data() {
        return {
            loaded: false,
            reestr: null,
            selectedProduct: null,
            metaKey: true,

            products: null,
            expandedRows: [],
            filters: null,

        }
    },
    beforeMount() {

    },
    mounted() {

    },
    created() {
        this.queryReestr();
        this.initFilters();

    },

    methods: {
        onUpload(event) {
            const file = event.files[0];
            const formData = new FormData();
            formData.append('file', file);
            axios.post('/api/reestr-import',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(res => {
                if (res.data.error == false) {
                    this.reestr = {
                        headers: JSON.parse(res.data.reestr.header),
                        data: res.data.reestr.reestrs
                    }
                    this.$toast.add({
                        severity: 'success',
                        summary: 'Успешно',
                        detail: 'Реестр успешно загружен',
                        life: 5000
                    });
                } else {
                    this.$toast.add({
                        severity: 'warn',
                        summary: 'Ошибка',
                        detail: 'Произошла ошибкаа при загрузке',
                        life: 5000
                    });
                }
                this.message = res.data.message
            }).catch(error => {
                console.log(error.response)
                this.$toast.add(
                    {
                        severity: 'warn',
                        summary: 'Success',
                        detail: 'Произошла ошибкаа при загрузке, проверьте расширение файла, он должен быть формата xlsx',
                        life: 5000
                    });
            }).finally(() => {
                // this.loaded = false
            })
        },
        queryReestr() {
            reestrServices.getReestr().then((data) => (this.products = data));
        },
        parseData(data) {
            // console.log(data)
            const newData = [];
            for (var key in data) {
                newData.push(data[key])
            }
            return newData;
        },
        jsonParseData(data) {
            return JSON.parse(data)
        },
        parseLineData(data, index) {
            const line = JSON.parse(data)
            return line[index]
        },
        onRowExpand(event) {
            this.$toast.add({ severity: 'info', summary: 'Product Expanded', detail: event.data.name, life: 3000 });
        },
        onRowCollapse(event) {
            this.$toast.add({ severity: 'success', summary: 'Product Collapsed', detail: event.data.name, life: 3000 });
        },
        expandAll() {
            this.expandedRows = this.products.reduce((acc, p) => (acc[p.id] = true) && acc, {});
        },
        collapseAll() {
            this.expandedRows = null;
        },
        deleteReestr() {
            this.loaded = true
            axios.get('/api/reestr/delete')
                .then(res => {
                    this.reestr = null
                })
                .catch(error => {
                    console.log(error.response)
                })
                .finally(() => {
                    // this.loaded = false
                })
        },
        recursiveSearchReestrFssp(index) {
            setTimeout(() => {
                axios.post('/api/search-reestrs', {
                    data: this.selectedReestr[index].id
                }).then(res => {
                    if (index + 1 !== this.selectedReestr.length) this.recursiveSearchReestrFssp(index + 1)
                }).catch(err => {
                    console.log(err.response)
                })
            }, 15000)
        },
        searchReestrFssp() {
            if (this.selectedReestr !== null) {
                axios.post('/api/search-reestrs', {
                    data: this.selectedReestr[0].id
                }).then(res => {
                    this.recursiveSearchReestrFssp(1)
                }).catch(err => {
                    console.log(err.response)
                })
            } else {
                this.$toast.add({
                    severity: 'warn',
                    summary: 'Предупреждение',
                    detail: 'Вы ни чего не выбрали для поиска',
                    life: 5000
                });
            }
        },
        clearFilter() {
            this.initFilters();
        },
        initFilters() {
            this.filters = {
                global: { value: null, matchMode: FilterMatchMode.CONTAINS },
                fio: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
                ip_number: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
                id_number: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
                inn: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
            };
        },
    },
    computed: {
        // getReestr() {
        //     console.log(reestrServices.getReestr())
        //   return reestrServices.getReestr().then((data) => (this.products = data));
        // },
        countReesrs() {
            return Object.keys(this.reestr.data).length

        },

    }
};
</script>

<template>
    <Toast />
    <div className="card reestr">
        <div class="reestr">
            <div class="reestr__header">
                <h2>Реестр исполнительных производств</h2>
                <div class="reestr__header-buttons">
                    <div class="reestr__header-buttons-upload">
                        <FileUpload mode="basic" :auto="true" customUpload @uploader="onUpload" chooseLabel="Загрузить реестр"/>
                    </div>
                    <div class="reestr__header-buttons-dowload">
                        <a href="/api/reestr-export" class="p-button p-component">
                            <span class="p-button-icon p-button-icon-left pi pi-download" data-pc-section="icon"></span>
                            Скачать реестр
                        </a>
                    </div>
                </div>
            </div>
            <div class="reestr__search mt-5">
                <Button icon="pi pi-trash" label="Удалить реестр" severity="danger" @click="deleteReestr" text raised />
                <Button type="button" label="Поиск по реестру" icon="pi pi-search" severity="info" @click="searchReestrFssp"/>
            </div>
            <div class="reestr__table mt-7">

                <Panel header="Загруженый реестр" :toggleable="true">
                    <!--                    {{ parseData(products.reestrs) }}-->
                    <DataTable
                        v-model:selection="selectedProduct"
                        v-model:expandedRows="expandedRows"
                        v-model:filters="filters"
                        :value="parseData(products.reestrs)"
                        dataKey="id"
                        tableStyle="min-width: 50rem"
                        paginator :rows="15"
                        filterDisplay="menu"
                        :globalFilterFields="['fio', 'ip_number', 'id_number', 'inn']"
                    >
                        <!--                        :globalFilterFields="['fio', 'ip_number', 'id_number', 'inn']"-->
                        <template #header>
                            <div class="flex justify-content-between">
                                <Button type="button" icon="pi pi-filter-slash" label="Очистить поиск" outlined @click="clearFilter()" />
                                <IconField iconPosition="left">
                                    <InputIcon>
                                        <i class="pi pi-search" />
                                    </InputIcon>
                                    <InputText v-model="filters['global'].value" placeholder="Поиск по реестру" />
                                </IconField>
                            </div>
                        </template>
                        <template #empty> По вашему запросу ни чего не нашлось. </template>

                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column expander style="width: 5rem" />
                        <Column field="fio" header="Должник">
                            <template #body="{ data }">
                                {{ data.fio }}
                            </template>
                            <template #filter="{ filterModel }">
                                <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Поиск по должнику" />
                            </template>
                        </Column>
                        <Column field="ip_number" header="Номер ИП">
                            <template #body="{ data }">
                                {{ data.ip_number }}
                            </template>
                            <template #filter="{ filterModel }">
                                <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Поиск по должнику" />
                            </template>
                        </Column>
                        <Column field="id_number" header="Номер ИД">
                            <template #body="{ data }">
                                {{ data.id_number }}
                            </template>
                            <template #filter="{ filterModel }">
                                <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Поиск по должнику" />
                            </template>
                        </Column>
                        <Column field="inn" header="Инн">
                            <template #body="{ data }">
                                {{ data.inn }}
                            </template>
                            <template #filter="{ filterModel }">
                                <InputText v-model="filterModel.value" type="text" class="p-column-filter" placeholder="Поиск по должнику" />
                            </template>
                        </Column>
                        <template #expansion="slotProps">
                            <div class="p-3">
                                <h5>Должник : {{ slotProps.data.fio }}</h5>
                            </div>

                            <div class="card">
                                <Accordion :activeIndex="1">
                                    <AccordionTab header="История поиска по реестру">
                                        <p>История 1</p>
                                        <p>История 2</p>
                                        <p>История 3</p>
                                        <p>История 4</p>
                                    </AccordionTab>
                                    <AccordionTab header="Информация по должнику">
                                        <div class="table__info">
                                            <div v-for="(item, index) of jsonParseData(products.header)" :key="index" class="table__info-line">
                                                <p class="text-teal-900">{{ item }}</p>
                                                <p>{{ parseLineData(slotProps.data.line, index) }}</p>
                                            </div>
                                        </div>

                                    </AccordionTab>
                                </Accordion>
                            </div>
                        </template>
                    </DataTable>
                </Panel>

            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
.table__info {
    &-line {
        display:grid;
        grid-template-columns: 300px auto;
        column-gap: 30px;
        padding-top: 8px;
        border-bottom: 1px solid #acacac;
    }
}
</style>
