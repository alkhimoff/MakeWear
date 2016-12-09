<?php
//==============================================================================
//                          Lenida	7-16	         		
//==============================================================================
$existUrl   = TRUE;
$pagination = array();

//Exist page
$arrayPagination = checkEmptyOrChangeSelector('.breadcrumbs', $saw, 'pagination - страницы');

if (isset($arrayPagination)) {
    foreach ($arrayPagination as $value) {
        $regexp = '/[0-9]/';
        if (preg_match($regexp, $value)) {
            $pagination[] = (int) $value;
        }
    }
    $pagination = max($pagination);
    // $i is in spider_main.php
    if ($i == $pagination) {
        $existUrl = FALSE;
    }
} else {
    $existUrl = FALSE;
}

//Get Links
$arrayLinks = checkEmptyOrChangeSelector($_SESSION["a_href"], $saw, 'a_href - ссылки');


if (isset($arrayLinks)) {
    $countNewLinks = count($arrayLinks) / 2;
    echo "\nУРЛ текущей ссылки:  <a href={$curLink} target='_blank' >{$curLink}</a>\n";
    echo "Запарсено новых ссылок: {$countNewLinks}\n";
    foreach ($arrayLinks as $key => $value) {
        if (substr_count(trim($arrayLinks[$key]['href']), ".html") > 0) {
            $link       = "http://www.lenida.com.ua".trim($arrayLinks[$key]['href']);
            $linksArr[] = $link;
        }
    }
}
