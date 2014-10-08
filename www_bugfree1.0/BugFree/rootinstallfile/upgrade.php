<?php
/**
 * Upgrade program of BugFree system.
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
 * @version     $Id: upgrade.php,v 1.2 2005/09/24 12:06:07 wwccss Exp $
 */
/* Init BugFree system. */
require_once("Include/SetupBug.inc.php");

/* If user click the upgrade button, upgrade the database. */
if(!empty($_POST["Submit"]))
{
    /* The sql to create BugGroup table. */
    $SqlList[] = "CREATE TABLE BugGroup
                  (
                      GroupID   smallint(5) unsigned NOT NULL auto_increment,
                      GroupName varchar(60)          NOT NULL default '',
                      GroupUser text                 NOT NULL,
                      GroupACL  text                 NOT NULL,
                      LastDate  datetime             NOT NULL default '0000-00-00 00:00:00',
                      PRIMARY KEY  (GroupID)
                  ) TYPE=MyISAM";
    
    /* The sql to alter BugUser table. */
    $SqlList[] = "ALTER TABLE BugUser CHANGE UserID UserID SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT";
    foreach($SqlList as $SQL)
    {
        if(!$MyDB->query($SQL))
        {
            die($MyDB->errorMsg());
        }
    }
    
    /* Show the result info. */
    $MyJS->alert($TplConfig["Upgrade"]["Success"]);
    $MyJS->goto("Login.php");
    exit;
}
else
{
    /* Judge wether there's BugGroup table. */
    $ResultID      = $MyDB->query("SHOW TABLES LIKE 'BugGroup'");
    $BugGroupTable = $ResultID->fetchRow();
    if(!empty($BugGroupTable))
    {
        $TPL->assign("Upgraded", true);
    }
    
    /* Show upgrade steps note. */
    $TPL->display("Upgrade.tpl");
}
?>