<?php
include_once "./ClassIncluder.php";
require_once('../../../wp-load.php'); // fungerer når plugin kataloven ligger på standard plassering og 
// "WMC_fileupload" ligger rett under denne (som også er standard)
global $wpdb;

$tabellnavn='wmc_user_document';

$request = json_decode(file_get_contents('php://input'));
$type = $_GET['type'];

$result = null;

// sett userId 
 // require_once $_SERVER["DOCUMENT_ROOT"] . "/mm/wmc/wp-content/plugins/Classes/usercodeToId.php";
 $u= new usercodeToId($_REQUEST['emergencycode']);

    // flere sjekker her mot andre user verdier?

$catnamefunc= new CategoryName();

if ($type == 'create') {
    // In batch mode the inserted records are available in the 'models' field

}
if ($type == 'read') {
    $q= 'SELECT * from '.$tabellnavn.' WHERE '.$u->meddicSqlPart.' userref ='.$u->userid.';';   
    $results= $wpdb->get_results( $q, ARRAY_A );
  
    
    if (isset($results)){
        $noRes=count($results);
        
        for( $c=0; $c<$noRes; $c++ ) {
            $catNo= $results[$c]["category"];
            $s= $catnamefunc->document_kategori($catNo);
            $results[$c]["catname"]= $s;
            
            $results[$c]["viewableMedic"]=($results[$c]["viewableMedic"]==0) ? false : true; // skift ut tinyint med boolsk verdi
        }
        
        $result= $results;
    }       // if (isset($results)){
}       // if ($type == 'read')
if ($type == 'update') {
    // flere sjekker her mot andre user verdier?

    // in batch mode the updated records are available in the 'models' field
    $updatedPoster = $request->models;

    foreach($updatedPoster as $post) {
        // Create UPDATE SQL statement
        $data= array( );
        $data['comment']= $post->comment;
        $data['viewableMedic']=$post->viewableMedic;
        $data['category']=$catnamefunc->Kategori_number( $post->catname);
        
        $where=array( );      
        $where['id']=$post->id;
      
        $wpdb->update($tabellnavn, $data, $where);
    }
}
if ($type == 'destroy') {
    // in batch mode the destroyed records are available in the 'models' field
    $destroyeposts = $request->models;

    foreach($destroyeposts as $post) {
        $where=array( );      
        $where['id']=$post->id;
        $wpdb->delete($tabellnavn, $where);
    }
}
if ($type == 'catnames') {
    $r1= $catnamefunc->KategoriList();
    $buildSchema= array('total'=>$catnamefunc->No_of_Categories());
    $data= array();
    $c=1;
    foreach($r1 as $item ){       
      $data[]= array('text' => $item, 'value' => $c);
      $c++;
    }
    $buildSchema['data']= $data;  
    $result=$buildSchema;
}

// Set response content type
header('Content-Type: application/json');

$r = json_encode($result);

echo $r;
?>