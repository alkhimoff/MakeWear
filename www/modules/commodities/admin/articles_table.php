<?
if ($_SESSION['status']=="admin"){


	$res=mysql_query("SELECT * FROM `articles` WHERE 1");

	while($row=mysql_fetch_assoc($res)){
		$id=$row["a_id"];
		$name=$row["name"];
		// $desc=$row["desc"];
		$url="/articles/".$row["alias"].".html";
		$date=$row["date"];

		$add_line.="
			<tr id='{$id}' rel='shop_blocks' rel2='id' >
				<td>{$id}</td>
				<td>{$name}
				<div class=\"hover-actions\">
						<a href=\"/?admin=articles&id={$id}\">Редактировать</a>&nbsp;
						<a href=\"/?admin=articles&id={$id}\" target=\"_blank\">Просмотр</a>&nbsp;
					</div>
				</td>
				<td id='title'>{$desc}</td>
				<td><a href='{$url}' target='_blank' >{$url}</a></td>
				<td>{$date}</td>
			</tr>";
	} 


	$center.="
		<table class=\"noborder\" style=\"margin-left:3px;float:left;border:1px solid #ccc;background:#fff;-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;\">
							<tbody><tr>
								<td></td>
			<td class=\"button\" id=\"toolbar-new\">
			<div onclick=\"javascript:go_to_page('/?admin=articles&id=new');\" class=\"toolbar\" style=\"width:100px!important;\">
			<span class=\"icon-32-new\" title=\"Добавить\">
			</span>
			Добавить
			</div>
			</td>

		</tr>
		</tbody></table>
		<br/><br/>
		<table style='width: 100%;' class='sortable scb'>
			<th>ID</th>
			<th>Наименование</th>
			<th>Статья</th>
			<th>Ссилка</th>
			<th>Дата</th>
			{$add_line}
		</table>
		<style>
			.scb th:first-child, .scb td:first-child{
				text-align: center;
				height: 30px;
			}
			.scb td{
				vertical-align: middle;
			}
		</style>
		<script>
			function(src){
				location.href=src;
			}
		</script>
	";


}

?>