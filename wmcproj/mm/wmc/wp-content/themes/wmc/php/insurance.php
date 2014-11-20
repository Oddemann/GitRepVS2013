<?php
function insurance_view() {
    global $wpdb, $current_language;

    $output = '';

    $ins_types = $wpdb->get_results('SELECT id, ins_type FROM wmc_ins_type WHERE ins_type_lang = ' . $current_language, OBJECT);
    $ins_output = array();
    foreach ($ins_types as $res) {
        $ins_output[$res->id] = $res->ins_type;
    }

    $output = '<script>wmcInsuranceTypes=' . json_encode($ins_output) . ';</script>';

    $current_user_id = get_current_user_id();

    /*
    <div>
<div class="flex_column av_one_half first"><input name="ins_company" type="text" placeholder="Forsikringsselskap" /></div>
<div class="flex_column av_one_half"><select title="Forsikringsstype" name="ins_type">
<option value="3">Travelinsurance</option>
<option value="4">Healthinsurance</option>
</select></div>
<div class="flex_column av_one_half first"><input name="ins_policy" type="text" placeholder="Polisenummer" /></div>
<div class="flex_column av_one_half"><input name="ins_phone" type="text" placeholder="Krisenummer" /></div>
</div>
*/
    
    // template for each insurance row
    echo '<script type="html/text" id="tpl_insurance_row">' 
    . '<tr>' 
    . '<td>'
        . '<input type="hidden" name="ins_id">' 
        . '<input type="text" name="ins_company" placeholder="' . __loc('insuranceCompany') . '" class="in-edit-mode">' 
        . '<span data-type="ins_company" class="in-read-mode"></span>' 
    . '</td>'
    . '<td>'
        . '<select name="ins_type" title="' . __loc('insuranceType') . '" class="in-edit-mode">'
        . '</select>' 
        . '<span data-type="ins_type" class="in-read-mode"></span>' 
    . '</td>'
    . '<td>'
        . '<input type="text" name="ins_policy" placeholder="' . __loc('insurancePolicy') . '" class="in-edit-mode">' 
        . '<span data-type="ins_policy" class="in-read-mode"></span>' 
    . '</td>'
    . '<td>'
        . '<input type="tel" name="ins_phone" placeholder="' . __loc('insurancePhone') . '" class="in-edit-mode">'
        . '<span data-type="ins_phone" class="in-read-mode"></span>' 
    . '</td>'
    // . '<td>'
    //     . '<label class="in-edit-mode"><input type="checkbox" name="ins_card" value="1"> <span>' . __loc('isIncludedInCard') . '</span></label>' 
    //     . '<span data-type="ins_card" class="symbol-icon in-read-mode" title="' . __loc("isIncludedInCard") . '"></span>' 
    // . '</td>'
    . '<td>'
        . '<button class="save in-edit-mode avia-button avia-icon_select-no avia-color-theme-color primary" title="' . __loc('save') . '" type="submit"><span class="symbol-icon"></span></button>' 
        . '<button class="cancel in-edit-mode avia-button avia-icon_select-no avia-color-theme-color secondary" title="'  . __loc('cancel') . '" type="button"><span class="symbol-icon"></span></button>' 
        . '<button class="edit in-read-mode avia-button avia-icon_select-no avia-color-theme-color secondary" title="' . __loc('edit') . '" type="submit"><span class="symbol-icon"></span></button>' 
        . '<button class="delete in-read-mode avia-button avia-icon_select-no avia-color-theme-color secondary" title="' . __loc('delete') . '" type="button"><span class="symbol-icon"></span></button>' 
    . '</td>'
    . '</tr>' 
    . '</script>';

    $output .= '<table class="insurance-table wmc-table zebra">' 
    // . '<thead>' 
    // . '<tr>' 
    // . '<th>Selskap</th>' 
    // . '<th>Type</th>' 
    // . '<th>Polisenummer</th>' 
    // . '<th>Krisenummer</th>' 
    // . '<th>WMC-kort</th>' 
    // . '<th></th>' 
    // . '</tr>' 
    // . '</thead>' 
    . '<tbody>';
    
    $js_array = array();
    
    $results = $wpdb->get_results('SELECT * FROM wmc_insurance WHERE user_id = ' 
    . $current_user_id, OBJECT);
    
    foreach ($results as $res) {
        // array_push($js_array, array($res->id, $res->ins_company, $res->ins_type, $res->ins_policy, $res->ins_phone, $res->ins_card));
        array_push($js_array, array($res->id, $res->ins_company, $res->ins_type, $res->ins_policy, $res->ins_phone));
        // $output .= "<tr data-id='" 
        //     . $res->id 
        //     . "'>" 
        //     . "<td>$res->ins_company</td>" 
        //     . "<td>$res->ins_type</td>" 
        //     . "<td>$res->ins_policy</td>" 
        //     . "<td>$res->ins_phone</td>" 
        //     . "<td>$res->ins_card</td>" 
        //     . "</tr>";
    }
    
    $output .= '</tbody>' 
        . '</table>'
        . '<div>'
        . '<button id="add-insurance" class="avia-button avia-icon_select-no avia-color-theme-color primary">' . __loc('addInsurance') . '</button>'
        . '</div>';
    
    $output.= '<script>wmcUserInsurances=' . json_encode($js_array) . ';</script>';
    
    return $output;
}

