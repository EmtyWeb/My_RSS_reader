<?php
interface Int_agregator {
    /*Функция c помощью file_get_contents получает содержимое xml_файла,
    в котором находятся данные о подписке RSS*/
    public function get_list_feeds($xml_file);
    /*Функция создает директорию и файл если его не существует,
     куда будет записываться данные которые были считаны с RSS каналов*/
    public function feed_results_rss($my_result,$number);
}
?>