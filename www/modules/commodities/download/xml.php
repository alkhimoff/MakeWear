<?php

include "commodity.class.php";

header("Content-Type: text/xml");

echo "<?xml version='1.0' standalone='yes'?>
<mw_commodities>";

	$shop=commodity::getCommodity();
	foreach ($shop as $k => $v) {

		$img=commodity::getPhoto($v['id']);
		$putImg='';
		for($i=0; $i<count($img); $i++){
				$putImg.="http://makewear-images.azureedge.net/{$v['id']}/{$img[$i]}.jpg;";
		}

		$brand=$v['cat_name'];
 		$brand=str_replace("&", "", $brand);

 		$name=$v['name'];
 		$name=str_replace("&", "", $name);

		$desc=strip_tags($v['desc']);
		$desc=html_entity_decode($desc);
		$desc=str_replace("&", "", $desc);


		echo "
			<commodity>
				<id>
					{$v['id']}
				</id>
				<article>
					{$v['art']}
				</article>
				<brand>
					{$brand}
				</brand>
				<name>
					{$name}
				</name>
				<price>
					{$v['price']}
				</price>
				<opt>
					{$v['opt']}
				</opt>
				<size>
					{$v['size']}
				</size>
				<description>
					{$desc}
				</description>
				<mw_url>
					http://makewear.com.ua/product/{$v['id']}/{$v['alias']}.html
				</mw_url>
				<photo>
					{$putImg}
				</photo>
				
			</commodity>

		";
	} 

	echo "</mw_commodities>";
?>

