<?php

// sett Dropdown boks med data fra endpoint
$ddtransport = new \Kendo\Data\DataSourceTransport();

$ddread = new \Kendo\Data\DataSourceTransportRead();

$ddread->url('xxxxxxxxxxxxxxxxx')
       ->contentType('application/json')
       ->type('POST');

$ddtransport->read($ddread)
          ->parameterMap('function(data) {
              return kendo.stringify(data);
           }');

$ddschema = new \Kendo\Data\DataSourceSchema();
$ddschema->data('data')
       ->total('total');

$dddataSource = new \Kendo\Data\DataSource();

$dddataSource->transport($ddtransport)
           ->schema($ddschema)
           ->serverFiltering(true);

$dropDownList = new \Kendo\UI\DropDownList('products');

$dropDownList->dataSource($ddataSource)
             ->dataTextField('ProductName')
             ->dataValueField('ProductID')
             ->filter('contains')
             ->ignoreCase(false)
             ->attr('style', 'width:250px');
?>

?>
<input id="movies" name="movies" style="width: 250px" />
<script>
    jQuery( function(){ jQuery("#movies").kendoDropDownList( {"dataTextField":"text",
                                                              "dataValueField":"value",
                                                              "dataSource":
                                                               [{"text":"The Shawshank Redemption","value":1},
                                                                {"text":"The Godfather","value":2},
                                                                {"text":"The Godfather: Part II","value":3},
                                                                {"text":"Il buono, il brutto, il cattivo.","value":4},
                                                                {"text":"Pulp Fiction","value":5},
                                                                {"text":"12 Angry Men","value":6},
                                                                {"text":"Schindler's List","value":7},
                                                                {"text":"One Flew Over the Cuckoo's Nest","value":8},
                                                                {"text":"Inception","value":9},
                                                                {"text":"The Dark Knight","value":10}
                                                               ]
                                                              }
                                                            );
                       });
