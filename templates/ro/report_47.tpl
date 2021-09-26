<p>Alege tip persoana:</p>
{foreach from=$status key=key item=item}
    <p><input type="checkbox" id="status_{$key}" value="{$key}" {if $key==2}checked{/if}>{$item}</p>
{/foreach}
<p><input type="button" value="Export" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export=1&status=' + getStatus();"></p>
{literal}
<script type="text/javascript">
    function getStatus() {
        var status = '0';
        {/literal}
        {foreach from=$status key=key item=item}
        if (document.getElementById('status_{$key}').checked) status = status + ',' + document.getElementById('status_{$key}').value
        {/foreach}
        {literal}
        return status;
    }
</script>
{/literal}