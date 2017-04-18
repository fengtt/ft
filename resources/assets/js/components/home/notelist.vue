<template>
	<div class="row">
		<div class="col s12">
			<a class="back-note" v-on:click="back()"><i class="fa fa-home"></i></a>
			<h3>Totall: 43</h3>
			<section id="cd-timeline" class="cd-container">
				<div class="cd-timeline-block" v-for="note in notes">
					<div class="cd-timeline-img"></div>
					<div class="cd-timeline-content  card hoverable">
						<label>{{notetype.title}}</label>
						<h2>{{note.title}}</h2>
						<p>{{note.info}}</p>
						<router-link :to="{name:'notedetail',params:{id:id}}" class="cd-read-more">阅读全文</router-link>
						<span class="cd-date">{{note.created_at}}</span>
					</div>
				</div>
			</section>
		</div>	
	</div>
</template>

<script>
  export default {
	data () {
  		return {
  			id:this.$route.params.id.split(".")[0],
  			notetype:'',
  			notes:[],
  			color:[
			'#f44336', '#e91e63', '#9c27b0',
			'#673ab7', '#3f51b5', '#2196f3',
			'#03a9f4', '#00bcd4', '#009688',
			'#4caf50', '#8bc34a', '#cddc39',
			'#ffeb3b', '#ffc107', '#ff9800',
			'#ff5722', '#795548', '#9e9e9e',
			'#607d8b'
			]
  		}
	},
    mounted: function() {
    	$('html, body').css({'height':'100%','overflow':'hidden'});
    	$('.row').perfectScrollbar();
    	var id = this.$route.params.id.split(".")[0];
    	var color = this.$route.params.id.split(".")[1];
    	$("body").css("background",this.color[color]);
		this.$http.post('/Api/notetypebyid',{id:id}).then(function(response){
	 			this.notetype = response.data;
		}, function(response){});
		this.$http.post('/Api/notes',{id:id}).then(function(response){
	 			this.notes = response.data;
		}, function(response){});
  	},
  	methods: {
  		back(){
  			this.$router.go(-1);
  		}
  	},
  	beforeDestroy: function(){
  		$('html, body').attr('style','');
    	$("body").css("background","#FFFFFF");
  	}
  }
</script>
<style scoped>
	.row{
		height: 100%;
		overflow: hidden!important;
	}
	h3{
		color: #FFFFFF;
		text-align: center;
	}
	.back-note{
		position: absolute;
	    color: #fff;
	    font-size: 3rem;
	    right: 3rem;
	    top: 2rem;
	    z-index: 999;
	    cursor: pointer;
	}
	.cd-timeline-content label{
	    background: #18a15f;
	    padding: 5px 10px;
	    color: #fff;
	}
	.cd-timeline-block:nth-child(even) .cd-timeline-content label{
		float: right;
	}
</style>