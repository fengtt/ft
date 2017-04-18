<template>
  <main>
  <headers></headers>
    <div id="dowebok">
	  	<slider></slider>
	  	<skill></skill>
  	  <note></note>
	  	<user></user>
	  	<reply></reply>
  	</div>
  	  <div class="fixed-action-btn toolbar">
    <a class="btn-floating btn-large">
      <i class="fa fa-leaf"></i>
    </a>
    <ul>
      <li v-if="!login" class="waves-effect waves-light"><a href="../login"><i class="fa fa-power-off"></i>  登陆</a></li>
      <li v-if="!login" class="waves-effect waves-light"><a href="../register"><i class="fa fa-edit"></i>  注册</a></li>
      <li v-if="login" class="waves-effect waves-light"><a href="../Admin/index"><i class="fa fa-user-o"></i>  {{username}}</a></li>
      <li v-if="login" class="waves-effect waves-light"><a v-on:click="logout" style="cursor: pointer;"><i class="fa fa-sign-out"></i>  登出</a></li>
    </ul>
  </div>
  </main>
</template>

<script>
import Headers from './header.vue'
import Slider from './slider.vue'
import Skill from './skill.vue'
import User from './user.vue'
import Note from './note.vue'
import Reply from './reply.vue'

  export default {
		components:{
	      Headers,Slider,Skill,User,Note,Reply
		},
  	data(){
  		return {
				login:false,
				username:''
  		}
  	},
    mounted: function () {
    	$('#dowebok').fullpage();
			this.$http.post('/Api/userlogin').then(function(response){
				if(response.data==0){
						this.login = false;
				}else{
					  this.login = true;
					  this.username = response.data.username;
				}
			}, function(response){});
  	},
  	methods:{
  		logout(){
				this.$http.post('/Api/logout').then(function(response){
				if(response.data==1){
						this.login = false;
				}
				}, function(response){});
  		}
  	},
  	beforeDestroy: function(){
    	$('html, body').attr('class','');
    	$('html, body').attr('style','');
  	}
  }
</script>
<style>
	#sidenav-overlay{
		display: none;
	}
	.modal-overlay{
		display: none!important;
	}
</style>