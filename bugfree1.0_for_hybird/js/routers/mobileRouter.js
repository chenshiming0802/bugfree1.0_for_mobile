// Mobile Router
// =============
define([
    "jquery",
    "backbone",
    "../views/home",
    //customer view-xml
    "../views/login",
    "../views/services",
    "../views/profile"
], function(
    $,
    Backbone,
    home,
    //cusomter view-obj
    login,
    services,
    profile
) {
    var viewCache = new Array();
    var CategoryRouter = Backbone.Router.extend({
        initialize: function() {
            Backbone.history.start();
        },
        routes: {
            "": "home",
            ":viewName": "view",
            ":viewName?:param": "view"
        },
        createView: function(viewName, param) {
            //var viewClass = viewName.substring(0, 1).toUpperCase() + viewName.substring(1, viewName.length) + "";
            viewClass = viewName;
            var obj = {};
            obj.__proto__ = eval(viewClass).prototype;
            //alert(viewClass+"/"+obj+"/"+param);
            eval(viewClass).call(obj, param);
            viewCache[viewName] = obj;
            return obj;
        },
        home: function() {
            this.view("home", null);
        },
        view: function(viewName) {
            this.view(viewName, null);
        },
        view: function(viewName, param) {
            $.mobile.loading( "show" );
            var params;
            if (param == null || param == '') {
                params = new Array();
            } else {
                params = param.split(",");
            }
            T.log("create view-#" + viewName);
            this.createView(viewName, {
                el: "#" + viewName
            }).onLoad(viewName, params);
            $.mobile.loading('hide');
        }
    });
    return CategoryRouter;

});