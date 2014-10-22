/*本项目用的工具类，不具有其他项目使用的特性*/
var A = {
	pageSize:20,
	displayFooter:function(view,currentPageId){
	    var f = $("script#common_footer_template").html(); 
	    view.$el.append(f); 
	    view.$el.find("."+currentPageId).addClass("active");
	},
	redFooterIcon:function (view,viewName, params) {
	    if (viewName=="services" && params[0] == "assignme") {  
	        currentPageId = "common_footer_assignme";
	        $("."+currentPageId).addClass("active");
	        view.$el.find("."+currentPageId).addClass("active");
	    } else if (viewName=="services" && params[0] == "mecreate") {      
	        currentPageId = "common_footer_mecreate";
	        $("."+currentPageId).addClass("active");
	        view.$el.find("."+currentPageId).addClass("active");
	    } else if (viewName=="profile") {   
	        currentPageId = "common_footer_profile";
	        $("."+currentPageId).addClass("active");
	        view.$el.find("."+currentPageId).addClass("active");
	    }   
	},
	/*
	checkLogin:function(){
		var user = this.getUserSummary();
		if(user==null){
            $.mobile.changePage("#login", {
                reverse: false,
                changeHash: false
            });	
            throw new Error(0,"");
		}
	},
	*/
	getUserSummary:function(){
		if(localStorage.ucore1==null || localStorage.ucore1==''){
			return null;
		}else{
			return {
				"userName":localStorage.userName,
				"userRealName":localStorage.userRealName,
				"bugUserEmail":localStorage.bugUserEmail,
				"ucore1":localStorage.ucore1
			};			
		}	
	},
    assertHasLogin:function (){
        if(this.getUserSummary()==null){
           T.redirect("#login");
            return false;                   	
        }
    },	
};