<template>
  <section>
    	<div id="notetype-toolbar">
          <div class="pull-left">
				<h4>笔记本管理</h4>
				<a class="waves-effect waves-light btn" v-on:click="add()"><i class="fa fa-plus" aria-hidden="true"></i>添加</a>
				<!--<router-link to="/Admin/column"  class="waves-effect waves-light btn del"><i class="fa fa-minus" aria-hidden="true"></i>添加</router-link>-->
          </div>
        </div>
	  	<table id="notetype-table"  class="responsive-table"></table>
  </section>
</template>

<script>
	var $table;
    var TableInit = function () {
    var oTableInit = new Object();
    //初始化Table
    oTableInit.Init = function () {
        $table.bootstrapTable({
            url: '/Api/notetype',         //请求后台的URL（*）
            method: 'get',                      //请求方式（*）
            toolbar: '#notetype-toolbar',                //工具按钮用哪个容器
            striped: true,                      //是否显示行间隔色
            cache: false,                       //是否使用缓存，默认为true，所以一般情况下需要设置一下这个属性（*）
            pagination: true,                   //是否显示分页（*）
            sortOrder: "asc",                   //排序方式
            queryParams: oTableInit.queryParams,//传递参数（*）
            sidePagination: "client",           //分页方式：client客户端分页，server服务端分页（*）
            pageNumber:1,                       //初始化加载第一页，默认第一页
            pageSize: 10,                       //每页的记录行数（*）
            pageList: [10, 25, 50, 100],        //可供选择的每页的行数（*）
            search: true,                       //是否显示表格搜索，此搜索是客户端搜索，不会进服务端，所以，个人感觉意义不大
            strictSearch: true,
            //showColumns: true,                  //是否显示所有的列
            //showRefresh: true,                  //是否显示刷新按钮
            showExport: true,                     //是否显示导出
			exportDataType: "all", 							//导出全部
            minimumCountColumns: 2,             //最少允许的列数
            clickToSelect: false,                //是否启用点击选中行
            //height: 600,                        //行高，如果没有设置height属性，表格自动根据记录条数觉得表格高度
            uniqueId: "id",                     //每一行的唯一标识，一般为主键列 （感觉没啥用）
            cardView: false,                    //是否显示详细视图
            detailView: false,                   //是否显示父子表
            onEditableSave:onEditableSave,
            columns: [{
                field: 'id',
                title: 'ID',
                align: 'center'
            },{
                field: 'created_at',
                title: '创建时间'
            },{
                field: 'updated_at',
                title: '修改时间'
            },{
                field: 'title',
                title: '分类名称',
                align: 'center',
                editable:{
                		type: 'text',
                    title: '分类名称',
                    validate: function (v) {
                        if (!v) return '名称不能为空';

                    }
                },
            },{
                field: 'Operate',
                title: '操作',
                align: 'center',
                events: operateEvents,
				formatter:operateFormatter,
            },{
                field: 'Open',
                title: '审核状态',
                align: 'center',
                events: openEvents,
                formatter: openFormatter
            }]
        });
    };
    //编辑请求
    function onEditableSave(value, row, index){
      $.post('/Api/editnotetype',{id:row.id,title:row.title},
			function(data){},"json");
    }
    function openFormatter(value, row, index) {
    	var state=row.open;
    	if(state==1){
    		var check='checked';
    	}else{
    		var check;
    	}
    	return [
			  '<div class="switch">',
			    '<label>',
			      '<input '+check+' type="checkbox">',
			      '<span class="lever"></span>',
			    '</label>',
			  '</div>'
        ].join('');
    }
    function operateFormatter(value, row, index) {
    	return [
			'<a class="waves-effect waves-light btn remove">删除</a>'
        ].join('');
    }
    window.operateEvents = {
       'click .remove': function (e, value, row, index) {
           if (confirm('确定删除?')==true){
						$.post('/Api/delnotetype',{id:row.id,file:row.img},
							function(data){
								if(data.status==1){
						    	$table.bootstrapTable('remove', {
						        field: 'id',
						        values: [row.id]
						    	});
									alert(data.msg);
								}else{
									alert(data.msg);
								}
							},"json");
						}
        }
    };
    window.openEvents = {
        'click .lever': function (e, value, row, index) {
         	var $this = $(this);
	        var ch = $this.prev('input');
	        console.log(ch.is(':checked'));
	        if(ch.is(':checked')) {
						var open=0;
	        }else{
	          var open=1;
	        }
   	      $.post('/Api/opennotetype',{id:row.id,open:open},
				  function(data){},"json");
        }
    };
    return oTableInit;
};
  export default {
  	mounted: function () {
  	  $table = $('#notetype-table');
	    var oTable = new TableInit();
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
			$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
	    oTable.Init();
  	 },
   	methods: {
	 	add(){
			this.$http.post('/Api/addnotetype').then(function(response){
				if(response.data.status==1){
					$table.bootstrapTable('refresh');
				}
				alert(response.data.msg);
			}, function(response){});
	 	},
 	}
  }
</script>
<style>
.pull-left i{
	font-size: 0.9rem;
	margin-right: 0.5rem;
}
.bootstrap-table{
	width: 95%;
	margin: 1rem auto;
}
.fixed-table-container{
	border: 0;
}

h4{
	color: #3a7596;
}
thead{
	font-size: 1rem;
	font-weight: bold;
}
tbody{
	font-size: 1rem;
}
th{
	border-bottom: 0!important;
}
th,td{
	border-left: none!important;
}
.fht-cell{
  border-bottom: 1px solid #111;
	width: 99%;
	margin: 0 auto;
}
.pull-left{
	font-size: 1rem;
}
.pull-left .btn{
    height: 2.5rem;
    line-height: 2.5rem;
}
.pull-left .btn.del{
	  background-image: linear-gradient(to bottom,#ee5f5b,#bd362f);
}
.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
    background-color: #3a7596;
    border-color: #3a7596;
}
.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #f2f2f2;
}
@media only screen and (max-width: 992px){
	.responsive-table .fht-cell{
		display: none;
	}
	.responsive-table thead th{
		height: auto;
		text-align: center;
	}
	.responsive-table thead th .th-inner{
		padding: 0;
		line-height: 1rem;
	}
}
td .btn{
  background-image: linear-gradient(to bottom,#68bff1,#3a7596);
  padding: 0 20px;
	height: auto;
	font-size: 0.9rem;
}
.dropdown-toggle{
	background-color: #3a7596;
}
</style>