<?php

/**
 * userccodeToId short summary.
 *
 * userccodeToId description.
 * Class to covert userclass to useridentity if present and sql clip for autorize access
 * @version 1.0
 * @author Odd Dahm Sælen
 */
class usercodeToId
{
    public $is_ok=false;
    public $userid= 0;
    public $meddicSqlPart="a";


    function __construct($usercode)
    {
        if(isset($usercode)){
            $this->set_User($usercode);
            return;
        }
            
        if(isset($_SESSION['wmcOds_User_Id_qzlp'])) {
            $userFromSession = $_SESSION['wmcOds_User_Id_qzlp'];
        } else {
            $userFromSession = 0;
        }
        
        global $current_user;
        get_currentuserinfo();
        $currentUserId= $current_user->ID;
        
        if ($userFromSession != 0 ){
            $this->userid=$userFromSession;
            $this->meddicSqlPart= "viewableMedic = 1 AND ";
        }
            
        else 
        {
            $this->userid=$currentUserId;
            $this->meddicSqlPart= " ";
        }
    }
    
    public function Active_emergency_session() 
    {
        if(isset($_SESSION['wmcOds_User_Id_qzlp']))
            return ($_SESSION['wmcOds_User_Id_qzlp'] !=0);
        
        return false;
    }
    
    function set_User($usercode)
    {
        $_SESSION['wmcOds_User_Id_qzlp']= $this->ods_GetUseridUsingCode($usercode); //n987654321
    }
    
    public function clear_User()
    {
        $_SESSION['wmcOds_User_Id_qzlp']= 0;
    }
    
    public function ods_GetUseridUsingCode($ods_emergency_code){
        global $wpdb;
        if (strlen($ods_emergency_code) != 10)
        { return null;}
        
        $q = $wpdb->prepare( "SELECT wp_user_id FROM mm_user_data  WHERE emergency_password='%s'", $ods_emergency_code);
        $row = $wpdb->get_row($q);
        if ($row == null){
            $this->is_ok = false;
            return null;
        } else {
            $this->is_ok = true;
            return $row->wp_user_id;
        }
    }
}



?>