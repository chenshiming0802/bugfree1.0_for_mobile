<?php
header("Content-Type: text/json; charset=utf-8");
header("Cache-Control:no-cache");
l("");
init();

function request($key,$defaultValue=null){

     $value = iconv("UTF-8","GB2312//IGNORE",$_REQUEST[$key]);
     if($value==null){
        $value = $defaultValue;
     }
     return $value;
}
function assertNotNull($value,$errorMessage,$errorCode){
    if($value==null || $value==''){
        $srModel = array();
        $srModel['resultFlag'] = "1";
        $srModel['resultMessage'] = $errorMessage;
        $srModel['resultMessageCode'] = $errorCode;
        echo(json_encode_bm($srModel));
        die();
    }
}

function json_encode_bm($array){
    $array = array_bianma($array);
    return json_encode($array);
}

function array_bianma($array){
    if(is_array($array)){
        foreach($array as $key=>$value){
            if(is_array($value)){
                $array[$key] = array_bianma($value);    
            }else{
                $array[$key] = iconv("GB2312","UTF-8//IGNORE",$value);  //todo gb2312配置
                //echo "[".$key.':'.$value."]";
            }    
        }        
    }
    return $array;
}

//to fix php<5.2 not support json_encode
if (!function_exists('json_decode')) {
    function json_decode($content, $assoc=false) {
        require_once 'JSON.php';
        if ($assoc) {
            $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        }
        else {
            $json = new Services_JSON;
        }
        return $json->decode($content);
    }
}
if (!function_exists('json_encode')) {
    function json_encode($content) {
        require_once 'JSON.php';
        $json = new Services_JSON;
        return $json->encode($content);
    }
}


