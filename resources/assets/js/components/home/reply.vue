<template>
	<div class="reply section" data-anchor="reply">
    <div class="row">
    <form id="replyForm" class="col s12 m10 l10">
    	<input type="hidden" v-model="user" name="user" />
       <h3>与我联系</h3>
      <div class="row">
        <div class="input-field col s6">
          <input id="first_name" type="text" name="name" class="validate">
          <label for="first_name">姓名</label>
        </div>
        <div class="input-field col s6">
          <input id="email" type="email" name="email" class="validate">
          <label for="last_name">你的邮箱</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="title" type="text" name="theme" class="validate">
          <label for="title">主题</label>
        </div>
      </div>
	  <div class="row">
          <div class="input-field col s12">
	          <textarea id="textarea1" name="content" class="materialize-textarea"></textarea>
	          <label for="textarea1">你想说的话</label>
          </div>
	  </div>
	 <div class="row">
        <div class="input-field col s12">
  			<a v-on:click="reply()" class="waves-effect waves-light btn">戳我吧</a>
        </div>
	  </div>
    </form>
    <div class="social-box col s12 m2 l2">
    	<div class="social-icon">
    		<a class="icon-box sinaweibo tooltipped" data-position="left" data-delay="50" v-bind:data-tooltip="weibo"><i class="fa fa-weibo"></i></a>
    	</div>
    	<div  class="social-icon">
    		<a class="icon-box qq tooltipped" data-position="left" data-delay="50" v-bind:data-tooltip="qq"><i class="fa fa-qq"></i></a>
    	</div>
    	<div  class="social-icon">
    		<a class="icon-box wechat tooltipped" data-position="left" data-delay="50" v-bind:data-tooltip="weixin"><i class="fa fa-weixin"></i></a>
    	</div>
    </div>
  </div>
		<footers></footers>
    </div>
</template>

<script>
import Footers from './footer.vue'
  export default {
	components:{
      Footers
	},
  	data(){
  		return {
  			user:this.$route.params.user,
  			weibo:'',
  			weixin:'',
  			qq:'',
  		}
  	},
    mounted: function(){
		this.$http.post('/Api/huser',{user:this.$route.params.user}).then(function(response){
				this.weibo = response.data.weibo;
				this.weixin = response.data.weixin;
				this.qq = response.data.qq;
		}, function(response){});
   },
	methods:{
		reply(){
			var formData = new FormData($('#replyForm')[0]);
			this.$http.post('/Api/hreply',formData).then(function(response){
				if(response.data.status==1){
					alert(response.data.msg);
				}
			}, function(response){});
		}
	},
    watch:{
    	qq:function(val, oldVal){
    		this.$nextTick(function(){
				$('.tooltipped').tooltip({delay: 50});
    		})
    	}
    }
  }
</script>
<style scoped>
	h3{
		text-align: center;
	}
	.reply{
		background-color: #fcfcfc;
	}
	.reply form{
		padding: 0 5rem;
	}
	@media only screen and (max-width: 450px){
		.reply form{
			padding: 0!important;
		}
		.row{
			margin-bottom: 0!important;
		}
		.social-icon{
			display: inline-block;
		}
		.icon-box{
		    width: 4rem;
	    	height: 4rem;
	    	line-height: 4rem;
		}
		.social-box{
			padding-top: 0!important;
		}
		.input-field{
			margin-top: 0!important;
		}
		.btn{
		    width: 100%;
		    height: 3rem;
		    line-height: 3rem;
		    font-size: 1.2rem;
		    border-radius: 10px;
		}
	}
	.social-box{
		padding-top: 3rem;
	}
	.icon-box{
	    width: 5rem;
	    height: 5rem;
	    font-size: 2.5rem;
	    line-height: 5rem;
	    color: #fff;
	    border-radius: 50%;
	    margin: 6px;
	    text-align: center;
	    display: inline-block;
	    cursor: pointer;
	}
	.icon-box:hover{
		opacity: .8;
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
	.btn{
	    width: 100%;
	    height: 60px;
	    line-height: 60px;
	    font-size: 1.5rem;
	    border-radius: 10px;
	}
</style>