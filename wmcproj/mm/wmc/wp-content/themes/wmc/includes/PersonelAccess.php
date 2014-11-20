<?php

function wmcods_Send_DocList_to_browser_func( ){
    //require_once $_SERVER["DOCUMENT_ROOT"] . "\\mm\\wmc\\wp-content\\plugins\\Classes\\usercodeToId.php";
    $u= new usercodeToId($_REQUEST['emergencycode']);
    
    $output = ($u->is_ok ? wmcods_ShowUserCodeFiles_globalId() : -1);
    if ($u->is_ok)
        $output.= "<br>".wmcods_DoctorReportView();
    
    $output=json_encode($output);
    echo $output;
    die();
}

// wp_ajax add_action for både pålogget bruk og anonym bruk: sende dokumentlisten til browser
add_action( 'wp_ajax_nopriv_wmcods_Send_DocList_to_browser', 'wmcods_Send_DocList_to_browser_func' );
add_action(        'wp_ajax_wmcods_Send_DocList_to_browser', 'wmcods_Send_DocList_to_browser_func' );

// Add Shortcode
add_shortcode( 'wmcods_Emergency_Login', 'wmcods_Emergency_Login_func' );
function wmcods_Emergency_Login_func( $atts , $content = null ) {
    
    
    // lagt inn wp_enqueue_script i functions PersonelAccess
    // Attributes
    extract( shortcode_atts(
            array(
                'Code' => '',
            ), $atts )
    );

    $outp ='<div class="Emergency_Login clearfix">'
         .'Emergency User Code: <Input type="text" class="Emergency_Login" id="Emergency_LoginId">'
         .'<a href="#" class="button Use-emergency-code" id="Emergency_button" onclick="startMedUserCode(this); return false;">Use emergency code </a>'
         .'<div class="result_Emergency_click" Id="result_Emergency" >Button not clicked</div>'
         ;

    // Code
    return $outp;

}

add_shortcode( 'wmcods_Emergency_Logout', 'wmcods_Emergency_Logout_func' );
function wmcods_Emergency_Logout_func( $atts , $content = null ) {
    
 
}
?>