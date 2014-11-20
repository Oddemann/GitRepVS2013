<?php
/*
Plugin Name: WMC file uploader
Plugin URI: http://wmc.no
Description: Uploads files for a user into a designated table in the WP database. Lists and shows the files
Author: Odd Dahm Sælen
Version: 0.1-alpha
Author URI: http://wmc.no


*/

include_once "ClassIncluder.php";

require_once 'lib/kendo/wrappers/php/lib/Kendo/Autoload.php'; 


add_action('admin_menu', 'odswmc_fileUploader_actions' );
function odswmc_fileUploader_actions(){
    
    add_options_page('WMC File Uploader', 'WMC File Uploader', 'manage_option', __FILE__ , 'odswmc_fileUploader_admin');  
}


    // To start end end sessionvariables for a wordpress user
add_action('init', 'aStartSession', 1);
add_action('wp_logout', 'anEndSession');
add_action('wp_login', 'anEndSession');

function AStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function anEndSession() {
    session_destroy ();
}

add_action("admin_enqueue_scripts", 'odswmc_fileUploader_enqscr_func');  
add_action('wp_enqueue_scripts', 'odswmc_fileUploader_enqscr_func');   
function odswmc_fileUploader_enqscr_func()
{
     

    // $directoryKendolib= plugins_url()."/WMC_fileupload/lib/kendo/";
    $directoryKendolib= plugins_url()."/WMC_fileupload/lib/kendo/";
    //$fil= "js/jquery.min.js";
    //wp_enqueue_script($fil, $directoryKendolib.$fil);
    $kendoHandle='kendo';
    $fil= "js/kendo.all.min.js";
    wp_enqueue_script($kendoHandle, $directoryKendolib.$fil,array( 'jquery' ));
    
   
    $fil= "styles/kendo.common.min.css";    
    wp_enqueue_style($fil, $directoryKendolib.$fil);
    
    $fil= "styles/kendo.default.min.css";
    wp_enqueue_style($fil, $directoryKendolib.$fil);
    
    $fil= "styles/kendo.rtl.min.css";
    wp_enqueue_style($fil, $directoryKendolib.$fil);
    
    $fil= "styles/kendo.default.min.css";
    wp_enqueue_style($fil, $directoryKendolib.$fil);
    
    $directory= plugins_url()."/WMC_fileupload/";   
    $fil= "WMC_fileupload.js";
    wp_enqueue_script($fil, $directory.$fil,array( 'jquery', $kendoHandle )); 
 }


function odswmc_fileUploader_admin()
{   
    echo wmcods_ShowUploadedFiles_func();
}



/* dette er flyttet til wmc tema (PersonelAccess.php) siden den er knyttet til data spesifikt for WMC  
add_shortcode('wmcods_ShowUserCodeFiles', 'wmcods_ShowUserCodeFiles_func');
function wmcods_ShowUserCodeFiles_func( )
{
	
}
*/


add_shortcode('wmcods_ShowUploadedFiles', 'wmcods_ShowUploadedFiles_func');  
function wmcods_ShowUploadedFiles_func( ){
     
    $u= new usercodeToId();
    $userId  = $u->clear_User();

    $outp= wmcods_ShowUserCodeFiles_forAuser();    
    
    return $outp;       
}

add_shortcode('wmcods_ShowUserCodeFiles', 'wmcods_ShowUserCodeFiles_globalId');  

        // denne funksjonen refereres to steder: i kode og i add_shortcode
function wmcods_ShowUserCodeFiles_globalId() 
{
    // global $wmcods_userid;
    $u= new usercodeToId();
    if ($u->Active_emergency_session()){
       return wmcods_ShowUserCodeFiles_forAuser();
    }
    else
    {
       return "<br>-----------<br>";
    }
}

