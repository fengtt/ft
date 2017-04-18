<template>
  	<div class="register-cont"  :style="{backgroundImage: 'url(' + bgimg + ')'}">
		<h1 class="register-title1">Feather Tag</h1>
		<h2 class="register-title2">To follow me,just sign up</h2>
		<form>
			<div class="register-form" style="border:none">
				<input class="validate" type="text" v-model="vip.email" name="email" placeholder="Email" id="signup_email">			
				<transition name="fade">
				<span v-if="yes.email">{{msg.email}}</span>
				</transition>
			</div>
			<div class="register-form">
				<input type="text" v-model="vip.username" name="username" placeholder="Username" id="signup_username">
				<transition name="fade">
				<span v-if="yes.username">{{msg.username}}</span>
				</transition>
			</div>
			<div class="register-form">
				<input type="password" v-model="vip.password" name="password" placeholder="Password" id="signup_password">
				<transition name="fade">
				<span v-if="yes.password">{{msg.password}}</span>
				</transition>
			</div>
			<div class="register-form">
				<input type="password" v-model="vip.conpassword"  placeholder="Confirm the password" id="signup_confirm_password">
				<transition name="fade">
				<span v-if="yes.conpassword">{{msg.conpassword}}</span>
				</transition>
			</div>
		</form>
		<button id="signup_forms_submit" v-on:click="register">Sign up</button>
		<router-link to="/login" class="signup_link">Log in</router-link>
	</div>
</template>

<script>
export default {
    data () {
      return {
        bgimg:'../../Auth/img/u1.jpg',
        vip:{
        	email:'',
        	username:'',
        	password:'',
        	conpassword:''
        },
        msg:{
        	email:'',
        	username:'',
        	password:'',
        	conpassword:''
        },
        yes:{
        	email:'',
        	username:'',
        	password:'',
        	conpassword:''
        }
      }
    },
    methods: {
        register() {
	    	var formData = JSON.stringify(this.vip);
			var cE=this.checkEmail();
			var cU=this.checkUsername();
			if(cU==undefined){
				cU=!this.yes.username;
			}
			var cU=!this.yes.username;
			var cP=this.checkPassword();
			if(cE&&cU&&cP){
				this.$http.post('/Api/register',formData).then(function(response){
					if(response.data.status==1){
						alert(response.data.msg);
						this.$router.push('/login');
					}else{
						alert(response.data.msg);
					}
				}, function(response){
					console.log(response.data.msg);
				});
			}
        },
        checkEmail(){
	      	var val=this.vip.email;
	      	var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	      	if(!myreg.test(val)){
	          	this.msg.email='请输入正确的邮箱格式';
	          	this.yes.email=true;
	          	return false;
	        }else{
	        	this.yes.email=false;
	        	return true;
	        }	
        },
        checkUsername(){
        	var val=this.vip.username;
        	if(val==''){
        		this.msg.username='用户名不能为空!';
        		this.yes.username=true;
        		return false;
        	}else{
				this.$http.post('/Api/userExists',{username:val}).then(function(response){
					if(response.data.status==1){
						this.yes.username=false;					
					}else{
						this.msg.username=response.data.msg;
						this.yes.username=true;
					}
				}, function(response){
					console.log(response.data.msg);
				});
        	}
        },
        checkPassword(){
        	var val=this.vip.password;
			if(val.length<6){
	          	this.msg.password='密码不少于6位';
	          	this.yes.password=true;
	          	return false;
			}else{
				this.yes.password=false;
				return true;
			}
        },
        checkConpassword(){
        	var val=this.vip.conpassword;
			if(this.vip.password==val){
				this.yes.conpassword=false;
				return true;
			}else{
	          	this.msg.conpassword='两次密码不同';
	          	this.yes.conpassword=true;
	          	return false;
			}
        }
    },
    watch: {
	    'vip.email':'checkEmail',
	    'vip.username':'checkUsername',
		'vip.password':'checkPassword',
		'vip.conpassword':'checkConpassword'
    }
}
</script>
<style>
	@import '../../../../../public/Auth/css/register.css';
	.register-form span{
	    position: absolute;
	    top: 0;
	    left: 269px;
	    width: 180px;
	    line-height: 42px;
	    color: #f76f65;
	    padding: 0 10px;
	    font-size: 15px;
	    background: #fff;
	    text-align: center;
	    border-radius: 4px;
	    box-shadow: 0 0 10px #000;
	    transition:all 2s ease;
	}
	.register-form span:before{
		width: 0;
	    height: 0;
	    left: -8px;
	    top: 12px;
	    content: '';
	    position: absolute;
	    border-top: 8px solid transparent;
	    border-right: 8px solid #fff;
	    border-bottom: 8px solid transparent;
	}
	.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>