<template>
  <div class="navbar-fixed">
	  <nav>
	    <div class="nav-wrapper container">
	      <a href="#!" class="brand-logo">Feather Tag</a>
	      <a href="#" data-activates="mobile" class="button-collapse"><i class="fa fa-list"></i></a>
	      <ul class="right hide-on-med-and-down">
	        <li><a href="#slider">主页</a></li>
	        <li><a href="#skill">专业技能</a></li>
	        <li><a href="#note">学习笔记</a></li>
	        <li><a href="#user">个人简介</a></li>
	        <li><a href="#reply">与我联系</a></li>
	      </ul>
	      <ul class="side-nav" id="mobile">
          <li><a href="#slider">主页</a></li>
	        <li><a href="#skill">专业技能</a></li>
	        <li><a href="#note">学习笔记</a></li>
	        <li><a href="#user">个人简介</a></li>
	        <li><a href="#reply">与我联系</a></li>
	      </ul>
	    </div>
	  </nav>
  </div>
</template>

<script>
  export default {
    mounted: function () {
    	 $(".button-collapse").sideNav();
  	}
  }
</script>
<style scoped>
	nav{
		background: #18A15F;
	    opacity: 0.8;
	}
	.navbar-fixed{
		position: fixed;
	}
</style>