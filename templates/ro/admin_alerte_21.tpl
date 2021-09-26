<tr>
    <td>{translate label='Status tichete'}:</td>
    <td>
        {foreach from=$ticketing_status key=key item=item}
            <input type="checkbox" name="settings[status][{$key}]" value="1"
                   {if !empty($alerte[$smarty.get.ID].Settings.status) && isset($alerte[$smarty.get.ID].Settings.status.$key)}checked{/if}>
            {$item}
            <br>
        {/foreach}
    </td>
</tr>