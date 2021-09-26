{include file="companies_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="companies_submenu.tpl"}</span>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px">
            <fieldset>
                <legend>{translate label='Contracte'}</legend>
                {if !empty($contracts)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <th>Nr. Contract</th>
                            <th>Nume Contract</th>
                            <th>Tip Contract</th>
                            <th>Data Semnare Contract</th>
                            <th>Persoana Contact Beneficiar</th>
                        </tr>
                        {foreach from=$contracts item=item}
                            <tr>
                                <td><a href="./?m=contract&o=edit&ContractID={$item.ContractID}" class="blue">{$item.ContractNo}</a></td>
                                <td>{$item.ContractName}</td>
                                <td>{$item.ContractType}</td>
                                <td>{$item.SignDate|date_format:'%d.%m.%Y'}</td>
                                <td>
                                    {if !empty($item.contacts)}
                                        {foreach from=$item.contacts item=contact}
                                            {$contact.ContactName}{if !empty($contact.ContactFunction) || !empty($contact.ContactPhone)} ({if !empty($contact.ContactFunction)}{$contact.ContactFunction}, {/if}{$contact.ContactPhone}){/if}
                                            <br>
                                        {/foreach}
                                    {else}
                                        -
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                    </table>
                {else}
                    <p>{translate label='Nu sunt date'}!</p>
                {/if}
            </fieldset>
        </td>
    </tr>
</table>
