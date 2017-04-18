<template>
  <main id="components">
  <headers></headers>
  <asides></asides>
  <div id="content-box">
  	<transition name="fade">
	  <router-view></router-view>
	  </transition>
	  <footers></footers>
  </div>
  </main>
</template>

<script>
  import Headers from './header.vue'
  import Asides from './aside.vue'
  import Footers from './footer.vue'
  export default {
  	components:{
      Headers,Asides,Footers
  	},
    mounted: function () {
   	  $('#slide-out').perfectScrollbar();
   	  $('#content-box').perfectScrollbar();
			$('#table tbody').perfectScrollbar();
  	}
  }
</script>
<style>
	#components{
		padding-left: 250px;
		height: 100%;
	}
  @media only screen and (max-width : 992px) {
	 	#components{
	    padding-left: 0;
	  }
	  .logo{
	  	margin-left: 0!important;
	  }
	}
	#content-box{
    position: relative;
		overflow: hidden!important;
	  background: #fcfcfc;
	}
	.dropdown-menu{
		position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 160px;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #ccc;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 4px;
    -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
	}
	.open>.dropdown-menu{
    display: block;
	}
	.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu{
    top: auto;
    bottom: 100%;
    margin-bottom: 2px;
	}
	.fixed-table-pagination .dropup .dropdown-menu{
		margin-bottom: 0;
	}
	.dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
		color: #fff;
    text-decoration: none;
    background-color: #3a7596;
    outline: 0;
	}
	.dropdown-menu>li>a{
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
	}
	.btn .fa-sort-up{
		vertical-align: sub;
    font-size: 1rem;
	}
		.navigation{
	    background-color: #eeeeee;
    	padding: 20px;
	}
	.navigation h5{
		margin: 0;
		padding: 10px;
	}
	.navigation .bread.first{
		padding-left:15px;
	}
	.navigation .bread{
		color: #18A15F;
		font-size: 1.2rem;
	}
	.navigation .bread:last-child{
		color: #CCCCCC;
	}
	.navigation > .bread + .bread:before {
	    padding: 0 5px;
	    color: #ccc;
	    content: "/\00a0";
	}
	.preloader-load{
		overflow: hidden;
	}
	.ps-scrollbar-x-rail{
		display: none!important;
	}
	.fade-enter-active {
  transition: all 1s;
}
.fade-leave-active{
	transition: all 0.5s;
}
.fade-enter{
  transform:translateX(100%);
}
.fade-leave-active{
	transform-origin:0 0;
  transform:rotate(30deg);
 }
</style>