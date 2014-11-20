function startMedUserCode(obj, showlist) {
    
    usercode= jQuery('#Emergency_LoginId').val();
                   
    if(typeof(a)==='undefined') {
    jQuery.ajax({
        type: 'post',
        dataType: 'json',
        url: ajaxurl,
        data: {
            action: 'wmcods_Send_DocList_to_browser',
            emergencycode: usercode,
            showlist:showlist
        },
        success: function (data) {
            if (data == -1) { jQuery('#result_Emergency').html( 'No such emergency code') }
            else 
            {
                jQuery('#result_Emergency').html(data);
            }
        },
        error: function (jqXHR, exception) {
            jQuery('#result_Emergency').text('ErrorRespons: ' + exception);
            alert('Feilmelding: ' + jqXHR.url + ' ' + exception);
        }
    });

    return false;
    }
};


