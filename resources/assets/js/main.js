import Vue from 'vue/dist/vue.js'
import App from './App.vue'
import VueRouter from 'vue-router/dist/vue-router.common.js'
import VueResource from 'vue-resource/dist/vue-resource.common.js'

Vue.use(VueRouter)
Vue.use(VueResource)
/*登陆注册组件*/
import Example from './components/example.vue'
import Login from './components/auth/Login.vue'
import Register from './components/auth/register.vue'
/*后台组件*/
import Index from './components/admin/index.vue'
import Main from './components/admin/main.vue'
import Column from './components/admin/column.vue'
import Slider from './components/admin/slider.vue'
import User from './components/admin/user.vue'
import Addslider from './components/admin/addslider.vue'
import Mdpwd from './components/admin/mdpwd.vue'
import Skill from './components/admin/skill.vue'
import Notetype from './components/admin/notetype.vue'
import Note from './components/admin/note.vue'
import Reply from './components/admin/reply.vue'
import Social from './components/admin/social.vue'

const router = new VueRouter({
  mode: 'history',
  base: __dirname,
  routes: [
    { path: '/example', component: Example },
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/Admin', component: Index,
      children:[
      	{ path: '/Admin/index', component: Main},
        { path: '/Admin/column', component: Column},
        { path: '/Admin/slider', component: Slider},
        { path: '/Admin/user', component: User},
        { path: '/Admin/slider/addslider', component: Addslider},
        { path: '/Admin/mdpwd', component: Mdpwd},
        { path: '/Admin/skill', component: Skill},
        { path: '/Admin/notetype', component: Notetype},
        { path: '/Admin/note', component: Note},
        { path: '/Admin/reply', component: Reply},
        { path: '/Admin/social', component: Social},
    	]
    }
  ]
})
//router.afterEach(route => {
//	$('#content-box>.ps-scrollbar-y-rail').css('top',0);
//		console.log($('#content-box>.ps-scrollbar-y-rail').css('top'));
//})
new Vue(Vue.util.extend({ router }, App)).$mount('#app')