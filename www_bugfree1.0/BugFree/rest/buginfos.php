<?php
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");

    $UserName = $_POST['UserName']; //$UserName = "chenshiming";
    $QueryID = $_POST['QueryID'];//$QueryID = "1";  //自定义查询ID from buginfo
    $IsAssignMe = $_POST['IsAssignMe'];//$IsAssignMe = "1";//最近5个指派给我的 Bug 参照bugfree登录左边的列表
    $IsMeCreate = $_POST['IsMeCreate'];//$IsMeCreate = "1";//最近5个由我创建的 Bug 参照bugfree登录左边的列表
    $PageNo = $_POST['PageNo'];$PageNo=1;
    //$PageSize = $_POST['PageSize'];
    $PageSize =20;

    $acls = rest_bugGetUserACL($UserName);  //获取用户权限信息

    $SQL = "SELECT * FROM BugInfo ";
    //自定义查询条件
    $hasWhere = false;
    if($QueryID!=null){
        $model = getRowBySql("select t.* from BugQuery t where t.QueryID='{$QueryID}' and UserName='{$UserName}'");
        if($model!=null){
            $SQL .= $model['QueryString'];
            $hasWhere = true; 
        }       
    }
    if($hasWhere==false){
        $SQL .= ' WHERE 1=1  ';
    }  
    // 当前用户的权限过滤
    if($acls[1]!=null){
       $SQL .= ' and '. $acls[1];
    }  
    //最近5个指派给我的 Bug  参照bugfree登录左边的列表
    if($IsAssignMe!=null && $IsAssignMe=="1"){
        $SQL .=  " and AssignedTo = '{$UserName}' and BugStatus != 'Closed'";
    }
    //最近5个由我创建的 Bug  参照bugfree登录左边的列表
    if($IsMeCreate!=null && $IsMeCreate=="1"){
        $SQL .=  " and OpenedBy = '{$UserName}' AND BugStatus != 'Closed' ";
    }

    $SQL .= " ORDER BY BugID DESC ";
    $FileList["datas"] = getListPageBySql($SQL,$PageNo,$PageSize);
    /*foreach($FileList['datas'] as $key=>$model){
        foreach($model as $kk=>$vv){
            $FileList['datas'][$key][$kk] = iconv("GB2312","UTF-8//IGNORE",$vv);
        }
    }
    echo(json_encode($FileList));*/
    echo(json_encode_bm($FileList));

 
?>