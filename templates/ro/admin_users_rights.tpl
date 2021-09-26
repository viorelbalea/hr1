{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="rights">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span
                        class="TitleBox">{translate label='Setari modul '} <u>{$app_modules[$smarty.get.module]}</u> {translate label='pentru'} <u>{$info.UserName}</a></span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Setari nivel 2'}</legend>
                    {foreach from=$rights_level2 key=key item=item}
                        <br>
                        {if $smarty.get.module == 20}
                            <b>{$item.name}</b>
                        {else}
                            <input type="checkbox" name="RightsLevel2[{$key}]" value="1" {if $info.UserRightsLevel2[$smarty.get.module][$key] > 0}checked{/if}>
                            <b>{$item.name}</b>
                            {if $item.type == 'list'}
                                {if $smarty.get.module == 9}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="1" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 1}checked{/if}>
                                    {translate label='vede doar actiunile introduse de el'}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="2" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 2}checked{/if}>
                                    {translate label='vede actiunile introduse de el si de catre cei care depind de el'}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="3" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 3}checked{/if}>
                                    {translate label='vede toate actiunile si le poate modifica'}

                                {else}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="1" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 1}checked{/if}>
                                    {translate label='read own'}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="2" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 2}checked{/if}>
                                    {translate label='read all'}
                                    <br>
                                    <input type="radio" name="settings[{$key}]" value="3" {if $info.UserRightsLevel2[$smarty.get.module][$key] == 3}checked{/if}>
                                    {translate label='read all / write own'}
                                    <br>
                                    {if $smarty.get.module == 1 && $info.UserType == 'role'}
                                        <b>Summary</b>
                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="0"
                                               {if $info.UserRightsLevel2[$smarty.get.module][9] == 0}checked{/if}>{translate label='none'}
                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="1"
                                               {if $info.UserRightsLevel2[$smarty.get.module][9] == 1}checked{/if}>{translate label='all'}
                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="2"
                                               {if $info.UserRightsLevel2[$smarty.get.module][9] == 2}checked{/if}>{translate label='others (not own)'}
                                    {/if}

                                {/if}
                            {/if}
                        {/if}
                        <br>
                    {/foreach}
                </fieldset>
                {if !empty($rights_level3)}
                    <br>
                    <fieldset>
                        <legend>Setari nivel 3</legend>
                        {foreach from=$rights_level3 key=key item=item}
                            <br>
                            <table cellspacing="0" celpadding="0" cellpadding="4">
                                {foreach from=$item key=key2 item=item2 name=iter}
                                    <tr>
                                        <td>{$item2.name}</td>
                                        <td align="center"><input type="radio" id="write_{$key2}" name="RightsLevel3[{$key}][{$key2}]" value="2"
                                                                  {if $info.UserRightsLevel3[$smarty.get.module][$key][$key2] == 2}checked{/if}>write
                                        </td>
                                        <td align="center"><input type="radio" id="read_{$key2}" name="RightsLevel3[{$key}][{$key2}]" value="1"
                                                                  {if $info.UserRightsLevel3[$smarty.get.module][$key][$key2] == 1}checked{/if}>read
                                        </td>
                                        <td align="center"><input type="radio" id="none_{$key2}" name="RightsLevel3[{$key}][{$key2}]" value="0"
                                                                  {if $info.UserRightsLevel3[$smarty.get.module][$key][$key2] == 0}checked{/if}>none
                                        </td>
                                        <td align="center" width="150">{position l2=$key l3=$key2 pos=$smarty.foreach.iter.iteration pos_last=$smarty.foreach.iter.total}</td>
                                    </tr>
                                {/foreach}
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><a href="#" onclick="checkall('write'); return false;">{translate label='check all'}</a> | <a href="#"
                                                                                                                                      onclick="uncheckall('write'); return false;">{translate label='uncheck all'}</a>
                                    </td>
                                    <td><a href="#" onclick="checkall('read'); return false;">{translate label='check all'}</a> | <a href="#"
                                                                                                                                     onclick="uncheckall('read'); return false;">{translate label='uncheck all'}</a>
                                    </td>
                                    <td><a href="#" onclick="checkall('none'); return false;">{translate label='check all'}</a> | <a href="#"
                                                                                                                                     onclick="uncheckall('none'); return false;">{translate label='uncheck all'}</a>
                                    </td>
                                    <td align="center"><a href="{$smarty.server.REQUEST_URI}&resetpos=1">reset</a></td>
                                </tr>
                            </table>
                        {/foreach}
                    </fieldset>
                {/if}
                <br>
                <input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}"
                                                                                             onclick="window.location.href = './?m=admin&o=users';">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='utilizatori si drepturi'}</span></td>
        </tr>
    </table>
</form>
{literal}
<script language="javascript">
    function checkall(type) {
        {/literal}
        {foreach from=$rights_level3 key=key item=item}
        {foreach from=$item key=key2 item=item2}
        document.getElementById(type + '_' + {$key2}).checked = true;
        {/foreach}
        {/foreach}
        {literal}
    }

    function uncheckall(type) {
        {/literal}
        {foreach from=$rights_level3 key=key item=item}
        {foreach from=$item key=key2 item=item2}
        document.getElementById(type + '_' + {$key2}).checked = false;
        {/foreach}
        {/foreach}
        {literal}
    }
</script>
{/literal}