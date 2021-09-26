{if empty($smarty.get.print)}
    <table cellspacing="0" cellpadding="0" bgcolor="#D8EAF5" height="20" width="100%">
        <tr>
            <td width="75" style="padding-left: 4px;"><a href="./?m=reports"><b>{translate label='Rapoarte'}</b></a></td>
            <td width="90" style="padding-left: 4px;"><a href="./?m=reports&o=new"><b>{translate label='Raport nou'}</b></a></td>
            <td width="120" style="padding-left: 4px;"><a href="./?m=reports&o=myreport" class="selected"><b>{translate label='Rapoartele mele'}</b></a></td>
            <td>&nbsp;</td>
        </tr>
    </table>
    <table width="100%" cellspacing="0" cellpadding="0" bgcolor="#D8EAF5" height="30">
        <tr>
            <td width="100%" style="padding-left: 4px;">
                <select name="o" onchange="if (this.value>0) window.location.href = './?m=reports&o=myreport&rep=' + this.value" class="cod">
                    <option value="0">{translate label='alege raport...'}</option>
                    {foreach from=$reports item=item}
                        <option value="{$item.ReportID}" {if $smarty.get.rep == $item.ReportID}selected{/if}>{$item.Report}</option>
                    {/foreach}
                </select>
            </td>
            {if !empty($smarty.get.rep)}
                <td align="right" style="padding-right: 4px;">
                    <input type="button" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&print=1'" value="Printeaza">&nbsp;
                    <input type="button" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export=1'" value="Export">
                </td>
            {/if}
        </tr>
    </table>
{/if}
{if !empty($smarty.get.rep)}
    {include file="report_2.tpl"}
{/if}