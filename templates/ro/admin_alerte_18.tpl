<tr>
    <td>{translate label='Numar zile inainte de expirare'}:</td>
    <td><input type="text" name="settings[days]" size="2" maxlength="2" value="{$alerte[$smarty.get.ID].Settings.days|default:'0'}"></td>
</tr>
<tr>
    <td>{translate label='Recurenta'}:</td>
    <td>
        <input type="checkbox" name="settings[is_rec]" value="1" {if $alerte[$smarty.get.ID].Settings.is_rec==1}checked{/if}>
        <input type="text" name="settings[int_rec]" size="2" maxlength="2" value="{$alerte[$smarty.get.ID].Settings.int_rec|default:''}"> {translate label='zile'}
    </td>
</tr>
<tr>
    <td>{translate label='Numar km inainte de limita'}:</td>
    <td><input type="text" name="settings[km]" size="4" maxlength="5" value="{$alerte[$smarty.get.ID].Settings.km|default:'0'}"></td>
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