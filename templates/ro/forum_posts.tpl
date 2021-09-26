{include file="forum_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}&action=new_post" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.ThreadName.0}</span></td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.post) && $err->getErrors() == ""}
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
                <br/>
                <!-- Salariu -->
                <fieldset>
                    <legend>{translate label='Lista comentarii'}</legend>
                    {if !empty($posts)}
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_posts').style.display; if (status == 'none') Effect.SlideDown('div_posts'); else Effect.SlideUp('div_posts'); return false;"><b>{translate label='Ascunde lista'}</b></a>
                        </p>
                        <div id="div_posts" style="display:block; width:100%; background:#ccc; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Comentariu'}</span></td>
                                    <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume'}</span></td>
                                    <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data'}</span></td>
                                    {if $thread.Status != 2}
                                        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Sterge'}</span></td>
                                    {/if}
                                </tr>
                                {foreach from=$posts item=item}
                                    <tr>
                                        <td class="celulaMenuST">{$item.PostText}</td>
                                        <td class="celulaMenuST"><b>{$item.FullName}</b></td>
                                        <td class="celulaMenuST">{$item.Date}<br/><i>{$item.Time}</i></td>
                                        {if $thread.Status != 2}
                                            <td class="celulaMenuSTDR">&nbsp;
                                                {if $smarty.session.USER_ID==1 || $smarty.session.PERS==$item.PersonID}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('Esti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_post&PostID={$item.PostID}'; return false;"
                                                                            title="Sterge comentariu"><b>Del</b></a></div>
                                                {/if}
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    {/if}

                    {if $thread && $thread.Status != 2}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td colspan="3"><textarea name="PostText" id="PostText" rows="3" style="width:615px;"></textarea></td>
                                <td><input type="submit" name="post" value="Trimite" class="cod"></td>
                            </tr>
                        </table>
                    {/if}
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>