<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume formular'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Formulare'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Persoana evaluata'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Functie evaluata'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Relatie'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data inceput'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data sfarsit'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span>&nbsp;</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Calificativ'}</span>&nbsp;</td>
    </tr>
    {foreach from=$evalForms key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$evalForms.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><b>{$item.FormName}</b></td>
                <td class="celulaMenuST">
                    {if $item.Evaluated}
                        <table cellspacing="0" cellpadding="2" width="100%">
                            <tr>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Evaluator'}</span></td>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Calificativ'}</span></td>
                            </tr>
                            {foreach from=$item.Evaluated item=c name=iter2}
                                <tr>
                                    <td width="130" class="celulaMenuST">{$c.FullName|default:'-'}</td>
                                    <td width="100" class="celulaMenuST">{if $c.Completed==1}Incheiata{else}Neincheiata{/if}</td>
                                    <td width="220" class="celulaMenuST">{if $c.Completed==1}{$c.SelfWeighted|default:'-'}{else}Indisponibil pana la<br/>finalizare{/if}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {else}
                        &nbsp;
                    {/if}
                </td>
                <td class="celulaMenuST">{$item.EvaluatedName|default:'-'}</td>
                <td class="celulaMenuST">{$item.Function|default:'-'}</td>
                <td class="celulaMenuST">{$relations[$item.RelationID]|default:'-'}</td>
                <td class="celulaMenuST">{$item.StartDate}</td>
                <td class="celulaMenuST">{$item.EndDate}</td>
                <td class="celulaMenuST">{if $item.Completed==1}Incheiata{else}Neincheiata{/if}</td>
                <td class="celulaMenuST">{if $item.Completed==1}{$item.SelfWeighted|default:'-'}{else}Indisponibil pana la<br/>aprobare{/if}</td>
            </tr>
        {/if}
    {/foreach}
    {if count($evalForms)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">Nici o evaluare!</td>
        </tr>
    {/if}
</table>

</body>
</html>