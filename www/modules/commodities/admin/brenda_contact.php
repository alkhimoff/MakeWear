<?
if ($_SESSION['status']=="admin"){

	$id=$_GET['id'];

	if($id)
		$img="<img src='/templates/shop/image/categories/{$id}/main.jpg' width='200px' style='margin-bottom: -62px;margin-top: -62px;' >";
	else
		$img="<span>LOGO</span>";

	if(empty($_GET["story"])){
		$active1="active";
			$txt='
	<div class="body_bc" rel='.$id.' >
		<table>
			<tr><td><span class="line_name" >БРЕНД</span></td><td></td><td><span class="line_name" >КОНТРАГЕНТ</span></td></tr>
			<tr><td>
				<div class="body_logo_img">
					<div class="brand-item brand-slider-'.$id.'" rel="'.$id.'"></div>
				</div>
			</td><td id="ta_tr">
				<div class="logo_info">
					<label style="width: 115px;" >НАВЗАНИЕ:</label><input type="text" id="bc_name" value="'.$name.'" /><br/>
					<label style="width: 115px;" >ВЕБ-САЙТ:</label><input type="text" id="bc_site" value="'.$site.'" /><br/>
					<label style="width: 115px;" >О БРЕНДЕ:</label><textarea id="bc_info" style="height: 120px;">'.$info.'</textarea>
				</div>
			</td>
			<td>
				<div class="logo_info">
					<label style="width: 115px;" >ФЛП</label><input type="text" class="con_flp" id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >ЕГРПОУ</label><input type="text" class="con_egp"  id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >ИНН</label><input type="text" class="con_inn"  id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >АДРЕС</label><input type="text"  class="con_add" id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >РС</label><input type="text"  class="con_pc" id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >БАНК</label><input type="text" class="con_bank"  id="bc_name" value="" style="width: 50%;" /><br/>
					<label style="width: 115px;" >МФО</label><input type="text" class="con_mfo"  id="bc_name" value="" style="width: 50%;" /><br/>
				</div>
				<br/>
					<span style="font-size:16px;">Скан-копии докумментов</span>
				<br/>
					<div style="display:table">
						<div style="display:table-cell">
							<div class="upload_up">
								<input type="file" class="upfile" />
								<div class="icon_upload"></div>
							</div>
						</div>
						<div style="display:table-cell">
							<div class="upload_up">
								<input type="file" class="upfile" />
								<div class="icon_upload"></div>
							</div>
						</div>
						<div style="display:table-cell">
							<div class="upload_up">
								<input type="file" class="upfile" />
								<div class="icon_upload"></div>
							</div>
						</div>
						<div style="display:table-cell">
							<div class="upload_up">
								<input type="file" class="upfile" />
								<div class="icon_upload"></div>
							</div>
						</div>
						<div style="display:table-cell">
							<div class="upload_up">
								<input type="file" class="upfile" />
								<div class="icon_upload"></div>
							</div>
						</div>
					</div>
			</td></tr>

		</table>
		<br/>
		<span class="line_name">ТОВАР</span>	
		<hr class="line" />
		<table>
		<tr><td>
		<div class="brenda_body">
			<div class="bre0">
			<span class="but_add add_commodity" style="float: left;margin: 0 4px;margin-top: 3px;" ></span>
				<select>
					<option>ОДЕЖДА</option>
					<option>ОБУВЬ</option>
					<option>АКСЕССУАРЫ</option>
				</select>
				<span class="but_sex sex_M" style="margin-left: -1px;">М</span>
				<span class="but_sex sex_W" style="margin-left: -1px;">Ж</span>
				<span class="but_sex sex_K" style="margin-left: -1px;">Д</span>
				<span class="but_sex sex_U" style="margin-left: -1px;">У</span>
			</div>
		</div>
		</td><td id="tab_tr">
			<div class="size_brenda">ТАБЛИЦА РАЗМЕРОВ<span id="size_plus"></span></div>
			<div class="tab_size" style="display:block">
				<button id="add_tr" title="Добавить строку">Добавить строку</button>
				<button id="add_last_td" title="Добавить столбцы">Добавить столбцы</button>
				<div style="display:table;height: 14px;" id="butDeleteRow"></div>
				<table id="table_size" class="brendaTableSize">
				</table>
			</div>
		</td></tr>
		</table>
		<br/>
		<br/>
		<span class="line_name">УСЛОВИЯ</span>	
		<hr class="line" />
		<table class="tab_po">
			<th>ОПТ</th><th>РОЗНИЦА</th>
			<tr><td>
				<label class="bor_label">СКИДКА:</label>
					<select class="sel_sk sel_skk"></select> %
				<br>
				<label class="bor_label">НАЦЕНКА:</label>
				<!--<select class="sel_na sel_skk"></select> %-->
				<input type="text" style="width:50px;" class="input_bor sel_na sel_skk" />
				<br>
				<label class="bor_label">ОТГРУЗКА:</label>
					<select class="sel_ot sel_skk"></select> мин/ед
					<input type="text" id="bc_name" style="width:50px;" class="input_bor ot_min_price" /> мин/грн
				<br>
				<label class="bor_label">ДОСТАВКА:</label>
				<select class="sel_do" style="width: 260px;">
						<option></option>
					</select><br>
				<label class="bor_label">ЦЕНА:</label>
					<select class="sel_pr" style="width: 260px;">
						<option></option>
					</select>
				<br>
			</td>

			<td style="display: inline-block;">
				<!--<label class="bor_label">СКИДКА:</label>-->
				<select class="sel_pr_sk sel_skk" style="margin: 7px;"></select> %
				<br>

				<!--<label class="bor_label">НАЦЕНКА:</label>-->
				<!--	<select class="sel_pr_na sel_skk"></select> -->
					<input type="text" style="width:50px;margin:7px;" class="input_bor sel_pr_na sel_skk" />
				<br>
				<!--<label class="bor_label">ОТГРУЗКА:</label>-->
					<select class="sel_pr_ot sel_skk" style="margin: 7px;"></select> мин/ед
					<input type="text" id="bc_name" style="width:50px;margin:7px;" class="input_bor ot_min_pr_price" /> мин/грн
				<br>

				<!--<label class="bor_label">ДОСТАВКА:</label>-->
				<select class="sel_pr_do" style="width: 260px;margin:7px;">
						<option></option>
					</select><br>
				<!--<label class="bor_label">ЦЕНА:</label>-->
					<select class="sel_pr_price" style="width: 260px;margin:7px;">
						<option></option>

					</select>
				<br>
				
			</td></tr>

		</table>
		<br/>
		<span class="line_name">КОНТАКТЫ</span>	
		<hr class="line" />
		<table class="tab_contact">
			<tr>
				<td>
					<div id="push_name">
					<label class="bor_label">ИМЯ:</label><input type="text" id="bc_name" class="input_bor cont_name" style="width: 250px;" />
					<span class="but_add add_name" style="position: absolute;margin-top: -38px;margin-left: 450px;"></span>
					</div><br>

					<div id="push_phone">
					<label class="bor_label">ТЕЛЕФОН:</label><input type="text" id="bc_name" class="input_bor cont_phone" style="width: 250px;" />
					<span class="but_add add_phone" style="position: absolute;margin-top: -38px;margin-left: 450px;"></span></div><br>
					
					<div id="push_mail">
					<label class="bor_label">ПОЧТА:</label><input type="text" id="bc_name" class="input_bor cont_mail" style="width: 250px;" />
					<span class="but_add add_mail" style="position: absolute;margin-top: -38px;margin-left: 450px;"></span></div><br>
				</td>
				<td style="display: inline-block;">
					<label class="bor_label">ДОПОЛНИТЕЛЬНО:</label>
					<textarea class="textarea_bor" id="cont_dop" style="height: 200px;" ></textarea>
				</td>
			</tr>
		</table>
		<br/>
		<span class="line_name">РЕКВИЗИТЫ</span>	
		<hr class="line" />
		<table class="tab_contact">
			<th>ОПЛАТА</th>
			<th>ДОСТАВКА</th>
			<tr>
				<td>
					<label class="bor_label">ВИД ПЛАТЕЖА:</label><input type="text" id="op_pl" class="input_bor" /><br>
					<label class="bor_label">Ф.И.О.</label><input type="text" id="op_name" class="input_bor" /><br>
					<label class="bor_label">БАНК:</label><input type="text" id="op_bank" class="input_bor" /><br>
					<label class="bor_label">№ СЧЕТА:</label><input type="text" id="op_chet" class="input_bor" /><br>
					<label class="bor_label">ДОПОЛНИТЕЛЬНО:</label>
					<textarea class="textarea_bor" id="op_dop"></textarea>
				</td>
				<td style="display: inline-block;">
					<label class="bor_label">ГОРОД:</label><input type="text" id="de_city" class="input_bor" /><br>
					<label class="bor_label">СПОСОБ</label><input type="text" id="de_cpo" class="input_bor" /><br>
					<label class="bor_label">№СКЛАДА/АДРЕС:</label><input type="text" id="de_address" class="input_bor" /><br>
					<label class="bor_label">ПОЛУЧАТЕЛЬ</label><input type="text" id="de_get" class="input_bor" /><br>
					<label class="bor_label">ДОПОЛНИТЕЛЬНО:</label>
					<textarea class="textarea_bor" id="de_dop"></textarea>
				</td>
			</tr>
		</table>
		<hr class="line" />
		<center><button id="save_brenda" >Сохранить</button></center>
	</div>



	';
	}elseif(isset($_GET["story"])) {
		$active2="active";
		include "soz.php";

		// $limit="LIMIT 10";

		$ress=mysql_query("
			SELECT * 
			FROM  `sup_group`
			WHERE `sup_id`='{$id}' AND `status` IN (4,5,6)
			ORDER BY `group_id` DESC {$limit};
		");

	while($roww=mysql_fetch_assoc($ress)){
		$group_id=$roww["group_id"];
		$date[$group_id]=$roww["date"];

		$statusGroup=$roww["status"];
		// $groupName=SOZ::getStatusGroup($statusGroup);
		// $addOption="<option value='{$statusGroup}' selected>{$groupName}</option>";
		//echo SOZ::getStatusGroup($statusGroup).", ";

		$sql = "SELECT * 
		FROM  `shop_orders` AS a
		INNER JOIN  `shop_orders_coms` AS b ON a.`id` = b.`offer_id` 
		WHERE b.`group_id`={$group_id}  ";

		//$sql = "SELECT *
		//		FROM  `sup_group` 
		//		INNER JOIN  `shop_orders_coms` 
		//		ON  `sup_group`.`group_id` =  `shop_orders_coms`.`group_id`
		//		WHERE  `com_status` in (1,3,4,5) AND `status` in (3,4,5,6,7) ORDER BY `sup_group`.`group_id` DESC";
	

	$res = mysql_query($sql);
	while($row = mysql_fetch_assoc($res)){
		// $idd2 = $row["id"];
		// echo $id.",";
		//$group_id = $row["group_id"];

		$ssent[$group_id] = $roww["payment_sent_mail"];
		$write_delii[$group_id]=$roww["write_payment"];
		$cclip[$group_id]=$roww["payment_clip"];
		$clip_file[$group_id]=$roww["payment_clip_file"];
		$clip_name[$group_id]=$roww["payment_clip_file"];
		

		if($cclip[$group_id]==1){
			$file2=$roww["payment_clip_file"]; 
			$urlFile="https://makewear.blob.core.windows.net/payment-p/".$file2;
		}
		
		if(!$numssd2[$group_id]){
			$numssd++;
			$numssd2=array($group_id=>1);
		}

		$com_id = $row["com_id"];
		$com_sum2 = $row["price"];
		$size = $row["com"];
		$count = $row["count"];
		$cur_id = $glb["cur"][$row["cur_id"]];
		$comment = $row["man_comment"];
		$com_status = $row["com_status"];
		if($row["com_color"] != "")
		{
			$color = $row["com_color"];
		}else{
			$color = strip_tags(get_color_to_order($com_id));
		}
		//$color = $row["com_color"];

		$select_cup[$group_id]=$row["cur_id"];
		$select_cupReal[$group_id]=$row["cur_id"];
		
		
		$sup_id[$group_id] = $roww["sup_id"];


		$off_id=$row['offer_id'];
		$of=mysql_query("SELECT * FROM `shop_orders` WHERE `id`='{$off_id}'");
		$off=mysql_fetch_assoc($of);
		$mail_o[$group_id]=$off['email'];
		$codd[$group_id]=$off['cod'];


		$status_group = $roww["status"];
		$status_groupp[$group_id] = $roww["status"];
		if($status_group == 1){
			$selected_group1[$group_id] = "selected";
		} elseif($status_group == 2) {
			$selected_group2[$group_id] = "selected";
		} elseif($status_group == 3) {
			$selected_group3[$group_id] = "selected";
		} elseif($status_group == 4) {
			$selected_group4[$group_id] = "selected";
		} elseif($status_group == 5) {
			$selected_group5[$group_id] = "selected";
		} elseif($status_group == 6){
			$selected_group6[$group_id] = "selected";
		} elseif($status_group == 7){
			$selected_group7[$group_id] = "selected";
		}elseif($status_group == 11){
			$selected_group11[$group_id] = "selected";
		}

		if($status_group<4 || $status_group == 11){
			$select_brande[$group_id]="
				<select size='1' name='status' id = 'select_group_status' class = 'color_select_group2' rel='{$group_id}'>
					<option value='3'  {$selected_group3[$group_id]}>Оплачен клиентом</option>
					<option value='11'  {$selected_group11[$group_id]}>Готов к оплате</option>
				    <option value='4'  {$selected_group4[$group_id]}>Оплачен поставщику</option>
				</select>";
		}else{
			$select_brande[$group_id]="
				<select style='color:white;' id = 'select_group_status' class = 'discolor_select_group2' disabled >
					<option value='3'  {$selected_group3[$group_id]}>Готов к оплате</option>
				    <option value='4'  {$selected_group4[$group_id]}>Оплачен поставщику</option>
				    <option value='6'  {$selected_group6[$group_id]}>Отправлен</option>
				    <option value='7'  {$selected_group7[$group_id]}>Доставлен</option>
				</select>";
		 }

		$groupName=SOZ::getStatusGroup($statusGroup);
		$addOption="<option value='{$statusGroup}' selected>{$groupName}</option>";

		$group_line[$group_id] ="";
		$com_selected1 = "";
		$com_selected2 = "";
		$com_selected3 = "";
		$com_selected4 = "";
		$com_selected5 = "";
		$com_selected0 = "";
		$com_selected6 = "";

		$linecolor = "";
		$status = $row["com_status"];
		if($status == 1){
			$com_selected1 = "selected";
			$linecolor = "greenline";
		} elseif($status == 2){
			$com_selected2 = "selected";
			$linecolor = "redline";
			$addOption="";
		} elseif($status == 3){
			$com_selected3 = "selected";
			$addOption="";
		} elseif($status == 0){
			$com_selected0 ="selected";
		} elseif($status == 4){
			$com_selected4 ="selected";
		} elseif($status == 5){
			$com_selected5 ="selected";
		} elseif($status == 6){
			$com_selected6 ="selected";
		}

		$bbb=mysql_query("SELECT * FROM `shop_categories` WHERE `categories_of_commodities_ID`='$sup_id[$group_id]'; ");
		while($b=mysql_fetch_assoc($bbb)){
		//	$sup_name[$group_id] = $b["cat_name"];
			$sup_name = $b["cat_name"];
		}

		$sql2 = "
			SELECT  `commodity_price` ,  `commodity_price2` ,  `com_name` ,  `from_url` ,  `cod` 
			FROM  `shop_commodity`  
			WHERE `commodity_ID` = {$com_id}";
		$res2 = mysql_query($sql2);
		if($row2 = mysql_fetch_assoc($res2)){
			//$com_price_set=0;

			$curSql=mysql_query("SELECT * FROM `shop_cur` WHERE `cur_id`={$row["cur_id"]}; ");
      		$curSqlVal=mysql_fetch_assoc($curSql);


			$cod = $row2["cod"];
			$name = $row2["com_name"];
			$from_url = $row2["from_url"];
			$com_name = $row2["com_name"];


			if($row["cur_id"]==2 || $row["cur_id"]==3){
				$com_price_set = round($com_sum2/$curSqlVal["cur_val"]);
				$realPrice=round($com_sum2/$curSqlVal["cur_val"]);
				$cur_id='грн';
				$select_cup[$group_id]=1;
			}else{
				$com_price_set = $com_sum2;
				$realPrice=$com_sum2;
			}
			$changeOptRoz[$group_id]=1;
			if($com_price_set==$row2["commodity_price"]){
				$changeOptRoz[$group_id]=1;
				$changePrice1[$group_id]='selected';
			}elseif($com_price_set==$row2["commodity_price2"]){
				$changeOptRoz[$group_id]=2;
				$changePrice2[$group_id]='selected';
			}

			$com_sum = $com_price_set*$count;
		}

		$brenda_flag[$group_id]=array();
		$sql3 = "SELECT * FROM `brenda_contact` WHERE `com_id`=$sup_id[$group_id]";
		$res3 = mysql_query($sql3);
		if($row3 = mysql_fetch_assoc($res3)){
			//$sup_name[$group_id] = $row3["sup_name"];
			$sup_margin_opt = $row3["uc_opt_skidka"];
			if(!$sup_margin_opt){
				$sup_margin_opt=0;
			}
			$sup_margin_roz = $row3["uc_pr_skidka"];
			if(!$sup_margin_roz){
				$sup_margin_roz=0;
			}

			$fromOpt=intval($row3["ot_min_price"]);
			$fromRoz=intval($row3["ot_min_pr_price"]);

			// if(is_numeric($fromOpt) && $fromOpt!=0){
			// 	$sup_margin_opt=0;
			// }
			// if(is_numeric($fromRoz) && $fromRoz!=0){
			// 	$sup_margin_roz=0;
			// }
			
			$skidka[$group_id]= $row3["uc_opt_skidka"];

			$skidka_opt[$group_id]= $row3["uc_opt_skidka"];
			$skidka_roz[$group_id]= $row3["uc_pr_skidka"];

			if($changeOptRoz[$group_id]==1){
				if($sup_margin_roz==0){
					$hideSkid[$group_id]=" style='display:none' ";
					$brenda_flag[$group_id]=0;
				}else{
					$brenda_flag[$group_id]=1;
				}
			}

			if($changeOptRoz[$group_id]==2){
				if($sup_margin_opt==0){
					$hideSkid[$group_id]=" style='display:none' ";
					$brenda_flag[$group_id]=0;
				}else{
					$brenda_flag[$group_id]=1;
				}
			}
		}
		$com_sum_our=0;
		$com_price_set_our=0;
		

		if((341<=$group_id && $group_id<=355) && $sup_id[$group_id]==15){ // Glem Акцiя -25% 16.05.2016 до 19.05.2016
			$com_sum-=$com_sum/100*25;
			$com_price_set-=$com_price_set/100*25;
		}


		if($changeOptRoz[$group_id]==1){
			$com_sum_our = $com_sum*(100-$sup_margin_roz)/100;
	      	$com_price_set_our = $com_price_set*(100-$sup_margin_roz)/100;
		}
		if($changeOptRoz[$group_id]==2){
			$com_sum_our = $com_sum*(100-$sup_margin_opt)/100;
	      	$com_price_set_our = $com_price_set*(100-$sup_margin_opt)/100;
		}

		$lines[$group_id].="
			<tr id='{$row["id"]}' >
				<td>
					<input type=\"checkbox\" class=\"cl_trt\" rel=\"{$row["id"]}\" rel-id=\"{$com_id}\">
				</td>
				<td>{$sup_name}</td>
				<td>{$cod}</td>
				<td>{$name}</td>
				<td>{$color}</td>
				<td>{$size}</td>
				<td>{$count}</td>
				<td  rel-real-price={$realPrice}>{$cur_id}</td>
				<td>{$com_price_set}</td>
				<td {$hideSkid[$group_id]} class='closeTdSki{$group_id}' >{$com_price_set_our}</td>
				<td>{$com_sum}</td>
				<td {$hideSkid[$group_id]} class='closeTdSki{$group_id}' >{$com_sum_our}</td>
				<td><a href ='{$from_url}'>Источник</a></td>
				<td>
					<select size='1' name='status' id = 'select_status_com' rel = '{$row['id']}' disabled>
						<option value='0' {selected0}></option>
						<option value='1' rel='{$row2['id']};1' {$com_selected1}>Есть в наличии</option>
		    			<option value='2' rel='{$row2['id']};2' {$com_selected2}>Нет в наличии</option>
		    			<option value='3' rel='{$row2['id']};3'{$com_selected3}>Замена</option>
		    			{$addOption}
					</select>
				</td></td>
				<td>{$comment}</td>
			</tr>";
		
		$add_line[$group_id]=$sup_name; 
		$cur[$group_id]=$cur_id;

		$total_price_to_pay[$group_id] += $com_sum*(100-$sup_margin_opt)/100;
		
		$bcc=mysql_query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$sup_id[$group_id]}';") or die(mysql_error());
		
		if($bcc) {
			$bb=mysql_fetch_assoc($bcc);
			$nameBrend[$group_id]=$bb["rek_pa_name"];
			$bank[$group_id]=$bb["rek_pa_bank"];
			$fl[$group_id]=$bb["rek_pa_plat"];
			$chet[$group_id]=$bb["rek_pa_shet"];
			$tel[$group_id]=$bb["cont_phone"];
			$tel[$group_id]=str_replace(";",",",$tel[$group_id]);
			$tel[$group_id]=substr($tel[$group_id],2,strlen($tel[$group_id]));
			$emaill[$group_id]=$bb["cont_mail"];
			$emaill[$group_id]=str_replace(";",",",$emaill[$group_id]);
			$emaill[$group_id]=substr($emaill[$group_id],2,strlen($emaill[$group_id]));
			$prim[$group_id]=$bb["rek_pa_dop"];

			// echo $name2[$group_id].", ";

		}
		
		if($status!=2){	
			if($changeOptRoz[$group_id]==1){
				$total_price_to_pay[$group_id] += $com_sum*(100-$sup_margin_roz)/100;
			}
			if($changeOptRoz[$group_id]==2){
				$total_price_to_pay[$group_id] += $com_sum*(100-$sup_margin_opt)/100;
			}

			if($brenda_flag[$group_id]==0){
				$total_price[$group_id] += $com_sum;
			}
			if($brenda_flag[$group_id]==1){
				$total_price[$group_id] += $com_sum_our;
			}

			$total_count[$group_id] += $count;

			$result_sum += $com_sum;
			if($changeOptRoz[$group_id]==1){
				$result_sum_to_pay += $com_sum*(100-$sup_margin_roz)/100;
			}
			if($changeOptRoz[$group_id]==2){
				$result_sum_to_pay += $com_sum*(100-$sup_margin_opt)/100;
			}
			$result_quantity += $count;


			if($sup_id[$group_id]==48 || $sup_id[$group_id]==47){
				$total_price[$group_id] += $total_price[$group_id] / 100 * 0.5;
			}
		}
		
	}

}
		$result_profit = $result_sum - $result_sum_to_pay;

				
		$txt.="<div id='pay_body' style='display: none'>
					<div id='pay_mail'>
						<div class='topDiv' >
							<div class='icon_close pay_close' ></div>
						</div>
						<label>Кому: </label><input type='text' name='' class='in_text' id='from_to' /><br/>
						<label>От кого: </label><input type='text' value='sales@makewear.com.ua' name='' class='in_text' id='from_whom' /><br/>
						<label>Тема: </label><input type='text' name='' class='in_text' id='from_sub' /><br/>
						
						<div class='html_mail' >
						</div>
						<div style='position: relative;height: 50px;'>
							<div class='send but_send'>Отправить</div>
							<button class='pay_close2 but_close'>Отмена</button>
						</div>
					</div>
				</div>";
//--------------------------------------------------------------------
	if($group_line){
	foreach ($group_line as $key => $value) {
			$selectCup1=null;
			$selectCup2=null;
			$selectCup3=null;
			$val1=null;
			$val2=null;
			$val3=null;
			switch ($select_cup[$key]) {
				case 1:
					$selectCup1='selected';
					break;
				case 2:
					$selectCup2='selected';
					break;
				case 3:
					$selectCup3='selected';
					break;
			}
			$curSql=mysql_query("SELECT * FROM `shop_cur` WHERE 1; ");
      		while($curSqlVal=mysql_fetch_assoc($curSql)){
      			
      			switch ($curSqlVal["cur_id"]) {
					case 1:
						$val1=$curSqlVal["cur_val"];
						$curname1=$curSqlVal["cur_show"];
						break;
					case 2:
						$val2=$curSqlVal["cur_val"];
						$curname2=$curSqlVal["cur_show"];
						break;
					case 3:
						$val3=$curSqlVal["cur_val"];
						$curname3=$curSqlVal["cur_show"];
						break;
				}
      		}

			$group_line[$key].="
			<table class ='tab_cat sortable'>
			<tr>
				<th><input type='checkbox' class='changeAllBox' rel='{$key}' /></th>
				<th>Бренд</th>
				<th>Артикул</th>
				<th>Название</th>
				<th>Цвет</th>
				<th>Размер</th>
				<th>Кол-во</th>
				<th>
					Валюта
					<select class='change_tab_cup' id='getCup{$key}' rel='{$key}' rel-skidki='{$skidka[$key]}'  >
						<option value='1' {$selectCup1} rel-val='{$val1}' rel-name-cur='{$curname1}' >UAH</option>
						<option value='2' {$selectCup2} rel-val='{$val2}' rel-name-cur='{$curname2}' >USD</option>
						<option value='3' {$selectCup3} rel-val='{$val3}' rel-name-cur='{$curname3}' >RUB</option>
					</select>	
				</th>
				<th style='width:125px'>
					Цена
					<select class='change_price_opt' id='getSki{$key}' rel='{$key}' rel-cur='{$select_cup[$key]}' rel-real-cur='{$select_cupReal[$key]}' >
						<option value=1 {$changePrice1[$key]} rel-skidki='{$skidka_roz[$key]}' >Розница</option>
						<option value=2 {$changePrice2[$key]} rel-skidki='{$skidka_opt[$key]}'>Опт</option>
					</select>		
				</th>
				<th {$hideSkid[$key]} class='closeTdSki{$key}' >Цена со скидкой</th>
				<th>Сумма</th>
				<th {$hideSkid[$key]} class='closeTdSki{$key}' >Сумма со скидкой</th>
				<th>Ссылка</th>
				<th>Статус</th>
				<th>Комментарий</th>
			</tr>

			";
			$group_line[$key].=$lines[$key];
			$group_line[$key] .="</table></td></tr>";
	}
}
//--------------------------------------------------------------------
	
	$add_line2="";
	if($add_line){
		foreach($add_line as $k=>$v){
			$names="";
			if($nameBrend[$k]){
				$name_a=explode(" ", $nameBrend[$k]);	
						
				$names=mb_ucfirst($name_a[0], "utf-8");
				if($name_a[1]){
					$names.=" ".mb_ucfirst(substr($name_a[1],0,2), "utf-8").".";
				}
				if($name_a[2]){
					$names.=mb_ucfirst(substr($name_a[2],0,2), "utf-8").".";	
				}
			}

			 if($ssent[$k]==0){
				$signal_sent="<div class='icon_send'></div>";
			 }	elseif($ssent[$k]>=1){
			 	$signal_sent="<div class='icon_sent' rel-was-sent='{$ssent[$k]}'></div>";	
			 }	
			
			if($cclip[$k]==0) {
				$clip="<div class='icon_clip_will' style='cursor:pointer;' rel='{$k}'></div>";
			}elseif($cclip[$k]==1) {
				$clip="<div class='icon_clip_was icw{$k}' style='cursor:pointer;' rel='{$k}' rel-file='{$clip_file[$k]}' rel-size='{$size_kb[$k]}' rel-name='{$clip_name[$k]}' ></div>";	
			}	

			$write_deli=$write_delii[$k];
			if($write_deli==""){
				$putInfoColor="icon_info_white";
				$putDownColor="block_down";
				$putInfo="wind_o2";
			}else{
				$putInfoColor="icon_info_orange";
				$putDownColor="block_down1_orange";
				$putInfo="wind_o2_orange";
			}


			$total_price[$k]=round($total_price[$k], 2);
			$add_line2.="<tr class='tab_up forsearch' style='{$active[$k]}' id='gh{$k}'>
				<td style='border-bottom: 0px solid;'></td>
				<td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						<div style='display:table;'>
							<div style='display:table-cell;padding-right: 5px;'>
								<span class='but_open_win' rel='{$k}' style='cursor:pointer'>
									<div class='block_down' id='bb{$k}' ></div>
								</span>
							</div>
							<div style='display:table-cell;'>
								{$k}
							</div>
						</div>
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2 cli_date'>
						{$date[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						{$add_line[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						{$select_brande[$k]}
			    	</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						{$total_count[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2' id='addPrice'>
						{$total_price[$k]} {$cur[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						
								<div class='wind_o open_backg' rel='{$k}' style='cursor:pointer;display:table;position: absolute;margin-top: -9px;'>
									<div style='display:table-cell;padding-left: 5px;padding-bottom: 9px;' rel-real-name='$nameBrend[$k]'>
										{$names}
									</div>
									<div style='display:table-cell;padding-left:3px;padding-right: 5px;'>
										<div class='block_down bc{$k}'></div>
									</div>
								</div>
								<div class='wind_names' id='open_win{$k}' style='display:none;max-height: 500px;'>
									<table>
										<tr><td></td><td></td></tr>
										<tr><td>Телефон:</td><td>{$tel[$k]}</td></tr>
										<tr><td></td><td></td></tr>
										<tr><td>E-mail:</td><td>{$emaill[$k]}</td></tr>
										<tr><td></td><td></td></tr>
										<tr><td>Примечание:</td><td class='getpri{$k}'>{$prim[$k]}</td></tr>
										<tr><td></td><td></td></tr>
									</table>
								</div>
						
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
							{$bank[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
							{$fl[$k]}
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						<div class='get_shet{$k}' >
							{$chet[$k]}
						</div>
					</div></div>
				</td><td style='border-bottom: 0px solid;'>
					<div class='hdiv'><div class='hdiv2'>
						<div style='display:table;margin-top: -4px;margin-bottom: -4px;margin-right: 10px;'>
							<div class='send_ac{$k}' style='display:table-cell;padding-right: 4px;vertical-align: middle;' >
								<span class='maill sentt$k' rel='{$k}' rel2='{$emaill[$k]}' art='{$codd[$k]}' rel-cat='{$catt[$k]}' >
									{$signal_sent}
								</span>
							</div>

							<div class='change_clip{$k}'   style='display:table-cell;padding-right: 4px;vertical-align: middle;' >
								{$clip}
							</div>
							<div  style='display:table-cell;'  >
								<div class='{$putInfo} open_backg' id='iiw{$k}' rel='{$k}' style='display:table;'>
									<div style='display:table-cell'>
										<div class='{$putInfoColor} iiw{$k}'></div>
									</div>
									<div style='display:table-cell;vertical-align: middle;padding-left: 2px;'>
										<div class='{$putDownColor} bbc{$k}' ></div>
									</div>
								</div>	
									
								<div class='wind_names' id='open_win2{$k}' style='display:none;right:16px;margin-top:0px;width: 300px;'>
									<table>
										<tr><td></td></tr>
										<tr>
											<td style='font-weight:100;text-align: left;width:300px;height: 90px;' contenteditable='true' class='write_tab' rel='{$k}'>
											{$write_deli}
											</td>
										</tr>
										<tr><td></td></tr>
									</table>
								</div>
								
							</div>
						</div>
					</div></div>
				</td>
		</tr>
		<tr>
			<td style='border-bottom: 0px solid #CCC;'></td>
			<td colspan=11 style='padding-top: 0px;border-bottom: 0px solid #CCC;' >
			<div class='open_line open_commodity{$k}' style='display:none;' >
				{$group_line[$k]}
		 	</div>
		 	</td>
		</tr>";
		}
	}
	

	$txt.="
		<div class='body_upload' style='display:none'>
			<div class='bbb2'>
			<div style='overflow-y: scroll;height: 100%;'>
				<div class='wind_upload' style='display:block'>
				
						<div class='close_upload icon_close' ></div>
						<div>ПОДТВЕРЖДЕНИЕ ОПЛАТЫ</div>
						<div class='names'>Заказ №<span id='get_upload_order'></span>; Сумма<span id='get_upload_price' ></span></div>	
							<div id='uupp' >
								<div>
									ЗАГРУЗИТЬ ДОКУМЕНТ
								</div>
								 <input type='file' name='file' class='upload' />
							</div>				
						<div>
							Загрузите скан-копию документа, подтверждающего осуществление оплаты.<br/>
							Допустимые форматы: JPG; PNG; PDF
						</div>
					
				</div>
				<div class='show_file' style='display:none' >
					<div class='close_upload icon_close' ></div>
					<div class='see_file'>
						
					</div>
					
					<div style='display:table;width: 100%;'>	
						<div style='display:table-cell;width: 10px;' >				
							<div class='any_file'>
								<div class='icon_file_upload' ></div>
								Загрузить другой файл
								<input type='file' name='file' class='upload' />
							</div>
							<div class='delete_file'  >
								<i class=\"fa fa-times\" aria-hidden=\"true\"></i>Удалить
							</div>
						</div>
						<!--<div style='display:table-cell;text-align: left;' >
							<div id='singal_upload'>OK</div>
						</div>-->
						<div style='display:table-cell;position: relative;'>
														
							<div class='name_file' >
								<div style='display:table;width: 100%;'>
									<div style='display:table-row' style='padding:2px;' >
										<table>
											<tr>
												<td>
													<div class='icon_file_jpg'></div>
												</td>
												<td>
													<span class='set_name' style='font-size: 11px; color: black;' ></span><br/>
													<span class='set_size' style='font-size:10px; color:gray;' /></span>
												</td>
											</tr>
										</table>
										<br/>
									</div>
									<div style='display:table-row;background: #E8E7E7;color: #5F5F5F;'>
										<div style='padding: 4px;' >								 		
								 		Прикреплено: 1файл. Общий размер:<span class='set_size' />
								 		</div>
								 	</div>
							 	</div> 
							</div>
						</div>
					</div>				
				</div>
			</div>
			</div>
		</div>
		";
	$txt.="	<table class='sortable order_to_sup'>
				<th style='width: 1px;' ></th>
				<th>№</th>
				<th>Дата</th>
				<th>Бренд</th>
				<th>Статус</th>
				<th>Единиц</th>
				<th>Сумма</th>
				<th style='width: 15%;'>Контрагент</th>
				<th>Банк</th>
				<th>Вид платежа</th>
				<th>№ счета/карт</th>
				<th style='width:88px;'></th>
				{$add_line2}
		</table>{$links}";
	$txt.="
		<script src='/templates/admin/js/i18n/datepicker-uk.js' type='text/javascript'></script>
		<script src='/templates/admin/js/i18n/datepicker-ru.js' type='text/javascript'></script>	
		<script src='/templates/admin/soz/js/orders_to_sup20.js'></script>
		<link href='/templates/admin/soz/style/order20.css' type='text/css' rel='stylesheet' />
			";

// }


	}



	$center="
		<div class='bcLine' >
			<div class='bcLineTd'>
				<div class='bcLineBut {$active1}' data-href='/?admin=brenda_contact&id=".$id."'>Карточка</div>
			</div>
			<div class='bcLineTd'>
				<div class='bcLineBut {$active2}' data-href='/?admin=brenda_contact&id=".$id."&story=true'>История</div>
			</div>
		</div>
		<div style='background: white;' >".$txt."</div>";
	$center.='<script type="text/javascript">
				var id='.($id).';
			</script>
	<script type="text/javascript" src="/templates/admin/soz/js/brenda_contact.js" ></script>
	<link href="/templates/admin/css/brenda_contact.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

';



}
?>