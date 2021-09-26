{include file="car_menu.tpl"}


<br>

<div id="layer_co" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Descriere'}</h3>
    <div class="observatiiTextbox">
        <textarea id="layer_co_notes"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value=""/>

    </div>

    <div class="saveObservatii" style="margin-top: 4px">
        {if $rw == 1}
            <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">
            <input type="button" value="{translate label='Anuleaza'}"
                   onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
        {/if}

    </div>
</div>
<!---->
<div id="layer_co_x" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>


<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="car_submenu.tpl"}</span></td>
    </tr>

    {if $err->getErrors()}
        <tr>

            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>

        </tr>
    {/if}

</table>


<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

    <tr>

        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">

            <br>

            <fieldset>
                <legend>{translate label='Plan de revizii'}</legend>

                <table border="0" cellpadding="4" cellspacing="0" class="screen">

                    <tr>

                        <td>

                            <table border="0" cellpadding="4" cellspacing="0">

                                <tr>

                                    <td><b>#</b></td>

                                    <td><b>{translate label='Km'}</b></td>

                                    <td><b>{translate label='Interval'}</b></td>

                                    <td><b>{translate label='Observatii'}</b></td>

                                    <td colspan="2">&nbsp;</td>

                                </tr>

                                {foreach from=$info key=key item=item name=inf}
                                    <tr>

                                        <td>{$smarty.foreach.inf.iteration}</td>

                                        <td><input type="text" id="Km_{$key}" name="Km_{$key}" value="{$item.Km}" size="15" maxlength="20"></td>

                                        <td><input type="text" id="Interval_{$key}" name="Interval_{$key}" value="{$item.MInt}" size="2"
                                                   maxlength="3"><span>&nbsp;&nbsp;{translate label='luni'}</span></td>

                                        <td><input type="hidden" id="Obs_{$key}" value="{$item.Notes}"><span id="Obs_{$key}_display"></span> [<a href="#"
                                                                                                                                                 title="{$item.Notes|escape:'javascript'}"
                                                                                                                                                 onclick="getNotes('Obs_{$key}', '{$item.RW}'); return false;">{if $rw == 1 && $item.RW == 1}{translate label='Editare'}{else}{translate label='Vizualizare'}{/if}</a>]
                                        </td>

                                        {if $rw == 1}

                                            {if $item.RW == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=cars&o=pcheckups&CarID={$smarty.get.CarID}&ID={$key}&Km=' + escape(document.getElementById('Km_{$key}').value) + '&MInt=' + escape(document.getElementById('Interval_{$key}').value) + '&Notes=' + escape(document.getElementById('Obs_{$key}').value); return false;"
                                                                            title="{translate label='Modifica revizie'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=cars&o=pcheckups&CarID={$smarty.get.CarID}&ID={$key}&del=1'; return false;"
                                                                            title="{translate label='Sterge revizie'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}

                                        {/if}

                                    </tr>
                                {/foreach}

                                {if $rw == 1}
                                    <tr>

                                        <td>&nbsp;</td>

                                        <td><input type="text" id="Km_0" name="Km_0" size="15" maxlength="20" value="{$smarty.get.Km}"></td>

                                        <td><input type="text" id="Interval_0" name="Interval_0" size="2" maxlength="3"
                                                   value="{$smarty.get.MInt}"><span>&nbsp;&nbsp;{translate label='luni'}</span></td>

                                        <td><input type="hidden" id="Obs_0"><span id="Obs_0_display"></span> [<a href="#"
                                                                                                                 onclick="getNotes('Obs_0'); return false;">{translate label='Editare'}</a>]
                                        </td>

                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=cars&o=pcheckups&CarID={$smarty.get.CarID}&ID=0&Km=' + escape(document.getElementById('Km_0').value) + '&MInt=' + escape(document.getElementById('Interval_0').value) + '&Notes=' + escape(document.getElementById('Obs_0').value); return false;"
                                                                    title="{translate label='Adauga revizie'}"><b>Add</b></a></div>
                                        </td>

                                    </tr>
                                {/if}

                            </table>

                        </td>

                    </tr>

                </table>

        </td>

    </tr>

</table>

{literal}
    <script type="text/javascript">

        function getNotes(id, rw) {

            document.getElementById('layer_co_notes').value = document.getElementById(id).value;

            document.getElementById('layer_co_notes_dest').value = id;

            document.getElementById('layer_co').style.display = 'block';

            document.getElementById('layer_co_x').style.display = 'block';

            if (rw == 0) {

                document.getElementById('layer_co_sb').style.display = 'none';

                document.getElementById('layer_co_cb').style.display = 'none';

                document.getElementById('layer_co_notes').setAttribute("readonly", "readonly");

            } else {

                document.getElementById('layer_co_sb').style.display = 'inline';

                document.getElementById('layer_co_cb').style.display = 'inline';

                document.getElementById('layer_co_notes').removeAttribute("readonly");

            }

        }

        function setNotes() {

            var id = document.getElementById('layer_co_notes_dest').value;

            document.getElementById(id).value = document.getElementById('layer_co_notes').value;

            document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';

            document.getElementById('layer_co').style.display = 'none';

            document.getElementById('layer_co_x').style.display = 'none';

        }

    </script>
{/literal}

    





