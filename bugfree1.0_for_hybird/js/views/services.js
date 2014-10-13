// Category View
// =============
define([
	"jquery",
	"backbone"
], function( $, Backbone ) {
    
    var View = Backbone.View.extend( { 
        //构造初始化
        initialize: function() {
            this.assignme = "0";
            this.mecreate = "0";
        },
        //设置UI的动作
        events: {
          "click #services_refresh":  "refresh"
        }, 
        //UI加载触发的方法       
        onLoad:function(viewName,params){ 
            A.redFooterIcon(this,viewName,params);
            T.assertParamsLength(params,1);
            $.mobile.changePage("#"+viewName, {
                reverse: false,
                changeHash: false
            });
            if(params[0]=="assignme"){
                $("#service_head").html("我的任务");
                this.assignme = "1";
                 A.displayFooter(this,"common_footer_assignme");
            }else if(params[0]=="mecreate"){
                $("#service_head").html("我创建的任务");
                this.mecreate = "1";
                 A.displayFooter(this,"common_footer_mecreate");
            }
            this.loadData();
           
            
        },
        //渲染UI界面
        render:function(collection){
            this.template = _.template( $( "script#services_list_template" ).html(), { "collection": collection } );
            $("#services_list").html(this.template);
            return this;
        },
        //刷新按钮
        refresh:function(e){
            this.loadData();
        },
        //加载数据
        loadData:function(){
            var that = this;
            var servcieName = "buginfos2.php";
            var posts = {
                pageIndex:"1",
                pageSize:A.pageSize,
                isAssignMe:this.assignme,
                isMeCreate:this.mecreate,
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    that.render(new Backbone.Collection(json.datas));
                }    
                T.display(that);            
            }
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,null);
        }
    } );
    return View;
} );
