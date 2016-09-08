<?

if ($_SESSION['status']=="admin")
{
	if(empty($_GET['user'])){
		$active1='active';
	}elseif($_GET['user']==2){
		$active2='active';
	}elseif($_GET['user']==3) {
		$active3='active';
		$sqlWhere="WHERE `status`='sp' ORDER BY `user_id` DESC ";
	}

	$add_lines='';
	$res=mysql_query("SELECT * FROM `users` {$sqlWhere}");
	while($row=mysql_fetch_assoc($res)){
		$user_id=$row["user_id"];
		$user_name=$row["user_name"];
		$siteSP=$row["site_SP"];
		$nikSP=$row["nik_SP"];
		$categoriya=$row["status"];
		switch ($categoriya) {
			case 'rozn':
				$categoriya="Розничный покупатель";
				break;
			case 'opt':
				$categoriya="Оптовый покупатель";
				break;
			case 'sp':
				$categoriya="Организатор СП";
				break;
			
			default:
				break;
		}
		$user_email=$row["user_email"];
		$user_tel=$row["user_tel"];
		$user_city=$row["user_city"];
		if(strpos($user_city,",")!==flase){
			$arrCity=explode(",",$user_city);
			$city=$arrCity[0];
		}else{
			$city=$user_city;
		}

		$user_soc_provider=$row["user_soc_provider"];
		switch ($user_soc_provider) {
			case 'vk':
				$user_soc_provider="В Контакте";
				break;
			case 'ok':
				$user_soc_provider="Одноклассники";
				break;
			case 'facebook':
			case 'fb':
				$user_soc_provider="Facebook";
				break;
			case 'google':
			case 'go':
				$user_soc_provider="Google";
				break;
			
			default:
				break;
		}
		
		$user_registred_date=$row["user_registred_date"];

		$add_lines.="
			<tr>
				<td>{$user_id}</td>
				<td>
					{$user_name}
					<div class='hover-actions' style='text-align: left;'>
							<a href='/?admin=edit_user&user_id={$user_id}'>Редактировать</a>&nbsp;
							<a href='/?admin=delete_user&user_id={$user_id}'>Удалить</a>
					</div>
				</td>
				<td>{$categoriya}</td>
				<td>{$user_email}</td>
				<td>{$user_tel}</td>
				<td>{$city}</td>
				<td>{$user_soc_provider}</td>
				<td>{$user_registred_date}</td>
				<td style='text-align: inherit;padding: inherit;'>
					<table class='tabSP'>
						<tr>
							<td>Сайт СП: {$siteSP}</td>
							<td rowspan=2 style='width: 50px;' >
								<div style='display:table;'>
									<div class=\"icon-32-apply\" title=\"Применить\"></div>
									<div class=\"icon-32-cancel\" title=\"Отменить\"></div>
								</div>
							</td>
						</tr>
						<tr><td>Ник СП: {$nikSP}</td></tr>
					</table>
				</td>
			</tr>";
	}

	$center.="
		<br/><br/>
		<div class='changeUsers'> 
			<div class='changeLineUsers'><div class='changeButUsers {$active1}' rel=1 > Клиенты</div></div>
			<div class='changeLineUsers'><div class='changeButUsers {$active2}' rel=2> Сотрудники</div></div>
			<div class='changeLineUsers'><div class='changeButUsers {$active3}' rel=3> Модерация</div></div>
		</div>
		<table class='sortable'>
			<th>ID</th>
			<th>Логин</th>
			<th>Категория</th>
			<th>E-mail</th>
			<th>Телефон</th>
			<th>Город</th>
			<th>Привязаний аккаунт</th>
			<th>Последний визит</th>
			<th>Модерация</th>
			{$add_lines}
		</table>";

	$center.="
		<style>
			.changeUsers{
				display:table;
				margin: 0px 10px;
			}
			.changeLineUsers{
				display:table-cell;
			}
			.changeButUsers{
				border: 1px solid #ccc;
				background: white;
				padding: 4px 15px;
				margin: 0px 1px;
    			margin-bottom: -1px;
    			font-weight: bold;
    			color: #ccc;
    			cursor:pointer;
    			border-top-left-radius: 3px;
    			border-top-right-radius: 3px;
			}
			.changeButUsers.active{
				font-weight: bold;
    			color: #656565;
			}
			.sortable th{
				text-align: center;
    			vertical-align: middle;
			}
			.sortable td{
				text-align: center;
    			padding: 7px 3px;
    			vertical-align: middle;
			}
			.tabSP{
				border-collapse: collapse;
    			width: 100%;
			}
			.tabSP td{
				/*border: 1px solid #ccc;*/
				padding: 0px 0px;
    			text-align: inherit;
			}
			.icon-32-apply, .icon-32-cancel{
				display:table-cell;
				width: 25px;
    			height: 25px;
    			cursor:pointer;
    			background-size: 25px;
			}
		</style>
		<script>
			$(document).ready(function(){
				$('.changeButUsers').click(function(){
					var rel=$(this).attr('rel');
					$('.changeButUsers').removeClass('active');
					$(this).addClass('active');

					switch(rel){
						case '1':
							location.href='/?admin=all_users20';
							break;
						case '2':
							location.href='/?admin=all_users20&user=2';
							break;
						case '3':
							location.href='/?admin=all_users20&user=3';
							break;
					}
				});
			});
		</script>
	";
}

?>