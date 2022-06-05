import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home'
import Users from '../views/Users'
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
        path: '/users',
        component: Users
    }
]

const router = new createRouter({
    history: createWebHistory(),
    routes
})

export default router