{include file="training_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" name="perf" onsubmit="return validForm(document.perf);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>

            <td valign="top" class="bkdTitleMenu" align="right">
                <!--
		<input type="button" class="cod" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
		<input type="button" class="cod" value="Printeaza pagina" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
	-->
            </td>
        </tr>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="padding: 10px;">
                <fieldset>
                    <legend>Evaluare <b>{$person.FullName}</b> pentru perioada <b>{$StartDate}</b> - <b>{$EndDate}</b></legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr valign="top">
                            <td align="left" class="bkdTitleMenu" width="400"><b>{translate label='Criteriu'}</b></td>
                            <td align="center" class="bkdTitleMenu" width="100"><b>{translate label='Pondere'}</b></td>

                            {if ($isPerson && $Completed) || $isEvaluator  || $smarty.session.USER_ID==1}
                                <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota evaluare'}</b></td>
                                <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'}</b></td>
                            {/if}
                        </tr>

                        {foreach from=$eval key=k item=section}
                            <tr>
                                <td colspan="50" style="border-bottom:1px solid #EDEDED; background-color:#FCFCFC;"><strong><br/>{$k}</strong></td>
                            </tr>
                            {foreach from=$section item=item}
                                <tr>
                                    <td class="celulaMenuST">{$item.Question}</td>
                                    <td align="center" class="celulaMenuST">{$item.Pondere}%</td>
                                    <!-- Evaluare -->
                                    {if ($isPerson && $Completed) || $isEvaluator  || $smarty.session.USER_ID==1}
                                        <td class="celulaMenuST">
                                            <table>
                                                {if $Completed==1 || $smarty.session.USER_ID==1}
                                                    <tr align="center">
                                                        <td align="center"><b>{$item.Mark}</b></td>
                                                    </tr>
                                                {else}
                                                    <tr align="center">
                                                        <td>1</td>
                                                        <td>2</td>
                                                        <td>3</td>
                                                        <td>4</td>
                                                        <td>5</td>
                                                    </tr>
                                                    <tr align="center">
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="1" {if $item.Mark==1}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="2" {if $item.Mark==2}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="3" {if $item.Mark==3}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="4" {if $item.Mark==4}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="5" {if $item.Mark==5}checked{/if}></td>
                                                    </tr>
                                                {/if}
                                            </table>
                                        </td>
                                        <td class="celulaMenuSTDR">
                                            {if (isEvaluator && $Completed==0 && $smarty.session.USER_ID!=1)}
                                                <textarea name="Comment[{$item.EvalID}]">{$item.Comment}</textarea>
                                            {elseif isPerson || $smarty.session.USER_ID==1}
                                                {$item.Comment|default:'-'}
                                            {/if}

                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}
                        {/foreach}
                        {if ($isEvaluator && $Completed==0) || $smarty.session.USER_ID==1}
                            <tr>
                                <td>{translate label=' Evaluarea este incheiata?'} <br/>{translate label='(se bifeaza de catre persoana evaluatoare)'}</td>
                                <td align="center"><input type="checkbox" name="Completed"
                                                          value="1" {if $Completed==1 || $smarty.session.USER_ID==1} disabled="disabled"{/if} {if $Completed==1} checked="checked" {/if}>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                        <tr>
                            <td colspan="3">
                                {if ($smarty.session.PersonID==$evalEvaluatorID && $Completed==0)}
                                    <input type="submit" value="{translate label='Salveaza'}">
                                    &nbsp;&nbsp;
                                {else}

                                {/if}

                                <input type="button" value="{translate label='Inapoi'}" onclick="history.back();">
                            </td>
                        </tr>
                    </table>
                </fieldset>

            </td>
        </tr>
        <tr>
            <td colspan="6" valign="top" class="bkdTitleMenu">&nbsp;</td>
        </tr>
    </table>
</form>
