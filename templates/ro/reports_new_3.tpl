<table cellspacing="0" cellpadding="0" bgcolor="#D8EAF5" height="20" width="100%">
    <tr>
        <td width="75" style="padding-left: 4px;"><a href="./?m=reports"><b>{translate label='Rapoarte'}</b></a></td>
        <td width="90" style="padding-left: 4px;"><a href="./?m=reports&o=new" class="selected"><b>{translate label='Raport nou'}</b></a></td>
        <td width="120" style="padding-left: 4px;"><a href="./?m=reports&o=myreport"><b>{translate label='Rapoartele mele'}</b></a></td>
        <td>&nbsp;</td>
    </tr>
</table>
<br>
<form action="./?m=reports&o=new&step=4" method="post">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr class="celulaMenuSTDR">
            <td>
                <fieldset>
                    <legend>{translate label='Salvare raport'}</legend>
                    <br>
                    {translate label='Denumire raport'}: <input type="text" name="report" size="60" maxlength="255">
                    <input type="hidden" name="cond" value="{$cond}">
                    <input type="submit" value="Finalizare">
                </fieldset>
            </td>
        </tr>
    </table>
</form>