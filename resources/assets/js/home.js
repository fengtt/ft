import Vue from 'vue/dist/vue.js'
import App from './App.vue'
import VueRouter from 'vue-router/dist/vue-router.common.js'
import VueResource from 'vue-resource/dist/vue-resource.common.js'

Vue.use(VueRouter)
Vue.use(VueResource)
/*前台组件*/
import Hindex from './components/home/index.vue'
import Notelist from './components/home/notelist.vue'
import Notedetail from './components/home/notedetail.vue'


const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/Home/:user', name: 'index',component: Hindex},
    {path: '/Home/notelist/:id', name: 'notelist',component: Notelist},
    {path: '/Home/notedetail/:id', name: 'notedetail',component: Notedetail},
  ]
})
//router.afterEach(route => {
//	$('#content-box>.ps-scrollbar-y-rail').css('top',0);
//		console.log($('#content-box>.ps-scrollbar-y-rail').css('top'));
//})
new Vue(Vue.util.extend({ router }, App)).$mount('#app')