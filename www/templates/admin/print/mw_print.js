$(document).ready(function(){
	$('.pri_click').click(function(){
		$('.paperA4').print();
	});
	$('.icon_print').click(function(){
		var rel=$(this).attr('rel');
		var cat=$(this).attr('rel-cat');
		$('body').css({'overflow':'hidden', 'cursor':'wait'});
		//$('.pri_body').show();


		// $.ajax({
		// 	method:"GET",
		// 	url:"/templates/admin/print/ajax_db.php",
		// 	data:{"idd":rel}
		// })
		// .done(function(data){
		// 	//alert(data);
		// });


		var t = new Date();

		var mm=t.getMonth();
		switch(mm+1){
			case 1:
				mm='січня';
				break;
			case 2:
				mm='лютого';
				break;
			case 3:
				mm='березня';
				break;
			case 4:
				mm='квітня';
				break;
			case 5:
				mm='травня';
				break;
			case 6:
				mm='червня';
				break;
			case 7:
				mm='липня';
				break;
			case 8:
				mm='серпня';
				break;
			case 9:
				mm='вересня';
				break;
			case 10:
				mm='жовтня';
				break;
			case 11:
				mm='листопада';
				break;
			case 12:
				mm='грудня';
				break;
		}
		var tt=t.getDate()+' '+mm+' '+t.getFullYear();

		if($(this).attr('is')=='1'){
			var table="";
			var get_table=$("#open_comm"+rel);
			var l=get_table.find("tr").length;
			var count=0;
			var sum_price=0;

			var name=$('.cli_info_open'+rel+' tr:nth-child(2) td:last-child').text();
			var email=$('.cli_info_open'+rel+' tr:nth-child(3) td:last-child').text();
			var phone=$('.cli_info_open'+rel+' tr:nth-child(4) td:last-child').text();
			var city=$('.cli_info_open'+rel+' tr:nth-child(5) td:last-child').text();
			var address=$('.cli_info_open'+rel+' tr:nth-child(6) td:last-child').text();

			var orderID=$("#gh"+rel+" .cli_cod").text();
			var delivery=parseInt($("#gh"+rel+" .cli_cod").data("delivery"));

			console.log(delivery);

			
			var j=1;
			for(i=1; i<l; i++){
				var brend=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(1)").text();
				var art=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(2)").text();
				var commodity=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(3)").text();
				var comName=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(4)").text();
				var color=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(5)").text();
				var size=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(6)").text();
				var count2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(7)").text();
				var price2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(8)").text();
				var sum_price2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(9)").text();
				var cupplierID=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(10)").text();
				var status=get_table.find("tr:nth-child("+(i+1)+") #select_status_com option:selected").val();
					// alert(status);
				if(status!=2){
					count+=parseInt(get_table.find("tr:nth-child("+(i+1)+") td:nth-child(7)").text());
					sum_price+=parseFloat(get_table.find("tr:nth-child("+(i+1)+") td:nth-child(8)").text());
					
					// table+="<tr><td>"+j+"</td><td>"+brend+"</td><td>"+art+"</td><td>"+art+"</td><td>"+color+"</td><td>"+color+"</td><td>"+count2+"</td><td>"+commodity+"</td><td>"+size+"</td></tr>";
					table+="<tr><td>"+j+"</td><td>"+brend+"</td><td>"+art+"</td><td>"+commodity+"</td><td>"+comName+"</td><td>"+color+"</td><td>"+size+"</td><td>"+count2+"</td><td>"+price2+"</td><td>"+sum_price2+"</td><td>"+cupplierID+"</td></tr>";
					j++;
				}
			}

			var all_sum=sum_price+delivery;
			sum_price=sum_price.toFixed(2);
			
			var txt="";

			txt+='<br><br>';
			txt+='<div style=\'font-size: 18px;font-weight: bold;border-bottom: 2px solid;padding-left: 10px;\'>Видаткова накладна №'+rel+' від '+tt+' р.</div>';
			txt+="<div style='display:table;'>";
			txt+="<div style='display:table-row'><div style='display:table-cell' ></div>";
			txt+="<div style='display:table-cell;font-weight: bold;padding-top: 10px;' ></div></div>";
			txt+="<div style='display:table-row'><div style='display:table-cell;padding-right: 10px;' ><span id='name_underline'>Постачальник:</span></div>";
			txt+="<div style='display:table-cell;line-height: 18px;' ><b>Інтернет-магазин:</b> \"MakeWear\"<br/><b>Веб-сайт:</b> www.makewear.com.ua<br/><b>Електронна пошта:</b> info@makewear.com.ua<br/><b>Телефон:</b> +38 (098) 474-22-82  +38 (099) 098-00-82<br/><b>Адреса:</b> м. Київ, вул. Олегівська, 36<br/><br/></div></div>";
			txt+="<div style='display:table-row'><div style='display:table-cell' ><span id='name_underline'>Покупець:</span></div>";
			txt+="<div style='display:table-cell;line-height: 18px;' ><b>Ім'я:</b> "+name+"<br/><b>Електронна пошта:</b> "+email+"<br/><b>Телефон:</b> "+phone+"<br/><b>Адреса:</b> "+address+", "+city+"</div></div>";
			txt+="</div>"

			txt+="<div style='padding-top: 10px;'> Заказ№ "+orderID+"</div>";
			txt+="<table class='table_print' >";
			// txt+="<th>№</th><th>Бренд</th><th>Артикул ориг.</th><th>Артикул</th><th>Колір ориг.</th><th>Колір</th><th>Кол-во</th><th>Товар</th><th>Розмір</th>";
			txt+="<th>№</th><th>Бренд</th><th>Артикул</th><th>Товар</th><th>Назва</th><th>Колір</th><th>Розмір</th><th>Кол-во</th><th>Ціна</th><th>Сума</th><th>Заказ П</th>";
			txt+=table;
			txt+="</table>";
			txt+="<div style='line-height: 28px;'>Всього найменувань "+count+", на суму "+sum_price+"грн <br/>В т.ч. доставка: <b>"+delivery+" грн</b></div>";
			txt+="<div id='pppp' >Сума до сплати: "+all_sum+" грн</div>";
			txt+="<div> Від постачальника:___________________________________________    Від покупця:_____________</div>";
			$('.paperA4').html(txt);
			$('body').css({'cursor':'default'});
			$('.pri_body').show();
			
		}else{

			$.ajax({
				method:"GET",
				url:"/templates/admin/print/ajax_db.php",
				data:{cat:cat},
				dataType:"json"
			})
			.done(function(dd){
				var table="";

				var get_table=$(".open_commodity"+rel);
				var l=get_table.find("tr").length;
				var count=0;
				var sum_price=0;

				var deli=$(".gett_del"+rel).text();

				var j=1;
				for(i=1; i<l; i++){
					var brend=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(2)").text();
					var art=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(3)").text();
					var commodity=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(4)").text();
					var comName=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(5)").text();
					var color=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(6)").text();
					var size=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(7)").text();
					var count2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(8)").text();
					var price2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(11)").text();
					var sum_price2=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(13)").text();
					var clientID=get_table.find("tr:nth-child("+(i+1)+") td:nth-child(14)").text();
					var status=get_table.find("tr:nth-child("+(i+1)+") #select_status_com option:selected").val();
					//alert(status);
					if(status!=2){
						count+=parseInt(get_table.find("tr:nth-child("+(i+1)+") td:nth-child(8)").text());
						sum_price+=parseFloat(get_table.find("tr:nth-child("+(i+1)+") td:nth-child(13)").text());
						// table+="<tr><td>"+j+"</td><td>"+brend+"</td><td>"+art+"</td><td>"+art+"</td><td>"+color+"</td><td>"+color+"</td><td>"+count2+"</td><td>"+commodity+"</td><td>"+size+"</td></tr>";
						table+="<tr><td>"+j+"</td><td>"+brend+"</td><td>"+art+"</td><td>"+commodity+"</td><td>"+comName+"</td><td>"+color+"</td><td>"+size+"</td><td>"+count2+"</td><td>"+price2+"</td><td>"+sum_price2+"</td><td>"+clientID+"</td></tr>";
						
						j++;
					}
				}
				var all_sum=sum_price+parseInt(deli);
				sum_price=sum_price.toFixed(2);
		
				var txt="";

				txt+='<br><br>';
				txt+='<div style=\'font-size: 18px;font-weight: bold;border-bottom: 2px solid;padding-left: 10px;\'>Видаткова накладна №'+rel+' від '+tt+' р.</div>';
				txt+="<div style='display:table;'><br/>";

				txt+="<div style='display:table-row'><div style='display:table-cell' ><span id='name_underline'>Постачальник:</span></div>";
				txt+="<div style='display:table-cell;line-height: 18px;' ><b>ФОП</b> "+dd["con_flp"]+"<br/><b>ЄДРПОУ</b> "+dd["con_bank"]+"<br/><b>Р/р</b>  <br/><b>МФО</b> "+dd["con_mfo"]+"<br/></div></div>";
				
				txt+="<div style='display:table-row'><div style='display:table-cell' ><span id='name_underline'>Покупець:</span></div>";
				txt+="<div style='display:table-cell;line-height: 18px;' ><b>Інтернет-магазин:</b> \"MakeWear\"<br/><b>Веб-сайт:</b> www.makewear.com.ua<br/><b>Електронна пошта:</b> info@makewear.com.ua<br/><b>Телефон:</b> +38 (098) 474-22-82  +38 (099) 098-00-82<br/><b>Адреса:</b> м. Київ, вул. Олегівська, 36<br/></div></div>";
				
				txt+="</div>"

				//txt+="<div style='display:table-row'><div style='display:table-cell;padding-right: 10px;' ><span id='name_underline'>Постачальник:</span></div>";
				// txt+="<span id='name_underline'>Постачальник:</span><br/>";
				// txt+="<span id='name_underline'>Покупець:</span>";
				txt+="<div style='padding-top: 10px;'> Заказ№ "+rel+"</div>";
				txt+="<table class='table_print' >";
				// txt+="<th>№</th><th>Бренд</th><th>Артикул ориг.</th><th>Артикул</th><th>Колір ориг.</th><th>Колір</th><th>Кол-во</th><th>Товар</th><th>Розмір</th>";
				txt+="<th>№</th><th>Бренд</th><th>Артикул</th><th>Товар</th><th>Назва</th><th>Колір</th><th>Розмір</th><th>Кол-во</th><th>Ціна</th><th>Сума</th><th>Заказ К</th>";
				txt+=table;
				txt+="</table>";
				txt+="<div style='line-height: 28px;'>Всього найменувань "+count+", на суму "+sum_price+"грн <br/> В т.ч. доставка: <b>"+deli+"<b/> </div>";
				txt+="<div id='pppp' >Сума до сплати: "+all_sum+" грн</div>";
				txt+="<div> Від постачальника:___________________________________________    Від покупця:_____________</div>";
				$('.paperA4').html(txt);
				$('body').css({'cursor':'default'});
				$('.pri_body').show();

			});
		}
	});
	$('.print_close').click(function(){
		$('.pri_body').hide();
		$('body').css({'overflow':'auto'});
	});
	$('.paperA4').click(function(){
		$(this).attr("contenteditable","true");
	});
});