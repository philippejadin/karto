$(document).ready(function(){
	$("#contact").keyup(function(){
		$.ajax({
			type:'GET',
			url:'monAdresse',
			data : contactParam:$("#contact").val()
			}
		});
		.success(function(ParamData){
			$("#listContact").html(ParamData);
			var res = JSON.parse(ParamData);
			for (var i = 0;i<res.length;i++) {
				console.log(res[i].name);
			}
		});
	});
};