{include file="forum_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.post) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Firul de discutie a fost salvat!'}</td>
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
                    <legend>{translate label='Informatii discutie'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Status'}:</b></td>
                            <td>
                                <select name="Status">
                                    {foreach from=$threadStatus key=key item=item}
                                        <option value="{$key}" {if $info.Status==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <td><b>{translate label='Nume discutie'}:*</b></td>
                        <td><input type="text" name="ThreadName" value="{$info.ThreadName|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Public'}:</b></td>
                            <td><input type="checkbox" name="Public" value="1" {if $info.Public==1} checked="checked"{/if}/></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                                {else}
                                    <input type="submit" value="Adauga discutie" class="formstyle">
                                {/if}
                                &nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}" onclick="history.back();" class="formstyle">
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

