<?php

?>
<input id="movies" name="movies" style="width: 250px" />
<script>jQuery(function () {
jQuery("#movies").kendoDropDownList({
"dataSource": { "transport": {"read": { "url": "http:\/\/localhost:10858\/mm\/wmc\/wp-content\/plugins\/WMC_fileupload\/UploadedData.php?type=catnames", "contentType": "application\/json", "type": "POST" },
                              "parameterMap": function (data) { return kendo.stringify(data);}
                              },
                 "schema": { "data": "data" }
               },
                "dataTextField": "text",
                "dataValueField": "value"
});
});</script>