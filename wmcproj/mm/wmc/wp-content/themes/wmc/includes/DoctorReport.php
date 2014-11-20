<?php
/**
 * Created by PhpStorm.
 * User: OddDahm
 * Date: 12.08.14
 * Time: 21:46
 */ 
function wmcods_DoctorReportView($atts)
{
    global $wpdb;   
    global $current_language;
// Henter pålogget brukeridentitet
 



$u= new usercodeToId();
$userid=$u->userid;

$ro="";   // reportoutput
// Lag connection
// http://localhost:8080/phpmyadmin/
// $con=mysqli_connect("localhost:8080","odd","Odd1419","wmc");

// Check connection
//if (mysqli_connect_errno()) {
//    $ro= "Failed to connect to MySQL: " . mysqli_connect_error();
//   return $ro;
// }

$userlanguage_id= $current_language;


// Formulate Query
// This is the best way to perform an SQL query
// For more examples, see mysql_real_escape_string()
$query_user = sprintf(
    "SELECT
mm_user_data.wp_user_id,
mm_user_data.first_name,
mm_user_data.last_name,
mm_user_data.phone,
mm_user_data.shipping_address1,
mm_user_data.shipping_address2,
mm_user_data.shipping_city,
mm_user_data.shipping_state,
mm_user_data.shipping_province,
mm_user_data.shipping_postal_code,
mm_user_data.shipping_country
FROM
mm_user_data
    WHERE mm_user_data.wp_user_id='%d'",

mysql_real_escape_string($userid));

// gjør Query
$result_user = $wpdb->get_results( $query_user, OBJECT);

// Sjekk resultat
// Viser query sent til MySQL, og feilen.  for debugging.
if ($result_user = null) {
    $ro= "No rows found, nothing to print. Exiting";
    return $ro;
    }
$ro= "<b><center>Database Output</center></b><br><br>";

// Bruk result
foreach($result_user as $result_item){
    $ro.= $result_item->first_name;
    $ro.= $result_item->last_name;
    $ro.= $result_item->billing_address1."<br>";

        // find land-navnet
    $query_country=sprintf(
        "SELECT country_iso2,country_name from wmc_country where country_iso2= '%s'",
        $result_item['shipping_country'] );

    $result_country= $wpdb->get_row( $query_country,OBJECT);

    if ($result_country != null) {

        $ro.=  $result_country->country_name;
        }
    else {

        $ro.= "country_name not available";
        }



     // find diagnoser
     $query_diagnoser=
         sprintf(
        "SELECT
            md.wmc_member_id,
            md.wmc_member_id,
            d.id,
            d.text,
            d.active,
            d.icd10_code,
            dt.text,
            dt.everyday_text,
            dt.language_id,
            md.wmc_diagnose_id
        FROM
            wmc_member_diagnosis AS md
            Inner Join wmc_diagnosis AS d ON md.wmc_diagnose_id = d.id AND d.active = 1 AND md.wmc_member_id = '%d'
            Inner Join wmc_diagnosis_translation AS dt ON d.id = dt.diagnosis_id AND
                    (dt.language_id = 0 OR dt.language_id = '%d')
        GROUP BY
            d.id
        ORDER BY
            dt.language_id DESC",
            $userid, $userlanguage_id );
    }


    $ro.= "<b><center>Diagnoser</center></b><br><br>";

    $result_diagnoser= $wpdb->get_results($query_diagnoser,OBJECT);


    if ($result_diagnoser == null) {
        $ro.= "Ingen diagnoser";

    }
    $linewritten=false;   // orginalspråk
    foreach($result_diagnoser as $row_diag)
    {
        if ($row_diag->language_id=$userlanguage_id || !$linewritten){
            $ro.= "$row_diag->icd10_code] \t $row_diag->text \t $row_diag->everyday_text <br>"  ;
            $linewritten = true;
        }else
        {
            $linewritten= false;}

    }

    //------------- Medication  start
    $query_Medication=
        sprintf(
            "SELECT
mm.wmc_medication_product,
ma.id,
ma.atc_code,
mm.wmc_member_id,
ma.text,
ma.active,
ma.`show`,
mt.text,
mt.active_ingredient,
mt.atc_id,
mt.language_id
FROM
wmc_member_medication_product AS mm
Inner Join wmc_medication_atc AS ma ON mm.wmc_member_id = '%d' AND mm.wmc_medication_product = ma.id AND mt.`show` = 1
 AND ma.active = 1
Inner Join wmc_medication_atc_translation AS mt ON ma.id = mt.atc_id AND (mt.language_id = 0
OR mt.language_id = '%d')
GROUP BY
ma.id
ORDER BY
mt.language_id DESC",
            $userid, $userlanguage_id );



            $ro.= "<b><center>Medication</center></b><br><br>";

            $result_Medication= $wpdb->get_results( $query_Medication, OBJECT);

            if ($result_Medication==null){
                $ro.= "Ingen Medication";

            }
            foreach($result_Medication as $row_Medication){
                $linewritten=false;   // orginalspråk
                if ($row_Medication->language_id = $userlanguage_id || !$linewritten){
                    $ro.= "$row_Medication->atc_code \t $row_Medication->text \t $row_Medication->active_ingredient <br>";
                    $linewritten= true;
                }else
                {
                    $linewritten= false;}
            }

            mysql_free_result($result_Medication);
    //------------- Medication  stopp

    // ------------ Alergy start
$query_Alergy=
    sprintf(
        "SELECT
ma.wmc_member_id,
a.id,
a.wmc_allergy_code,
a.wmc_allergy_text,
at.allergy_id,
a.active,
a.`show`,
at.everyday_text,
at.text,
ma.id,
ma.wmc_allergy_id,
at.language_id
FROM
wmc_member_allergy AS ma
Inner Join wmc_allergy AS a ON ma.wmc_allergy_id = a.id AND ma.wmc_member_id = '%d'
Inner Join wmc_allergy_translation AS at ON a.id = at.allergy_id AND (at.language_id = '%d' OR at.language_id = 0)
GROUP BY
ma.wmc_allergy_id
ORDER BY
at.language_id DESC",$userid, $userlanguage_id );



$ro.= "<b><center>Alergy</center></b><br><br>";

$result_Alergyn= $wpdb->get_results( $query_Alergy, OBJECT);


if ($result_Alergy == null) {
    $ro.= "Ingen Alergy <br>";

}
foreach($result_Alergy as $row_Alergy){
    $linewritten=false;   // orginalspråk
    if ($row_Alergy->language_id=$userlanguage_id || !$linewritten){
        $ro.= "$row_Alergy->wmc_allergy_code \t $row_Medication->text \t $row_Medication->everyday_text <br>"  ;
        $linewritten= true;
    }else
    {
        $linewritten= false;}
}



    // ------------ Alergy stopp
return $ro;  

}
 
add_shortcode('wmcods_DoctorReport', 'wmcods_DoctorReportView');

?>
