<template>
	<div class="slider fullscreen section" data-anchor="slider">
	    <ul class="slides">
	      <li v-for="slider in sliders">
	        <img :src="['../../'+slider.img]"> <!-- random image -->
	        <div class="caption center-align">
	          <h3>{{slider.title}}</h3>
	        </div>
	      </li>
	    </ul>
    </div>
</template>

<script>
  export default {
	data () {
      return {
        img1: '../../slider/background1.jpg',
        img2: '../../slider/background2.jpg',
        img3: '../../slider/background3.jpg',
        sliders:[]
      }
    },
    mounted: function(){
		this.$http.post('/Api/hslider',{user:this.$route.params.user}).then(function(response){
			this.sliders = response.data;
		}, function(response){});			
    },
    watch:{
    	sliders:function(val, oldVal){
    		this.$nextTick(function(){
	    		$('.slider').slider({full_width: true});
    		})
    	}
    }
  }
</script>
<style scoped>
	.slider.fullscreen{
		position: relative;
	}
</style>