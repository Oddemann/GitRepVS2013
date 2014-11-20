(function($) {    // lagt til av ods
/***********************************************************************************************************************
 Global functions
 **********************************************************************************************************************/
//function createCookie( name, value, days ) {
//    if ( days ) {
//        var date = new Date();
//        date.setTime( date.getTime() + (days * 24 * 60 * 60 * 1000) );
//        var expires = "; expires=" + date.toGMTString();
//    }
//    else {
//        var expires = "";
//    }
//    document.cookie = name + "=" + value + expires + "; path=/";
//}
//
//function readCookie( name ) {
//    var nameEQ = name + "=";
//    var ca = document.cookie.split( ';' );
//    for ( var i = 0; i < ca.length; i++ ) {
//        var c = ca[i];
//        while ( c.charAt( 0 ) == ' ' ) {
//            c = c.substring( 1, c.length );
//        }
//        if ( c.indexOf( nameEQ ) == 0 ) {
//            return c.substring( nameEQ.length, c.length );
//        }
//    }
//    return null;
//}
//
//function eraseCookie( name ) {
//    createCookie( name, "", -1 );
//}


// ods start ================


// ods stopp ================

function getCSSicon( character ) {
    return '<span class="avia-font-entypo-fontello" data-update_class_with="font"><span data-update_with="icon_fakeArg" class="avia_tab_icon big">' + character + '</span></span>';
}

function getSelectCountryCodes(name) {
   
    
    return '<select name="' + name + '"><option value="0">' +
        __locale.chooseCountryCode + // ods temporært
        //+"47"+    // ods temporært
        '</option><option value="1">1 (Canada)</option><option value="1">1 (United States)</option><option value="1-242">1-242 (Bahamas)</option><option value="1-246">1-246 (Barbados)</option><option value="1-264">1-264 (Anguilla)</option><option value="1-268">1-268 (Antigua and Barbuda)</option><option value="1-284">1-284 (Virgin Islands (British))</option><option value="1-340">1-340 (Virgin Islands (U.S.))</option><option value="1-345">1-345 (Cayman Islands)</option><option value="1-441">1-441 (Bermuda)</option><option value="1-473">1-473 (Grenada)</option><option value="1-649">1-649 (Turks and Caicos Islands)</option><option value="1-664">1-664 (Montserrat)</option><option value="1-670">1-670 (Northern Mariana Islands)</option><option value="1-671">1-671 (Guam)</option><option value="1-684">1-684 (American Samoa)</option><option value="1-758">1-758 (Saint Lucia)</option><option value="1-767">1-767 (Dominica)</option><option value="1-784">1-784 (Saint Vincent and The Grenadines)</option><option value="1-787">1-787 (Puerto Rico)</option><option value="1-809">1-809 (Dominican Republic)</option><option value="1-868">1-868 (Trinidad and Tobago)</option><option value="1-869">1-869 (Saint Kitts and Nevis)</option><option value="1-876">1-876 (Jamaica)</option><option value="20">20 (Egypt)</option><option value="212">212 (Morocco)</option><option value="213">213 (Algeria)</option><option value="216">216 (Tunisia)</option><option value="218">218 (Libyan Arab Jamahiriya)</option><option value="220">220 (Gambia)</option><option value="221">221 (Senegal)</option><option value="222">222 (Mauritania)</option><option value="223">223 (Mali)</option><option value="224">224 (Guinea)</option><option value="225">225 (Cote D\'ivoire)</option><option value="226">226 (Burkina Faso)</option><option value="227">227 (Niger)</option><option value="228">228 (Togo)</option><option value="229">229 (Benin)</option><option value="230">230 (Mauritius)</option><option value="231">231 (Liberia)</option><option value="232">232 (Sierra Leone)</option><option value="233">233 (Ghana)</option><option value="234">234 (Nigeria)</option><option value="235">235 (Chad)</option><option value="236">236 (Central African Republic)</option><option value="237">237 (Cameroon)</option><option value="238">238 (Cape Verde)</option><option value="239">239 (Sao Tome and Principe)</option><option value="240">240 (Equatorial Guinea)</option><option value="241">241 (Gabon)</option><option value="242">242 (Congo)</option><option value="244">244 (Angola)</option><option value="245">245 (Guinea-Bissau)</option><option value="246">246 (British Indian Ocean Territory)</option><option value="248">248 (Seychelles)</option><option value="249">249 (Sudan)</option><option value="250">250 (Rwanda)</option><option value="251">251 (Ethiopia)</option><option value="252">252 (Somalia)</option><option value="253">253 (Djibouti)</option><option value="254">254 (Kenya)</option><option value="255">255 (Tanzania - United Republic of)</option><option value="256">256 (Uganda)</option><option value="257">257 (Burundi)</option><option value="258">258 (Mozambique)</option><option value="260">260 (Zambia)</option><option value="261">261 (Madagascar)</option><option value="262">262 (Reunion)</option><option value="263">263 (Zimbabwe)</option><option value="264">264 (Namibia)</option><option value="265">265 (Malawi)</option><option value="266">266 (Lesotho)</option><option value="267">267 (Botswana)</option><option value="268">268 (Swaziland)</option><option value="269">269 (Comoros)</option><option value="27">27 (South Africa)</option><option value="290">290 (St. Helena)</option><option value="291">291 (Eritrea)</option><option value="297">297 (Aruba)</option><option value="298">298 (Faroe Islands)</option><option value="299">299 (Greenland)</option><option value="30">30 (Greece)</option><option value="31">31 (Netherlands)</option><option value="32">32 (Belgium)</option><option value="33">33 (France)</option><option value="34">34 (Spain)</option><option value="350">350 (Gibraltar)</option><option value="351">351 (Portugal)</option><option value="352">352 (Luxembourg)</option><option value="353">353 (Ireland)</option><option value="354">354 (Iceland)</option><option value="355">355 (Albania)</option><option value="356">356 (Malta)</option><option value="357">357 (Cyprus)</option><option value="358">358 (Finland)</option><option value="359">359 (Bulgaria)</option><option value="36">36 (Hungary)</option><option value="370">370 (Lithuania)</option><option value="371">371 (Latvia)</option><option value="372">372 (Estonia)</option><option value="373">373 (Moldova - Republic of)</option><option value="374">374 (Armenia)</option><option value="375">375 (Belarus)</option><option value="376">376 (Andorra)</option><option value="377">377 (Monaco)</option><option value="378">378 (San Marino)</option><option value="379">379 (Vatican City State (Holy See))</option><option value="380">380 (Ukraine)</option><option value="385">385 (Croatia (Local Name: Hrvatska))</option><option value="386">386 (Slovenia)</option><option value="387">387 (Bosnia and Herzegowina)</option><option value="389">389 (Macedonia - The Former Yugoslav Republic of)</option><option value="39">39 (Italy)</option><option value="40">40 (Romania)</option><option value="41">41 (Switzerland)</option><option value="420">420 (Czech Republic)</option><option value="421">421 (Slovakia (Slovak Republic))</option><option value="423">423 (Liechtenstein)</option><option value="43">43 (Austria)</option><option value="44">44 (United Kingdom)</option><option value="45">45 (Denmark)</option><option value="46">46 (Sweden)</option><option value="47">47 (Norway)</option><option value="48">48 (Poland)</option><option value="49">49 (Germany)</option><option value="500">500 (Falkland Islands (Malvinas))</option><option value="501">501 (Belize)</option><option value="502">502 (Guatemala)</option><option value="503">503 (El Salvador)</option><option value="504">504 (Honduras)</option><option value="505">505 (Nicaragua)</option><option value="506">506 (Costa Rica)</option><option value="507">507 (Panama)</option><option value="508">508 (St. Pierre and Miquelon)</option><option value="509">509 (Haiti)</option><option value="51">51 (Peru)</option><option value="52">52 (Mexico)</option><option value="53">53 (Cuba)</option><option value="54">54 (Argentina)</option><option value="55">55 (Brazil)</option><option value="56">56 (Chile)</option><option value="57">57 (Colombia)</option><option value="58">58 (Venezuela)</option><option value="590">590 (Guadeloupe)</option><option value="591">591 (Bolivia)</option><option value="592">592 (Guyana)</option><option value="593">593 (Ecuador)</option><option value="594">594 (French Guiana)</option><option value="595">595 (Paraguay)</option><option value="596">596 (Martinique)</option><option value="597">597 (Suriname)</option><option value="598">598 (Uruguay)</option><option value="599">599 (Netherlands Antilles)</option><option value="60">60 (Malaysia)</option><option value="61">61 (Australia)</option><option value="62">62 (Indonesia)</option><option value="63">63 (Philippines)</option><option value="64">64 (New Zealand)</option><option value="65">65 (Singapore)</option><option value="66">66 (Thailand)</option><option value="672">672 (Antarctica)</option><option value="673">673 (Brunei Darussalam)</option><option value="674">674 (Nauru)</option><option value="675">675 (Papua New Guinea)</option><option value="676">676 (Tonga)</option><option value="677">677 (Solomon Islands)</option><option value="678">678 (Vanuatu)</option><option value="679">679 (Fiji)</option><option value="680">680 (Palau)</option><option value="681">681 (Wallis and Futuna Islands)</option><option value="682">682 (Cook Islands)</option><option value="683">683 (Niue)</option><option value="685">685 (Samoa)</option><option value="686">686 (Kiribati)</option><option value="687">687 (New Caledonia)</option><option value="688">688 (Tuvalu)</option><option value="689">689 (French Polynesia)</option><option value="690">690 (Tokelau)</option><option value="691">691 (Micronesia - Federated States of)</option><option value="692">692 (Marshall Islands)</option><option value="7">7 (Kazakhstan)</option><option value="7">7 (Russian Federation)</option><option value="81">81 (Japan)</option><option value="82">82 (Korea - Republic of)</option><option value="84">84 (Viet Nam)</option><option value="850">850 (Korea - Democratic People\'s Republic of)</option><option value="852">852 (Hong Kong)</option><option value="853">853 (Macau)</option><option value="855">855 (Cambodia)</option><option value="856">856 (Lao People\'s Democratic Republic)</option><option value="86">86 (China)</option><option value="880">880 (Bangladesh)</option><option value="886">886 (Taiwan)</option><option value="90">90 (Turkey)</option><option value="91">91 (India)</option><option value="92">92 (Pakistan)</option><option value="93">93 (Afghanistan)</option><option value="94">94 (Sri Lanka)</option><option value="95">95 (Myanmar)</option><option value="960">960 (Maldives)</option><option value="961">961 (Lebanon)</option><option value="962">962 (Jordan)</option><option value="963">963 (Syrian Arab Republic)</option><option value="964">964 (Iraq)</option><option value="965">965 (Kuwait)</option><option value="966">966 (Saudi Arabia)</option><option value="967">967 (Yemen)</option><option value="968">968 (Oman)</option><option value="971">971 (United Arab Emirates)</option><option value="972">972 (Israel)</option><option value="973">973 (Bahrain)</option><option value="974">974 (Qatar)</option><option value="975">975 (Bhutan)</option><option value="976">976 (Mongolia)</option><option value="977">977 (Nepal)</option><option value="98">98 (Iran (Islamic Republic of))</option><option value="992">992 (Tajikistan)</option><option value="993">993 (Turkmenistan)</option><option value="994">994 (Azerbaijan)</option><option value="995">995 (Georgia)</option><option value="996">996 (Kyrgyzstan)</option><option value="998">998 (Uzbekistan)</option></select>';
}

function getIconButton( iconCharacter, title, cls, extra ) {
    var extra = extra || "";
    return '<button ' +
        extra + ' ' +
        'class="' + cls + ' avia-button avia-icon_select-no avia-color-theme-color secondary" ' +
        'title="' + title + '" ' +
        'type="button"' +
        '>' +
        '<span ' +
        'class="avia-font-entypo-fontello" data-update_class_with="font"' +
        '>' +
        '<span ' +
        'data-update_with="icon_fakeArg" ' +
        'class="avia_tab_icon big"' +
        '>' +
        iconCharacter +
        '</span>' +
        '</span>' +
        '</button>';
}

/**
 * Adds/removes an overlay to the page and displays a progressbar, indicating to the user that some asynchronous
 * event is taking place.
 * @param boolShow {Boolean} Whether or not to add/remove the overlay. If undefined it is treated as true.
 */
window.wmcOverlay = function ( boolShow ) {
    boolShow = boolShow === undefined ? true : boolShow;
    var $veil = $( "#wmc-veil" );
    if ( boolShow ) {
        if ( !$veil.length ) {
            $( "body" ).append( '<div id="wmc-veil"><div class="progress-bar"></div></div>' );
            $( "#wmc-veil .progress-bar" ).progressbar( {
                value: false
            } );
        }
    } else {
        $veil.remove();
    }
};

function wmcElementOverlay( boolShow, $el ) {
    boolShow = boolShow === undefined ? true : boolShow;
    $el.toggleClass( "wmc-veil-parent", boolShow );
    if ( !boolShow ) {
        $el.find( ".wmc-veil" ).remove();
        return;
    }
    var $veil = $( '<div class="wmc-veil"><div class="progress-bar"></div></div>' );
    $el.append( $veil );
    $veil.find( ".progress-bar" ).progressbar( {
        value: false
    } );
}

/***********************************************************************************************************************
 Personal information
 **********************************************************************************************************************/

/**
 * Viewmodel for the personal and shipping details sections. Prepares a new form by adding click functionality to form
 * (edit/cancel) and radio buttons, and performs ajax form submission. Note that the action URL should be defined in the
 * form's action attribute.
 * @param selector CSS selector to the form itself.
 * @param additionalPostData Any additional form data that should be included in the submission.
 */
function wmcPrepareForm( selector, additionalPostData ) {

    var $form = $( selector );
    var $meta = $form.find( ".meta" );

    function toggleEditMode() {
        $form.toggleClass( "edit-mode" );
        $meta.find( ".edit, .cancel, .submit" ).toggleClass( "active" );
    }

    // add some basic form button operations
    $meta.find( ".edit, .cancel" ).click( toggleEditMode );

    // prepare form radio elements
    $form.find( ".value.form.radio" ).each( function () {
        // the helper contains the current value, this will be the data base value at startup
        var $helper = $( this ).find( "input[type='hidden']" );
        var val = $helper.val();
        // check the radio element that coincides with the current value
        $( this ).find( "input[type='radio'][value='" + val + "']" ).prop( 'checked', true );
        // whenever a radio button is checked (ie. changed) we'll update the current value
        $( this ).find( "input[type='radio']" ).change( function () {
            $helper.val( $( this ).val() );
        } );
    } );

    $form.submit( function () {

        var url = $( this ).attr( "action" );
        var data = $( this ).serialize() + "&" + $.param( additionalPostData );

        wmcOverlay( true );

        $.ajax( {
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function ( data ) {
                alert( data.message );
                location.reload();
            }
        } );

        return false;

    } );
}

/***********************************************************************************************************************
 Next of kin
 **********************************************************************************************************************/

/**
 * Next of kin class. Creates a kind of view model that keeps track of the kin's data attributes and manages ajax calls
 * to the server - basic CRUD operations.
 * @param $element A DOM element with data-attributes, se this.data for specifics.
 * @constructor
 */

function NextOfKinRow( $element ) {

    // retrieve data
    this.data = {
        id: $element.data( "id" ),
        first_name: $element.data( "first_name" ),
        last_name: $element.data( "last_name" ),
        phone_prefix: $element.data( "phone_prefix" ),
        phone: $element.data( "phone" )
    };

    // clone the template markup
    var replaced = String( this.tplRow );

    $.each( this.data, function ( key, val ) {
        replaced = replaced.replace( '{{' + key + '}}', val );
        replaced = replaced.replace( '{{' + key + '}}', val );
    } );

    var $el = this.$el = $( replaced );

    var $btnEdit = $el.find( "button.edit" );
    var $btnCancel = $el.find( "button.cancel" );
    var $btnSave = $el.find( "button.save" );
    var $btnDelete = $el.find( "button.delete" );
    var $inpFirstName = $el.find( "input[name='first_name']" );
    var $inpLastName = $el.find( "input[name='last_name']" );
    var $inpPhonePrefix = $el.find( "select[name='phone_prefix']" );
    var $inpPhone = $el.find( "input[name='phone']" );
    var $inpId = $el.find( "input[name='id']" );

    $inpFirstName.keyup( checkCanSubmit );
    $inpLastName.keyup( checkCanSubmit );
    $inpPhone.keyup( checkCanSubmit );

    var canSubmit = false;

    function checkCanSubmit() {
        canSubmit = ($inpFirstName.val() && $inpLastName.val() && $inpPhone.val());
        $el.find( "button.save" ).prop( "disabled", !canSubmit );
    }

    $inpPhonePrefix.find( '[value="' + this.data.phone_prefix + '"]' ).attr( "selected", true );

    function toggleEditMode() {
        $el.each( function () {
            $( this ).toggleClass( "edit-mode" );
        } );
    }

    function focus() {
        $inpFirstName.focus();
    }

    function enable( bool ) {
        $el.filter( ".form" ).find( "input, select, button" ).prop( "disabled", !bool );
    }

    function onClickSave() {

        enable( false );

        var data = {
            action: 'update_next_of_kin',
            first_name: $inpFirstName.val(),
            last_name: $inpLastName.val(),
            phone_prefix: $inpPhonePrefix.val(),
            phone: $inpPhone.val()
        };

        if ( $inpId.val() !== "undefined" ) {
            data.nok_id = $inpId.val()
        } else {
            data.action = 'save_next_of_kin';
        }

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: data,
            success: function ( data ) {
                if ( data.nok_id ) {
                    $inpId.val( data.nok_id );
                }
                $el.filter( ".read" ).find( "td:nth-child(1)" ).html( [$inpFirstName.val(), $inpLastName.val()].join( " " ) );
                $el.filter( ".read" ).find( "td:nth-child(2)" ).html( ['+' + $inpPhonePrefix.val(), $inpPhone.val()].join( " " ) );
                toggleEditMode();
                enable( true );
            }
        } );
        return false;
    }

    function onClickDelete() {
        enable( false );
        if ( confirm( __locale.doYouWishToDeleteKin + ', ' + $inpFirstName.val() + ' ' + $inpLastName.val() + '?' ) ) {
            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    action: 'delete_next_of_kin',
                    nok_id: $inpId.val()
                },
                success: function ( data ) {
                    $el.remove();
                }
            } );
        }
        enable( true );
        return false;
    }

    function onClickCancel() {
        if ( $inpId.val() !== "undefined" ) {
            toggleEditMode();
        } else {
            $el.remove();
        }
        return false;
    }

    function onClickEdit() {
        toggleEditMode();
        focus();
    }

    $btnEdit.click( toggleEditMode );
    $btnCancel.click( onClickCancel );
    $btnSave.click( onClickSave );
    $btnDelete.click( onClickDelete );

    // make public
    this.toggleEditMode = toggleEditMode;
    this.focus = focus;
    this.onClickEdit = onClickEdit;

    checkCanSubmit();

}

