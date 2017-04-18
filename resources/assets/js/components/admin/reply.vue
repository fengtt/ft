<template>
  <section>
        	<div id="reply-toolbar">
	          <div class="pull-left">
					<h4>留言管理</h4>
	          </div>
          </div>
	  	<table id="reply-table"  class="responsive-table"></table>
  </section>
</template>

<script>
	  var $table;
    var TableInit = function () {
    var oTableInit = new Object();
    //初始化Table
    oTableInit.Init = function () {
        $table.bootstrapTable({
            url: '/Api/reply',         //请求后台的URL（*）
            method: 'get',                      //请求方式（*）
            toolbar: '#reply-toolbar',                //工具按钮用哪个容器
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
            columns: [{
                field: 'id',
                title: 'ID',
                align: 'center'
            },{
                field: 'name',
                title: '留言者姓名',
            },{
                field: 'email',
                title: '留言者邮箱',
            },{
                field: 'theme',
                title: '留言主题',
            },{
                field: 'content',
                title: '留言内容',
            },{
                field: 'created_at',
                title: '创建时间'
            },{
                field: 'updated_at',
                title: '修改时间'
            },{
                field: 'Open',
                title: '审核状态',
                align: 'center',
                events: openEvents,
                formatter: openFormatter
            }]
        });
    };

    //在table表里写dom结构
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
   	      $.post('/Api/openreply',{id:row.id,open:open},
				  function(data){},"json");
        }
    };
    return oTableInit;
};
  export default {
  	 mounted: function () {
  	  $table = $('#reply-table');
	    var oTable = new TableInit();
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
  	 	$('#content-box>.ps-scrollbar-y-rail').css('top',0);
		  $('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
	    oTable.Init();
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