<?php

// DIAGNOSES
function diagnoses_view() {
    global $wpdb;
    global $current_language;
    global $current_user_id;
    
    $results = $wpdb->get_results('SELECT * FROM wmc_member_diagnosis WHERE wmc_member_id = ' . $current_user_id, OBJECT);
    
    $diagnoses_output = '<div class="BottomBoxHeader"><h2 class="registration">' . __loc('doYouHaveDiagnoses') . '</h2><h2>' . __loc('myDiagnoses') . '</h2></div>';
    $diagnoses_output.= '<table class="diagnoses-table wmc-table zebra"><thead><tr>';
    $diagnoses_output.= '<th>' . __loc('description') . '</th>';
    $diagnoses_output.= '<th>' . __loc('diagnosisCodeICD10code') . '</th>';
    $diagnoses_output.= '<th></th>';
    $diagnoses_output.= '</tr></thead><tbody>';
    
    // generate an javascript array with objects, each containing information about a single diagnose
    $js_script = array();

    foreach ($results as $result_item) {
        $diagnose_id = $result_item->wmc_diagnose_id;
        $translation_results = $wpdb->get_results('SELECT * FROM wmc_diagnosis_translation WHERE diagnosis_id = ' . $diagnose_id . ' AND language_id = ' . $current_language, OBJECT);
        $description = $translation_results[0]->text;
        $icd10_code = $translation_results[0]->icd10_code;
        
        array_push($js_script, "['" . htmlSafe($diagnose_id) . "', '" . htmlSafe($description) . "', '" . htmlSafe($icd10_code) . "']");
//        $diagnoses_output.= '<tr data-diagnosis-id="' . $diagnose_id . '"><td>' . $description . '</td><td>' . $icd10_code . '</td><td><a href="#" class="delete-diagnosis">Remove</a></td></tr>';
    }
  
      // concatenate and prepare a javascript script tag
    $script_output = "<script>var wmcUserDiagnoses=[" . implode(",", $js_script) . "];</script>";
  
    $diagnoses_output.= '</tbody></table>'
        . '<div class="table-is-empty">' . __loc("listIsEmpty") . '</div>'
        . '<div class="search-diagnoses clearfix"><input type="text" placeholder="' . __loc('typeYourDiagnosisHere') . '"></div>'
        . '<div class="search-diagnoses-results"></div>'
        ;
    
    // add the js script to the output
    $diagnoses_output.= $script_output;
    
    return $diagnoses_output;
}
add_shortcode('diagnoses', 'diagnoses_view');

function save_diagnosis() {
    global $wpdb;
    global $current_user_id;
    
    $diagnosis_id = $_REQUEST['diagnosis_id'];
    
    $wpdb->insert('wmc_member_diagnosis', array('wmc_member_id' => $current_user_id, 'wmc_diagnose_id' => $diagnosis_id));
    
    $result['diagnosis_id'] = $diagnosis_id;
    $result['user_id'] = $current_user_id;
    
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_save_diagnosis', 'save_diagnosis');

function delete_diagnosis() {
    global $wpdb;
    global $current_user_id;
    
    $diagnosis_id = intval($_REQUEST['diagnosis_id']);
    
    $wpdb->delete('wmc_member_diagnosis', array('wmc_diagnose_id' => $diagnosis_id, 'wmc_member_id' => $current_user_id));
    
    $result['success'] = 1;
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_delete_diagnosis', 'delete_diagnosis');

function search_diagnoses() {
    global $wpdb;
    global $current_language;
    global $current_user_id;
    
    $search_string = $_REQUEST['search_string'];
    
    $user_diagnoses = $wpdb->get_results('SELECT * FROM wmc_member_diagnosis WHERE wmc_member_id = ' . $current_user_id, OBJECT);
    if (count($user_diagnoses) > 0) {
        foreach ($user_diagnoses as $user_diagnosis) {
            $diagnoses_to_exclude[] = $user_diagnosis->wmc_diagnose_id;
        }
    } else {
        $diagnoses_to_exclude[] = 0;
    }
    
    $search_results = $wpdb->get_results('SELECT * FROM wmc_diagnosis_translation WHERE text LIKE "%' . $search_string . '%" AND language_id = ' . $current_language . ' AND diagnosis_id NOT IN (' . implode(',', $diagnoses_to_exclude) . ')', OBJECT);
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
add_action('wp_ajax_search_diagnoses', 'search_diagnoses');

?>