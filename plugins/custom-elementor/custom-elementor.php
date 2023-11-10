<?php

/**
 * Plugin Name: Custom Elementor
 * Description: Enda loodud Elementor pluginad, et veebilehe uuendamine ja hoidmine oleks mugavam
 * Version: 1.0.0
 * Author: RaikkoP
 * Text Domain: custom-elementor
 * 
 * Elementor tested up to 3.9.0
 * Elementor Pro tested up to 3.9.0
 */

 //Eelnevalt valja toodud METADATA laseb meil nuud kasutada meie pluginat


 //Turvalisuse tagamiseks peame peitma ligipääsu koodile
 //Selle abiga on voimalik ainult, et arendajad saavad ligi koodile
 if (!defined('ABSPATH')){
    exit;
 }

 /**
  * Register Widgets
  *
  * Include widget file and register widget class
  *
  * @since 1.0.0
  * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
  * @return void
  */

  //See MATADATA tuleb mitu korda koodi jooksul ja paneb paika funktsiooni kohta vajaliku
  //Informatsiooni. Kaasa arvatud mida me valjastama ja vastu votame.
  //since tahandab, et mis versioonist meie pluginast on funktsioon loodud
  //param tahandab, mida me funktsiooni vastu votame
  //return tahendab, et mida me valjastame enda rakendusega, sel juhul void
  //tahendab, et me ei valjasta kindlat andmetuupi

  function register_custom_elementor( $widgets_manager){
    require_once(__DIR__ . '/widgets/informative-textbox.php');

    $widgets_manager->register(new \Informative_Textbox());
  }
  //Action on koodi osa, mida me saame kasutada WordPressis, et lisada
  //Uusi pluginaid ilma, et me peaksime muutma susteemi enda arhitektuuri
  add_action('elementor/widgets/register', 'register_custom_elementor');

 //Action kuulub kategoorilist Hook funktsioonidesse, mis on koodi osad, mis 
 //on ehitatud WordPressi sisse ja neid saab kasutada arenduse kaigus. 
