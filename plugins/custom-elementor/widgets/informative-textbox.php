<?php

//Iga plugina osa jaoks on vaja eraldi luua turvalisuse kontroll
if(!defined("ABSPATH")){
    exit; //Sulge, kui keegi proovib manuaalselt ligi saada
}

//Widgeti enda METADATA, kirjeldab milleks vajalik ja milal loodud
/**
 * Custom Elementor Informative Textbox
 * Informative Textbox is used to for informative pages
 * Gives the power to add an image a title and text as needed
 * 
 * @since 1.0.0
 */
class Informative_Textbox extends \Elementor\Widget_Base {
    //Widget informatsioon laheb siia funktsiooni
    //Esimesena oleks vaja anda meie widgetile ID
    //WorPressis saab olla ID inimloetav seega paneme Informativ Box
    //Lisaks lisame ka sellele METADATA, et WordPressil oleks lihtne sellega
    //Edasi tegutseda

    /**
     * Gets widget name
     * 
     * Retrives Informative Box name
     * 
     * @since 1.0.0
     * @access public
     * @return string Widget name
     */

     //Tegemist on sisseehitatud Elementori funktsiooniga, mis paneb widgetitele
     //Vajaliku ID
    public function get_name() {
        return 'informative_box'; //ID on sama mis nimi selles olukorras
    }

    //Lisame ka nime, mida kasutaja peaks nagema Elementori widgetite nimekirjas
    //Lisame ka vajaliku METADATA selle jaoks

    /**
     * Get widget title.
     * 
     * Retrieve Informative Box title
     * 
     * @since 1.0.0
     * @access public
     * @return string Widget title
     */

    //Tegemist on sisse ehitatud Elementor funktiooniga, mis paneb loetava tiitli meie widgetile
    public function get_title() {
        return esc_html__('Informative Textbox', 'custom-elementor');
    }
}