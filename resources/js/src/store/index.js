import { createStore } from 'vuex'
import axios from "axios";
import {onBeforeRouteUpdate} from "vue-router";

export const store = createStore({
    state : {
        user: {},
        message: {},
        senders: {},
        loading: false,
        isChange: false
    },
    getters: {
        getUser(state) {
            return state.user
        },
        getMessage(state) {
            return state.message
        },
        getSenders(state) {
            return state.senders
        }
    },
    mutations: {
        setUser(state, user) {
            localStorage.setItem('user', JSON.stringify(user))
        },

        setMessage(state, message) {
            state.message = message
            console.log(state.message)
        },
        setSenders(state, senders) {
            state.senders = senders
        }
    },
    actions: {
        setUser(context, email) {
            axios.get('/api/admin/user/' + email)
                .then(res => {
                    context.commit('setUser', res.data.data)
                })
                .catch(err => {
                    console.log(err.response)
                })
        },

        setMessage({state, commit}, id) {
            axios.get('/api/admin/messages/' + id)
                .then(res => {
                    state.loading = true
                    commit('setMessage', res.data)
                })
                .catch(err => {
                    console.log(err.response)
                })
                .finally(() => {
                    state.loading = false
                })
        },
        setSenders({state, commit}, message) {
            state.loading = true
            const user = JSON.parse(localStorage.getItem('user'))
            axios.get('/api/admin/messages/' +  user.id + '/' + message)
                .then(res => {
                    commit('setSenders', res.data)
                })
                .catch(err => {
                    console.log(err.response)
                })
                .finally(() => {
                    state.loading = false
                })
        }
    }
})


