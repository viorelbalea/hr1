{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Setari pe companie'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend>{translate label='Setari'}</legend>
                    <br>
                    <select name="company_id" onchange="if (this.value > 0) window.location.href = './?m=admin&o=settings&company_id=' + this.value;">
                        <option value="0">{translate label="Compania"}</option>
                        {foreach from=$self key=key item=item}
                            <option value="{$key}" {if $smarty.get.company_id == $key}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                    {if !empty($smarty.get.company_id)}
                        <br>
                        <br>
                        <fieldset>
                            <legend>{translate label='Pontaj'}</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td>{translate label='Procent plata suplimentara zi normala'}:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_normal]" value="{$company_settings.pontaj.proc_normal|default:''}" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td>{translate label='Procent plata suplimentara zi de weekend'}:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_weekend]" value="{$company_settings.pontaj.proc_weekend|default:''}" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td>{translate label='Procent plata suplimentara zi de sarbatoare legala'}:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_legal]" value="{$company_settings.pontaj.proc_legal|default:''}" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td>{translate label='Procent plata suplimentara ore de noapte'}:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_night]" value="{$company_settings.pontaj.proc_night|default:''}" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend>{translate label='Concedii'}</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td>{translate label='Managerul direct isi poate aproba propriul concediu'}:</td>
                                    <td><input type="checkbox" value="1"
                                               name="company_settings[vacation][manager_self_approve]" {if $company_settings.vacation.manager_self_approve==1} checked="checked" {/if}>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td>{translate label='Grila vechime tine cont de'}:<br>
                                        {translate label='(necesita rularea Recalculare concedii)'}
                                    </td>
                                    <td>
                                        <input type="radio" name="company_settings[vacation][accepted_seniority]" value="1"
                                               id="company_settings[vacation][accepted_seniority]_1" {if $company_settings.vacation.accepted_seniority != 2} checked="checked"{/if}><label
                                                for="company_settings[vacation][accepted_seniority]_1">Vechime in companie</label>
                                        <br>
                                        <input type="radio" name="company_settings[vacation][accepted_seniority]" value="2"
                                               id="company_settings[vacation][accepted_seniority]_2" {if $company_settings.vacation.accepted_seniority == 2} checked="checked"{/if}><label
                                                for="company_settings[vacation][accepted_seniority]_2">Vechime anterioara + vechime in companie</label>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend>{translate label='Catering'}</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td>{translate label='Numar zile anterioare pentru posibilite modificare meniu fata de duminica urmatoare'}:</td>
                                    <td>
                                        <select name="company_settings[catering][menu_days_before]">
                                            <option value="0">{translate label='Alege'}</option>
                                            {section name=tmp start=0 loop=31}
                                                <option value="{$smarty.section.tmp.index}" {if $company_settings.catering.menu_days_before==$smarty.section.tmp.index} selected="selected"{/if}>{$smarty.section.tmp.index}</option>
                                            {/section}
                                        </select>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td>{translate label='Ora pana la care se poate alege meniu zilnic in ultima zi disponibila (setata anterior)'}:</td>
                                    <td>
                                        <select name="company_settings[catering][menu_max_hour]">
                                            <option value="0">{translate label='Alege'}</option>
                                            {section name=tmp start=0 loop=24}
                                                <option value="{$smarty.section.tmp.index}" {if $company_settings.catering.menu_max_hour==$smarty.section.tmp.index} selected="selected"{/if}>{$smarty.section.tmp.index}
                                                    :00
                                                </option>
                                            {/section}
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <div align="center"><br><input type="submit" value="{translate label='Salveaza'}"></div>
                    {/if}
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px; width: 50%;">
                <br>
                {if !empty($smarty.get.company_id)}
                    <fieldset>
                        <legend>{translate label='Logo companie'}</legend>
                        <br>
                        {if $err->getErrors()}
                            <p style="color: #FF0000;">{$err->getErrors()}</p>
                        {/if}
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>{translate label='Foto'}:&nbsp;</td>
                                <td><input type="file" name="photo"></td>
                                <td>
                                    {if isset($company_settings.photo)}
                                        <a href="{$company_settings.photo|replace:'_170_40':''}" title="{translate label='mareste poza'}" target="_blank"><img
                                                    style="padding:2px; margin-left:10px; border:solid 1px #666;" src="{$company_settings.photo}"></a>
                                        <a href="#"
                                           onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta imagine?'}')) window.location.href='./?m=admin&o=settings&company_id={$smarty.get.company_id}&del_photo=1'; return false;"
                                           title="{translate label='Sterge'} class=" blue
                                        ">{translate label='sterge'}</a>
                                    {/if}
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu">{translate label='setari pe companie'}</td>
        </tr>
    </table>
</form>
