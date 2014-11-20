<?php

$progressDict = array(
    array(
        step => 0,
        url => '/home/myaccount/',
        percent => 0
    ),
    array(
        step => 1,
        url => '/home/next-of-kin/',
        percent => 20
    ),
    array(
        step => 2,
        url => '/home/medical-data/',
        percent => 40
    ),
    array(
        step => 3,
        url => '/home/organdonation/',
        percent => 60
    ),
    array(
        step => 4,
        url => '/home/insurance/',
        percent => 80
    ),
    array(
        step => 5,
        url => '/home/card/',
        percent => 100
    ),
    array(
        // the last page when all mandatory steps are completed
        step => 100,
        url => '/home/',
        percent => 100
    )
);

function is_in_registration_process() {
  	global $current_user_id, $localeShort, $wpdb;

    // do we have a user?
    if ($current_user_id) {

    	// prefixed table name
	    $table = $localeShort . '_users';

      // retrieve user data
      $user = $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ID = ' . $current_user_id, OBJECT);

      // retrieve user's registration progress
      $registrationProgress = $user->registration_progress;

      // return whether or not the user in the process of registering?
      return $registrationProgress < 100;

    }

    return false;

}

function registration_progress_view() {
	global $current_user_id, $localeShort, $wpdb, $progressDict;

    // do we have a user?
    if ($current_user_id) {

    	// prefixed table name
	    $table = $localeShort . '_users';

    	// retrieve user data
        $user = $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ID = ' . $current_user_id, OBJECT);

        // retrieve user's registration progress
        $registrationProgress = $user->registration_progress;

        // is the user in the process of registering?
        if ($registrationProgress < 100) {

            $progressObj = $progressDict[$registrationProgress];
            $c2aLabel = $progressObj['step'] < 5 
                ? __loc("next")
                : __loc("orderCard")
                ;

            // make progress navigation template available for front end
			$markup = '<span id="progressNavigation" class="progress-navigation">'
				. '<button class="avia-button avia-icon_select-no secondary" type="button">' . $c2aLabel . '</button>'
				. '<span class="progress" title="' . __loc("progress") . '">'
				. '<span class="bg"></span>'
				. '<span class="percent dark"></span>'
				. '<span class="percent light"></span>'
				. '</span>'
				. '</span>'
				;

            if ($progressObj['percent'] === 100 ) {
                $markup .= '<div style="display: none" id="wmc-card-is-sent-content">' . get_page_content(array("slug" => "card-is-sent")) . '</div>';
            }

            // make the registration progress step available for front end
			$markup .= '<script>'
                . 'wmc.progressDict = ' . json_encode($progressDict) . ';'
                . 'wmc.registrationProgress = ' . $registrationProgress . ';'
                . '</script>';


			return $markup;
        }

    }

}
add_shortcode('registration_progress', 'registration_progress_view');

function update_registration_progress() {
    global $wpdb, $localeShort;

    $table = $localeShort . '_users';

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
add_action('wp_ajax_update_registration_progress', 'update_registration_progress');

?>