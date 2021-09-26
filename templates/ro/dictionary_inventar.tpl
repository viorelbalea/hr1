{include file="dictionary_menu.tpl"}

<div class="layer" id="layer_co" style="display: none;">

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

<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"

     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">

    x

</div>


<form action="{$smarty.server.REQUEST_URI}" method="post">

    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

        <tr>

            <td colspan="2" valign="top" class="bkdTitleMenu"><span

                        class="TitleBox">{translate label='Obiecte de inventar'}</span></td>

        </tr>

        <tr>

            <td class="celulaMenuSTDR"

                style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">

                <br>

                <fieldset>

                    <legend>{translate label=' Obiecte de inventar'}</legend>

                    <table border="0" cellpadding="4" cellspacing="0" class="screen">

                        <tr>

                            <td>

                                <table border="0" cellpadding="4" cellspacing="0">

                                    <tr>

                                        <td>{translate label='Nume obiect'}</td>

                                        <td>{translate label='Cod unic'}</td>

                                        <td>{translate label='Nr. obiecte'}</td>

                                        <td>{translate label='Valoare achizitie'}</td>

                                        <td>{translate label='Tip'}</td>

                                        <td style="width:120px;">{translate label='Data achizitie'}</td>

                                        <td>{translate label='Companie'}</td>

                                        <td style="width:110px;">{translate label='Descriere'}</td>

                                        <td>{translate label='Activ'}</td>

                                        <td colspan="2">&nbsp;</td>

                                    </tr>

                                    {foreach from=$inventar key=key item=item}
                                        <tr>

                                            <td><input type="text" id="ObjName_{$key}" name="ObjName_{$key}"

                                                       value="{$item.ObjName}" size="40" maxlength="128"></td>

                                            <td><input type="text" id="ObjCode_{$key}" name="ObjCode_{$key}"

                                                       value="{$item.ObjCode}" size="10"></td>

                                            <td><input type="text" id="ObjCount_{$key}" name="ObjCount_{$key}"

                                                       value="{$item.ObjCount}" size="10"></td>

                                            <td><input type="text" id="ObjAcqValue_{$key}" name="ObjAcqValue_{$key}"

                                                       value="{$item.ObjAcqValue}" size="10" maxlength="10"></td>

                                            <td>

                                                <select name="ObjCategory_{$key}" id="ObjCategory_{$key}">

                                                    <option value="0"></option>

                                                    {foreach from=$categories item=item2 key=key2}
                                                        <option value="{$key2}" {if $item.ObjCategory == $key2} selected="selected" {/if}>{$item2}</option>
                                                    {/foreach}

                                                </select>

                                            </td>

                                            <td>

                                                <input type="text" id="ObjAcqDate_{$key}" class="formstyle"

                                                       value="{if !empty($item.ObjAcqDate) && $item.ObjAcqDate != '0000-00-00'}{$item.ObjAcqDate|date_format:"%d.%m.%Y"}{/if}"

                                                       size="10" maxlength="10">

                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">

                                                    var cal1_{$key} = new CalendarPopup();

                                                    cal1_{$key}.isShowNavigationDropdowns = true;

                                                    cal1_{$key}.setYearSelectStartOffset(10);

                                                    //writeSource("js1_{$key}");

                                                </SCRIPT>

                                                <A HREF="#"

                                                   onClick="cal1_{$key}.select(document.getElementById('ObjAcqDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"

                                                   NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png"

                                                                                                  border="0"></A>

                                            </td>

                                            <td>

                                                <select name="Comp_{$key}" id="Comp_{$key}">

                                                    <option value="0">Compania</option>

                                                    {foreach from=$Companies item=item3 key=key3}
                                                        <option value="{$key3}" {if $item.CompanyId==$key3}selected="selected"{/if}>{$item3.CompanyName}</option>
                                                    {/foreach}                                                </select>

                                            </td>

                                            <td>

                                                <input type="hidden" id="ObjNotes_{$key}" value="{$item.ObjNotes}"/>

                                                <span id="ObjNotes_{$key}_display"></span>

                                                [<a href="#" title="{$item.ObjNotes|escape:'javascript'}"

                                                    onclick="getNotes('ObjNotes_{$key}'); return false;">{translate label='Editare'}</a>]

                                            </td>

                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1"

                                                                      {if $item.Status==1}checked{/if}></td>

                                            {if $rw == 1}
                                                <td>

                                                    <div id="button_mod"><a href="#"

                                                                            onclick="if(document.getElementById('ObjCode_{$key}').value.length > 0)

                                                                                    window.location.href = './?m=dictionary&o=inventar&ObjID={$key}' +

                                                                                    '&ObjName=' + escape(document.getElementById('ObjName_{$key}').value) +

                                                                                    '&ObjCode=' + escape(document.getElementById('ObjCode_{$key}').value) +

                                                                                    '&ObjAcqValue=' + escape(document.getElementById('ObjAcqValue_{$key}').value) +

                                                                                    '&ObjCount=' + escape(document.getElementById('ObjCount_{$key}').value) +

                                                                                    '&ObjCategory=' + escape(document.getElementById('ObjCategory_{$key}').value) +

                                                                                    '&ObjAcqDate=' + escape(document.getElementById('ObjAcqDate_{$key}').value) +

                                                                                    '&ObjNotes=' + escape(document.getElementById('ObjNotes_{$key}').value) +

                                                                                    '&Comp='+

                                                                                    escape(document.getElementById('Comp_{$key}').value) +

                                                                                    '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); else alert('{translate label='Cod produsului trebuie completat!'}');

                                                                                    return false;"

                                                                            title="{translate label='Modifica obiect de inventar'}"><b>Mod</b></a>

                                                    </div>

                                                </td>
                                                <td>

                                                    <div id="button_del"><a href="#"

                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=inventar&ObjID={$key}&delObj=1'; return false;"

                                                                            title="{translate label='Sterge obiect de inventar'}"><b>Del</b></a>

                                                    </div>

                                                </td>
                                            {/if}

                                        </tr>
                                    {/foreach}

                                    <tr>
                                        <th colspan="7"> Adauga Obiect de inventar nou</th>
                                    </tr>

                                    <tr>
                                        <td>Nume obiect</td>
                                        <td>Cod Unic</td>
                                        <td>Nr. obiecte</td>
                                        <td>Valoare Achizitie</td>
                                        <td>Tip</td>
                                        <td>Data Achizitie</td>
                                        <td>Companie</td>
                                    </tr>

                                    {if $rw == 1}
                                        <tr>

                                            <td>
                                                <input type="text" id="ObjName_0" name="ObjName_0" size="40" maxlength="128">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjCode_0" name="ObjCode_0" size="10">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjCount_0" name="ObjCount_0" size="10">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjAcqValue_0" name="ObjAcqValue_0" size="10" maxlength="10">
                                            </td>

                                            <td>

                                                <select name="ObjCategory_0" id="ObjCategory_0">

                                                    <option value="0"></option>

                                                    {foreach from=$categories item=item2 key=key2}
                                                        <option value="{$key2}">{$item2}</option>
                                                    {/foreach}

                                                </select>

                                            </td>

                                            <td>

                                                <input type="text" id="ObjAcqDate_0" class="formstyle" value=""

                                                       size="10" maxlength="10">

                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">

                                                    var cal1_0 = new CalendarPopup();

                                                    cal1_0.isShowNavigationDropdowns = true;

                                                    cal1_0.setYearSelectStartOffset(10);

                                                    //writeSource("js1_0");

                                                </SCRIPT>

                                                <A HREF="#"

                                                   onClick="cal1_0.select(document.getElementById('ObjAcqDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"

                                                   NAME="anchor1_0" ID="anchor1_0"><img src="./images/cal.png"

                                                                                        border="0"></A>

                                            </td>

                                            <td>

                                                <select name="Comp_0" id="Comp_0">

                                                    <option value="0">Compania</option>

                                                    {foreach from=$Companies item=item3 key=key3}
                                                        <option value="{$key3}">{$item3.CompanyName}</option>
                                                    {/foreach}

                                                </select>

                                            </td>

                                            {*<td>*}

                                            <input type="hidden" id="ObjNotes_0" value=""/>

                                            {*<span id="ObjNotes_0_display"></span>*}

                                            {*[<a href="#" title=""*}

                                            {*onclick="getNotes('ObjNotes_0'); return false;">{translate label='Editare'}</a>]*}

                                            {*</td>*}

                                            <td>&nbsp;</td>

                                            <td colspan="2">

                                                <div id="button_add"><a href="#"

                                                                        onclick="if(document.getElementById('ObjCode_0').value.length > 0)

                                                                                window.location.href = './?m=dictionary&o=inventar&ObjID=0' +

                                                                                '&ObjName=' + escape(document.getElementById('ObjName_0').value) +

                                                                                '&ObjCode=' + escape(document.getElementById('ObjCode_0').value) +

                                                                                '&ObjAcqValue=' + escape(document.getElementById('ObjAcqValue_0').value) +

                                                                                '&ObjCategory=' + escape(document.getElementById('ObjCategory_0').value) +
                                                                                '&ObjCount=' + escape(document.getElementById('ObjCount_0').value) +
                                                                                '&ObjAcqDate=' + escape(document.getElementById('ObjAcqDate_0').value) +

                                                                                '&Comp=' + escape(document.getElementById('Comp_0').value) +

                                                                                '&ObjNotes=' + escape(document.getElementById('ObjNotes_0').value); else alert('{translate label='Cod produsului trebuie completat!'}');

                                                                                return false;"

                                                                        title="{translate label='Adauga obiect de inventar'}"><b>Add</b></a>

                                                </div>

                                            </td>

                                        </tr>
                                    {/if}

                                </table>

                            </td>

                        </tr>

                    </table>

            </td>

        </tr>

        <tr>

            <td colspan="2" valign="top" class="bkdTitleMenu"><span

                        class="TitleBoxDown">{translate label='lista de obiecte de inventar'}</span></td>

        </tr>

    </table>

</form>


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

            document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';

            document.getElementById('layer_co').style.display = 'none';

            document.getElementById('layer_co_x').style.display = 'none';

        }


    </script>
{/literal}

