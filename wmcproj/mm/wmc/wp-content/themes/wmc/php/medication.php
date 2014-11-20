<?php

// MEDICATION
function medication_view() {
    global $wpdb;
    global $current_language;
    global $current_user_id;
    
    //$current_language = 1;
    
    $results = $wpdb->get_results('SELECT * FROM wmc_member_medication_product WHERE wmc_member_id = ' . $current_user_id, OBJECT);
    
    $medication_output = '<div class="BottomBoxHeader"><h2 class="registration">' . __loc('doYouTakeMedicines') . '</h2><h2>' . __loc('myMedication') . '</h2></div>';
    $medication_output.= '<table class="medication-table wmc-table zebra"><thead><tr>';
    $medication_output.= '<th>' . __loc('productName') . '</th>';
    $medication_output.= '<th>' . __loc('activeIngredient') . '</th>';
    $medication_output.= '<th>' . __loc('medicalCodeATCcode') . '</th>';
    $medication_output.= '<th></th>';
    $medication_output.= '</tr></thead><tbody>';
    
    // generate an javascript array with objects, each containing information about a single medication
    $js_script = array();
    
    foreach ($results as $result_item) {
        $atc_id = $result_item->wmc_medication_product;
        
        // Active ingredient
        $translation_results = $wpdb->get_results('SELECT * FROM wmc_medication_atc_translation WHERE atc_id = ' . $atc_id . ' AND language_id = ' . $current_language, OBJECT);
        $active_ingredient = $translation_results[0]->text;
        if ($active_ingredient == '') {
            $translation_results = $wpdb->get_results('SELECT * FROM wmc_medication_atc_translation WHERE atc_id = ' . $atc_id . ' AND language_id = 0', OBJECT);
            $active_ingredient = $translation_results[0]->text;
        }
        
        $atc_code = $translation_results[0]->atc_code;
        
        // Product name
        $translation_results = $wpdb->get_results('SELECT * FROM wmc_medication_product WHERE atc_id = ' . $atc_id . ' AND language_id = ' . $current_language, OBJECT);
        $product_name = $translation_results[0]->text;
        if ($product_name == '') {
            $translation_results = $wpdb->get_results('SELECT * FROM wmc_medication_product WHERE atc_id = ' . $atc_id . ' AND language_id = 0', OBJECT);
            $product_name = $translation_results[0]->text;
        }
        
        // push the javascript object (an array) into the $js_script array
        array_push($js_script, "['" . htmlSafe($atc_id) . "', '" . htmlSafe($product_name) . "', '" . htmlSafe($active_ingredient) . "', '" . htmlSafe($atc_code) . "']");
        
        //$medication_output.= '<tr data-atc-id="' . $atc_id . '"><td>' . $product_name . '</td><td>' . $active_ingredient . '</td><td>' . $atc_code . '</td><td><a href="#" class="delete-medication">Remove</a></td></tr>';
        
        
    }
    
    // concatenate and prepare a javascript script tag
    $script_output = "<script>var wmcUserMedications=[" . implode(",", $js_script) . "];</script>";
    
    $medication_output.= '</tbody></table>'
        . '<div class="table-is-empty">' . __loc("listIsEmpty") . '</div>'
        . '<div class="search-medication clearfix"><input type="text" placeholder="' . __loc("typeYourMedicationHere") . '"></div>'
        . '<div class="search-medication-results"></div>'
        ;
    
    // add the js script to the output
    $medication_output.= $script_output;
    
    return $medication_output;
}
add_shortcode('medication', 'medication_view');

function save_medication() {
    global $wpdb;
    global $current_user_id;
    global $current_language;
    
    $atc_id = $_REQUEST['atc_id'];
    
    $wpdb->insert('wmc_member_medication_product', array('wmc_member_id' => $current_user_id, 'wmc_medication_product' => $atc_id));
    
    $translation_results = $wpdb->get_results('SELECT * FROM wmc_medication_atc_translation WHERE atc_id = ' . $atc_id . ' AND language_id = ' . $current_language, OBJECT);
    $active_ingredient = $translation_results[0]->text;
    $atc_code = $translation_results[0]->atc_code;
    
    $result['atc_id'] = $atc_id;
    $result['user_id'] = $current_user_id;
    $result['active_ingredient'] = $active_ingredient;
    $result['atc_code'] = $atc_code;
    
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_save_medication', 'save_medication');

function delete_medication() {
    global $wpdb;
    global $current_user_id;
    
    $atc_id = intval($_REQUEST['atc_id']);
    
    $wpdb->delete('wmc_member_medication_product', array('wmc_member_id' => $current_user_id, 'wmc_medication_product' => $atc_id));
    
    $result['success'] = 1;
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_delete_medication', 'delete_medication');

function search_medication() {
    global $wpdb;
    global $current_language;
    global $current_user_id;
    
    $search_string = $_REQUEST['search_string'];
    
    $user_medication = $wpdb->get_results('SELECT * FROM wmc_member_medication_product WHERE wmc_member_id = ' . $current_user_id, OBJECT);
    if (count($user_medication) > 0) {
        foreach ($user_medication as $user_medication_item) {
            $medications_to_exclude[] = $user_medication_item->wmc_medication_product;
        }
    } else {
        $medications_to_exclude[] = 0;
    }
    
    $search_results = $wpdb->get_results('SELECT * FROM wmc_medication_product WHERE text LIKE "%' . $search_string . '%" AND language_id = ' . $current_language . ' AND atc_id NOT IN (' . implode(',', $medications_to_exclude) . ')', OBJECT);
    $search_count = count($search_results);
    if ($search_count > 0) {
        foreach ($search_results as $search_item) {
            $result[] = $search_item;
        }
    }
    
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_search_medication', 'search_medication');

?>