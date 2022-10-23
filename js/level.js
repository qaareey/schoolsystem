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

	var form = $(this);

	$.ajax({

		url: url,
		data: new FormData(this),
		processData: false,
		contentType: false,
		type: "POST",
		success : function(res){
			//alert(res);

			var msg2 = res.split("|");
			if(form.hasClass('.report')){

				$(".form-response").html(res);

			}else{

				$(".form-response").html(res);

			

			
			if(res.indexOf("success") > 1){
			form.trigger("reset");

		}
		}
		
		}
	})
});


$("body").delegate(".autocomplete","keyup",function(){
    // alert(1);
	var text = $(this).val();
	var action = $(this).attr('action');
	var ul = $(this).next();
     if(text == ""){

     	ul.addClass('hide');
     	return false;
     }
	ul.removeClass('hide');
    var data = "text="+text+"&action="+action;
	$.post("php/search.php",data,function(res){

		//alert(res);
		ul.html(res);


	})
});

$("body").delegate(".hoverme","click",function(){

	var selected = $(this).text();
	var id = $(this).attr('id');

	$(this).parent().prev().val(selected);
	$(this).parent().next().val(id);
	$(this).parent().addClass('hide');
});

// $("body").delegate(".get_balance","change",function(){
//   //alert(1);
//   // var id = $(".autocomplete-value").val();
//   // alert(id);

//   $(this).trigger('blur');
// })

$("body").delegate(".get_balance","blur", function(){
    var id = $(this).val();
    $('.msgerror').text('');
    //var msg = '';
    var ele = $(this);
	 id = $('.hoverme').attr('id');
	var action = $(this).attr('action');
	var data = "sp=get_info_sp"+"&id="+id+"&action="+action;
	//alert(data);
	$.post("php/save.php",data,function(res){

		ele.next().next().after('<span  class="msgerror">'+res+'</span>');
		//alert(res);

	})
	
});

$("body").delegate(".da_delete","click",function(){
     var tr = $(this).closest('tr');
	if(confirm("ma hubtaa inaad tireyso xogtaan")){

		var table = $(this).attr("table");
		var column = $(this).attr("column");
		var value = $(this).attr("id");
		var user_id = $(this).attr("user_id");

		var data="sp=delete_sp"+"&table="+table+"&column="+column+"&value="
		+value+"&user_id="+user_id;

		$.post("php/save.php",data,function(res){
			alert(res);
			tr.hide();
		})
		//alert(data);
	}


});

$("body").delegate(".da_update","click",function(){
	
	var action = $(this).attr('action');
	var column = $(this).attr('column');
	var id = $(this).attr('id');

	var data="action="+action+"&column="+column+"&id="+id;
	$.post("php/search_row.php",data,function(res){
		$(".update-body").html(res);
		$("#updatemodal").modal("show");
	})
});


$("body").delegate(".update-field","keyup",function(){

	$(this).closest("form").find(".btn-update").removeClass('hide');
})

$("body").delegate(".update-field","change",function(){

	$(this).closest("form").find(".btn-update").removeClass('hide');
});


$("body").delegate(".update-form","submit",function(e){

	//alert(1);
	e.preventDefault();
	var url = $(this).attr("action");

	var form = $(this);

	$.ajax({

		url: url,
		data: new FormData(this),
		processData: false,
		contentType: false,
		type: "POST",
		success : function(res){
			//alert(res);

			var msg2 = res.split("|");
			// if(form.hasClass('.report')){

			// 	$(".form-response").html(res);

			// }else{

				$(".update-response").html(res);
				form.find(".btn-update").text("updated successfully");
				form.find(".btn-update").addClass('hide');

			

			
			// if(msg2[0] == "success"){

			// 	form.trigger("reset");
			// }
		//}
		
		}
	})
});

// $("body").delegate(".checklink","change",function()){

// 	var type = "delete";

// 	if($(this).is(":checked")){

// 		type = "insert";
// 	}

// 	var data = "sp=user_permision_sp&id="+$(this).attr('id')+
// 	"&user_id="+$(this).attr('user_id')+"&got_user="+$(this).attr('got_user')+"&type="+type;

