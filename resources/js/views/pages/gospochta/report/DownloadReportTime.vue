<script>
import DownloadReportService from "@/service/DownloadReportService.js";

const downloadReportService = new  DownloadReportService();
export default {
    name: "DownloadReportTime",
    data() {
        return {
            dateStart: null,
            dateEnd: null,
        }
    },
    methods: {
        downloadReport() {
            const data = {
                dataStart: this.dateStart,
                dataEnd: this.dateEnd
            }

            if (this.dateStart !== null && this.dateEnd !== null) {
                downloadReportService.downloadReportTime(data);
            } else {
                this.$toast.add({
                    severity: 'warn',
                    summary: 'Предупреждение',
                    detail: 'Заполните все поля',
                    life: 5000
                });
            }

        }
    }
}
</script>

<template>
    <Toast />
    <div class="card">
        <h2>Выгрузка данных за период времени</h2>
        <div class="p-fluid">
            <div class="formgrid grid">
                <div class="field col-3">
                    <label for="name2">Начало переода</label>
                    <Calendar v-model="dateStart" locale="ru"  dateFormat="dd.mm.yy" />
                </div>
                <div class="field col-3">
                    <label for="email2">Конец переода</label>
                    <Calendar v-model="dateEnd" locale="ru"  dateFormat="dd.mm.yy" />
                </div>
            </div>
        </div>
        <Button class="mt-2" label="Выгрузить отчет" @click="downloadReport"/>
    </div>
</template>

<style scoped lang="scss">

</style>
