<template>
        <img src="../../assets/todo.png" width="20%" />
        <div class="form-group forma mb-3">
            <input type="text" class="form-control mb-3" placeholder="Name" v-model="user.name" required>
            <input type="email" class="form-control mb-3" placeholder="Email" v-model="user.email" required>
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="user.password" autocomplete="on" required>
            <input type="password" class="form-control mb-3" placeholder="Password confirmation" v-model="user.password_confirmation" autocomplete="on" required>
        </div>
        <button @click="registerUser()" class="buttonas btn btn-primary btn-block">Register</button>
</template>
<script>
export default {
    name: 'register-page',
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            error: {},
        }
    },
    methods: {
        registerUser(){
            console.log(this.user)
            this.$store.dispatch('userModule/registerUser', this.user)
            this.user = ''
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