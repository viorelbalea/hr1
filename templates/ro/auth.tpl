<form action="{$smarty.server.REQUEST_URI}" method="post" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend>{translate label='Date autentificare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;">
                        {if $err->getErrors()}
                            <tr>
                                <td>&nbsp;</td>
                                <td style="text-align: left; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
                            </tr>
                        {/if}
                        <tr height="60">
                            <td><b>{translate label='Username'}:</b></td>
                            <td><input type="text" name="Username" value="{$info.Username|default:$info.suggest}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Parola'}:</b></td>
                            <td><input type="text" name="Password" value="{$info.Password|default:'123456'}" size="30" maxlength="64"></td>
                        </tr>
                        <tr height="40">
                            <td>&nbsp;</td>
                            <td><input type="submit" value="{translate label='Salveaza'}" class="formstyle"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><font color="#FFFFFF">{translate label='campurile marcate cu * sunt obligatorii'}</td>
        </tr>
    </table>
</form>
