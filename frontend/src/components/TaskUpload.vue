<template>
    <div class="forma3 mb-3">
        <input type="text" class="form-control mb-2" placeholder="Todo task" v-model="task.title" required>
        <textarea class="form-control mb-2" rows="2" v-model="task.description" placeholder="Description"></textarea>
        <select class="form-select mb-2" aria-label="Default select example" v-model="task.user">
            <option value="">Select a user</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
        </select>
    </div>
    <button @click="createTask()" class="buttonas btn btn-primary btn-block">Create new task</button>
</template>
<script>
import { mapState } from 'vuex';
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'
export default {
    name: 'upload-page',

    data() {
        return {
            v$: useVuelidate(),
            task: {
                title: '',
                description: '',
                user: ''
            }
        }
    },  
    validations() {
        return {
            task: {
                title: { required },
                user: { required }
            }
        }
    },
    methods: {
        createTask(){
            this.v$.$validate()
            if(!this.v$.$error){
                this.$store.dispatch('taskModule/createTask', this.task)
                console.log(this.task)
                this.task.title = '',
                this.task.description ='',
                this.task.user = ''
                this.$store.dispatch('taskModule/loadTasks')
                alert('Task successfully created.')
            } else{
                alert('Something went wrong. Check all the fields.')
            }
        },
        
    },
    computed: {
        ...mapState('userModule', ['users']),
    },  
    mounted() {
        this.$store.dispatch('userModule/getAllUsers')
    }
}
</script>
<style>
.forma3{
    width: 20%;
    margin: auto;
    padding-top: 20px;
}
</style>