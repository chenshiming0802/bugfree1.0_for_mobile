<?php
//http://service.bsteel.com/BugFree1.0/rest/buginfos2.php?pageIndex=2&pageSize=3&isAssignMe=1
//http://service.bsteel.com/BugFree1.0/rest/buginfos2.php?userName=chenshiming&pageIndex=2&pageSize=3&queryString=307
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");

    $UserName = $_REQUEST['userName']; //$UserName = "chenshiming";
    $QueryID = $_REQUEST['queryId'];//$QueryID = "1";  //自定义查询ID from buginfo
    $IsAssignMe = $_REQUEST['isAssignMe'];//$IsAssignMe = "1";//最近5个指派给我的 Bug 参照bugfree登录左边的列表
    $IsMeCreate = $_REQUEST['isMeCreate'];//$IsMeCreate = "1";//最近5个由我创建的 Bug 参照bugfree登录左边的列表
    //$queryString = $_REQUEST['queryString'];
    $queryString = request('queryString');
    $pageIndex = $_REQUEST['pageIndex'];//$PageNo=1;
    $pageSize = $_REQUEST['pageSize'];
    $acls = rest_bugGetUserACL($UserName);  //获取用户权限信息
    //var_dump($pageSize);
    assertNotNull($UserName,"reqired username!","username_is_need");
    assertNotNull($pageIndex,"reqired pageIndex!","pageIndex_is_need");
    assertNotNull($pageSize,"reqired pageSize!","pageSize_is_need");

    if($QueryID==null && $IsAssignMe==null && $IsMeCreate==null && $queryString==null){
        assertNotNull(null,"reqired argument!","argument_is_need");
    }

    $SQL = "SELECT ";
    $SQL .=   "(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.AssignedTo) AssignedToRealUserName,";
    $SQL .=   "(SELECT MAX(a.RealName) FROM BugUser a WHERE a.UserName=t.OpenedBy) OpenedByRealUserName,";
    $SQL .= "t.* FROM BugInfo t";

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
    if($queryString!=null){
        $SQL .=  " and (BugTitle like '%{$queryString}%' or BugID like '%{$queryString}%')";
    }    

    $SQL .= " ORDER BY BugID DESC ";
    $FileList["datas"] = getListPageBySql($SQL,$pageIndex,$pageSize);
    //var_dump($pageIndex);var_dump($pageSize);
    $srModel = array();
    $srModel['resultFlag'] = "0";
    $srModel['resultMessage'] = "";
    $srModel['datas'] = array();
    //var_dump($FileList);
    foreach($FileList['datas'] as $key=>$m){
        $item = array();
        $item['bugTitle'] = $m["BugTitle"];
        $item['moduleName'] = $m["ModulePath"];
        $item['projectId'] = $m["ProjectID"];
        $item['projectName'] = $m["ProjectName"];
        $item['bugId'] = $m["BugID"];
        $item['assignedTo'] = $m["AssignedTo"];
        $item['assignedToRealUserName'] = $m["AssignedToRealUserName"];
        //$item['assignedDate'] = $m["AssignedDate"];
        $item['bugStatus'] = $m["BugStatus"];
        $item['openedBy'] = $m["OpenedBy"];//创建人
        $item['openedByRealUserName'] = $m["OpenedByRealUserName"];//创建人姓名
        $item['openedDate'] = $m["OpenedDate"];//创建时间
        $item['fixedTime'] = $m["FixedTime"];//期望完成时间
        $item['lastEditedDate'] = $m["LastEditedDate"];
        $srModel['datas'][] = $item;
    }       

    echo(json_encode_bm($srModel));

 
?>