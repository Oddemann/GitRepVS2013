<?php

/*
* Add your own functions here. You can also copy some of the theme functions into this file. 
* Wordpress will use those functions instead of the original functions then.

add_filter('show_admin_bar', '__return_false');
*/
define('WPLANG', 'nb_NO'); // lagt til av Ods
// retrieve the current language definitions
$localePath = $_SERVER['DOCUMENT_ROOT'] . "\\wp-content\\themes\\wmc\\locale\\" . get_locale() . '.php';
include_once $localePath;
$localeShort = explode( "_", get_locale() );
$localeShort = strtolower( $localeShort[1] );

// Current language for the language picker used in medical data
session_start();
$current_language = $_SESSION['current_language'];

if ($current_language == '') {
    $current_language = 1;
}

// $output = $wpdb->get_results('SELECT * FROM wmc_language WHERE active = 1', OBJECT);

/**
Makes the $__locale dictionary more easealy accessible for functions - not needing to add the global statement.
@param $id {String} The id of the locale string to be retrieved.
@return {String} The translated locale string.
*/
function __loc($id) {
    global $__locale;
    return $__locale[$id];
}

function htmlSafe($str) {
    return htmlentities($str, ENT_QUOTES);
}

// Current user ID
$current_user_id = get_current_user_id();

function wmc_js() {
    wp_enqueue_script('jquery.cookiesdirective.js', get_bloginfo('stylesheet_directory') . '/js/jquery.cookiesdirective.js', array());
    wp_enqueue_script('jqueryUI/jquery-ui.min.js', get_bloginfo('stylesheet_directory') . '/jqueryUI/jquery-ui.min.js');
    wp_enqueue_script('jqueryUI/datepicker-nb.js', get_bloginfo('stylesheet_directory') . '/jqueryUI/datepicker-nb.js');
    
    // make language definitions accessible to javascript
    global $__locale;
    echo '<script>var __locale = ' . json_encode($__locale) . ';</script>';
    wp_enqueue_script('ProgressManager', get_bloginfo('stylesheet_directory') . '/js/ProgressManager.js', array());
    wp_enqueue_script('wmc-js', get_bloginfo('stylesheet_directory') . '/js/wmc-js.js', array());
    
    wp_enqueue_script('PersonelAccess', get_bloginfo('stylesheet_directory') . '/includes/PersonelAccess.js', array());
}

function wmc_inline_js() {

    global $__locale, $current_user_id, $wpdb;

    // wmc front end name space
    echo '<script>if (!wmc) { var wmc = {}; }</script>';

    // make the AJAX script's URL available for front end
    echo "<script>var ajaxurl = '" . admin_url('admin-ajax.php') . "';</script>";

}

add_action('wp_enqueue_scripts', 'wmc_js');
add_action('wp_head', 'wmc_inline_js');

$pathToPHPfolder = $_SERVER['DOCUMENT_ROOT'] . "\\wp-content\\themes\\wmc\\php\\";
include_once $pathToPHPfolder . "nextofkin.php";
include_once $pathToPHPfolder . "allergy.php";
include_once $pathToPHPfolder . "medication.php";
include_once $pathToPHPfolder . "diagnose.php";
include_once $pathToPHPfolder . "insurance.php";
include_once $pathToPHPfolder . "progress.php";
include_once $pathToPHPfolder . "card.php";
include_once $pathToPHPfolder . "otherinformation.php";

function language_picker_view() {
    global $wpdb;
    global $current_language;
    
    $language_picker = '<div class="wmc-language-picker">'
        . '<p>' . __loc('chooseTranslateLanguage') . '</p>'
        . '<select>'
        ;
    
    //$language_picker .= '<option value="0">English</option>';
    
    $languages = $wpdb->get_results('SELECT id, name FROM wmc_language WHERE active = 1', OBJECT);
    foreach ($languages as $language) {
        $language_picker.= '<option value="' . $language->id . '"';
        if ($current_language == $language->id) {
            $language_picker.= ' selected';
        }
        $language_picker.= '>' . $language->name . '</option>';
    }
    
    $language_picker.= '</select>';
    $language_picker.= '</div>';
    
    return $language_picker;
}
add_shortcode('language_picker', 'language_picker_view');

function language_to_session() {
    $_SESSION['current_language'] = $_REQUEST['current_language'];
    echo $_SESSION['current_language'];
    
    die();
}

add_action('wp_ajax_language_to_session', 'language_to_session');

function get_page_id_by_slug($slug){
    global $wpdb;
    $id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$slug."'AND post_type = 'page'");
    return $id;
}

function get_page_content($atts) {
    $id = get_page_id_by_slug($atts["slug"]);
    $post = get_post($id); 
    $content = apply_filters('the_content', $post->post_content); 
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = str_replace("\r", "<br />", $content);
    return $content; 
}
add_shortcode('page_content', 'get_page_content');

function get_translation($atts) {
    return __loc( $atts[0] );
}
add_shortcode('loc', 'get_translation');

function wmc_decision($atts, $content = null) {
    $a = shortcode_atts( array(
        'registration_process' => 0
    ), $atts );

    if ( isset( $atts["registration_process"] ) ) {
        // show if in registration process
        if ( is_in_registration_process() && $a["registration_process"] ) {
          return do_shortcode($content);
        }
        // show if not in registration process
        if ( !is_in_registration_process() && !$a["registration_process"] ) {
          return do_shortcode($content);
        }
        // nothing to show
        return "";
    }

}
add_shortcode('wmc_decision', 'wmc_decision');

function edit_password(){
	global $current_user_id;

  $ret = array(
    "result" => 0,
    "message" => __loc("passwordWasNotChanged")
  );

	// the user must be logged in
	if ($current_user_id) {

    $password = $_REQUEST['password'];

    $result = update_user_meta($current_user_id, 'user_pass', $password);
    wp_update_user( array ('ID' => $current_user_id, 'user_pass' => $password) ) ;

    $ret = array(
      "result" => 1,
      "message" => __loc("passwordWasChanged")
    );

  }

  echo json_encode($ret);
	die();
}
add_action('wp_ajax_edit_password', 'edit_password');

// start include ods
// =============================================================================================
// Legg til linjer fra og med "start include ods" til og med "stopp include ods"
// på slutten av functions.php (som ligger wmc-tema katalogen)
$ods_StiTilincludes = $_SERVER["DOCUMENT_ROOT"] . "\\mm\\wmc\\wp-content\\themes\\wmc\\includes\\";
include_once $ods_StiTilincludes.'insurance_crud.php';
include_once $ods_StiTilincludes.'kapow_sms.php';
include_once $ods_StiTilincludes.'doctorreport.php';
include_once $ods_StiTilincludes.'PersonelAccess.php';  // 14.10.01
// stopp include ods

?>