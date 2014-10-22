// Category View
// =============
define([
	"jquery",
	"backbone"
], function( $, Backbone ) {
    
    var View = Backbone.View.extend( { 
        //构造初始化
        initialize: function() {
            this.bugId = "";
        },
        //设置UI的动作
        events: {
          "tap #service_refresh":  "refresh",//title的刷新按钮
          "tap #service_back":  "back",//title的返回按钮
          "click #service_f0_editbt":  "editbt",//点击编辑按钮
          "click #service_f0_fixbt":  "fixbt",//点击解决按钮
          "click #service_f1_cancel":  "f1cancel",//编辑取消
          "click #service_f2_cancel":  "f2cancel",//解决取消
          "click #service_f1_submit":  "f1submit",//编辑提交
          "click #service_f2_submit":  "f2submit",//解决提交
          "change #service_f1_commonreply":  "f1commonreply",//编辑常见意见选择
          "change #service_f2_commonreply":  "f2commonreply"//解决常见意见选择
        }, 
        //UI加载触发的方法       
        onLoad:function(viewName,params){  
            A.assertHasLogin();
            T.assertParamsLength(params,1);
            $.mobile.changePage("#"+viewName, {
                reverse: false,
                changeHash: false
            });
            this.bugId = params[0];
            return true; 
        },
        onResume:function(viewName,params){ 
            this.loadData();    
        },
        //渲染UI界面
        render:function(data){
            $("#service_title").text(data.bugTitle);
            $("#service_project").text("项目模块："+data.projectName+data.moduleName);
            $("#service_type").text("事件类型："+data.bugType);
            $("#service_fixtime").text("期望时间："+data.fixedTime);
            $("#service_import").text("严重程度："+data.bugSeverity);
            $("#service_assignto").text("指派人员："+data.assignedToRealUserName);
            $("#service_createuser").text("由谁创建："+data.openedByRealUserName);

            $("#service_f1_assignto").val(data.assignedTo);
            $("#service_f1_assignto_text").val(data.assignedToRealUserName+"<"+data.assignedTo+">");
            this.template = _.template( $( "script#service_list_template" ).html(), { "collection": data.comments } );
            $("#service_list").html(this.template);
            return this;
        },
        //刷新按钮
        refresh:function(e){   
            this.loadData();
        },
        //加载数据
        loadData:function(){
            var that = this;
            var servcieName = "buginfo2.php";
            var posts = {
                bugId:this.bugId
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    that.render(json);
                }    
                T.display(that);            
            }
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,null);
        },
        back:function(e){
            T.goBack();
        },
        displayFooterZone:function(zoneId){
            $("#service_f0").css("display","none");
            $("#service_f1").css("display","none");
            $("#service_f2").css("display","none");
            $("#"+zoneId).css("display","block");          
        },
        editbt:function(e){
            this.displayFooterZone("service_f1");
        },
        fixbt:function(e){
            this.displayFooterZone("service_f2");
        },
        f1cancel:function(e){
            this.displayFooterZone("service_f0");         
        },
        f2cancel:function(e){
            this.displayFooterZone("service_f0");          
        },
        f1submit:function(e){
            $notes = $("#service_f1_notes").val();
            T.assertNotNull($notes,"请输入回复内容");
            $assignedTo = $("#service_f1_assignto").val();
            T.assertNotNull($assignedTo,"请选择指派人员");

            var that = this;
            var servcieName = "updateBug2.php";
            var posts = {
                bugId:this.bugId,
                notes:$notes,
                assignedTo:$assignedTo,
                action:"Edited"
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    that.loadData();
                    this.displayFooterZone("service_f0"); 
                }    
                T.display(that);            
            }
            //alert(T.json2str(posts));
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,null);            
        },
        f2submit:function(e){
            var notes = $("#service_f2_notes").val();
            T.assertNotNull(notes,"请输入回复内容");    
            var resolution = $("#service_f2_resolution").val();
            T.assertNotNull(resolution,"请输入解决方案");  
                               
            var that = this;
            var servcieName = "resolveBug2.php";
            var posts = {
                bugId:this.bugId,
                notes:notes,
                resolution:resolution
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    that.loadData();
                    this.displayFooterZone("service_f0"); 
                }    
                T.display(that);            
            }
            //alert(T.json2str(posts));
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,null);            
        },
        f1commonreply:function(e){
            var text = $("#service_f1_commonreply").val();
            $("#service_f1_notes").val(text);
        },
        f2commonreply:function(e){
            var text = $("#service_f2_commonreply").val();
            $("#service_f2_notes").val(text);
        }          
    } );
    return View;
} );
 