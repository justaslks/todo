<template>
    <div class="klase">
        <h1>Your Tasks:</h1>
        <select class="selectas form-select" aria-label="Default select example" @change="sortTasks($event)">
            <option value="" selected>Select sorting</option>
            <option value="task">Sort by name</option>
            <option value="status">Sort by status</option>
            <option value="created_at">Sort by date</option>
        </select>
    </div>
    <div v-for="task in tasks" :key="task.id" >
        <div class="card cardas mt-2" v-if="task.users[0].id == useris.id">
            <div class="card-body" >   
                <b>{{task.task}}</b>
                <p>
                {{task.description}} 
                </p>
                <p class="card-text"> <b>Status:</b> <i>{{task.status}}</i> | <b> Date:</b> <i>{{getHumanDate(task.created_at)}}</i></p>
                <div class="w-30 float-end">
                    <select class="form-select form-select-sm" @change="changeStatus($event, task.id)">
                        <option value="">Change status</option>
                        <option value="in progress">in progress</option>
                        <option value="done">done</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import moment from 'moment'
import { mapGetters, mapState } from 'vuex'
export default{
    name: 'usertasks-page',
    data() {
        return {
            status: '',
            sorter: ''
        }
    },
    computed:{
        ...mapState('userModule', ['tasks']),
        ...mapGetters({useris: 'userModule/getUser'}),
    },
    mounted(){
        this.$store.dispatch('userModule/getMyTasks', {
            sorter: this.sorter
        })
    },
    methods: {
        getHumanDate : function (date) {
            return moment(date, 'YYYY-MM-DD hh:mm').format('DD/MM/YYYY hh:mm');
        },
        changeStatus(event, $id){
            this.$store.dispatch('userModule/changeStatus', {
                id: $id,
                status: event.target.value
            })
            this.$store.dispatch('userModule/getMyTasks')
        },
        sortTasks(event){            
            this.sorter = event.target.value
            console.log(this.sorter)
            this.$store.dispatch('userModule/getMyTasks', {
                sorter: this.sorter
            })
        }
    }
    
}
</script>
<style>
.cardas{
    width: 40%;
}
.klase{
    width: 40%;
    margin: auto;
}
</style>