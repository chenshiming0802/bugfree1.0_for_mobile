{if $FileFormMode}
<tr class="BgRow">
  <td width="15%" class="StrongText">{$TplConfig.AddBugForm.SelectFile}</td>
  <td>
    {foreach from=$BugConfig.File.MaxAddFilesCount item=FileNO}
     <input type="file" name="{$BugConfig.File.BugFileName}[]" style="width:300" class="MyInput">
     {$TplConfig.AddBugForm.SetFileName}
     <input type="text" name="FileTitle[]" style="width:150" class="MyInput">
    <br />
    {/foreach}
  </td>
</tr>
{else}
<tr class="BgRow">
  <td align="right">{$TplConfig.AddBugForm.BugFiles}</td>
  <td>
    {foreach from=$BugConfig.File.MaxAddFilesCount item=FileNO}
    {$TplConfig.AddBugForm.SelectFile} <input type="file" name="{$BugConfig.File.BugFileName}[]" style="width:300" class="MyInput">
    {$TplConfig.AddBugForm.SetFileName}<input type="text" name="FileTitle[]"                     style="width:150" class="MyInput">
    <br />
    {/foreach}
  </td>
</tr>
{/if}