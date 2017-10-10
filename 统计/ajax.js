function tongji(){
	//alert('asdf');
	
	var url = window.location.href;
	$.ajax({
		url:'http://www.mmvau.com/uc3/33/ajax.php/',
		//url:'xx.php',
		dataType:'jsonp',
		type:'GET',
		//data:'customer_phone='+customer_phone,
		data:'url='+url,
		success: function(data) {
			//alert(data);
		}
	});

	setTimeout("tiaozhuang()",100);//跳转到微信
	
}

function tiaozhuang(){
	 window.location.href='weixin://';
}
