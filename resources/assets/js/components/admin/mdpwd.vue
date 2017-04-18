<template>
	<section class="mdpwd">
		<div class="navigation col s12">
	    	<h5>修改密码</h5>
	     	<a href="#!" class="bread first">用户管理</a>
	      	<a href="#!" class="bread">修改密码</a>
    	</div>
		<div class="row">
		    <form id="mdpwdForm" class="col s12">
		      <div class="row">
		        <div class="input-field col s12">
		          <input name="oldpwd" type="password" class="validate">
		          <label for="password">原密码</label>
		        </div>
		      </div>
		      <div class="row">
		        <div class="input-field col s12">
		          <input name="newpwd"  type="password" class="validate">
		          <label for="password">新密码</label>
		        </div>
		      </div>
		    </form>
        	<button class="btn waves-effect waves-light" v-on:click="submit">
	        	提交<i class="fa fa-send" aria-hidden="true"></i>
			</button>
		</div>
	</section>
</template>

<script>
  export default {
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
  	 },
  	 methods: {
  	 	submit(){
  	 		var formData = new FormData($('#mdpwdForm')[0]);
			this.$http.post('/Api/mdpwd',formData).then(function(response){
				if(response.data.status==1){
					alert(response.data.msg);
				}else{
					alert(response.data.msg);
				}
			}, function(response){
				console.log(response.data.msg);
			});
  	 	}
  	 }
  }
</script>
<style>
	.mdpwd .row{
		width: 85%;
		margin: 1rem auto 0;
	}
	.mdpwd button.btn{
		display: block;
		margin: 0 auto;
	}
	.mdpwd .btn{
		font-size: 1.2rem;
	}
	.mdpwd .btn i{
		font-size: 1rem;
		margin-left: 0.5rem;
	}
</style>