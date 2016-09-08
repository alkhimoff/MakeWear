<?

if ($_SESSION['status']=="admin")
{

	$res=mysql_query("SELECT * FROM `users` WHERE `user_id`='{$_SESSION["user_id"]}' ");
	$row=mysql_fetch_assoc($res);

	$current = $_POST["current_old_pass"];
	$pass = $_POST["current_new_pass"];
	$pass2 = $_POST["current_new_pass2"];

	// echo $_POST["current_old_pass"]."<br/>";
	// echo $_POST["current_new_pass"]."<br/>";
	// echo $_POST["current_new_pass2"]."<br/>";
	// $center.="Change pass ".md5($row["user_realpassword"])." = ".$row["user_password"];
	
	$error="";
	$msg="";
	if(isset($current) && isset($pass)){
		if($pass!==$pass2){	
			$error="Не правильно повтор пароль";
		}else{
			if(md5($current)!==$row["user_password"]){
				$error="Неправильно старый пароль";
			}else{
				$md=md5($pass);
				mysql_query("UPDATE `users` SET `user_password`='{$md}', `user_realpassword`='{$pass}' WHERE `user_id`='{$_SESSION["user_id"]}' ");
				$msg="Уже переминелоcь";
			}
		}
	}

	$center.="
	<style>
		.body-pass{
			border: 1px solid gray;
		    display: inline-block;
		    margin: 10px;
		    padding: 10px;
		    background: #e6e6e6;
		}
		.body-pass label{
			display: inline-block;
		    width: 155px;
		    text-align: end;
		    padding-right: 6px;
		}
		.body-pass #butt{
			text-align: center;
		}
		.body-pass input[type='submit']{

		}
	</style>
	<div class='body-pass'>
		<form method='POST'>
			<label>Введите старый пароль</label><input type='password' name='current_old_pass' /><br/>
			<label>Введите новый пароль</label><input type='password' name='current_new_pass' /><br/>
			<label>Повтор пароль</label><input type='password' name='current_new_pass2' /><br/>";
		if(is_string($error)){
			$center.="<span style='color:red;'>{$error}</span>";
		}
		if(is_string($msg)){
			$center.="<span style='color:green;'>{$msg}</span>";
		}

	$center.="
			<div id='butt'><input type='submit' value='изменить пароль' /></div>
		</form>
	</div>
	";
}