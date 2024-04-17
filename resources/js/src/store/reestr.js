import { createStore } from 'vuex'
import axios from "axios";
import {onBeforeRouteUpdate} from "vue-router";

const apiUrl = '/api/admin/'
export const reestr = createStore({
    state : {
        reestrs: {
            headers: [],
            data: []
        },
        reestrsId : [],
    },
    getters: {
        getReestr(state) {
            return state.reestrs
        },
        getReestrsId(state) {
            return state.reestrsId
        }
    },
    mutations: {
        setReestr(state, data) {
            state.reestrs.headers = data.headers
            state.reestrs.data = data.data
        },
        setReestrs(state, id) {
            if (state.reestrsId.includes(id)) {
                const reestrs = state.reestrsId.filter((number) => number !== id);
                state.reestrsId = reestrs
            } else {
                state.reestrsId.push(id)
            }
        },
        setAddReestr(state, id) {
            if (!state.reestrsId.includes(id)) state.reestrsId.push(id)
        },
        setDeleteReestr(state, id) {
            const reestrs = state.reestrsId.filter((number) => number !== id);
            state.reestrsId = reestrs
        }
    },
    actions: {
        queryReestr({state, commit}) {
            axios.get(apiUrl + 'reestr')
                .then(res => {
                    const data = {
                        headers: JSON.parse(res.data.header),
                        data: res.data.reestrs
                    }
                    commit('setReestr', data);
                }).catch(err => {
                    // console.log(err.response)
                }).finally(() => {

                })
        },
        setUpdateReestrs({state, commit}, id) {
            commit('setReestrs', id);
        },
        setAddReestr({state, commit}, id) {
            commit('setAddReestr', id);
        },
        setDeleteReestr({state, commit}, id) {
            commit('setDeleteReestr', id);
        },

    }
})


