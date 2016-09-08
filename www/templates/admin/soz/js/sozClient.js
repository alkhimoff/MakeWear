$(document).ready(function(){

	$('#fromDate').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
      	changeYear: true,
		onClose: function( selectedDate ) {
			$( '#toDate' ).datepicker( 'option', 'minDate', selectedDate );
		},
		onSelect:function(dateText, inst){
			var fromDate=dateText;
			var toDate=$("#toDate").val();
			searchDate(fromDate, toDate);
			// var fromDate=dateText;
			// var toDate=$("#toDate").val();


			// $(".getDate").each(function(){
			// 	var data=$(this).text();
			// 	var dataArr=data.split(" ");
			// 	var rel=$(this).attr("rel");
			// 	alert(dataArr[0]);
			// 	// if(fromCount<=count && count<=toCount){
			// 	// 	$("#cli"+rel).show();
			// 	// 	$(".openCline"+rel).show();
			// 	// }else{
			// 	// 	$("#cli"+rel).hide();
			// 	// 	$(".openCline"+rel).hide();
			// 	// }
			// });
		}
	});

	$('#toDate').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
      	changeYear: true,
		onClose: function( selectedDate ) {
			$('#fromDate').datepicker( 'option', 'maxDate', selectedDate );
		},
		onSelect:function(dateText, inst){
			var fromDate=$("#fromDate").val();
			var toDate=dateText;
			searchDate(fromDate, toDate);
			// var fromDate=$("#fromDate").val();
			// var toDate=dateText;

			// if(toDate==""){
			// 	alert(toDate);
			// }else{
			// 	alert(fromDate+"-"+toDate);
			// }
		}
	});


	var pushRel=0;
	$(".w_cli tr").each(function(){
		if($(this).hasClass("client")){
			pushRel=parseInt($(this).attr("rel-tr"));
		}else{
			$(this).find(".getCount").attr("rel",pushRel);
			$(this).find(".getSum").attr("rel",pushRel);
			$(this).find(".getDate").attr("rel",pushRel);
		}
	});

	$("#fromCount, #toCount").keyup(function(){
		var fromCount=parseInt($("#fromCount").val());
		var toCount=parseInt($("#toCount").val());
		if($.isNumeric(fromCount)){
			$(".getCount").each(function(){
				var count=parseInt($(this).text());
				var rel=$(this).attr("rel");
				if(fromCount<=count && count<=toCount){
					$("#cli"+rel).show();
					$(".openCline"+rel).show();
				}else{
					$("#cli"+rel).hide();
					$(".openCline"+rel).hide();
				}
			});
		}
	});

	$("#fromSum, #toSum").keyup(function(){
		var fromSum=parseInt($("#fromSum").val());
		var toSum=parseInt($("#toSum").val());
		if($.isNumeric(fromSum)){
			$(".getSum").each(function(){
				var sum=parseInt($(this).text());
				var rel=$(this).attr("rel");
				if(fromSum<=sum && sum<=toSum){
					$("#cli"+rel).show();
					$(".openCline"+rel).show();
				}else{
					$("#cli"+rel).hide();
					$(".openCline"+rel).hide();
				}
			});
		}
	});


	var gcou='';
	var gMax=parseInt($(".getCount").eq(1).text());
	var gMin=parseInt($(".getCount").eq(1).text());
	$(".getCount").each(function(){
		var int=parseInt($(this).text());
		if(gMax<int){
			gMax=int;
		}
		if(gMin>int){
			gMin=int;
		}
		gcou+=int+", ";
	});
	$("#fromCount").val(gMin);
	$("#toCount").val(gMax);
	//alert(gMin+" - "+gMax);

	var gsum='';
	var gsMax=parseInt($(".getSum").eq(1).text());
	var gsMin=parseInt($(".getSum").eq(1).text());
	$(".getSum").each(function(){
		var int=parseInt($(this).text());
		if(gsMax<int){
			gsMax=int;
		}
		if(gsMin>int){
			gsMin=int;
		}
		gsum+=int+", ";
	});
	$("#fromSum").val(gsMin);
	$("#toSum").val(gsMax);
	//alert(gsMin+" - "+gsMax);

	$(".searchSOZ #key").keyup(function(event){
		var text=$(this).val();
		// $(".readSearch").empty();
		// if(text==""){
		// 	$(".readSearch").hide();
		// }else{
		// 	$(".readSearch").show();
		// }
		$(".tr_client").removeAttr("style");
		var vall=$(".searchSOZ select").val();
		if(vall==1){
			$(".get_name").each(function(){
				var rel=$(this).attr("rel");
				var txt=$(this).text();
				if(lctext(txt).indexOf(text)==-1 && txt.indexOf(text)==-1){
					// $(".readSearch").append("<div>"+txt+"</div>");
					$("#cli"+rel).hide();
				}
			});
		}
		if(vall==2){
			$(".get_tel").each(function(){
				var rel=$(this).attr("rel");
				var txt=$(this).text();
				if(txt.indexOf(text)==-1){
					// $(".readSearch").append("<div>"+txt+"</div>");
					$("#cli"+rel).hide();
				}
			});
		}
		if(vall==3){
			$(".get_mail").each(function(){
				var rel=$(this).attr("rel");
				var txt=$(this).text();
				if(txt.indexOf(text)==-1){
					// $(".readSearch").append("<div>"+txt+"</div>");
					$("#cli"+rel).hide();
				}
			});
		}
		if(event.which==13){
			alert("up")
		}
	});


	$(".butOpenClient").click(function(){
		var rel=$(this).attr("rel");

		if($(this).hasClass("block_down")){
			$(this).removeClass("block_down").addClass("block_up");
			// $(".openCline"+rel).show();
			$(".occc"+rel).slideDown();
		}else{
			$(this).removeClass("block_up").addClass("block_down");
			//$(".openCline"+rel).slideUp();
			$(".occc"+rel).slideUp();
		}
	});

	$(".client").each(function(){
		var rel=$(this).attr("rel-tr");
		$(".openCline"+rel+' .maill2').attr("rel", rel);
		//alert(rel);
	});

	onloadLine();

	
	var i=1;
	$(".changeLine button").click(function(){
		var line=$(".addLine div").length;
		// $(".addLine").before("<div id='line"+i+"' style='display:table-cell;position:relative;'><div class='changeLineBut'>Name</div><i class='fa fa-times' onclick='deleteLine("+i+")'></i></div>");
		$("body").css({"cursor":"wait"});
		//var id=$('.idClient').attr("rel"); 
		$.ajax({
			method:"GET",
			url:"/modules/commodities/ajax/ajax_SOCClinet2.php",
			data:{add_id:1}
		})
		.done(function(data){
			$(".addLine").before("<div style='display:table-cell;position:relative;' id='bonusLine"+data+"'><div class='changeLineBut ' rel='"+data+"'> Add Name</div><i class='fa fa-times' onclick='deleteLine("+data+")'></i></div>");
			$.get("/templates/admin/soz/js/viem/bonusTable.html",function(txt){
				$(".cardTable .bonus").append(txt);
				$(".viemAdd").attr("id","ss"+data);
				$("#ss"+data).removeClass("viemAdd");

				$("body").css({"cursor":"default"});

				onloadLine();
			});
		});

		i++;
	});
	function onloadLine(){
		$(".changeLineBut").click(function(){
			var rel=$(this).attr("rel");

			if($(".butSave").hasClass("active")){
				$(".changeLine .changeLineBut").removeClass("active");
				$(this).addClass("active");

				$(".allTab").css({'display':'none'});
				$("#ss"+rel).css({'display':'block'});
				//$("#bonusLine"+rel).append("<i class='fa fa-times' onclick='deleteLine("+rel+")'></i>")
			}else{
				alert("Нажми на кнопку \"Сохранить\"");
			}
		});
		$(".changeLineBut").dblclick(function(){
			$(this).attr("contenteditable",true);
		});
		$(".changeLineBut").keyup(function(){
			var text=$(this).text();
			var rel_id=$(this).attr("rel");
			var id=$('.idClient').attr("rel");
			$.ajax({
				method:"GET",
				url:"/modules/commodities/ajax/ajax_SOCClinet2.php",
				data:{id:id, text:text, row:'scas_name', rel_id:rel_id}
			})
		});
		$(".butWrite").click(function(){
			$(".butSave").removeClass("active");
			$(".bonus .pressKeyS, .bonus .pressSelectS").prop("disabled", false).css({"color":"black"});
		});
		$(".butSave").click(function(){
			if($(this).hasClass("active")){

			}else{
				if(confirm("Сохранить?")){
					$(".bonus .pressKeyS, .bonus .pressSelectS").prop("disabled", true).css({"color":""});

					// var id=$('.idClient').attr("rel");
					var rel_id=$(".changeLine .active").attr("rel");

					$('#ss'+rel_id+' .pressKeyS').each(function(){
						var text=$(this).val();
						var row=$(this).attr('id');
						// var id=$('.idClient').attr("rel");
						if($(this).hasClass("infoType")){
							text=$(".infoType").text();
						}
						$.ajax({
							method:"GET",
							url:"/modules/commodities/ajax/ajax_SOCClinet2.php",
							data:{text:text, row:row, rel_id:rel_id}
						})
					});
					$('#ss'+rel_id+' .pressSelectS').each(function(){
						var t=$(this).val();
						var row=$(this).attr('id');
						// var id=$('.idClient').attr("rel"); 
						$.ajax({
							method:"GET",
							url:"/modules/commodities/ajax/ajax_SOCClinet2.php",
							data:{text:t, row:row, rel_id:rel_id}
						})
					});
					$(".butSave").addClass("active");
				}else{

				}
				// $(".butSave").addClass("active");
			}
		});
	}
});


