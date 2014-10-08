<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset={$BugConfig.Charset}">
<meta http-equiv="Content-Language" content="{$BugConfig.Charset}">
<link href="Include/LangFile/{$BugConfig.Language}{$CssStyle}.css" rel="stylesheet" type="text/css">
<title>{$BugConfig.Title}</title>
</head>
<frameset cols="220,10,*" name="MainFrame" id="MainFrame" frameborder="no" border="0" framespacing="0">
  <frameset rows="*,270"  name="LeftFrame" id="LeftFrame" frameborder="no" border="0" framespacing="0"> 
    <frame src="ListModule.php"  name="LeftTopFrame"    id="LeftTopFrame"    scrolling="auto" noresize>
    <frame src="UserControl.php" name="LeftBottomFrame" id="LeftBottomFrame" scrolling="no"   noresize>
  </frameset>
  <frame src="ControlFrame.php" name="ControlFrame" id="ControlFrame" scrolling="no" noresize>
  <frameset rows="150,*" cols="*"  name="RightFrame"       id="RightFrame"    framespacing="0" frameborder="no" border="0">
    <frame src="QueryBugForm.php"  name="RightTopFrame"    id="RightTopFrame"    noresize>
    <frame src="{$RightBottomURL}" name="RightBottomFrame" id="RightBottomFrame" noresize>
  </frameset>
</frameset>
<noframes>
  <body>
    {$TplConfig.Index.NotSupportFrame}
  </body>
</noframes>
</html>