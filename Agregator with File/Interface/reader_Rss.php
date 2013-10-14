<?php
interface reader_RSS {
    /*Функция использует сURL и извлекает содержимое из канадов RSS*/
    public function perform_curl_operation($url_rss);
    /*Функция получает содержимое каналов, определяет это RSS 1.0 или 2.0 c помощью SimpleXML,
    перебирает и записывает данные в массивы*/
    public function parse_rss($received_rss, $max_rss,$name_rss_provider);
}
?>