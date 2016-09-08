<?php
if ($_SESSION['status']=="admin")
{

include "soz.php";

	$active=array();
	$but_active=array();
	$brendam_active=array();



	// Pagination LIMIT


	if(isset($_POST["sel_link"])){
		$_SESSION["select_link"]=$_POST["sel_link"];
	}
	if(isset($_SESSION["select_link"])){
		$limit_rows=$_SESSION["select_link"];
		switch ($limit_rows) {
			case 10:
				$limitSelected10="selected";
				break;
			case 25:
				$limitSelected25="selected";
				break;
			case 50:
				$limitSelected50="selected";
				break;
			case 75:
				$limitSelected75="selected";
				break;
			case 100:
				$limitSelected100="selected";
				break;
			default:

				break;
		}
	}else{
		$limit_rows=100;
	}


	$pagge=$_GET['p'];
	$archive=$_GET['archive'];

	//echo $archive.": ".$_GET["p"];
	if($archive=='true'){
		$status="`status` IN (5,6,7, 13) AND `com_status` < 6";
		$but_orr2="but_nn_active";
		$but_style2="border-bottom: 0px solid gray;color: black;";
	}else{
		$status="`status` IN (1,2,3,4,8, 12) AND `com_status` < 5";
		$but_orr1="but_nn_active";
		$but_style1="border-bottom: 0px solid gray;color: black;";
	}

	$mysql_len=mysql_query("
		SELECT a.`id` AS or_id, a.`offer_id`, `group_id` , b.`id` , `com_status` , `status`, `com_id`
		FROM `shop_orders_coms` AS a
		INNER JOIN `shop_orders` AS b ON a.`offer_id` = b.`id`
		WHERE {$status}
		ORDER BY a.`id` DESC ;
		");
	$lengths=mysql_num_rows($mysql_len);

	if(isset($archive)){
	if($lengths>0){
		if($pagge){
			$page=$pagge;
		}else{
			$page=1;
		} 
		$pages=$limit_rows*($page-1);
		$limit="LIMIT {$pages}, {$limit_rows}";
		$length_links=ceil($lengths/$limit_rows);

		$server=$_SERVER["REQUEST_URI"];
		if(strpos($server, "&p=")!==flase){
			$server=str_replace("&p={$page}","",$server);
		}

		$links="<div class='links'><div class='links_div'><ul class='links_li'>";
		$page1=$page-1;
		if($page<=1){
			// $links.="<li style='color:gray' ><<</li>";
		}else{
			$links.="<a href='{$server}&p={$page1}' ><li><<</li></a>";
		}

		if($length_links>10){
			if($page!=1){
				$links.="<a href='{$server}&p=1' ><li>1</li></a>";
			}
			$page_prev=$page-1;
			$page_prev2=$page-2;
			$page_prev3=$page-3;
			$page_next=$page+1;
			$page_next2=$page+2;
			$page_next3=$page+3;

			if($page > 4){
				$links.="<li class='leng_span'> <span>. . .</span> </li>";
			}
			if($page > 3){
				$links.="<a href='{$server}&p={$page_prev2}' ><li>{$page_prev2}</li></a>";
			}
			if($page > 2){
				$links.="<a href='{$server}&p={$page_prev}' ><li>{$page_prev}</li></a>";
			}	

			$links.="<li class='active'>{$page}</li>"; // active

			if($page < $page+1 && $page <= $length_links-2){
				$links.="<a href='{$server}&p={$page_next}' ><li>{$page_next}</li></a>";
			}
			if($page < $page+2 && $page <= $length_links-3){
				$links.="<a href='{$server}&p={$page_next2}' ><li>{$page_next2}</li></a>";
			}
			if($page < $length_links-3){
				$links.="<li class='leng_span'> <span>. . .</span> </li>";
			}
			if($page != $length_links){
				$links.="<a href='{$server}&p={$length_links}' ><li>{$length_links}</li></a>";
			}
			
		}else{
			for($i=1; $i<=$length_links; $i++){
				if($page==$i){
					$links.="<li class='active'>{$i}</li>";
				}else{
					$links.="<a href='{$server}&p={$i}' ><li>{$i}</li></a>";
				}
			}
		}

		$page2=$page+1;
		if($page2 == $length_links+1){
			//$links.="<li style='color:gray' >>></li>";
		}else{
			$links.="<a href='{$server}&p={$page2}' ><li>>></li></a>";
		}
		$links.="</ul></div></div>";
		$links.="<form active='{$server}' method='POST' id='links_select'>
						<select onchange=\"this.form.submit()\" name='sel_link' style='margin-left: 10px;' >
							<option value='10' {$limitSelected10}>10</option>
							<option value='25' {$limitSelected25}>25</option>
							<option value='50' {$limitSelected50}>50</option>
							<option value='75' {$limitSelected75}>75</option>
							<option value='100' {$limitSelected100}>100</option>
						</select>
					</form>
					<br/>";
	}
	}else{
		$limit="LIMIT 200";
	}
//-----End Pagination------

	// $comm=mysql_query("SELECT * FROM `shop_orders_coms` AS a 
	// 						INNER JOIN `shop_orders` AS b ON a.`offer_id`=b.`id` 
	// 						WHERE `status` IN (1,3) AND `com_status` IN (0,1,2,3)");
	$comm=mysql_query("SELECT a.`id` AS or_id, b.`cur_id` AS curClient, a.`offer_id`, `group_id`, b.`id`, `com_status`, `status`, `com_id`
		FROM `shop_orders_coms` AS a
		INNER JOIN `shop_orders` AS b ON a.`offer_id` = b.`id`
		WHERE {$status}
		ORDER BY a.`id` DESC {$limit}; ");

	//`status` <5 `com_status` <6
	while($com=mysql_fetch_assoc($comm)) {
		$offer_iddd=$com['offer_id'];
		$com_id=$com['com_id'];
		$or_id=$com['or_id'];
		$gro_id=$com['group_id'];
		$iid=$com['id'];

		$date=$com["date"];

		$curClient[$gro_id]=$com["curClient"];
		$order_commodity[$com['or_id']]=$com['com_id'];
		$order_id[$com['or_id']]=$com['offer_id'];
		$order_group[$com['or_id']]=$com['group_id'];
		
		//<5	
		$gr=mysql_query("SELECT * FROM `sup_group` WHERE `status` in (1,2,3,4,5, 11) AND `group_id`='{$gro_id}' ");
		$gro=mysql_fetch_assoc($gr);
		$gro2=$gro['sup_id'];
		$gr_id=$gro["group_id"];

		$brendam_active[$gro2][0]=0;
		$brendam_active[$gro2][1]=0;


		if($gro_id!=0 && $gro2==true){
			$group_id[$gro_id]=$gro2;

			$group_sent[$gro_id]=$gro["sent_email"];
			$write_delii[$gro_id]=$gro["write_payment"];
			$write_deliiImportant[$gro_id]=$gro["write_payment_important"];

			$gr_date[$gro_id]=$gro["sent_date"];
		
			$status_group = $gro["status"];
			$status_gr[$gro_id] = $gro["status"];
			$arr_status_group[$gr_id] = $gro["status"];

			if($status_group>=3){
				$groupName=SOZ::getStatusGroup($status_group);
				$addOption[$com['or_id']]="<option selected>{$groupName}</option>";
			}

			$selected_group1[$gr_id]="";
			$selected_group2[$gr_id]="";
			$selected_group3[$gr_id]="";
			$selected_group4[$gr_id]="";
			$selected_group5[$gr_id]="";
			$selected_group6[$gr_id]="";
			$selected_group10[$gr_id]="";
			$selected_group11[$gr_id]="";

			if($status_group == 1){
				$selected_group1[$gr_id] = "selected";
			} elseif($status_group == 2) {
				$selected_group2[$gr_id] = "selected";
			} elseif($status_group == 3) {
				$selected_group3[$gr_id] = "selected";
			} elseif($status_group == 4) {
				$selected_group4[$gr_id] = "selected";
			} elseif($status_group == 5) {
				$selected_group5[$gr_id] = "selected";
			} elseif($status_group == 6){
				$selected_group6[$gr_id] = "selected";
			}elseif($status_group == 10){
				$selected_group10[$gr_id] = "selected";
			}elseif($status_group == 11){
				$selected_group11[$gr_id] = "selected";
			}		
		}		

		$cat=mysql_query("SELECT `categories_of_commodities_parrent`,`categories_of_commodities_ID`,`cat_name`,`categoryID`,`commodityID`
							FROM `shop_categories` AS a
							INNER JOIN `shop_commodities-categories` AS b
							ON a.`categories_of_commodities_ID`=b.`categoryID`
							WHERE `categories_of_commodities_parrent`=10 
							AND `commodityID`='{$com_id}'");	
		$gr=mysql_fetch_assoc($cat);
			$cat_id=$gr['categories_of_commodities_ID'];
			$cat_name[$cat_id]=$gr['cat_name'];

			$commodity[$com_id]=$cat_id;
			$commodity_group[$com_id]=intval($gro_id);
			$group_cat[$com_id]=intval($gro_id);

			$get_brands[$cat_id]=$gr['cat_name'];

			$brandeId[$or_id]=$cat_id;
		
	}	


	if($order_commodity){	
		$group_count_total=array();
		$group_sum_total=array();
		$jj=0;

		foreach($order_commodity as $k_orid=>$v_comid){
			$oc_offed_id=$order_id[$k_orid];

			$groupid=$group_cat[$k_orid];

			// echo $oc_offed_id.", ";
			

			$add_comm[$group_cat[$k_orid]]="";
			$add_comm2[$group_cat[$k_orid]]="";

			if($count1[$commodity[$v_comid]]=="" || $count1[$commodity[$v_comid]]==0)
				$count1[$commodity[$v_comid]]=0;	
			if($count2[$commodity[$v_comid]]=="" || $count2[$commodity[$v_comid]]==0)
				$count2[$commodity[$v_comid]]=0;	
			
			$cat_name2=SOZ::getCategoryName($v_comid);		

			$shop_com=mysql_query("SELECT *, b.`id` AS iiid, a.`cod` AS cod_art, b.`count` AS count_a 
				FROM `shop_commodity` AS a 
				INNER JOIN `shop_orders_coms` AS b ON a.`commodity_ID`=b.`com_id`
				INNER JOIN `shop_orders` AS c ON c.`id`=b.`offer_id`
				WHERE `commodity_ID`='{$v_comid}' AND `offer_id`='{$oc_offed_id}'; ");
			
			while($shop=mysql_fetch_assoc($shop_com)){
				
				$s_id=$shop['iiid'];
				$cod=$shop["cod"];

			//	echo "a:",$s_id.", ";
				$cur=$glb["cur"][$shop["cur_id"]];

				$curSql=mysql_query("SELECT * FROM `shop_cur` WHERE `cur_id`={$shop["cur_id"]}; ");
				$curRes=mysql_fetch_assoc($curSql);

				$man_comment=$shop['man_comment'];
				$offer_id=$shop['offer_id'];
				$group_id_coms=$shop['group_id'];
				$cod_group=$shop['cod_art'];
				$size_group[$s_id] = $shop["com"];
				$com_name = $shop["com_name"];

				$count_group[$s_id] = $shop["count_a"];

				if($shop["cupplier_price"]==0){
					$com_price[$s_id] = round($shop["price"]/$curRes["cur_val"]);
				}else{
					$com_price[$s_id] = round($shop["cupplier_price"]/$curRes["cur_val"]);
				}
				// $com_price[$s_id] = round($shop["cupplier_price"]/$curRes["cur_val"]);
				if($shop["cur_id"]==2 || $shop["cur_id"]==3){
					$cur='грн';
				}

				// $com_price[$s_id]-=$com_price[$s_id]/100*25;

				// if(==15){
				// 	$price_or_opt[$s_id]=2;
				// 	$com_price[$s_id]-=$com_price[$s_id]/100*25;
				// }

				$com_price_poz[$s_id]=$shop["commodity_price"];
				$com_price_opt[$s_id]=$shop["commodity_price2"];

				$ccidd=$offer_id;

				$price_group[$s_id] = $com_price[$s_id]*$count_group[$s_id];
				$group_null=$shop['group_id'];
				$from_url=$shop['from_url'];
				$com_name=$shop['com_name'];
				
			//	echo $group_id_coms.", ";
				if($group_id_coms!=0){
					$group_count_total[$group_id_coms]+=$count_group[$s_id];
					$group_sum_total[$group_id_coms]+=$price_group[$s_id] ;
					$cur2[$group_id_coms]=$glb["cur"][$shop["cur_id"]];
					if($shop["cur_id"]==2 || $shop["cur_id"]==3){
						$cur2[$group_id_coms]='грн';
					}
				}

				// if($group_id_coms==167){
				// 	echo $group_count_total[$group_id_coms]."=".$count_group[$k_orid].", ";
				// }
				//------Select---------------------------
				$status_com = $shop["com_status"];
				$status_c[$order_group[$k_orid]] = $shop["status"];
				$com_selected1[$s_id] = "";
				$com_selected2[$s_id] = "";
				$com_selected3[$s_id] = "";
				$com_selected4[$s_id] = "";
				$com_selected5[$s_id] = "";
				$com_selected0[$s_id] = "";
				$com_selected6[$s_id] = "";

				$linecolor = "";
				if($status_com == 1){
					$com_selected1[$s_id] = "selected";
					$linecolor = "greenline";
					
					$count1[$commodity[$v_comid]]++;
					$count2[$commodity[$v_comid]]++;
				} elseif($status_com == 2){
					$com_selected2[$s_id] = "selected";
					$linecolor = "redline";
					$group_count_total[$group_id_coms] -= $count_group[$s_id];
					$group_sum_total[$group_id_coms] -= $price_group[$s_id] ;
					
					$count1[$commodity[$v_comid]]++;

					$addOption[$k_orid]="";
				} elseif($status_com == 3){
					$com_selected3[$s_id] = "selected";
					$group_count_total[$group_id_coms] -=$count_group[$s_id];
					$group_sum_total[$group_id_coms] -=$price_group[$s_id];

					$addOption[$k_orid]="";
				} elseif($status_com == 0){
					$com_selected0[$s_id] ="selected";
				} elseif($status_com == 4){
					$com_selected4[$s_id] ="selected";
				} elseif($status_com == 5){
					$com_selected5[$s_id] ="selected";
				} elseif($status_com == 6){
					$com_selected6[$s_id] ="selected";
				} 
				//------Color----------------------------------
				if($shop["com_color"] == ""){
					$color[$s_id] = strip_tags(get_color_to_order($v_comid));
				} else{
					$color[$s_id] = $shop["com_color"];
				}
				//-------Date---------------------
				$res14 = mysql_query("SELECT * FROM `shop_orders` WHERE `id`={$offer_id}");
				if($row14 = mysql_fetch_assoc($res14)){
					$date_group = $row14["date"];
					$date1 = strtotime($date_group); 
				}

				$url_site=$shop['from_url'];
				// $url_group=$row11["alias"]!=""?"/pr{$shop["com_id"]}_{$shop["alias"]}/":"/pr{$shop["com_id"]}/";
				$url_group="/product/".$v_comid."/".$shop["alias"].".html";

				if($brandeId[$k_orid]==48){
					$comisia="comisia";
				}	
				if($brandeId[$k_orid]==47){
					//$shop['commodity_price2'];
					$opt47=$shop['commodity_price2']*$group_count_total[$group_id_coms];
					$optp47=$shop['commodity_price2'];
				}

				$bbb2=mysql_query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$brandeId[$k_orid]}';");
				$b2=mysql_fetch_assoc($bbb2);
				$skidka = $b2["uc_opt_skidka"];
				$selRoz = $b2["uc_pr_skidka"];
				$selOpt = $b2["uc_opt_skidka"];	


				$price_or_opt[$s_id]=0;
				$changeRozSelected[$group_id_coms]='';
				$changeOptSelected[$group_id_coms]='';

				$hideSkid="";
				if($shop["commodity_price"]==$com_price[$s_id]){
					$price_or_opt[$s_id]=1;
					$changeRozSelected[$group_id_coms]='selected';
					$com_price2 = $com_price[$s_id]-$com_price[$s_id]/100*$selRoz;
					$price_group2 = $price_group[$s_id]-$price_group[$s_id]/100*$selRoz;

					if($selRoz==0){
						// $hideSkid=" style='display:none' ";
					}
				}
				if($shop["commodity_price2"]==$com_price[$s_id]){
					$price_or_opt[$s_id]=2;
					$changeOptSelected[$group_id_coms]='selected';
					$com_price2 = round($com_price[$s_id]-$com_price[$s_id]/100*$selOpt, 0);
					$price_group2 = round($price_group[$s_id]-$price_group[$s_id]/100*$selOpt, 0);

					if($selOpt==0){
						// $hideSkid=" style='display:none' ";
					}
				}
			}
			
				if($order_group[$k_orid]==0){
					if(!$add_comm2[$commodity[$v_comid]]){
						$add_comm2[$commodity[$v_comid]]="
								<div class='status_bor cll{$commodity[$v_comid]}' style='display:none;' >
									<table>
										<tr>
											<td>
												<div class='cl_edittt cll{$commodity[$v_comid]}' style='cursor:pointer'>
													<div class='icon_group'></div>
													<div class='b_word'>группировать</div>
												</div>
											</td>
											<td>
												<div class='icon_status'></div>
												<div class='b_word select_open' rel='{$commodity[$v_comid]}'>изменить статус</div>
												<div class='sc{$commodity[$v_comid]} select_change' style='display:none' >
													<ul>
														<li rel=1 rel2='{$commodity[$v_comid]}' >Есть в наличии</li>
														<li rel=2 rel2='{$commodity[$v_comid]}' >Нет в наличии</li>
														<li rel=3 rel2='{$commodity[$v_comid]}' >Замена</li>
													<ul>
												</div>
											</td>
											<td>
												<div class='cl_delll cll{$commodity[$v_comid]}' style='cursor:pointer'>
													<div class='icon_delete'></div>
													<div class='b_word'>удалить</div>
												</div>
											</td>
										</tr>
									</table>
								</div>
								<!--<span class='cl_delll cll{$commodity[$v_comid]}'>Удалить <img src='/templates/admin/img/btnbar_del.png'></span>
			 					<span class='cl_edittt cll{$commodity[$v_comid]}'> Группировать<img src='/templates/admin/img/btnbar_edit.png'></span>-->
								<!--<table class = 'tab_brenda tab_top' style='margin-top: 5px;' >-->
								<div class='tab_commodity'>
							";
					}

					$brendam_active[$commodity[$v_comid]][0]=1;
				//echo $k_orid.", ";	
					$add_comm2[$commodity[$v_comid]].="

							<div class='table-row table_row_line but_active' id='get_com_cols{$k_orid}'>
								<div class='tab_td2 wid_in'>
									<input type='checkbox' class='cl_trt bb{$commodity[$v_comid]}' rel='{$k_orid}' rel2='{$commodity[$v_comid]}' style='margin-top: 4px;' />
								</div>
								<div class='tab_td2 tab_left_line wid_date'>
									{$cat_name2}
								</div>
								<div class='tab_td2 tab_left_line wid_art'>
									{$cod_group}
								</div>
								<div class='tab_td2 tab_left_line wid_color'>
									{$color[$k_orid]}
								</div>
								<div class='tab_td2 tab_left_line wid_size'>
									{$size_group[$k_orid]}
								</div>
								<div class='tab_td2 tab_left_line wid_count'>
									{$count_group[$k_orid]}
								</div>
								<div class='tab_td2 tab_left_line wid_cur'>
									{$cur}
								</div>
								<div class='tab_td2 tab_left_line wid_price' rel-opt='{$optp47}'>
									{$com_price[$k_orid]}
								</div>
								<div class='tab_td2 tab_left_line wid_sum' rel-opt='{$opt47}' >
									{$price_group[$k_orid]}
								</div>
								<div class='tab_td2 tab_left_line wid_url'>
									<a href ='{$url_group}'>{$url_group}</a>
								</div>
								<div class='tab_td2 tab_left_line wid_url'>
									<a href ='{$url_site}'>Источник</a>
								</div>
								<div class='tab_td2 tab_left_line wid_comment'>
									{$man_comment}
								</div>
								<div class='tab_td2 tab_left_line'>
									<select size='1' name='status' id = 'select_status_com' class='ssc{$k_orid}' rel = '{$k_orid}' style='margin-right: 8px;'>
										<option value='0' {$com_selected0[$k_orid]}></option>
										<option value='1' {$com_selected1[$k_orid]}>Есть в наличии</option>
				    					<option value='2' {$com_selected2[$k_orid]}>Нет в наличии</option>
				    					<option value='3' {$com_selected3[$k_orid]}>Замена</option>
				    				</select>
								</div>

							</div>


							";
						$add_group_cat2[$commodity[$v_comid]]=$add_comm2[$commodity[$v_comid]];
				//	$ret[$commodity[$v_comid]]=$add_group_cat2[$commodity[$v_comid]]."</table>";
					$ret[$commodity[$v_comid]]=$add_group_cat2[$commodity[$v_comid]]."</div>";
				}else{
					// echo $k_groid.", ";
					if(!$add_comm[$order_group[$k_orid]]){
						$add_comm[$order_group[$k_orid]]="<div class='open_line open_commodity{$order_group[$k_orid]}' style='display:none;' >
										<table class = 'sortable tab_brenda' id='but22_tab{$order_group[$k_orid]}' >
											<th>
											<input type=\"checkbox\" class=\"all_change\" rel=\"{$order_group[$k_orid]}\">
											</th>
											<th>Товар</th>
											<th>Артикул</th>
											<th>Название</th>
											<th>Цвет</th>
											<th>Размер</th>
											<th>Кол-во</th>
											<th>
												<select class='change_tab_cup' id='getCup{$order_group[$k_orid]}' rel='{$order_group[$k_orid]}' rel-skidki='{$skidka}'  >
													<option value='1' {$selectCup1} rel-val='{$glb["cur_val2"][1]}' rel-name-cur='{$glb["cur_show2"][1]}' >Валюта:UAH</option>
													<option value='2' {$selectCup2} rel-val='{$glb["cur_val2"][2]}' rel-name-cur='{$glb["cur_show2"][2]}' >Валюта:USD</option>
													<option value='3' {$selectCup3} rel-val='{$glb["cur_val2"][3]}' rel-name-cur='{$glb["cur_show2"][3]}' >Валюта:RUB</option>
												</select>
											</th>
											<th>
												<select class=\"change_price_opt {$comisia}\" id=\"getSki{$order_group[$k_orid]}\" rel=\"{$order_group[$k_orid]}\" rel-cur=\"{$curClient[$order_group[$k_orid]]}\" rel-brenda='{$brandeId[$k_orid]}'>
													<option value=\"1\" rel-skidki={$selRoz} {$changeRozSelected[$order_group[$k_orid]]}>Цена:Розница</option>
													<option value=\"2\" rel-skidki={$selOpt} {$changeOptSelected[$order_group[$k_orid]]}>Цена:Опт</option>
												</select>
											</th>
											<th {$hideSkid} class='closeTdSki{$group_idey}' >Цена со скидкой</th>
											<th>Сумма</th>
											<th {$hideSkid} class='closeTdSki{$group_idey}' >Сумма со скидкой</th>
											<th>Заказ К</th>
											<th>Ссылка на товар</th>
											<th>Источник</th>
											<th>Комментарий</th>
											<th>Статус</th>";
					}
					$add_comm[$order_group[$k_orid]].="
								<tr class = 'group_td gr_tab' id='{$k_orid}' rel='shop_orders_coms' rel2='id' rel-url='{$from_url}' rel-nameurl='{$com_name}' >
									<td class = 'group_td'>
										<input type='checkbox' class='c2_trt' rel='{$k_orid}' rel-id='{$v_comid}' style='margin-bottom: 0px;' /></td>
									<td class = 'group_td'>{$cat_name2}</td>
									<td class = 'group_td'>{$cod_group}</td>
									<td class = 'group_td'>{$com_name}</td>
									<td class = 'group_td'>{$color[$k_orid]}</td>
									<td class = 'group_td' style='text-align:center'>{$size_group[$k_orid]}</td>
									<td class = 'group_td' style='text-align:center'>{$count_group[$k_orid]}</td>
									<td class = 'group_td' style='text-align:center' rel-real-price={$com_price[$k_orid]} >{$cur}</td>
									<td class = 'group_td' style='text-align:center' rel-price-roz='{$com_price_poz[$k_orid]}' rel-price-opt='{$com_price_opt[$k_orid]}' rel-opt='{$optp47}' >{$com_price[$k_orid]}</td>
									<td class = 'group_td' style='text-align:center' {$hideSkid}>{$com_price2}</td>
									<td class = 'group_td' style='text-align:center' rel-opt-roz='{$price_or_opt[$k_orid]}' rel-opt='{$opt47}' >".($com_price[$k_orid]*$count_group[$k_orid])."</td>
									<td class = 'group_td' style='text-align:center' {$hideSkid}>".($com_price2*$count_group[$k_orid])."</td>
									<td class = 'group_td'>{$cod}</td>
									<td class = 'group_td'><a href ='{$url_group}'>{$url_group}</a></td>
									<td class = 'group_td'><a href ='{$url_site}'>Источник</a></td>
									<td id = 'man_comment' class='cl_edit'>{$man_comment}</td>
									<td><select size='1' name='status' id = 'select_status_com' class = 'forClient changeCommodity' rel = '{$k_orid}' rel-client='{$order_id[$k_orid]}' rel-group='{$order_group[$k_orid]}' >
												<option value='0' {$com_selected0[$k_orid]}></option>
												<option value='1' {$com_selected1[$k_orid]}>Есть в наличии</option>
					    						<option value='2' {$com_selected2[$k_orid]}>Нет в наличии</option>
					    						<option value='3' {$com_selected3[$k_orid]}>Замена</option>
					    					</select>
					        		</td>
								</tr>
							";
					
					$add_group_cat[$order_group[$k_orid]]=$add_comm[$order_group[$k_orid]]; // Gorup		
				}	
		}
		
	}


if($group_id){
	foreach($group_id as $k_groid=>$v_comid){

		$degroup="";
		$addCommodity="";

		if($group_sent[$k_groid]==0){
			$sendd="<div style='margin-top: 3px;'>
						<span class='send_mail sentt{$k_groid}' rel='{$k_groid}' rel2={$v_comid} style='cursor:pointer'>
							<div class='icon_send'></div>
							отправить
						</span>
					</div>";

			$degroup="<div class='c2_degroup under_line'>
							<div class='icon_degroup'></div>разгруппировать
						</div>";
			$addCommodity="<span class='add_commodity under_line' rel='{$k_groid}' rel_com='{$v_comid}'><div class='icon_dop'></div>дополнить</span>";
		}elseif($group_sent[$k_groid]>=1){
			$sendd="<div style='margin-top: 3px;'>
						<span class='send_mail sentt{$k_groid}' rel='{$k_groid}' rel2={$v_comid} style='cursor:pointer'>
							<div class='icon_sent' rel-was-sent='{$group_sent[$k_groid]}'></div>
							<span style='text-decoration:underline;color: rgb(248, 106, 5);'>отправлен</span>
						</span>
					</div>";

			$degroup="<div class='c2_degroup under_line' style='color: #171944;cursor:default;'>
							<div class='icon_degroup_active'></div>разгруппировать
						</div>";
			$addCommodity="<span class='add_commodity under_line' rel='{$k_groid}' rel_com='{$v_comid}' style='color: #171944;cursor:default;'><div class='icon_dop_active'></div>дополнить</span>";
		}
		$write_deli=$write_delii[$k_groid];
		if(strip_tags($write_deli)==""){
			$putInfoColor="icon_info_white";
			$putDownColor="block_down";
			$putInfo="wind_o2";
		}else{
			$putInfoColor="icon_info_orange";
			$putDownColor="block_down1_orange";
			$putInfo="wind_o2_orange";
		}

		$note_important=$write_deliiImportant[$k_groid];
			$checkbox="";
			if($note_important==1){
				$checkbox=" checked";

				$putInfoColor="icon_info_red";
				$putDownColor="block_down1_red";
				$putInfo="wind_o2_red";
			}



		if($arr_status_group[$k_groid] <= 3 || $status_c[$k_groid] <= 3){
			$brand_select[$k_groid]='
			<select size="1" name="status" id="select_group_status" class="eachStatus color_select_group auto_set'.$k_groid.'" rel="'.$k_groid.'" style="margin-top: 4px;margin-bottom: 4px;">
					<option value="1" '.$selected_group1[$k_groid].'>Новый заказ</option>
					<option value="2" '.$selected_group2[$k_groid].'>Обрабатывается</option>
					<option value="3" '.$selected_group3[$k_groid].'>Подтвержден</option>
					<option value="10" '.$selected_group10[$k_groid].'>Отменен</option>
    		</select>
			';
		}else{

			$statuss=SOZ::getStatusCommodity($status_c[$k_groid], $arr_status_group[$k_groid]);

			$brand_select[$k_groid]="<select style='margin-top: 4px;margin-bottom: 4px;color: white;' class='discolor_select_group eachStatus' rel='{$k_groid}' disabled >
				<option value='{$arr_status_group[$k_groid]}' selected>{$statuss}</option>
    		</select>";
		}

		$ret_group[$v_comid]="
				<div class='group_head tab_up {$but_active[$k_groid]}' id='gh{$k_groid}' style='{$active[$k_groid]}' >
					<div class='tab_td2' style='padding: 9px;'>
						<span class='but_open_win' rel='{$k_groid}'>
							<div class='block_down' id='bb{$k_groid}' ></div>
						</span>
					</div>
					<div class='tab_td2'>Заказ №{$k_groid}</div>
					<div class='tab_td2'>
						{$brand_select[$k_groid]}
					</div>
					<div class='tab_td2'>
						Единиц: <span id='gr_set_count{$k_groid}'>0</span>
					</div>
					<div class='tab_td2'>
						Сумма:  <span id='gr_set_summ{$k_groid}'>0</span> {$cur2[$k_groid]}
					</div>
					<div class='tab_td2'>
						
					</div>
					<div class='tab_td2'>
						{$gr_date[$k_groid]}
					</div>
					<div class='tab_td2 under_line'>
						{$sendd}
					</div>
					<div class='tab_td2'>
						{$degroup}
					</div> 
					<div class='tab_td2'>
						{$addCommodity}
					</div>
					<div class='tab_td2'>
						<div  style='display:table-cell;position: relative;'  >
								<div class='{$putInfo} open_backg' rel='{$k_groid}' style='display:table;'>
									<div style='display:table-cell'>
										<div class='{$putInfoColor} iiw{$k_groid}'></div>
									</div>
									<div style='display:table-cell;vertical-align: middle;padding-left: 2px;'>
										<div class='{$putDownColor} bbc{$k_groid}' ></div>
									</div>
								</div>	
									
								<div class='wind_names' id='open_win2{$k_groid}' style='display:none;right:-1px;margin-top:0px;width: 300px;'>
									<table>
										<tr><td>
											Отметить как важное <input type='checkbox' class='noteImportant' rel='{$k_groid}' {$checkbox} />
										</td></tr>
										<tr>
											<td>
												<div style='font-weight:100;text-align: left;width:300px;height: 260px;overflow-y: auto;' class='write_tab' rel='{$k_groid}'>
												{$write_deli}
												</div>
											</td>
										</tr>
									</table>
								</div>
								
							</div>
					</div>
				</div>";

		$ret[$v_comid].=$ret_group[$v_comid];
		$ret[$v_comid].=$add_group_cat[$k_groid]."</table></div>";

	}
}

if($get_brands){
		foreach ($get_brands as $k => $v) {
			$bbb=mysql_query("SELECT * FROM `brenda_contact` WHERE `com_id`='{$k}';");
			$b=mysql_fetch_assoc($bbb);
			$name="";
			if($b["cont_name"]){
				$name_a=explode(";", $b["cont_name"]);
				for($i=0; $i<count($name_a); $i++){
					if($i==1){
						$name.="<span class='border_gray'>{$name_a[$i]}</span>";
					}
					if($i>1){
						$phone.="<br/><span class='border_gray'>{$name_a[$i]}</span>";
					}
				}
			}
			$phone="";
			if($b["cont_phone"]){
				$phone_a=explode(";", $b["cont_phone"]);
				for($i=0; $i<count($phone_a); $i++){
					if($i==1){
						$phone.="<span class='border_gray'>{$phone_a[$i]}</span>";
					}
					if($i>1){
						$phone.="<br/><span class='border_gray'>{$phone_a[$i]}</span>";
					}
				}
			}
			$email="";
			if($b["cont_mail"]){
				$email_a=explode(";", $b["cont_mail"]);
				for($i=0; $i<count($email_a); $i++){
					if($i==1){
						$email.="<span class='border_gray'>{$email_a[$i]}</span>";
					}
					if($i>1){
						$phone.="<br/><span class='border_gray'>{$email_a[$i]}</span>";
					}
				}
			}


		if($b['rek_pa_plat'])
			$rek_plat=$b['rek_pa_plat'];
		else
			$rek_plat=" --- ";
		$payment_plat="<span class='border_gray2'>".$rek_plat."</span>";
		
		if($b['rek_pa_name'])
			$rek_name=$b['rek_pa_name'];
		else
			$rek_name=" --- ";
		$payment_name="<span class='border_gray2'>".$rek_name."</span>";
		
		if($b['rek_pa_bank'])
			$rek_bank=$b['rek_pa_bank'];
		else
			$rek_bank=" --- ";
		$payment_bank="<span class='border_gray2' >".$rek_bank."</span>";
		
		if($b['rek_pa_shet'])
			$rek_shet=$b['rek_pa_shet'];
		else
			$rek_shet=" --- ";
		$payment_shet="<span class='border_gray2' >".$rek_shet."</span>";
		
		if($b['rek_pa_dop'])
			$rek_dop=$b['rek_pa_dop'];
		else
			$rek_dop=" --- ";
		$payment_dop="<span class='border_gray2'>".$rek_dop."</span>";
	

		if($b['rek_de_sity'])
			$rek_de_sity=$b['rek_de_sity'];
		else
			$rek_de_sity=" --- ";
		$delivery_sity="<span class='border_gray2'>".$rek_de_sity."</span>";
		
		if($b['rek_de_sposib'])
			$rek_de_sposib=$b['rek_de_sposib'];
		else
			$rek_de_sposib=" --- ";
		$delivery_sposib="<span class='border_gray2'>".$rek_de_sposib."</span>";
		
		if($b['rek_de_address'])
			$rek_de_address=$b['rek_de_address'];
		else
			$rek_de_address=" --- ";
		$delivery_add="<span class='border_gray2'>".$rek_de_address."</span>";
		
		if($b['rek_de_get'])
			$rek_de_get=$b['rek_de_get'];
		else
			$rek_de_get=" --- ";
		$delivery_get="<span class='border_gray2'>".$rek_de_get."</span>";
		
		if($b['rek_de_dop'])
			$rek_de_dop=$b['rek_de_dop'];
		else
			$rek_de_dop=" --- ";
		$delivery_dop="<span class='border_gray2'>".$rek_de_dop."</span>";

		$ret_b[$k]="
			<div class='tab'>
					<div class='tab_td' style='width:13%'>
						<div class='br_name br_div'>
							<a href='{$b['bc_site']}' target='_blank'>
								<div class='brand-item2 brand-slider2-{$k}' rel='{$k}'></div>
							</a>
						</div>
						<div class='nameBrande'>{$brendName[$k]}</div>
					</div>
					<div class='tab_td' style='width:20%'>
						<div class='open_windows1' id='ow1_{$k}'>
							<div class='br_cont br_div' id='window_cont{$k}' style='padding-top: 1px;'>
								<div class='div_center' style='display:table;width: 100%;'>
									<div style='display:table-row;'>
										<div class='cupllierTabTd' style='width: 50px;'>
											<span class='border_blue' >ИМЯ</span>
										</div>
										<div class='cupllierTabTd'>
											{$name}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >ТЕЛЕФОН</span>
										</div>
										<div class='cupllierTabTd'>
											{$phone}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >ПОЧТА</span>
										</div>
										<div class='cupllierTabTd'>
											{$email}
										</div>
									</div>
								</div>
							</div>
							<center>
								<span class='open_cont bu1' style='cursor:pointer;' rel='{$k}'>
									<div class='block_down1' id='bo1_{$k}' style='margin: 5px;'></div>
								</span>
							</center>
						</div>
					</div>



					<div class='tab_td' style='width:25%'>
						<div class='open_windows2' id='ow2_{$k}' >
							<div class='br_us br_div div_center' id='window_us{$k}' style='padding-top: 1px;'>
								<div style='display:table;width: 100%;'>

								<div style='display:table-row;'>
									<div class='cupllierTabTd' style='width: 50px;'></div>
									<div class='cupllierTabTd' style='text-align: center;'>
										<div class='border_blue' ><b>ОПТ</b>
										</div>
									</div>
									<div class='cupllierTabTd' style='text-align: center;'>
										<div class='border_blue' ><b>РОЗНИЦА</b></div>
									</div>
								</div>
								
								<div style='display:table-row;'>
									<div class='cupllierTabTd'>
										<span class='border_blue' >СКИДКА</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray' id='getSkidkaOpt{$k}'>{$b["uc_opt_skidka"]} %</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray' id='getSkidkaRoz{$k}'>{$b["uc_pr_skidka"]} %</span>
									</div>
								</div>

								<div style='display:table-row;'>
									<div class='cupllierTabTd'>
										<span class='border_blue' >НАЦЕНКА</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_opt_natsenka"]}</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_pr_natsenka"]}</span>
									</div>
								</div>
								
								<div style='display:table-row;'>
									<div class='cupllierTabTd'>
										<span class='border_blue' >ОТГРУЗКА</span></div>
									<div class='cupllierTabTd'>
										<span class='border_gray' id='getOtgruzOpt{$k}'>{$b["uc_opt_otgruz"]} мин/ед</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray' id='getOtgruzRoz{$k}'>{$b["uc_pr_otgruz"]} мин/ед</span>
									</div>
								</div>
								
								<div style='display:table-row;'>
									<div class='cupllierTabTd'><span class='border_blue' >ДОСТАВКА</span></div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_opt_delivery"]}</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_pr_delivery"]}</span>
									</div>
								</div>
								
								<div style='display:table-row;'>
									<div class='cupllierTabTd'><span class='border_blue' >ЦЕНА</span></div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_opt_price"]}</span>
									</div>
									<div class='cupllierTabTd'>
										<span class='border_gray'>{$b["uc_pr_price"]}</span>
									</div>
								</div>
								</div>
							</div>
							<center>
								<span class='open_us bu1' style='cursor:pointer;' rel='{$k}'>
									<div class='block_down1' id='bo2_{$k}' style='margin: 5px;'></div>
								</span>
							</center>
							<div></div>
						</div>
					</div>



					<div class='tab_td' style='width:40%'>
						<div class='open_windows3' id='ow3_{$k}'>
							<div class='br_rez br_div div_center' id='window_rez{$k}' style='padding-top: 1px;'>
								<div style='display:table;width: 100%;'>
									<div style='display:table-row;'>
										<div class='cupllierTabTd' style='width: 50px;'></div>
										<div class='cupllierTabTd' style='text-align: center;'>
											<span class='border_blue' style='text-align:center;' ><b>ОПЛАТА</b></span>
										</div>
										<div class='cupllierTabTd' style='width: 50px;'></div>
										<div class='cupllierTabTd' style='text-align: center;'>
											<span class='border_blue' style='text-align:center;' ><b>ДОСТАВКА</b></span>
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >ПЛАТЕЖ</span>
										</div>
										<div class='cupllierTabTd' >
											{$payment_plat}
										</div>
										<div class='cupllierTabTd' >
											<span class='border_blue' >ГОРОД</span>
										</div>
										<div class='cupllierTabTd' >
											{$delivery_sity}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >Ф.И.О.</span>
										</div>
										<div class='cupllierTabTd' >
											{$payment_name}
										</div>
										<div class='cupllierTabTd' >
											<span class='border_blue' >СПОСОБ</span>
										</div>
										<div class='cupllierTabTd' >
											{$delivery_sposib}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >БАНК</span>
										</div>
										<div class='cupllierTabTd' >
											{$payment_bank}
										</div>
										<div class='cupllierTabTd' >
											<span class='border_blue' >№СКЛАДА</span>
										</div>
										<div class='cupllierTabTd' >
											{$delivery_add}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >№СЧЕТА</span>
										</div>
										<div class='cupllierTabTd' >
											{$payment_shet}
										</div>
										<div class='cupllierTabTd' >
											<span class='border_blue' >ПОЛУЧАТЕЛЬ</span>
										</div>
										<div class='cupllierTabTd' >
											{$delivery_get}
										</div>
									</div>
									<div style='display:table-row;'>
										<div class='cupllierTabTd'>
											<span class='border_blue' >ПРИЧЕМ.</span>
										</div>
										<div class='cupllierTabTd' >
											{$payment_dop}
										</div>
										<div class='cupllierTabTd' >
											<span class='border_blue' >ПРИЧЕМ.</span>
										</div>
										<div class='cupllierTabTd' >
											{$delivery_dop}
										</div>
									</div>
								</div>
							</div>
							<center>
								<span class='open_rez bu1' style='cursor:pointer;' rel='{$k}'>
									<div class='block_down1' id='bo3_{$k}' style='margin: 5px;'></div>
								</span>
							</center>
						</div>
					</div>
				</div>";
		}
	}

