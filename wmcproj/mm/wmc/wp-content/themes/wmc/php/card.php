<?php
    function card_view() {
        global $current_user_id, $localeShort, $wpdb;

        $PDFGenerator = new PDFGenerator( $current_user_id, $wpdb );
//        $PDFGenerator->getBarCodeURL() // ===> bilde

        $userData = $PDFGenerator->getUserDataForUserId($current_user_id);

        // prefixed table name
        $table = $localeShort . '_users';

        // retrieve user data
        $user = $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ID = ' . $current_user_id, OBJECT);
        $insurance = $wpdb->get_row('SELECT * FROM wmc_insurance WHERE user_id = '  . $current_user_id, OBJECT);

        $params = array(
            "insurancecompany" => $insurance->ins_company,
            "policyno" => $insurance->ins_policy,
            "emergencynumber" => $insurance->ins_phone,
            "firstname" => mm_member_data(array("name"=>"firstName")),
            "lastname" => mm_member_data(array("name"=>"lastName")),
            "nationalid" => mm_member_data(array("name"=>"customField_2")),
            "birthdate" => mm_member_data(array("name"=>"customField_1")),
            "organdonation" => "Info inside",
            // "issued" => mm_member_data(array("name"=>"registrationDate", "dateFormat"=>"d.m.Y"))
            "issued" =>  $userData->pdfOrderDate

        );

        echo '<object id="svgCard" type="image/svg+xml" data="/images/card_template_standardMyPage.svg?' . http_build_query($params, '', '&amp;', PHP_QUERY_RFC3986) . '"></object>';

        // TODO: REMOVE DEBUG OUTPUT
        echo "<pre>";
        print_r($userData);
        echo "</pre>";

        $medicationsString = $userData->getMedicationsString();
        $diagnosesString = $userData->getDiagnosesString();
        $allergiesString = $userData->getAllergiesString();

//        $allergies = array();
//        $shortMode = sizeof($userData->allergies) > 8 ? TRUE : FALSE;
//        foreach ($userData->allergies AS $allergy) {
//            $allergies[] = $allergy->text;
//        }
//        $allergiesString = implode(", ", $allergies);

        $nextOfKins = array();
        foreach (array_slice($userData->nextOfKins, 0, 3) AS $nextOfKin) {
            $nextOfKins[] = "<strong>Emergency contact:</strong> " . $nextOfKin->getTextForCard();
        }
        $nextOfKinsString = implode("<br />", $nextOfKins);


        echo '<div class="card-inside clearfix">'
                . '<div class="column left">'
                    . '<div>'
                        . '<strong>Diagnoses (based on ICD-10):</strong> ' . (isset($diagnosesString) ? $diagnosesString : "No medications")
                    . '</div>'
                    . '<div>'
                        . '<strong>Medications (based on ATC):</strong> ' . (isset($medicationsString) ? $medicationsString : "No medications")
                    . '</div>'
                    . '<div>'
                        . '<strong>Allergies:</strong> ' . $allergiesString
                    . '</div>'
                . '</div>'
                . '<div class="column right">'
                    . '<div class="clearfix">'
                        . '<img src="' . $PDFGenerator->getBarCodeURL() . '">'
                        . '<strong>For further information please use my emergency login:</strong><br />'
                        . 'http://wmc-card.no/emergency<br />'
                        . '<strong>Password:</strong> ' . $userData->emergencyPassword
                    . '</div>'
                    . '<div>' . $nextOfKinsString . '</div>'
                    . '<div>'
                        . '<strong>Organ donation:</strong> ' . $userData->agreesToOrganDonation
//                        . '<strong>Organ donation:</strong> ' . mm_member_data(array("name"=>"customField_5"))
                    . '</div>'
                    . '<div>'
                        . '<strong>Other information:</strong> ' . $userData->otherInformation
                    . '</div>'
                . '</div>'
            . '</div>';

    } // card_view function end
    add_shortcode('card', 'card_view');

    function card_order_button_view() {

        global $localeShort, $wpdb, $current_user_id;

        // prefixed table name
        $table = $localeShort . '_users';

        // retrieve user data
        $user = $wpdb->get_row('SELECT * FROM ' . $table . ' WHERE ID = ' . $current_user_id, OBJECT);

        // has the user completed the process of registering?

        // TODO: add some logic for determining whether or not the user can order a new card 
        // (ie. (s)he has made changes to the card)
        if ($user->registration_progress == 100) {
            return '<button id="orderCardBtn" class="avia-button avia-icon_select-no avia-color-theme-color primary" type="button">' . __loc("orderCard") . '</button>'
                . '<div style="display: none" id="wmc-card-is-sent-content">' . get_page_content(array("slug" => "card-is-sent")) . '</div>'
                ;
        } else {
            return '';
        }
    }
    add_shortcode('card_order_button', 'card_order_button_view');

?>