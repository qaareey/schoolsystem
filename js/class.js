$(".getlink").click(function (e){

	e.preventDefault();

	var url = $(this).attr("href");

	//alert(url);

	$.post(url,function(data){
		$(".form-place").html(data);
	})
});

$("body").delegate(".form-data","submit",function(e){

	//alert(1);
	e.preventDefault();
	var url = $(this).attr("action");

	$.ajax({

		url: url,
		data: new FormData(this),
		processData: false,
		contentType: false,
		type: "POST",
		success : function(res){
			//alert(res);

            var msg = res.split("|");

			$(".form-response").html(res);

			if(msg == "success"){
				$(this).trigger("reset");
			}
		}
	})
})