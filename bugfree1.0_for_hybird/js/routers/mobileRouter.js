// Mobile Router
// =============
define([
    "jquery",
    "backbone",
    "../views/home",
    //customer view-xml
    "../views/login",
    "../views/services",
    "../views/service",
    "../views/profile",
    "../views/usersearch"
], function(
    $,
    Backbone,
    home,
    //cusomter view-obj
    login,
    services,
    service,
    profile,
    usersearch
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
                params = param.split("&");
            }
            T.log("create view-#" + viewName);
            var view = this.createView(viewName, {
                el: "#" + viewName
            });  
            var ret = view.onLoad(viewName, params);   
            if(ret==true){ //返回ture则继续调用resume
                //是否需要刷新数据
                if(T.isNextPageRefresh==true){        
                    if(view.onResume){
                        view.onResume(viewName, params);
                    }
                }else{
                    T.isNextPageRefresh = true;
                }
            }      
            $.mobile.loading('hide');
        }
    });
    return CategoryRouter;

});