{include file="job_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="job">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        <tr>
            <td valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="job_submenu.tpl"}</span></td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.JobTitle}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;" colspan="2">
                <fieldset>
                    <legend>{translate label='Candidati alocati acestui job'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        {foreach from=$job_candidates item=item}
                            {if !empty($persons.$item)}
                                <tr>
                                    <td>
                                        <select id="persons_{$item}">
                                            {foreach from=$persons key=key2 item=item2}
                                                <option value="{$key2}" {if $item==$key2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                        {if $info.rw == 1}<a href="#"
                                                             onclick="if (confirm('{translate label='Sunteti sigur(a)?'}') && document.getElementById('persons_{$item}').value>0) window.location.href='./?m=jobs&o=alloc-candidates&JobID={$smarty.get.JobID}&action=del&PersonID=' + document.getElementById('persons_{$item}').value; return false;">{translate label='sterge'}</a>&nbsp;|{/if}
                                        <a href="#"
                                           onclick="window.open('./?m=jobs&o=alloc-candidates&JobID={$smarty.get.JobID}&action=options&PersonID=' + document.getElementById('persons_{$item}').value, 'options', 'scrollbars=yes, width=600, height=600'); return false;">{translate label='optiuni'}</a>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                        {if $info.rw >= 0}
                            <tr>
                                <td>
                                    <select id="persons_0">
                                        <option value="0">{translate label='alege candidat'}</option>
                                        {foreach from=$persons key=key2 item=item2}
                                            {if !in_array($key2, $job_candidates)}
                                                <option value="{$key2}">{$item2}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                    <a href="#"
                                       onclick="if (document.getElementById('persons_0').value>0) window.location.href='./?m=jobs&o=alloc-candidates&JobID={$smarty.get.JobID}&action=add&PersonID=' + document.getElementById('persons_0').value; return false;">{translate label='adauga'}</a>
                                </td>
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
