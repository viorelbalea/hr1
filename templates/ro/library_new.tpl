{include file="library_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.DocID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="library_submenu.tpl"}</span></td>
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
                            <td><b>{translate label='Categoria'}:*</b></td>
                            <td>
                                <select name="CatID">
                                    <option value="0">{translate label='alege categoria'}</option>
                                    {foreach from=$cats.0 key=key item=item}
                                        {if $smarty.session.USER_ID==1 || isset($categories.$key)}
                                            <option value="{$key}" {if $info.CatID==$key}selected{/if}>{$item}</option>
                                            {if is_array($cats.$key)}
                                                {foreach from=$cats.$key key=key2 item=item2}
                                                    <option value="{$key2}" {if $info.CatID==$key2}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                                                {/foreach}
                                            {/if}
                                        {/if}
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cod document'}:*</b></td>
                            <td><input type="text" name="DocCode" value="{$info.DocCode|default:''}" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nume document'}:*</b></td>
                            <td><input type="text" name="DocName" value="{$info.DocName|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Versiune'}:</b></td>
                            <td><input type="text" name="DocVersion" value="{$info.DocVersion|default:''}" size="20" maxlength="32"></td>
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
                                    [ Acceseaza documentul
                                    <a href="{$info.curr_filename}" target="_blank">{$info.FileName}</a>
                                    ]
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Citire obligatorie'}:</b></td>
                            <td>
                                <input type="checkbox" name="MandatoryReading" id="MandatoryReading" style="float:left;"
                                       value="1" {if $info.MandatoryReading==1} checked="checked"{/if} onchange="
							if (this.checked==false) 
								document.getElementById('div_InternalFunctions').style.display='none';
							if (this.checked==true) 
								document.getElementById('div_InternalFunctions').style.display='inline';"/>
                                <div id="div_InternalFunction" style="float:left; margin-left:20px;">
                                    <select name="InternalFunctions[]" multiple="multiple" size="10">
                                        {foreach from=$internal_functions item=item}
                                            {foreach from=$item key=key2 item=item2 name=iter2}
                                                {if $smarty.foreach.iter2.first}<optgroup label="{$item2.GroupName}">{/if}
                                                <option value="{$key2}" {if $key2==$info.InternalFunctions[$key2]}selected{/if}>{$item2.Function} [{$item2.GroupName}
                                                    | {$item2.Grad}]
                                                </option>
                                                {if $smarty.foreach.iter2.last}</optgroup>{/if}
                                            {/foreach}
                                        {/foreach}
                                    </select>
                                    <br/>* {translate label='Pentru selectie multipla tineti tasta <b>Ctrl</b> apasata'}
                                </div>
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
                                &nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}" onclick="window.location='./?m=library';" class="formstyle">
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

<script type="text/javascript">
    if (document.getElementById('MandatoryReading').checked == false)
        document.getElementById('div_InternalFunctions').style.display = 'none';
    if (document.getElementById('MandatoryReading').checked == true)
        document.getElementById('div_InternalFunctions').style.display = 'inline';
</script>

