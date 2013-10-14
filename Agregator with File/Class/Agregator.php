<?php
require('interface/Int_agregator.php');
require('Get_feed.php');
class Agregator extends Ged_feed implements Int_agregator{
    static $number = 0;
    public function get_list_feeds($xml_file){
        /*проверяем есть ли файт если есть то зачитываем его в строку file_get_contents*/
        if(file_exists($xml_file) or die("Файл не найден " . $xml_file));
        $this->xml_file = $xml_file;
        $xml_string_contents = file_get_contents($xml_file);
        return $xml_string_contents;
    }
    public function feed_results_rss($my_result,$number){
    /*получаем массив с данными содаем файл куда будут записываться данные,
    открываем файл fopen и записывает данные fwrite*/
        if (file_exists('feed_results') == false) {
            mkdir('feed_results');
        }
        $result_file_name = sprintf("%s/%03d%s", 'feed_results',
            $number, '_rss_feed.txt');
        $handle = fopen($result_file_name, 'w');
        $feed_provider_number = "Feed Provider Number"  .$number . "\n";
        fwrite($handle, $feed_provider_number);
        // Записываем имя провайдера канала.
        $feed_provider_name = 'Provider:' . $my_result[0] . "\n";
        fwrite($handle, $feed_provider_name);
        // Записываем количество полученных элементов канала.
        $number_of_received_rss_feeds = 'Number of RSS' .$my_result[1] . "\n";
        fwrite($handle, $number_of_received_rss_feeds);
        $rss_feed_title_array = $my_result[2];
        $rss_feed_url_array = $my_result[3];
        $rss_feed_description_array = $my_result[4];

        for($i=0; $i < count($rss_feed_title_array); $i++) {
            $feed_item_sequence_number = 'Feed ' .($i+1) . "\n";
            fwrite($handle, $feed_item_sequence_number);
            $feed_item_title = 'Title ' . $rss_feed_title_array[$i] ."\n";
            fwrite($handle, $feed_item_title);
            $feed_item_url = 'url ' . $rss_feed_url_array[$i] . "\n";
            fwrite($handle, $feed_item_url);
            $feed_item_description = 'description ' . "\n" . $rss_feed_description_array[$i] . "\n";
            fwrite($handle, $feed_item_description);
        }
        fclose($handle);


    }
    public function perform_curl_operation($url_rss){
        $contents = parent::perform_curl_operation($url_rss);
        return $contents;
    }
    public function parse_rss($received_rss, $max_rss,$name_rss_provider){
        $result = parent::parse_rss($received_rss, $max_rss,$name_rss_provider);
        return $result;
    }
}
?>