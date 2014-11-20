<?php

// NEXT OF KIN
function next_of_kin_view() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $results = $wpdb->get_results('SELECT * FROM wmc_member_next_of_kin WHERE wmc_member_id = ' . $current_user_id, OBJECT);
    
    $next_of_kin_output = '<table class="next-of-kin-table wmc-table zebra-double">'
    
    //        . '<thead>'
    //        . '<tr>'
    //        . '<th>Navn</th>'
    //        . '<th>Telefon</th>'
    //        . '<th></th>'
    //        . '</tr>'
    //        . '</thead>'
     . '<tbody>';
    
    foreach ($results as $result_item) {
        $nok_id = $result_item->id;
        $first_name = $result_item->first_name;
        $last_name = $result_item->last_name;
        $phone_prefix_country = $result_item->phone_prefix_country;
        $phone = $result_item->phone;
        
        $next_of_kin_output.= '<tr data-id="' . $nok_id . '" data-first_name="' . $first_name . '" data-last_name="' . $last_name . '" data-phone_prefix="' . $phone_prefix_country . '" data-phone="' . $phone . '">' . '<td></td>' . '</tr>';
    }
    
    $next_of_kin_output.= '</tbody>' . '</table>';
    
    $next_of_kin_output.= '<div><button id="add-next-of-kin" class="avia-button avia-icon_select-no avia-color-theme-color primary">' . __loc('addNextOfKin') . '</button></div>';
    
    return $next_of_kin_output;
}

add_shortcode('next_of_kin', 'next_of_kin_view');

function save_next_of_kin() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone_prefix = $_REQUEST['phone_prefix'];
    $phone = $_REQUEST['phone'];
    
    $wpdb->insert('wmc_member_next_of_kin', array('wmc_member_id' => $current_user_id, 'first_name' => $first_name, 'last_name' => $last_name, 'phone_prefix_country' => $phone_prefix, 'phone' => $phone));
    
    $nok_id = $wpdb->get_results('SELECT id FROM wmc_member_next_of_kin WHERE wmc_member_id = ' . $current_user_id, ARRAY_A);
    $nok_id = array_reverse($nok_id);
    $nok_id = $nok_id[0]['id'];
    
    $result['nok_id'] = $nok_id;
    
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_save_next_of_kin', 'save_next_of_kin');

function delete_next_of_kin() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $nok_id = $_REQUEST['nok_id'];
    
    $wpdb->delete('wmc_member_next_of_kin', array('id' => $nok_id, 'wmc_member_id' => $current_user_id));
    
    $result['success'] = '1';
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_delete_next_of_kin', 'delete_next_of_kin');

function update_next_of_kin() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone_prefix = $_REQUEST['phone_prefix'];
    $phone = $_REQUEST['phone'];
    $nok_id = $_REQUEST['nok_id'];
    
    $wpdb->update('wmc_member_next_of_kin', array(
    
    //'wmc_member_id' => $current_user_id,
    'first_name' => $first_name, 'last_name' => $last_name, 'phone_prefix_country' => $phone_prefix, 'phone' => $phone,), array('id' => $nok_id));
    
    $result['success'] = '1';
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_update_next_of_kin', 'update_next_of_kin');

?>