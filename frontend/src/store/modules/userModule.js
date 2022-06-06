import axios from 'axios'

const state = {
    user: {},
    users: [],
    tasks: [],
    sorter: {}
}
const getters = {
    getUser(state){
        return state.user
    },
    errorsLogin(state){
        return state.errorsLogin
    },
    errorsRegister(state){
        return state.errorsRegister
    },
}
const actions = {
    registerUser({commit}, user){
        axios.post(process.env.VUE_APP_URL + 'register', {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation
        })
        .then(response => {
            commit('UNSET_ERRORS')
            console.log(response)
            window.location.replace('/login')
        })
        .catch(error => {
            commit('SET_ERRORS_REGISTER', error.response.data.errors)
            console.log(error)
        })
    },
    loginUser({commit}, user){
        axios.post(process.env.VUE_APP_URL + 'login', {
            email: user.email,
            password: user.password
        })
        .then( response => {
            commit('UNSET_ERRORS')
            if(response.data.token){
                //save token to localstorage
                localStorage.setItem(
                   "app_token",
                    response.data.token
                )
                axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('app_token');
                window.location.replace('/')
            }
        })
        .catch(error => {
            commit('SET_ERRORS_LOGIN', error.response.data)
            console.log(error)
        })
    },
    logoutUser(){
        const config = { 
            headers: { Authorization: 'Bearer ' + localStorage.getItem('app_token')},
        };
        console.log(config);
        axios.post(process.env.VUE_APP_URL + 'logout', config)
            .then(() => {
                localStorage.clear();
                window.location.replace('/login')
            })
            .catch(error => {
                console.log(error);
            });
    },
    getUser({commit}){
        axios.get(process.env.VUE_APP_URL + 'user')
            .then(response => {
                commit('SET_USER', response.data)
            })
            .catch(error => {
                console.log(error)
            })
    },
    getAllUsers({commit}){
        axios.get(process.env.VUE_APP_URL + 'users')
            .then(response => {
                commit('SET_USERS', response.data)
            })
            .catch(error => {
                console.log(error);
            })
    },
    getMyTasks({commit}, task){
        axios.get(process.env.VUE_APP_URL + 'usertasks', {
            params: {
                sorter: task ? task.sorter : ''
            }
        })
            .then(response => {
                console.log(response.data)
                commit('SET_TASKS', response.data)
               
            })
            .catch(error => {
                console.log(error);
            })
    },
    changeStatus(_, task){
        axios.put(process.env.VUE_APP_URL + 'status/' + task.id, {
            status: task.status
        })
        .then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        })
    }
}
const mutations = {
    SET_USER(state, data){
        state.user = data
    },
    SET_USERS(state, data){
        state.users = data
    },
    SET_TASKS(state, data){
        state.tasks = data
    },
    SET_ERRORS_LOGIN(state, data){
        state.errorsLogin = data
    },
    SET_ERRORS_REGISTER(state, data){
        state.errorsRegister = data
    },
    UNSET_ERRORS(state){
        state.errorsLogin = ''
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}