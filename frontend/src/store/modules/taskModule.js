import axios from 'axios'

const state = {
    task: {},
    tasks: [],
    sorter: {}
}
const getters = {}
const actions = {
    createTask(_, task){
        axios.post(process.env.VUE_APP_URL + 'task', {
            task: task.title,
            description: task.description,
            user: task.user
        })
        .then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        })
    },
    loadTasks({commit}, task){
        axios.get(process.env.VUE_APP_URL + 'assignments', {
            params: {
                sorter: task ? task.sorter : ''
            }
        })
        .then(response => {
            commit('SET_TASKS', response.data)
        })
        .catch(error => {
            console.log(error)
        })
    },
    deleteTask(_, task){
        axios.delete(process.env.VUE_APP_URL + 'task/' + task.id)
            .then(response => {
                console.log(response);
            })
            .catch(error => {
                console.log(error);
            })
    }
}
const mutations = {
    SET_TASKS(state, data){
        state.tasks = data
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions, 
    mutations
}