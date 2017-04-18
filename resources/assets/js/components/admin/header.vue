<template>
    <nav>
	    <div class="nav-wrapper">
	      <a href="#!" class="brand-logo"><img width="35px" class="logo" :src="logoSrc">Feather Tag</a>
	      <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-list"></i></a>
	      <ul class="right hide-on-med-and-down">
	        <li><i class="fa fa-sign-out material-icons" v-on:click="logout()"></i></li>
	      </ul>
	    </div>
  	</nav>
</template>

<script>
  $( document ).ready(function(){
  	$(".button-collapse").sideNav();
  })
  export default {
  	data () {
      return {
      	logoSrc: '../../Common/img/logo.png'
      }
   },
   methods:{
     logout(){
     	if (confirm('确定登出?')==true){
			this.$http.post('/Api/logout').then(function(response){
				if(response.data = 1){
					this.$router.push('../login');
				}
			}, function(response){});
		}
     }
   }
  }
</script>

<style scoped>
	.logo{
		vertical-align: middle;
		margin-left: 1rem;
	}
	.brand-logo{
		left: 0;
	}
	.nav-wrapper form{
	    width: 50%;
	    background: #46d08d;
	    float: left;
	    margin-left: 25%;
	}
	nav{
		background: #18A15F;
	}
	.right i{
		cursor: pointer;
		margin-right: 30px;
	    font-size: 30px!important;
	}
	.try{
		width: 100px;
		height: 100px;
		background: red;
	}
	@media only screen and (max-width: 992px) {
	 	.nav-wrapper form{
			display: none;
		}
	}
</style>