NextOfKinRow.prototype.tplRow =
    '<tr class="form">' +
    '<td colspan="2">' +
    '<input type="text" name="first_name" value="{{first_name}}" placeholder="Fornavn">' +
    '<input type="text" name="last_name" value="{{last_name}}" placeholder="Etternavn">' +
    getSelectCountryCodes( 'phone_prefix' ) +
    '<input type="tel" name="phone" value="{{phone}}" placeholder="Telefon">' +
    '</td>' +
    '<td>' +
    '<button class="save avia-button avia-icon_select-no avia-color-theme-color primary" title="' + __locale.save + '" type="submit">' +
    getCSSicon( '' ) +
    '</button>' +
    '<button class="cancel avia-button avia-icon_select-no avia-color-theme-color secondary" title="' + __locale.cancel + '" type="button">' +
    getCSSicon( '' ) +
    '</button>' +
    '<input type="hidden" name="id" value="{{id}}">' +
    '</td>' +
    '</tr>' +
    '<tr class="read">' +
    '<td>' +
    '{{first_name}} {{last_name}}' +
    '</td>' +
    '<td>' +
    '+{{phone_prefix}} {{phone}}' +
    '</td>' +
    '<td>' +
    '<button class="edit avia-button avia-icon_select-no avia-color-theme-color secondary" title="' + __locale.edit + '" type="button">' +
    getCSSicon( '' ) +
    '</button>' +
    '<button class="delete avia-button avia-icon_select-no avia-color-theme-color secondary" title="' + __locale.delete + '" type="button">' +
    getCSSicon( '' ) +
    '</button>' +
    '</td>' +
    '</tr>'
