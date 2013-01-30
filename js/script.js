var url; 
function dd(id){
	post = $("#url_" + id).serialize();
	request = $.ajax({
		url: "/broqode/index.php/code/update",
		type: "POST",
		data: post,
		dataType: "html",
		success: function(){
		}
	});
	return false;
}
/*
$(document).ready(function(){
	$("#reg").hide();
	request = $.ajax({
		url: "/index.php/code",
		type: "POST",
		dataType: "html",
		success: function(url){
				url_cpy = url;
				url = "http://localhost/index.php/code/d/"+url;
			   	$("#qrStream").append("<img src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl="+url+"&choe=UTF-8&chld=L|0'/><form id='url_"+url_cpy+"' action='' onSubmit='return dd(\""+url_cpy+"\")' id='qrupdate'><input name='data' id='data' type='text'/><input type='hidden' name='id' value='"+url_cpy+"'><input type='submit' class='updtqr' value='Connect to Qr' /></form><h2>"+url+"</h2>");
				$("#genQr").remove();
  		}
	});  

   
}); */