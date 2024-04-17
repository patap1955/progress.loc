<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLayout } from '@/layout/composables/layout';
import { useRouter } from 'vue-router';
import { useConfirm } from "primevue/useconfirm";
import axios from "axios";
import BalansService from "@/service/BalansService.js";

const { layoutConfig, onMenuToggle } = useLayout();

const confirm = useConfirm();

const outsideClickListener = ref(null);
const topbarMenuActive = ref(false);
const router = useRouter();

const balans = ref(0.00);

const balansService = new BalansService();

onMounted(() => {
    bindOutsideClickListener();
    getBalans();
});

onBeforeUnmount(() => {
    unbindOutsideClickListener();
});

const logoUrl = computed(() => {
    return `layout/images/${layoutConfig.darkTheme.value ? 'logo-white' : 'logo-dark'}.svg`;
});

const getUser = computed(() => {
    return JSON.parse(localStorage.getItem('user'))
});

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};

const logout = () => {
    axios.post('/logout').then(res => {
        localStorage.removeItem('x-xsrf-token')
        localStorage.removeItem('user')
        router.push('/login');
    })
};

const onSettingsClick = () => {
    topbarMenuActive.value = false;
    router.push('/documentation');
};
const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});

const bindOutsideClickListener = () => {
    if (!outsideClickListener.value) {
        outsideClickListener.value = (event) => {
            if (isOutsideClicked(event)) {
                topbarMenuActive.value = false;
            }
        };
        document.addEventListener('click', outsideClickListener.value);
    }
};
const unbindOutsideClickListener = () => {
    if (outsideClickListener.value) {
        document.removeEventListener('click', outsideClickListener);
        outsideClickListener.value = null;
    }
};
const isOutsideClicked = (event) => {
    if (!topbarMenuActive.value) return;

    const sidebarEl = document.querySelector('.layout-topbar-menu');
    const topbarEl = document.querySelector('.layout-topbar-menu-button');

    return !(sidebarEl.isSameNode(event.target) || sidebarEl.contains(event.target) || topbarEl.isSameNode(event.target) || topbarEl.contains(event.target));
};

const requireConfirmation = (event) => {
    topbarMenuActive.value = !topbarMenuActive.value;
    confirm.require({
        target: event.currentTarget,
        group: 'headless',
        message: 'Save your current process?',
        // accept: () => {
        //     toast.add({severity:'info', summary:'Confirmed', detail:'You have accepted', life: 3000});
        // },
        // reject: () => {
        //     toast.add({severity:'error', summary:'Rejected', detail:'You have rejected', life: 3000});
        // }
    });
}

const getBalans = () => {
    balansService.getBalans().then((data) => (balans.value = data));
}

const formatBalance = (val) => {
    // console.log(parseFloat(val));
   return parseFloat(val).toLocaleString('ru');
}

</script>

<template>
    <div class="layout-topbar">
        <router-link to="/" class="layout-topbar-logo">
            <img :src="logoUrl" alt="logo" />
        </router-link>

        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class=""><p>Ваш баланс: <span class="text-green-700">{{ formatBalance(balans.amount) }} руб</span></p></div>

        <div class="layout-topbar-menu" :class="topbarMenuClasses">
<!--            <button @click="onTopBarMenuButton()" class="p-link layout-topbar-button">-->
<!--                <i class="pi pi-calendar"></i>-->
<!--                <span>Calendar</span>-->
<!--            </button>-->

                <ConfirmPopup group="headless">
                    <template #container="{ message, acceptCallback, rejectCallback }">
                        <div class="border-round p-3">
                            <p>{{ getUser.name }}</p>
                            <p>{{ getUser.role.name }}</p>
                            <div class="flex align-items-center gap-2 mt-3">
                                <Button label="Выход" @click="logout" size="small"></Button>
                            </div>
                        </div>
                    </template>
                </ConfirmPopup>
            <button @click="requireConfirmation($event)" class="p-link layout-topbar-button" outlined>
                <i class="pi pi-user"></i>
                <span>Profile</span>
            </button>
<!--            <button @click="onSettingsClick()" class="p-link layout-topbar-button">-->
<!--                <i class="pi pi-cog"></i>-->
<!--                <span>Settings</span>-->
<!--            </button>-->
        </div>
    </div>
</template>

<style lang="scss" scoped>
.layout-topbar .layout-topbar-logo img {
    margin-top: 1rem;
    height: 8.5rem;
    margin-right: .5rem;
}
</style>
