import { createRouter, createWebHistory } from "vue-router"
import routes from "./routes.js";

const router = createRouter({
    history: createWebHistory(),
    linkActiveClass: 'active',
    routes
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('x-xsrf-token')

    if (!token) {
        if (to.name === 'login' || to.name === 'registration') {
            return next()
        } else {
            return next({
                name: "login"
            })
        }
    }

    if (to.name === 'login' || to.name === 'registration' && token) {
        return next({
            name: 'admin.home'
        })
    }

    next()
})

export default router
