<?php
//==============================================================================
//                     Daminika     48-322	         		
//==============================================================================
$existUrl = FALSE;

//Get Links
if (isset($saw)) {
    $countNewLinks = count($saw);
    echo "\nURL текущей ссылки:  <a href={$curLink} target='_blank' >{$curLink}</a>\n";
    echo "Запарсено новых ссылок: {$countNewLinks}\n";
    foreach ($saw->shop->offers->offer as $key => $offer) {
        $linksArr[] = trim($offer->url);
    }
    $linksArr = array_values(array_unique($linksArr));
} 