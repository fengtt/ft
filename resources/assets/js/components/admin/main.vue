<template>
	<section>
		<div class="row" style="height:360px;">
			<div id="chart1" class="col s12 m12 l12 card" style="height: 100%;"></div>
 		</div>	
 		<div class="card-stats">
 			<div class="row">
	 		<div class="col s12 m6 l4">
	 			<div class="card" style="background: #FF7E67;">
	 				<div id="chart2" style="width: 100%;height: 80%"></div>
	 				<p class="card-stats-title"><span class="counter">645</span>  访问总量</p>
	 			</div>
	 		</div>
	 		<div class="col s12 m6 l4">
	 			<div class="card" style="background: #F5FC9E;">
	 				<div id="chart3" style="width: 100%;height: 80%"></div>
	 				<p class="card-stats-title" style="color: #9EFCB4;"><span class="counter">876</span>  笔记总数 </p>
	 			</div>
	 		</div>
	 		<div class="col s12 m6 l4">
	 			<div class="card" style="background: #466baf;">
	 				<a class="card-stats-i valign-wrapper"><i class="fa fa-leaf valign"></i></a>
	 				<p class="card-stats-title"><span class="counter">206</span>  留言总数</p>
	 			</div>
	 		</div>

 			</div>
 		</div>
	</section>
</template>

<script>
  require('../../../../../public/Common/js/jquery.countup.js');
  export default {
  	mounted:function(){
  	 	var content_height=$(window).height()-$("nav").height();
  	 	var section_height=content_height-$("footer").height();
		$('#content-box').css('height',content_height);
  		$('section').css('min-height',section_height);
  		$('#content-box>.ps-scrollbar-y-rail').css('top',0);
  		$('.counter').countUp();
  		/*每月访问量*/
		var myChart1 = echarts.init(document.getElementById('chart1'));
		var option1 = {
			color:['#F2F062'],
			textStyle:{
				color:'#ffffff'
			},
		    title: {
		        text: '网站每月访问量',
		        subtext: 'Feather Tag',
		    	textStyle:{
					color:'#ffffff'
				},
		    },
		    tooltip: {
		        trigger: 'axis'
		    },
		    legend: {
		        data:['总人数']
		    },
		    xAxis:  {
		        type: 'category',
		        boundaryGap: false,
		        data: ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
		        axisLine:{
		        	lineStyle:{
		        		color:'#fff'
		        	}
		        },
		        axisTick:{
		        	show:false
		        }
		    },
		    yAxis: {
		        type: 'value',
		        axisLabel: {
		            formatter: '{value} 人'
		        },
		        splitLine:{
		        	show:false
		        },
		        axisLine:{
		        	lineStyle:{
		        		color:'#fff'
		        	}
		        }
		    },
		    series: [
		        {
		            name:'最高人数',
		            type:'line',
		            data:[110, 212, 150, 230, 120, 330, 100,111,231,421,123,189],
		            markLine: {
		                data: [
		                    {type: 'average', name: '平均值'}
		                ]
		            },
		            symbolSize:14,
		            smooth: true,
		            areaStyle: {normal: {
		            	color:'#18a15f'
		            }},
		            lineStyle:{
		            	normal:{
		            		width: 4
		            	}
		            }
		        }
		    ]
		};
      	myChart1.setOption(option1);
      	/*访问总量*/
      	var myChart2 = echarts.init(document.getElementById('chart2'));
		    var  option2 = {
		    tooltip: {
		        trigger: 'item',
		        formatter: "{a} <br/>{b}: {c} ({d}%)"
		    },
		    legend: {
		        orient: 'vertical',
		        x: 'left',
		        data:['web访问','手机访问'],
		        textStyle:{
		        	color:'#ffffff'
		        }
		    },
		    series: [
		        {
		            name:'访问来源',
		            type:'pie',
		            radius: ['40%', '70%'],
		            avoidLabelOverlap: false,
		            label: {
		                normal: {
		                    show: false,
		                    position: 'center'
		                },
		                emphasis: {
		                    show: true,
		                    textStyle: {
		                        fontSize: '14'
		                    }
		                }
		            },
		            labelLine: {
		                normal: {
		                    show: false
		                }
		            },
		            data:[
		                {
		                	value:335,
		                	name:'web访问',
						    itemStyle: {
							    normal: {
							        // 设置扇形的颜色
							        color: '#A2D5F2',
							        shadowBlur: 200,
							        shadowColor: 'rgba(255, 255, 255, 0.5)'
							    }
							}
		                },
		                {
		                	value:310,
		                	name:'手机访问',
						    itemStyle: {
							    normal: {
							        // 设置扇形的颜色
							        color: '#07689F',
							        shadowBlur: 200,
							        shadowColor: 'rgba(255, 255, 255, 0.5)'
							    }
							}
		                },
		            ]
		        }
		    ]
		};
		myChart2.setOption(option2);
		/*笔记总数*/
		var myChart3 = echarts.init(document.getElementById('chart3'));
		myChart3.setOption({
		    series : [
		        {
		            name: '访问来源',
		            type: 'pie',
		            radius: '70%',
		            roseType: 'angle',
		            data:[
		                {value:400, name:'PHP'},
		                {value:335, name:'JAVA'},
		                {value:310, name:'C#'},
		                {value:274, name:'JS'},
		                {value:235, name:'PYTHON'}
		            ]
		        }
		    ],
		    itemStyle: {
    normal: {
        // 阴影的大小
        shadowBlur: 200,
        // 阴影水平方向上的偏移
        shadowOffsetX: 0,
        // 阴影垂直方向上的偏移
        shadowOffsetY: 0,
        // 阴影颜色
        shadowColor: 'rgba(255, 255, 255, 0.5)'
    }
}
		})
  	}
  }
</script>
<style>	
	#chart1{
		margin: 0;
		background: #199258!important;
		border-radius: 0!important;
	}
    .card-stats .col .card{
    	height: 170px;
    	margin: 0;
    	margin-bottom: 1rem;
    }
    .card-stats-title{
    	text-align: center;
    	color: #FFFFFF;
    	font-size: 1.5rem;
	    font-weight: bold;
    }
    .card-stats-i{
	    color: #fff;
	    height: 80%;
    }
    .card-stats-i i{
    	font-size: 5rem;
    	margin: 0 auto;
    }
</style>