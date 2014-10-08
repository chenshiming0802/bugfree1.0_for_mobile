<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
{literal}
<script language="Javascript">
function expandLeft()
{
    var MainFrame = parent.document.getElementById('MainFrame');
    var Control   = document.getElementById("ControlLeft");
    if(MainFrame.cols == "220,10,*")
    {
        MainFrame.cols = "0,10,*";
        Control.src    = "Images/ArrowRight.gif";
    }
    else
    {
        MainFrame.cols = "220,10,*";
        Control.src    = "Images/ArrowLeft.gif";
    }
}
function expandTop()
{
    var RightFrame = parent.document.getElementById('RightFrame');
    var Control    = document.getElementById("ControlTop");
    if(RightFrame.rows == "150,*")
    {
        RightFrame.rows = "0,*";
        Control.src     = "Images/ArrowDown.gif";
    }
    else
    {
        RightFrame.rows = "150,*";
        Control.src     = "Images/ArrowUp.gif";
    }
}
function expandBottom()
{
    var LeftFrame = parent.document.getElementById('LeftFrame');
    var Control   = document.getElementById("ControlBottom");
    if(LeftFrame.rows == "*,270")
    {
        LeftFrame.rows = "*,0";
        Control.src    = "Images/ArrowUp.gif";
    }
    else
    {
        LeftFrame.rows = "*,270";
        Control.src    = "Images/ArrowDown.gif";
    }
}
</script>
{/literal}
</head>
<body topmargin="0" marginheight="0" leftmargin="0" marginwidth="0">
<table height="100%" width="10" align="center" cellpadding="0" cellspacing="0" border="0" style="cursor:hand">
  <tr valign="top"    align="center"><td onclick="expandTop()">     <img id="ControlTop"    src="Images/ArrowUp.gif"   /></td></tr>
  <tr valign="middle" align="center"><td onclick="expandLeft();">   <img id="ControlLeft"   src="Images/ArrowLeft.gif" /></td></tr>
  <tr valign="bottom" align="center"><td onclick="expandBottom();"> <img id="ControlBottom" src="Images/ArrowDown.gif" /></td></tr>
</table>
</body>
</html>