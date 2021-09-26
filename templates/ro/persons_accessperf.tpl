{include file="persons_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend>{translate label='Acces performanta'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="400">
                        <tr>
                            <td><input type="checkbox" name="accessperf[1]" value="1" {if $info.AccessPerf == 1 || $info.AccessPerf == 3}checked{/if}></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Performanta actiuni : Actiuni divizii, Plan actiuni'}</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="accessperf[2]" value="2" {if $info.AccessPerf == 2 || $info.AccessPerf == 3}checked{/if}></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Performanta obiective: Obiective angajati, Obiective proprii'}</td>
                        </tr>
                        {if $info.rw==1}
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td><input type="submit" name="save" value="{translate label='Salveaza'}" class="formstyle"></td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
