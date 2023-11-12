<?php

use Elementor\Controls_Manager;

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
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_title_typography',
                'selector' => '{{WRAPPER}} h3'
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
        $get_data = callAPI('https://puurmani.edu.ee/kool/wp-json/wp/v2/posts?per_page=5');
        //Kuna vastus on JSON data siis on vaja see teha PHP loetavaks
        $response = json_decode($get_data, true);
        //Teeme kiiresti eraldi listid informatsioonist mida soovime naidata
        $date = [];
        $link_to_post = [];
        $title = [];
        $image = [];
        $description = [];
        foreach ($response as $data) {
            array_push($date, $data['date']);
            array_push($title, $data['title']['rendered']);
            array_push($image, $data['_links']['wp:featuredmedia'][0]['href']);
            array_push($description, $data['excerpt']['rendered']);
            array_push($link_to_post, $data['link']);
        }
?>
        <style>

        </style>
        <div class="news_container">
            <div>
                <img src="<?php echo $image[0] ?>" width="200" height="200" />
            </div>
            <div>
                <div>
                    <a href="<?php echo $link_to_post[0] ?>">
                        <h3><?php echo $title[0] ?></h3>
                    </a>
                </div>
                <div>
                    <h3><?php echo $date[0] ?></h3>
                </div>
                <div>
                    <h3><?php echo $description[1] ?></h3>
                </div>
            </div>
        </div>
<?php
    }
}
