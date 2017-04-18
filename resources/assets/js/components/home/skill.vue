<template>
  <div class="skill section" data-anchor="skill">
	<h2>专业技能</h2>
	<div class="row">
		<div class="col s6 m-6 l3" v-for="(skill,index) in skills">
			<div id="phpcircle" class="c100 p87 big" v-bind:class="color[index]">
			    <span>{{skill.plan}}%</span>
			    <div class="slice">
			        <div class="bar"></div>
			        <div class="fill"></div>
			    </div>
			</div>
			<div class="skill-name">{{skill.name}}</div>
		</div>
	</div>
  </div>
</template>

<script>
  export default {
  	data () {
      return {
        skills:[],
        color:['','orange','spink','green','','orange','spink','green','','orange','spink','green']
      }
    },
    mounted: function(){
			this.$http.post('/Api/hskill',{user:this.$route.params.user}).then(function(response){
				this.skills = response.data;
			}, function(response){});
    },
    watch:{
    	skills:function(val, oldVal){
    		this.$nextTick(function(){
					$(document).ready(function () {
						var rotationMultiplier = 3.6;
						// For each div that its id ends with "circle", do the following.
						$( ".c100" ).each(function() {
							// Save all of its classes in an array.
							var classList = $( this ).attr('class').split(/\s+/);
							// Iterate over the array
							for (var i = 0; i < classList.length; i++) {
							   /* If there's about a percentage class, take the actual percentage and apply the
									css transformations in all occurences of the specified percentage class,
									even for the divs without an id ending with "circle" */
							   if (classList[i].match("^p")) {
								var rotationPercentage = classList[i].substring(1, classList[i].length);
								var rotationDegrees = rotationMultiplier*rotationPercentage;
								$('.c100.p'+rotationPercentage+ ' .bar').css({
								  '-webkit-transform' : 'rotate(' + rotationDegrees + 'deg)',
								  '-moz-transform'    : 'rotate(' + rotationDegrees + 'deg)',
								  '-ms-transform'     : 'rotate(' + rotationDegrees + 'deg)',
								  '-o-transform'      : 'rotate(' + rotationDegrees + 'deg)',
								  'transform'         : 'rotate(' + rotationDegrees + 'deg)'
								});
							   }
							}
						});
					});
    		})
    	}
    }
  }
</script>
<style scoped>
	h2{
		text-align: center;
	}
	.skill .c100{
		float: none;
		margin: 1rem auto;
		background-color: #FFFFFF!important;
	}
	.skill .c100.big{
		font-size: 14rem;
	}
	@media only screen and (max-width: 450px){
		.skill .c100.big{
			font-size: 8rem!important;
		}
		.skill h2{
		 	font-size: 2.5rem;
		 	margin: 1rem 0;
		}
	}
	.skill-name{
		font-size: 1.5rem;
		text-align: center;
	}
</style>