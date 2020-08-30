import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './provider/state';

Vue.use(VueRouter)


//components
import Login from './components/Login';
import DashBoard from './components/Dash';

const routes = [
  { path: '/', component: Login },
  { path: '/dash', component: DashBoard },
]

const router = new VueRouter({routes})

 new Vue({
  router,
  store
}).$mount('#app')