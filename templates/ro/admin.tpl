{include file="admin_menu.tpl"}
{if empty($smarty.get.o) }
    <div id="checkversion" align="center"></div>
    <script type="text/javascript">showInfo('./update/checkversion.php', 'checkversion');</script>
{/if}