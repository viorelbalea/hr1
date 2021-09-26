<link href="images/style.css" rel="stylesheet" type="text/css"/>
<div align="center" class="loginPage">
    <br clear="left"/>
    <div>
        <form action="{$smarty.server.REQUEST_URI}" method="post">
            <table class="loginBox" border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td colspan="2" align="left" valign="top" height="80"><a href="./"><img src="images/logo.png" alt=""/></a></td>
                </tr>
                <tr>
                    <td width="150" height="22" align="left" valign="top"><p class="loginText"><b>{translate label='Schimbare parola'}</b></p></td>
                    <td height="22" align="left" valign="top">{if $err->getErrors()}<font color="#FF0000"><b>{$err->getErrors()}</b>{/if}</td>
                </tr>
                <tr>
                    <td align="left" height="30"><p class="loginText">{translate label='Username'}:</p></td>
                    <td align="left" height="30"><b>{$smarty.post.username|default:$smarty.get.username}</b><input type="hidden" name="username"
                                                                                                                   value="{$smarty.post.username|default:$smarty.get.username}">
                    </td>
                </tr>
                <tr>
                    <td align="left" height="30"><p class="loginText">{translate label='Parola noua'}:</p></td>
                    <td align="left" height="30"><input type="password" class="loginInput" name="password" value="" size="27"></td>
                </tr>
                <tr>
                    <td align="left" height="30"><p class="loginText">{translate label='Rescrie parola noua'}:</p></td>
                    <td align="left" height="30"><input type="password" class="loginInput" name="password2" value="" size="27"></td>
                </tr>
                <tr>
                    <td height="30" colspan="2" align="left">
                        <p align="center" style="margin: 1px 0 10px 0;"><input id="loginSubmit" type="submit" value="{translate label='Trimite'}" class="loginSubmit"></p>
                        <input type="hidden" name="area_id" value="{$smarty.post.area_id|default:$smarty.get.area_id}">
                    </td>
                </tr>
                <tr>
                    <td height="145" colspan="2" align="left" valign="top"><p align="center" style="margin-top: 30px;">{$smarty.now|date_format:"%Y"} Ka&Te Associates. All rights
                            reserved </p></td>
                </tr>
            </table>
        </form>
    </div>
</div>