function init(){
    if(true){
        l('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
        foreach($_POST as $key=>$value){
            l('    '.$key."=".$value);
        }          
    }
}

function l($content){
        //$file_name = "/home/bugfree/BugFree1.0/rest/logs/log.dat";
        $file_name = "c://log.dat";
        $file_pointer = fopen($file_name, "a");
        fwrite($file_pointer, $content."\r\n"); 
        fclose($file_pointer);   
}
function querySql($SQL){
    l("querySql:".$SQL);    
    global $MyDB;
    return $MyDB->query($SQL);
}

//查询第一条记录信息
function getRowBySql($SQL){
    global $MyDB;
    //echo $SQL."<HR>";
    $ResultID = $MyDB->query($SQL);
    l("getRowBySql:".$SQL);
    if($ResultID){
        if($FileInfo = $ResultID->fetchRow()){
            return $FileInfo;
        }
    }    
    return null;
}
//根据sql查询list数据 如果listKey不为空，则作为list的key信息
function getListBySql($SQL,$listKey=null){
    global $MyDB;
    //echo $SQL."<HR>";
    //l($SQL);
    $list = array();
    $MyDB->query("SET NAMES 'latin1'"); 
    $ResultID = $MyDB->query($SQL);
    l("getListBySql:".$SQL);
    if($ResultID){
        while($FileInfo = $ResultID->fetchRow()){
            if($listKey!=null){
               $list[$FileInfo[$listKey]] = $FileInfo;    
            }else{
                $list[] = $FileInfo;
            }  
        }
    }    
    return $list;    
}
//根据sql查询list数据 如果listKey不为空，则作为list的key信息
function getListPageBySql($SQL,$pageNo,$pageSize,$listKey=null){
   $SQL .= " limit ". (($pageNo-1)*$pageSize) . ',' . ($pageSize);
   //echo $SQL."<HR>";
   return getListBySql($SQL,$listKey);
}


//copy from FunctionsMain.inc.php 
function rest_bugJudgeUser($BugUserName = "",$BugUserPWD = "")
{
    global $MyJS;
    global $BugConfig;

    $DBName = !empty($BugConfig["UserDB"]) ? "MyUserDB" : "MyDB";
    global $$DBName;

    if(!empty($BugUserName) and !empty($BugUserPWD))
    {
        // Register user password to session, thus it can be passed in the export page.
        $_SESSION["BugUserPWD"]   = $BugUserPWD;

        // Encrypt the password.
        $BugUserPWD = bugEncryptUserPWD($BugUserPWD);

        // The query sql.
        $SQL      = " SELECT " . $BugConfig["UserTable"]["UserName"] . " AS UserName,
                             " . $BugConfig["UserTable"]["RealName"] . " AS RealName,
                             " . $BugConfig["UserTable"]["Email"]    . " AS Email
                        FROM " . $BugConfig["UserTable"]["TableName"]. "
                       WHERE " . $BugConfig["UserTable"]["UserName"]     . " = '$BugUserName' AND
                             " . $BugConfig["UserTable"]["UserPassword"] . " = " . $BugUserPWD ;
        $ResultID = $$DBName->query($SQL);
        if($ResultID)
        {
            $BugUserInfo = $ResultID->fetchRow();
            if(empty($BugUserInfo))
            {
                return false;
            }
            else
            {
                $_SESSION["BugUserName"]  = $BugUserInfo["UserName"];
                $_SESSION["BugRealName"]  = $BugUserInfo["RealName"];
                $_SESSION["BugUserEmail"] = $BugUserInfo["Email"];

                // If the user is Admin, then register session var IsAdminUser to ture.
                if(in_array($BugUserInfo["UserName"],$BugConfig["AdminUser"]))
                {
                    $_SESSION["IsAdminUser"] = true;
                }
                else
                {
                    $_SESSION["IsAdminUser"] = false;
                }
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    if(empty($_SESSION["BugUserName"]))
    {
        return false;
    }
}


//copy from FunctionsMain.inc.php 
function rest_bugGetUserACL($BugUserName)
{
    global $MyDB;
    global $BugConfig;
    global $MyJS;

 

    /* If the user is admin, assign all projects' access to him. */
    if(false && $_SESSION["IsAdminUser"])
    {
        $SQL = "SELECT ProjectID FROM BugProject ORDER BY ProjectID";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            while($ProjectInfo = $ResultID->fetchRow())
            {
                $UserACL[$ProjectInfo["ProjectID"]] = "All";
            }
        }
    }
    /* If common user, query from BugGroup table. */
    else
    {
        $SQL = "SELECT * FROM BugGroup WHERE GroupUser LIKE '%,$BugUserName,%'";
        $ResultID = $MyDB->query($SQL);
        if($ResultID)
        {
            $UserACL = array();
            while($GroupInfo = $ResultID->fetchRow())
            {
                /* User ACL inherits from group ACL. */
                $GroupACL = unserialize($GroupInfo["GroupACL"]);
                if(is_array($GroupACL))
                {
                    $UserACL  = $UserACL + $GroupACL;    // Merge acl.
                }
            }
        }
        else
        {
            return null;
        }
    }

    /* Registe to session. */
    if(!empty($UserACL))
    {
        $UserACL   = $UserACL;
        $BugUserAclSQL = "ProjectID " . dbCreateIN(@join(",", @array_keys($UserACL)));    // To used in query.
        return array($UserACL,$BugUserAclSQL);
    }
    /* If no ACL, go to login page. */
    else
    {
        return null;
    }
}



function rest_bugAddFile($userName,$ProjectID,$BugIdList)
{
    global $MyDB;
    global $BugConfig;
    global $TplConfig;

    // Explode the BugIdList to array.
    $BugIdList = explode(",",$BugIdList);

    // Get uploaded files array.
    $BugFileList = $_FILES[$BugConfig["File"]["BugFileName"]];

    // Init the return array ResultInfo.
    $ResultInfo["Success"] = true;

    // Cycle the array, deal with every file.
    for($I = 0 ; $I < count($BugFileList["name"]); $I ++)
    {
        if(!empty($BugFileList["name"][$I]))
        {
            // Set file title.
            if(!empty($_POST["FileTitle"][$I]))
            {
                $FileTitle = $_POST["FileTitle"][$I];
            }
            else
            {
                $FileTitle = $BugFileList["name"][$I];
            }

            // Push FileTitle to $FileTitleList.
            $FileTitleList[] = $FileTitle;

            // Get fize size.
            $FileSize = $BugFileList["size"][$I];

            // Judge the fize.
            if($FileSize > $BugConfig["File"]["MaxFileSize"])
            {
                $ResultInfo["Success"]     = false;
                $ResultInfo["ErrorInfo"][] = $FileTitle . ":Size exceed,max size:".$BugConfig["File"]["MaxFileSize"].",current size:".$FileSize ;
                continue;
            }
            // Change file size to human type.
            else
            {
                if($FileSize <= 1024 * 1024 )
                {
                    $FileSize = round($FileSize / 1024,2) . "KB";
                }
                else
                {
                    $FileSize = round($FileSize / (1024 * 1024),2) . "MB";
                }
            }

            // Get file type.
            $FileType = explode(".",$BugFileList["name"][$I]);
            $FileType = strtolower($FileType[1]);

            // Change dangerous file to txt.
            if(in_array($FileType,$BugConfig["File"]["DangerousTypeList"]) or empty($FileType))
            {
                $FileType = "txt";
            }

            // Create dir to store all uploaded files of this project.
            $PartProjectPath = "Project". $ProjectID;
            $FullProjectPath = $BugConfig["ScriptDir"] . "/../" . $BugConfig["File"]["UploadDirectory"] . "/" . $PartProjectPath;
            if(!is_dir($FullProjectPath))
            {
                if(!@mkdir($FullProjectPath))
                {
                    $ResultInfo["Success"]     = false;
                    $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCreateDIR"] . ": " . $FullProjectPath;
                    return $ResultInfo;
                }
            }

            // Make directory under the project directory to store today uploaded files.
            $PartTodayPath   = date("Ym");
            $FullTodayPath   = $FullProjectPath . "/" .$PartTodayPath;
            if(!is_dir($FullTodayPath))
            {
                if(!@mkdir($FullTodayPath))
                {
                    $ResultInfo["Success"]     = false;
                    $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCreateDIR"] . ": " . $FullTodayPath;;
                    return $ResultInfo;
                }
            }

            // Copy file
            $PartFileName = date("His") . $I . "." .$FileType;
            $FullFileName = $PartProjectPath . "/" . $PartTodayPath . "/" . $PartFileName;
            if(!@copy ($BugFileList["tmp_name"][$I],$FullTodayPath . "/" . $PartFileName))
            {
                $ResultInfo["Success"]     = false;
                $ResultInfo["ErrorInfo"][] = $TplConfig["AddBug"]["CantCopyFile"] . ": " . $FullFileName;
                continue;
            }

            // Insert into BugFile table.
            foreach($BugIdList as $BugID)
            {
                $SQL = "INSERT INTO BugFile(BugID,FileTitle,FileName,FileType,FileSize,AddUser,AddDate) VALUES(
                                            '$BugID','$FileTitle','$FullFileName','$FileType','$FileSize','{$userName}',now())";
                if(!$MyDB->query($SQL))
                {
                    die($MyDB->errorMsg());
                }
            }

            // Delete the temp file.
            @unlink($BugFileList["tmp_name"][$I]);
        }
    }

    // Return.
    if($ResultInfo["Success"])
    {
        $ResultInfo["Success"]  = true;
        $ResultInfo["FileList"] = @join(",",$FileTitleList);
    }
    return $ResultInfo;
}
?>