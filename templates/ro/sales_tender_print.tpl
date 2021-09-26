<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export' && $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{translate label='Beneficiar'}</td>
        {if !empty($personalisedlist.Ofertare)}
            {foreach from=$personalisedlist.Ofertare key=field item=label}
                <td class="bkdTitleMenu">{translate label=$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label='Proiect'}</td>
            <td class="bkdTitleMenu">{translate label='Subiect'}</td>
            <td class="bkdTitleMenu">{translate label='Status'}</td>
            <td class="bkdTitleMenu">{translate label='Participare'}</td>
            <td class="bkdTitleMenu">{translate label='Sursa de finantare'}</td>
            <td class="bkdTitleMenu">{translate label='Locatia proiectului'}</span></td>
            <td class="bkdTitleMenu">{translate label='Data cererii'}</td>
            <td class="bkdTitleMenu">{translate label='Termen limita'}</td>
            <td class="bkdTitleMenu">{translate label='Data ofertei'}</td>
            <td class="bkdTitleMenu">{translate label='Beneficiar final'}</td>
            <td class="bkdTitleMenu">{translate label='Valoare oferta'}</td>
        {/if}
    </tr>
    {foreach from=$activities key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$key y=1 z=$activities.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CompanyName}</td>
                {if !empty($personalisedlist.Ofertare)}
                    {foreach from=$personalisedlist.Ofertare key=field item=label name=iter}
                        <td class="celulaMenuST">
                            {if $field == 'Subject'}{$activitySubject[$item.Subject]|default:'-'}
                            {elseif $field == 'Status'}{$activityStatus[$item.Status]|default:'-'}
                            {elseif $field == 'ParticipationType'}{$participation_types[$item.ParticipationType]|default:'-'}
                            {elseif $field == 'FinancialSource'}{$financial_sources[$item.FinancialSource]|default:'-'}
                            {elseif $field == 'RequestDate'}{if $item.RequestDate > '0000-00-00'}{$item.RequestDate}{else}-{/if}
                            {elseif $field == 'Deadline'}{if $item.Deadline > '0000-00-00'}{$item.Deadline}{else}-{/if}
                            {elseif $field == 'OfferDate'}{if $item.OfferDate > '0000-00-00'}{$item.OfferDate}{else}-{/if}
                            {elseif $field == 'OfferValue'}{$item.OfferValue|default:'-'} {$item.Coin}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.Name|default:'-'}</td>
                    <td class="celulaMenuST">{$activitySubject[$item.Subject]|default:'-'}</td>
                    <td class="celulaMenuST">{$activityStatus[$item.Status]|default:'-'}</td>
                    <td class="celulaMenuST">{$participation_types[$item.ParticipationType]|default:'-'}</td>
                    <td class="celulaMenuST">{$financial_sources[$item.FinancialSource]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Address|default:'-'}</td>
                    <td class="celulaMenuST">{if $item.RequestDate > '0000-00-00'}{$item.RequestDate}{else}-{/if}</td>
                    <td class="celulaMenuST">{if $item.Deadline > '0000-00-00'}{$item.Deadline}{else}-{/if}</td>
                    <td class="celulaMenuST">{if $item.OfferDate > '0000-00-00'}{$item.OfferDate}{else}-{/if}</td>
                    <td class="celulaMenuST">{$item.Beneficiary|default:'-'}</td>
                    <td class="celulaMenuST">{$item.OfferValue|default:'-'} {$item.Coin}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($activities)==1}
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>

</body>
</html>