;

/***********************************************************************************************************************
 On DOM ready function.
 **********************************************************************************************************************/
jQuery( function ( $ ) {

    $( ".next-of-kin-table tbody tr" ).each( function ( key, el ) {
        var $el = $( el );
        var row = new NextOfKinRow( $el );
        // we're only interested in real next of kin rows - ie. they must have a db id
        $el.replaceWith( row.$el );
    } );

    $( '#add-next-of-kin' ).click( function () {
        var $el = $( '<tr data-first_name="" data-last_name="" data-phone_prefix="" data-phone=""></tr>' );
        $( ".next-of-kin-table tbody" ).append( $el );
        var row = new NextOfKinRow( $el );
        $el.replaceWith( row.$el );
        row.onClickEdit();
        return false;
    } );

    /**
     *  Initialize the cookies directive script
     *  http://cookiesdirective.com/
     *
     *  Perhaps this plugin should be used instead?
     *  https://wordpress.org/plugins/eu-cookie-directive/
     */
    $.cookiesDirective( {
        explicitConsent: false,
        position: 'bottom',
        duration: 10, // display time in seconds
        limit: 0, // limit disclosure appearances, 0 is forever
        message: null, // use default (English) message
        privacyPolicyUri: '/sikkerhet/personvern/',
        fontColor: '#FFF',
//        fontSize: '13px',
        backgroundColor: '#000',
        backgroundOpacity: '90', // opacity of disclosure panel
        linkColor: '#CA0000' // link color in disclosure panel
    } );

    // wrapping the h3-tag in BottomBoxHeader fixes the underline (text has a blue underline, while the whole block has
    // a gray underline).
    $( "#footer h3" ).wrap( "<div class='BottomBoxHeader'>" );

    // change the styling of the checkout button
    $( ".mm-checkoutContainer a.mm-button" ).removeClass().addClass( "avia-button avia-icon_select-no avia-color-theme-color primary big" );

    // Adds url segments to the body tag so that we can do specific CSS styling based on URL segments.
    // Eg. if the url is /home/myaccount/ the body-tag will be given new attributes:
    // <body data-seg-0="home" data-seg-1="myaccount">
    var segments = [];
    (function () {
        $.each( window.location.pathname.split( "/" ), function ( key, segment ) {
            if ( segment.length ) {
                segments.push( segment );
            }
        } );
        $.each( segments, function ( key, segment ) {
            $( 'body' ).attr( 'data-seg-' + key, segment );
        } );
        $( 'body' ).attr( 'data-segments', segments.join( " " ) );
    }());

    // add a notification that the card has been updated
    // TODO: change the if-statement to actually track changes
    if ( window.location.hash === "#notificationUpdatedCard" ) {
        $( "body" ).append( '<div id="notificationUpdatedCard" class="notification-alert">' + __locale.notificationUpdatedCard + '</div>' );
    }

    // if at my page and the registration progress is incomplete
    if ( segments[0] === "home" && wmc.registrationProgress < 100 ) {
        var registrationProgressManager = new ProgressManager( wmc.progressDict, wmc.registrationProgress );
    }

    $( "#orderCardBtn" ).click( function () {
        var w = $( window ).width();
        var h = $( window ).height();
        $( "#wmc-card-is-sent-content" ).dialog( {
            width: w * .9,
            modal: true,
            title: __locale["cardIsSentToProduction"]
            // TODO: communicate to the server that the user wants a new card
        } );
    } );

    $( "#frmChangePassword" ).submit( function ( e ) {
        e.preventDefault();
        var $wmcPassword = $( "#wmcPassword" );
        var $wmcPasswordRepeat = $( "#wmcPasswordRepeat" );
        var $frmChangePassword = $( "#frmChangePassword" );
        var $error = $frmChangePassword.find( ".error" );
        var hasError = false;
        var newpass = $wmcPassword.val();
        var checkVal = $wmcPasswordRepeat.val();

        if ( newpass == '' ) {
            $error.text( __locale["enterAPassword"] );
            hasError = true;
        } else if ( checkVal == '' ) {
            $error.text( __locale["reenterPassword"] );
            hasError = true;
        } else if ( newpass != checkVal ) {
            $error.text( __locale["passwordsDontMatch"] );
            hasError = true;
        }

        if ( hasError == true ) {
            $error.show();
        }

        if ( hasError == false ) {
            wmcOverlay( true );
            $error.hide();
            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    action: 'edit_password',
                    password: newpass
                },
                success: function ( data ) {
                    alert( data.message );
                    location.reload();
                }
            } );
        }
    } );

    // birth date picker
    $( "input[name='mm_custom_1']" ).datepicker( {
        format: "dd.mm.yyyy",
        value: new Date(),
        minDate: "-100Y",
        maxDate: "0D",
        autoSize: true,
        changeMonth: true,
        changeYear: true,
        yearRange: "1914:"
    } );

    $( '#nmuploader-wrapper li.tool a[title="Delete"]' ).addClass( "avia-button secondary" ).append( '<span class="symbol-icon delete"></span>' );
