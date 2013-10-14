<?php
header("Content-type: text/html; charset=utf-8");
/*подключаем основной класс agregator.php, создаем объект данного класса,
вызываем функцию get_list_feeds которая извлекает содержимое из xml_файла(передаем файл)
далее используем simlexml  c помощью simplexml_load_string возвращяем строку как объект,
перебираем наш полученный массив получаем массивы
(провайдеров на которых подписаны на RSS канал,URL , колл. нужных новостей),
далее вызываем функцию perform_curl_operation с помощью которой получаем,
использует сURL содержимое из канадов RSS,
после чего с помощью функции parse_rss определяет это RSS 1.0 или 2.0 c помощью SimpleXML,
перебирает и записывает данные в массивы, далее используем функцию feed_results_rss,
 которая записывает данные в файл*/
require('class/agregator.php');
$myAgr = new Agregator();
$xml_string_contents=$myAgr->get_list_feeds("rss_feed.xml");
$xml = simplexml_load_string($xml_string_contents);
foreach ($xml->InfoProvaider as $feed_source) {
    Agregator::$number++;
    $name_rss_provider = trim(strval($feed_source->ProviderName));
    $url_rss_provider = trim(strval($feed_source->ProviderUrl));
    $max_rss = trim(strval($feed_source->maximumRss));
    $received_rss = $myAgr->perform_curl_operation($url_rss_provider);
    $my_result = $myAgr->parse_rss($received_rss, $max_rss,$name_rss_provider);
    if(!empty($my_result)){
        $myAgr->feed_results_rss($my_result,Agregator::$number);
    }
}
?>