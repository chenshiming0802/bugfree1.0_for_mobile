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
           "change #usersearch_input":  "usersearch_input",
           "click .usersearch_list_item":  "usersearch_list_item"
        }, 
        //UI加载触发的方法       
        onLoad:function(viewName,params){ 
             
            T.assertParamsLength(params,0);
            $.mobile.changePage("#"+viewName, {
                reverse: false,
                changeHash: false
            });
            //this.loadData();
            return true;
 
        },
        usersearch_input:function(e, data){
            var str = $("#usersearch_input").val();
            if(str.length>0){
                this.loadData();
            }
        },
        usersearch_list_item:function(e){
            var realName = $(e.currentTarget).find(".realName_i").val();
            var userName = $(e.currentTarget).find(".userName_i").val();
            $("#service_f1_assignto_text").val(realName+"<"+userName+">");
            $("#service_f1_assignto").val(userName);
            T.goBack(false);
        },
        //渲染UI界面
        render:function(collection){
            this.template = _.template( $( "script#usersearch_list_template" ).html(), { "collection": collection } );
            $("#usersearch_list").html(this.template);
            return this;            
        },
        //加载数据
        loadData:function(){
            var that = this;
            var servcieName = "queryUsers2.php";
            var posts = {
                pageIndex:"1",
                pageSize:A.pageSize,
                queryString:$("#usersearch_input").val()
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    that.render(json.datas);
                }    
                T.display(that);            
            }
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,null);
        }
    } );
    return View;
} );
 