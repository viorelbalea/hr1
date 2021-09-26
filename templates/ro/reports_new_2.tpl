<table cellspacing="0" cellpadding="0" bgcolor="#D8EAF5" height="20" width="100%">
    <tr>
        <td width="75" style="padding-left: 4px;"><a href="./?m=reports"><b>{translate label='Rapoarte'}</b></a></td>
        <td width="90" style="padding-left: 4px;"><a href="./?m=reports&o=new" class="selected"><b>{translate label='Raport nou'}</b></a></td>
        <td width="120" style="padding-left: 4px;"><a href="./?m=reports&o=myreport"><b>{translate label='Rapoartele mele'}</b></a></td>
        <td>&nbsp;</td>
    </tr>
</table>
<br>
<form action="./?m=reports&o=new&step=3" method="post">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr class="celulaMenuSTDR">
            <td>
                <fieldset>
                    <legend>{translate label='RAPORT NOU: stabiliti corelatiile'}</legend>
                    <br>
                    <table cellspacing="0" cellpadding="6">
                        {foreach from=$smarty.post.value key=key item=item}
                            {foreach from=$item key=key2 item=item2 name=iter}
                                <tr>
                                    <td>
                                        <select name="paranthesisl[{$key}-{$smarty.foreach.iter.iteration}]">
                                            <option value=""></option>
                                            <option value="(">(</option>
                                            <option value="((">((</option>
                                            <option value="(((">(((</option>
                                            <option value="((((">((((</option>
                                        </select>
                                        {$key2} {$smarty.post.operator.$key.$key2} {$item2}<input type="hidden" name="criteria[{$key}-{$smarty.foreach.iter.iteration}]"
                                                                                                  value="{$key2} {$smarty.post.operator.$key.$key2} '{$item2}'">
                                        <select name="paranthesisr[{$key}-{$smarty.foreach.iter.iteration}]">
                                            <option value=""></option>
                                            <option value=")">)</option>
                                            <option value="))">))</option>
                                            <option value=")))">)))</option>
                                            <option value="))))">))))</option>
                                        </select>
                                    </td>
                                </tr>
                                {if !$smarty.foreach.iter.last}
                                    <tr>
                                        <td align="center">
                                            <input type="radio" name="operator[{$key}-{$smarty.foreach.iter.iteration}]" value="AND" checked>AND
                                            <input type="radio" name="operator[{$key}-{$smarty.foreach.iter.iteration}]" value="OR">OR
                                        </td>
                                    </tr>
                                {/if}
                            {/foreach}
                        {/foreach}
                        <tr>
                            <td colspan="3"><input type="submit" value="Pasul urmator"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>