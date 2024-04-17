import Login from "@/components/pages/Login.vue";
import Index from "@/components/pages/admin/Index.vue";
import Home from "@/components/pages/Home.vue";
import Registration from "@/components/pages/admin/Registration.vue";
import ReestrIndex from "@/components/pages/reestr/ReestrIndex.vue";
import ReesrtAdd from "@/components/pages/reestr/ReesrtAdd.vue";
import SearchByIp from "@/components/pages/search/SearchByIp.vue";
import SearchById from "@/components/pages/search/SearchById.vue";
import SearchByInn from "@/components/pages/search/SearchByInn.vue";
import SearchByFl from "@/components/pages/search/SearchByFl.vue";
import SearchByUl from "@/components/pages/search/SearchByUl.vue";
import ImportReestr from "@/components/pages/reestr/ImportReestr.vue";



const routes = [

    {
        path: '/',
        name: 'index',
        component: Home,
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
    },

    {
        path: '/registration',
        name: 'registration',
        component: Registration,
    },

    {
        path: '/admin',
        name: 'admin.home',
        component: Index,
    },

    {
        path: '/admin/reestr',
        name: 'admin.reestr',
        component: ReestrIndex,
    },

    {
        path: '/admin/reestr-add',
        name: 'admin.reestr.add',
        component: ReesrtAdd,
    },

    {
        path: '/admin/reestr-import',
        name: 'admin.reestr.import',
        component: ImportReestr,
    },

    {
        path: '/admin/search-ip',
        name: 'admin.search.ip',
        component: SearchByIp,
    },

    {
        path: '/admin/search-id',
        name: 'admin.search.id',
        component: SearchById,
    },

    {
        path: '/admin/search-inn',
        name: 'admin.search.inn',
        component: SearchByInn,
    },

    {
        path: '/admin/search-fl',
        name: 'admin.search.fl',
        component: SearchByFl,
    },

    {
        path: '/admin/search-ul',
        name: 'admin.search.ul',
        component: SearchByUl,
    },
     // {
     //     path: '/:CatchAll(.*)',
     //     name: '404',
     //     component: <h1 class="title">404 Not Found</h1>
     // }
 ]

export default routes