//    $( '#nmuploader-wrapper #prev-page a, #nmuploader-wrapper #next-page a, #uploadifive-file_upload' ).addClass( "avia-button avia-icon_select-no avia-color-theme-color secondary" );
    $( '#uploadifive-file_upload' ).addClass( "avia-button avia-icon_select-no avia-color-theme-color primary" );
    $( '#nm-upload-container .nm-submit-button' ).addClass( "avia-button avia-icon_select-no avia-color-theme-color secondary" );

    $( ".wmc-responsive-list" ).each( function () {
        $( this )
            .addClass( "clearfix" )
            .find( "> :even" ).each( function ( index ) {
                var cls = ["flex_column", "av_one_half"];
                if ( index % 2 === 0 ) {
                    cls.push( "first" );
                }
                $( this ).next().andSelf().wrapAll( '<div class="' + cls.join( " " ) + '">' )
            } )
    } );

    $( '.wmc-conditions-link' ).click( function () {
        var w = $( window ).width();
        var h = $( window ).height();
        var $title = $( "#wmc-conditions-content h1" );
        $( "#wmc-conditions-content" ).dialog( { width: w * .9, height: h * .9, modal: true, title: $title.text() } );
        $( "#wmc-conditions-content" ).scrollTop( "0" )
        return false;
    } );

    // more than one form make use of these data
    var defaultPostData = {
        method: "performAction",
        action: "module-handle",
        module: "MM_MyAccountView"
    };

    // apply view models to personal info
    wmcPrepareForm( "#frmEditPersonalInformation", $.extend( {}, defaultPostData, {
        mm_action: "updateAccountDetails"
    } ), true );

    // apply view models to billing info
    wmcPrepareForm( "#frmEditBillingInfo", $.extend( {}, defaultPostData, {
        mm_action: "updateBillingInfo"
    } ), true );

    wmcPrepareForm( "#frmUpdateOtherInfromation", $.extend( {}, defaultPostData, {
        mm_action: "updateAccountDetails"
    } ), false );

    // Mask sensitive information by replacing text with asterisks. Example:
    //      <div data-mask-length="8">12345678901</div>
    // would become
    //      <div data-mask-length="8">********901</div>
    $( "[data-mask-length]" ).each( function () {
        var $el = $( this );
        var maskLen = parseInt( $el.data( "mask-length" ) );
        var val = $el.text();
        var str = Array( maskLen ).join( "*" ) + val.substr( maskLen - val.length );
        $el.text( str );
    } );

    /*******************************************************************************************************************
     *
     * Medical data
     ******************************************************************************************************************/

    function updateMedicalDataUI() {
        var numAllergies = $( ".wmc-table.allergies-table tbody tr" ).length;
        $( ".wmc-table.allergies-table" ).attr( "data-rows", numAllergies );

        var numMedications = $( ".wmc-table.medication-table tbody tr" ).length;
        $( ".wmc-table.medication-table" ).attr( "data-rows", numMedications );

        var numDiagnoses = $( ".wmc-table.diagnoses-table tbody tr" ).length;
        $( ".wmc-table.diagnoses-table" ).attr( "data-rows", numDiagnoses );
    }

    /*
     |-----------------------------------------------------------------------------------------
     | Allergy
     |-----------------------------------------------------------------------------------------
     */

    // Save allergy
    $( '.search-allergies-results' ).on( 'click', '.save-allergy', function () {
        var $this = $( this );
        var searchResultRow = $this.parent().parent();
        var allergyID = $this.data( 'allergy-id' );
        var allergyName = $this.parent().prev().text();

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'save_allergy',
                allergy_id: allergyID
            },
            success: function ( data ) {
                $( '.allergies-table tbody' ).append( '<tr data-allergy-id="' + allergyID + '"><td>' + allergyName + '</td><td><button class="delete delete-allergy avia-button avia-icon_select-no avia-color-theme-color secondary" title="Slett" type="button"><span class="avia-font-entypo-fontello" data-update_class_with="font"><span data-update_with="icon_fakeArg" class="avia_tab_icon big"></span></span></button></td></tr>' );
                searchResultRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    // Delete allergy
    $( '.allergies-table' ).on( 'click', '.delete-allergy', function () {
        var tableRow = $( this ).parent().parent();
        var allergyID = tableRow.data( 'allergy-id' );

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'delete_allergy',
                allergy_id: allergyID
            },
            success: function ( data ) {
                tableRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    /*
     |-----------------------------------------------------------------------------------------
     | Medication
     |-----------------------------------------------------------------------------------------
     */

    function addMedication( atcID, productName, activeIngredient, atcCode ) {
        activeIngredient = activeIngredient || "";
        $( '.medication-table tbody' ).append( '<tr data-atc-id="' + atcID + '"><td>' + productName + '</td><td>' + activeIngredient + '</td><td>' + atcCode + '</td><td>' + getIconButton( "", __locale["delete"], "delete delete-medication" ) + '</td></tr>' );
    }

    // Save medication
    $( '.search-medication-results' ).on( 'click', '.save-medication', function () {
        var $this = $( this );
        var searchResultRow = $this.parent().parent();
        var atcID = $this.data( 'atc-id' );
        var productName = $this.parent().prev().text();

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'save_medication',
                atc_id: atcID
            },
            success: function ( data ) {
                addMedication( atcID, productName, data.active_ingredient, data.atc_code );
                searchResultRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    // Delete medication
    $( '.medication-table' ).on( 'click', '.delete-medication', function () {
        var tableRow = $( this ).parent().parent();
        var atcID = tableRow.data( 'atc-id' );

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'delete_medication',
                atc_id: atcID
            },
            success: function ( data ) {
                tableRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    /*
     |-----------------------------------------------------------------------------------------
     | Diagnosis
     |-----------------------------------------------------------------------------------------
     */

    function addDiagnosis( diagnosisID, description, icd10_code ) {
        $( '.diagnoses-table tbody' ).append( '<tr data-diagnosis-id="' + diagnosisID + '"><td>' + description + '</td><td>' + icd10_code + '</td><td>' +
            getIconButton( "", __locale["delete"], "delete delete-diagnosis" ) +
            '</td></tr>' );
    }

    // Save diagnosis
    $( '.search-diagnoses-results' ).on( 'click', '.save-diagnosis', function () {
        var $this = $( this );
        var searchResultRow = $this.parent().parent();
        var diagnosisID = $this.data( 'diagnosis-id' );
        var description = searchResultRow.find( '.diagnosis-description' ).text();
        var icd10_code = searchResultRow.find( '.diagnosis-icd10-code' ).text();

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'save_diagnosis',
                diagnosis_id: diagnosisID
            },
            success: function ( data ) {
                addDiagnosis( diagnosisID, description, icd10_code );
                searchResultRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    // Delete diagnosis
    $( '.diagnoses-table' ).on( 'click', '.delete-diagnosis', function () {
        var tableRow = $( this ).parent().parent();
        var diagnosisID = tableRow.data( 'diagnosis-id' );

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'delete_diagnosis',
                diagnosis_id: diagnosisID
            },
            success: function ( data ) {
                tableRow.remove();
                updateMedicalDataUI();
            }
        } );

        return false;
    } );

    /*
     |-----------------------------------------------------------------------------------------
     | Search (allergy, medication, and diagnoses)
     |-----------------------------------------------------------------------------------------
     */

    var typingTimer;
    var doneTypingInterval = 500;

    function empty_search_results( divClass ) {
        $( divClass ).html( '' );
    }

    // Search allergy
    $( '.search-allergies input' ).on( 'input', function () {
        clearTimeout( typingTimer );
        typingTimer = setTimeout( doneTypingAllergy, doneTypingInterval );
    } );

    function doneTypingAllergy() {
        var searchInput = $( '.search-allergies input' );
        var searchInputValue = searchInput.val();
        var searchStringLength = searchInputValue.length;

        empty_search_results( '.search-allergies-results' );

        if ( searchStringLength >= 2 ) {
            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    action: 'search_allergies',
                    search_string: searchInputValue
                },
                success: function ( data ) {
                    if ( data !== null ) {
                        //empty_search_results('.search-allergies-results');
                        $( '.search-allergies-results' ).append( '<table class="allergies-search-table wmc-table zebra"><thead><tr><th>' + __locale['allergy'] + '</th><th></th></tr></thead><tbody></tbody></table>' );
                        $.each( data, function () {
                            $( '.allergies-search-table tbody' ).append( '<tr><td>' + this.text + '</td><td>' +
                                '<button data-allergy-id="' + this.allergy_id + '" class="save-allergy avia-button avia-icon_select-no avia-color-theme-color secondary" title="' + __locale.add + '" type="button">' +
                                getCSSicon( '' ) +
                                '</button>' +
                                '</td></tr>' );
                        } );
                    }
                }
            } );
        }
    }

    // Search medication
    $( '.search-medication input' ).on( 'input', function () {
        clearTimeout( typingTimer );
        typingTimer = setTimeout( doneTypingMedication, doneTypingInterval );
    } );

    function doneTypingMedication() {
        var searchInput = $( '.search-medication input' );
        var searchInputValue = searchInput.val();
        var searchStringLength = searchInputValue.length;

        empty_search_results( '.search-medication-results' );

        if ( searchStringLength >= 3 ) {
            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    action: 'search_medication',
                    search_string: searchInputValue
                },
                success: function ( data ) {
                    if ( data !== null ) {
                        //empty_search_results('.search-medication-results');
                        $( '.search-medication-results' ).append( '<table class="medication-search-table wmc-table zebra"><thead><tr><th>' + __locale['productName'] + '</th><th></th></tr></thead><tbody></tbody></table>' );
                        $.each( data, function () {
                            $( '.medication-search-table tbody' ).append( '<tr><td>' + this.text + '</td><td>' +
                                getIconButton( "", __locale["add"], "save-medication", 'data-atc-id="' + this.atc_id + '"' ) +
                                '</td></tr>' );
                        } );
                    }
                }
            } );
        }
    }

    // Search diagnosis
    $( '.search-diagnoses input' ).on( 'input', function () {
        clearTimeout( typingTimer );
        typingTimer = setTimeout( doneTypingDiagnosis, doneTypingInterval );
    } );

    function doneTypingDiagnosis() {
        var searchInput = $( '.search-diagnoses input' );
        var searchInputValue = searchInput.val();
        var searchStringLength = searchInputValue.length;

        empty_search_results( '.search-diagnoses-results' );

        if ( searchStringLength >= 3 ) {
            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: {
                    action: 'search_diagnoses',
                    search_string: searchInputValue
                },
                success: function ( data ) {
                    if ( data !== null ) {
                        //empty_search_results('.search-diagnoses-results');
                        $( '.search-diagnoses-results' ).append( '<table class="diagnoses-search-table wmc-table zebra"><thead><tr><th>' + __locale['description'] + '</th><th>' + __locale['diagnosisCodeICD10code'] + '</th><th></th></tr></thead><tbody></tbody></table>' );
                        $.each( data, function () {
                            $( '.diagnoses-search-table tbody' ).append( '<tr><td class="diagnosis-description">' + this.text + '</td><td class="diagnosis-icd10-code">' + this.icd10_code + '</td><td>' +
//                                '<a href="#" class="save-diagnosis" data-diagnosis-id="' + this.diagnosis_id + '">Add</a>' +
                                getIconButton( "", __locale["add"], "save-diagnosis", 'data-diagnosis-id="' + this.diagnosis_id + '"' ) +
                                '</td></tr>' );
                        } );
                    }
                }
            } );
        }
    }

    $( '.wmc-language-picker select' ).on( 'change', function () {
        // show overlay and progressbar
        wmcOverlay( true );

        var select = $( this );
        var selectValue = select.val();

        $.ajax( {
            type: 'post',
            dataType: 'json',
            url: ajaxurl,
            data: {
                action: 'language_to_session',
                current_language: selectValue
            },
            success: function ( data ) {
                location.reload();
            }
        } );
    } );

    function getInsuranceTypeSelectBox( type ) {
        var html = $( "#tpl_insurance_type_select" ).html();
        var $option = $( "#tpl_insurance_type_option" );
        var htmlOption = '';
        $.each( wmcInsuranceTypes, function ( key, val ) {
            var _htmlOption = $option.html();
            htmlOption += _htmlOption.replace( "{{selected}}", key === type ? "selected" : "" );
        } );
        html.replace( "{{option}}", html )

    }

    function addInsurance( ins_id, ins_company, ins_type, ins_policy, ins_phone, ins_card ) {

        var $tbody = $( ".insurance-table tbody" );
        var $el = $( $( "#tpl_insurance_row" ).html() );

        var $formId = $el.find( '[name="ins_id"]' );
        var $formCompany = $el.find( '[name="ins_company"]' );
        var $formType = $el.find( '[name="ins_type"]' );
        var $formPolicy = $el.find( '[name="ins_policy"]' );
        var $formPhone = $el.find( '[name="ins_phone"]' );
        var $formCard = $el.find( '[type="checkbox"][name="ins_card"]' );

        var $readCompany = $el.find( '[data-type="ins_company"]' );
        var $readType = $el.find( '[data-type="ins_type"]' );
        var $readPolicy = $el.find( '[data-type="ins_policy"]' );
        var $readPhone = $el.find( '[data-type="ins_phone"]' );
        var $readCard = $el.find( '[data-type="ins_card"]' );

        function enable( bool ) {
            $el.filter( ".form" ).find( "input, select, button" ).prop( "disabled", !bool );
        }

        function toggleEditMode() {
            $el.toggleClass( "edit-mode" );
        }

        function updateRead() {
            $readCompany.html( $formCompany.val() );
            $readType.html( $formType.find( "option:selected" ).html() );
            $readPolicy.html( $formPolicy.val() );
            $readPhone.html( $formPhone.val() );
            $readCard.html( $formCard.attr( "checked" ) ? "" : "" );
        }

        $el.find( "button.edit" ).click( function () {
            toggleEditMode();
        } );

        $el.find( "button.delete" ).click( function () {
            enable( false );
            if ( confirm( __locale.areYouSureYouWantToDelete ) ) {
                $.ajax( {
                    type: 'post',
                    dataType: 'json',
                    url: ajaxurl,
                    data: {
                        action: 'delete_insurance',
                        id: ins_id
                    },
                    success: function ( data ) {
                        $el.remove();
                    }
                } );
            } else {
                enable( true );
            }
            return false;
        } );

        $el.find( "button.save" ).click( function () {

            enable( false );

            var data = {
                action: "update_insurance",
                ins_company: $formCompany.val(),
                ins_policy: $formPolicy.val(),
                ins_phone: $formPhone.val(),
                ins_type: $formType.val(),
                ins_card: $formCard.attr( "checked" ) ? 1 : 0
            };

            if ( $formId.val() ) {
                // update id
                data.ins_id = $formId.val();
            } else {
                data.action = 'save_insurance';
            }

            $.ajax( {
                type: 'post',
                dataType: 'json',
                url: ajaxurl,
                data: data,
                success: function ( data ) {
                    $formId.val( data.ins_id );
                    updateRead();
                    toggleEditMode();
                    enable( true );
                }
            } );

            return false;

        } );

        $el.find( "button.cancel" ).click( function () {
            if ( $formId.val() ) {
                toggleEditMode();
            } else {
                $el.remove();
            }
            return false;
        } );

        $formId.val( ins_id );
        $formCompany.val( ins_company );
        $.each( wmcInsuranceTypes, function ( key, val ) {
            var $option = $( '<option value="' + key + '">' + val + '</option>' );
            if ( key === ins_type ) {
                $option.attr( "selected", true );
            }
            $formType.append( $option );
        } );
        $formPolicy.val( ins_policy );
        $formPhone.val( ins_phone );
        $formCard.attr( "checked", ins_card === "1" );

        updateRead();

        $tbody.append( $el );

        return {
            toggleEditMode: toggleEditMode
        }
    }

    if ( segments[1] === "medical-data" ) {

        // initialize user's medications
        try {
            $.each( wmcUserMedications, function ( key, arr ) {
                addMedication.apply( window, arr );
            } );
        } catch ( err ) {
        }

        // initialize user's diagnoses
        try {
            $.each( wmcUserDiagnoses, function ( key, arr ) {
                addDiagnosis.apply( window, arr );
            } );
        } catch ( err ) {
        }

        updateMedicalDataUI();

    }

    if ( segments[1] === "insurance" ) {

        // initialize user's insurances
        try {
            $.each( wmcUserInsurances, function ( key, arr ) {
                addInsurance.apply( window, arr );
            } );
        } catch ( err ) {
        }

        $( "#add-insurance" ).click( function () {
            var row = addInsurance();
            row.toggleEditMode();
        } );

    }

} );

