<table width="100%" cellspacing="0" cellpadding="2" border="0">

    <tr>
        <td colspan="10"><b>Evaluare</b></td>
    </tr>

    <tr>
        <td colspan="5"><b>{translate label='Cod formular'}:</b> {$form.FormCode}</td>
        <td colspan="5" width="500" align="right"><b>{translate label='Nume angajat'}</b>
            ..................................................................................................
        </td>
    </tr>
    <tr>
        <td colspan="5">{$form.FormDesc}</td>
        <td colspan="5" valign="top" width="500" align="right"><b>{translate label='Perioada'}</b> .................................................... -
            ....................................................
        </td>
    </tr>

</table>
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
        <td align="left" class="bkdTitleMenu" width="400"><b>{translate label='Criteriu'}</b></td>
        <td align="center" class="bkdTitleMenu" width="100"><b>{translate label='Pondere'}</b></td>
        <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota'}<br/>{translate label='autoevaluare'}<br/>(1 - 5)</b></td>
        <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'}</b></td>
        <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota'} <br/>{translate label='evaluator'}<br/>(1 - 5)</b></td>
        <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='evaluator'} </b></td>
        <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota'} <br/>{translate label='evaluator 2'}<br/>(1 - 5)</b></td>
        <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='evaluator 2'} </b></td>
        <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota '}<br/>{translate label='mediator'}<br/>(1 - 5)</b></td>
        <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='mediator'}</b></td>
    </tr>
    {foreach from=$sections key=k item=section}
        <tr>
            <td colspan="50" style="border-bottom:1px solid #EDEDED; background-color:#FCFCFC;" colspan="10"><b><br/>{$section.Name}</b></td>
        </tr>
        {foreach from=$section.Questions item=item}
            <tr>
                <td class="celulaMenuST">{$item.Question}</td>
                <td align="center" class="celulaMenuST">{$item.Pondere}%</td>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuSTDR" style="width: 200px;">&nbsp;</td>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuSTDR" style="width: 200px;">&nbsp;</td>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuSTDR" style="width: 200px;">&nbsp;</td>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuSTDR" style="width: 200px;">&nbsp;</td>
            </tr>
        {/foreach}
    {/foreach}
</table>