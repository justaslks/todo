import axios from 'axios'

const state = {
    user: {},
    users: []
}
const getters = {
    getUser(state){
        return state.user.isAdmin
    }
}
const actions = {
    registerUser(_, user){
        axios.post(process.env.VUE_APP_URL + 'register', {
            name: user.name,
            email: user.email,
            password: user.password,
            password_confirmation: user.password_confirmation
        })
        .then(response => {
            console.log(response)
        })
        .catch(error => {
            console.log(error)
        })
    },
    loginUser(_, user){
        axios.post(process.env.VUE_APP_URL + 'login', {
            email: user.email,
            password: user.password
        })
        .then( response => {
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
    }
}
const mutations = {
    SET_USER(state, data){
        state.user = data
    },
    SET_USERS(state, data){
        state.users = data
    }
}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}