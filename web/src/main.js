import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './provider/state';
import VueSimpleAlert from "vue-simple-alert";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faSignOutAlt } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(faSignOutAlt)

Vue.component('font-awesome-icon', FontAwesomeIcon)


Vue.use(VueRouter)
Vue.use(VueSimpleAlert);


//components
import Login from './components/Login';
import DashBoard from './components/Dash';

const routes = [
  { path: '/', component: Login },
  { path: '/dash', component: DashBoard },
]

const router = new VueRouter({ routes })

new Vue({
  router,
  store
}).$mount('#app')