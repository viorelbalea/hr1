{include file="car_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Dictionar auto'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>

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
        <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">
        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<!---->
<div id="layer_co_x" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Cheltuieli'}</legend>
                <table border="0" cellpadding="6" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Tip cheltuiala'}</td>
                                    <td>{translate label='Grupa'}</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                {foreach from=$costtype key=key item=item}
                                    <tr valign="top">
                                        <td><input type="text" id="CostType_{$key}" value="{$item.CostType}" size="20" maxlength="128"></td>
                                        <td>
                                            <select id="CostGroup_{$key}">
                                                <option value="0">&nbsp;</option>
                                                {foreach from=$cost_groups key=cost_key item=cost_group}
                                                    <option value="{$cost_key}" {if $item.CostGroup == $cost_key} selected="selected"{/if}>{$cost_group}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#" onclick="if (!is_empty(document.getElementById('CostType_{$key}').value))
                                                            window.location.href = './?m=cars&o=dictionary&CostTypeID={$key}' +
                                                            '&CostType=' + escape(document.getElementById('CostType_{$key}').value) +
                                                            '&CostGroup=' + escape(document.getElementById('CostGroup_{$key}').value);
                                                            return false;" title="{translate label='Modifica tip cheltuiala'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>{if $item.Deletable == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=cars&o=dictionary&CostTypeID={$key}&del=1'; return false;"
                                                                            title="{translate label='Sterge tip cheltuiala'}"><b>Del</b></a></div>{else}&nbsp;{/if}</td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="CostType_0" size="20" maxlength="128"></td>
                                        <td>
                                            <select id="CostGroup_0">
                                                <option value="0">&nbsp;</option>
                                                {foreach from=$cost_groups key=cost_key item=cost_group}
                                                    <option value="{$cost_key}">{$cost_group}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#" onclick="if (!is_empty(document.getElementById('CostType_0').value))
											  window.location.href = './?m=cars&o=dictionary&CostTypeID=0' + 
														 '&CostType=' + escape(document.getElementById('CostType_0').value) +
                                                                                                                 '&CostGroup=' + escape(document.getElementById('CostGroup_0').value);
														 return false;" title="{translate label='Adauga tip cheltuiala'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                {/if}
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Dictionar auto'}</legend>
                <table border="0" cellpadding="6" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Tip cheltuiala'}</td>
                                    <td>{translate label='Producator'}</td>
                                    <td>{translate label='Proprietati'}</td>
                                    <td>{translate label='U.M.'}</td>
                                    <td>{translate label='Valoare aproximativa'}</td>
                                    <td>{translate label='Observatii'}</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                {foreach from=$dictionary key=key item=item}
                                    <tr valign="top">
                                        <td>
                                            <select id="CostTypeID_{$key}">
                                                <option value="0">{translate label='alege'}</option>
                                                {foreach from=$costtype key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.CostTypeID}selected{/if}>{$item2.CostType}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td>
                                            <select id="Producer_{$key}">
                                                <option value="0">Producator</option>
                                                {foreach from=$producers key=prod_key item=prod_item}
                                                    <option value="{$prod_key}" {if $item.Producer==$prod_key}selected="selected"{/if}>{$prod_item}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td><input type="text" id="Properties_{$key}" value="{$item.Properties}" size="20" maxlength="255"></td>
                                        <td>
                                            <select id="UM_{$key}">
                                                <option value="0">&nbsp;</option>
                                                {foreach from=$measurement_units key=unit_value item=unit}
                                                    <option value="{$unit_value}" {if $item.UM == $unit_value} selected="selected"{/if}>{$unit.Unit}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="Cost_{$key}" value="{$item.Cost}" size="10" maxlength="10">
                                            <select id="Coin_{$key}">
                                                {foreach from=$coins key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.Coin}selected{/if}>{$item2}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td><input type="hidden" id="Notes_{$key}" value="{$item.Notes}"><span id="Notes_{$key}_display"></span> [<a href="#"
                                                                                                                                                     title="{$item.Notes|escape:'javascript'}"
                                                                                                                                                     onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]
                                        </td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#" onclick="if (!is_empty(document.getElementById('CostTypeID_{$key}').value) &&
                                                            !is_empty(document.getElementById('Producer_{$key}').value) &&
                                                            !is_empty(document.getElementById('Properties_{$key}').value) &&
                                                            !is_empty(document.getElementById('UM_{$key}').value) &&
                                                            !is_empty(document.getElementById('Cost_{$key}').value))
                                                            window.location.href = './?m=cars&o=dictionary&ID={$key}' +
                                                            '&CostTypeID=' + escape(document.getElementById('CostTypeID_{$key}').value) +
                                                            '&Producer=' + escape(document.getElementById('Producer_{$key}').value) +
                                                            '&Properties=' + escape(document.getElementById('Properties_{$key}').value) +
                                                            '&UM=' + escape(document.getElementById('UM_{$key}').value) +
                                                            '&Cost=' + escape(document.getElementById('Cost_{$key}').value) +
                                                            '&Coin=' + escape(document.getElementById('Coin_{$key}').value) +
                                                            '&Notes=' + escape(document.getElementById('Notes_{$key}').value); else alert('{translate label='Intoduceti Tip cheltuiala, Producator, Proprietati, Unitatea de masura, Valoare aproximativa!'}');
                                                            return false;" title="{translate label='Modifica articol'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=cars&o=dictionary&ID={$key}&del=1'; return false;"
                                                                        title="{translate label='Sterge articol'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td>
                                            <select id="CostTypeID_0">
                                                <option value="0">{translate label='alege'}</option>
                                                {foreach from=$costtype key=key2 item=item2}
                                                    <option value="{$key2}">{$item2.CostType}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td><input type="text" id="Producer_0" size="20" maxlength="255"></td>
                                        <td><input type="text" id="Properties_0" size="20" maxlength="255"></td>
                                        <td>
                                            <select id="UM_0">
                                                <option value="0">&nbsp;</option>
                                                {foreach from=$measurement_units key=unit_value item=unit}
                                                    <option value="{$unit_value}">{$unit.Unit}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="Cost_0" size="10" maxlength="10">
                                            <select id="Coin_0">
                                                {foreach from=$coins key=key2 item=item2}
                                                    <option value="{$key2}">{$item2}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td><input type="hidden" id="Notes_0"><span id="Notes_0_display"></span> [<a href="#"
                                                                                                                     onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                                        </td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#" onclick="if (!is_empty(document.getElementById('CostTypeID_0').value) &&
                                                        !is_empty(document.getElementById('Producer_0').value) &&
                                                        !is_empty(document.getElementById('Properties_0').value) &&
                                                        !is_empty(document.getElementById('UM_0').value) &&
                                                        !is_empty(document.getElementById('Cost_0').value))
                                                        window.location.href = './?m=cars&o=dictionary&ID=0' +
                                                        '&CostTypeID=' + escape(document.getElementById('CostTypeID_0').value) +
                                                        '&Producer=' + escape(document.getElementById('Producer_0').value) +
                                                        '&Properties=' + escape(document.getElementById('Properties_0').value) +
                                                        '&UM=' + escape(document.getElementById('UM_0').value) +
                                                        '&Cost=' + escape(document.getElementById('Cost_0').value) +
                                                        '&Coin=' + escape(document.getElementById('Coin_0').value) +
                                                        '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Intoduceti Tip cheltuiala, Producator, Proprietati, Unitatea de masura, Valoare aproximativa!'}');
                                                        return false;" title="{translate label='Adauga articol'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                {/if}
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='dictionar auto'}</span></td>
    </tr>
</table>

{literal}
    <script type="text/javascript">
        function getNotes(id) {
            document.getElementById('layer_co_notes').value = document.getElementById(id).value;
            document.getElementById('layer_co_notes_dest').value = id;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
        }

        function setNotes() {
            var id = document.getElementById('layer_co_notes_dest').value;
            document.getElementById(id).value = document.getElementById('layer_co_notes').value;
            //document.getElementById(id + '_display').innerHTML  	= document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
            document.getElementById('layer_co').style.display = 'none';
            document.getElementById('layer_co_x').style.display = 'none';
        }
    </script>
{/literal}