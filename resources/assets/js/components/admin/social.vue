<template>
	<section>
   		<div class="navigation col s12">
	    	<h5>联系方式管理</h5>
	     	<a href="#!" class="bread first">联系管理</a>
	      	<a href="#!" class="bread">联系方式管理</a>
    	</div>
    	<form id="socialForm">
    	<div class="social-icon">
    		<div class="icon-box sinaweibo"><i class="fa fa-weibo"></i></div>
	        <div class="input-field">
		          <input id="sinaweibo" v-model="weibo" v-on:blur="edit()" type="text" class="validate" name="weibo">
		          <label for="sinaweibo">微博网址</label>
	        </div>
    	</div>
    	<div  class="social-icon">
    		<div class="icon-box qq"><i class="fa fa-qq"></i></div>
	        <div class="input-field">
		          <input id="qq" v-model="qq" v-on:blur="edit()"  type="text" class="validate" name="qq">
		          <label for="qq">qq号</label>
	        </div>
    	</div>
    	<div  class="social-icon">
    		<div class="icon-box wechat"><i class="fa fa-weixin"></i></div>
	        <div class="input-field">
		          <input id="wechat" v-model="weixin" v-on:blur="edit()"  type="text" class="validate" name="weixin">
		          <label for="wechat">微信号</label>
	        </div>
    	</div>
    	</form>
	</section>
</template>

<script>
  export default {
  	data(){
  		return {
  			weibo:'',
  			qq:'',
  			weixin:'',
  		}
  	},
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
		this.$http.post('/Api/getsocial').then(function(response){
			this.weibo = response.data.weibo;
			this.weixin = response.data.weixin;
			this.qq = response.data.qq;
			$(".validate").next().addClass('active');
		}, function(response){});
  	 },
  	 methods:{
  	 	edit(){
  	 		var formData = new FormData($('#socialForm')[0]);
			this.$http.post('/Api/editsocial',formData).then(function(response){}, function(response){});
  	 	}
  	 }
  }
</script>
<style>
	.social-icon{
		position: relative;
	    margin: 1rem auto 0;
   		width: 80%;
	}
	.social-icon div{
	    display: inline-block;
	}
	.social-icon .icon-box{
	    width: 5rem;
	    height: 5rem;
	    font-size: 2.5rem;
	    line-height: 5rem;
	    color: #fff;
	    border-radius: 50%;
	    margin: 6px;
	    text-align: center;
	}
	.social-icon .input-field{
		width: 60%;
	}
	.sinaweibo{
		background: #EC5B5B;
	}
	.qq{
	    background: #49C085;
	}
	.wechat{
		background: #6F92FF;
	}
</style>