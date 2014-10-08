<table width="98%" align="center" border="0" cellpadding="1" cellspacing="0" class="BgTable">
  <tr class="BgRow">
    <td align="center">
     <fieldset>
     <legend>{$TplConfig.BugInfo.HistoryTitle}</legend>
     <div align="left">
       <ol>
       {foreach from=$HistoryList item=HistoryInfo}
         <li>
           {$HistoryInfo.ActionDate}
           <span class="StrongText">{$HistoryInfo.Action}</span> BY 
           <span class="StrongText">{$HistoryInfo.UserName}</span><br>
           {if $HistoryInfo.FullInfo}
           <div class="History">{$HistoryInfo.FullInfo}</div>
           {else}
           <br>
           {/if}
         </li>
       {/foreach}
      </ol>
     </div>
     </fieldset>
   </td>
 </tr> 
</table>