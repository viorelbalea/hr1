<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr valign="top">
        <td>
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <td><b>{translate label='Masina'}</b></td>
                    <td>{$brands[$info.Brand]} {$info.Model} / {$info.RegNo}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Km'}</b></td>
                    <td>{$info.Km|default:''}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Angajat'}</b></td>
                    <td>{$info.FullName|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Numar document'}</b></td>
                    <td>{$info.ReceiptNo|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label="Data document"}</b></td>
                    <td>{$info.Date|date_format:"%d.%m.%Y"|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Furnizor'}</b></td>
                    <td>{$info.CompanyName|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Valoare cu TVA'}</b></td>
                    <td>{$info.Cost|default:''} {$coins[$info.Coin]|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Buget'}</b></td>
                    <td>{if $info.Budget == 1}{translate label='Da'}{else}{translate label='Nu'}{/if}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Grupa cheltuiala'}</b></td>
                    <td>{$costgroups[$info.CostGroupID]|default:'-'}</td>
                </tr>
                <tr>
                    <td><b>{translate label='Observatii'}</b></td>
                    <td>{$info.Notes}</td>
                </tr>
            </table>
        </td>
        <td>
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <td><b>{translate label='Articol'}</b></td>
                    <td colspan="2"><b>{translate label='Cant.'}</b></td>
                    <td><b>{translate label='Valoare<br> fara TVA'}</b></td>
                    <td><b>{translate label='Cota<br> TVA'}</b></td>
                    <td><b>{translate label='Total cu TVA'}</b></td>
                </tr>

                {foreach from=$info.items key=key item=item}
                    <tr>
                        <td>{$item.CostType} {$item.Producer} {$item.Properties}</td>
                        <td>{$item.Quantity|default:'&nbsp;'}</td>
                        <td>{$item.Unit|default:'&nbsp;'}</td>
                        <td>{$item.ItemCost}</td>
                        <td>{$item.VAT_value|default:'&nbsp;'}</td>
                        <td>{$item.Value}</td>
                    </tr>
                {/foreach}
            </table>

        </td>
    </tr>
</table>