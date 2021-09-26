{include file="job_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="job_submenu.tpl"}</span>
            </td>
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
                    <legend>{translate label='Strategie'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Detalii despre compania angajatoare'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="EmplCompanyInfo" rows="5" cols="60">{$info.EmplCompanyInfo|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Contextul recrutarii (scopul proiectului)'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="RecruitContext" rows="5" cols="60">{$info.RecruitContext|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Strategia de recrutare'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="RecruitmentStrategy" rows="5" cols="60">{$info.RecruitmentStrategy|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Descrierea procesului de recrutare'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="RecruitDescription" rows="5" cols="60">{$info.RecruitDescription|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Detalii despre compania recrutoare'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="RecruitCompanyInfo" rows="5" cols="60">{$info.RecruitCompanyInfo|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Echipa de proiect'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="ProjectTeam" rows="5" cols="60">{$info.ProjectTeam|default:''}</textarea></td>
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
