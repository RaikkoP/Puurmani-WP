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
    public function get_icon() {
        return "eicon-slider-album"; //Ikoon
    }
    public function get_categories() {
        return ["general"]; //Kategooriad
    }
    public function get_keywords() {
        return ["puurmani", "sponsor"]; //Otsingumootori terminid
    }
    protected function register_controls() {
        //Teeme konteineri meie informatsiooni jaoks
        $this->start_controls_section(
            'sponsor_info',
            [
                'label' => esc_html__('Pildid', 'custom-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        //Alapealkiri
        $this->add_control(
            'sponsor_info_sisu',
            [
                'label' => esc_html__('Partnerid', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //Meedia valiku lahtrid
        $this->add_control(
            'esimene_partner',
            [
                'label' => esc_html__('Esimene pilt', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => "",
				],
                'label_block' => true,
            ]
        );
         //Lisame voimaluse muuta pildi suurust nii nagu soovid
         $this->add_control(
            'esimene_suurus',
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
        $this->add_control(
            'teine_partner',
            [
                'label' => esc_html__('Pilt', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => "",
				],
                'label_block' => true,
            ]
        );
        //Lisame voimaluse muuta pildi suurust nii nagu soovid
        $this->add_control(
            'teine_suurus',
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
        $this->add_control(
            'kolmas_partner',
            [
                'label' => esc_html__('Pilt', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => "",
				],
                'label_block' => true,
            ]
        );
          //Lisame voimaluse muuta pildi suurust nii nagu soovid
          $this->add_control(
            'kolmas_suurus',
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
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
    }
}