<template>
  <main class="cd-image-mask-effect">
		<section class="project-2 cd-project-mask">		
			<h1><img width="35px" class="logo" :src="logoSrc">Feather Tag</h1>
						<div class="featured-image" :style="{backgroundImage: 'url(' + bgimg + ')'}"></div>
			<div class="mask">
				    <div class="login">
				    	 <div class="login__check"></div>
				      <div class="login__form">
				        <div class="login__row input-field">
				          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
				            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
				          </svg>
				          <input autocomplete="off" type="text" id="username" class="login__input name"/>
				        	<label for="username">Username</label>
				        </div>
				        <div class="login__row input-field">
				          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
				            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
				          </svg>
				          <input type="password" id="pwd" class="login__input pass"/>
				        	<label for="username">Password</label>
				        </div>
				        <button type="button" v-on:click="login" class="login__submit">Sign in</button>
				        <p class="login__signup">Don't have an account? &nbsp;<router-link to="/register">Sign up</router-link></p>
				      </div>
				    </div>   
				<span class="mask-border mask-border-top"></span>
				<span class="mask-border mask-border-bottom"></span>
				<span class="mask-border mask-border-left"></span>
				<span class="mask-border mask-border-right"></span>
			</div>

			<!--<a href="#0" class="project-trigger" style="color: #18a15f;">登  录</a>-->
			<div class="cd-project-info" data-url="project-2">
				<!-- content loaded using js -->
				
			</div>
			<div class="front-desk front-desk-left">
				<p>后台</p>
				<router-link to="/Admin/index"><i class="fa fa-cog"></i></router-link>
			</div>
			<div class="front-desk front-desk-right">
				<p>前台</p>
				<a v-bind:href="href"><i class="fa fa-leaf"></i></a>
			</div>
		</section> <!-- .cd-project-mask -->
	</main>
</template>

<script>
		var transitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';
		var self;
		function RevealingProject( element ) {
			this.element = element;
			this.projectTrigger = this.element.find('.login__submit');
			this.projectClose = this.element.find('.project-close'); 
			this.projectTitle = this.element.find('h1');
			this.projectMask = this.element.find('.mask');
			this.maskScaleValue = 1;
			this.bgImage = this.element.find('.featured-image');
			this.projectContent = this.element.find('.cd-project-info');
			this.projectContentUrl = this.projectContent.data('url');
			this.animating = false;
			this.scrollDown = this.element.find('.cd-scroll');
			this.scrolling = false;
			this.initProject();
		}
		RevealingProject.prototype.initProject = function() {
			self = this;
			//open the project
//			this.projectTrigger.on('click', function(e){	
//	
//			});
		}
		RevealingProject.prototype.revealProject = function() {
			var self = this;
			self.projectTitle.attr('style', 'opacity: 0;');
			self.projectMask.css('transform', 'translateX(-50%) translateY(-50%) scale('+self.maskScaleValue+')').one(transitionEnd, function(){
				self.projectMask.off(transitionEnd);
				self.animating = false;
				self.element.addClass('center-title');
				self.projectTitle.attr('style', '');
				$(".logo").attr('src','Auth/img/logo.png');
				$(".front-desk").show();
			});
	
			//hide the other sections
			self.element.addClass('project-selected content-visible').parent('.cd-image-mask-effect').addClass('project-view');
		}
  export default {
    data () {
      return {
        logoSrc: '../../Common/img/logog.png',
        bgimg:'../../Auth/img/login.jpg',
        href:''
      }
    },
    methods: {
       login() {
       		$('.login__submit').addClass("processing");
       	  this.$http.post('/Api/login',{username:$("#username").val(),pwd:$("#pwd").val()}).then(function(response){
						if(response.data.status==1){
							if( $(window).scrollTop() == self.element.offset().top ) {
								self.revealProject();
							} else {
								$('body,html').animate({'scrollTop': self.element.offset().top}, 400).promise().then(function() {
									self.revealProject();
								});
							}
							$('.login__submit').removeClass("processing");
							this.href = '../Home/' + response.data.username;
						}else{
							alert(response.data.msg);
							$('.login__submit').removeClass("processing");
						}
					}, function(response){
						console.log(response.data.msg);
					});
       }
    },
    mounted: function () {
    	new RevealingProject($('.cd-project-mask'));
  	}
  }

</script>
<style scoped>
	@import '../../../../../public/Common/css/font.css';
	@import '../../../../../public/Auth/css/style.css';
	@import '../../../../../public/Auth/css/login.css';
	.login__form .input-field label{
		color: #fff;
		top: 1.8rem;
	  left: 15%;
	}
</style>