<?php

//Turvalisuse tagamiseks ei lase source codeile veebilehelt ligi
if (!defined("ABSPATH")) {
    exit;
}

class News_List extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return "news-list"; //ID
    }
    public function get_title()
    {
        return "Uudiste Nimekiri"; //Nimi
    }
    public function get_icon()
    {
        return "eicon-post-list"; //Ikoon
    }
    public function get_categories()
    {
        return ["general"];
    }
    public function get_keywords()
    {
        return ["uudised", "puurmani"];
    }
    protected function register_controls()
    {
        //Teeme containeri 
        $this->start_controls_section(
            'style_container',
            [
                'label' => esc_html__('Stiil', 'custom-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        //Teeme containeri sisse alapealkirjaga osa nimega Pealkirja seaded
        $this->add_control(
            'news_posts_style',
            [
                'label' => esc_html__('Pealkirja Seaded', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //Lisame koodi pealkirja varvi muutmiseks
        $this->add_control(
            'post_title',
            [
                'label' => esc_html__('Pealkirja värv', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}}'
                ]
            ]
        );
        //Saame muuta pealkirja tagust varvi
        $this->add_control(
            'post_title_background',
            [
                'label' => esc_html__('Pealkirja taustavärv', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} h3' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        //Teeme nii, et kasutaja saab vahetada teksti seonduvat informatsioon nagu soovib
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'selector' => '{{WRAPPER}} h3'
            ]
        );
        //Teeme containeri sisse alapealkirjaga osa nimega sisu seaded
        $this->add_control(
            'news_posts_style_desc',
            [
                'label' => esc_html__('Sisu Seaded', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        //Lisame koodi sisu varvi muutmiseks
        $this->add_control(
            'post_description',
            [
                'label' => esc_html__('Sisu värv', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}}'
                ]
            ]
        );
        //Muudame sisu tausta varvi
        $this->add_control(
            'post_description_background',
            [
                'label' => esc_html__('Sisu taustavärv', 'custom-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} p' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        //Sisu teksti seadeid saab muuta
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_description_typography',
                'selector' => '{{WRAPPER}} p'
            ]
        );


        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        //Selleks, et naidata vajalikke uudised on meil vaja votta kasutusele WordPressi postituste API
        //Meie API endpointiks on https://puurmani.edu.ee/kool/wp-json/wp/v2/posts?per_page=5
        //Selleks, et funktsiooni toole saada loome funktsiooni nimega callApi mis votab vastu vajaliku informatsiooni
        //Funktsioon on kirjutatud dokumentatsiooni jargi
        function callAPI($url)
        {
            //Alustame uut curl seanssi
            $curl = curl_init();
            //See maaratleb ulekande viisi, sel juhul me tahame serverilt infot edasi kanda stringina
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //Sellega maarame ulekande URL-i
            curl_setopt($curl, CURLOPT_URL, $url);
            //Saadame HTTP paringu ja salvestame tulemused
            $result = curl_exec($curl);
            if (!$result) {
                die("Connection Failure");
            }
            curl_close($curl);
            return $result;
        }
        //Votame kasutusele nuud API kaudu saadud informatsiooni
        $get_data = callAPI('https://puurmani.edu.ee/kool/wp-json/wp/v2/posts?per_page=4');
        //Kuna vastus on JSON data siis on vaja see teha PHP loetavaks
        $response = json_decode($get_data, true);
        //Teeme kiiresti eraldi listid informatsioonist mida soovime naidata
        $date = [];
        $link_to_post = [];
        $title = [];
        $image = [];
        $description = [];
        //Salvestame nuud informatsiooni oigesse lahtrisse
        foreach ($response as $data) {
            //Muudame kuupaev selliseks, et see naeb veebilehe peal normaalne valja, lisaks kellaaeg pole oluline uudise jaoks
            $dateTime = new DateTime($data['date']);
            $formattedDate = $dateTime->format('d.m.Y');
            array_push($date, $formattedDate);
            array_push($title, $data['title']['rendered']);
            //Kuna pildi URL on natuke rohkem peidus siis kasutame nested funktsiooni
            $image_response = json_decode(callAPI($data['_links']['wp:featuredmedia'][0]['href']), true);
            array_push($image, $image_response['guid']['rendered']);
            array_push($description, $data['excerpt']['rendered']);
            array_push($link_to_post, $data['link']);
        }
?>
        <style>
            .news_container {
                display: grid;
                grid-template-columns: auto 1fr;
                grid-gap: 10px;
            }

            .image_col {
                grid-row: span 3;
            }

            .text_col {
                margin-top: 0;
            }
            .text_col h3{
                margin-top: 0;
                padding: 10px;
            }
        </style>
        <div class="news_container">
            <div class="image_col">
                <img src="<?php echo $image[0] ?>" width="200" height="200" />
            </div>
            <div class="text_col">
                <div>
                    <a href="<?php echo $link_to_post[0] ?>">
                        <h3><?php echo $title[0] ?></h3>
                    </a>
                </div>
                <div>
                    <p class="news_time"><?php echo $date[0] ?></p>
                </div>
                <div>
                    <p class="news_description"></p><?php echo $description[0] ?></p>
                </div>
            </div>
        </div>
        <div class="news_container">
            <div class="image_col">
                <img src="<?php echo $image[1] ?>" width="200" height="200" />
            </div>
            <div class="text_col">
                <div>
                    <a href="<?php echo $link_to_post[1] ?>">
                        <h3><?php echo $title[1] ?></h3>
                    </a>
                </div>
                <div>
                    <p class="news_time"><?php echo $date[1] ?></p>
                </div>
                <div>
                    <p class="news_description"></p><?php echo $description[1] ?></p>
                </div>
            </div>
        </div>
        <div class="news_container">
            <div class="image_col">
                <img src="<?php echo $image[2] ?>" width="200" height="200" />
            </div>
            <div class="text_col">
                <div>
                    <a href="<?php echo $link_to_post[2] ?>">
                        <h3><?php echo $title[2] ?></h3>
                    </a>
                </div>
                <div>
                    <p class="news_time"><?php echo $date[2] ?></p>
                </div>
                <div>
                    <p class="news_description"></p><?php echo $description[2] ?></p>
                </div>
            </div>
        </div>
        <div class="news_container">
            <div class="image_col">
                <img src="<?php echo $image[3] ?>" width="200" height="200" />
            </div>
            <div class="text_col">
                <div>
                    <a href="<?php echo $link_to_post[3] ?>">
                        <h3><?php echo $title[3] ?></h3>
                    </a>
                </div>
                <div>
                    <p class="news_time"><?php echo $date[3] ?></p>
                </div>
                <div>
                    <p class="news_description"></p><?php echo $description[3] ?></p>
                </div>
            </div>
        </div>
<?php
    }
}
