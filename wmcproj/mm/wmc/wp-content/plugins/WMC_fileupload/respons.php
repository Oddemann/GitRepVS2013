<?php

require_once('../../../wp-load.php'); // fungerer når plugin kataloven ligger på standard plassering og 
                                       // "WMC_fileupload" ligger rett under denne (som også er standard)
//include_once "/Classes/usercodeToId.php";
include_once "/Classes/CommonValues.php";
global $wpdb;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $type = $_GET['type'];
   $brukerid = $_GET['userid'];
   $kategori = $_GET['cat'];
   $viewMedic= $_GET['medic'];
   
   
    $cv= new CommonValues();
    if ($type == 'save') {
        $files = $_FILES['files'];
        
        if(!isset( $files)){
            echo ("Data inconsistency. No files to upload when uploading");
            return;
        }
        
        $upl_dir= $cv->GenUploadDir();
        if (!file_exists ( $upl_dir) || is_file( $upl_dir) )
        {
            echo ("Upload directory does not exist");
            return;
        }
      
        $upl_dir= $cv->ownDir();
        if (!file_exists ( $upl_dir)) 
        {
            if( is_file( $upl_dir) )
            {
                echo "Upload directory does not exist";
                return;
            }
            
            if( !mkdir($upl_dir) )
            {
                echo "Directory for uploaded files did not exist and creation failed";
                return;
            };
            
            if( !is_writable($upl_dir) ){
                echo "Directory for uploaded files did not exist and creation failed";
                return;
        
            }
             
                
        }  // if (!file_exists ( $upl_dir))
        
        
        for ($index = 0; $index < count($files['name']); $index++) {
            $file = $files['tmp_name'][$index];
            $filstorleik= $files['size'][$index];
            
            if (is_uploaded_file($file)) {
                $filnavn= $files['name'][$index];
                $filtype= $files['type'][$index];
                $filfeil= $files['error'][$index];
                $filstorleik= $files['size'][$index];

                    // bygg opp insert sql streng;
                $valuelist= array();
                $Colnames=  array();
                $Colnames[]='userref';
                $valuelist[]=$brukerid;
                $Colnames[]='filetype';
                $valuelist[]=addslashes($filtype);
                $Colnames[]='category';
                $valuelist[]=$kategori;  
                $Colnames[]='comment';
                $valuelist[]=" ";
                $Colnames[]='viewableMedic';
                $valuelist[]=$viewMedic;            
                $Colnames[]='filename';
                $valuelist[]=addslashes($filnavn);
                $Colnames[]='filesize';
                $valuelist[]=$filstorleik;
                $Colnames[]='errorcode';
                if ($filfeil ==0)
                    {$valuelist[]= -586;}    // dette blir feilen viss ikke oppdatering lykkes
                else
                    {$valuelist[]= $filfeil;}
            
                $colNameStreng= implode(',', $Colnames);
                $valuelistsStreng = implode("','",$valuelist);
                
                
                   // gjør dataoppdatering
                $queryNyPost= "INSERT INTO wmc_user_document (".$colNameStreng.") VALUES('".$valuelistsStreng."');";
                
                $result = $wpdb->query($queryNyPost);
                $insertedId= $wpdb->insert_id;
                
                $genFileName='f'.$insertedId;
                
                if (copy($file, $cv->PathAndName( $genFileName))) {
                    $qInsertFName= 'UPDATE wmc_user_document SET internName= "'.$genFileName.'", errorcode = 0 WHERE Id= '.$insertedId.';'; 
                    $result = $wpdb->query($qInsertFName);
                }    // if copy(
          
            }    // if       
        }   // for
/*         
    } else if ($type == 'remove') {
        $fileNames = $_POST['fileNames'];
        // Delete uploaded files
        /*
        for ($index = 0; $index < count($fileNames); $index++) {
        unlink('./' . $fileNames[$index]);
        }
         */ /*
    }

    // Return an empty string to signify success
  
    */
    }   // if
} // if
echo "";
?>