{include file="persons_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
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
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Etica'}</legend>
                    <div id="items" style="padding-left: 20px; padding-top: 20px;"> {* display="none" *}
                        {foreach from=$item key=key2 item=item2}
                            {if $key2 > 0}
                                <p><input type="checkbox" name="Status[{$key}][{$key2}]" value="1" {if !empty($item2.Status)}checked{/if}> {translate label=$item2.Item}</p>
                            {/if}
                        {/foreach}
                        <table style="width: 550px;" border="0" cellpadding="4" cellspacing="0">
                            <tr>
                                <td><b>Categoria instruita</b></td>
                                <td><b>Responsabil</b></td>
                                <td><b>Data</b></td>
                            </tr>
                            {foreach from=$info.items key=key item=item}
                                <tr>
                                    <td>{$item.Categorie}</td>
                                    <td>{$item.FullName}</td>
                                    <td>{$item.CapitolDate}</td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&ID={$key}&del=1'; return false;"
                                                                title="{translate label='Sterge inregistrarea'}"><b>Del</b></a></div>
                                    </td>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                        <p>
                            {translate label='Categoria instruita'}
                            <select name="Categorie">
                                <option value="0">alege...</option>
                                {foreach from=$etica key=k item=i}
                                    <option value="{$k}">{$i}</option>
                                {/foreach}
                            </select>
                        </p>
                        <p>
                            {translate label='Responsabil'}:
                            <select name="ResponsableID">
                                <option value="0">{translate label='alege...'}</option>
                                {foreach from=$employees key=k item=i}
                                    <option value="{$k}">{$i}</option>
                                {/foreach}
                            </select>&nbsp;&nbsp;&nbsp;
                            Data:
                            <input type="text" name="CapitolDate" id="CapitolDate" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js">
                                var cal = new CalendarPopup();
                                cal.isShowNavigationDropdowns = true;
                                cal.setYearSelectStartOffset(10);
                                //writeSource("js");
                            </SCRIPT>
                            <A HREF="#" onClick="cal.select(document.getElementById('CapitolDate'),'anchor','dd.MM.yyyy'); return false;"
                               NAME="anchor" ID="anchor"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                                                onClick="document.getElementById('CapitolDate').value = ''; return false;">{translate label='Anuleaza'}</A>
                        </p>
                        <p>&nbsp;</p>
                    </div>
                    {if $info[0].rw == 1}
                        <input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                        &nbsp;
                    {/if}
{*                    <input type="button" value="{translate label='Printeaza'}" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=print';" class="formstyle">&nbsp;*}
                    <input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle">
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
