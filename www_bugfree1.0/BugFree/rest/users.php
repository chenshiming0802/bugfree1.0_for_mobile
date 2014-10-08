<?php
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");
    
    $BugID = $_POST['BugID'];//$BugID = '0055571';
    $queryString = $_POST['queryString']; //$UserName = "chenshiming";
    $PageNo = $_POST['PageNo'];$PageNo=1;
    //$PageSize = $_POST['PageSize'];
    $PageSize =20;

    $SQL = "SELECT t.* FROM BugUser t  WHERE 1=1 ";
    if($queryString!=null && $queryString!=""){
        $SQL .=  " and t.RealName LIKE '%{$queryString}%' OR t.UserName LIKE '%{$queryString}%'";
    }

    $SQL .= " ORDER BY UserID DESC ";
    $FileList["datas"] = getListPageBySql($SQL,$PageNo,$PageSize);
    echo(json_encode_bm($FileList));

?>