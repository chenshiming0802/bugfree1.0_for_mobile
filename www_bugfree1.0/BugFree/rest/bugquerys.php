<?php
    require_once("include_SetupBug.inc.php");
    require_once("include_FunctionsMain.inc.php");
 
    $UserName = $_POST['UserName'];//$UserName = "chenshiming";

    $list["datas"] = getListBySql("SELECT * FROM BugQuery where UserName='{$UserName}'");
    echo(json_encode_bm($list));

?>