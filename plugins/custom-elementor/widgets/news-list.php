<?php

//Turvalisuse tagamiseks ei lase source codeile veebilehelt ligi
if (!defined("ABSPATH")){
    exit;
}

//Selleks, et naidata vajalikke uudised on meil vaja votta kasutusele WordPressi postituste API
//Meie API endpointiks on https://puurmani.edu.ee/kool/wp-json/wp/v2/posts?per_page=5
//Selleks, et funktsiooni toole saada loome funktsiooni nimega callApi mis votab vastu vajaliku informatsiooni
//Funktsioon on kirjutatud dokumentatsiooni jargi
function callAPI($url){
    //Alustame uut curl seanssi
    $curl = curl_init();
    //See maaratleb ulekande viisi, sel juhul me tahame serverilt infot edasi kanda stringina
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //Sellega maarame ulekande URL-i
    curl_setopt($curl, CURLOPT_URL, $url);
    //Saadame HTTP paringu ja salvestame tulemused
    $result = curl_exec($curl);
    if(!$result){die("Connection Failure");}
    curl_close($curl);
    return $result;
}
//Votame kasutusele nuud API kaudu saadud informatsiooni
$get_data = callAPI('https://puurmani.edu.ee/kool/wp-json/wp/v2/posts?per_page=5');
//Kuna vastus on JSON data siis on vaja see teha PHP loetavaks
$response = json_decode($get_data, true);


class News_List extends \Elementor\Widget_Base {
    public function get_name() {
        return "news-list"; //ID
    }

}