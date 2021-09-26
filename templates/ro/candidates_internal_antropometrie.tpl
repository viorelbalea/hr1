{include file="candidates_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Date antropometrice'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Grupa sangvina'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="Grupa_sangvina" class="dropdown">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$grupa_sangvina key=key item=item}
                                        <option value="{$key}" {if $info.Grupa_sangvina != '' && $key == $info.Grupa_sangvina}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>RH:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="HR" class="dropdown">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$sang_hr key=key item=item}
                                        <option value="{$key}" {if !empty($info.HR) && $key == $info.HR}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Greutate (kg)'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Greutate" value="{$info.Greutate|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Inaltime (m)'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Inaltime" value="{$info.Inaltime|default:''}" size="20" maxlength="16"></td>
                        </tr>
                    </table>
                </fieldset>
                {if $info.rw == 1 || !empty($smarty.post)}
                    <div align="center"><br><input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button" value="{translate label='Inapoi'}"
                                                                                                                                onclick="window.location='./?m=candidates'"
                                                                                                                                class="formstyle"></div>{/if}
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Masuri'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Masura casca'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_casca" value="{$info.Masura_casca|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Masura manusi'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_manusi" value="{$info.Masura_manusi|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Masura haine (salopeta)'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_haine" value="{$info.Masura_haine|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Masura pantaloni'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_pantaloni" value="{$info.Masura_pantaloni|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Masura pantofi'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_pantofi" value="{$info.Masura_pantofi|default:''}" size="20" maxlength="16"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
