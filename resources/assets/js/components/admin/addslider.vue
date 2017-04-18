<template>
	<section class="addslider">
	    <div class="navigation col s12">
	    	<h5>添加滚动图</h5>
	     	<a href="#!" class="bread first">滚动图管理</a>
	      	<a href="#!" class="bread">添加滚动图</a>
	    </div>
	   	<div class="row">
	    	<form id="uploadForm" class="col s12" enctype="multipart/form-data">
		      <div class="row">
		        <div class="input-field col s12">
		          <input id="title" type="text" name="title" class="validate">
		          <label for="password">标题</label>
		        </div>
		       <div class="file-field input-field col s12">
			      <div class="btn">
			        <span>文件</span>
			        <input type="file" name="file">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
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
  	 data () {
  	 	return {
  	 	}
  	 },
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
  	 },
  	 methods: {
  	 	submit(){
  	 		var formData = new FormData($('#uploadForm')[0]);
			this.$http.post('/Api/addslider',formData).then(function(response){
				if(response.data.status==1){
					alert(response.data.msg);
					this.$router.push('../slider');
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
	.addslider .row{
		width: 90%;
	}
	.addslider button.btn{
		display: block;
		margin: 0 auto;
	}
	.addslider .btn,.addslider .btn span{
		font-size: 1.2rem;
	}
	.addslider .btn i{
		font-size: 1rem;
		margin-left: 0.5rem;
	}
</style>