</script>
<!DOCTYPE html>
<html class="html_stretched responsive av-default-lightbox  html_header_top html_logo_left html_main_nav_header html_menu_right html_slim html_header_sticky html_header_shrinking html_mobile_menu_phone html_disabled html_entry_id_73  k-ie k-ie11 avia_desktop  js_active  avia_transform  avia_transform3d  avia_transform  avia_transform3d  avia-msie avia-msie-11 avia-windows" lang="nb-NO">
<head>
<title></title>
<style>
* {
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;
}
html {
	min-width: 910px;
}
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}
article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	font: 13px/1.65em "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
	color: #444;
	-webkit-text-size-adjust: 100%;
}
::selection {
	background-color: #719430;
	color: #ffffff;
}
.flex_column::after, .clearfix::after {
	clear: both;
}
.content, .sidebar {
	padding-top: 30px;
}
.container::after {
	content: "\0020";
	display: block;
	height: 0px;
	clear: both;
	visibility: hidden;
}
.container_wrap {
	clear: both;
	position: relative;
	border-top-style: solid;
	border-top-width: 1px;
}
.main_color, .main_color div, .main_color header, .main_color main, .main_color aside, .main_color footer, .main_color article, .main_color nav, .main_color section, .main_color span, .main_color applet, .main_color object, .main_color iframe, .main_color h1, .main_color h2, .main_color h3, .main_color h4, .main_color h5, .main_color h6, .main_color p, .main_color blockquote, .main_color pre, .main_color a, .main_color abbr, .main_color acronym, .main_color address, .main_color big, .main_color cite, .main_color code, .main_color del, .main_color dfn, .main_color em, .main_color img, .main_color ins, .main_color kbd, .main_color q, .main_color s, .main_color samp, .main_color small, .main_color strike, .main_color strong, .main_color sub, .main_color sup, .main_color tt, .main_color var, .main_color b, .main_color u, .main_color i, .main_color center, .main_color dl, .main_color dt, .main_color dd, .main_color ol, .main_color ul, .main_color li, .main_color fieldset, .main_color form, .main_color label, .main_color legend, .main_color table, .main_color caption, .main_color tbody, .main_color tfoot, .main_color thead, .main_color tr, .main_color th, .main_color td, .main_color article, .main_color aside, .main_color canvas, .main_color details, .main_color embed, .main_color figure, .main_color fieldset, .main_color figcaption, .main_color footer, .main_color header, .main_color hgroup, .main_color menu, .main_color nav, .main_color output, .main_color ruby, .main_color section, .main_color summary, .main_color time, .main_color mark, .main_color audio, .main_color video, #top .main_color .pullquote_boxed, .responsive #top .main_color .avia-testimonial, .responsive .avia-blank#top #main :first-child.container_wrap.main_color, #top .fullsize.main_color .template-blog .post_delimiter, .main_color .av-related-style-full.related_posts a {
	border-color: #e1e1e1;
}
.row, .clearfix {
	zoom: 1;
}
.clearfix::before, .clearfix::after, .flex_column::before, .flex_column::after {
	content: "\0020";
	display: block;
	overflow: hidden;
	visibility: hidden;
	width: 0px;
	height: 0px;
}
.content .entry-content-wrapper {
	padding-right: 50px;
}
.unit, .units {
	float: left;
	display: inline;
	margin-left: 50px;
	position: relative;
	z-index: 1;
	min-height: 1px;
}
.content, .sidebar {
	padding-top: 50px;
	padding-bottom: 50px;
	-webkit-box-sizing: content-box;
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	min-height: 1px;
	z-index: 1;
}
.content {
	border-right-style: solid;
	border-right-width: 1px;
	margin-right: -1px;
}
.main_color .content, #top #main .sidebar {
	border-color: transparent;
}
body .alpha.unit, body .alpha.units, body div .first {
	margin-left: 0px;
	clear: left;
}
body .alpha.unit, body .alpha.units {
	width: 100%;
}
.container .units.nine {
	width: 670px;
}
/* @media only screen and (min-width:1140px) */
.responsive .container .units.nine {
	width: 760px;
}
.container {
	position: relative;
	width: 910px;
	margin: 0 auto;
	padding: 0px;
	clear: both;
}
/* @media only screen and (min-width:1140px) */
.responsive .container {
	width: 1030px;
}
.main_color, .main_color .site-background, .main_color .first-quote, .main_color .related_image_wrap, .main_color .gravatar img .main_color .hr_content, .main_color .news-thumb, .main_color .post-format-icon, .main_color .ajax_controlls a, .main_color .avatar_no.tweet-text, .main_color .toggler, .main_color .activeTitle.toggler:hover, .main_color #js_sort_items, .inner-entry.main_color, .main_color .grid-entry-title, .main_color .related-format-icon, .grid-entry .main_color .avia-arrow, .main_color .avia-gallery-big, .main_color .avia-gallery-big, .main_color .avia-gallery img, .main_color .grid-content, .main_color .av-share-box ul, #top .main_color .av-related-style-full .related-format-icon, .main_color .av-related-style-full.related_posts a:hover, .avia-fullwidth-portfolio.main_color .pagination .current, .avia-fullwidth-portfolio.main_color .pagination a {
	background-color: #ffffff;
	color: #666666;
}
.container_wrap {
	clear: both;
	position: relative;
}
#main > .container_wrap {
	border-top: 0;
}
#wrap_all {
	width: 100%;
	position: relative;
	z-index: 2;
	overflow: hidden;
}
#main, .html_stretched #wrap_all {
	background-color: #ffffff;
}
.html_header_sticky.html_header_top #main {
	padding-top: 88px;
}
body {
	line-height: 1;
}
body {
	font-family: " helvetica neue", "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.helvetica-neue-websave {
	font-family: "HelveticaNeue", "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
}
html.responsive {
	min-width: 0px;
}
html.responsive, .responsive body {
	overflow-x: hidden;
}
html, #scroll-top-link {
	background-color: #ffffff;
}
html {
	margin-top: 32px !important;
}
</style>
</head>
<body class="page page-id-73 page-template-default logged-in admin-bar stretched helvetica-neue-websave _helvetica_neue  customize-support" id="top" data-seg-0="mm" itemtype="https://schema.org/WebPage" itemscope="itemscope" data-seg-1="wmc" data-segments="mm wmc last-opp-med-plugin" data-seg-2="last-opp-med-plugin"><div id="wrap_all"><div id="main" data-scroll-offset="88"><div class="container_wrap container_wrap_first main_color sidebar_right"><div class="container">
<main class="template-page content  nine alpha units" role="main" itemprop="mainContentOfPage">
    <article class="post-entry post-entry-type-page post-entry-73" itemtype="https://schema.org/CreativeWork" itemscope="itemscope">
        <div class="entry-content-wrapper clearfix"><div class="entry-content" itemprop="text">
<script>jQuery(function () {
jQuery("#movies").kendoDropDownList({
"dataSource": {
"transport": {
"read": { "url": "http:\/\/localhost:10858\/mm\/wmc\/wp-content\/plugins\/WMC_fileupload\/UploadedData.php?type=catnames", "contentType": "application\/json", "type": "POST" }, "parameterMap": function (data) {
    return kendo.stringify(data);
}
}, "schema": { "data": "data" }
}, "dataTextField": "text", "dataValueField": "value"
});
});</script></div></div></article></main></div></div></div></div></body>
</html>


