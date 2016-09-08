<?php

namespace Modules;

require_once('../../../vendor/autoload.php');
require_once('../../../settings/conf.php');
require_once('../../../settings/connect.php');
require_once('../../../settings/functions.php');
require_once('../../../settings/main.php');

bd_session_start();

$db = MySQLi::getInstance()->getConnect();

	if(isset($_POST['con_payment'])){
		$rel=$_POST["rel"];
		$name=$_POST["name"];
		$site=$_POST["site"];
		$info=$_POST["info"];

		$com_sex=$_POST["com_sex"];
		$com_sex=substr($com_sex, 0,strlen($com_sex)-1);
		$t_tab=$_POST["t_tab"];
		//$t_tab=substr($t_tab, 0,strlen($t_tab)-1);

		$sel_sk=$_POST["sel_sk"];
		$sel_ot=$_POST["sel_ot"];
		$sel_na=$_POST["sel_na"];
		$sel_do=$_POST["sel_do"];
		$sel_pr=$_POST["sel_pr"];
		$sel_pr_sk=$_POST["sel_pr_sk"];
		$sel_pr_do=$_POST["sel_pr_do"];
		$sel_pr_price=$_POST["sel_pr_price"];
		$ot_min_price=$_POST["ot_min_price"];
		$sel_pr_ot=$_POST["sel_pr_ot"];
		$sel_pr_na=$_POST["sel_pr_na"];
		$ot_min_pr_price=$_POST["ot_min_pr_price"];

		$cont_name=$_POST["cont_name"];
		$cont_phone=$_POST["cont_phone"];
		$cont_mail=$_POST["cont_mail"];
		$cont_dop=$_POST["cont_dop"];

		$op_pl=$_POST["op_pl"];
		$op_name=$_POST["op_name"];
		$op_bank=$_POST["op_bank"];
		$op_chet=$_POST["op_chet"];
		$op_dop=$_POST["op_dop"];
		$de_city=$_POST["de_city"];
		$de_cpo=$_POST["de_cpo"];
		$de_address=$_POST["de_address"];
		$de_get=$_POST["de_get"];
		$de_dop=$_POST["de_dop"];




		// $bbb=mysql_query("SELECT * FROM `brenda_contact` WHERE `com_id`= '{$rel}' ")or die(mysql_error());
		// $b=mysql_fetch_assoc($bbb);

		$bbb=$db->query("SELECT * FROM `brenda_contact` WHERE `com_id`= '{$rel}' ");
		$b=$bbb->fetch_assoc();

		if(!$b){
			$db->query("INSERT INTO `brenda_contact`(
				`com_id`,
				`bc_name`, 
				`bc_site`, 
				`bc_info`, 
				`uc_opt_skidka`, 
				`uc_opt_natsenka`, 
				`uc_opt_otgruz`, 
				`uc_opt_delivery`, 
				`uc_opt_price`, 
				`uc_pr_skidka`, 
				`uc_pr_delivery`, 
				`uc_pr_price`, 
				`rek_pa_plat`, 
				`rek_pa_name`, 
				`rek_pa_bank`, 
				`rek_pa_shet`, 
				`rek_pa_dop`, 
				`rek_de_sity`, 
				`rek_de_sposib`, 
				`rek_de_address`, 
				`rek_de_get`, 
				`rek_de_dop`, 
				`cont_dop`, 
				`cont_name`, 
				`cont_phone`, 
				`cont_mail`, 
				`bc_commodity`,
				`ot_min_price`,
				`uc_pr_natsenka`, 
				`uc_pr_otgruz`, 
				`ot_min_pr_price`,
				`bc_table_size`) 
			VALUES (
				'{$rel}',
				'{$name}',
				'{$site}',
				'{$info}',
				'{$sel_sk}',
				'{$sel_ot}',
				'{$sel_na}',
				'{$sel_do}',
				'{$sel_pr}',
				'{$sel_pr_sk}',
				'{$sel_pr_do}',
				'{$sel_pr_price}', 
				'{$op_pl}', 
				'{$op_name}', 
				'{$op_bank}', 
				'{$op_chet}', 
				'{$op_dop}', 
				'{$de_city}', 
				'{$de_cpo}', 
				'{$de_address}', 
				'{$de_get}', 
				'{$de_dop}', 
				'{$cont_dop}', 
				'{$cont_name}', 
				'{$cont_phone}', 
				'{$cont_mail}', 
				'{$com_sex}',
				'{$ot_min_price}',
				'{$sel_pr_na}',
				'{$sel_pr_ot}',
				'{$ot_min_pr_price}',
				'{$t_tab}'
				)");
			echo "Сохранить";
		}
		else{
			$db->query("UPDATE `brenda_contact` SET `bc_name`='{$name}',`bc_site`='{$site}',`bc_info`='{$info}', `uc_opt_skidka`='{$sel_sk}', `uc_opt_natsenka`='{$sel_na}', `uc_opt_otgruz`='{$sel_ot}', `uc_opt_delivery`='{$sel_do}', `uc_opt_price`='{$sel_pr}', `uc_pr_skidka`='{$sel_pr_sk}', `uc_pr_delivery`='{$sel_pr_do}', `uc_pr_price`='{$sel_pr_price}', `rek_pa_plat`='{$op_pl}', `rek_pa_name`='{$op_name}', `rek_pa_bank`='{$op_bank}', `rek_pa_shet`='{$op_chet}', `rek_pa_dop`='{$op_dop}', `rek_de_sity`='{$de_city}', `rek_de_sposib`='{$de_cpo}', `rek_de_address`='{$de_address}', `rek_de_get`='{$de_get}', `rek_de_dop`='{$de_dop}', `cont_dop`='{$cont_dop}', `cont_name`='{$cont_name}', `cont_phone`='{$cont_phone}', `cont_mail`='{$cont_mail}', `bc_commodity`='{$com_sex}', `ot_min_price`='{$ot_min_price}', `uc_pr_otgruz`='{$sel_pr_ot}', `uc_pr_natsenka`='{$sel_pr_na}', `ot_min_pr_price`='{$ot_min_pr_price}', `bc_table_size`='{$t_tab}' WHERE `com_id`= '{$rel}' ");
			echo "Обновить";
		}
		
	}
	if(isset($_POST['contact_id'])){
		$arr=array();
		$id=$_POST['contact_id'];

		$ass=$db->query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$id}' ");
		$a=$ass->fetch_assoc();

		$name=$a['bc_name'];
		$site=$a['bc_site'];
		$info=$a['bc_info'];

		$uc_opt_skidka=$a['uc_opt_skidka'];
		$uc_opt_natsenka=$a['uc_opt_natsenka'];
		$uc_opt_otgruz=$a['uc_opt_otgruz'];
		$uc_opt_delivery=$a['uc_opt_delivery'];
		$uc_opt_price=$a['uc_opt_price'];

		$uc_pr_skidka=$a['uc_pr_skidka'];
		$uc_pr_delivery=$a['uc_pr_delivery'];
		$uc_pr_price=$a['uc_pr_price'];
		$uc_pr_natsenka=$a['uc_pr_natsenka'];
		$uc_pr_otgruz=$a['uc_pr_otgruz'];

		$op_pl=$a['rek_pa_plat'];
		$op_name=$a['rek_pa_name'];
		$op_bank=$a['rek_pa_bank'];
		$op_chet=$a['rek_pa_shet'];
		$op_dop=$a['rek_pa_dop'];
		$de_city=$a['rek_de_sity'];
		$de_cpo=$a['rek_de_sposib'];
		$de_address=$a['rek_de_address'];
		$de_get=$a['rek_de_get'];
		$de_dop=$a['rek_de_dop'];

		$cont_name=$a['cont_name'];
		$cont_phone=$a['cont_phone'];
		$cont_mail=$a['cont_mail'];
		$cont_dop=$a['cont_dop'];

		$com_sex=$a['bc_commodity'];
		$ot_min_price=$a['ot_min_price'];
		$ot_min_pr_price=$a['ot_min_pr_price'];

		$t_tab=$a["bc_table_size"];

		$arr=array("name"=>$name, "t_tab"=>$t_tab, "site"=>$site, "info"=>$info,"ot_min_pr_price"=>$ot_min_pr_price, "uc_pr_otgruz"=>$uc_pr_otgruz,"uc_pr_natsenka"=>$uc_pr_natsenka,"uc_opt_skidka"=>$uc_opt_skidka,"uc_opt_natsenka"=>$uc_opt_natsenka,"uc_opt_otgruz"=>$uc_opt_otgruz,"uc_opt_delivery"=>$uc_opt_delivery,"uc_opt_price"=>$uc_opt_price, "uc_pr_skidka"=>$uc_pr_skidka,"uc_pr_delivery"=>$uc_pr_delivery,"uc_pr_price"=>$uc_pr_price, "op_pl"=>$op_pl, "op_bank"=>$op_bank, "op_name"=>$op_name, "op_chet"=>$op_chet, "op_dop"=>$op_dop, "de_city"=>$de_city, "de_cpo"=>$de_cpo, "de_address"=>$de_address, "de_get"=>$de_get, "de_dop"=>$de_dop, "cont_dop"=>$cont_dop, "cont_name"=>$cont_name, "cont_phone"=>$cont_phone, "cont_mail"=>$cont_mail, "com_sex"=>$com_sex, "ot_min_price"=>$ot_min_price);
		echo json_encode($arr);

	}


?>
