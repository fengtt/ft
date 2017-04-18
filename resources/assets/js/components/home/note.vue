<template>
	<div class="note section" data-anchor="note" v-bind:style="{backgroundImage:'url('+bgimg+')'}" >
		<h2>学习笔记</h2>
		<div  ele-range id="bubble-box" class="valign-wrapper">
			<div id="bubble">
		    <a v-for="note in notes">{{note.title}}?id={{note.id}} </a>
			<!--<div class="bubble a valign-wrapper hoverable"><p>PHP</p></div>
			<div class="bubble b valign-wrapper hoverable"><p>JS</p></div>
			<div class="bubble c valign-wrapper hoverable"><p>CSS</p></div>
			<div class="bubble d valign-wrapper hoverable"><p>PYTHON</p></div>-->
	    	</div>
    	</div>
	</div>
</template>

<script>
	var href;
  export default {
	data () {
  		return {
  			bgimg:'../../Home/img/notebg.jpg',
  			notes:[]
  		}
	},
    mounted: function(){
    	href = this.$router;
		this.$http.post('/Api/hnotetype',{user:this.$route.params.user}).then(function(response){
	 			this.notes = response.data;
		}, function(response){});
    },
    methods:{
    	show (){
  			this.notes = "";
    	}
    },
    watch:{
    	notes:function(val, oldVal){
    		this.$nextTick(function(){
	    		var neontext = new Neontext("bubble");
	    		neontext.render.run();
				$("#bubble a").click(function(){
					href.push({ name: 'notelist', params: { id: $(this).attr('id') }});
				})
    		})
    	}
    }
  }
</script>
<style>
	.note{
		
	}
	h2{
		text-align: center;
	}
	#bubble-box{
	    position: absolute;
	    width: 100%;
	    top: 0;
	    height: 100%;
	    background: rgba(10, 10, 10, 0);
	}
	#bubble{
		width: 60%;
		height: 100%;
		margin: 0 auto;
	}
	#bubble .circles{
	    width: 12rem;
	    height: 12rem;
	    line-height: 12rem;
	    font-size: 2rem;
	    border-radius: 50%;
	    opacity: .7;
	    text-align: center;
	    cursor: pointer;
	}
	#bubble .circles:hover{
		opacity: .8;
	}
	@media only screen and (max-width: 450px){
		#bubble .circles{
		    width: 7rem;
		    height: 7rem;
		    line-height: 7rem;
		    font-size: 1.2rem;
		}
	}
</style>