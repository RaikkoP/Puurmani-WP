<?php

if(!defined("ABSPATH")){
    exit; //Kontroll lause, et keegi ei saaks ligi veebilehelt koodile
}


//Widgeti enda METADATA, kirjeldab milleks vajalik ja milal loodud
/**
 * Custom Elementor image carousel made for sponsors
 * Lets user pick sponsor images and settings about scroll speed and so on
 * 
 * @since 1.0.0
 */
class Sponsors_Carousel extends \Elementor\Widget_Base {
    public function get_name() {
        return "sponsor_carousel"; //ID
    }
    public function get_title() {
        return "Koostöö partnerid"; //Pealkiri
    }
}