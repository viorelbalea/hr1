{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Rapoarte'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Drepturi raport'}: {$rights.report.name}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                {translate label='Nume raport'}:&nbsp;
                                <input type="text" name="ReportName" value="{$rights.report.name}" size="40"/><br><br>
                                {translate label='Grupa rapoarte'}:
                                <select name="GroupID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$groups key=key item=item}
                                        <option value="{$key}" {if $rights.report.groupid==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {translate label='Tip rapoarte'}:
                                <select name="Type" id="Type">
                                    <option value="0">alege...</option>
                                    {foreach from=$types key=key item=item}
                                        <option value="{$key}" {if $rights.report.Type==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <br><br>
                                <table border="0" cellpadding="6" cellspacing="0">
                                    <tr>
                                        <td><b>{translate label='Useri'}</b></td>
                                        <td><b>{translate label='Roluri'}</b></td>
                                    </tr>
                                    <tr valign="top">
                                        <td>
                                            {foreach from=$rights.user key=key item=item}
                                                <input type="checkbox" name="rights[{$key}]" value="{$key}" {if isset($rights.report.rights.$key)}checked{/if}>
                                                {$item}
                                                <br>
                                                <br>
                                            {/foreach}
                                        </td>
                                        <td>
                                            {foreach from=$rights.role key=key item=item}
                                                <input type="checkbox" name="rights[{$key}]" value="{$key}" {if isset($rights.report.rights.$key)}checked{/if}>
                                                {$item}
                                                <br>
                                                <br>
                                            {/foreach}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" name="save" value="{translate label='Salveaza'}"></td>
                                        <td><input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=admin&o=reports';"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='administrare rapoarte'}</td>
        </tr>
    </table>
</form>
