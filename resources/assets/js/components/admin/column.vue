<template>
	<section>
    <div class="row">
	    <div class="col s12 m6" v-for="column in columns">
	      <div class="card" v-bind:class="column.color">
	        <div class="card-content white-text">
	          <span class="card-title">{{column.title}}</span>
	          <p>{{column.info}}</p>
	        </div>
	        <div class="card-action">
	            <div class="switch">
				    <label>
				      关
				      <input v-bind:checked="column.open" v-on:click="open(column.id)" type="checkbox">
				      <span class="lever"></span>
				      开
				    </label>
			    </div>
	        </div>
	      </div>
	    </div>
    </div>
	</section>
</template>

<script>
  export default {
  	  data () {
  	 	return {
  	 		columns:[]
  	 	}
  	 },
  	 mounted: function () {
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
		this.$http.post('/Api/column').then(function(response){
			this.columns = response.data;
		}, function(response){});
  	},
  	 methods: {
  	 	open(id){
			this.$http.post('/Api/opencolumn',{pid:id}).then(function(response){
			}, function(response){});
  	 	}
  	 }
  }
</script>
<style>
	.card .card-content p{
		font-size: 1.2rem;
	}
	.card-action{
		text-align: right;
	}
	.card-action .switch label{
		color: #FFFFFF;
	}
	.switch label input[type=checkbox]:checked+.lever{
		ackground-color: #46d08d;
	}
	.switch label input[type=checkbox]:checked+.lever:after{
		background-color: #FFFFFF;
    box-shadow: none;
	}
</style>