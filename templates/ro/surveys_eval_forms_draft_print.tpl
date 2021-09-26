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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume formular'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data creare'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Numar asignari'}</span></td>
    </tr>
    {foreach from=$evalFormsDraft key=key item=item name=iter1}
        {if $key>0}
            <tr BGCOLOR="#F9F9F9" height="30">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$evalFormsDraft.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FormName|default:'-'}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CreateDate|default:'-'}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.AssignedForms|default:'-'}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="6" class="celulaMenuSTDR" style="background-color: #F9F9F9;  border-bottom: 1px solid #999999;">{translate label='Nici un formular de studiu!'}</td>
        </tr>
    {/foreach}
</table>

</body>
</html>