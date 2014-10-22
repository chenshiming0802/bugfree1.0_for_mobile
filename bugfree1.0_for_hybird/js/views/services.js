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
            this.search = "0";
            this.queryString = "";
        },
        //设置UI的动作
        events: {
          "click #services_refresh":  "refresh",
          "click #servicessearch_back":  "servicessearch_back",
          "change #servicesearch_input":  "servicesearch_input"
        }, 
        servicesearch_input:function(e){
            var str = $("#servicesearch_input").val();
            if(str.length>0){
                this.queryString = str;
                this.loadData();
            }   
        },
        servicessearch_back:function(){
            T.goBack(true);
        },
        //UI加载触发的方法       
        onLoad:function(viewName,params){ 
 
            A.assertHasLogin();


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
                 $(".servicesearch_div").css("display","none");
            }else if(params[0]=="mecreate"){
                $("#service_head").html("我创建的任务");
                this.mecreate = "1";
                 A.displayFooter(this,"common_footer_mecreate");
                 $(".servicesearch_div").css("display","none");
            }else if(params[0]=="search"){
                $("#service_head").html("Servcie搜索");
                this.search = "1";
                $(".servicesearch_div").css("display","block");
            }
            this.loadData();
            return true;
            
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

            //如果是查询，但没有查询关键字，则不查询
            if(this.search=="1" && this.queryString==""){
                return;
            }

            var posts = {
                pageIndex:"1",
                pageSize:A.pageSize,
                isAssignMe:this.assignme,
                isMeCreate:this.mecreate,
                queryString:this.queryString
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
