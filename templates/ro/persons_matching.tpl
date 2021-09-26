{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{translate label='Potrivire persoane'}</span>
        </td>
    </tr>
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 100%;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" method="post" name="pers">
                <fieldset>
                    <legend>{translate label='Potrivire persoane'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <select name="src_person" size="20">
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="submit" value="Potrivire &gt;&gt;">
                            <td>
                            <td>
                                <select name="dst_person" size="20">
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
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
