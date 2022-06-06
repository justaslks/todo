import axios from 'axios'

const state = {
    user: {},
    task: {},
}
const getters = {
    errorsAdd(state){
        return state.errors
    },
    errorsEdit(state){
        return state.errorsEdit
    } 
}
const actions = {
    addUser({commit}, user){
        axios.post(process.env.VUE_APP_URL + 'adduser', {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation
        })
        .then(response => {
            console.log(response)
            commit('UNSET_ERRORS')
        })
        .catch(error => {
            console.log(error.response.data.errors)
            commit('SET_ERRORS', error.response.data.errors)
        })
    },
    deleteUser(_, task){
        axios.delete(process.env.VUE_APP_URL + 'user/' + task.id)
            .then(response => {
                console.log(response)
            })
            .catch(error => {
                console.log(error)
            })
    },
    editUser({commit}, user){
        axios.put(process.env.VUE_APP_URL + 'user/' + user.id, {
            name: user.name,
            email: user.email,
            isAdmin: user.role
        })
        .then(response => {
            console.log(response)
            commit('UNSET_ERRORS')
        })
        .catch(error => {
            console.log(error)
            commit('SET_ERRORS_EDIT', error.response.data.errors)
        })
    }
}
const mutations = {
    SET_ERRORS(state, data){
        state.errors = data
    },
    SET_ERRORS_EDIT(state, data){
        state.errorsEdit = data
    },
    UNSET_ERRORS(state){
        state.errorsEdit = ''
        state.errors = ''
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions, 
    mutations
}