<?php
require('Class/Ged_feed.php');
require('Interface/Int_agregator.php');
class Agregator extends Ged_feed implements It_agregator{
    static $number= 0;
    public function providerInfo($DBH){
        $this->DBH = $DBH;
        $sql_select_provider = "SELECT * FROM providerinfo";
        if(!$DBH){
            echo "<p>Извините но в данный момент сайт не корректно работает!</p>";
            exit();
        }else{
            $resultProvider = $this->DBH->query($sql_select_provider)->fetchAll(PDO::FETCH_ASSOC);
            return $resultProvider;
            //var_dump($resultProvider);
        };
    }
    public function Delete_providernews($DBH){
        $this->DBH = $DBH;
        $sql="DELETE  FROM providernews";
        if(!$DBH){
            echo "<p>Извините но в данный момент сайт не корректно работает! Напишите администратору Emtiska@mail.ru</p>";
            exit();
        }else{
            $DBH->query($sql);
        };
    }
    public function Insert_providernews($DBH,$my_result){
        $this->DBH = $DBH;
        $this->my_result = $my_result;
        $sql="INSERT INTO  providernews (provider_name,provider_title,provider_url,provider_description)
                    VALUES (:name_rss_provider,:url_rss_array,:title_rss_array,:description_rss_array)";
        $STH = $DBH->prepare($sql);

        for($j=0; $j<count($my_result[3]); $j++){
            for($i=0; $i<count($my_result[0]); $i++){
                $STH->bindParam(':name_rss_provider', $my_result[$i]);
            }
            $STH->bindParam(':url_rss_array', $my_result[1][$j]);
            $STH->bindParam(':title_rss_array', $my_result[2][$j]);
            $STH->bindParam(':description_rss_array', $my_result[3][$j]);
            $STH->execute();
        }
    }
    public function get_feeds($name_rss,$url_rss,$max_rss){
        parent::get_feeds($name_rss,$url_rss,$max_rss);
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