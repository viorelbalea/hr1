<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume companie'}</span></td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Contacte'}</span></td>
    </tr>
    {foreach from=$companies key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$companies.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CompanyName}</td>
                <td class="celulaMenuSTDR">
                    {if $item.Contacts}
                        <table cellspacing="0" cellpadding="2" width="100%">
                            <tr BGCOLOR="#CCCCCC">
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label=' Nume'}</span></td>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label=' Telefon'}</span></td>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label=' Email'}</span></td>
                                <td class="bkdTitleMenu"><span class="TitleBox">{translate label=' Functie'}</span></td>
                            </tr>
                            {foreach from=$item.Contacts item=c name=iter2}
                                <tr>
                                    <td width="130" class="celulaMenuST">{$c.ContactName|default:'-'}</td>
                                    <td width="100" class="celulaMenuST">{$c.ContactPhone|default:'-'}</td>
                                    <td width="220" class="celulaMenuST">{$c.ContactEmail|default:'-'}</td>
                                    <td width="150" class="celulaMenuST">{$c.ContactFunction|default:'-'}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {else}
                        &nbsp;
                    {/if}
                </td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>