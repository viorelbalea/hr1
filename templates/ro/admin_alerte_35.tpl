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
<tr>
    <td>{translate label='Se trimite si la'}:</td>
    <td>
        <input type="checkbox" name="settings[md]" value="1" {if !empty($alerte[$smarty.get.ID].Settings.md)}checked{/if}> manager direct
        <br>
        <input type="checkbox" name="settings[mf]" value="1" {if !empty($alerte[$smarty.get.ID].Settings.mf)}checked{/if}> manager functional
    </td>
</tr>