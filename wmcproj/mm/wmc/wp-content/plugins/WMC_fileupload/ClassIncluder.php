<?php
function FiluploadClassDir(){
    return $_SERVER["DOCUMENT_ROOT"] . "/mm/wmc/wp-content/plugins/WMC_fileupload/Classes/";
}

spl_autoload_register(function($classname) {

    $filename = FiluploadClassDir(). $classname .".php";
    include_once($filename);
});


?>