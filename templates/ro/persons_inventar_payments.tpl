<div style="height:20px">
    {if !empty($smarty.get.msg) && $smarty.get.msg == 1}
        <span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
    {/if}
</div>


<table border="0" cellpadding="4" cellspacing="0" width="100%">

    <tr valign="top">

        <td>

            <table border="0" cellpadding="4" cellspacing="0">

                <tr>

                    <td>{translate label='Nr. factura'}</td>

                    <td colspan="3"><input type="text" id="InvoiceNo" value="{$info.InvoiceNo|default:''}" size="10" maxlength="10"></td>

                </tr>

                <tr>

                    <td>{translate label="Data factura"}</td>

                    <td colspan="3">

                        <input type="text" id="InvoiceDate" class="formstyle"
                               value="{if !empty($info.InvoiceDate) && $info.InvoiceDate != '0000-00-00'}{$info.InvoiceDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">

                        <A HREF="#"
                           onClick="var cal1 = new CalendarPopup(); cal1.isShowNavigationDropdowns = true; cal1.setYearSelectStartOffset(10); cal1.select(document.getElementById('InvoiceDate'),'anchor1','dd.MM.yyyy'); return false;"
                           NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"></A>

                    </td>

                </tr>

                <tr>

                    <td>{translate label="Data scadenta"}</td>

                    <td colspan="3">

                        <input type="text" id="PaymentDueDate" class="formstyle"
                               value="{if !empty($info.PaymentDueDate) && $info.PaymentDueDate != '0000-00-00'}{$info.PaymentDueDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                               maxlength="10">

                        <A HREF="#"
                           onClick="var cal2 = new CalendarPopup(); cal2.isShowNavigationDropdowns = true; cal2.setYearSelectStartOffset(10); cal2.select(document.getElementById('PaymentDueDate'),'anchor2','dd.MM.yyyy'); return false;"
                           NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A>

                    </td>

                </tr>

                <tr>

                    <td>{translate label='Valoare factura'}</td>

                    <td colspan="2">

                        <input type="text" id="InvoiceValue" value="{$info.InvoiceValue|default:''}" size="10" maxlength="10" style="text-align:right;">

                    </td>

                    <td>

                        <select id="InvoiceCurrency">

                            {foreach from=$coins key=key item=item}
                                <option value="{$item}" {if $item==$info.InvoiceCurrency}selected{/if}>{$item}</option>
                            {/foreach}

                        </select>

                    </td>

                </tr>


            </table>

        </td>

        <td>
            <div style="width:100%; height:200px; overflow-y:scroll">
                <table border="0" cellpadding="4" cellspacing="0" width="100%">

                    <tr width="440px">


                        <td width="242px" colspan="2">{translate label='Valoare'}</td>

                        <td width="113px">{translate label="Data"}</td>

                        <td width="52px" colspan="2">&nbsp;</td>

                    </tr>


                    {foreach from=$payments key=key item=item}
                        <tr width="440px">

                            <td width="165px">

                                <input type="text" id="Value_{$key}" value="{$item.Value}" style="text-align: right;">

                            </td>

                            <td width="68px">

                                <select id="Currency_{$key}">

                                    {foreach from=$coins key=key2 item=item2}
                                        <option value="{$item2}" {if $item2==$item.Currency}selected{/if}>{$item2}</option>
                                    {/foreach}

                                </select>

                            </td>

                            <td width="113px">

                                <input type="text" id="PaymentDate_{$key}" class="formstyle"
                                       value="{if !empty($item.PaymentDate) && $item.PaymentDate != '0000-00-00'}{$item.PaymentDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">

                                <A HREF="#"
                                   onClick="var cal3_{$key} = new CalendarPopup(); cal3_{$key}.isShowNavigationDropdowns = true; cal3_{$key}.setYearSelectStartOffset(10); cal3_{$key}.select(document.getElementById('PaymentDate_{$key}'),'anchor3_{$key}','dd.MM.yyyy'); return false;"
                                   NAME="anchor3_{$key}" ID="anchor3_{$key}"><img src="./images/cal.png" border="0"></A>

                            </td>

                            <td width="34px">
                                <div id="button_mod"><a href="#"
                                                        onclick="if (document.getElementById('Value_{$key}').value > 0 && document.getElementById('PaymentDate_{$key}').value.length > 0)

                                                                showInfo('{$smarty.server.REQUEST_URI}&save=2&PaymentID={$key}' +

                                                                '&Value=' + document.getElementById('Value_{$key}').value +

                                                                '&Currency=' + document.getElementById('Currency_{$key}').value +

                                                                '&PaymentDate=' + document.getElementById('PaymentDate_{$key}').value

                                                                , 'layer_inventarpayments_content'); else alert('{translate label='Nu ati specificat toate informatiile!'}');

                                                                return false;" title="{translate label='Modificare plata'}"><b>Mod</b></a></div>
                            </td>

                            <td width="34px">
                                <div id="button_del"><a href="#"
                                                        onclick="if (confirm('Sunteti sigur(a)?')) showInfo('{$smarty.server.REQUEST_URI}&save=2&PaymentID={$key}&del=1', 'layer_inventarpayments_content'); return false;"
                                                        title="{translate label='Stergere plata'}"><b>Del</b></a></div>
                            </td>

                        </tr>
                    {/foreach}

                    <tr>

                        <td>

                            <input type="text" id="Value_0" style="text-align: right;">

                        </td>

                        <td>

                            <select id="Currency_0">

                                {foreach from=$coins key=key2 item=item2}
                                    <option value="{$item2}">{$item2}</option>
                                {/foreach}

                            </select>

                        </td>

                        <td>

                            <input type="text" id="PaymentDate_0" class="formstyle" value="{$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">

                            <A HREF="#"
                               onClick="var cal3_0 = new CalendarPopup(); cal3_0.isShowNavigationDropdowns = true; cal3_0.setYearSelectStartOffset(10); cal3_0.select(document.getElementById('PaymentDate_0'),'anchor3_0','dd.MM.yyyy'); return false;"
                               NAME="anchor3_0" ID="anchor3_0"><img src="./images/cal.png" border="0"></A>

                        </td>

                        <td colspan="2">
                            <div id="button_add"><a href="#" onclick="if (document.getElementById('Value_0').value > 0 && document.getElementById('PaymentDate_0').value.length > 0)

                                        showInfo('{$smarty.server.REQUEST_URI}&save=2&PaymentID=0' +

                                        '&Value=' + document.getElementById('Value_0').value +

                                        '&Currency=' + document.getElementById('Currency_0').value +

                                        '&PaymentDate=' + document.getElementById('PaymentDate_0').value

                                        , 'layer_inventarpayments_content'); else alert('{translate label='Nu ati specificat toate informatiile!'}');

                                        return false;" title="{translate label='Adaugare articol'}"><b>Add</b></a></div>
                        </td>

                    </tr>
                </table>
            </div>
            <table border="0" cellpadding="4" cellspacing="0">
                <tr>

                    <td colspan="2" width="242px" style="border-top: 1px solid #a4a4a4;">{translate label="Total achitat"}&nbsp;({$smarty.session.CURRENCY.CURRENT})</td>

                    <td width="113px" style="border-top: 1px solid #a4a4a4; text-align: right;">{$info.Payed}</td>

                    <td width="32px" colspan="2" style="border-top: 1px solid #a4a4a4;">&nbsp;</td>

                </tr>

                <tr>

                    <td colspan="2">{translate label="Diferenta"}</td>

                    <td style="text-align: right;">{$info.ToPay}</td>

                    <td colspan="2">&nbsp;</td>

                </tr>

                <tr>

                    <td colspan="7" id="check_invoice_message"></td>

                </tr>

            </table>


        </td>

    </tr>
</table>
<div class="saveObservatii">
    <input type="button" value="{translate label='Salveaza'}" onclick="showInfo('{$smarty.server.REQUEST_URI}&save=1' +

            '&InvoiceNo=' +  escape(document.getElementById('InvoiceNo').value) +

            '&InvoiceDate=' + escape(document.getElementById('InvoiceDate').value) +

            '&PaymentDueDate=' + escape(document.getElementById('PaymentDueDate').value) +

            '&InvoiceValue=' + escape(document.getElementById('InvoiceValue').value) +

            '&InvoiceCurrency=' + document.getElementById('InvoiceCurrency').value

            , 'layer_inventarpayments_content'); document.getElementById('layer_inventarpayments').style.display = 'none'; document.getElementById('layer_inventarpayments_x').style.display = 'none';">

</div>







    