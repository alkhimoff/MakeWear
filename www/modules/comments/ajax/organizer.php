<?php

namespace Modules;

require_once("../../../vendor/autoload.php");
require_once("../../../settings/conf.php");
require_once("../../../settings/connect.php");
require_once("../../../settings/functions.php");
require_once("../../../settings/main.php");

	$user = new User(); // Для взять iз Каптча 
	$organ = new OrganizerSp();

	if ($user->isCaptchaChecked()) {
		echo "Отримаю";
    } else {
        echo 'Каптча не выбрана.';
    }