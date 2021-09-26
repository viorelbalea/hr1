{include file="car_menu.tpl"}
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="car_submenu.tpl"}</span>
        </td>
    </tr>
</table>
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.DocID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Modificare document'} - {$info.DocName}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare document'}</span></td>
            </tr>
        {/if}
        {if !empty($smarty.post) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Documentul a fost salvat!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Informatii document'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Cod document'}:*</b></td>
                            <td><input type="text" name="DocCode" value="{$info.DocCode|default:''}" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nume document'}:*</b></td>
                            <td><input type="text" name="DocName" value="{$info.DocName|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Descriere'}:</b></td>
                            <td><textarea name="DocDescr" cols="80" rows="6" wrap="soft">{$info.DocDescr|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Taguri'}:</b><br>{translate label='(separate prin , )'}</td>
                            <td><textarea name="Tags" cols="80" rows="4" wrap="soft">{$info.Tags|default:''}</textarea><br>{translate label='(ex: economie, legislatie)'}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Document'}:*</b></td>
                            <td>
                                <input type="file" name="FileName">
                                {if !empty($smarty.get.DocID)}
                                    [ {translate label='Acceseaza documentul'}
                                    <a href="{$info.curr_filename}" target="_blank">{$info.FileName}</a>
                                    ]
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                {if !empty($smarty.get.DocID)}
                                    <input type="hidden" name="curr_filename" value="{$info.curr_filename}">
                                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                                {else}
                                    <input type="submit" value="{translate label='Adauga document'}" class="formstyle">
                                {/if}
                                &nbsp;&nbsp;<input type="button" value="{translate label='Anuleaza'}" onclick="history.back();" class="formstyle">
                            </td>
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

