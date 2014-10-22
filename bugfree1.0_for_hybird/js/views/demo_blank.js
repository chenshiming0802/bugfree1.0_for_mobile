// Category View
// =============
define([
	"jquery",
	"backbone"
], function( $, Backbone ) {
    
    var View = Backbone.View.extend( { 
        //构造初始化
        initialize: function() {
            //this.assignme = "0";
        },
        //设置UI的动作
        events: {
          //"click #services_refresh":  "refresh"
        }, 
        //UI加载触发的方法       
        onLoad:function(viewName,params){  
            /* 
            T.assertParamsLength(params,1);
            $.mobile.changePage("#"+viewName, {
                reverse: false,
                changeHash: false
            });
            */       
        },
        onResume:function(viewName,params){  
            //this.render(null);
        }
        //渲染UI界面
        render:function(collection){
            /*
            this.template = _.template( $( "script#services_list_template" ).html(), { "collection": collection } );
            $("#services_list").html(this.template);
            */
            return this;            
        }
    } );
    return View;
} );
 