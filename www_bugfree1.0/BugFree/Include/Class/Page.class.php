<?php
/**
 * DB record pager class.
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
 * @version     $Id: Page.class.php,v 1.5 2005/09/01 02:19:33 wwccss Exp $
 */
class Page
{
   /**
    * the object of the ADO class.
    * @var Object
    */
    var $_MyDB;

   /**
    * the total record count.
    * @var int
    */
    var $_RecTotal;
    
   /**
    * the count of the record per page.
    * @var int
    */
    var $_RecPerPage;
    
   /**
    * the total count of pages.
    * @var int
    */
    var $_PageTotal;
    
   /**
    * ID number of current page.
    * @var int
    */
    var $_PageID;
    
   /**
    * the link url.
    * @var string
    */
    var $_URL;
    
   /**
    * the table name to query from.
    * @var string
    */
    var $_TableName;
   
   /**
    * the condition string to query.
    * @var string
    */
    var $_Where;
    
   /**
    * init the class.
    */
    function Init($TableName,$RecTotal="",$RecPerPage=20,$PageID,$URL="",$Where="")
    {
        global $MyDB;
        
        //设置数据库连接对象。
        $this->_MyDB = $MyDB;
        
        //设定进行分页统计的表名。
        $this->_TableName = !empty($TableName)?$TableName:die("请指定表名");

        //设定分页条件。
        $this->_Where = $Where;
        
        //设定记录总数。
        !empty($RecTotal)?$this->_RecTotal = $RecTotal:$this->getRecTotal();
        
        //默认每页显示记录为20条。
        $this->_RecPerPage = ($RecPerPage > 0)?$RecPerPage:20;
        
        //设置分页总数。
        $this->getPageTotal();
        
        //设定当前页面编号。
        $this->_PageID = ($PageID > 0)?$PageID:$this->getPageTotal();
        
        //设定URL链接地址。
        $this->_URL = !empty($URL)?$URL:$_SERVER["PHP_SELF"];
        
        //判断变量传递方式。如果原来的URL地址里面有"?"，则使用"&"追加变量，否则则使用"?"
        $this->_URL .= !eregi("\?",$this->_URL)?"?":"&";
        
        //传递记录总数。
        $this->_URL .= "RecTotal=".$this->_RecTotal."&";
   }
   
   /**
    * 获得当前的页面编号。 
    */
    function getPageID()
    {
        return $this->_PageID;
    }
   
   /**
    * 取得某一条件查询结果的记录总数。
    *
    */
    function getRecTotal()
    {
        $SQL     = "SELECT COUNT(*) AS RecTotal FROM $this->_TableName $this->_Where";
        $DataSet = $this->_MyDB->getRow($SQL);
        if($DataSet["RecTotal"] > 0)
        {
            $this->_RecTotal = $DataSet["RecTotal"];
        }
        else
        {
            $this->_RecTotal = 0;
        }
    }
    
   /**
    * 获得分页总数。
    *
    * @return int          记录分页总数。
    */
    function getPageTotal()
    {
        //设置分页总数。
        $this->_PageTotal = ceil($this->_RecTotal / $this->_RecPerPage);
        return $this->_PageTotal;
    }
    