$( window ).load( function () {

    // Remove the membermouse currency prefix ("kr"). Example of changes:
    // "kr325,00 NOK" => "325,00 NOK" or
    // "kr325,00" => "325,00"
    function hideCurrencyPrefix() {
        var str = $( "#mm_label_total_price" ).text();
        str = str.replace( "kr", "" );
        $( ".mm_label_total_price" ).text( str );
    }

    $( "#mm_label_total_price" ).before( '<span class="mm_label_total_price"></span>' );
    $( "#mm_label_total_price" ).bind( "DOMSubtreeModified", hideCurrencyPrefix ).css( "display", "none" );
    hideCurrencyPrefix();

} );

// == ODS start
// ================ INSURENCE CRUD
// Vars
var addINSbutton = $('.add-insurence');
    
// Add insurence
addINSbutton.on('click', function () {
	    
    $(this).hide();
    $('.insurence-table tbody').append('<tr id="add-ins-row">' +
                                        '<td><input type="text" class="inins-company"></td>' +
                                        '<td  class="select-place"></td>' +
                                        '<td><input type="text" class="inins-policyNo"></td>' +
                                        '<td><input type="text" class="inins-phone"></td>' +
                                        '<td><a href="#" class="save-insurence">Save</a></td>' +
                                        '<td><a href="#" class="cancel-insurence">Cancel</a></td>' +
                                        '</tr>');

    // kopier dropdown og legg den i tabellen 
    $("#hidden_select_mal").clone().appendTo(".select-place").attr("id", "copied").attr("class", "inins-type");
    document.getElementById("copied").style.display = 'block';
	    
	    
    return false;
});

