import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);
const store = new Vuex.Store({
    state: {  // global variable for component
        token: null
    },
    getters: { //central function for component
        getToken(state) {
            return !!state.token;
        }
    },
    mutations: { //central function to  change for variable in global
        setToken(state, token) {
            state.token = token;
            localStorage.setItem('token', JSON.stringify(token));
            axios.defaults.headers.common.Authorization = token;
        },
        removeToken(state) {
            state.token = null;
            localStorage.removeItem('token');
        }
    },
    actions: {//central between mutations and component
        registerUser({commit}, payload) {
            axios.post('api/register', payload).then(res => {
                commit('setToken', res.data.token);
            }).catch(err => {
            })
        },
        loginUser({commit}, payload) {
            axios.post('api/login', payload).then(res => {
                commit('setToken',res.data.token);
            }).catch(err => {
                console.log(err);
            })
        }
    }
});


export default store;