   /**
    * 显示查询结果的分页链接。
    *
    * @return string               返回导航条文字。
    * @param  int    $SectionMax   分页条区间长度。默认值为15，必须为奇数。
    * @param  string $Align        对其方式，默认为居中对齐。left|center|right
    * @param  booble $JsOut        是否以JS脚本的形式输出。
    */
    function Show($SectionMax = 15,$Align="center",$JsOut = false)
    {
        //定义样式表信息，通过JS脚本的形式输出，增加这个类文件的独立性。
        $StyleString = <<<EOT
<script language="JavaScript">
document.write("<style type='text/css'>.Pager {text-decoration: none;font-family: 'Tahoma';font-size: 9pt;}");
document.write(".PagerSmall{font-family: 'Courier New';font-size: 9pt;}");
document.write(".BoldText {font-family: 'Tahoma';font-size: 10pt;color: #CCCCCC;background-color: #003300;}</style>");
</script>
EOT;
        //定义表格头和表格结束HTML代码。
        $TableBegin .= "\n<table bgcolor='#999999' border='0' cellspacing='1' cellpadding='0' class='Pager' align='$Align'>\n<tr bgcolor='#E4E4E4' align='center' title='Record:$this->_RecTotal
Page:$this->_PageTotal'> \n";
        $TableEnd   = "</tr>\n</table>\n";
        
        //定义链接符号。
        $FirstPage = "<font face='Webdings'>9</font>";
        $EndPage   = "<font face='Webdings'>:</font>";
        $PrePage   = "<font face='Webdings'>7</font>";
        $NextPage  = "<font face='Webdings'>8</font>";
        
        //判断SectionMax是否是奇数，如果不是奇数，则加1。
        if($SectionMax % 2 == 0)
        {
            $SectionMax ++;
        }
        
        //建立一个数组，其数值从PageTotal降序排列。
        $Y = 1;
        for($I=$this->_PageTotal;$I>=1;$I--)
        {
            $PageIdList[$Y] = $I;
            $Y ++;
        }

        //如果页码总数为零，则直接退出。
        if($this->_RecTotal == 0)
        {
            $LinkString = $TableBegin."<td style='font-size:9pt'>Sorry, no record yet</td>\n";
            $LinkString .= $TableEnd;
            return $LinkString;
        }
        
        //链接文字条开始。
        $LinkString = $TableBegin;
        
        /**
         * 显示记录总数。
         */
        $LinkString .= "<td class='PagerSmall'>Record:$this->_RecTotal</td>";
        
        /**
         * 生成第一页的链接。(对应正常分页的最后一页。)
         */
        //如果是最后一页，只显示文字，不生成链接。
        if($this->_PageID == $this->_PageTotal)
        {
            $LinkString .= $this->createTD($FirstPage,"BoldText");
        }
        else
        {
            $LinkString .= $this->createTD($this->Link($FirstPage,$this->_URL."PageID=".$this->_PageTotal));
        }
        
        /**
         * 判断前一页的链接。
         */
        //如果是最后一页，则只显示文字，不生成链接。
        if($this->_PageID == $this->_PageTotal)
        {
            $LinkString .= $this->createTD($PrePage,"BoldText");
        }
        else
        {
            $LinkString .= $this->createTD($this->Link($PrePage,$this->_URL."PageID=".($this->_PageID + 1)));
        }
        
        /**
         * 生成中间页码的链接。
         */
        //最后一页的情况，实际上是从最后一页开始倒数15。
        if($this->_PageID == $this->_PageTotal)
        {
            for($I = $this->_PageTotal;$I > ($this->_PageTotal - $SectionMax) and $I > 0;$I --)
            {
                if($I != $this->_PageTotal)
                {
                    $LinkString .= $this->createTD($this->Link($PageIdList[$I],$this->_URL."PageID=".$I));
                }
                else
                {
                    $LinkString .= $this->createTD($PageIdList[$I],"BoldText");
                }
            }
        }
        //第一页的情况,实际是从第一页正数$SectionMax。
        elseif($this->_PageID == 1)
        {
            if($this->_PageTotal < $SectionMax)
            {
                $PageStart = $this->_PageTotal;
            }
            else
            {
                $PageStart = $SectionMax;
            }
            for($I = $PageStart ; $I >= 1; $I --)
            {
                if($I != 1)
                {
                    $LinkString .= $this->createTD($this->Link($PageIdList[$I],$this->_URL."PageID=".$I));
                }
                else
                {
                    $LinkString .= $this->createTD($PageIdList[$I],"BoldText");
                }
            }
        }
        //中间页码的情况。
        else
        {
            $PageStart = $this->_PageID + ($SectionMax - 1) /2;
            if($PageStart > $this->_PageTotal)
            {
                $PageStart = $this->_PageTotal;
            }
            $PageEnd = $this->_PageID - ($SectionMax - 1) /2;
            if($PageEnd != $PageStart - $SectionMax)
            {
                $PageEnd = $PageStart - $SectionMax + 1;
            }
            if($PageEnd < 1)
            {
                $PageEnd = 1;
            }
            if($PageStart != $PageEnd + $SectionMax)
            {
                $PageStart = $PageEnd + $SectionMax - 1;
            }
            if($PageStart > $this->_PageTotal)
            {
                $PageStart = $this->_PageTotal;
            }
            for($I = $PageStart;$I >= $PageEnd;$I --)
            {
                if($I != $this->_PageID)
                {
                    $LinkString .= $this->createTD($this->Link($PageIdList[$I],$this->_URL."PageID=".$I));
                }
                else
                {
                    $LinkString .= $this->createTD($PageIdList[$I],"BoldText");
                }
            }
        } 
        
        /**
         * 生成下一页的链接。  
         */
        //如果是第一页，则只显示文字，不生成链接。
        if($this->_PageID == 1)
        {
             $LinkString .= $this->createTD($NextPage,"BoldText");
        }
        else
        {
            $LinkString .= $this->createTD($this->Link($NextPage,$this->_URL."PageID=".($this->_PageID - 1)));
        }
        
        /**
         * 生成最后一页的链接。
         */
        if($this->_PageID == 1)
        {
            $LinkString .= $this->createTD($EndPage,"BoldText");
        }
        else
        {
            $LinkString .= $this->createTD($this->Link($EndPage,$this->_URL."PageID=1"));
        }
        
        /**
         * 显示页面总数。
         */
        $LinkString .= "<td class='PagerSmall'>Page:$this->_PageTotal</td>";
        
        $LinkString .= $TableEnd;
        
        //判断输出方式。        
        if($JsOut)
        {
            //将LinkString用换行符分开，然后做循环，用document.write括起来。输出为JS脚本的形式。
            $LinkString = explode("\n",$LinkString);
            for($I = 0; $I < count($LinkString);$I ++)
            {
                if(!empty($LinkString[$I]))
                {
                    $LinkString[$I] = 'document.write("'.$LinkString[$I].'")'.";\n";
                }
            }
            $LinkString = join('',$LinkString);
            return $StyleString."<script>\n".$LinkString."</script>";
        }
        else
        {
            return $StyleString.$LinkString;
        }
     }
   
