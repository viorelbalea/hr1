{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Abonamente'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Abonamente'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td colspan="2" style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">&nbsp;</td>
                                        <td colspan="4"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;">{translate label='Minute'}</td>
                                        <td colspan="2"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;">{translate label='SMS'}</td>
                                        <td colspan="1"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;">{translate label='Date MB National'}</td>
                                        <td colspan="2"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;">{translate label='Roaming'}</td>
                                        <td colspan="1"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;">{translate label='Prelungire achizitie telefon'}</td>
                                        <td colspan="1" style="border-bottom: 1px solid #000; text-align: center;">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="border-left:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Nr. telefon'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Tip abonament'}</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;">{translate label='Grup'}</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;">{translate label='Nationale'}</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;">{translate label='Alte retele mobile'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='International'}</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;">{translate label='Retea'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Nationale'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Trafic date inclus'}</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;">{translate label='Voce min/sms'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Date MB'}</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">&nbsp;</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">{translate label='Cost'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$contracts key=key item=item}
                                        <tr>
                                            <td><input type="text" id="PhoneNo_{$key}" name="PhoneNo_{$key}" value="{$item.PhoneNo}" size="17" maxlength="17"></td>
                                            <td><input type="text" id="ContractType_{$key}" name="ContractType_{$key}" value="{$item.ContractType}"></td>
                                            <td><input type="text" id="MinuteGrup_{$key}" name="MinuteGrup_{$key}" value="{$item.MinuteGrup}" size="10"></td>
                                            <td><input type="text" id="MinuteNationale_{$key}" name="MinuteNationale_{$key}" value="{$item.MinuteNationale}" size="10"></td>
                                            <td><input type="text" id="MinuteAlte_{$key}" name="MinuteAlte_{$key}" value="{$item.MinuteAlte}" size="10"></td>
                                            <td><input type="text" id="MinuteInternationale_{$key}" name="MinuteInternationale_{$key}" value="{$item.MinuteInternationale}"
                                                       size="10"></td>
                                            <td><input type="text" id="SMSRetea_{$key}" name="SMSRetea_{$key}" value="{$item.SMSRetea}" size="10"></td>
                                            <td><input type="text" id="SMSNat_{$key}" name="SMSNat_{$key}" value="{$item.SMSNat}" size="10"></td>
                                            <td><input type="text" id="TraficNational_{$key}" name="TraficNational_{$key}" value="{$item.TraficNational}" size="10"></td>
                                            <td><input type="text" id="RoamingVoce_{$key}" name="RoamingVoce_{$key}" value="{$item.RoamingVoce}" size="10"></td>
                                            <td><input type="text" id="RoamingTrafic_{$key}" name="RoamingTrafic_{$key}" value="{$item.RoamingTrafic}" size="10"></td>
                                            <td><input type="text" id="PrelungireAchizitie_{$key}" name="PrelungireAchizitie_{$key}" value="{$item.PrelungireAchizitie}"></td>
                                            <td><input type="text" id="Cost_{$key}" name="Cost_{$key}" value="{$item.Cost}"></td>

                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#" onclick="window.location.href = './?m=dictionary&o=phone_contracts&ID={$key}' +
                                                                '&PhoneNo=' + escape(document.getElementById('PhoneNo_{$key}').value) +
                                                                '&ContractType=' + escape(document.getElementById('ContractType_{$key}').value) +
                                                                '&MinuteGrup=' + escape(document.getElementById('MinuteGrup_{$key}').value) +
                                                                '&MinuteNationale=' + escape(document.getElementById('MinuteNationale_{$key}').value) +
                                                                '&MinuteAlte=' + escape(document.getElementById('MinuteAlte_{$key}').value) +
                                                                '&MinuteInternationale=' + escape(document.getElementById('MinuteInternationale_{$key}').value) +
                                                                '&SMSRetea=' + escape(document.getElementById('SMSRetea_{$key}').value) +
                                                                '&SMSNat=' + escape(document.getElementById('SMSNat_{$key}').value) +
                                                                '&TraficNational=' + escape(document.getElementById('TraficNational_{$key}').value) +
                                                                '&RoamingVoce=' + escape(document.getElementById('RoamingVoce_{$key}').value) +
                                                                '&RoamingTrafic=' + escape(document.getElementById('RoamingTrafic_{$key}').value) +
                                                                '&PrelungireAchizitie=' + escape(document.getElementById('PrelungireAchizitie_{$key}').value) +
                                                                '&Cost=' + escape(document.getElementById('Cost_{$key}').value);
                                                                return false;" title="{translate label='Modifica contract'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=phone_contracts&ID={$key}&del=1'; return false;"
                                                                            title="{translate label='Sterge contract'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="PhoneNo_0" name="PhoneNo_0" size="17" maxlength="17"></td>
                                            <td><input type="text" id="ContractType_0" name="ContractType_0"></td>
                                            <td><input type="text" id="MinuteGrup_0" name="MinuteGrup_0" size="10"></td>
                                            <td><input type="text" id="MinuteNationale_0" name="MinuteNationale_0" size="10"></td>
                                            <td><input type="text" id="MinuteAlte_0" name="MinuteAlte_0" size="10"></td>
                                            <td><input type="text" id="MinuteInternationale_0" name="MinuteInternationale_0" size="10"></td>
                                            <td><input type="text" id="SMSRetea_0" name="SMSRetea_0" size="10"></td>
                                            <td><input type="text" id="SMSNat_0" name="SMSNat_0" size="10"></td>
                                            <td><input type="text" id="TraficNational_0" name="TraficNational_0" size="10"></td>
                                            <td><input type="text" id="RoamingVoce_0" name="RoamingVoce_0" size="10"></td>
                                            <td><input type="text" id="RoamingTrafic_0" name="RoamingTrafic_0" size="10"></td>
                                            <td><input type="text" id="PrelungireAchizitie_0" name="PrelungireAchizitie_0"></td>
                                            <td><input type="text" id="Cost_0" name="Cost_0"></td>

                                            <td colspan="2">
                                                <div id="button_add"><a href="#" onclick="window.location.href = './?m=dictionary&o=phone_contracts&ID=0' +
				                                                                                 '&PhoneNo=' + escape(document.getElementById('PhoneNo_0').value) +  
				                                                                                 '&ContractType=' + escape(document.getElementById('ContractType_0').value) +  
				                                                                                 '&MinuteGrup=' + escape(document.getElementById('MinuteGrup_0').value) +  
				                                                                                 '&MinuteNationale=' + escape(document.getElementById('MinuteNationale_0').value) +  
				                                                                                 '&MinuteAlte=' + escape(document.getElementById('MinuteAlte_0').value) +  
				                                                                                 '&MinuteInternationale=' + escape(document.getElementById('MinuteInternationale_0').value) +  
				                                                                                 '&SMSRetea=' + escape(document.getElementById('SMSRetea_0').value) +  
				                                                                                 '&SMSNat=' + escape(document.getElementById('SMSNat_0').value) +  
				                                                                                 '&TraficNational=' + escape(document.getElementById('TraficNational_0').value) +  
				                                                                                 '&RoamingVoce=' + escape(document.getElementById('RoamingVoce_0').value) +  
				                                                                                 '&RoamingTrafic=' + escape(document.getElementById('RoamingTrafic_0').value) +  
				                                                                                 '&PrelungireAchizitie=' + escape(document.getElementById('PrelungireAchizitie_0').value) +  
				                                                                                 '&Cost=' + escape(document.getElementById('Cost_0').value); 
														 return false;" title="{translate label='Adauga contract'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de obiecte de inventar'}</span></td>
        </tr>
    </table>
</form>
