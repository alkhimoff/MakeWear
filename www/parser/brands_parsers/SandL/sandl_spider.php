<?php
//==============================================================================
//			S&L   	17-48         		
//==============================================================================
$existUrl = FALSE;

//Get Links
$arrayLinks = checkEmptyOrChangeSelector($_SESSION["a_href"], $saw, 'a_href - ссылки');

if (isset($arrayLinks)) {
    $countNewLinks = count($arrayLinks);
    echo "\nУРЛ текущей ссылки:  <a href={$curLink} target='_blank' >{$curLink}</a>\n";
    echo "Запарсено новых ссылок: {$countNewLinks}\n";
    foreach ($arrayLinks as $key => $value) {
        $linksArr[] = "http://sl-odejda.com/".trim($arrayLinks[$key]['href']);
    }
}




