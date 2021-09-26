{include file="persons_menu.tpl"}

<!---->


<div id="layer_co" class="layer" style="display: none;">

    <div class="eticheta">

        {$eticheta}

    </div>

    <h3 class="layer">{translate label='Descriere'}</h3>

    <div class="observatiiTextbox">

        <textarea id="layer_co_notes"></textarea>

        <input type="hidden" id="layer_co_notes_dest" value=""/>


    </div>


    <div class="saveObservatii">

        <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">

        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">

    </div>

</div>

<!---->

<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>


<div id="layer_inventarpayments" class="layer" style="display: none;">

    <div class="eticheta">

        {$eticheta}

    </div>

    <h3 class="layer" id="layer_title">{translate label='Plati obiect inventar'}</h3>

    <div id="layer_inventarpayments_content" class="layerContent"></div>


</div>

<div id="layer_inventarpayments_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_inventarpayments').style.display = 'none'; document.getElementById('layer_inventarpayments_x').style.display = 'none'; window.location.reload();">
    x
</div>


<br>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

    <tr>

        <td valign="top" class="bkdTitleMenu">

            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>

        </td>

        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$rights.FullName}</span></td>

    </tr>

    {if !empty($smarty.post) && $err->getErrors() == ""}

    <tr height="30">
        <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
    </tr>

    {else}

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
                <legend>{translate label='Obiecte de inventar'}</legend>

                <table cellspacing="0" cellpadding="4">

                    <tr>

                        <td>{translate label='Obiect'}</td>

                        <td>{translate label='Data inceput'}</td>

                        <td>{translate label='Data sfarsit'}</td>

                        <td>{translate label='Observatii'}</td>

                        <td>{translate label='Personal'}</td>

                        <td>{translate label='Achitat'}</td>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                    </tr>

                    {foreach from=$person_inventar key=key item=item}
                        <tr>

                            <td>

                                <select id="ObjID_{$key}">

                                    <option value="0">{translate label='alege...'}</option>

                                    {foreach from=$inventar key=key2 item=item2}
                                        <option value="{$key2}" oldvalue="{$item.ObjID}" {if $key2==$item.ObjID}selected{/if}>{$item2.ObjName} ({$item2.ObjCode})</option>
                                    {/foreach}

                                </select>

                            </td>

                            <td nowrap="nowrap">

                                <input type="text" id="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" size="10" maxlength="10">

                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">

                                    var cal1_{$key} = new CalendarPopup();

                                    cal1_{$key}.isShowNavigationDropdowns = true;

                                    cal1_{$key}.setYearSelectStartOffset(10);

                                    //writeSource("js1_{$key}");

                                </SCRIPT>

                                <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('StartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                   NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>

                            </td>

                            <td nowrap="nowrap">

                                <input type="text" id="StopDate_{$key}"
                                       value="{if !empty($item.StopDate) && $item.StopDate != '0000-00-00'}{$item.StopDate|date_format:"%d.%m.%Y"}{/if}" class="formstyle" size="10"
                                       maxlength="10">

                                <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">

                                    var cal2_{$key} = new CalendarPopup();

                                    cal2_{$key}.isShowNavigationDropdowns = true;

                                    cal2_{$key}.setYearSelectStartOffset(10);

                                    //writeSource("js2_{$key}");

                                </SCRIPT>

                                <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('StopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                   NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>

                            </td>

                            <td>

                                <input type="hidden" id="Notes_{$key}" value="{$item.Notes}"/>

                                <span id="Notes_{$key}_display"></span>

                                [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]

                                <!--<textarea id="Notes_{$key}" rows="2" cols="40" wrap="soft"  style="width:100%">{$item.Notes}</textarea>-->

                            </td>

                            <td style="text-align: center;"><input type="checkbox" id="PersonProperty_{$key}"
                                                                   value="1" {if $item.PersonProperty} checked="checked"  {if $item.Payed > 0} disabled="disabled"{/if}{/if} />

                            <td style="text-align: right;">{if $item.PersonProperty}<a href="#" onclick="getPayments({$key}); return false;">{$item.Payed}</a>{else}&nbsp;{/if}</td>

                            <td>{if $rights.rw == 1}
                                    <div id="button_mod"><a href="#"
                                                            onclick="if (document.getElementById('ObjID_{$key}').value > 0 && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, '{translate label='Data inceput'}')) window.location.href = './?m=persons&o=inventar&PersonID={$smarty.get.PersonID}&action=edit&ID={$key}&ObjID=' + document.getElementById('ObjID_{$key}').value + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value + '&Notes=' + escape(document.getElementById('Notes_{$key}').value) + '&PersonProperty=' + (document.getElementById('PersonProperty_{$key}').checked ? '1' : '0'); else alert('{translate label='Completati Obiect, Data inceput!'}'); return false;"
                                                            title="{translate label='Modifica obiect de inventar'}"><b>Mod</b></a></div>{/if}</td>

                            <td>{if $rights.rw == 1}
                                    <div id="button_del"><a href="#"
                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=inventar&PersonID={$smarty.get.PersonID}&action=del&ID={$key}&what='+document.getElementById('ObjID_{$key}').value; return false;"
                                                            title="{translate label='Sterge obiect de inventar'}"><b>Del</b></a></div>{/if}</td>

                        </tr>
                    {/foreach}

                    <tr>

                        <td>

                            <select id="ObjID_0">

                                <option value="0">alege...</option>
                                {foreach from=$inventar key=key item=item}
                                    <option value="{$key}" {if $item.ObjCountAssigned >= $item.ObjCount}disabled{/if}>{$item.ObjName} ({$item.ObjCode})</option>
                                {/foreach}

                            </select>

                        </td>

                        <td nowrap="nowrap">

                            <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">

                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">

                                var cal1_0 = new CalendarPopup();

                                cal1_0.isShowNavigationDropdowns = true;

                                cal1_0.setYearSelectStartOffset(10);

                                //writeSource("js1_0");

                            </SCRIPT>

                            <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                        src="./images/cal.png" border="0"></A>

                        </td>

                        <td nowrap="nowrap">

                            <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">

                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">

                                var cal2_0 = new CalendarPopup();

                                cal2_0.isShowNavigationDropdowns = true;

                                cal2_0.setYearSelectStartOffset(10);

                                //writeSource("js2_0");

                            </SCRIPT>

                            <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                        src="./images/cal.png" border="0"></A>

                        </td>

                        <td>

                            <input type="hidden" id="Notes_0" value="{$item.Notes}"/>

                            <span id="Notes_0_display"></span>

                            [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]

                            <!-- <textarea id="Notes_0" rows="2" cols="40" wrap="soft" style="width:100%"></textarea> -->

                        </td>

                        <td colspan="2">&nbsp;</td>

                        <td colspan="2" nowrap="nowrap">{if $rights.rw == 1}
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('ObjID_0').value > 0 && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, '{translate label='Data inceput'}')) window.location.href = './?m=persons&o=inventar&PersonID={$smarty.get.PersonID}&action=new&ID=0&count=1&ObjID=' + document.getElementById('ObjID_0').value + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Completati Obiect, Data inceput!'}'); return false;"
                                                        title="{translate label='Adaugaa obiect de inventar'}"><b>Add</b></a></div>{/if}</td>

                    </tr>

                </table>

            </fieldset>

            <br/>

            <fieldset>
                <legend>{translate label='Obiect'}</legend>

                <table cellspacing="0" cellpadding="4">

                    <tr>

                        <td>{translate label='Numar telefon'}</td>

                        <td>{translate label='Data inceput'}</td>

                        <td>{translate label='Data sfarsit'}</td>

                        <td>{translate label='Observatii'}</td>

                        <td>&nbsp;</td>

                        <td>&nbsp;</td>

                    </tr>

                    <tr>

                        <td>

                            <input type="hidden" name="oldMobile" value="{$person_phone_inventar.Mobile}"/>

                            <select id="Mobile">

                                <option value=""></option>

                                {foreach from=$numbers item=itemx key=keyx}
                                    <option value="{$keyx}" {if $person_phone_inventar.Mobile == $itemx.PhoneNo} selected="selected"{/if}>{$itemx.PhoneNo} {$itemx.ContractType}</option>
                                {/foreach}

                            </select>

                            <input type="hidden" name="oldMobileTerminal" value="{$person_phone_inventar.MobileTerminal}"/>

                            <select id="MobileTerminal">

                                <option value="0"></option>

                                {foreach from=$terminals key=keyt item=itemt}
                                    <option value="{$keyt}" {if $person_phone_inventar.MobileTerminal == $keyt} selected="selected"{/if}>{$itemt.ObjName} ({$itemt.ObjCode})
                                    </option>
                                {/foreach}

                            </select>

                        </td>

                        <td nowrap="nowrap">

                            <input type="text" id="StartDate_p0" class="formstyle" value="{$person_phone_inventar.StartDate}" size="10" maxlength="10">

                            <SCRIPT LANGUAGE="JavaScript" ID="js1_p0">

                                var cal1_p0 = new CalendarPopup();

                                cal1_p0.isShowNavigationDropdowns = true;

                                cal1_p0.setYearSelectStartOffset(10);

                                //writeSource("js1_p0");

                            </SCRIPT>

                            <A HREF="#" onClick="cal1_p0.select(document.getElementById('StartDate_p0'),'anchor1_p0','dd.MM.yyyy'); return false;" NAME="anchor1_p0"
                               ID="anchor1_p0"><img src="./images/cal.png" border="0"></A>

                        </td>

                        <td nowrap="nowrap">

                            <input type="text" id="StopDate_p0" class="formstyle" value="{$person_phone_inventar.StopDate}" size="10" maxlength="10">

                            <SCRIPT LANGUAGE="JavaScript" ID="js2_p0">

                                var cal2_p0 = new CalendarPopup();

                                cal2_p0.isShowNavigationDropdowns = true;

                                cal2_p0.setYearSelectStartOffset(10);

                                //writeSource("js2_p0");

                            </SCRIPT>

                            <A HREF="#" onClick="cal2_p0.select(document.getElementById('StopDate_p0'),'anchor2_p0','dd.MM.yyyy'); return false;" NAME="anchor2_p0" ID="anchor2_p0"><img
                                        src="./images/cal.png" border="0"></A>

                        </td>

                        <td><textarea id="Notes_p0" rows="2" cols="40" wrap="soft" style="width:100%">{$person_phone_inventar.Notes}</textarea></td>

                        <td colspan="2">&nbsp;</td>

                        <td colspan="2" nowrap="nowrap">{if $rights.rw == 1}
                                <div id="button_mod"><a id="btnAdd" href="#"><b>Mod</b></a></div>
                            {/if}</td>

                    </tr>

                </table>

            </fieldset>

        </td>


    </tr>

    {/if}

    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='drepturi pe aplicatiile firmei'}</span></td>
    </tr>

