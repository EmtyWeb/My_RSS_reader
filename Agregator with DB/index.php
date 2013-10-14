<?php
header("Content-type: text/html; charset=utf-8");
require('Database/DB.php');
require('Class/Agregator.php');
$DBH = new DB();
$myAgr = new Agregator();
$resultProvider = $myAgr->providerInfo($DBH);
$myAgr->Delete_providernews($DBH);
//var_dump($resultProvider) ;
foreach ($resultProvider as $feed_source){
    Agregator::$number++;
    $name_rss_provider = $feed_source['provider_name'];
    $url_rss_provider = $feed_source['provider_url'];
    $max_rss = $feed_source['count_news'];
    $received_rss = $myAgr->perform_curl_operation($url_rss_provider);
    $my_result = $myAgr->parse_rss($received_rss, $max_rss,$name_rss_provider);
    if(!empty($my_result)){
        $myAgr->Insert_providernews($DBH,$my_result);
    }
}
echo "Выполненно!";
?>