<?php
//http://service.bsteel.com/BugFree1.0/rest/queryUsers2.php?pageIndex=2&pageSize=3
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");
    
    //$BugID = $_POST['BugID'];//$BugID = '0055571';
    $queryString = request('queryString'); //$UserName = "chenshiming";
    $pageIndex = request('pageIndex');//$PageNo=1;
    $pageSize = request('pageSize');
    //$queryString = $_REQUEST['queryString'];
    //$queryString = iconv("UTF-8","GB2312//IGNORE",$queryString);


    $SQL = "SELECT t.* FROM BugUser t  WHERE 1=1 ";
    if($queryString!=null && $queryString!=""){
        $SQL .=  " and (t.RealName LIKE '%{$queryString}%' OR t.UserName LIKE '%{$queryString}%')";
    }
 
    $SQL .= " ORDER BY UserID DESC ";
    //echo $SQL;
    //echo $pageIndex."//";
    //echo $pageSize;
    $FileList["datas"] = getListPageBySql($SQL,$pageIndex,$pageSize);
    $srModel = array();
    $srModel['resultFlag'] = "0";
    $srModel['resultMessage'] = "";
    $srModel['datas'] = array();
    foreach($FileList['datas'] as $key=>$m){
        $item = array();
        $item['userName'] = $m["UserName"];
        $item['realName'] = $m["RealName"];
        $srModel['datas'][] = $item;
    }
    echo(json_encode_bm($srModel));

?>