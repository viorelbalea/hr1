<form action="./?m=admin&o=reports" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="layerContent">
        <tr valign="top">
            <td>
                <p><b>{translate label='Grupa rapoarte'}:</b></p>
                <select name="GroupID">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$groups key=key item=item}
                        <option value="{$key}" {if $rights.report.groupid==$key}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
                <p>&nbsp;</p>
                <p><b>{translate label='Tip rapoarte'}:</b></p>
                <select name="Type" id="Type">
                    <option value="0">alege...</option>
                    {foreach from=$types key=key item=item}
                        <option value="{$key}" {if $rights.report.Type==$key}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td style="padding-left: 100px;" width="100%">
                <table border="0" cellpadding="6" cellspacing="0" width="100%">
                    <tr>
                        <td><b>{translate label='Useri'}</b></td>
                        <td><b>{translate label='Roluri'}</b></td>
                    </tr>
                    <tr valign="top">
                        <td>
                            {foreach from=$rights.user key=key item=item}
                                <input type="checkbox" name="rights[{$key}]" value="{$key}">
                                {$item}
                                <br>
                            {/foreach}
                        </td>
                        <td>
                            {foreach from=$rights.role key=key item=item}
                                <input type="checkbox" name="rights[{$key}]" value="{$key}">
                                {$item}
                                <br>
                            {/foreach}
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
    </fieldset>
    <div class="saveObservatii">
        <input type="submit" name="save" value="{translate label='Salveaza'}">
        <input type="hidden" name="reports" value="{$reports}">
    </div>
</form>