   /**
    * 生成SQL查询语句的Limit部分
    *
    * Thanks to lixiaoliang@gmail.com and panzs@supcon.com for their advice of LIMIT -20,20
    * @return string          Limit语句。
    */
    function Limit()
    {
        //保证最后一页查出的记录数为RecPerPage。加上不等于1的限制是为了防止出现limit -20,10这样的情况。
        if($this->_RecTotal < $this->_RecPerPage)
        {
	        $Limit = " LIMIT 0,".$this->_RecTotal;
        }
        elseif($this->_PageID == $this->_PageTotal and $this->_PageTotal != 1)
        {
            $Limit = " LIMIT ".($this->_RecTotal - $this->_RecPerPage).",".$this->_RecPerPage;
        }
        else
        {
            $Limit = " LIMIT ".$this->_RecPerPage * ($this->_PageID - 1).",".$this->_RecPerPage;
        }
        return $Limit;
    }
    
    /**
     * 生成<a href="">text</a>标记。
     *
     * @param string $Text	    链接文字。
     * @param string $URL	    链接地址。
     */
     function link($Text,$URL)
     {
         $LinkString = "<A href='".$URL."'>".$Text."</A>";
         return $LinkString;
     }
     
    /**
     * 生成TD代码。
     *
     * @param string $Text	    链接文字。
     * @param string $URL	    链接地址。
     * @return string           生成的TD代码。
     */
     function createTD($Text,$CssStyle="Pager")
     {
        return "<td class='".$CssStyle."' width='20'>$Text</td>\n";
     }
}
?>