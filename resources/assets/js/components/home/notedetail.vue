<template>
	<main class="userdetail">
	  <div class="parallax-container">
	    <div class="parallax"><img :src="img1"></div>
	  </div>
	  <div class="section">
	  	<a class="btn-floating halfway-fab waves-effect waves-light" v-on:click="close()"><i class="fa fa-close"></i></a>
	    <div class="row container"  v-html="noteInfo">   
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
  			noteInfo:'',
	        img1: '../../slider/background1.jpg',
        	img2: '../../slider/background2.jpg'
  		}
	},
    mounted: function(){
		this.$http.post('/Api/note',{id:this.$route.params.id}).then(function(response){
				this.noteInfo = response.data.content;
		}, function(response){});
	    $(document).ready(function(){
	      $('.parallax').parallax();
	    });
    },
    methods:{
    	close(){
    		this.$router.go(-1);
    	}
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