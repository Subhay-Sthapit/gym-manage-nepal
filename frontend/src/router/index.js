import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/dashboard',
        component: () => import('../views/DashboardView.vue')
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})