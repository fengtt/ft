<template>
	<div class="user section" data-anchor="user">
		<h2>个人简介</h2>
		<div class="user-content" v-html="userInfo"></div>
		<div class="user-btn"><a href="#modal1" class="waves-effect waves-light btn">查看详情</a></div>
		  <div id="modal1" class="modal">
			  <a class="modal-action modal-close btn-floating halfway-fab waves-effect waves-light"><i class="fa fa-close"></i></a>
		      <div class="card" v-html="userInfo">   
		      </div>
		  </div>
	</div>
</template>

<script>
  export default {
	data () {
  		return {
  			userInfo: '',
	        img1: '../../slider/background1.jpg',
        	img2: '../../slider/background2.jpg'
  		}
	},
    mounted: function(){
		this.$http.post('/Api/hgetvitae',{user:this.$route.params.user}).then(function(response){
				this.userInfo = response.data;
		}, function(response){});
		$(document).ready(function(){
			$('.modal').modal();
			$(".user .fp-tableCell").css('display','block');
			$('.modal').modal({
			    ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
			        $('.modal').perfectScrollbar();
			        $(".navbar-fixed").hide();
			      },
			      complete: function() { $(".navbar-fixed").show(); } // Callback for Modal close
			    }
  			);
		})
    }
  }
</script>
<style scoped>
	h2{
		text-align: center;
	}
	.user{
	    display: block;
    	overflow: hidden;
	}
	.user-content{
		margin: 4rem;
	}
	@media only screen and (max-width: 450px){
		.user-content{
			margin: .5rem!important;
		}
	}
	.user-btn{
		text-align: center;
		position: absolute;
		width: 100%;
		opacity: .8;
		bottom: 0;
	    height: 65px;
		background: #FFFFFF;
	}
	#modal1{
		position: absolute;
		top: 0!important;
		height: 100%;
	    width: 100%;
	    max-height: 100%;
	    overflow: hidden;
	    padding: 4rem;
	}
	#modal1 .card{
		padding: 1rem;
	}
	.user .btn-floating.halfway-fab{
	    top: 1rem!important;
	    width: 4rem!important;
	    height: 4rem!important;
	    opacity: .9;
	}
    .btn-floating.halfway-fab i{
    	font-size: 2.6rem;
    	line-height: 4rem;
    }
</style>