// 	$.post("php/save.php",data,function(res)){
// 		$(".user-response").html(res);
// 		//alert(1);
// 	}

// }



$("body").delegate(".checklink","change",function(){

	var type = "delete";

	if($(this).is(":checked")){
		type = "insert";
	}

	var data = "sp=user_permision_sp&id="+$(this).attr('id')+"&user_id="+$(this).attr('user_id')+"&got_user="+$(".got_user1").val()+"&type="+type;

     //alert(data);
	
	$.post("php/save.php",data,function(res){
		//alert(res);
		$(".user-response").html(res);
	})
});


$("body").delegate(".marks","blur",function(e){

    //var max = $(".max").text();
     var tr = $(this).closest("tr");
    let max = parseFloat($.trim(tr.find(".max").text()));
    var marks = parseFloat($.trim($(this).text()));

    if(marks == 0){

    	return false;
    }
    
    if(marks > max){

    	$(this).css("color","red");
    	$(this).attr("title","dhibcaha kama badnaan karaan " +max);
    	tr.find('.da-tick').prop('disabled',true);
    	return false;
    }else if(marks < max){
    	$(this).css("color","blue");
    	$(this).attr("title", "ardeygaan waxa uu keenay dhibco ka yar "+max);
    	tr.find('.da-tick').prop('disabled',false);
    	tr.find(".da-tick").trigger("click");
    	return false;
    
    }else{

    	$(this).css("color","black");
    	tr.find('.da-tick').prop('disabled',false);
    	tr.find(".da-tick").trigger("click");
    }

})



 $("body").delegate(".da-tick","click",function(){

 	var tr = $(this).closest("tr");
 	var icon = $(this);

	var data = "";
     var i = 0;

     var error = 0

 	tr.find(".req").each(function(){

 		i++;
 		var text = $.trim($(this).text());

 		   if(text == ""){

 		   	  error = 1;
 		   }


 		if($(this).hasClass("select")){

 			data += "&p"+i+"="+$(this).find("select").val();
 		}else{


 		 data += "&p"+i+"="+encodeURIComponent(text);

 		}



 	})

 	if(error == 1){

 		return false;
 	}


 	$.ajax({

		url: "php/save.php",
		data: data,
		type: "POST",
		success : function(res){
			//alert(res);

			var msg2 = res.split("|");
			// if(form.hasClass('.report')){

			// 	$(".form-response").html(res);

			// }else{

				$(".user-response").html(res);
				icon.attr("title",res);

				if(res.indexOf("success") > -1){

			    icon.removeClass("fa fa-remove");
				icon.addClass("fa fa-check");



				}
			

				

			

			
			// if(msg2[0] == "success"){

			// 	form.trigger("reset");
			// }
		//}
		
		}
	})


 	
 })

 $("body").delegate(".chart-detail","click",function(e){

 	e.preventDefault();

 	var url = $(this).attr('href');


 	$.get(url,function(res){

 		$("#chart-result").html(res);
 	})
 });

function laod_page(url){

	$("<iframe>")

	.hide()
	.attr("src",url)
	.appendTo("body");

}

 $("body").delegate(".print-invoice","click",function(e){
 	e.preventDefault();
 	var url = $(this).attr("href");
 	laod_page(url);
 })




// $("body").delegate(".da-tick","click",function(){
// 	var tr = $(this).closest("tr");
// 	var icon = $(this);
// 	var data = "";
// 	var i = 0;
// 	tr.find(".req").each(function(){
// 		i++;
// 		var text = $.trim($(this).text());

// 		if($(this).hasClass("select")){
// 			data += "&p"+i+"="+$(this).find("select").val();
// 		}else{
// 			data += "&p"+i+"="+encodeURIComponent(text);
// 		}
		
// 	})
// 	$.ajax({
// 		url: "php/save.php",
// 		data: data,
// 		type: "POST",
// 		success: function(res){
// 		//alert(res);
// 		// var msg = res.split("|");
		
// $(".user-response").html(res);

//   if(res.indexOf("success") > -1){
//   	 icon.removeClass("fa fa-remove");
// 	  icon.addClass("fa fa-check"); 
//   }
	    
// 		}

// 	})

	
// })