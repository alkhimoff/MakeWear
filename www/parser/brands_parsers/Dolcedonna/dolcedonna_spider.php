<?php
//==============================================================================
//			Dolcedonna  51-325         		
//==============================================================================
$existUrl = TRUE;

//Get Links
$arrayLinks = checkEmptyOrChangeSelector($_SESSION["a_href"], $saw, 'a_href - ссылки');

if (isset($arrayLinks)) {
    $countNewLinks = count($arrayLinks);
    echo "\nУРЛ текущей ссылки:  <a href={$curLink} target='_blank' >{$curLink}</a>\n";
    foreach ($arrayLinks as $key => $value) {
        $linksArr[] = "http://dolcedonna.com.ua".trim($arrayLinks[$key]['href']);
    }
    echo "Запарсено новых ссылок: {$countNewLinks}\n";
} else {
    $existUrl = FALSE;
}