<template>
	<section class="skill">
   		<div class="navigation col s12">
	    	<h5>专业技能</h5>
	     	<a href="#!" class="bread first">用户管理</a>
	      	<a href="#!" class="bread">专业技能</a>
    	</div>
	   <form>
	    <p class="range-field"  v-for="skill in skills">
	      <span class="range">{{skill.name}}<i class="fa fa-close" aria-hidden="true" v-on:click="del(skill.id)"></i></span><input type="range" v-bind:style="{backgroundSize:skill.plan+'% 100%'}" v-model="skill.plan" min="0" max="100" />
	    </p>
	    <p v-if="show" class="range-field">
	      <span><input v-model="addname" v-on:blur="runadd()" autofocus/></span><input type="range" value="0" min="0" max="100" />
	    </p>
	    <div class="add" v-on:click="add">添加一行</div>
	   </form>
	</section>
</template>

<script>
  export default {
  	 data () {
  	 	return {
  	 		skills:[],
  	 		show:false,
  	 		addname:""
  	 	}
  	 },
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
		this.$http.post('/Api/skills').then(function(response){
			this.skills = response.data;
		}, function(response){});
  	 },
  	 methods: {
  	 	add(){
  	 		this.show = true;
  	 	},
  	 	runadd(){
  	 		if(this.addname){
				this.$http.post('/Api/addskill',{name:this.addname}).then(function(response){
					this.skills = response.data;
					this.addname = "";
					this.show = false;
				}, function(response){});
	  	 	}else{
	  	 			this.show = false;
	  	 	}
  	 	},
  	 	revisePlan(id,plan){
			this.$http.post('/Api/reviseplan',{id:id,plan:plan}).then(function(response){
			}, function(response){});
  	 	},
  	 	del(id){
  	 		if (confirm('确定删除?')==true){
				this.$http.post('/Api/delskill',{id:id}).then(function(response){
					this.skills = response.data;
				}, function(response){});
  	 		}
  	 	}
  	 },
     computed:{
	    skillRest:function(){
	       var obj = {};
	       for(var i = 0; i < this.skills.length; i++) obj[i]=this.skills[i].plan;
	       return obj;
	    }
     },
  	 watch: {
	    skillRest:{
	       handler:function(nowVal,oldVal){
	       	if(!(oldVal[0]==undefined)){	
       		    for(var i = 0; i < this.skills.length; i++){
		         	if(nowVal[i] != oldVal[i])  this.revisePlan(this.skills[i].id,nowVal[i]);
		        }
	       	}
	       },
	       deep:true
	    }
  	}
  }
</script>
<style scoped>
	.skill form{
		width: 80%;
		margin: 1rem auto 0;
	}
	.skill form span{
	    font-size: 1.3rem;
	    display: inline-block;
	    float: left;
	}
	.skill form span:hover>i{
		opacity: 1;
	}
	.skill form span i{
		font-size: 1rem;
	    color: #c2c0c2;
		cursor: pointer;
		padding-left: 10px;
    	vertical-align: top;
    	opacity: 0;
	}
	.skill input[type=range]{
	    width: 100%;
	    border-radius: 10px;
	    background: -webkit-linear-gradient(#18a15f, #18a15f) no-repeat,#ddd;
	    background-size: 0% 100%;
	}
	input[type=range]:focus {
    	outline: none!important;
	}
	.skill .add{
		font-size: 1.3rem;
		color: #c2c0c2;
		cursor: pointer;
	}
	input[type=range]::-webkit-slider-runnable-track{
	    height: 15px;
	    border-radius: 10px; /*将轨道设为圆角的*/
	}
	input[type=range]::-moz-range-track{
	    height: 15px;
	    border-radius: 10px; /*将轨道设为圆角的*/
	}
	input[type=range]::-moz-range-progress {
	    background: -webkit-linear-gradient(#18a15f, #18a15f) no-repeat, #ddd;
	    height: 15px;    
    	border-radius: 10px;
    	border-top-right-radius: 0;
		border-bottom-right-radius: 0;
	}
</style>