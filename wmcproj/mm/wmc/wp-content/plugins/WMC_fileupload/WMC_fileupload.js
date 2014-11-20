
function onSuccess(e)
{
    jQuery('#FileValList').data('kendoGrid').dataSource.read();
    jQuery('#FileValList').data('kendoGrid').refresh();
}
    
function dropDownEditor(container, options)
{
     jQuery('<input data-bind="value:' + options.field + '">')
                .appendTo(container)
                .kendoDropDownList({
                    "dataSource": {
                            "transport": {
                            "read": { "url": "http:\/\/localhost:10858\/mm\/wmc\/wp-content\/plugins\/WMC_fileupload\/UploadedData.php?type=catnames", "contentType": "application\/json", "type": "POST" },
                                      "parameterMap": function (data) { return kendo.stringify(data); }
                            },  //  "transport"
                            "schema": { "total": "total", "data": "data" }
                    },     // "dataSource"
                    "dataTextField": "text",
                    "dataValueField": "text"
                });         // kendoDropDownList    parameterist
 }   //function dropDownEditor(container,options)

// javascript function
function onViewfileClick(e)
{
    var grid = jQuery("#DocList").data("kendoGrid");
    var row = jQuery(e.currentTarget).closest("tr");
    var rowIndex = jQuery("tr", grid.tbody).index(row);
    var idOfDbRecord = grid.dataSource.at(rowIndex).id;


    // Arguments :
    //  verb : 'GET'|'POST'
    //  target : an optional opening target (a name, or "_blank"), defaults to "_self"
    open = function (verb, url, data, target) {
        var form = document.createElement("form");
        form.action = url;
        form.method = verb;
        form.target = target || "_self";
        if (data) {
            for (var key in data) {
                var input = document.createElement("textarea");
                input.name = key;
                input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
                form.appendChild(input);
            }
        }
        form.style.display = 'none';
        document.body.appendChild(form);
        form.submit();
   
    };

    open('POST', dennePluginUrl + "Fileview.php", { fileref: idOfDbRecord }, '_blank');

}
   