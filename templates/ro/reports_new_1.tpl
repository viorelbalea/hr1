<table cellspacing="0" cellpadding="0" bgcolor="#D8EAF5" height="20" width="100%">
    <tr>
        <td width="75" style="padding-left: 4px;"><a href="./?m=reports"><b>{translate label='Rapoarte'}</b></a></td>
        <td width="90" style="padding-left: 4px;"><a href="./?m=reports&o=new" class="selected"><b>{translate label='Raport nou'}</b></a></td>
        <td width="120" style="padding-left: 4px;"><a href="./?m=reports&o=myreport"><b>{translate label='Rapoartele mele'}</b></a></td>
        <td>&nbsp;</td>
    </tr>
</table>
<form action="./?m=reports&o=new&step=2" method="post">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr class="celulaMenuSTDR">
            <td>
                <fieldset>
                    <legend>{translate label='RAPORT NOU: alegeti criteriile'}</legend>
                    <br>
                    <table cellspacing="0" cellpadding="0" width="100%">
                        <tr valign="top">
                            {foreach from=$criteria key=key item=item name=iter}
                                <td width="20%" {if !$smarty.foreach.iter.last}style="border-right: 1px solid #cccccc;"{/if}>
                                    <table cellspacing="2" cellpadding="3" width="100%">
                                        <tr>
                                            <td colspan="3"><b>{$key}</b></td>
                                        </tr>
                                        {foreach from=$item key=key2 item=item2}
                                            <tr height="30">
                                                <td>{$item2}</td>
                                                <td>
                                                    <select name="operator[{$key}][{$key2}]" style="font-size: 11px;">
                                                        <option value="=">=</option>
                                                        <option value=">">&gt;</option>
                                                        <option value=">=">&gt;=</option>
                                                        <option value="<">&lt;</option>
                                                        <option value="<=">&lt;=</option>
                                                        <option value="<>">&lt;&gt;</option>
                                                    </select>
                                                </td>
                                                <td id="{$key}_{$key2}">
                                                    {if isset($criteria_values.$key.$key2)}
                                                        <select name="value[{$key}][{$key2}]" style="font-size: 11px;"
                                                                onchange="if (this.value > '') updateSelect('{$key}', '{$key2}', this.value);">
                                                            <option value="">alege...</option>
                                                            {foreach from=$criteria_values.$key.$key2 key=key3 item=item3}
                                                                <option value="{$key3}">{$item3}</option>
                                                            {/foreach}
                                                        </select>
                                                    {else}
                                                        <input type="text" name="value[{$key}][{$key2}]" size="15" style="font-size: 11px;">
                                                    {/if}
                                                </td>
                                            </tr>
                                        {/foreach}
                                    </table>
                                </td>
                            {/foreach}
                        </tr>
                        <tr height="50">
                            <td colspan="5" align="center"><input type="submit" value="Pasul urmator"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>

{literal}
    <script language="javascript">
        function updateSelect(criteria, field, value) {
            if (criteria == 'Personal' && field == 'Status') {
                showInfo('ajax_report.php?o=SubStatus&Status=' + value + '&rnd=' + Math.floor(Math.random() * 11), 'Personal_SubStatus');
            } else if (criteria == 'Personal' && field == 'd.DistrictID') {
                showInfo('ajax_report.php?o=CityID&DistrictID=' + value + '&rnd=' + Math.floor(Math.random() * 11), 'Personal_d.CityID');
            }
        }
    </script>
{/literal}