// Cancel insurence
$('.insurence-table').on('click', '.cancel-insurence', function () {
    $(this).parent().parent().remove();
    addINSbutton.show();

    return false;
});

// Save insurence
$('.insurence-table').on('click', '.save-insurence', function () {
	    
    var tableRow = $(this).parent().parent();

    var i = 0;
    var ins_company = tableRow.find('.inins-company').val();  
    var ins_typecode = tableRow.find('.inins-type').val(); 
    var ins_policyno = tableRow.find('.inins-policyNo').val();

    var ins_phone = tableRow.find('.inins-phone').val();
	   
    var ins_typetekst;
    if (ins_typecode == 0) {
        ins_typetekst = "";
    } else {
	        
        ins_typetekst = tableRow.find('.inins-type option:selected').text();
	        
    }
	    
    // Ajax kall til wp_ajax_xxxxxx
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: ajaxurl,
        data: {
            action: 'save_insurence',
            company: ins_company,
            type_ins: ins_typecode,
            phone: ins_phone,
            policy_no: ins_policyno
        },
        success: function (data) {
	            
            $('.insurence-table tbody').append('<tr data-ins-id="' + data['ins_id'] + '"  data-ins-type="' + ins_typecode + '">' +
                                                '<td class="ins-company">' + ins_company + '</td>' +
                                                '<td class="ins-typetekst">' + ins_typetekst + 'ss</td>' +
                                                '<td class="ins-policyNo">' + ins_policyno + '</td>' +
                                                '<td class="ins-phone">' + ins_policyno + '</td>' +
                                                '<td><a href="#" class="edit-insurence">Edit</a></td>' +
                                                '<td><a href="#" class="delete-insurence">Remove</a></td>' +
                                                '</tr>');
            tableRow.remove();
            addINSbutton.show();
        },
	      
    });

    return false;
});

