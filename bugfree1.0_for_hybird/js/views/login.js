// Category View
// =============
define([
	"jquery",
	"backbone"
], function( $, Backbone ) {
    
    var View = Backbone.View.extend( { 
        //构造初始化
        initialize: function() {
            this.username = "";
            this.password = "";
        },
        //设置UI的动作
        events: {
          "click #login_submit":  "loginSubmit"
        }, 
        //UI加载触发的方法       
        onLoad:function(viewName,params){  
            T.assertParamsLength(params,0);
            if(params.length>0&&params[0]=="logout"){
                localStorage.userName='';
                localStorage.userRealName='';
                localStorage.bugUserEmail='';
                localStorage.ucore1='';            
            }
            T.log(localStorage.ucore1);
            if(localStorage.ucore1!=null && localStorage.ucore1!=''){
                //已经登录过，直接进入画面
                this.toMainPage();
            }else{
                //登录画面
                $.mobile.changePage("#"+viewName, {
                    reverse: false,
                    changeHash: false
                });
                this.render(null);                 
            }
        },
        //渲染UI界面
        render:function(collection){
        },
        loginSubmit:function(){
            this.username = $("#login_username").val();
            this.password = $("#login_password").val();
            T.log("login:"+this.username+"/"+this.password);
            var that = this;
            var servcieName = "dologin2.php";
            var posts = {
                userName:this.username,
                userPassword:this.password
            };
            var successFunction = function(json){
                if(json.resultFlag=="0"){
                    localStorage.userName=json.userName;
                    localStorage.userRealName=json.userRealName;
                    localStorage.bugUserEmail=json.bugUserEmail;
                    localStorage.ucore1=json.ucore1;
                    that.toMainPage();
                }                
            };
            var errorFunction = function(errorCode,errorMessage){
                alert("登录失败，失败原因:"+errorCode);
            };
            T.getRemoteJsonByProxy(this,servcieName,posts,successFunction,errorFunction);
        },
        toMainPage:function(){
            T.redirect("#services?assignme");
        }
    } );
    return View;
} );
 