function wmcods_ShowUserCodeFiles_forAuser()    
{          

    $dennePluginUrl= plugins_url()."/WMC_fileupload/";
    $outp ='<script> var dennePluginUrl="'. addslashes($dennePluginUrl).'"; </script>';
    $transport = new \Kendo\Data\DataSourceTransport();
    
    // Configure the remote service - a PHP file called 'UploadedData.php'
    // The query string parameter 'type' specifies the type of CRUD operation

    $DataAccessUrl= $dennePluginUrl."UploadedData.php";

    $read = new \Kendo\Data\DataSourceTransportRead();

    $read->url($DataAccessUrl.'?type=read')
         ->contentType('application/json')
         ->type('POST')
         ->data( array('qwerty'));

    // Configure the transport. Send all data source parameters as JSON using the parameterMap setting
    $transport->read($read)
              ->parameterMap('function(data) {
              return kendo.stringify(data);
          }');

    // Configure the model
    $model = new \Kendo\Data\DataSourceSchemaModel();


    $idField = new \Kendo\Data\DataSourceSchemaModelField('id');
    $idField->type('number')->editable(false);

    $filenameField = new \Kendo\Data\DataSourceSchemaModelField('filename');
    $filenameField->type('string')->editable(false);

    $filetypeField = new \Kendo\Data\DataSourceSchemaModelField('filetype');
    $filetypeField->type('string')->editable(false);
    
    $categoryField = new \Kendo\Data\DataSourceSchemaModelField('catname');
    $categoryField->type('string')->editable(false);

    $viewableMedicField = new \Kendo\Data\DataSourceSchemaModelField('viewableMedic');
    $viewableMedicField->type('boolean');

           
   $commentField = new \Kendo\Data\DataSourceSchemaModelField('comment');
   $commentField->type('string')->nullable(true);

    $model->id('id')
          ->addField($idField)
          ->addField($filenameField)
          ->addField($filetypeField)
          ->addField($categoryField)
          ->addField($viewableMedicField)
          ->addField($commentField);

    $schema = new \Kendo\Data\DataSourceSchema();

    $schema->model($model);

    $dataSource = new \Kendo\Data\DataSource();

    // Configure data source - set transport, schema and enable batch mode
    $dataSource->transport($transport)
               ->schema($schema);

    // lag grid
    $gridId="DocList";
    $grid = new \Kendo\UI\Grid($gridId);

    $fileName = new \Kendo\UI\GridColumn();
    $fileName->field('filename')
              ->title('File Name')
              ->width(250);
    $filetype = new \Kendo\UI\GridColumn();
    $filetype->field('filetype')
              ->title('Filtype')
    //          ->format('{0:c}')
              ->width(50);

    $category = new \Kendo\UI\GridColumn();  // todo: dropdown
    $category->field('catname')
              ->width(100)
              ->title('Category')
              ->editor("dropDownEditor");

    $viewableMedic = new \Kendo\UI\GridColumn();
    $viewableMedic->field('viewableMedic')
                  ->title('For Med. Pers.')
                  ->width(50);  

    $comment = new \Kendo\UI\GridColumn();
    $comment->field('comment')
            ->title('comment')
            ->width(75);

    $commanditem = new \Kendo\UI\GridColumnCommandItem();
    $commanditem->className('OpenFile')
                ->click('onViewfileClick')
                ->text('Opne');  // kan ikke innholde Å (i hvert fall)



    $command = new \Kendo\UI\GridColumn();
    $command->addCommandItem($commanditem)
            ->title('&nbsp;')
            ->width(50); 
                                             // Ta vekk kommentering viss Kommentarfeltet skal vises
    $grid->addColumn($fileName, $filetype, $category, $viewableMedic, /*$comment,*/ $command )//
         ->dataSource($dataSource)         
         ->editable(true)
         ->selectable(true)
         ->height(400);

    
    $outp .= $grid->render();
    
    return $outp;
}



    // lag shortcode
