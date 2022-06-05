<template>
    <div>
        <task-upload v-if="isAdmin" />
        <tasks-page />
    </div>
</template>
<script>
import TaskUpload from '@/components/TaskUpload.vue';
import Tasks from '@/components/Tasks.vue';
import { mapGetters } from 'vuex';
export default {
    name: 'home-page',
    components:{
        'task-upload' : TaskUpload,
        'tasks-page' : Tasks
    },
    computed: {
        ...mapGetters({
            isAdmin: 'userModule/getUser'
        })
        
    }
}
</script>