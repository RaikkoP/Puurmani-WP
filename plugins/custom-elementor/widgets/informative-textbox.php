<?php

//Iga plugina osa jaoks on vaja eraldi luua turvalisuse kontroll
if (!defined("ABSPATH")) {
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
class Informative_Textbox extends \Elementor\Widget_Base
{
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
    public function get_name()
    {
        return 'informative_box'; //ID
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
    public function get_title()
    {
        return esc_html__('Informative Textbox', 'custom-elementor');
    }

    //Lisame widgetile ise valitud ikooni, mis vastab rohkem selle funktsionaalsusega
    //Lisame ka METADATA vajaliku funktsiooni kohta
    /**
     * Get widget icon
     * 
     * Retrieve Informative Box icon
     * 
     * @since 1.0.0
     * @access public
     * @return string Widget icon
     */

     //Sisseehitatud funktsioon, mis kasutab Elementori sisseehitatud funktsiooni
    public function get_icon()
    {
        //Ikoonid votame Elementori ikooni andmebaasist.
        return 'eicon-info-box';
    }


    //Lisame vajaliku METADATA kategooriate jaoks
    /**
     * Get widget categories.
     * 
     * Retrieve the list of categories the widget belongs to
     *  
     * @since 1.0.0
     * @access public
     * @return array Widget categories
     */

     //Kasutab elementori sisseehitatud funktsiooni
    public function get_categories()
    {
        //Saadame kategooriad arrayna edasi.
        return ['general'];
    }


    //Otsingu mootori jaoks on meil vaja otsingusonu lisame selle jaoks METADATA
    /**
     * Get widget keywords
     * 
     * Retrieve widget keywords for search
     * 
     * @since 1.0.0
     * @access public
     * @return array Widget keywords
     */
    //Elementori funktsioon, mis lisab vajalikud otsingumootori sonad
    public function get_keywords() {
        //Sonad, kuidas saab otsida widgetit
        return ['informative','information','textbox'];
    }
}
