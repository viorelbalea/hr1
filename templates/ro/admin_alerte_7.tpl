<tr>
    <td>{translate label='Numar zile inainte de expirare'}:</td>
    <td><input type="text" name="settings[days]" size="2" maxlength="2" value="{$alerte[$smarty.get.ID].Settings.days|default:'0'}"></td>
</tr>
<tr>
    <td>{translate label='Roluri'}:</td>
    <td>
        {foreach from=$roles key=key item=item}
            <input type="checkbox" name="settings[roles][{$key}]" value="1"
                   {if !empty($alerte[$smarty.get.ID].Settings.roles) && isset($alerte[$smarty.get.ID].Settings.roles.$key)}checked{/if}>
            {$item}
            <br>
        {/foreach}
    </td>
</tr>