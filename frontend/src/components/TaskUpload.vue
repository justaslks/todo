<template>
    <div class="forma mb-3">
        <input type="text" class="form-control mb-2" placeholder="Todo task" v-model="task.title" required>
        <textarea class="form-control mb-2" rows="2" v-model="task.description" placeholder="Description"></textarea>
        <select class="form-select mb-2" aria-label="Default select example" v-model="task.user">
            <option value="">Select a user</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{user.name}}</option>
        </select>
    </div>
    <button @click="createTask()" class="buttonas btn btn-primary btn-block">Login</button>
</template>
<script>
import { mapState } from 'vuex';

export default {
    name: 'upload-page',
    data() {
        return {
            task: {
                title: '',
                description: '',
                user: ''
            }
        }
    },  
    methods: {
        createTask(){
            if(!this.task.user){
                return console.log('No selected user')
            }
            this.$store.dispatch('taskModule/createTask', this.task)
            console.log(this.task)
            this.task.title = '',
            this.task.description ='',
            this.task.user = ''
            this.$store.dispatch('taskModule/loadTasks')
        },
        
    },
    computed: {
        ...mapState('userModule', ['users'])
    },  
    mounted() {
        this.$store.dispatch('userModule/getAllUsers')
    }
}
</script>
<style>
.forma{
    padding-top: 20px;
}
</style>