//	$djs=json_encode($e_com);

//	echo $djs;

	$center.="
		<link href='/templates/admin/soz/style/orders_brands20.css' type='text/css' rel='stylesheet' />
		<script src='/templates/admin/soz/js/orders_brands20.js' ></script>			
	";	
		
	$center.="
		<div class='send_body' style='display:none'>
			<div class='send_window'>
				<div id='size_w'>
					<div class='icon_close'></div>
				</div>
				<table class='tab_send' >
					<tr>
						<td>
							<label>Кому</label>
							<input type='text' class='tab_send_towhere'  />
						</td>
						<td rowspan=3 style='width: 16%;'>
							<img src='http://www.makewear.com.ua/email/images/mw_logo.jpg' style='width: 91px;' />
						</td>
					</tr>
					<tr>
						<td>
							<label>От кого</label>
							<input type='text' class='tab_send_whom' value='sales@makewear.com.ua' />
						</td>
					</tr>
					<tr>
						<td>
						<label  style='text-align: center;'>Тема</label>
							<input type='text' class='tab_send_subject' value='' />
						</td>
					</tr>
				</table>
				<hr width='100%' />
					<div class='sent_html'>
						Body
					</div>
				<hr width='100%' id='bottom_hr' />
				<div>
					<button class='close_window'>Отмена</button>
					<span class='sent_order'> Отправить</span>	
				</div>
			</div>
		</div>
		";

	$center.="<div class='rees'></div><br/><br/>
			<div style='position: relative;height: 28px;'>
				<div style='display:table;position: absolute;right: 2px;' class='but_nn'>
					<div class='{$but_orr1} tab_nn' style='display:table-cell;{$but_style1}' rel=1 >
						<div>
							Заказы по брендам
						</div>
					</div>
					<div class='{$but_orr2} tab_nn' style='display:table-cell;{$but_style2}' rel=2 >
						<div>
							Архив
						</div>
					</div>
				</div>
			</div>
			<table class='sortable w_brands'>
				<th style='width:8px;'></th>
				<th style='width:15%;text-align:center;'>Бренд</th>
				<th style='width:20%;text-align:center;'>Контакты</th>
				<th style='width:25%;text-align:center;'>Условия</th>
				<th style='width:40%;text-align:center;'>Резвизиты</th>
				";

	//var_dump($brendam_active);
	// echo "<br/>";
	// var_dump($group_id);

	if($ret){
		ksort($ret); 
		foreach($ret as $key=>$val){
			$but_active2='';
			$active2='';

		//	echo $key."=(".$brendam_active[$key][0].", ".$brendam_active[$key][1].")<br/>";
			if($brendam_active[$key][0]==1 && $brendam_active[$key][1]==0){
				$but_active2="but_active";
				$active2="display:grid";
			}
			if($brendam_active[$key][0]==0 && $brendam_active[$key][1]==1){
				$but_active2="but_active7";
				$active2="display:none";
			}

			$center.="<tr class='{$but_active2}' style='{$active2}'>
						<td></td>
						<td colspan=4 >".$ret_b[$key].$ret[$key]."</td>
					</tr>";

		}
	}
	$center.="</table>{$links}";
}
?>
