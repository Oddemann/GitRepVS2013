<?php
/**
 * Created by PhpStorm.
 * User: OddDahm
 * Date: 26.08.14
 * Time: 09:57
 */


function insurance_crud_view(){
    global $wpdb;
    global $current_user_id;
    $query= 'SELECT ins_type FROM wmc_ins_type ORDER BY ins_type';
    $hiddenselect= '<select  id="hidden_select_mal" style="display: none;"><option value="0">Choose insurence type</option>';
    //style="visibility: hidden;"
    $lt=0;   // Løkketeller
    $result_types = $wpdb->get_results( $query);
    foreach ($result_types as $itemt) {
        $lt++;
        $hiddenselect.=  '<option value="'.$lt.'">'.$itemt->ins_type.'</option>';
    }
    $hiddenselect.= '</select>';



        // ihh spesifikasjonen skal språk ikke tas hensyn til
    $results = $wpdb->get_results(
    'SELECT i.id, i.user_id, i.ins_company, i.ins_policy, i.ins_phone, i.ins_type AS ins_kode, i.ins_card, it.ins_type_lang, it.ins_type AS ins_type_tekst
    FROM wmc_insurance AS i INNER JOIN wmc_ins_type AS it ON i.ins_type = it.id
    WHERE i.user_id ='. $current_user_id, OBJECT);

    $insurance_reg_output = $insurance_reg_output =$hiddenselect;
    $insurance_reg_output .= '<div class="insurence-wrap clearfix"><h2>INSURENCES</h2>';
    $insurance_reg_output .= '<table class="insurence-table"><thead><tr>';
    $insurance_reg_output .= '<th>Forsikringsselskap</th>';
    $insurance_reg_output .= '<th>Forsikringstype</th>';
    $insurance_reg_output .= '<th>Polisenr.</th>';
    $insurance_reg_output .= '<th>Telefon</th>';
    //$insurance_reg_output .= '<th colspan="2"></th>';
    $insurance_reg_output .= '</tr></thead><tbody>';

    foreach($results as $result_item){
        $ins_id = $result_item->id;
        $ins_typekode = $result_item->ins_kode;
        $ins_company = $result_item->ins_company;
        $ins_policy = $result_item->ins_policy;
        $typetekst = $result_item->ins_type_tekst;
        $phone = $result_item->ins_phone;

        $insurance_reg_output .= '<tr data-ins-id="'. $ins_id .'" data-ins-type="'. $ins_typekode .'">';
        $insurance_reg_output .= '<td class="ins-company">'. $ins_company .'</td>';
        $insurance_reg_output .= '<td class="ins-typetekst">'. $typetekst .'</td>';
        $insurance_reg_output .= '<td class="ins-policyNo">'. $ins_policy .'</td>';
        $insurance_reg_output .= '<td class="ins-phone">'. $phone .'</td>';

        $insurance_reg_output .= '<td><a href="#" class="edit-insurence">Edit</a></td>';
        $insurance_reg_output .= '<td><a href="#" class="delete-insurence">Remove</a></td>';
        $insurance_reg_output .= '</tr>';
    }

    $insurance_reg_output .= '</tbody></table>';
    $insurance_reg_output .= '<a href="#" class="button add-insurence">Add insurance</a></div>';

    return $insurance_reg_output;
}
add_shortcode('wmcods_insurance_crud', 'insurance_crud_view');
    // crud = Create, read, update od delete


function save_insurence(){
    global $wpdb;
    global $current_user_id;

    $company = $_REQUEST['company'];
    $type_ins = $_REQUEST['type_ins'];
    $policyNo = $_REQUEST['policy_no'];
    $phone = $_REQUEST['phone'];

    $wpdb->insert(
        'wmc_insurance',
        array(
            'user_id' => $current_user_id,
            'ins_company' => $company,
            'ins_policy' => $policyNo,
            'ins_type' => $type_ins,
            'ins_type' => $type_ins,
            'ins_phone' => $phone
        )
    );
            // her er det potensiale for ytelsesforbedringer:  SELECT MAX(column_name) FROM table_name WHERE ...;
    $ins_id = $wpdb->get_results('SELECT id FROM wmc_insurance WHERE user_id = '. $current_user_id, ARRAY_A);
    $ins_id = array_reverse($ins_id);
    $ins_id = $ins_id[0]['id'];

    $result['ins_id'] = $ins_id;

    $result = json_encode($result);
    echo $result;
    die();
}
add_action('wp_ajax_save_insurence', 'save_insurence');

function delete_insurence(){
    global $wpdb;
    global $current_user_id;

    $ins_id = $_REQUEST['ins_id'];

    $wpdb->delete('wmc_insurance', array('id' => $ins_id));

    $result['success'] = 1;
    $result = json_encode($result);
    echo $result;

    die();
}
add_action('wp_ajax_delete_insurence', 'delete_insurence');

function update_insurence(){
    global $wpdb;
    global $current_user_id;

    $company = $_REQUEST['company'];
    $type_ins = intval($_REQUEST['type_ins']);
    $policy_no = $_REQUEST['policy_no'];
    $phone = $_REQUEST['phone'];

    $ins_id = intval($_REQUEST['ins_id']);

    $wpdb->update(
        'wmc_insurance',
        array(
            'ins_company' => $company,
            'ins_type' => $type_ins,
            'ins_phone' => $phone,
            'ins_policy' => $policy_no,
        ),
        array(
            'id' => $ins_id
        )
    );

    $result['success'] = 1;
    $result = json_encode($result);
    echo $result;

    die();
}
add_action('wp_ajax_update_insurence', 'update_insurence');



?>