$(document).ready(function(){
	onload();
	onloadEdit();

	$("#butTags").click(function(){
		$(".readTags").append("<span>"+$("#inputTags").val()+"</span>");
		$("#inputTags").val("")
	});
	$("#newArticle").click(function(){
		$(".articleButNames").removeClass("active");
		$(".disArt").before("<div class='articleButNames active diss'>Статья</div>");

		$("#short_text").val("");
		$("#alias").val("");
		$("#seo_title").val("");
		$("#seo_desc").val("");
		$(".readTags").empty();
		
		CKEDITOR.instances.short_text.setData("");

		onload();
		onloadEdit();
	});


	$("#butName").keyup(function(){
		var text=$(this).val();
		var push="";
		for(var i=0; i<text.length; i++){
			push+=setTranslatesWord(text[i]);
		}
		push=push.replace(/ /g, "");
		$("#alias, #alias2").val(push);
		// alert(push);
		// var ss=setTranslatesWord();
		// alert("word: "+ss);
	});

	function onload(){
		$(".articleButNames").click(function(){
			var id=$(this).attr("rel");
			if(!$(this).hasClass("disArt")){

				if($(".articleNames .active").hasClass("diss")){
					if(!$(this).hasClass("diss"))
					alert("Нажмите сохранить или применить");
				}else{
					$(".articleButNames").removeClass("active");
					$(this).addClass("active");
					$("body").css({"cursor":"wait"});
					$.ajax({
						type:'POST',
						url:'/modules/commodities/ajax/articles.php',
						data:{selectId:id},
						dataType:'json'
					})
					.done(function(data){
						$("#short_text").val("");
						$("#short_text").val(data['desc']);
						CKEDITOR.instances.short_text.setData(data['desc']);

						$("#alias").val(data['alias']);
						$("#seo_title").val(data['title_seo']);
						$("#seo_desc").val(data['desc_seo']);

						var tags=$.parseJSON(data['tags']);
						$(".readTags").empty();
						for(var i=0; i<tags.tags.length; i++){
							$(".readTags").append("<span>"+tags.tags[i]+"</span>");
						}

						$("body").css({"cursor":"default"});
						onloadEdit();
					});


				}
			}
		});
		$(".articleButNames").dblclick(function(){
			if(!$(this).hasClass("disArt")){
				$(this).attr("contenteditable",true);
			}
		});

	}

	function onloadEdit(){
		CKEDITOR.replace('short_text', { language: 'ru' });
		CKEDITOR.config.allowedContent = true
		CKEDITOR.config.width = 1000;
		CKEDITOR.config.height = 500;

		timer = setInterval(updateDiv,100);
		function updateDiv(){
		    var editorText = CKEDITOR.instances.short_text.getData();
		    $('#short_text').val(editorText);
		}
	}
});

function saveArticle(){
	if(confirm("Сохранить?")){
		saveAjax();
		location.href="/?admin=articles_table";
	}
}
function applyArticle(){
	if(confirm("Применить?")){
		saveAjax();
	}
}
function canelArticle(){
	if(confirm("Отменить?")){
		location.href="/?admin=articles_table";
	}
}
function deleteArticle(){
	if(confirm("Удалить?")){
		var id=$("#butName").attr("rel");
		var data={del:id}
		$.ajax({
			type:'POST',
			url:'/modules/commodities/ajax/articles.php',
			data:data
		}).done(function(){
			location.href="/?admin=articles_table";
		});
	}
}

function saveAjax(){
	var id=$("#butName").attr("rel");
	// var name=$(".articleNames .active").text();butName
	var name=$("#butName").val();
	var desc=$("#short_text").val();
	var alias=$("#alias").val();
	var title_seo=$("#seo_title").val();
	var desc_seo=$("#seo_desc").val();

	var tags='{"tags":[';
	$(".readTags span").each(function(){
		tags+='"'+$(this).text()+'",';
	});
	tags+=']}';
	tags=tags.replace(',]',']');

	var data={id:id, name:name, desc:desc, alias:alias, title_seo:title_seo, desc_seo:desc_seo, tags:tags};

	if(id==null || id=="new"){
		data["status"]=2;
	}else{
		data["status"]=1;
	}

	$.ajax({
		type:'POST',
		url:'/modules/commodities/ajax/articles.php',
		data:data
	})
	.done(function(data){
		if(data==1){
			location.href="/?admin=articles_table";
		}
	});

	//alert(id+", "+name+", "+desc+"="+alisa+", "+title_seo+", "+desc_seo+", "+tags);
}

function setTranslatesWord(a){
	var word={а:'a',ё:'e',й:'y',ц:'ts',у:'u',к:'k',е:'e',н:'n',г:'g',ш:'ch',щ:'sch',з:'z',х:'kh',ъ:' ',ф:'f',ы:'i',в:'v',п:'p',р:"r",о:"o",л:"l",д:"d",ж:"w",э:"e",я:"ia",ч:"ch",с:"s",м:"m",и:"i",т:"t",ь:" ",б:"b",ю:"u",Ё:"e",Й:"y",Ц:"ts",У:"u",К:"k",Е:"e",Н:"n",Г:"g",Ш:"sh",Щ:"sch",З:"z",Х:"kh",Ъ:" ",Ф:"f",Ы:"i",В:"v",А:"a",П:"p",Р:"r",О:"o",Л:"l",Д:"d",Ж:"w",Э:"e",Я:"ia",Ч:"ch",С:"c",М:"m",И:"i",Т:"t",Ь:" ",Б:"b",Ю:"u"};
 	if(a==" "){
 		return "-";
 	}else{
 		if(!word[a]){
 			return a;
 		}else{
 			return word[a];
 		}
 	}
}