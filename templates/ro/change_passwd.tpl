<br>
{if !empty($smarty.post.go) && $smarty.post.go == 2}
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table border="0" cellpadding="4" cellspacing="0">
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Schimbare parola'}</span></td>
            </tr>
            {if $err->getErrors()}
                <tr>
                    <td class="celulaMenuST">&nbsp;</td>
                    <td class="celulaMenuDR" style="text-align: center; color: #FF0000">{$err->getErrors()}</td>
                </tr>
            {/if}
            <tr>
                <td class="celulaMenuST"><b>{translate label='Parola noua'}:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST"><b>{translate label='Rescrie parola noua'}:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password2" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuDR" style="text-align: center;">
                    <input type="hidden" name="go" value="2">
                    <input type="submit" name="save" value="{translate label='Salveaza'}" class="formstyle">
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu">{translate label='campurile marcate cu * sunt obligatorii'}</td>
            </tr>
        </table>
    </form>
{else}
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table border="0" cellpadding="4" cellspacing="0">
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Schimbare parola'}</span></td>
            </tr>
            {if $err->getErrors()}
                <tr>
                    <td class="celulaMenuST">&nbsp;</td>
                    <td class="celulaMenuDR" style="text-align: center; color: #FF0000">{$err->getErrors()}</td>
                </tr>
            {/if}
            <tr>
                <td class="celulaMenuST"><b>{translate label='Parola curenta'}:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuDR" style="text-align: center">
                    <input type="hidden" name="go" value="1">
                    <input type="submit" name="next" value="Pasul urmator" class="formstyle">
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu">{translate label='campurile marcate cu * sunt obligatorii'}</td>
            </tr>
        </table>
    </form>
{/if}