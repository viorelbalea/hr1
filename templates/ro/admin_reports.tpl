{include file="admin_menu.tpl"}

<div id="layer_reports" class="layer" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Drepturi raport'} : <span id="reportTitle"></span></h3>

    <div class="layerContent" id="layer_reports_content"></div>

</div>
<div id="layer_reports_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_reports').style.display = 'none'; document.getElementById('layer_reports_x').style.display = 'none'; return false;">x
</div>

<div id="layer_reports_alloc" class="layer" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Drepturi rapoarte'}</h3>
    <div class="layerContent" id="layer_reports_alloc_content"></div>
</div>
<div id="layer_reports_alloc_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_reports_alloc').style.display = 'none'; document.getElementById('layer_reports_alloc_x').style.display = 'none'; return false;">x
</div>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Rapoarte'}</span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;" width="75%">
            <br>
            <fieldset>
                <legend>{translate label='Rapoarte'}</legend>
                <p>
                    {translate label='Grupa rapoarte'}:
                    <select name="GroupID" id="GroupID" onchange="window.location.href = './?m=admin&o=reports&GroupID=' + 										document.getElementById('GroupID').value +
		 												'&Type=' + document.getElementById('Type').value;">
                        <option value="0">alege...</option>
                        {foreach from=$groups key=key item=item}
                            <option value="{$key}" {if $smarty.get.GroupID==$key}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    {translate label='Tip rapoarte'}:
                    <select name="Type" id="Type" onchange="window.location.href = './?m=admin&o=reports&GroupID=' + document.getElementById('GroupID').value +
		 												'&Type=' + document.getElementById('Type').value;">
                        <option value="0">alege...</option>
                        {foreach from=$types key=key item=item}
                            <option value="{$key}" {if $smarty.get.Type==$key}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </p>
                {if !empty($reports)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0" class="grid">
                                    <tr height="25">
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b>{translate label='Modul'}</b></td>
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b>{translate label='Raport'}</b></td>
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b>{translate label='Drepturi'}</b></td>
                                        <td class="celulaMenuSTDR" style="border-top: 1px solid #EDEDED;"><input type="checkbox" id="alloc"></td>
                                    </tr>
                                    {foreach from=$reports item=item}
                                        <tr height="25">
                                            <td class="celulaMenuST" width="80">{$modules_txt[$item.ModuleID]} </td>
                                            <td class="celulaMenuST">{$item.Report}</td>
                                            <td class="celulaMenuST" style="text-align: center;">
                                                <div id="button_mod"><a href="./?m=admin&o=reports&ReportID={$item.ReportID}"
                                                                        onclick="document.getElementById('layer_reports').style.display = 'block'; document.getElementById('layer_reports_x').style.display = 'block'; showInfo('ajax.php?o=reports_rights&ReportID={$item.ReportID}', 'layer_reports_content'); document.getElementById('reportTitle').innerHTML = '{$item.Report}'; return false;"
                                                                        title="Drepturi"><b>{translate label='Mod'}</b></a></div>
                                            </td>
                                            <td class="celulaMenuSTDR" style="text-align: center;"><input type="checkbox" value="{$item.ReportID}" class="allocr"></td>
                                        </tr>
                                    {/foreach}
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                {else}
                    {translate label='Niciun raport asociat acestei grupe!'}
                {/if}
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Grupe rapoarte'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                {foreach from=$groups key=key item=item}
                                    <tr>
                                        <td><input type="text" id="GroupName_{$key}" value="{$item}" size="30" maxlength="128"></td>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=reports&action=edit&GroupID={$key}&GroupName=' + escape(document.getElementById('GroupName_{$key}').value); return false;"
                                                                    title="Modifica grupa rapoarte"><b>{translate label='Mod'}</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=reports&action=del&GroupID={$key}'; return false;"
                                                                    title="Sterge grupa rapoarte"><b>{translate label='Del'}</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                                <tr>
                                    <td><input type="text" id="GroupName_0" size="30" maxlength="128"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=reports&action=new&GroupID=0&GroupName=' + escape(document.getElementById('GroupName_0').value); return false;"
                                                                title="Adauga grupa rapoarte"><b>{translate label='Add'}</b></a></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='administrare rapoarte'}</td>
    </tr>
</table>
{literal}
<script type="text/javascript">
    $(document).ready(function () {
        $("#alloc").change(function () {

            if ($(this).prop('checked')) {
                var reports = '|';
                $(".allocr").each(function () {
                    if ($(this).prop('checked')) {
                        reports += $(this).attr('value') + '|';
                    }
                });
                if (reports.length > 1) {
                    $("#layer_reports_alloc").show();
                    $("#layer_reports_alloc_x").show();
                    $.get('ajax.php?o=reports_rights_alloc&reports=' + reports, function (data) {
                        $("#layer_reports_alloc_content").html(data)
                    });
                } else {
                    alert('{/literal}{translate label="Nu ai ales rapoarte"}{literal}!');
                }
            }
        });
    });
</script>
{/literal}