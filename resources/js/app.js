import { createApp } from "vue";
import loader from "vue3-ui-preloader";
// import "bootstrap/dist/css/bootstrap.min.css";
// import "bootstrap/dist/js/bootstrap.bundle.js";
import "vue3-ui-preloader/dist/loader.css"
// import "bootstrap/dist/js/bootstrap.bundle.js"
import '@/assets/scss/_index.scss';
import App from "@/components/App.vue";
import Router from "@/router/router.js";
import { store } from "@/store/index.js"
import { reestr } from "@/store/reestr.js";
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css'

// console.log(Router)

const app = createApp(App);

app.component('loader', loader)
app.use(Router);
app.use(store);
app.use(reestr);
app.use(PrimeVue, { unstyled: true, ripple: true });

app.mount("#app");
