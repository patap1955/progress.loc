<script setup>
import {onBeforeMount, ref} from 'vue';
import SendersService from "@/service/SendersService.js";
import { useToast } from 'primevue/usetoast';


import AppMenuItem from './AppMenuItem.vue';
import axios from "axios";
const senders = ref([]);

const senderServices = new SendersService();

onBeforeMount(() => {
    senderServices.getServices().then((data) => (senders.value = getSenders(data)));
    // getSenders(senders.value);
});
const toast = useToast();


const getSenders = (senders) => {
    const array = [];
    senders.forEach((el) => {
        const newObject = {label: el.title, icon: 'pi pi-fw pi-bookmark', to: '/senders/' + el.id};
        array.push(newObject)
    })
    return array;
    // console.log(senders);
};

const getMail = () => {
    axios.post('/api/get-mail')
        .then(res => {
            if (res.data.type === 2) {
                window.open(res.data.url);
            } else  {
                toast.add({
                    severity: 'warn',
                    summary: 'Предупреждение',
                    detail: res.data.message,
                    life: 10000
                })
            }
        })
        .catch(err => {
            console.log(err)
        })
}


const model = ref([
    {
        label: 'ФССП',
        items: [
            {
                label: 'Реестр ИП',
                icon: 'pi pi-fw pi-bookmark',
                to: '/'
                // items: [
                //     {
                //         label: 'Реестр',
                //         icon: 'pi pi-fw pi-bookmark',
                //         to: '/reestr'
                //     },
                //     {
                //         label: 'Новая запись',
                //         icon: 'pi pi-fw pi-bookmark',
                //         to: '/reestr-add'
                //     },
                //     // {
                //     //     label: 'Submenu 1.2',
                //     //     icon: 'pi pi-fw pi-bookmark',
                //     //     // items: [{ label: 'Submenu 1.2.1', icon: 'pi pi-fw pi-bookmark' }]
                //     // }
                // ]
            },
            {
                label: 'Новая запись',
                icon: 'pi pi-fw pi-bookmark',
                to: '/reestr-add',
            },
            {
                label: 'База ФССП',
                icon: 'pi pi-fw pi-bookmark',
                items: [
                    {
                        label: 'Поиск по номеру ИП',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/search-ip'
                    },
                    {
                        label: 'Поиск по номеру ИД',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/search-id'
                    },
                    {
                        label: 'Поиск по ИНН',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/search-inn'
                    },
                    {
                        label: 'Поиск по данным ФЛ',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/search-fl'
                    },
                    {
                        label: 'Поиск по данным ЮЛ',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/search-ul'
                    },
                ]
            },
        ]
    },
    {
        label: 'Госпочта',
        items: [
            {
                label: 'Отправители',
                icon: 'pi pi-fw pi-bookmark',
                items: senders,
            },
            {
                label: 'Выгрузка отчетов',
                icon: 'pi pi-fw pi-bookmark',
                items: [
                    {
                        label: 'За период времени',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/download-report-time'
                    },
                    {
                        label: 'По типу документа',
                        icon: 'pi pi-fw pi-bookmark',
                        to: '/download-report-doc'
                    },
                ],
            },
        ],
    },
    {
        label: 'Получить почту',
        icon: 'pi pi-fw pi-bookmark',
        separator: true,
    },
    {
        label: 'Пользователи',
        items: [

        ],
    },
]);
</script>

<template>
    <Toast />
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item v-if="!item.separator" :item="item" :index="i"></app-menu-item>
            <li v-if="item.separator" class="menu-separator">
                <div class="layout-menuitem-root-text">
                    <i :class="item.icon" class="layout-menuitem-icon"></i>
                    <span @click="getMail">{{ item.label }}</span>
                </div>
<!--                <i :class="item.icon" class="layout-menuitem-icon"></i>-->
<!--                <span @click="getMail">{{ item.label }}</span>-->
            </li>
        </template>
    </ul>
</template>

<style lang="scss" scoped>

  .menu-separator {
      padding: 0.75rem 1rem;
  }
  .menu-separator i {
      margin-right: 0.5rem;
  }
  .menu-separator span {
      cursor: pointer;
      //margin-left: 1rem;
  }
</style>
