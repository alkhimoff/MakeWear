<?
if ($_SESSION['status']=="admin"){

	$today = date("d.m.Y H:i:s"); 

	$id=$_GET["id"];

	$butName="";
	$flag=0;
	$pushTags="";
	$res=mysql_query("SELECT * FROM `articles` WHERE `a_id`='{$id}'; ");
	$row=mysql_fetch_assoc($res);

			$butName=$row["name"];
			$today=$row["date"];
			$desc=$row["desc"];
			$alias=$row["alias"];
			$title_seo=$row["title_seo"];
			$desc_seo=$row["desc_seo"];
			$tags=json_decode($row["tags"],true);

			if($tags){
				for($i=0; $i<count($tags["tags"]); $i++){
					$pushTags.="<span>".$tags["tags"][$i]."</span>";
				}
			}

	$center.="
	<br/><br/>
	<div class='article_body'>
		<div class='colorLine'></div>
		<div style='padding-left: 7px;' >
			<br/>
			Наименование
			<br/>
			<input type='text' rel='{$id}' id='butName' value='{$butName}' style='width: 500px;' />
		</div>
		<div class='putData'> Дата: {$today}</div>
		<div class='articleDesc'>
			<!--<div class='articleDescTr' >
					<div class=\"cl_edit_phoo\" style='height: 315px;'>
						<img src=\"/templates/shop/image/block_share/block-{$block}.jpg\">
						<br><br>
						<input type=\"checkbox\" name=\"use_photo\" id=\"id_use_photo\" value=\"1\" checked><label for=\"id_use_photo\">Отображать изображение</label><br>
						<input name=\"myfile1\" type=\"file\" id='uploadBlock' >
						<div style='height: 0px;margin-top: -5px;width: 246px;margin-left: 16px;'>
							<div style='height: 2px;' class='see_progress' ></div>
						</div>
						<br>
					</div>	
			</div>-->
			<div class='articleDescTr' >
				<textarea name='short_text' id='short_text'>{$desc}</textarea>

				<div style='display:table;margin-top: 7px;'>
					<div style='display:table-cell;'>
						<span class='pushTags' >#Теги: </span> 
					</div>
					<div style='display:table-cell;'>
						<div class='addTags'>
							<div class='addTagsTr' style='position:relative;width: 135px;height: 23px;'>
								<input type='text' id='inputTags' />
							</div>
							<div class='addTagsTr' id='butTags'>+</div>
						</div>
					</div>
					<div style='display:table-cell;' class='readTags'>
						{$pushTags}
					</div>
				</div> 
			</div>
		</div>
		<div style='display:table;margin-top: 10px;'>
			<div style='display:table-cell;'>
				<div class='articleSEO'>
					Адрес товара:<br>
					<input type='hidden' name='alias' value=\"{$alias}\" style='width:400px;' id='alias' /><br>
					<input type='text' name='alias' value=\"{$alias}\" style='width:400px;' id='alias2' /><br>
					<input type='checkbox' name='use_alias' id='id_use_alias' value='1' {$use_alias_checked}>
					<label style='color:#777777;font-size:11px;' for='id_use_alias'>Генерировать автоматически</label><br><br>
					Title:<br>
					<input type='text' name='title' value='{$title_seo}' style='width:400px;' id='seo_title' />
					<br><br>Description:<br>
					<textarea name='description' style='width:400px;height:100px;' id='seo_desc'>{$desc_seo}</textarea>
					<br/>
				</div>
			</div>
			<div style='display:table-cell;vertical-align: bottom;position: relative;width: 100%;'>
				<table class=\"noborder\" style=\"position: absolute;bottom: 5px;right: 5px;margin-left:3px;float:left;border:1px solid #ccc;background:#fff;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;\">
							<tbody><tr>
								<td></td>
									<td class=\"button\" id=\"toolbar-save\">
									<div onclick=\"javascript:saveArticle();\" class=\"toolbar\">
									<span class=\"icon-32-save\" title=\"Сохранить\">
									</span>
									Сохранить
									</div>
									</td>

									<td class=\"button\" id=\"toolbar-apply\">
									<div onclick=\"javascript:applyArticle();\" class=\"toolbar\">
									<span class=\"icon-32-apply\" title=\"Применить\">
									</span>
									Применить
									</div>
									</td>

									<td class=\"button\" id=\"toolbar-cancel\">
									<div onclick=\"javascript:canelArticle();\" class=\"toolbar\">
									<span class=\"icon-32-cancel\" title=\"Отменить\">&nbsp;
									</span>
									Отменить
									</div>
									</td>

									<td class=\"button\" id=\"toolbar-cancel\">
									<div onclick=\"javascript:deleteArticle();\" class=\"toolbar\">
									<span class=\"icon-32-delete\" title=\"Удалить\">&nbsp;
									</span>
									Удалить
									</div>
									</td>

									</tr>
							</tbody></table>
			</div>
		</div>
		<br/>
	</div>";

	$center.="
		<link href='/templates/admin/css/articles.css' type='text/css' rel='stylesheet' />
		<script src='/templates/admin/js/articles.js' ></script>";
}
?>
