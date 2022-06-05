<template>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">To Do</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <router-link class="nav-link" to="/">Home</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/users">Users</router-link>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            </ul>
        </div>
        <div class="d-flex">
            <router-link class="nav-link" v-if="!isLoggedIn" to="/login">Login</router-link>
            <router-link class="nav-link" v-if="!isLoggedIn" to="/register">Register</router-link>
            <a class="nav-link" href="#">{{currentUser.name}}</a>
            <button type="button" @click="logoutUser()" v-if="isLoggedIn" class="btn buttonas" style="width:80px">Logout</button>
        </div>
        
    </nav>
</template>
<script>
export default {
    name: 'navbar-page',
    computed: {
        currentUser:{
            get(){
                return this.$store.state.userModule.user
            }
        },
        isLoggedIn(){
            return window.localStorage.getItem('app_token')
        }
    },
    methods: {
        logoutUser(){
            if(window.localStorage.getItem('app_token'))
                this.$store.dispatch('userModule/logoutUser')
        }
    },
    created(){
        if(window.localStorage.getItem('app_token'))
            this.$store.dispatch('userModule/getUser')
    }
}
</script>
<style>
.buttonas{
    color: white;
}
.navbar{
    padding: 15px;
    padding-left: 18%;
    margin: auto;
    background-color: #006640;
}
.nav-link{
    padding: 10px;
    color: white;
}
.d-flex{
    padding-right: 10%;
}
</style>