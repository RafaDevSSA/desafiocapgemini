import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        account: {}
    },
    mutations: {
        set(state, { account }) {
            state.account = account
            alert(account)
        },
    },
    actions: {
        set(state, { account }) {
            state.account = account
            alert(account)
        }
    }
});

export default store;