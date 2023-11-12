<?php

if(!defined("ABSPATH")){
    exit; //Kontroll lause, et keegi ei saaks ligi veebilehelt koodile
}

class Sponsors_Carousel  extends \Elementor\Widget_Base {
    public function get_name() {
        return "sponsor_carousel"; //ID
    }
    public function get_title() {
        return "Koostöö partnerid"; //Pealkiri
    }
}