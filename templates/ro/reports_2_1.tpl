<form action="./?m=reports_2&o=1" method="post">
    <table cellspacing="0" cellpadding="2">
        <tr>
            <td>{translate label='Alege centru de cost'}:</td>
            <td>
                <select name="CostCenterID">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$costcenters key=key item=item}
                        <option value="{$key}">{$item}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>{translate label='Alege locatie'}:</td>
            <td>
                <select name="SiteID">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$sites key=key item=item}
                        <option value="{$key}">{$item}</option>
                    {/foreach}
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" value="Afiseaza"></td>
        </tr>
        {if !empty($smarty.post)}
            <tr height="30">
                <td>&nbsp;</td>
                <td align="center">{$result.total_contactat} / {$result.total}</td>
            </tr>
        {/if}
    </table>
</form>
