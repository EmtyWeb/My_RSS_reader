<?php
/*Главный интерфейс agregator_RSS*/
interface It_agregator {
    public function providerInfo($DBH);
    public function Delete_providernews($DBH);
    public function Insert_providernews($DBH,$my_result);
}
?>