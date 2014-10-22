<html>
<head></head>
<body>
 
<form 
	name="xx" 
	method="post" 
	enctype="multipart/form-data" 
	action="http://127.0.0.1:82/BugFree/rest/uploadBugFile2.php">
	bugId:<input type="text" name="bugId" value="0000004"><BR>
	userName:<input type="text" name="userName" value="chenshiming"><BR>
	bugId:<input type="file" name="BugFileName[]"><BR>
	<input type="submit" value="Submit!">
</form>
</html>