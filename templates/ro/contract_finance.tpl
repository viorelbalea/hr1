{include file="contract_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);" name="contract">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="contract_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.CompanyName}</td>
        </tr>
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele contractului au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
                <br/>
                <fieldset>
                    <legend>{translate label='Informatii financiare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Valoare'}:</b></td>
                            <td><input type="text" name="ContractInitialValue" value="{$info.ContractInitialValue|default:''}" size="20" maxlength="20"></td>
                        </tr>
                        {foreach from=$contract_actead key=key item=item}
                            <tr>
                                <td><b>Act aditional {$item.ActNo}:</b></td>
                                <td>{$item.ActValue}</td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td><b>{translate label='Valoare actualizata'}:</b></td>
                            <td>{$info.ContractValue|default:''}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data plata'}:</b></td>
                            <td>
                                <input type="text" name="PayDate" class="formstyle" value="{if $info.PayDate != '0000-00-00'}{$info.PayDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.contract.PayDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>&nbsp;
                            </td>
                        </tr>

                        <tr>
                            <td><b>{translate label='Tip plata'}:</b></td>
                            <td>
                                <select name="PaymentType" {literal}onchange="if (this.value == 2 || this.value == 3) {
																	document.getElementById('ratenolabel').style.display = 'block'; 
																	document.getElementById('rateno').style.display = 'block'; 
																	document.getElementById('invoicedaylabel').style.display = 'block'; 
																	document.getElementById('invoiceday').style.display = 'block';
																} else {
																	document.getElementById('ratenolabel').style.display = 'none'; 
																	document.getElementById('rateno').style.display = 'none'; 
																	document.getElementById('invoicedaylabel').style.display = 'none'; 
																	document.getElementById('invoiceday').style.display = 'none';
																}
																if (this.value == 4) {
																	document.getElementById('desfRate').style.display = 'block';
																} else{
																	document.getElementById('desfRate').style.display = 'none';
																}"{/literal}>
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$payment_type key=key item=item}
                                        <option value="{$key}" {if $info.PaymentType == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='TVA(%)'}:</b></td>
                            <td>
                                <select name="TVA">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$tva item=item}
                                        <option value="{$item}" {if $info.TVA == $item}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Valoare rata'}:</b></td>
                            <td><input type="text" name="RateValue" value="{$info.RateValue|default:''}" size="20" maxlength="20"></td>
                        </tr>
                        <tr>
                            <td><span id="ratenolabel" style="display: {if $info.PaymentType == 2 || $info.PaymentType == 3}block{else}none{/if};"><b>{translate label='Numar rate'}:</b></span>
                            </td>
                            <td><span id="rateno" style="display: {if $info.PaymentType == 2 || $info.PaymentType == 3}block{else}none{/if};"><input type="text" name="RateNo"
                                                                                                                                                     value="{$info.RateNo|default:''}"
                                                                                                                                                     size="10"
                                                                                                                                                     maxlength="10"></span></td>
                        </tr>
                        <tr>
                            <td><span id="invoicedaylabel"
                                      style="display: {if $info.PaymentType == 2 || $info.PaymentType == 3}block{else}none{/if};"><b>{translate label='Zi facturare'}:</b></span>
                            </td>
                            <td><span id="invoiceday" style="display: {if $info.PaymentType == 2 || $info.PaymentType == 3}block{else}none{/if};"><input type="text"
                                                                                                                                                         name="InvoiceDay"
                                                                                                                                                         value="{$info.InvoiceDay|default:''}"
                                                                                                                                                         size="10"
                                                                                                                                                         maxlength="2"></span></td>
                        </tr>
                    </table>
                </fieldset>

                <br/>

                <fieldset id="desfRate" style="display: {if $info.PaymentType == 4}block{else}none{/if};">
                    <legend>{translate label='Desfasurator de rate'}</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td>{translate label='Numar rata'}</td>
                            <td>{translate label='Valoare fara TVA'}</td>
                            <td>{translate label='Valoare cu TVA'}</td>
                            <td>{translate label='Procent'}</td>
                            <td>{translate label='Realizat'}</td>
                            <td>{translate label='Data plata'}</td>
                            <td>{translate label='Achitat'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$lstRate key=key item=item name=iter}
                            <tr>
                                <td align="center">{$smarty.foreach.iter.iteration}</td>
                                <td><input type="text" id="RataValue_{$key}" value="{$item.RataValue}" size="10" maxlength="16"></td>
                                <td align="center">{$item.RataValueTVA}</td>
                                <td align="center">{$item.RataProcent}%</td>
                                <td align="center">{$item.RataRealizat}%</td>
                                <td nowrap="nowrap">
                                    <input type="text" id="PayDate_{$key}" value="{$item.PayDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                        var cal1_{$key} = new CalendarPopup();
                                        cal1_{$key}.isShowNavigationDropdowns = true;
                                        cal1_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js1_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('PayDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                       NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td align="center"><input type="checkbox" id="RataAchitat_{$key}" value="1" {if $item.RataAchitat==1}checked{/if}></td>

                                <td>
                                    {if $info.rw == 1}
                                        <div id="button_mod">
                                            <a href="#"
                                               onclick="if (document.getElementById('RataValue_{$key}').value && document.getElementById('PayDate_{$key}').value && checkDate(document.getElementById('PayDate_{$key}').value, 'Data plata'))
                                                       window.location.href = './?m=contract&o=finance&ContractID={$smarty.get.ContractID}&action=edit_rata&RataID={$key}&RataValue=' + document.getElementById('RataValue_{$key}').value +
                                                       '&PayDate=' + document.getElementById('PayDate_{$key}').value +
                                                       '&RataAchitat=' + (document.getElementById('RataAchitat_{$key}').checked ? 1 : 0);
                                                       else
                                                       alert('{translate label='Completati Valoare rata fara TVA si Data platii'}!');
                                                       return false;" title="{translate label='Modifica rata'}"><b>Mod</b>
                                            </a>
                                        </div>
                                    {/if}
                                </td>
                                <td>
                                    {if $info.rw == 1}
                                        <div id="button_del">
                                            <a href="#" onclick="if (confirm('{translate label='Sunteti sigur(a)?'}'))
                                                    window.location.href = './?m=contract&o=finance&ContractID={$smarty.get.ContractID}&action=del_rata&RataID={$key}';
                                                    return false;" title="{translate label='Sterge rata'}"><b>Del</b>
                                            </a>
                                        </div>
                                    {/if}
                                </td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td align="center"> -</td>
                            <td><input type="text" id="RataValue_0" value="" size="10" maxlength="16"></td>
                            <td align="center"> -</td>
                            <td align="center"> -</td>
                            <td align="center"> -</td>
                            <td nowrap="nowrap">
                                <input type="text" id="PayDate_0" value="" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                    var cal1_{$key} = new CalendarPopup();
                                    cal1_{$key}.isShowNavigationDropdowns = true;
                                    cal1_{$key}.setYearSelectStartOffset(10);
                                    //writeSource("js1_{$key}");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('PayDate_0'),'anchor1_{$key}','dd.MM.yyyy'); return false;" NAME="anchor1_{$key}"
                                   ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td align="center"> -</td>

                            <td colspan="2" nowrap="nowrap">
                                {if $info.rw == 1}
                                    <div id="button_add">
                                        <a href="#"
                                           onclick="if (document.getElementById('RataValue_0').value && document.getElementById('PayDate_0').value && checkDate(document.getElementById('PayDate_0').value, 'Data plata'))
                                                   window.location.href = './?m=contract&o=finance&ContractID={$smarty.get.ContractID}&action=add_rata&RataValue=' + document.getElementById('RataValue_0').value +
                                                   '&PayDate=' + document.getElementById('PayDate_0').value;
                                                   else
                                                   alert('{translate label='Completati Valoare rata fara TVA si Data platii'}!');
                                                   return false;" title="{translate label='Adauga rata'}"><b>Add</b>
                                        </a>
                                    </div>
                                {/if}
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Garantie'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Tip'}:</b></td>
                            <td>
                                <select name="GuaranteeType">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$guarantee_type key=key item=item}
                                        <option value="{$key}" {if $info.GuaranteeType == $key}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data expirare garantie'}:</b></td>
                            <td>
                                <input type="text" name="GuaranteeExpireDate" class="formstyle"
                                       value="{if $info.GuaranteeExpireDate != '0000-00-00'}{$info.GuaranteeExpireDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4">
                                    var cal4 = new CalendarPopup();
                                    cal4.isShowNavigationDropdowns = true;
                                    cal4.setYearSelectStartOffset(10);
                                    //writeSource("js4");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4.select(document.contract.GuaranteeExpireDate,'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Valoare'}:</b></td>
                            <td><input type="text" name="GuaranteeValue" value="{$info.GuaranteeValue|default:''}" size="20" maxlength="20"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top">
                <br/>
                <div align="center">
                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    <input type="button" class="formstyle" onclick="window.location.href = './?m=contract';" value="{translate label='Inapoi'}">
                </div>
            </td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        {/literal}return (is_empty(f.PayDate.value) ? true : checkDate(f.PayDate.value, '{translate label='Data plata'}')) && (is_empty(f.GuaranteeExpireDate.value) ? true : checkDate(f.GuaranteeExpireDate.value, '{translate label='Data expirare garantie'}'));{literal}
    }
</script>
{/literal}