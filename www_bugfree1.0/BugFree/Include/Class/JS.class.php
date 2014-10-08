<?php
/**
 * JS class.
 *
 * BugFree is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * BugFree is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with BugFree; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @link        http://bugfree.1zsoft.com
 * @package     BugFree
 * @version     $Id: JS.class.php,v 1.5 2005/09/01 02:19:33 wwccss Exp $
 */
class JS
{
   /**
    *
    * @var boole
    */
    var $_Begined;

   /**
    *
    * @var booble
    */
    var $_Ended;

   /**
	* Init JS
	*/
	function JS()
	{
	    $this->_Begined = false;
	    $this->_Ended   = false;
    }

   /**
	* the start of javascript.
	*/
	function begin()
	{
	    if($this->_Begined)
	    {
	        return;
	    }
	    global $BugConfig;
	    echo <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type"     content="text/html; charset=$BugConfig[Charset]">
<meta http-equiv="Content-Language" content="$BugConfig[Charset]">
<title></title>
</head>
<body>
<script language="Javascript">
EOT;
    //$this->_Begined = true;
	}

   /**
	* the end of javascript.
	*
	*/
	function end()
	{
	    if($this->_Ended)
	    {
	        return;
	    }
	    else
	    {
	        echo "\n</script>\n</body>\n</html>";
	        //$this->_Ended = true;
	    }
	}

   /**
	* show a alert box.
	*
	* @param string $Text  the text to be showd in the alert box.
	*/
	function alert($Text)
	{
	    $this->begin();
		echo 'alert("' . $Text .'")';
		$this->end();
	}

   /**
	* show a confirm box, press ok go to URL1, else go to URL2.
	*
	* @param string $Text   the text to be showed.
	* @param string $URL1   the url to go to when press 'ok'.
	* @param string $URL2   the url to go to when press 'cancle'.
	* @param string $Target the name of the window to change location.
	*/
	function confirm($InfoText,$URL1,$URL2,$Target="self")
	{
	    $this->begin();
		echo <<<EOT
if(confirm("$InfoText"))
{
    if("$URL1" == "Back")
    {
        history.back(-1);
    }
    else
    {
        $Target.location = "$URL1";
    }
}
else
{
    if("$URL2" == "Back")
    {
        history.back(-1);
    }
    else
    {
    	$Target.location = "$URL2";
    }
}
EOT;
  	    $this->end();
	}

   /**
	* change the location of the $Target window to the $URL.
	*
	* @param string $URL
	* @param string $Target
	*/
	function goto($URL,$Target="self")
	{
	    $this->begin();
		if ($URL == "Back")
		{
			echo "history.back(-1)";
		}
		else
		{
			echo "$Target.location='$URL'";
		}
		$this->end();
	}

   /**
	* select an item of a select box.
	*
	* @param string $ObjName        the object name of the select box.
	* @param string $ItemValue      the value of the item to be selected.
	* @param string $FunctionName   the name of the function to create. If empty, execute directly.
	* @param booble $Echo           show directly or false.
	*/
	function selectOption($ObjName,$ItemValue,$FunctionName="",$Echo=false)
	{
		$JS = "    <script language='Javascript'>";
		if(!empty($FunctionName))
        {
            $JS .= "function $FunctionName(){";
        }
        $JS .="
        var Value='".$ItemValue."';
        for(I = 0;I < ".$ObjName.".options.length; I++)
        {
            if(Value.indexOf(',') >=0)
            {
                ValueList = Value.split(',');
                for(Y = 0;Y < ValueList.length;Y++)
                {
                    if(ValueList[Y] == ".$ObjName.".options[I].value)
                    {
                        ".$ObjName.".options[I].selected = true;
                    }
                }
            }
            else if(Value == ".$ObjName.".options[I].value)
            {
               ".$ObjName.".options[I].selected = true;
            }
        }";
        if(!empty($FunctionName))
        {
            $JS .= "}";
        }
        $JS .="
        </script>
        ";
		if($Echo)
		{
		    echo $JS;
		}
		return $JS;
	}
   /**
	* select an item of a group of radios.
	*
	* @param string $ObjName   the object name of the radios.
	* @param string $ItemValue the value of the item to be selected.
	* @param booble $Echo      show or false.
	*/
	function selectRadio($ObjName,$ItemValue,$Echo=false)
	{
		$JS =  '<script language="javascript">';
		$JS .= '
        for(I=0;I<'.$ObjName.'.length;I++)
        {
          if('.$ObjName.'[I].value == "'.$ItemValue.'")
          {
              '.$ObjName.'[I].checked=true;
          }
        }';
	    $JS .= "</script>\n";
	    return $JS;
	}

   /**
	* close current window.
	*
	*/
	function closeWindow()
	{
		echo "<script language=javascript>window.close();</script>";
	}
}
?>