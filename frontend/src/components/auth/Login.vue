<template>
        <img src="../../assets/todo.png" width="20%" alt="" />
        <div class="forma mb-3">
            <input type="email" class="form-control mb-3" placeholder="Email" v-model="user.email" required>
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="user.password" autocomplete="on" required>
        </div>
        <button @click="loginUser()" class="buttonas btn btn-primary btn-block">Login</button>
</template>
<script>
export default {
    name: 'login-page',
    data() {
        return {
            user: {
                email: "",
                password: ""
            }
        }
    },
    methods: {
        loginUser(){
            console.log(this.user)
            this.$store.dispatch('userModule/loginUser', this.user)
        }
    }
}
</script>
<style>
img{
    padding-top: 2%;
    padding-bottom: 2%;
}
.forma{
    margin: auto;
    width: 20%;
}
.buttonas{
    padding-top: 5px;
    width: 20%;
}
</style>