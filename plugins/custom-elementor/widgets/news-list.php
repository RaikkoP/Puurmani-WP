<?php

//Turvalisuse tagamiseks ei lase source codeile veebilehelt ligi
if (!defined("ABSPATH")){
    exit;
}

class News_List extends \Elementor\Widget_Base {
    public function get_name() {
        return "news-list"; //ID
    }

}