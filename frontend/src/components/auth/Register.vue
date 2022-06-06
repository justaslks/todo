<template>
    <div class="page1">
        <div class="form-group forma1 mb-3">
            <h1 class="mb-3">Register</h1>
            <input type="text" class="form-control mb-3" placeholder="Name" v-model="user.name" required>
            <input type="email" class="form-control mb-3" placeholder="Email" v-model="user.email" required>
            <input type="password" class="form-control mb-3" placeholder="Password" v-model="user.password" autocomplete="on" required>
            <input type="password" class="form-control mb-3" placeholder="Password confirmation" v-model="user.password_confirmation" autocomplete="on" required>
            <div v-if="errors.length" class="bg-danger rounded">
                <ul>
                    <p v-for="error in errors" :key="error">{{error}}</p>
                </ul>
            </div>
            <div v-if="errorsRegister" class="bg-danger rounded">
                <p>{{errorsRegister}}</p>
            </div>
        </div>

        <button @click="registerUser()" class="buttonas btn btn-primary btn-block">Register</button>
    </div>
</template>
<script>
import useVuelidate from '@vuelidate/core'
import { mapGetters } from 'vuex'
import { minLength, required, sameAs } from '@vuelidate/validators'
export default {
    name: 'register-page',
    data() {
        return {
            v$: useVuelidate(),
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            errors: {}
        }
    },
    validations(){
        return {
            user: {
                password: { required, minLength: minLength(6)},
                password_confirmation: { required, sameAs: sameAs(this.user.password) }
            }
        }
    },
    computed:{
        ...mapGetters({errorsRegister: 'userModule/errorsRegister'}),
    },
    methods: {
        registerUser(){
            this.errors = []
            this.v$.$validate()

            if(!this.user.email ||  !this.user.password || !this.user.password || !this.user.password_confirmation){
               this.errors.push('Some fields are not filled.')
            }
            else if(!this.v$.$error){
                console.log(this.user)
                this.$store.dispatch('userModule/registerUser', this.user)
                this.user.name = ''
                this.user.email = ''
                this.user.password = ''
                this.user.password_confirmation = ''
            } else{
                alert('Something went wrong. Check all the fields.')
            }
        }
    }
}
</script>
<style>

.forma1{
    padding-top: 100px;
    margin: auto;
    width: 20%;
}
.page1{
    margin-bottom: 13%;
}
.buttonas{
    padding-top: 5px;
    width: 20%;
}
</style>