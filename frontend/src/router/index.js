import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home'
import Admin from '../views/Admin'
import Login from '../components/auth/Login'
import Register from '../components/auth/Register'

const routes = [
    {
        path: '/',
        component: Home   
    },
    {
        path: '/register',
        component: Register
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/admin',
        component: Admin
    }
]

const router = new createRouter({
    history: createWebHistory(),
    routes
})

export default router