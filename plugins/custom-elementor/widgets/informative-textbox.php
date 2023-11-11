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

    public function get_name()
    {
        //Tegemist on sisseehitatud Elementori funktsiooniga, mis paneb widgetitele
        //Vajaliku ID
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
    public function get_title()
    {
        //Tegemist on sisse ehitatud Elementor funktiooniga, mis paneb loetava tiitli meie widgetile
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
    public function get_icon()
    {
        //Sisseehitatud funktsioon, mis kasutab Elementori sisseehitatud funktsiooni
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
    public function get_categories()
    {
        //Kasutab elementori sisseehitatud funktsiooni
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
    public function get_keywords()
    {
        //Elementori funktsioon, mis lisab vajalikud otsingumootori sonad
        //Sonad, kuidas saab otsida widgetit
        return ['informative', 'information', 'textbox'];
    }


    //Funktsionaalsuse lisamiseks on vaja lisada controller.
    //Controller vajab enda METADATAT
    /**
     * Get widget controls.
     * 
     * Add input fields to allow customization
     * 
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        //Tapsustame, et me tahame,et jargmised seadmed laheksid meie
        //Content Containerisse. Label tahendab seda, et me teeme alapealkirja
        //vastavasse tabi, tabi me saame kasutades 'tab' kasku
        $this->start_controls_section(
            'content_section',
            [
                //Sektsiooni nimi
                'label' => esc_html__('Content', 'custom-elementor'),
                //Paigutame sektsiooni CONTENT tabi
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        //Lisame esimese tekstivalja
        $this->add_controls(
            //ID
            'textbox_title',
            [
                //Anname sellele nime Pealkiri
                'label' => esc_html__(' Pealkiri ', 'custom-elementor'),
                //Paneme, et see oleks TEXT tuupi, ehk siis tavaline tekstilahter
                'type' => \Elementor\Controls_Manager::TEXT,
                //Teeme selle nahtavaks
                'label_block' => true,
                //Lisame sellele ajutiselt paigutatud teksti
                'placeholder' => esc_html__('Pane pealkiri siia lahtrisse', 'custom-elementor')
            ]
        );
        //Sektsioon loppeb siin
        $this->end_controls_section();
    }
}
