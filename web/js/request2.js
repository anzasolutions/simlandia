var count = 0;

$(document).ready(function(){
	$("#refresh").click(function(event) {
		event.preventDefault();
		alert("ss");
		callMe();
	});
	//window.setInterval(callMe, 6000);
	/* $('#description').load(function() {
		window.setInterval(callMe, 6000);
	}); */
});

function callMe()
{	
	$.post("http://localhost/simlandia/main/callUser",
	function(data){
		alert(data.length);
		for (var i = 0; i < data.length; i++)
		{
			$('#description').html(data.returnValue + data.ret2);
		}
		
		
		//$('#description').html(data.returnValue + data.ret2);
	}, "json");
}

function callMe2()
{
	$.post("http://localhost/simlandia/main/callUser",
	function(data){
		$('#description').html(data);
	});
}