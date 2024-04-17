<script>
import DownloadReportService from "@/service/DownloadReportService.js";
import ReportDocService from "@/service/ReportDocService.js";
// import Repo

const downloadReportService = new  DownloadReportService();
const reportDocService = new ReportDocService();
export default {
    name: "DownloadReportDoc",
    data() {
        return {
            dateStart: null,
            dateEnd: null,
            selectedDoc: null,
            docs: null,
        }
    },
    mounted() {
        this.getDocs();
    },
    methods: {
        downloadReport() {
            const data = {
                dataStart: this.dateStart,
                dataEnd: this.dateEnd,
                selectedDoc: this.selectedDoc
            }

            if (this.dateStart !== null && this.dateEnd !== null && this.selectedDoc !== null) {
                downloadReportService.downloadReportDoc(data);
            } else {
                this.$toast.add({
                    severity: 'warn',
                    summary: 'Предупреждение',
                    detail: 'Заполните все поля',
                    life: 5000
                });
            }

        },
        getDocs() {
            reportDocService.getDocs().then((data) => (this.docs = data));
        }
    }
}
</script>

<template>
    <div class="card">
        <h2>Выгрузка данных по типу документа</h2>
        <div class="p-fluid">
            <div class="formgrid grid">
                <div class="field col-2">
                    <label for="name2">Начало переода</label>
                    <Calendar v-model="dateStart" dateFormat="dd.mm.yy" />
                </div>
                <div class="field col-2">
                    <label for="email2">Конец переода</label>
                    <Calendar v-model="dateEnd" locale="ru" dateFormat="dd.mm.yy"/>
                </div>
                <div class="field col-3">
                    <label for="email2">Тип документа</label>
                    <Dropdown v-model="selectedDoc" locale="ru"  :options="docs" optionLabel="name" placeholder="Выбор документа" class="w-full md:w-14rem" />
                </div>
            </div>
        </div>
        <Button class="mt-2" label="Выгрузить отчет" />
    </div>
</template>

<style scoped lang="scss">

</style>
