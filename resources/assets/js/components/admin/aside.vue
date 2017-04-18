<template>
  <aside>
    <ul id="slide-out" class="side-nav fixed collapsible"  data-collapsible="accordion">
	    <li>
	    	<div class="userView">
		      <div class="background">
		      	<img :src="userbg">
		      </div>
		      <a href="#!user" style="display: inline-block;vertical-align: bottom;margin-right: 5px;"><img class="circle" :src="userimg"></a>
		      <div class="user-info">
		      <a href="#!name"><span class="white-text name">Feather Tag</span></a>
		      <a href="#!email"><span class="white-text email">Administrator</span></a>
					</div>    
	      </div>
	    </li>
	    <li><router-link to="/Admin/index" class="collapsible-header waves-effect waves-green"><i class="fa fa-home"></i>主页</router-link></li>
	    <li>
	    	 <a class="collapsible-header waves-effect waves-green has-more"><i class="fa fa-cogs"></i>系统管理<i class="fa fa-angle-right"></i></a >
				 <div class="collapsible-body">
				 	<ul>
				 		<li><router-link to="/Admin/column" class="waves-effect waves-green">栏目管理</router-link></li>
				 		<li><router-link to="/Admin/slider" class="waves-effect waves-green">滚动图管理</router-link></li>
				 	</ul>
				 </div>
	    </li>
	    <li>
	    	 <a class="collapsible-header waves-effect waves-green has-more"><i class="fa fa-star"></i>用户管理<i class="fa fa-angle-right"></i></a >
				 <div class="collapsible-body">
				 	<ul>
				 		<li><router-link to="/Admin/user" class="waves-effect waves-green">个人简历</router-link></li>
				 		<li><router-link to="/Admin/skill"  class="waves-effect waves-green">专业技能</router-link></li>
				 		<li><router-link to="/Admin/mdpwd"  class="waves-effect waves-green">修改密码</router-link></li>
				 	</ul>
				 </div>
	    </li>
	    <li>
	    	 <a class="collapsible-header waves-effect waves-green has-more"><i class="fa fa-pencil"></i>笔记管理<i class="fa fa-angle-right"></i></a >
				 <div class="collapsible-body">
				 	<ul>
				 		<li><router-link to="/Admin/notetype"  class="waves-effect waves-green">笔记本管理</router-link></li>
				 		<li><router-link to="/Admin/note"  class="waves-effect waves-green">笔记管理</router-link></li>
				 	</ul>
				 </div>
	    </li>
	    <li>
	    	<a class="collapsible-header waves-effect waves-green has-more"><i class="fa fa-comment"></i>联系管理<i class="fa fa-angle-right"></i></a >
				 <div class="collapsible-body">
				 	<ul>
				 		<li><router-link to="/Admin/social"  class="waves-effect waves-green">联系方式管理</router-link></li>
				 		<li><router-link to="/Admin/reply"  class="waves-effect waves-green">留言管理</router-link></li>
				 	</ul>
				 </div>
	    </li>
    </ul>
  </aside>
</template>

<script>
  export default {
  	data () {
      return {
      	userbg: '../../Admin/img/user-bg.png',
      	userimg:'../../Admin/img/dog.jpg'
      }
   },
    mounted: function () {
	  	$(".button-collapse").sideNav({
	  		draggable: true
	  	});
	  	$(".collapsible").collapsible();
		  $("#slide-out li a.waves-effect").click(function(){
					if(!$(".button-collapse").is(":hidden")&&!$(this).hasClass("has-more")){
						$(".button-collapse").sideNav("hide");
					}
			});
			$(".router-link-active").parents(".collapsible-body").prev().addClass('active');
			$(".router-link-active").parents(".collapsible-body").show();
  	}
  }
</script>
<style>
	.side-nav{
		width: 250px;
	}
	#slide-out{
		overflow: hidden!important;
	}
	#slide-out i{
		font-size: 1.5rem;
	}
	#slide-out .waves-effect{
		padding: 0 32px;
	}
	#slide-out .waves-effect .fa-angle-right{
    float: right;
    margin-right: 0;
    font-size: 1.2rem;
    transition: all 0.5s;
	}
	#slide-out .active,#slide-out .active i{
		color: #18A15F!important;
	}
	#slide-out .active .fa-angle-right{
		 transform: rotate(90deg);
	}
	#slide-out .collapsible-body{
    padding: 0 0;
    font-size: 1.2rem;
	}
	.collapsible{
		border: 0;
	}
	.collapsible-body li a{
		padding: 0 45px!important;
	}
  .router-link-active{
		background-color: rgba(0,0,0,0.05)!important;
	}
  .router-link-active,.router-link-active>i{
		color: #18A15F!important;
	}
	.userView{
		padding: 1.5rem!important;
    text-align: center;
	}
	.user-info{
		display: inline-block;
	}
	.user-info a{
		 height: auto;
		 padding: 0;
	}
	.user-info a .name{
		padding-top: 0px!important;
	}
	.user-info a .email{
		padding-bottom: 0px!important;
	}
</style>