add_shortcode( 'wmcods_PickAndSubmitFiles', 'wmcods_PickAndSubmitFiles_func' );
function wmcods_PickAndSubmitFiles_func( $atts , $content = null )
{
    
    //require_once $_SERVER["DOCUMENT_ROOT"] . "\\mm\\wmc\\wp-content\\plugins\\Classes\\usercodeToId.php";
    $u= new usercodeToId();
    $userId  = $u->userid;
 

    $outp ='<div class="k-content">
<div class="configuration k-widget k-header" style="width: 300px">
    <span class="infoHead">Information</span>
    <p>
        Velg filer for opplasting
    </p>
    <p>
        Etterpå kan du angi kategori og om autorisert helsepersonell skal kunne få se på dem
    </p>
</div>

</div>';
    
    $reqUrl= plugins_url()."/WMC_fileupload/respons.php";
        //"http".(!empty($_SERVER['HTTPS'])?"s":""). "://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
    $upload = new \Kendo\UI\Upload('files[]');
    $upload->async(array(
            'saveUrl' => $reqUrl.'?type=save&cat=1&medic=1&userid='.$userId,            
            'removeUrl' => $reqUrl.'?type=remove',
            'autoUpload' => false,
            'removeField' => 'fileNames[]'
            
           ))
           ->success('onSuccess');     // se helt i WMC_fileupload.js for 'onSuccess'
    
    $outp .=  $upload->render();
    
    $outp .=
'<p>
  Editer verdier til opplastede filer
</p>';


$transport = new \Kendo\Data\DataSourceTransport();

    // Configure the remote service - a PHP file called 'UploadedData.php'
// The query string parameter 'type' specifies the type of CRUD operation

$DataAccessUrl= plugins_url()."/WMC_fileupload/UploadedData.php";
$create = new \Kendo\Data\DataSourceTransportCreate();

$create->url($DataAccessUrl.'?type=create')
       ->contentType('application/json')
       ->type('POST');

$read = new \Kendo\Data\DataSourceTransportRead();

$read->url($DataAccessUrl.'?type=read')
     ->contentType('application/json')
     ->type('POST')
     ->data( array('qwerty'));

$update = new \Kendo\Data\DataSourceTransportUpdate();

$update->url($DataAccessUrl.'?type=update')
       ->contentType('application/json')
       ->type('POST');

$destroy = new \Kendo\Data\DataSourceTransportDestroy();

$destroy->url($DataAccessUrl.'?type=destroy')
        ->contentType('application/json')
        ->type('POST');

// Configure the transport. Send all data source parameters as JSON using the parameterMap setting
$transport->create($create)
          ->read($read)
          ->update($update)
          ->destroy($destroy)
          ->parameterMap('function(data) {
              return kendo.stringify(data);
          }');

// Configure the model
$model = new \Kendo\Data\DataSourceSchemaModel();


//               ->editable(false)
//               ->nullable(true);->min(1);->validation(array('required' => true))

$idField = new \Kendo\Data\DataSourceSchemaModelField('id');
$idField->type('number')->editable(false);


$filenameField = new \Kendo\Data\DataSourceSchemaModelField('filename');
$filenameField->type('string')->editable(false);

$filetypeField = new \Kendo\Data\DataSourceSchemaModelField('filetype');
$filetypeField->type('string')->editable(false);
                    
$categoryField = new \Kendo\Data\DataSourceSchemaModelField('catname');
$categoryField->type('string');

$viewableMedicField = new \Kendo\Data\DataSourceSchemaModelField('viewableMedic');
$viewableMedicField->type('boolean');

$commentField = new \Kendo\Data\DataSourceSchemaModelField('comment');
$commentField->type('string')->nullable(true);

$model->id('id')
      ->addField($idField)
      ->addField($filenameField)
      ->addField($filetypeField)
      ->addField($categoryField)
      ->addField($viewableMedicField)
      ->addField($commentField);

$schema = new \Kendo\Data\DataSourceSchema();

$schema->model($model);

$dataSource = new \Kendo\Data\DataSource();

// Configure data source - set transport, schema and enable batch mode
$dataSource->transport($transport)
           ->batch(true)
           ->schema($schema);

        // lag grid
$gridId="FileValList";
$grid = new \Kendo\UI\Grid($gridId);

$fileName = new \Kendo\UI\GridColumn();
$fileName->field('filename')
          ->title('File Name')
          ->width(250);
$filetype = new \Kendo\UI\GridColumn();
$filetype->field('filetype')
          ->title('Filtype')
//          ->format('{0:c}')
          ->width(50);

$category = new \Kendo\UI\GridColumn();  // todo: dropdown
$category->field('catname')
          ->width(100)
          ->title('Category')
          ->editor("dropDownEditor");

$viewableMedic = new \Kendo\UI\GridColumn();
$viewableMedic->field('viewableMedic')
              ->title('For Med. Pers.')
              ->width(50);  

$comment = new \Kendo\UI\GridColumn();
$comment->field('comment')
        ->title('comment')
        ->width(75);

$command = new \Kendo\UI\GridColumn();
$command->addCommandItem('destroy')
        ->title('&nbsp;')
        ->width(100);
                                  // Ta vekk kommentering viss Kommentarfeltet skal vises
$grid->addColumn($fileName, $filetype, $category, $viewableMedic, /*$comment,*/ $command )
     ->dataSource($dataSource)
     ->addToolbarItem(
        new \Kendo\UI\GridToolbarItem('save'), new \Kendo\UI\GridToolbarItem('cancel'))
     ->editable(true)
     ->height(400);

// linjeskiftet i tegnstrengen under gir en penere generert kode. Da bli browseren glad :)

$outp .= $grid->render();




$outp .= $dd; 
        // Code
return $outp;
}