<?php

/**
 * CommonValues for files uploading
 *
 * CommonValues description.
 *
 * @version 1.0
 * @author OddDahm
 */
class CommonValues
{
    function GenUploadDir(){
        return wp_upload_dir()["basedir"];
    }
    
    function ownDir( )
    {
    	return $this->GenUploadDir().'/Gets';
    }
    
    
    function PathAndName($fileName){
        return $this->ownDir( )."/".$fileName.".gts";
    }
}
?>