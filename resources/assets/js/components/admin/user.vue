<template>
	<section class="user">
	<div class="navigation col s12">
    	<h5>个人简历</h5>
     	<a href="#!" class="bread first">用户管理</a>
      	<a href="#!" class="bread">个人简历</a>
    </div>
    <div class="row">
    	<div class="col s12 m9 l10">
		    <div class="card">
		    	<form id="uploadForm" enctype="multipart/form-data">
				  <div id="artEditor">
					</div>
					</form>
					<div class="btn-box">
						<button class="btn waves-effect waves-light" v-on:click="submit">
				        	提交<i class="fa fa-send" aria-hidden="true"></i>
						</button>
					</div>
				</div>
    	</div>
		<div class="xiumi col hide-on-small-only m3 l2">
				<a href="http://xiumi.us" target="_blank"><img :src="xiumi"><span>推荐使用秀米排版</span></a>
		</div>
		</div>
	</section>
</template>

<script>
  var editor;
  export default {
  	data(){
  		return {
  			xiumi: '../../Admin/img/xiumi_logo.png',
  		}
  	},
  	 methods: {
  	 	submit(){
  	 		var formData = new FormData($('#uploadForm')[0]);
			this.$http.post('/Api/editvitae',formData).then(function(response){
					if(response.data.status==1){
						alert(response.data.msg);
					}
			}, function(response){
				console.log(response.data.msg);
			});
  	 	}
  	},
  	mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
  		var editor_content="请编辑个人简历";
  		editor = UE.getEditor('artEditor', {
			initialFrameHeight : 500,
			scaleEnabled:true
		});
		this.$http.post('/Api/getvitae').then(function(response){
			editor.ready(function(){
				editor.setContent(response.data);
			});
		}, function(response){});
  	},
	beforeDestroy: function() {
		editor.setHide()
		editor.destroy();
	}
  }
</script>
<style>
	.btn-box{
		text-align: right;
	}
	.user button.btn{
		display: inline-block;
    margin: 1rem 2rem;
	}
	.user .btn{
		font-size: 1.2rem;
	}
	.user .btn i{
		font-size: 1rem;
		margin-left: 0.5rem;
	}
	.xiumi{
		text-align: center;
    padding: 1.5rem!important;
	}
	.xiumi a{
		display: inline-block;
    width: 40px;
    text-align: center;
    font-size: 40px;
    color: #18A15F;
	}
	#edui1{
		z-index: 99!important;
	}
</style>