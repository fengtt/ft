<template>
	<section class="note">
		<div id="noteList">
			<select v-model="notetype">
			 <option v-for="option in options" v-bind:value="option.value">
			  {{option.text}}
			 </option>
			</select>
			<div class="add">
				<i class="fa fa-plus" aria-hidden="true" v-on:click="add()"></i>
			</div>
			<div class="card"  v-for="notedata in notedatas" v-bind:class="{'note_active':notedata.id==id}" v-bind:id="notedata.id" v-on:click="show(notedata.id)">
              	<div class="card-content">
	                <span class="card-title">{{notedata.title}}</span>
	              	<p>{{notedata.info}}</p>
	          	</div>
	            <div class="card-action">
					<span><i class="fa fa-book"></i>{{typename[notetype]}}</span>
					<span><i class="fa fa-clock-o"></i>{{notedata.updated_at}}</span>
	            </div>
			</div>
		</div>
		<div id="note">
			<div class="note-toolbar">
			    <div class="input-field">
		          <input id="icon_prefix"  v-on:blur="edit()"  v-model="title"  type="text" class="validate">
		          <label for="icon_prefix">标题</label>
		        </div>
			    <div class="input-field">
		          <input id="icon_prefix"  v-on:blur="edit()"  v-model="info"  type="text" class="validate">
		          <label for="icon_prefix">简要信息</label>
		        </div>
		        <div class="note-dateinfo">
		        	<i class="fa fa-arrow-left" aria-hidden="true" v-on:click="back()"  v-show="left"></i>
		        	<span>创建: <span>{{created_at}}</span></span>
		        	<span style="margin-left: 1rem;">修改: <span>{{updated_at}}</span></span>
		        	<i class="fa fa-trash" aria-hidden="true" v-on:click="del()"></i>
		        </div>
			</div>
		    <div id="noteEditor">
			</div>
		</div>
	</section>
</template>

<script>
	var editor;
  export default {
  	data(){
  		return {
  			id:'',
  			pid:'',
  			notetype:'',
  			typename:[],
		    options: [],
		    notedatas:[],
		    title:'',
		    info:'',
		    created_at:'',
		    updated_at:'',
		    width:'',
		    left:false
  		}
  	},
  	 mounted: function () {
		var self = this;
  	 	var section_height = $(window).height()-$("nav").height();
  	 	this.width = $(window).width();
  	 	if(this.width>768){
	  	 	$("nav").hide();
	  	 	section_height = $(window).height();
  	 	}else{
  	 		this.left = true;
  	 	}
  	 	$("footer").hide();
  	 	$('#content-box').css('height',section_height);
  		$('section').css('height',section_height);
		$('#noteList').perfectScrollbar();
  		editor = UE.getEditor('noteEditor', {
			initialFrameHeight : section_height-260,
			scaleEnabled:true,
			elementPathEnabled:false,
		});
		editor.addListener('blur',function(){
			self.$http.post('/Api/editnote',{id:self.id,title:self.title,info:self.info,content:editor.getContent()}).then(function(response){
				this.updated_at = response.data.updated_at;
				Materialize.toast('编辑成功!', 2000);
			}, function(response){});
		});
		this.$http.post('/Api/notetype').then(function(response){
			for (var i = 0; i < response.data.length; i++) {
				this.options[i]={text:response.data[i].title,value:response.data[i].id};
				this.typename[response.data[i].id]=response.data[i].name;
			}
			this.notetype=response.data[0].id;
		}, function(response){});
  	},
  	 methods: {
  	 	show(id){
  	 		if(this.width<768){
  	 			$("#noteList").hide();
	  	 		$("#note").show();	
  	 		}
			this.id = id;
	 		this.$http.post('/Api/note',{id:id}).then(function(response){
				this.title = response.data.title;
				this.info = response.data.info;
				$(".validate").next().addClass('active');
				editor.setContent(response.data.content);
				this.created_at = response.data.created_at;
				this.updated_at = response.data.updated_at;
			}, function(response){});
  	 	},
  	 	edit(){
  	 		for (var i = 0; i < this.notedatas.length; i++) {
  	 			if(this.notedatas[i].id==this.id){
  	 				this.notedatas[i].title=this.title;
  	 				this.notedatas[i].info=this.info;
  	 			}
  	 		}
			this.$http.post('/Api/editnote',{id:this.id,title:this.title,info:this.info,content:editor.getContent()}).then(function(response){
				this.updated_at = response.data.updated_at;
			}, function(response){});
  	 	},
  	 	del(){
  	 		if (confirm('确定删除?')==true){
				this.$http.post('/Api/delnote',{id:this.id,pid:this.pid}).then(function(response){
					alert(response.data.msg);
					if(response.data.status==1){
						this.notedatas=response.data.notedatas;
						if(response.data.notedatas.length>0){
							this.id = response.data.notedatas[0].id;
							this.title = response.data.notedatas[0].title;
							this.info = response.data.notedatas[0].info;
							editor.setContent(response.data.notedatas[0].content);
							this.created_at = response.data.notedatas[0].created_at;
							this.updated_at = response.data.notedatas[0].updated_at;
						}else{
							this.title = '';
							this.info = '';
							editor.setContent('');
						}
					}
				}, function(response){});
  	 		}
  	 	},
  	 	back(){
	  	 	$("#note").hide();
 			$("#noteList").show();
  	 	},
  	 	add(){
			this.$http.post('/Api/addnote',{pid:this.pid}).then(function(response){
				this.notedatas=response.data.notedatas;
				this.show(response.data.id);
			}, function(response){});
  	 	}
  	 },
  	 watch: {
  	 	notetype:function(nowVal,oldVal){
  	 		this.pid = nowVal;
  	 		this.$http.post('/Api/notes',{id:nowVal}).then(function(response){
			    this.notedatas=response.data;
				if(response.data.length>0){
					this.id = response.data[0].id;
					this.title = response.data[0].title;
					this.info = response.data[0].info;
					$(".validate").next().addClass('active');
					editor.setContent(response.data[0].content);
					this.created_at = response.data[0].created_at;
					this.updated_at = response.data[0].updated_at;
				}else{
					this.title = '';
					this.info = '';
					editor.setContent('');
				}
			}, function(response){});
  		 }
  	 },
	beforeDestroy: function() {
		editor.setHide()
		editor.destroy();
		$("nav").show();
		$("footer").show();
	}
  }
