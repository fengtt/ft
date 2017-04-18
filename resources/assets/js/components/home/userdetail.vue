<template>
	<main class="userdetail">
	  <div class="parallax-container">
	    <div class="parallax"><img :src="img1"></div>
	  </div>
	  <div class="section">
	  	<router-link to="/Home/index" class="btn-floating halfway-fab waves-effect waves-light"><i class="fa fa-home"></i></router-link>
	    <div class="row container"  v-html="userInfo">   
	    </div>
	  </div>
	  <div class="parallax-container">
	    <div class="parallax"><img :src="img2"></div>
	  </div>
	</main>
</template>

<script>
import Headers from './header.vue'
  export default {
	components:{
      Headers
	},
	data () {
  		return {
  			userInfo:'',
	        img1: '../../slider/background1.jpg',
        	img2: '../../slider/background2.jpg'
  		}
	},
    mounted: function(){
		this.$http.post('/Api/getvitae').then(function(response){
				this.userInfo = response.data;
		}, function(response){});
	    $(document).ready(function(){
	      $('.parallax').parallax();
	    });
    },
	beforeDestroy: function() {
	}
  }
</script>
<style>
	.userdetail{
		overflow-x: hidden;
	}
	.section{
		position: relative;
	}
	.btn-floating.halfway-fab{
	    left: 3rem;
	    top: -3.8rem;
	    width: 4rem;
	    height: 4rem;
	    opacity: .9;
	}
    .btn-floating.halfway-fab i{
    	font-size: 2.6rem;
    	line-height: 4rem;
    }
</style>