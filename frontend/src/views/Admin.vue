<template> 
    <h2>Admin dashboard</h2>
    <div class="border w-25 m-auto border-primary">
        <button class="btn" v-on:click="isHidden=!isHidden">Users</button>
        <button class="btn" v-on:click="isHidden1=!isHidden1">tasks</button>
    </div>
    <div v-if="isHidden == true && isHidden1 == true" class="up"></div>
    <div v-if="!isHidden">
        <div class="form-group forma3 mb-3">
            User creation
            <input type="text" class="form-control mb-3" placeholder="Name" v-model="user.name" required>
            <input type="email" class="form-control mb-3" placeholder="Email" v-model="user.email" required>
            <input :type="checked ? 'text' : 'password'" class="form-control" placeholder="Password" v-model="user.password" autocomplete="on" required> 
            <div class="d-flex mb-2">
                <input type="checkbox" v-model="checked" class="form-check-input" name="Show pasword" id="">Show password
            </div>
            <input type="password" class="form-control mb-3" placeholder="Password confirmation" v-model="user.password_confirmation" autocomplete="on" required>
            <div v-if="errors" class="bg-danger rounded">
                <p>{{errors}}</p>
            </div>
        </div>
            
        <button @click="addUser()" class="buttonas btn btn-primary btn-block">Create a new user</button>
        <users-page/>
    </div>
    <div v-if="!isHidden1">
        <task-upload />
        <tasks-page />
    </div>
    
</template>
<script>
import { mapState, mapGetters } from 'vuex'
import TaskUpload from '@/components/TaskUpload.vue'
import Tasks from '@/components/Tasks.vue'
import Users from '../components/Users'
import useVuelidate from '@vuelidate/core'
import { required, minLength, sameAs } from '@vuelidate/validators'
export default {
    name: 'admin-page',
    components: {
        'users-page' : Users,
        'task-upload': TaskUpload,
        'tasks-page': Tasks,
    },
    data() {
        return {
            v$: useVuelidate(),
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            checked: false,
            isHidden: true,
            isHidden1: true
        }
    },
    validations() {
         return {
            user: {
                name: { required },
                email: { required },
                password: { required, minLength: minLength(6) },
                password_confirmation: { required, sameAs : sameAs(this.user.password) }
            },
        }
    },
    methods: {
        addUser(){
            this.v$.$validate()
            if(!this.v$.$error){
                this.$store.dispatch('adminModule/addUser', this.user)
                this.user.name = ''
                this.user.email = ''
                this.user.password = ''
                this.user.password_confirmation = ''
                this.$store.dispatch('userModule/getAllUsers')
            }
            else{
                alert('Something went wrong. Check all the fields.')
            }
        }
    },
    computed: {
        ...mapState('userModule', ['users']),
        ...mapGetters({errors: 'adminModule/errorsAdd'}),
    }
}
</script>
<style>
.users{
    padding-top: 200px;
}
.up{
    padding-top: 33%;
}
</style>