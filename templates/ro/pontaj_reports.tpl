{include file="pontaj_menu.tpl"}
<div class="filter">
    <label>Alege raport:</label>
    <select name="report_id" onchange="window.location.href = './?m=pontaj&o=reports&report_id=' + this.value;">
        <option value="0">alege...</option>
        {foreach from=$reports key=key item=item}
            <option value="{$key}" {if !empty($smarty.get.report_id) && $smarty.get.report_id == $key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    {if !empty($smarty.get.report_id) && isset($reports[$smarty.get.report_id])}
        <div class="outputZone outputZoneOne">
            <div>
                <ul>
                    <li class="header"><label>{translate label='Output'}</label></li>
                    <li>
                        <td width="60"><input type="button" class="cod printFile" value="Printeaza" onclick="window.open('{$smarty.server.REQUEST_URI}&action=print', 'print')">
                        </td>
                    </li>
                    <li>
                        <td width="60"><input type="button" class="cod exportFile" value="Export .xls"
                                              onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=export'"></td>
                    </li>
                    <li>
                        <td width="60"><input type="button" class="cod exportFile" value="Export .doc"
                                              onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'"></td>
                    </li>
                </ul>
            </div>
        </div>
    {/if}
</div>
{if !empty($smarty.get.report_id) && isset($reports[$smarty.get.report_id])}
    {include file="pontaj_reports_"|cat:$smarty.get.report_id|cat:".tpl"}
{/if}