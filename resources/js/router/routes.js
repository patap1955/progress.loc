import AppLayout from "@/layout/AppLayout.vue";
import ReesrtAdd from "@/views/pages/reestr/ReesrtAdd.vue";
import SearchIp from "@/views/pages/baseFssp/SearchIp.vue";
import SearchId from "@/views/pages/baseFssp/SearchId.vue";
import SearchInn from "@/views/pages/baseFssp/SearchInn.vue";
import SearchFl from "@/views/pages/baseFssp/SearchFl.vue";
import SearchUl from "@/views/pages/baseFssp/SearchUl.vue";
import ReestrIndex from "@/views/pages/reestr/ReestrIndex.vue";
import SenderIndex from "@/views/pages/gospochta/SenderIndex.vue";
import Message from "@/views/pages/gospochta/Message.vue";
import DownloadReportTime from "@/views/pages/gospochta/report/DownloadReportTime.vue";
import DownloadReportDoc from "@/views/pages/gospochta/report/DownloadReportDoc.vue";
import GetMail from "@/views/pages/gospochta/GetMail.vue";
import UserIndex from "@/views/pages/users/UserIndex.vue";
import UserEdit from "@/views/pages/users/UserEdit.vue"
import UserAdd from "@/views/pages/users/UserAdd.vue";
import RolesIndex from "@/views/pages/roles/RolesIndex.vue";
import PermissionsIndex from "@/views/pages/permissions/PermissionsIndex.vue";
import RoleEdit from "@/views/pages/roles/RoleEdit.vue";
import RoleAdd from "@/views/pages/roles/RoleAdd.vue";


const routes = [
    {
        path: '/',
        component: AppLayout,
        children: [
            {
                path: '/',
                name: 'reestr',
                component: ReestrIndex,
            },
            {
                path: '/reestr-add',
                name: 'reestr-add',
                component: ReesrtAdd,
            },
            {
                path: '/search-ip',
                name: 'search-ip',
                component: SearchIp,
            },
            {
                path: '/search-id',
                name: 'search-id',
                component: SearchId,
            },
            {
                path: '/search-inn',
                name: 'search-inn',
                component: SearchInn,
            },
            {
                path: '/search-fl',
                name: 'search-fl',
                component: SearchFl,
            },
            {
                path: '/search-ul',
                name: 'search-ul',
                component: SearchUl,
            },
            {
                path: '/senders/:id',
                name: 'sender',
                component: SenderIndex,
            },
            {
                path: '/sender/:sender/message/:message',
                name: 'sender.message',
                component: Message,
            },

            {
                path: '/download-report-time',
                name: 'download-report-time',
                component: DownloadReportTime,
            },
            {
                path: '/download-report-doc',
                name: 'download-report-doc',
                component: DownloadReportDoc,
            },
            {
                path: '/get-mail',
                name: 'get-mail',
                component: GetMail,
            },
            {
                path: '/users',
                name: 'users',
                component: UserIndex
            },
            {
                path: '/users/edit/:id',
                name: 'users-edit',
                component: UserEdit
            },
            {
                path: '/users/add',
                name: 'users-add',
                component: UserAdd
            },
            {
                path: "/settings/roles",
                name: 'roles',
                component: RolesIndex
            },
            {
                path: "/settings/role/edit/:id",
                name: 'role-edit',
                component: RoleEdit
            },
            {
                path: "/settings/role/add",
                name: 'role-add',
                component: RoleAdd
            },
            {
                path: "/settings/permissions",
                name: 'permissions',
                component: PermissionsIndex
            },






            {
                path: '/uikit/formlayout',
                name: 'formlayout',
                component: () => import('@/views/uikit/FormLayout.vue')
            },
            {
                path: '/uikit/input',
                name: 'input',
                component: () => import('@/views/uikit/Input.vue')
            },
            {
                path: '/uikit/floatlabel',
                name: 'floatlabel',
                component: () => import('@/views/uikit/FloatLabel.vue')
            },
            {
                path: '/uikit/invalidstate',
                name: 'invalidstate',
                component: () => import('@/views/uikit/InvalidState.vue')
            },
            {
                path: '/uikit/button',
                name: 'button',
                component: () => import('@/views/uikit/Button.vue')
            },
            {
                path: '/uikit/table',
                name: 'table',
                component: () => import('@/views/uikit/Table.vue')
            },
            {
                path: '/uikit/list',
                name: 'list',
                component: () => import('@/views/uikit/List.vue')
            },
            {
                path: '/uikit/tree',
                name: 'tree',
                component: () => import('@/views/uikit/Tree.vue')
            },
            {
                path: '/uikit/panel',
                name: 'panel',
                component: () => import('@/views/uikit/Panels.vue')
            },

            {
                path: '/uikit/overlay',
                name: 'overlay',
                component: () => import('@/views/uikit/Overlay.vue')
            },
            {
                path: '/uikit/media',
                name: 'media',
                component: () => import('@/views/uikit/Media.vue')
            },
            {
                path: '/uikit/menu',
                component: () => import('@/views/uikit/Menu.vue'),
                children: [
                    {
                        path: '/uikit/menu',
                        component: () => import('@/views/uikit/menu/PersonalDemo.vue')
                    },
                    {
                        path: '/uikit/menu/seat',
                        component: () => import('@/views/uikit/menu/SeatDemo.vue')
                    },
                    {
                        path: '/uikit/menu/payment',
                        component: () => import('@/views/uikit/menu/PaymentDemo.vue')
                    },
                    {
                        path: '/uikit/menu/confirmation',
                        component: () => import('@/views/uikit/menu/ConfirmationDemo.vue')
                    }
                ]
            },
            {
                path: '/uikit/message',
                name: 'message',
                component: () => import('@/views/uikit/Messages.vue')
            },
            {
                path: '/uikit/file',
                name: 'file',
                component: () => import('@/views/uikit/File.vue')
            },
            {
                path: '/uikit/charts',
                name: 'charts',
                component: () => import('@/views/uikit/Chart.vue')
            },
            {
                path: '/uikit/misc',
                name: 'misc',
                component: () => import('@/views/uikit/Misc.vue')
            },
            {
                path: '/blocks',
                name: 'blocks',
                component: () => import('@/views/utilities/Blocks.vue')
            },
            {
                path: '/utilities/icons',
                name: 'icons',
                component: () => import('@/views/utilities/Icons.vue')
            },
            {
                path: '/pages/timeline',
                name: 'timeline',
                component: () => import('@/views/pages/Timeline.vue')
            },
            {
                path: '/pages/empty',
                name: 'empty',
                component: () => import('@/views/pages/Empty.vue')
            },
            {
                path: '/pages/crud',
                name: 'crud',
                component: () => import('@/views/pages/Crud.vue')
            },
            {
                path: '/documentation',
                name: 'documentation',
                component: () => import('@/views/utilities/Documentation.vue')
            }
        ]
    },
    {
        path: '/landing',
        name: 'landing',
        component: () => import('@/views/pages/Landing.vue')
    },
    {
        path: '/pages/notfound',
        name: 'notfound',
        component: () => import('@/views/pages/NotFound.vue')
    },

    {
        path: '/auth/login',
        name: 'login',
        component: () => import('@/views/pages/auth/Login.vue')
    },
    {
        path: '/auth/access',
        name: 'accessDenied',
        component: () => import('@/views/pages/auth/Access.vue')
    },
    {
        path: '/auth/error',
        name: 'error',
        component: () => import('@/views/pages/auth/Error.vue')
    }
]

export default routes
