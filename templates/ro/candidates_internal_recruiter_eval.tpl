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
                    <legend>{translate label='Evaluare recruiter'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Caracteristici generale'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="General" rows="5" cols="60">{$info.General|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Competente'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Competences" rows="5" cols="60">{$info.Competences|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Profil'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Profile" rows="5" cols="60">{$info.Profile|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Sumar'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Summary" rows="5" cols="60">{$info.Summary|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Puncte tari'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Strong" rows="5" cols="60">{$info.Strong|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Puncte de imbunatatit'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Weak" rows="5" cols="60">{$info.Weak|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Motivatie'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="Motivation" rows="5" cols="60">{$info.Motivation|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 10px;" align="center">
                                {if $info.rw == 1 || !empty($smarty.post)}
                                    <div align="center"><br><input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button"
                                                                                                                                                value="{translate label='Inapoi'}"
                                                                                                                                                onclick="window.location='./?m=candidates'"
                                                                                                                                                class="formstyle"></div>{/if}
                            </td>
                        </tr>
                    </table>

                </fieldset>

            </td>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
