<template>
    <div class="page">
        <div class="forma mb-3"> 
            <h1 class="mb-3">Login</h1>
            <input type="email" class="form-control mb-3" placeholder="Email" v-model="user.email" required>
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="user.password" autocomplete="on" required>        
            <div v-if="errors.length" class="bg-danger rounded">
                <ul>
                    <p v-for="error in errors" :key="error">{{error}}</p>
                </ul>
            </div>
            <div v-if="errorsLogin" class="bg-danger rounded">
                <p>{{errorsLogin}}</p>
            </div>
        </div>

        <button @click="loginUser()" type="submit" class="buttonas btn btn-primary btn-block">Login</button>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    name: 'login-page',
    data() {
        return {
            user: {
                email: "",
                password: ""
            },
            errors: []
        }
    },
    computed:{
        ...mapGetters({errorsLogin: 'userModule/errorsLogin'}),
    },
    methods: {
        loginUser(){
            this.errors = []
            if(!this.user.email || !this.user.password){
                this.errors.push('Bad credentials')
            }
            else{
                console.log(this.user)
                this.$store.dispatch('userModule/loginUser', this.user)
            }
        }
    }
}
</script>
<style>

.forma{
    padding-top: 150px;
    margin-bottom: 200px;
    margin: auto;
    width: 20%;
}
.page{
    padding-bottom: 16%;
}
.buttonas{
    padding-top: 5px;
    width: 20%;
}
</style>