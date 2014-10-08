<?php
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");

    $queryString = $_POST['queryString']; //$UserName = "chenshiming";
    $PageNo = $_POST['PageNo'];$PageNo=1;
    //$PageSize = $_POST['PageSize'];
    $PageSize =20;
 

    $SQL = "SELECT * FROM BugInfo ";

    if($queryString==false){
        $SQL .= " where QueryTitle like '%{$queryString}%' or BugID like '%{$queryString}%'";
    }  

    $SQL .= " ORDER BY BugID DESC ";
    $FileList["datas"] = getListPageBySql($SQL,$PageNo,$PageSize);
    echo(json_encode_bm($FileList));

 
?>