// Delete insurence     
	
$('.insurence-table').on('click', '.delete-insurence', function () {
	  
    var tableRow = $(this).parent().parent();
    var insID = tableRow.data('ins-id');

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: ajaxurl,
        data: {
            action: 'delete_insurence',
            ins_id: insID
        },
        success: function (data) {
	          
            tableRow.remove();
        }
    });
	   
    return false;
});
	
// Edit insurance table
$('.insurence-table').on('click', '.edit-insurence', function () {
	   
    var tableRow = $(this).parent().parent();
    var tableRowIndex = tableRow.index();
    var idSelect = "SelectPlaceU" + tableRowIndex;
	  
    addINSbutton.hide();
	    
    var ins_company = tableRow.find('.ins-company').text();
    var typeins = tableRow.data('ins-type');    // plukk fra raddata 
    var ins_policyNo = tableRow.find('.ins-policyNo').text();
    var ins_phone = tableRow.find('.ins-phone').text();

    $('.insurence-table tbody tr:eq(' + tableRowIndex + ')').after('<tr>' +
                                                                        
    '<td><Input type="text" value="' + ins_company  + '" class="inins-company">' +'</td>' +
    '<td  id="'+idSelect+'"></td>' +                           
    '<td><Input type="text" value="' + ins_policyNo +'" class="inins-policyNo"></td>' +
    '<td><Input type="text" value="' + ins_phone    +'" class="inins-phone">' +  '</td>' +
    '<td><a href="#" class="update-insurence">Save</a>' +
    '<td><a href="#" class="do-not-save-insurence">Cancel</a></td>' +
    '</tr>');
    $("#hidden_select_mal").clone().appendTo("#" + idSelect).attr("id", "copied2").attr("class", "inins-type").val(typeins);
    document.getElementById("copied2").style.display = 'block';
	    
    tableRow.css('display', 'none');

    return false;
});