</script>
<style>
	.note{
		position: relative;
	}
	#noteList{
		position: relative;
		height: 100%;
		width: 20%;
		float: left;
		overflow: hidden!important;
	}
	#note{
		height: 100%;
		width: 80%;
		float: right;
	}
	@media only screen and (max-width: 768px){
		#noteList{
			width: 100%;
		}
		#note{
			width: 100%;
			display: none;
		}
		.note-dateinfo{
			padding-top: 1rem!important;
    		padding-bottom: 1rem!important;
			font-size: .5rem!important;
		}
	}
	
	select{
	    display: block;
	    background: #EEEEEF;
	    font-size: 1rem;
	    height: 2.5rem;
	}
	select:focus{
		outline: none;
	}
	select option{
		background: #FFFFFF;
	}
	.note .card{
		margin: .5rem;
		color: #666;
		cursor: pointer;
	}
	.note .card.note_active{
		background: #18A15F;
		color: #FFFFFF;
		opacity: .8;
	}
	.note .card:hover{
		background: #DDDDDD;
	}
	.note .card.note_active:hover{
		background: #18A15F;
	}
	.note .card .card-content{
		padding: 10px;
	}
	.note .card .card-title{
	    font-size: 1.2rem;
	    line-height: 1.2rem;
	    padding-bottom: 3px;
		border-bottom: 1px dashed #ebeff2;
	}
	.note .card .card-content p{
		font-size: 1rem;
	}
	.note .card .card-action{
		font-size: .5rem;
		text-align: left;
		padding: 10px;
	}
	.note .card .card-action i{
		margin-right: 3px;
	}
	.note-toolbar #icon_prefix{
		margin-bottom: 2px;
	}
	.note-dateinfo{
		background: #EEEEEF;
	    font-size: 1rem;
    	padding: .5rem;
	}
	.note .edui-default td{
		padding: 7px 5px;
	}
	.note-dateinfo i{
		float: right;
		margin-right: 1rem;
		cursor: pointer;
		transition: transform .5s;
	}
	.note-dateinfo i:hover{
		color: #18A15F;
		opacity: .8;
		transform: scale(1.2);
	}
	.note-dateinfo i.fa-arrow-left{
		float: left;
		color: #18A15F;
	}
	#noteList .add{
		text-align: center;
	    cursor: pointer;
	    padding: 1rem;
	}
	#noteList .fa-plus{
	    color: #eee;
	    font-size: 3rem;
        transition: transform 1s;
	}
	#noteList .add:hover>.fa-plus{
		color: #18A15F;
		opacity: .8;
		transform: rotate(90deg);
	}
</style>