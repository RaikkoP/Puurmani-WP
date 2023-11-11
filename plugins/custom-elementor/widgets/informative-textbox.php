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
        return esc_html__('Informatiivne Tekstikast', 'custom-elementor');
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
                'label' => esc_html__('Sisu', 'custom-elementor'),
                //Paigutame sektsiooni CONTENT tabi
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        //Lisame esimese tekstivalja
        $this->add_control(
            //ID
            'textbox_title',
            [
                //Anname sellele nime Pealkiri
                'label' => esc_html__('Pealkiri', 'custom-elementor'),
                //Paneme, et see oleks TEXT tuupi, ehk siis tavaline tekstilahter
                'type' => \Elementor\Controls_Manager::TEXT,
                //Teeme selle nahtavaks
                'label_block' => true,
                //Lisame sellele ajutiselt paigutatud teksti
                'placeholder' => esc_html__('Pane pealkiri siia lahtrisse', 'custom-elementor')
            ]
        );
        //Lisame nuud tekstivalja, kuhu saab lisada informatiivse kasti sisu
        $this->add_control(
            //ID
            'textbox_description',
            [
                //Anname sellele nime Sisu
                'label' => esc_html__('Sisu', 'custom-elementor'),
                //Anname sellele tuubiks TEXTAREA, sest sellel on rohkem ruumi kui TEXTil
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                //Teeme kasti nahtavaks
                'label_block' => true,
                //Lisame ajutise sisu, et lahter ei oleks alguses tuhi
                'placeholder' => esc_html__("Kasti sisu tuleb kirjutada siia!", 'custom-elementor'),
            ]
        );
        //Lisame pildi lisamiseks controli, pilti kasutaja ei pea lisama ja kast peaks muutuma sel juhul kui pilti pole lisatud
        $this->add_control(
            //ID
            'textbox_image',
            [
                //Anname sellele nime Pilt
                'label' => esc_html__('Pilt', 'custom-elementor'),
                //Kasutame selle jaoks valikut nimega MEDIA
                //MEDIA ei ole tekstilahter vaid laseb pilte uleslaadida WordPressi andmebaasi
                'type' => \Elementor\Controls_Manager::MEDIA,
                //Teeme meedia valiku kasti nahtavaks
                'label_block' => true,
            ]
        );
        //Lisame voimaluse muuta pildi suurust nii nagu soovid
        $this->add_control(
            'textbox_image_dimension',
            [
                'label' => esc_html__('Pildi suurus', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => esc_html__('Vaheta pildi suuruseid', 'custom-elementor'),
                'default' => [
                    'width' => '400',
                    'height' => '400',
                ],
            ]
        );
        //Lisame float funktsionaalsuse pildi jaoks, et kasutaja saaks valida, kus positsioonis pilti naidata
        $this->add_control(
            'textbox_image_alignment',
            [
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label' => esc_html__('Positsioon', 'custom-elementor'),
                'options' => [
                    'vasak' => [
                        'title' => esc_html__('Vasak', 'custom-elementor'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'parem' => [
                        'title' => esc_html__('Parem', 'custom-elementor'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
            ]
        );
        //Lopetame sisu loomise sektsiooni
        $this->end_controls_section();
        //Lisame enda tehtud widgetile nuud ka stiili valikud, et seda saaks ilusamaks teha
        $this->start_controls_section(
            //ID
            'section_style',
            [
                //Kontaineri nimetus
                'label' => esc_html__('Stiil', 'custom-elementor'),
                //Kuhu kontainer paigutatakse
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        //Lisame nuud pealkirja muutmise jaoks stiili
        $this->add_control(
            'textbox_title_options',
            [
                //Paneme seadete valikul nime
                'label' => esc_html__('Pealkirja Seaded', 'custom-elementor'),
                //Tapsustame, et seaded kehtivad HEADING tuupi valjale
                'type' => \Elementor\Controls_Manager::HEADING,
                //Seadete lahter tuleb lahutada eelmisest lahtrist
                //Kuigi selles olukorras on tegemist esimese seadme konteineriga
                //Siis ikkagi on hea tava see rida koodi lisada
                'separator' => 'before',
            ]
        );
        //Lisame nuud meie loodud konteinerisse tegelikud stiili muudatused
        $this->add_control(
            //ID
            'title_color',
            [
                //NIMI
                'title' => 'Vaheta Pealkirja Värv',
                //TUUP
                'type' => \Elementor\Controls_Manager::COLOR,
                //VAIKIMISI VAARTUS
                'default' => '#f00',
                //MIDA ME HTMLIS MUUDAME
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}}',
                ]
            ]
        );
        //Lisame nuud ka fonti suuruste ja stiili muutmise seaded pealkirjale
        $this->add_group_control(
            //VALIME KOIK FONTI VAHETAMISE SEADED
            \Elementor\Group_Control_Typography::get_type(),
            [
                //ID
                'name' => 'title_typography',
                //MIDA MUUDAME
                'selector' => '{{WRAPPER}} h3',
            ]
        );
        //Lisame nuud sisule samad seaded
        $this->add_control(
            'textbox_description_options',
            [
                'label' => esc_html__('Sisu seaded', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_color',
            [
                'title' => 'Vaheta Sisu Värv',
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}}',
                ]
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} p',
            ]
        );
        //Pealkirja stiilid loppevad siin
        $this->end_controls_section();
    }
    //Nuud on vaja teha funktsioon, mis renderib meile HTML koodi kasutades neid eelmiseid vaartusi, mida me loime
    //funktsioonis nimega register_controls, tegemist peab olema jalle protected functioniga. METADATA vajalik.

    /**
     * Render Textbox widget output in the frontend.
     * 
     * Written in PHP and used to generate the final HTML
     * 
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        //Renderdamise kood laheb siia
        //Votame koik eelmised vaartused ja paneme need uhte muutujasse nimega settings
        $settings = $this->get_settings_for_display();

        //Votame koik vaartused valja settigsist ja paneme need enda muutujate sisse
        $textbox_title = $settings['textbox_title'];
        $textbox_description = $settings['textbox_description'];
        $textbox_image = $settings['textbox_image']['url'];
        $image_height = $settings['textbox_image_dimension']['height'];
        $image_width = $settings['textbox_image_dimension']['width'];
        $image_position = $settings['textbox_image_alignment'];

        //Tahtis on nuud PHP kood kinni panna, et saaksime kirjutada HTML,CSS,JavaScript koodi nuud edasi
        //Hiljem avame jalle vajaliku PHP koodi
        //Lisame nuud positsiooni pohjal kontrolli, et kus kohas pilt peab paiknema
?>
        <style>
            .textbox-content {
                overflow: hidden;
            }

            .textbox-image {
                float: <?php echo $image_position == 'vasak' ? 'left' : 'right' ?>;
                margin-right: 10px;
            }

            .textbox-text p {
                overflow-wrap: break-word;
            }
        </style>
        <div>
            <h3 class="textbox-title"><?php echo $textbox_title ?></h3>
            <div class="textbox-content">
                <div class="textbox-image">
                    <img src="<?php echo $textbox_image ?>" width="<?php echo $image_width ?>" height="<?php echo $image_height ?>" />
                </div>
                <div class="textbox-text">
                    <p><?php echo $textbox_description ?></p>
                </div>
            </div>
        </div>

<?php
    }
}
