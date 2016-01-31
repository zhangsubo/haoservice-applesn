$(document).ready(function(e) {
        $(".btn").click(function(){

			$(this).val("查询中...").attr("disabled","disabled");
			$(".result").html('');
			var sn = $("#sn").val();

			if(checkSN(sn)){
				$.getJSON('do.php?sn='+sn,function(o){
					if(o.error_code =='0'){
						var data = o.result;
						var html ='<div class="show">'+
								  '<div class="left">结果由蓝点科技提供</div><div class="right"><ul><li>'+data.Model+'</li>'+
								  '<li>产品全称：'+data.exName+'</li>'+
								  '<li>序列号：'+data.Key+'</li>'+
								  '<li>生产日期：'+data.MakeTime+'</li>'+
								  '<li>产地：'+data.MakeLocation+'</li>'+
								  '<li>硬件保修状态：'+data.Repairs+'</li>'+
								  '<li>电话支持服务状态:'+data.Telephone+'</li>'+
								  '<li>产品激活状态:'+data.Active+'</li>'+
								  '<li>产品颜色：'+data.Color+'</li>'+
								  '<li>产品容量：'+data.Size+'</li>'+
								  '</ul>'+
								  '</div>'+
								  '<div class="clearfix"></div>'+
								  '</div>';
							$(".result").html(html);
							$(".btn").val("查询").removeAttr("disabled");

					}else{
						$(".result").html("<div class=\"tips\">"+o.reason+"</div>");
						$(".btn").val("查询").removeAttr("disabled");
					}
				})
			}else{
				$(".result").html("<div class=\"tips\">请输入正确的SN/IMEI</div>");
				$(".btn").val("查询").removeAttr("disabled");
			}

		})
    });

	function checkSN(sn){
		var myreg=/^[\w]{8,}$/;
		if(!myreg.test(sn)){
			return false;
		}
		return true;
	}
