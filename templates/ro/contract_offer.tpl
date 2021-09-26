{include file="contract_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);" name="contract">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="contract_submenu.tpl"}</span>
            </td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding: 0 10px 10px 10px;">
                <br/>
                <fieldset>
                    <legend>{translate label='Oferte'}</legend>
                    {if !empty($offers)}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr>
                                <th>Data oferta</th>
                                <th>Valoare totala oferta</th>
                                <th>Responsabil</th>
                                <th align="center">Asociaza la contract</th>
                                <th align="center">
                                </td>
                            </tr>
                            {foreach from=$offers item=item}
                                <tr>
                                    <td>{$item.OfferDate|date_format:'%d.%m.%Y'}</td>
                                    <td>{$item.OfferValue} {$item.Coin}</td>
                                    <td>{$item.Beneficiary|default:'-'}</td>
                                    <td align="center"><input type="checkbox" name="contract_offers[{$item.ActivityDetID}]"
                                                              {if isset($contract_offers[$item.ActivityDetID])}checked{/if}></td>
                                    <td align="center"><a
                                                href="./?m=sales&o=new_activity&ActivityID={$item.ActivityID}&ActivityDetID={$item.ActivityDetID}&CompanyID={$item.CompanyID}&ContactID={$item.ContactID}">{translate label="detalii oferta"}</a>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td colspan="3"></td>
                                <td align="center"><input type="submit" name="save" value="{translate label='Salveaza'}"></td>
                                <td></td>
                            </tr>
                        </table>
                    {else}
                        <p>{translate label='Nu sunt date'}!</p>
                    {/if}
                </fieldset>
            </td>
        </tr>
    </table>
</form>
