<?php

require_once('../../../vendor/autoload.php');

define('BLOB_STORAGE', getenv('BLOB_STORAGE'));

$blob = new \Modules\BlobStorage();

// 1 - шлях до файла, 2 - назва файла як він буде назв. в сторейджі, 3 - назва папки в сторейджі
// $blob->uploadBlob('/home/kosovserver/Изображения/20160708_124756.jpg', 'maxim.jpg', 'banners');
// var_dump($blob->getListBlobsInContainer('banners'));

if(isset($_FILES['userfile'])){
	echo "Name: ".$_FILES['userfile']["name"]."<br/>";
	echo "Tmp name: ".$_FILES['userfile']["tmp_name"]."<br/>";
	echo "Type: ".$_FILES['userfile']["type"]."<br/>";
	echo "Error: ".$_FILES['userfile']["error"]."<br/>";
	
	$blob->uploadBlob($_FILES['userfile']["tmp_name"], $_FILES['userfile']["name"], 'banners');
	var_dump($blob->getListBlobsInContainer('banners'));
}


echo '<!-- Тип кодирования данных, enctype, ДОЛЖЕН БЫТЬ указан ИМЕННО так -->
<form enctype="multipart/form-data" action="/modules/commodities/ajax/upload.php" method="POST">
    <!-- Название элемента input определяет имя в массиве $_FILES -->
    Отправить этот файл: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>';

	//	var_dump($_FILES);
	//echo $_GET['files'];	
	//echo "uppl".$_FILES[0]["name"]."\n";
	//var_dump($_FILES);

	// $format=end(explode(".",$_FILES[0]["name"]));
	
	
	// if($format=='jpeg' || $format=='jpg' || $format=='JPG' || $format=='pdf' || $format=='PDF' || $format=='png' || $format=='PNG' ){
		//$file=str_replace("_", "", $_FILES[0]["name"]);
		// $blob->uploadBlob($_FILES[0]['tmp_name'], $_FILES[0]["name"], 'payment-p');
		// var_dump($blob->getListBlobsInContainer('payment-p')); 
		// echo "@@".$_FILES[0]["name"];
		// $sourcePath = $_FILES[0]['tmp_name'];  
		//$targetPath = "../../../uploads/payment_P/".$_FILES[0]["name"]; 
		//$targetPath = "../../../uploads/order/eee.".$format;
		// if(move_uploaded_file($sourcePath,$targetPath)) {
		// 	echo 1;
		// }else{
		// 	echo 0;
		// }
	// }else{
	// 	echo 2;
	// }

?>