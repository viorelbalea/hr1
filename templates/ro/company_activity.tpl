{include file="companies_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.CompanyID)}
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox">{include file="companies_submenu.tpl"}</span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.CompanyName}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare companie'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label=' Datele companiei au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 4px; padding-bottom: 10px;" width="65%">
                <br>
                <fieldset>
                    <legend>{translate label='Domenii de activitate principale'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>#</td>
                            <td>{translate label='Obiecte activitate'}</td>
                            <td>{translate label='Activ'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$activities key=key item=item}
                            <tr>
                                <td>{$key}</td>
                                <td>
                                    <select name="CompanyDomainID_{$item.ID}" id="CompanyDomainID_{$item.ID}" class="dropdown">
                                        <option value="0">alege...</option>
                                        {foreach from=$companydomains key=key2 item=item2}
                                            <option value="{$key2}" {if $key2 == $item.CompanyDomainID}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td><input type="checkbox" id="active_{$item.ID}" {if $item.Active == 1}checked{/if}></td>
                                <td>{if $info.rw == 1}
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('CompanyDomainID_{$item.ID}').value<=0 ) alert('{translate label='Nu ati selectat Obiect activitate'}!'); else window.location.href = '{$smarty.server.REQUEST_URI}&action=mod&ID={$item.ID}&CompanyDomainID=' + escape(document.getElementById('CompanyDomainID_{$item.ID}').value) + '&active=' + (document.getElementById('active_{$item.ID}').checked == true ? 1 : 0); return false;"
                                                                title="{translate label='Modifica activitate'}"><b>Mod</b></a></div>{/if}</td>
                                <td>{if $info.rw == 1}
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceasta activitate?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del&ID={$item.ID}'; return false;"
                                                                title="{translate label='Sterge activitate'}"><b>Del</b></a></div>{/if}</td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td>&nbsp;</td>
                            <td><select name="CompanyDomainID_0" id="CompanyDomainID_0" class="dropdown">
                                    <option value="0">alege...</option>
                                    {foreach from=$companydomains key=key2 item=item2}
                                        <option value="{$key2}">{$item2}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="checkbox" id="active_0"></td>
                            <td>{if $info.rw == 1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('CompanyDomainID_0').value<=0) alert('{translate label='Nu ati selectat Obiect activitate'}!'); else window.location.href = '{$smarty.server.REQUEST_URI}&action=add&CompanyDomainID=' + escape(document.getElementById('CompanyDomainID_0').value) +  '&active=' + (document.getElementById('active_0').checked == true ? 1 : 0); return false;"
                                                            title="{translate label='Adauga activitate'}"><b>Add</b></a></div>{/if}</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Training'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Compania ofera training'}:</b></td>
                            <td><input type="checkbox" name="isTrainer" value="1" {if $info.isTrainer==1}checked{/if}></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Detalii training'}:</b></td>
                            <td><textarea name="TrainingNotes" rows="3" cols="36">{$info.TrainingNotes|default:''}</textarea></td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Tipul de training oferit'}:</b></td>
                            <td>
                                {foreach from=$training_types key=key item=item}
                                    <input type="checkbox" name="TrainingTypeID[{$key}]" value="{$key}" {if !empty($info.training_types.$key)}checked{/if}>
                                    {$item}
                                    <br>
                                {/foreach}
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Asigurare / beneficii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Compania ofera asigurari / beneficii'}:</b></td>
                            <td><input type="checkbox" name="isAssurance" value="1" {if $info.isAssurance==1}checked{/if}></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Detalii asigurari / beneficii'}:</b></td>
                            <td><textarea name="AssuranceNotes" rows="3" cols="36">{$info.AssuranceNotes|default:''}</textarea></td>
                        </tr>
                    </table>
                </fieldset>


                <br/>

                <fieldset>
                    <legend>{translate label='Fleet Management'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Compania este furnizor de servicii auto'}:</b></td>
                            <td><input type="checkbox" name="isAutoFurnizor" value="1" {if $info.isAutoFurnizor==1}checked{/if}></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Detalii servicii auto'}:</b></td>
                            <td><textarea name="AutoFurnizorNotes" rows="3" cols="36">{$info.AutoFurnizorNotes|default:''}</textarea></td>
                        </tr>
                    </table>
                </fieldset>

            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 4px; padding-right: 4px;">
                <br>
                <fieldset>
                    <legend>{translate label='Descriere firma'}</legend>
                    <textarea name="CompanyDescr" cols="44" rows="12" wrap="soft">{$info.CompanyDescr}</textarea>
                </fieldset>
                <br>
                {if $info.rw == 1 || !empty($smarty.post)}
                    <div align="center"><input type="submit" value="{translate label='Salveaza'}" class="formstyle"></div>{/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
