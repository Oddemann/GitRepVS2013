<?php
/**
 * Created by PhpStorm.
 * User: OddDahm
 * Date: 01.09.14
 * Time: 11:01
 */
require($StiTilincludes .'kapowlib.php');

// Add Shortcode
function wmcods_Send_kapow_sms_func( $atts , $content = null ) {

    // Attributes
    extract( shortcode_atts(
            array(
                'password' => '',
                'username' => 'wmc',
                'number' => '',
            ), $atts )
    );
   

    $outp ='<div class="sms-kapow-wrap clearfix">'
         .'Brukernavnf: <Input type="text" class="sms_brukernavn"><br>'
         .'Passord: <Input type="text" class="sms_passord"><br>'
         .'Nummer: <Input type="text" class="sms_nummer"><br>'
         .'Melding: <Input type="text" class="sms_melding"><br>'
         .'<a href="#" class="button send-kapow-sms">Send sms</a>'
         .'<p class="sms-resultat"> Ikke sendt enda</>';

    // Code
    return $outp;

}
add_shortcode( 'wmcods_Send_kapow_sms', 'wmcods_Send_kapow_sms_func' );


function send_kapow_sms_go_func(){

    $kapowNavn = $_REQUEST['kapow_name'];
    $passord = $_REQUEST['kapow_password'];
    $mottagerNr = $_REQUEST['reciever_no'];
    $Melding = $_REQUEST['message_to_send'];
    //$Melding= urlencode($Melding);

    $fraSendMess= send_message($kapowNavn,$passord,$mottagerNr,$Melding,'','','','','','');

    $result['kapowRespons']= $fraSendMess;
    $result = json_encode($result);
    echo $result;
    die();
}

add_action('wp_ajax_send_kapow_sms_go', 'send_kapow_sms_go_func');
                              
?>