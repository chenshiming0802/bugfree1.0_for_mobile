<?php
/**
 * HTML class.
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
 * @version     $Id: Html.class.php,v 1.6 2005/09/06 07:51:33 bugfree Exp $
 */
class Html
{
    /**
     * create tags like <a href="">text</a> 
     *
     * @param string $Text	    the link text.
     * @param string $URL	    the link url.
     * @param string $Target	the target window
     * @param booble $Echo      show directly or false.
     */
     function link($Text, $URL, $Target = "_self", $Echo = false)
     {
         $LinkString = '<A href="'.$URL.'" target="'.$Target.'">'.$Text.'</A>';
         $LinkString .= "\n";
         if($Echo)
         {
            echo $LinkString;
         }
         return $LinkString;
     }
   
    /**
     * create tags like "<select><option></option></select>"
     *
     * @param array  $ArrayData    the array to create select tag from.
     * @param string $SelectName   the name of the select tag.
     * @param string $Mode         Normal|Reverse,if normal, show the key of the array in the select box, else show the value of the array in the select box.
     * @param string $OnChange     the javascript script to excute when the select changed.
     * @param string $Multiple     the multiple choice limit.
     * @param booble $Echo         show directly or false.
     */
     function select($ArrayData,$SelectName,$Mode = "Normal",$OnChange = "",$Multiple = 0,$Echo = false)
     {
         if(!is_array($ArrayData))
         {
            return false;
         }
         
         $SelectString = "\n  <select name='$SelectName' id='$SelectName' ";
         if(eregi("\[",$SelectName))
         {
             $SelectName    = explode("[",$SelectName);
             $SelectString .= "id='$SelectName[0]' ";
         }
         if($Multiple > 0)
         {
             $SelectString .= " multiple='multiple' size='$Multiple' ";
         }
         if($OnChange != "")
         {
             $SelectString  .= "onChange=\"$OnChange\"";
         }
         $SelectString .=">\n";
         foreach ($ArrayData as $Key=>$Value)
         {
             if($Mode == "Normal")
             {
                 $SelectString .= "  <option value='$Value'>$Key</option>";
             }
             elseif($Mode == "Reverse")
             {
                 $SelectString .= "  <option value='$Key'>$Value</option>";
             }
             $SelectString .= "\n";
         }
         $SelectString .= "</select>\n";
         if($Echo)
         {
            echo $SelectString;
         }
         return $SelectString;
     }

  /**
   * create tags like "<radio></radio>"
   *
   * @param array  $ArrayData       the array to create radio tag from.
   * @param string $RadioName       the name of the radio tag.
   * @param string $Mode            Normal|Reverse,if normal, show the key of the array, else show the value of the array.
   * @param string $DefaultChecked  the value to checked by default.
   * @param string $OnChange        the javascript script to excute when the select changed.
   * @param booble $Echo            show directly or false.
   */
   function radio($ArrayData, $RadioName, $Mode = "Normal", $DefaultChecked = "", $OnChange = "", $Echo = false)
   {
       if(!is_array($ArrayData))
       {
          return false;
       }
       foreach($ArrayData as $Key => $Value)
       {
          if($Mode == "Reverse")
          {
              $SwitchTMP = $Value;
              $Value     = $Key;
              $Key       = $SwitchTMP;
          }
          
          $RadioString .= "<input type='radio' name='$RadioName' value='$Value'";
          
          if($Value == $DefaultChecked)
          {
              $RadioString .= " checked ";
          }
          $RadioString .=" >$Key\n";
       }
       return $RadioString;
   }
}
?>
