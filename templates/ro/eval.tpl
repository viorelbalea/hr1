<div class="submeniu">
    <a href="./?m=eval&o=forms" class="unselected">{translate label='Lista evaluari'}</a>
    {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 1 || $smarty.session.ACCESSEVAL == 3}
        <a href="./?m=eval&o=formsDraft" class="unselected">{translate label='Formulare evaluare'}</a>
        <a href="./?m=eval&o=evalDraft&action=new" class="unselected">{translate label='Adauga formular evaluare'}</a>
        <a href="./?m=eval&o=evalAssign" class="unselected">{translate label='Asignare evaluare'}</a>
    {/if}
    <a href="./?m=eval&o=evalPersons" class="selected">{translate label='Evaluari angajati'}</a>
</div>

<form action="{$smarty.server.REQUEST_URI}" method="post" name="perf" onsubmit="return validForm(document.perf);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>

            <td valign="top" class="bkdTitleMenu" align="right">
                <!--
		<input type="button" class="cod" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
		<input type="button" class="cod" value="{translate label='Printeaza pagina'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
	-->
            </td>
        </tr>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="padding: 10px;">
                <fieldset>
                    <legend>{translate label='Evaluare'} <b>{$person.FullName}</b>{translate label=' pentru perioada'} <b>{$StartDate}</b> -
                        <b>{$EndDate}</b></legend>
                    <table cellspacing="0" cellpadding="4">
                        {if !empty($FormCode)}
                            <tr>
                                <td colspan="4"><b>{translate label='Cod formular'}:</b> {$FormCode}</td>
                            </tr>
                        {/if}
                        {if !empty($FormDesc)}
                            <tr>
                                <td colspan="4">{$FormDesc}</td>
                            </tr>
                        {/if}
                        <tr valign="top">
                            <td align="left" class="bkdTitleMenu" width="400"><b>{translate label='Criteriu'}</b></td>
                            <td align="center" class="bkdTitleMenu" width="100"><b>{translate label='Pondere'}</b></td>


                            {if $isPerson || (($isManager || $isManager2) && $Completed==1)  || $isMediator || $smarty.session.USER_ID==1}
                                <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota autoevaluare'}</b></td>
                                <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'}</b></td>
                            {/if}


                            {if ($isPerson && $Approved==1 && $ShowResults==1) || ($isManager && $Completed==1) || $isMediator || $ShowResults==1}
                                <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota'}
                                        <br/>{translate label='evaluator'}</b></td>
                                <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='evaluator'}
                                    </b></td>
                            {/if}

                            {if ($isPerson && $Approved2==1 && $ShowResults==1) || ($isManager2 && $Completed==1) || ($isMediator && $Approved2==1) || ($ShowResults==1 && $Approved2==1)}
                                <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota'}
                                        <br/>{translate label='evaluator 2'}</b></td>
                                <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='evaluator 2'}
                                    </b></td>
                            {/if}

                            {if ($isPerson && $Mediated==2 && $ShowResults==1) || ($isManager && $Mediated==2) || ($isMediator && $Mediated!=0) || $ShowResults==1}
                                <td align="center" class="bkdTitleMenu" width="150"><b>{translate label='Nota '}
                                        <br/>{translate label='mediator '}</b></td>
                                <td align="center" class="bkdTitleMenu"><b>{translate label='Comentariu'} <br/>{translate label='mediator '}</b>
                                </td>
                            {/if}
                        </tr>

                        {foreach from=$eval key=k item=section}
                            <tr>
                                <td colspan="50" style="border-bottom:1px solid #EDEDED; background-color:#FCFCFC;"><strong><br/>{$k}</strong>
                                </td>
                            </tr>
                            {foreach from=$section item=item}
                                <tr>
                                    <td class="celulaMenuST">{$item.Question}</td>
                                    <td align="center" class="celulaMenuST">{$item.Pondere}%</td>
                                    <!-- Autoevaluare -->
                                    {if $isPerson || (($isManager || $isManager2) && $Completed==1)  || $isMediator  || $smarty.session.USER_ID==1}
                                        <td class="celulaMenuST">
                                            <table>
                                                {if ($Completed==1) || $isMediator  || $smarty.session.USER_ID==1}
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
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="1"
                                                                   {if $item.Mark==1}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="2"
                                                                   {if $item.Mark==2}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="3"
                                                                   {if $item.Mark==3}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="4"
                                                                   {if $item.Mark==4}checked{/if}></td>
                                                        <td><input type="radio" name="Mark[{$item.EvalID}]" value="5"
                                                                   {if $item.Mark==5}checked{/if}></td>
                                                    </tr>
                                                {/if}
                                            </table>
                                        </td>
                                        <td class="celulaMenuSTDR">

                                            {if ($isPerson && $Completed==0) && !$isMediator  && $smarty.session.USER_ID!=1}
                                                <textarea name="Comment[{$item.EvalID}]">{$item.Comment}</textarea>
                                            {else}
                                                {$item.Comment|default:'-'}
                                            {/if}

                                        </td>
                                    {/if}
                                    <!-- Pentru Manageri -->


                                    {if ($isPerson && $Approved==1 && $ShowResults==1) || ($isManager && $Completed==1) || $isMediator || $ShowResults==1}
                                        <td class="celulaMenuST">
                                            <table>
                                                {if ($Approved==1||$Completed==0)  || $smarty.session.USER_ID==1}
                                                    <tr align="center">
                                                        <td><b>{$item.ManagerMark}</b></td>
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
                                                        <td><input type="radio" name="ManagerMark[{$item.EvalID}]" value="1"
                                                                   {if $item.ManagerMark==1}checked{/if}></td>
                                                        <td><input type="radio" name="ManagerMark[{$item.EvalID}]" value="2"
                                                                   {if $item.ManagerMark==2}checked{/if}></td>
                                                        <td><input type="radio" name="ManagerMark[{$item.EvalID}]" value="3"
                                                                   {if $item.ManagerMark==3}checked{/if}></td>
                                                        <td><input type="radio" name="ManagerMark[{$item.EvalID}]" value="4"
                                                                   {if $item.ManagerMark==4}checked{/if}></td>
                                                        <td><input type="radio" name="ManagerMark[{$item.EvalID}]" value="5"
                                                                   {if $item.ManagerMark==5}checked{/if}></td>
                                                    </tr>
                                                {/if}
                                            </table>
                                        </td>
                                        <td class="celulaMenuSTDR">
                                            {if $Approved==0 && $isManager && $smarty.session.USER_ID!=1}
                                                <textarea name="ManagerComment[{$item.EvalID}]">{$item.ManagerComment}</textarea>
                                            {else}
                                                {$item.ManagerComment|default:'-'}
                                            {/if}
                                        </td>
                                    {/if}

                                    <!-- Pentru Evaluatori 2 -->


                                    {if ($isPerson && $Approved2==1 && $ShowResults==1) || ($isManager2 && $Completed==1) || ($isMediator && $Approved2==1) || ($ShowResults==1 && $Approved2==1)}
                                        <td class="celulaMenuST">

                                            <table>

                                                {if ($Approved2==1||$Completed==0)  || $smarty.session.USER_ID==1}
                                                    <tr align="center">

                                                        <td><b>{$item.ManagerMark2}</b></td>

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

                                                        <td><input type="radio" name="ManagerMark2[{$item.EvalID}]" value="1"
                                                                   {if $item.ManagerMark2==1}checked{/if}></td>

                                                        <td><input type="radio" name="ManagerMark2[{$item.EvalID}]" value="2"
                                                                   {if $item.ManagerMark2==2}checked{/if}></td>

                                                        <td><input type="radio" name="ManagerMark2[{$item.EvalID}]" value="3"
                                                                   {if $item.ManagerMark2==3}checked{/if}></td>

                                                        <td><input type="radio" name="ManagerMark2[{$item.EvalID}]" value="4"
                                                                   {if $item.ManagerMark2==4}checked{/if}></td>

                                                        <td><input type="radio" name="ManagerMark2[{$item.EvalID}]" value="5"
                                                                   {if $item.ManagerMark2==5}checked{/if}></td>

                                                    </tr>
                                                {/if}

                                            </table>

                                        </td>
                                        <td class="celulaMenuSTDR">

                                            {if $Approved2==0 && !$isMediator && $isManager2 && $smarty.session.USER_ID!=1}
                                                <textarea name="ManagerComment2[{$item.EvalID}]">{$item.ManagerComment2}</textarea>
                                            {else}

                                                {$item.ManagerComment2|default:'-'}

                                            {/if}

                                        </td>
                                    {/if}

                                    <!-- Mediator -->

                                    {if ($isPerson && $Mediated==2 && $ShowResults==1) || ($isManager && $Mediated==2) || ($isMediator && $Mediated!=0) || $ShowResults==1}
                                        <td class="celulaMenuST">
                                            <table>
                                                {if $Mediated==2}
                                                    <tr align="center">
                                                        <td><b>{$item.MediatorMark}</b></td>
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
                                                        <td><input type="radio" name="MediatorMark[{$item.EvalID}]" value="1"
                                                                   {if $item.MediatorMark==1}checked{/if}></td>
                                                        <td><input type="radio" name="MediatorMark[{$item.EvalID}]" value="2"
                                                                   {if $item.MediatorMark==2}checked{/if}></td>
                                                        <td><input type="radio" name="MediatorMark[{$item.EvalID}]" value="3"
                                                                   {if $item.MediatorMark==3}checked{/if}></td>
                                                        <td><input type="radio" name="MediatorMark[{$item.EvalID}]" value="4"
                                                                   {if $item.MediatorMark==4}checked{/if}></td>
                                                        <td><input type="radio" name="MediatorMark[{$item.EvalID}]" value="5"
                                                                   {if $item.MediatorMark==5}checked{/if}></td>
                                                    </tr>
                                                {/if}
                                            </table>
                                        </td>
                                        <td class="celulaMenuSTDR">

                                            {if $Mediated != 2  && $isMediator}
                                                <textarea name="MediatorComment[{$item.EvalID}]">{$item.MediatorComment}</textarea>
                                            {else}
                                                {$item.MediatorComment|default:'-'}
                                            {/if}

                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}
                        {/foreach}
                        {if $isPerson || ($isManager && $Completed==1 && $Approved==1) || $isMediator  || $smarty.session.USER_ID==1}
                            <tr>
                                <td>{translate label=' Evaluarea este incheiata?'}
                                    <br/>{translate label='(se bifeaza de catre persoana evaluata)'}</td>
                                <td align="center"><input type="checkbox" name="Completed"
                                                          value="1" {if ($Approved==1 || $Completed==1) || $Mediated==2 || $isMediator  || $smarty.session.USER_ID==1} disabled="disabled"{/if} {if $Completed==1} checked="checked" {/if}>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                        {if ($isPerson && $Approved==1) || ($isManager && $Completed==1) || $isMediator }
                            <tr>
                                <td>{translate label='Aprobare evaluare.'} <br/>{translate label='(se bifeaza de catre evaluatorul direct)'}
                                </td>
                                <td align="center"><input type="checkbox" name="Approved"
                                                          value="1" {if ($Approved==1||$Completed==0)|| $Mediated==2  || $smarty.session.USER_ID==1} disabled="disabled"{/if} {if $Approved==1} checked="checked"{/if}>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}

                        {if $isManager2 && $Completed==1 }
                            <tr>

                                <td>{translate label='Aprobare evaluare secundara.'}
                                    <br/>{translate label='(se bifeaza de catre evaluatorul secund)'}</td>

                                <td align="center"><input type="checkbox" name="Approved2"
                                                          value="1" {if ($Approved2==1||$Completed==0)|| $Mediated==2  || $smarty.session.USER_ID==1} disabled="disabled"{/if} {if $Approved2==1} checked="checked"{/if}>
                                </td>

                                <td>&nbsp;</td>

                            </tr>
                        {/if}


                        {if (($isPerson && $Approved==1) || ($isManager && $Completed==1) || ($isMediator))}
                            <tr>
                                <td>{translate label='Incheiere mediere.'} <br/>{translate label='(se bifeaza de catre mediator)'}</td>
                                <td align="center"><input type="checkbox" name="Mediated"
                                                          value="2" {if $isPerson || $Mediated==2} disabled="disabled"{/if} {if $Mediated==2} checked="checked"{/if}>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}


                        {if ($isPerson && $Approved==1 && $ShowResults==1) || ($isManager && $Completed==1) || $isMediator }
                            <tr>

                                <td>{translate label='Afisare scoruri.'} <br/>{translate label='(se bifeaza de catre evaluatorul direct)'}</td>

                                <td align="center"><input type="checkbox" name="ShowResults"
                                                          value="1" {if ($Approved==0 || $Completed==0 || $ShowResults==1) || !isMediator || $smarty.session.USER_ID==1} disabled="disabled"{/if} {if $ShowResults==1} checked="checked"{/if}>
                                </td>

                                <td>&nbsp;</td>

                            </tr>
                        {/if}

                        <tr>
                            <td colspan="3">
                                {if ($smarty.session.PersonID==$evalPersonID && $Completed==0) ||

                                ($smarty.session.PersonID!=$evalPersonID && $Completed==1 && $Approved==0 && $isManager) ||

                                ($smarty.session.PersonID!=$evalPersonID && $Completed==1 && $Approved2==0 && $isManager2) ||

                                (($Mediated==1)  && ($smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3)) ||
                                ($smarty.session.PersonID!=$evalPersonID && ($isManager || $isManager2 || $isMediator) && $Approved==1 && $Completed==1 && $Mediated == 0 && $ShowResults==1)}
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
