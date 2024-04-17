<script>
import SendersService from "@/service/SendersService.js";

const senderService = new SendersService();
export default {
    name: "SenderIndex",
    data() {
        return {
            messages: [],
            selectedMessage: null,
            expandedRows: null,
        }
    },

    created() {
        senderService.getSenderMessages(this.$route.params.id).then((data) => (this.messages = data));
    },
    watch: {
        $route: 'getSenderMessages'
    },

    methods: {
        getSenderMessages() {
            senderService.getSenderMessages(this.$route.params.id).then((data) => (this.messages = data));
        }
    }
}
</script>

<template>
    <Toast />
    <div className="card ">
        <div class="reestr">
            <div class="reestr__header">
                <h2>Сообщения от {{ messages.title }}</h2>

            </div>
            <div class="reestr__table mt-7">

                <Panel header="Список сообщений" :toggleable="true">
                    <DataTable
                        v-model:selection="selectedMessage"
                        v-model:expandedRows="expandedRows"
                        :value="messages.messages"
                        dataKey="id"
                        tableStyle="min-width: 50rem"
                        paginator :rows="2"
                    >
                        <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                        <Column expander style="width: 5rem" />
                        <Column field="title" header="Заголовок сообщения">
                            <template #body="{ data }">
                                <div class="d-flex justify-items-center">
                                    <router-link :to="'/sender/' + messages.id + '/message/' + data.id">
                                        <i class="text-green-600 pi pi-inbox mr-2"></i>
                                        <span class="text-green-500 text-xl">{{ data.title }}</span>
                                    </router-link>
                                </div>
                            </template>
                        </Column>
                        <template #expansion="slotProps">
                            <div class="p-3">
                                <h5>{{ slotProps.data.title }}</h5>
                                <div v-if="slotProps.data.subject !== null" v-html=" slotProps.data.subject.split('\\').join('')">
                                </div>
                            </div>
                        </template>
                    </DataTable>
                </Panel>

            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
br {
    margin-bottom:10px;
}

.mini-bottom br {
    margin-bottom:10px;
}
</style>