function deleteLine(d){
	var del=$("#bonusLine"+d+" .changeLineBut").text();

	if(confirm(" Удалить \""+del.trim()+"\"?")){
		$.ajax({
			method:"GET",
			url:"/modules/commodities/ajax/ajax_SOCClinet2.php",
			data:{delete_id:d}
		});
		if($("#bonusLine"+d+" div").hasClass("active")){
			$(".changeLineBut").eq(0).addClass("active");
			$(".allTab").eq(0).show();
		}

		$("#bonusLine"+d+", #ss"+d).remove();
	}
	
}

function ucfirst(str) {
    var f = str.charAt(0).toUpperCase();
    return f + str.substr(1, str.length-1);
}
function lcfirst(str) {
    var f = str.charAt(0).toLowerCase();
    return f + str.substr(1, str.length-1);
}

function uctext(str){
	return str.toUpperCase();
}
function lctext(str){
	return str.toLowerCase();
}

function searchDate(fromData,toData){
			// var fromData=$("#formDate").val();
			// var toData=$("#toDate").val();
			// alert(fromData+"-"+toData);
			console.log(fromData);
			console.log(toData);

			var arrFromData=fromData.split("/");
			var arrToData=toData.split("/");

			var fromDay=parseInt(arrFromData[0]);
			var fromMonth=parseInt(arrFromData[1]);
			var fromYear=parseInt(arrFromData[2]);

			var toDay=parseInt(arrToData[0]);
			var toMonth=parseInt(arrToData[1]);
			var toYear=parseInt(arrToData[2]);

			var flag=0;

			if(fromData!="" && toData==""){
				flag=1;
			}
			if(fromData=="" && toData!=""){
				flag=2;
			}
			if(fromData!="" && toData!=""){
				flag=3;
			}


			$(".getDate").each(function(){
				var clientDate=$(this).text();
				var cli=clientDate.split(" ");
				var cliDate2=cli[0].split("-");
				var cliDate2Year=parseInt(cliDate2[0]);
				var cliDate2Month=parseInt(cliDate2[1]);
				var cliDate2Day=parseInt(cliDate2[2]);

				var rel=$(this).attr("rel");

				if(flag==1){
					// $(this).css({"display":"none"});
					$("#cli"+rel).hide();
					$(".openCline"+rel).hide();
					if((fromDay<cliDate2Day)&&(fromMonth<=cliDate2Month) && (fromYear<=cliDate2Year)){	
						// $(this).removeAttr("style");
						$("#cli"+rel).show();
						$(".openCline"+rel).show();
					}
				}
				if(flag==2){
					// $(this).removeAttr("style");
					$("#cli"+rel).show();
					$(".openCline"+rel).show();
					if((toDay<cliDate2Day)&&(toMonth<=cliDate2Month) && (toYear<=cliDate2Year)){
						// $(this).css({"display":"none"});
						$("#cli"+rel).hide();
						$(".openCline"+rel).hide();
					}
				}
				if(flag==3){
					// $(this).css({"display":"none"});
					$("#cli"+rel).hide();
					$(".openCline"+rel).hide();
					if(((fromDay<=cliDate2Day) && (cliDate2Day<=toDay)) && ((fromMonth<=cliDate2Month) && (cliDate2Month<=toMonth))&& ((fromYear<=cliDate2Year) && (cliDate2Year<=toYear))){
						// $(this).removeAttr("style");
						$("#cli"+rel).show();
						$(".openCline"+rel).show();
					}
				}
				
			});


			// $(".getCount").each(function(){
			// 	var count=parseInt($(this).text());
			// 	var rel=$(this).attr("rel");
			// 	if(fromCount<=count && count<=toCount){
			// 		$("#cli"+rel).show();
			// 		$(".openCline"+rel).show();
			// 	}else{
			// 		$("#cli"+rel).hide();
			// 		$(".openCline"+rel).hide();
			// 	}
			// });
		}
