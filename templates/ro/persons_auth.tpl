{include file="persons_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="pers">
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend>{translate label='Autentificare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        {if !empty($smarty.post) && $err->getErrors() == ""}
                            <tr>
                                <td>&nbsp;</td>
                                <td style="color: #0000FF;">{translate label='Datele de autentificare au fost salvate!'}</td>
                            </tr>
                        {/if}
                        {if $err->getErrors()}
                            <tr>
                                <td>&nbsp;</td>
                                <td style="text-align: left; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
                            </tr>
                        {/if}
                        <tr height="60">
                            <td><b>{translate label='Username'}:</b></td>
                            <td><input type="text" id="Username" name="Username" value="{$info.Username|default:$info.suggest}" size="30" maxlength="64"></td>
                        </tr>
                        <tr height="35">
                            <td><b>{translate label='Parola'}:</b></td>
                            <td>
                                <input type="password" name="Password" id="Password" value="" size="30" maxlength="64">
                                {if $smarty.session.USER_ID == 1}
                                    <input type="button" value="{translate label='Genereaza'}" onclick="
			var username=document.getElementById('Username').value;
			var passgen =  username.charAt(0).toUpperCase() + username.slice(1) + Math.floor(Math.random()*Math.pow(10,5));
			document.getElementById('passgen').innerHTML = passgen;
			document.getElementById('Password').value = passgen;
			document.getElementById('Password2').value = passgen;
			">
                                    <span id="passgen"></span>
                                {/if}
                            </td>
                        </tr>
                        <tr height="35">
                            <td><b>{translate label='Rescrie parola'}:</b></td>
                            <td><input type="password" name="Password2" id="Password2" value="" size="30" maxlength="64"></td>
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
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend>{translate label='Trimite prin email'}</legend>
                    {if !empty($smarty.post) && $err->getErrors() == "" && !empty($smarty.post.AuthMessageType)}
                        <p style="color: #0000FF;">{translate label='Credentialele au fost trimise!'}</p>
                    {else}
                        <br>
                    {/if}
                    <b>Mesaj:</b>
                    <select name="AuthMessageType"
                            onchange="if (this.value == 'personalizat') document.getElementById('div_AuthMessageBody').style.display = 'block'; else document.getElementById('div_AuthMessageBody').style.display = 'none';">
                        <option value="">{translate label='fara trimitere mesaj'}</option>
                        <option value="standard" {if $smarty.post.AuthMessageType == 'standard'}selected{/if}>{translate label='standard'}</option>
                        <option value="personalizat" {if $smarty.post.AuthMessageType == 'personalizat'}selected{/if}>{translate label='personalizat'}</option>
                    </select>&nbsp;&nbsp;
                    <div id="div_AuthMessageBody" style="display: none;"><br><textarea name="AuthMessageBody" cols="60" rows="8"
                                                                                       wrap="soft">{$info.AuthMessageBody|default:''}</textarea></div>
                    {if $smarty.post.AuthMessageType == 'personalizat'}
                        <script type="text/javascript">document.getElementById('div_AuthMessageBody').style.display = 'block';</script>
                    {/if}
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
