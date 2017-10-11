 document.write(”<script language=javascript src=’http://order.mmvcc.com:4580/Public/js/jquery.js’></script>”);

//添加客户资料
$(document).ready(function(){
	$('.customer_save').click(function(){
		   //alert('adsfds');
			var customer_phone='1';
			$.ajax({
				url:'test.php',
				dataType:'json',
				type:'POST',
				data:'customer_phone='+customer_phone,
				success: function(data) {
					alert(data);
				}
			});
			
		}
	);
})