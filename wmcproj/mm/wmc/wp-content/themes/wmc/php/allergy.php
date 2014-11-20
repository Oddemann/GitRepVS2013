<?php

// ALLERGIES
function allergies_view(){
	global $wpdb;
	global $current_language;
	global $current_user_id;

	$results = $wpdb->get_results('SELECT * FROM wmc_member_allergy WHERE wmc_member_id = '. $current_user_id, OBJECT);

	$allergies_output = '<div class="BottomBoxHeader"><h2 class="registration">' . __loc('doYouHaveAllergies') . '</h2><h2>' . __loc('myAllergies') . '</h2></div>';
	$allergies_output .= '<table class="wmc-table allergies-table zebra">';
//	$allergies_output .= '<thead><tr>';
//	$allergies_output .= '<th>' . __loc('allergy') . '</th>';
//	$allergies_output .= '<th></th>';
//	$allergies_output .= '</tr></thead>';
	$allergies_output .= '<tbody>';

	foreach($results as $result_item){
		$allergy_id = $result_item->wmc_allergy_id;
		$translation_results = $wpdb->get_results('SELECT * FROM wmc_allergy_translation WHERE allergy_id = '. $allergy_id .' AND language_id = '. $current_language, OBJECT);
		$allergy_translation = $translation_results[0]->text;
		if($allergy_translation == ''){
			$translation_results2 = $wpdb->get_results('SELECT * FROM wmc_allergy_translation WHERE allergy_id = '. $allergy_id .' AND language_id = 0', OBJECT);
			$allergy_translation = $translation_results2[0]->text;
		}
		$allergies_output .= '<tr data-allergy-id="'. $allergy_id .'"><td>'. $allergy_translation .'</td><td><button class="delete delete-allergy avia-button avia-icon_select-no avia-color-theme-color secondary" title="Slett" type="button"><span class="avia-font-entypo-fontello" data-update_class_with="font"><span data-update_with="icon_fakeArg" class="avia_tab_icon big"></span></span></button></td></tr>';
	}

	$allergies_output .= '</tbody></table>'
		. '</tbody></table>'
		. '<div class="table-is-empty">' . __loc("listIsEmpty") . '</div>'
		. '<div class="search-allergies clearfix"><input type="text" placeholder="' . __loc('typeYourAllergyHere') . '"></div>'
		. '<div class="search-allergies-results"></div>'
		;

	return $allergies_output;
}
add_shortcode('allergies', 'allergies_view');

function save_allergy(){
	global $wpdb;
	global $current_user_id;

	$allergy_id = $_REQUEST['allergy_id'];

	$wpdb->insert(
		'wmc_member_allergy',
		array(
			'wmc_member_id' => $current_user_id,
			'wmc_allergy_id' => $allergy_id
		)
	);

	$result['allergy_id'] = $allergy_id;
	$result['user_id'] = $current_user_id;

	$result = json_encode($result);
	echo $result;

	die();
}
add_action('wp_ajax_save_allergy', 'save_allergy');

function delete_allergy(){
	global $wpdb;
	global $current_user_id;

	$allergy_id = intval($_REQUEST['allergy_id']);

	$wpdb->delete('wmc_member_allergy', array('wmc_allergy_id' => $allergy_id, 'wmc_member_id' => $current_user_id));

	$result['success'] = 1;
	$result = json_encode($result);
	echo $result;

	die();
}
add_action('wp_ajax_delete_allergy', 'delete_allergy');

function search_allergies(){
	global $wpdb;
	global $current_language;
	global $current_user_id;

	$search_string = $_REQUEST['search_string'];

	$user_allergies = $wpdb->get_results('SELECT * FROM wmc_member_allergy WHERE wmc_member_id = '. $current_user_id, OBJECT);
	if(count($user_allergies) > 0){
		foreach($user_allergies as $user_allergy){
			$allergies_to_exclude[] = $user_allergy->wmc_allergy_id;
		}
	}
	else {
		$allergies_to_exclude[] = 0;
	}

	$search_results = $wpdb->get_results('SELECT * FROM wmc_allergy_translation WHERE (text LIKE "%'. $search_string .'%" OR everyday_text LIKE "%'. $search_string .'%") AND language_id = '. $current_language .' AND allergy_id NOT IN ('. implode(',', $allergies_to_exclude) .')', OBJECT);
	$search_count = count($search_results);
	if($search_count > 0){
		foreach($search_results as $search_item){
			$result[] = $search_item;
		}
	}

	$result = json_encode($result);
	echo $result;

	die();
}
add_action('wp_ajax_search_allergies', 'search_allergies');