add_shortcode('insurance', 'insurance_view');

function save_insurance() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $ins_company = $_REQUEST['ins_company'];
    $ins_policy = $_REQUEST['ins_policy'];
    $ins_phone = $_REQUEST['ins_phone'];
    $ins_type = $_REQUEST['ins_type'];
    // $ins_card = $_REQUEST['ins_card'];
    
    // $wpdb->insert('wmc_insurance', array('user_id' => $current_user_id, 'ins_company' => $ins_company, 'ins_policy' => $ins_policy, 'ins_phone' => $ins_phone, 'ins_type' => $ins_type, 'ins_card' => $ins_card));
    $wpdb->insert('wmc_insurance', array('user_id' => $current_user_id, 'ins_company' => $ins_company, 'ins_policy' => $ins_policy, 'ins_phone' => $ins_phone, 'ins_type' => $ins_type));
    
    $ins_res = $wpdb->get_results('SELECT id FROM wmc_insurance WHERE user_id = ' . $current_user_id, ARRAY_A);
    $ins_res = array_reverse($ins_res);
    $ins_id = $ins_res[0]['id'];
    
    $result['ins_id'] = $ins_id;
    
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_save_insurance', 'save_insurance');

function delete_insurance() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $ins_res = $_REQUEST['id'];
    
    $wpdb->delete('wmc_insurance', array('id' => $ins_res, 'user_id' => $current_user_id));
    
    $result['success'] = '1';
    $result = json_encode($result);
    echo $result;
    
    die();
}
add_action('wp_ajax_delete_insurance', 'delete_insurance');

function update_insurance() {
    global $wpdb;
    $current_user_id = get_current_user_id();
    
    $ins_id = $_REQUEST['ins_id'];
    $ins_company = $_REQUEST['ins_company'];
    $ins_policy = $_REQUEST['ins_policy'];
    $ins_phone = $_REQUEST['ins_phone'];
    $ins_type = $_REQUEST['ins_type'];
    // $ins_card = $_REQUEST['ins_card'];
    
    // $result = $wpdb->update('wmc_insurance', array('ins_company' => $ins_company, 'ins_policy' => $ins_policy, 'ins_phone' => $ins_phone, 'ins_type' => $ins_type, 'ins_card' => $ins_card), array( 'id' => $ins_id ) );
    $result = $wpdb->update('wmc_insurance', array('ins_company' => $ins_company, 'ins_policy' => $ins_policy, 'ins_phone' => $ins_phone, 'ins_type' => $ins_type), array( 'id' => $ins_id ) );
    
    $response = array(
        "ins_id" => $ins_id,
        "ins_company" => $ins_company,
        "ins_policy" => $ins_policy,
        "ins_phone" => $ins_phone,
        "ins_type" => $ins_type,
        "success" => $result
    );
    echo json_encode($response);
    
    die();
}
add_action('wp_ajax_update_insurance', 'update_insurance');

function getInsuranceType($ins_type) {
    $translation_results = $wpdb->get_results('SELECT * FROM wmc_ins_type WHERE id = ' . $ins_type . ' AND ins_type_lang = ' . $current_language, OBJECT);
    $ins_type = $translation_results[0]->ins_type;
    return $ins_type;
}
?>