<template>
    <h2 class="mt-3">All users</h2>
    <div class="card cardas mt-2" v-for="user in users" :key="user.id">
        <div class="card-body">
            <p class="d-flex"><b>Name:</b>&nbsp;<i>{{user.name}}</i></p>
            <button class="btn btn-sm btn-danger float-end m-1" @click="removeUser(user.id)">Delete</button>
            <button class="btn btn-sm btn-danger float-end m-1" @click="editUserId(user.id)" v-on:click="isHidden = !isHidden">Edit</button>
            <p class="d-flex"><b>Email:</b>&nbsp;<i>{{user.email}}</i></p>
            <p class="d-flex"><b>Role:</b>&nbsp;<i>{{getRole(user.isAdmin)}}</i></p>
        </div>
        <div v-if="!isHidden && user.id == divid">
            <label for="">Name</label>
            <input type="text" class="form-control adminas mb-3" placeholder="Name" v-model="eUser.name" required>
            <label for="">Email</label>
            <input type="email" class="form-control adminas mb-3" placeholder="Email" v-model="eUser.email" required>
            <select class="adminas form-select mt-2" v-model="eUser.role">
                <option value="">Change user's role</option>
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
            <div v-if="errors" class="bg-danger eile rounded">
                <p>{{errors}}</p>
            </div>
            <button class="btn btn-sm btn-danger mb-2" @click="editUser(user.id)">Edit user</button>
        </div>
    </div>
    <div class="mb-3"></div>
 </template>
<script>
import { mapState, mapGetters } from 'vuex'

export default {
    name: 'users-page',
    computed:{
        ...mapState('userModule', ['users']),
        ...mapGetters({errors: 'adminModule/errorsEdit'}),
    },
    data: function () {
        return {
            user: {
                name: '',
                email: '',
                role: ''
            },
            eUser: {
                name: '',
                email: '',
                role: ''
            },
            isHidden: true,
            divid: ''
        };
    },
    mounted() {
        this.$store.dispatch('userModule/getAllUsers')
    },
    methods: {
        getRole: function ($role) {
            return $role ? 'Admin' : 'User'
        },
        removeUser($id){
            this.$store.dispatch('adminModule/deleteUser', {
                id: $id
            })
            this.$store.dispatch('userModule/getAllUsers')
        },
        editUser($id){
            if(this.eUser.name == '' && this.eUser.email == '' && this.eUser.role == ''){
                console.log(this.eUser)
                return;
            }
            console.log(this.eUser)
            this.$store.dispatch('adminModule/editUser', {
                id: $id,
                name: this.eUser.name,
                email: this.eUser.email,
                role: this.eUser.role
            })
            this.$store.dispatch('userModule/getAllUsers')
            this.eUser.name = ''
            this.eUser.email = ''
            this.eUser.role = ''
        },
        editUserId($id){
            this.divid = $id
        }
    }
}
</script>
<style>
.cardas{
    margin-top: 0;
    margin-bottom: 0;
    width: 40%;
    margin: auto
}
.adminas{
    width: 80%;
    margin: auto;
}
.eile{
    width: 80%;
    margin: auto;
}
</style>