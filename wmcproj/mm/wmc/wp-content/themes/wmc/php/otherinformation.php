<?php

function other_information_view() {
	$heading = is_in_registration_process() ? __loc('doYouHaveOtherInformation') : __loc('otherInformation');

	$output = '<div class="BottomBoxHeader"><h2>' . $heading . '</h2></div>'
		. '<div><input type="text" maxlength="128" value="' . mm_member_data(array("name"=>"customField_2")) . '"></div>'
		. '<div><button id="addOtherInformation" class="avia-button avia-icon_select-no avia-color-theme-color primary">' . __loc('save') . '</button></div>'
		;

	echo $output;
}
add_shortcode('other_information', 'other_information_view');

function update_other_information() {
    global $wpdb;

    $current_user_id = get_current_user_id();
    
    $registration_progress = $_REQUEST['registration_progress'];

    $result = $wpdb->update(
    	$table, 
    	array( 'registration_progress' => $registration_progress ), 
    	array( 'ID' => $current_user_id ) 
    );

    $response = array(
    	"registration_progress" => $registration_progress,
        "success" => $result
    );

    echo json_encode($response);
    
    die();
}
add_action('wp_ajax_update_other_information', 'update_other_information');

?>