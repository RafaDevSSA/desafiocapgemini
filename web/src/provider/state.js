import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        account: {}
    },
    mutations: {
        setAccount(state, payload) {
            state.account = payload
        },
    },
    actions: {
      setAccount(state,payload){
          state.commit('setAccount',payload)
      }
    },
    getters: {
        account(state) {
            return state.account
        }
    }
});

export default store;