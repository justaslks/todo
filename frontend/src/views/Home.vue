<template>
    <div>
        <h2 v-if="user.isAdmin">All tasks</h2>
        <front-page v-if="!isLoggedIn&&!user.isAdmin"/>
        <tasks-page v-if="user.isAdmin" message />
        <usertasks-page v-if="isLoggedIn&&!user.isAdmin"/>
    </div>
</template>
<script>
import Tasks from '@/components/Tasks.vue';
import UserTasks from '@/components/UserTasks.vue';
import FrontPage from '@/components/FrontPage.vue';
import { mapGetters } from 'vuex';

export default {
    name: 'home-page',
    components:{
    "tasks-page": Tasks,
    "usertasks-page": UserTasks,
    "front-page": FrontPage,
},
    computed: {
        ...mapGetters({
            user: 'userModule/getUser'
        }),
        isLoggedIn(){
            return window.localStorage.getItem('app_token')
        }
        
    }
}
</script>