// Update insurence
$('.insurence-table').on('click', '.update-insurence', function () {
	   
    var tableRow = $(this).parent().parent();
    var tableRowIndex = tableRow.index();

    // plukk ut data
    var selskap = tableRow.find('.inins-company').val();
    var typeins = tableRow.find('.inins-type').val();   
    var policyno = tableRow.find('.inins-policyNo').val();


        
        
    var phone = tableRow.find('.inins-phone').val();
    var insID = tableRow.prev().data('ins-id');          // plukk fra raddata i opprinnelig rad
	    
    var ins_typetekst;
    if (typeins == 0) {
        ins_typetekst = "";
    } else {
	       
        ins_typetekst = tableRow.find('.inins-type option:selected').text();
	        
    }

    $.ajax({

        type: 'post',
        dataType: 'json',
        url: ajaxurl,
        data: {
            action: 'update_insurence',
            company: selskap,
            type_ins: typeins,
            phone: phone,
            policy_no: policyno,
            ins_id: insID
        },
        success: function (data) {    // etablerer tabell-linjen igjen 
	            	            
            $('.insurence-table tbody tr:eq(' + tableRowIndex + ')').before('<tr data-ins-id="' + insID + '"  data-ins-type="' + typeins + '">' +
                                                                            '<td class="ins-company">' + selskap + '</td>' +
                                                                            '<td class="ins-typetekst">' + ins_typetekst + '</td>' +
                                                                            '<td class="ins-policyNo">' + policyno + '</td>' +
                                                                            '<td class="ins-phone">' + phone + '</td>' +
                                                                            '<td><a href="#" class="edit-insurence">Edit</a></td>' +
                                                                            '<td><a href="#" class="delete-insurence">Remove</a></td>' +
                                                                            '</tr>');
            tableRow.remove();   // og fjerner den gamle og den med innleggingen
	           
            $('tr[data-ins-id="' + insID + '"]:first').remove();	           
            addINSbutton.show();
        },
        error: function (jqXHR, exception) {
            //$('.sms-resultat').text('ErrorRespons: ' + jqXHR.responseText  +' | '+ exception);
            alert('Feilmelding: ' + jqXHR.url + ' ' + exception);
        }
    });
    return false;
});

// Cancel insurence
$('.insurence-table').on('click', '.do-not-save-insurence', function () {
    var tableRow = $(this).parent().parent();
    tableRow.prev().removeAttr('style');
    tableRow.remove();

    return false;
});	
    
// send sms melding
$('.send-kapow-sms').on('click', function () {
    kapowNavn= $('.sms_brukernavn').val();
    passord = $('.sms_passord').val();
    mottagerNummer = $('.sms_nummer').val();
    melding = $('.sms_melding').val();
    $('.sms-resultat').text("Sender...");

    $.ajax({
        type: 'post',
        dataType: 'json',
        url: ajaxurl,
        data: {
            action: 'send_kapow_sms_go',
            kapow_name: kapowNavn,
            kapow_password: passord,
            reciever_no: mottagerNummer,
            message_to_send: melding
        },
        success: function (data) {
            $('.sms-resultat').text('Respons: '+data['kapowRespons']);
        },
        error: function (jqXHR, exception) {
            $('.sms-resultat').text('ErrorRespons: ' + jqXHR.responseText  +' | '+ exception);
            alert('Feilmelding: '+jqXHR.url + ' ' + exception);
        }
    });

    return false;
});

// =====================
// ODS stopp
})(jQuery);    // lagt til av ODS