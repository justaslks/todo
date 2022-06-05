<template>    
    <div class="block"> 
        <select class="selectas form-select mt-2" aria-label="Default select example" @change="sortTasks($event)">
            <option value="" selected>Select sorting</option>
            <option value="1">Sort by name</option>
            <option value="2">Sort by date</option>
        </select>
        <div class="card mt-2" v-for="task in tasks" :key="task.id">
            <div class="card-body">
                <b class="">{{task.id}} - {{task.task}}</b> 
                <button @click="removeTask(task.id)" class="btn btn-sm btn-danger float-end">Delete</button>
                <p class="card-text">{{task.description}}<br/> <b>Status:</b> <i>{{task.status}}</i>, <b>User: </b>
                <i v-for="user in task.users" :key="user.id">{{user.name}}</i>, <b>date: </b>
                <i>{{getHumanDate(task.created_at)}}</i></p>
            </div>
        </div>
    </div>
</template>
<script>
import { mapState }from 'vuex'
import moment from 'moment'

export default {
    name: 'tasks-page',
    data: function() {
        return {
            sorterValue: ''
        }
    },
    methods:{
        removeTask($id){
            this.$store.dispatch('taskModule/deleteTask', {
                id: $id
            })
            this.$store.dispatch('taskModule/loadTasks')
        },
        getHumanDate : function (date) {
            return moment(date, 'YYYY-MM-DD hh:mm').format('DD/MM/YYYY hh:mm');
        },
        sortTasks(event){
            let value = event.target.value
            if(value == 1){
                this.sorterValue = 'task'
            }
            else if(value == 2){
                this.sorterValue = 'created_at'
            }
            else{
                this.sorterValue = ''
            }
            console.log(this.sorterValue)
            this.$store.dispatch('taskModule/loadTasks',{
                sorter: this.sorterValue
            })
        }
    },
    computed: {
        ...mapState('taskModule', ['tasks'])
    },
    mounted() {
        this.$store.dispatch('taskModule/loadTasks')
    },
}
</script>
<style>
.block{
    width: 40%;
    margin: auto;
}
.header{
    margin-left: 20px;
}
.card-header{
    height: 30px
}
.selectas{
    width: 25%;
    margin: right;
}
</style>