</table>


{literal}

    <script type="text/javascript">

        function getPayments(inventar_id) {

            document.getElementById('layer_inventarpayments_content').innerHTML = '';

            var curr_time = new Date().getTime();

            showInfo('./?m=persons&o=inventar&action=payments&ID=' + inventar_id + '&rnd=' + curr_time, 'layer_inventarpayments_content');

            document.getElementById('layer_inventarpayments').style.display = 'block';

            document.getElementById('layer_inventarpayments_x').style.display = 'block';

        }

        <!---->

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

        <!---->

    </script>


<script type="text/javascript">

    $('document').ready(function () {

        $('#btnAdd').click(function () {

            if (document.getElementById('Mobile').value > 0 && document.getElementById('MobileTerminal').value > 0 && document.getElementById('StartDate_p0').value && checkDate(document.getElementById('StartDate_p0').value, '{/literal}{translate label='Data inceput'}{literal}')) {

                result = sendRequest('check_person_inventar', 'PersonID={/literal}{$smarty.get.PersonID}{literal}', 'MobileTerminal=' + $('#MobileTerminal').val(), 'Mobile=' + $('#Mobile').val(), 'StartDate=' + $('#StartDate_p0').val(), 'StopDate=' + $('#StopDate_p0').val());

                var cf = false;


                if (result[0].alocat == 1) {

                    cf = confirm('Telefonul (modelul) ales este deja alocat unei alte persoane: ' + result[0].nume + '\n\n Doriti continuarea procesului?');


                    if (cf == false)

                        return false;

                }


                if (result[1].alocat == 1) {

                    cf = confirm('Numarul de telefon ales este deja alocat unei alte persoane: ' + result[1].nume + '\n\n Doriti continuarea procesului?');


                    if (cf == false)

                        return false;

                }


                window.location.href = './?m=persons&o=inventar&PersonID={/literal}{$smarty.get.PersonID}{literal}&action=save_phone&MobileTerminal=' + document.getElementById('MobileTerminal').value + '&Mobile=' + document.getElementById('Mobile').value + '&StartDate=' + document.getElementById('StartDate_p0').value + '&StopDate=' + document.getElementById('StopDate_p0').value + '&Notes=' + escape(document.getElementById('Notes_p0').value);

            } else {

                alert('{/literal}{translate label='Completati Obiect, Data inceput!'}{literal}');

                return false;

            }


            return false;

        });

    });


    function extractData(data) {

        var arr = new Array();


        for (var i = 0; i < data.length; i++) {

            var obj = new Object;

            obj.alocat = data[i]['alocat'];

            obj.id = data[i]['id'];

            obj.nume = data[i]['nume'];

            arr[arr.length] = obj;

        }


        return arr;

    }


    function sendRequest(method) {

        var url = "./ajax.php?o=" + method;

        for (var i = 1; i < arguments.length; i++) url += "&" + arguments[i];

        url += "/";


        var obj;

        var req = $.ajax({

            type: "GET",

            url: url,

            timeout: 5000,

            datatype: "json",

            async: false,

            success: function (data) {

                obj = extractData(data);

            }

        });


        return obj;

    }


</script>

{/literal}



