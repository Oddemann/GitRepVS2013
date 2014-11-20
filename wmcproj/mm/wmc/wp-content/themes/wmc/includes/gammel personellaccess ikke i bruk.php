<?php

function wmcods_Emergency_Login_go_func() {
    
    
    $code = $_POST['emergencycode'];
    $userid = ods_GetUseridUsingCode($code);
    
    
    
    $r=-1;
    if( $userid != null)
        $r= $userid;
    // response output
    header( "Content-Type: application/json" );
    echo json_encode($r);  
    
    exit;
}

// wp_ajax add_action for både pålogget bruk og anonym bruk
add_action( 'wp_ajax_nopriv_wmcods_Emergency_Login_go', 'wmcods_Emergency_Login_go_func' );
add_action(        'wp_ajax_wmcods_Emergency_Login_go', 'wmcods_Emergency_Login_go_func' );

// =================
function wmcods_Display_user_files_func( $atts , $content = null )
{
    $args = array(
        'orderby'          => 'post_title',
        'order'            => $post_order,
        'post_type'        => 'nm-userfiles',
        'post_status'      => 'publish',
        'paged'			   => $paged,
        'author'           => get_current_user_id(),
        'meta_query' 	   => array( 
                                    array('key' => 'uploaded_file_names',
                                          'value' => $search_str,
                                          'compare' => 'LIKE')
                                    )
        );
    
    $my_query = new WP_Query();
    $query_posts = $my_query->query($args);
    
    $my_query1 = new WP_Query($args);
    
    $outP='';
    while ( $my_query->have_posts() ) : 
        $my_query->the_post();
        $outP .= '<div class="seperator-user-document"></div>';
        $outP .= the_content();
    endwhile;
    $outP .= '<div class="end-user-document"></div>';
}


// bruk av fileupload
add_shortcode('wmcods_ShowUserCodeFiles', 'wmcods_ShowUserCodeFiles_func');
function wmcods_ShowUserCodeFiles_func( )
{
    // Attributes for shortcode
    $atts= shortcode_atts(
            array(
                'Code' => '',
            ), 
            $atts );
    
    // $userIdOfCode=ods_GetUseridUsingCode($atts['Code']);
    
    $outp= do_shortcode( '[wmcods_ShowUploadedFiles_func]' . $userIdOfCode . '[/wmcods_ShowUploadedFiles_func]' );
    return $outp;
	
}

?>