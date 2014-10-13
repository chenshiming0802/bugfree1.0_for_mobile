// Category View
// =============
define([
	"jquery",
	"backbone"
], function( $, Backbone ) {
    
    var View = Backbone.View.extend( {
        initialize: function() {
        },
        onLoad:function(viewName,params){
            var that = this;
            $.mobile.changePage("#flash", {
                reverse: false,
                changeHash: false
            });
            setTimeout("T.redirect(\"#services?assignme\");",1000);    
        },
        renderList:function(collection){
        }
    } );
    return View;

} );