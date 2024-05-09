import { createRouter, createWebHistory } from 'vue-router'
import AuthLayout from '@/layouts/auth.vue'
import DefaultLayout from '@/layouts/default.vue'

import AuthMiddleware from '@/middleware/auth.js'
import LoginMiddleware from '@/middleware/login.js'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/login',
            name: 'login',
            meta: {
                layout: AuthLayout,
                middleware: [LoginMiddleware]
            },
            component: () => import('../pages/LoginView.vue')
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            meta: {
                layout: DefaultLayout,
                middleware: [AuthMiddleware]
            },
            component: () => import('../pages/Dashboard.vue')
        },
        {
            path: '/users/group',
            name: 'users.group',
            meta: {
                layout: DefaultLayout,
                middleware: [AuthMiddleware]
            },
            component: () => import('../pages/User/UsersGroup.vue')
        },
        {
            path: '/users/:action(create|group/create)',
            name: 'users.create',
            meta: {
                layout: DefaultLayout,
                middleware: [AuthMiddleware]
            },
            component: () => import('../pages/User/UsersCreate.vue')
        },
        {
            path: '/users/update',
            name: 'users.update',
            meta: {
                layout: DefaultLayout,
                middleware: [AuthMiddleware]
            },
            component: () => import('../pages/User/UsersUpdate.vue')
        },
        {
            path: '/users',
            name: 'users',
            meta: {
                layout: DefaultLayout,
                middleware: [AuthMiddleware]
            },
            component: () => import('../pages/User/Users.vue')
        },
    ],
    linkActiveClass: 'active',
    linkExactActiveClass: 'exact-active-class'
})

router.beforeEach((to, from, next) => {
    if(to.meta.middleware) {
        const middleware = to.meta.middleware
        middleware.forEach(m => m(to, from, next))
    } else {
        next()
    }
})
export default router
