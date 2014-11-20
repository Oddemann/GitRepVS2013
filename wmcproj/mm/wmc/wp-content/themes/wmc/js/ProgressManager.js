/**
 * A class for tracking the progress of the user and communicating with the back end when there are changes in progress.
 * @param currentProgress {Number} Integer indicating the current progress the user has made.
 * @constructor
 */
function ProgressManager( progressDict, currentProgress ) {

    this.progressDict = progressDict;
    this.currentProgress = currentProgress;
    this.currentProgressObj = this.progressDict[this.currentProgress];

    // set a flag to the body so that CSS can respond to the registration process
    $( 'body' ).attr( 'data-registration-percent', this.currentProgressObj.percent );

    // if not in the valid step we'll redirect the user
    if ( !this.isValidProgressStep() ) {
        // show an overlay while waiting
        wmcOverlay( true );
        window.location = this.currentProgressObj.url;
        return;
    }

//    // append the progress navigation template to the end of main content
//    $( "main" ).append( $( "#tpl_progressNavigation" ).html() );

    // easy reference to the progress navigation element
    var $progressNavigation = $( "#progressNavigation" );

    var $progress = $progressNavigation.find( ".progress" );

    // make element available to prototype
    this.$progress = $progress;

    this.updateProgressBar();

    $progressNavigation.find("button").click(function(e){
        if (this.currentProgressObj.percent < 100) {
            e.preventDefault();
            this.incrementProgress();
        } else {
            var w = $( window ).width();
            var h = $( window ).height();
            $( "#wmc-card-is-sent-content" ).dialog( {
                width: w * .9,
                modal: true,
                title: __locale["cardIsSentToProduction"],
                close: function( ) {
                    this.incrementProgress();
                }.bind(this)
            } );
        }
    }.bind(this));
}

ProgressManager.prototype.updateProgressBar = function () {

    // percentage completed
    var percent = this.currentProgressObj.percent;
    var percentStr = percent + "%";

    var rect = [ 0, this.$progress.width() * percent / 100, 200, 0 ];
    var rectStr =
        $.map( rect, function ( val ) {
            return val + "px";
        } );
    rectStr = "rect(" + rectStr.join(",") + ")";

    // clip the light percentage text, making the dark text appear next to the (dark) progress bar
    this.$progress.find( ".percent.light" ).css( "clip", rectStr );

    // set the width of the progress bar
    this.$progress.find( ".bg" ).css( "width", percentStr );

    // update the percentage text (for both light and dark)
    this.$progress.find( ".percent" ).text( percentStr );

};

/**
 * Increments the progress step and takes the user to the next step/page.
 */
ProgressManager.prototype.incrementProgress = function () {

    var nextProgressObj = this.getNextProgressObj();

    var data = {
        action: 'update_registration_progress',
        registration_progress: nextProgressObj.step
    };

    var url = ajaxurl;

    wmcOverlay( true );

    // do ajax stuff here and then redirect the user
    $.ajax( {
        type: "POST",
        url: url,
        data: data,
        dataType: "json",
        success: function ( data ) {
            window.location = nextProgressObj.url;
        }
    } );

};

/**
 * Checks if the current URL coincides with the current progress.
 * Eg. if progress is 1 the url should be '/home/parorende/'
 * @returns {boolean}
 */
ProgressManager.prototype.isValidProgressStep = function () {
    return this.currentProgressObj.url === window.location.pathname;
};

/**
 * Returns the next object in the list.
 * @returns {*}
 */
ProgressManager.prototype.getNextProgressObj = function () {
    return this.progressDict[ this.currentProgress + 1 ];
};

//	0 => Personopplysninger
//	1 => Pårørende
//	2 => Medisinske data
//	3 => Organdonasjon
//	4 => Forsikringsinformasjon
//	5 => Kort
//	100 => Ferdig
//Object.defineProperty( ProgressManager, "PROGRESS", {
//    writeable: false,
//    value: [
//        {
//            step: 0,
//            url: '/home/myaccount/',
//            percent: 0
//        },
//        {
//            step: 1,
//            url: '/home/next-of-kin/',
//            percent: 20
//        },
//        {
//            step: 2,
//            url: '/home/medical-data/',
//            percent: 40
//        },
//        {
//            step: 3,
//            url: '/home/organdonation/',
//            percent: 60
//        },
//        {
//            step: 4,
//            url: '/home/insurance/',
//            percent: 80
//        },
//        {
//            step: 5,
//            url: '/home/card/',
//            percent: 100
//        },
//        {
//            // the last page when all mandatory steps are completed
//            step: 100,
//            url: '/home/my-files/',
//            percent: 100
//        }
//    ]
//} );
