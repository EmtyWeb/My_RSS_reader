<?php
require('interface/reader_Rss.php');
class Ged_feed implements reader_RSS{
    public function perform_curl_operation($url_rss){
 /*Инициализирует сеанс cURL, устанавливаем URL и убираем хедеры,
 загруем, завершаем сеанса*/

        try{
            if(empty($url_rss)) throw new Exception("Введены не все данные!");
            $this->url_rss = $url_rss;
            $contents = "";
            $empty_contents = "";
            $curl_handle = curl_init();
            if ($curl_handle) {
                curl_setopt($curl_handle, CURLOPT_URL, $url_rss);
                curl_setopt($curl_handle, CURLOPT_HEADER, false);
                curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
                $contents = curl_exec($curl_handle);
                curl_close($curl_handle);
                if($contents!=false){
                    return $contents;
                }else{
                    return $empty_contents;
                }
            }
        }catch(Exception $e){
            echo "Произошла ошибка ", $e->getMessage(),
            " в строке ", $e->getLine(),
            " файла ", $e->getFile();
            exit;
        }
    }
    public function parse_rss($received_rss, $max_rss, $name_rss_provider){
        /*Использует SimpleXml  simplexml_load_string определяем есть ли,
         у элемента item предок channel, перебираем наш объект и записываем в массивы
        (имя провайдера,колл. новостей, заголовок,ссылку,описание)  */
        $count=0;
        try{
            if(empty($received_rss) or empty($max_rss) or empty($name_rss_provider))throw new Exception("Введены не все данные!");
            $this->received_rss = $received_rss;
            $this->max_rss = $max_rss;
            $this->name_rss_provider = $name_rss_provider;
            $description_rss_array = array();
            $url_rss_array = array();
            $title_rss_array = array();
            $xml = simplexml_load_string($received_rss);
            if ((is_object($xml) == false) || (count($xml) <= 0)) {
                return(false);
            }
            $obj1 = $xml->item;
            if ((is_object($obj1) == false) || (sizeof($obj1) <= 0)) {
                $xml = $xml->channel;
            }
            if ((is_object($xml) == false) || (sizeof($xml) <= 0)) {
                return(false);
            }
            foreach ($xml->item as $item) {
                $rss_feed_title = trim(strval($item->title));
                $rss_feed_url = trim(strval($item->link));
                $rss_feed_description = trim(strval($item->description));
                array_push($title_rss_array, $rss_feed_title);
                array_push($url_rss_array, $rss_feed_url);
                array_push($description_rss_array, $rss_feed_description);
                $this->count++;
                if($this->count >= $max_rss){
                    break;
                }
            }
            $myresult = array();
            $myresult[0] = $name_rss_provider;
            $myresult[1] = count($max_rss);
            $myresult[2] = $url_rss_array;
            $myresult[3] = $title_rss_array;
            $myresult[4] = $description_rss_array;

            return $myresult;
        }catch(Exception $e){
            echo "Произошла ошибка ", $e->getMessage(),
            " в строке ", $e->getLine(),
            " файла ", $e->getFile();
            exit;
        }
    }
}
?>
