{include file="newsletters_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="news" id="news" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.NewsletterID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="newsletters_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare stire'}</span></td>
            </tr>
        {/if}

        {if (!empty($smarty.post) ||$smarty.get.msg==1) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Stirea a fost salvata!'}</td>
            </tr>
        {elseif $smarty.get.msg==2 && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='E-mailul de test a fost trimis!'}</td>
            </tr>
        {else}
            {if $err->getErrors()}
                <tr>
                    <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
                </tr>
            {/if}
        {/if}
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Informatii stire'}</legend>
                    <table width="100%" border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Campanie*'}:</b></td>
                            <td colspan="2"><input type="text" name="Campaign" value="{$info.Campaign|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Subiect e-mail*'}:</b></td>
                            <td colspan="2"><input type="text" name="Title" value="{$info.Title|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='De la nume*'}:</b></td>
                            <td colspan="2"><input type="text" name="FromAlias" value="{$info.FromAlias|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='De la e-mail*'}:</b></td>
                            <td colspan="2"><input type="text" name="FromEmail" value="{$info.FromEmail|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><b>{translate label='Continut*'}:</b></td>
                            <td colspan="2">{$content}</td>
                        </tr>
                        <tr>
                            <td colspan="2" width="150"><b>{translate label='Status trimitere:'}</b><br/>
                                {translate label='Se poate trimite un singur newsletter odata; <br />daca este setat activ, celelate vor deveni inactive.'}

                            </td>
                            <td><select name="Status">
                                    {foreach from=$status key=key item=item}
                                        <option value="{$key}" {if $key == $info.Status}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        {if $smarty.get.o=='edit-intern' || $smarty.get.o=='new-intern'}
                            <tr>
                                <td width="90"><b>{translate label='Destinatari'}:</b></td>
                                <td>
                                    <select name="CompanyID"
                                            onchange="if (this.value>0) showInfo('ajax.php?o=recipients-internal&CompanyID=' + this.value + '&NewsletterID='+ {$smarty.get.NewsletterID} + '&rand=' + parseInt(Math.random()*999999999), 'div_RecipientsInternal');">
                                        <option value="-1">{translate label='Companii'}</option>
                                        {foreach from=$self key=key item=item}
                                            <option value="{$key}" {if $key == $info.Company}selected{/if}>{$item}</option>
                                        {/foreach}
                                        <option value="999999999">{translate label='Toate companiile'}</option>
                                    </select>
                                </td>
                                <td>
                                    <div id="div_RecipientsInternal"></div>
                                    <input type="checkbox" class="checkall"> {translate label='Selecteaza toti'}
                                </td>
                            </tr>
                        {else if $smarty.get.o=='edit-extern' || $smarty.get.o=='new-extern'}
                            <tr>
                                <td width="90"><b>{translate label='Destinatari'}:</b></td>
                                <td>
                                    <select name="CompanyID"
                                            onchange="if (this.value>0) showInfo('ajax.php?o=recipients-external&CompanyID=' + this.value + '&NewsletterID='+ {$smarty.get.NewsletterID} + '&rand=' + parseInt(Math.random()*999999999), 'div_RecipientsExternal');">
                                        <option value="-1">{translate label='Companii'}</option>
                                        {foreach from=$companies key=key item=item}
                                            <option value="{$key}" {if $key == $info.Company}selected{/if}>{$item.CompanyName}</option>
                                        {/foreach}
                                        <option value="999999999">{translate label='Toate companiile'}</option>
                                    </select>
                                </td>
                                <td>
                                    <div id="div_RecipientsExternal"></div>
                                    <input type="checkbox" class="checkall"> {translate label='Selecteaza toti'}
                                </td>
                            </tr>
                        {/if}
                        {if $info.Recipients}
                            <tr>
                                <td width="90"><b>{translate label='Destinatari existenti'}:</b></td>
                                <td colspan="2" style="border:solid 1px #333;">
                                    {$info.Recipients}
                                </td>
                            </tr>
                        {/if}
                        <tr>
                            <td><b>{translate label='E-mailuri auxiliare'}:</b>{translate label='(separate prin ;)'}</td>
                            <td colspan="2"><textarea name="AuxRecipients" rows="3" style="width:420px;">{$info.AuxRecipients|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Incarca atasamente'}:</b></td>
                            <td colspan="2">
                                <p><input type="file" name="doc"></p>
                                {if !empty($docs)}
                                    <table border="0" cellpadding="4" cellspacing="0">
                                        {foreach from=$docs key=doc item=docname}
                                            <tr>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_doc&doc=' + escape('{$doc}'); return false;"
                                                                            title="{translate label='Sterge document'}"><b>Del</b></a></div>
                                                </td>
                                                <td><a href="{$doc}" target="_blank">{$docname}</a></td>
                                            </tr>
                                        {/foreach}
                                    </table>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data si ora inceperii trimiterii'}:</b></td>
                            <td>
                                <input type="text" name="SendStartDate" class="formstyle"
                                       value="{if !empty($info.SendStartDate) && $info.SendStartDate != '0000-00-00 00:00:00'}{$info.SendStartDate|date_format:"%d.%m.%Y %H:%M:%S"}{/if}"
                                       size="19" maxlength="19">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(1);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.news.SendStartDate,'anchor1','dd-MM-yyyy hh:mm:ss'); return false;" NAME="anchor1" ID="anchor1"
                                   title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data"></A>
                            </td>
                        </tr>
                        {if !empty($smarty.get.NewsletterID)}
                            <tr>
                                <td><b>{translate label='Adrese e-mail de test'}:</b>{translate label='(separate prin ;)'}</td>
                                <td colspan="2"><textarea name="TestRecipients" rows="1" style="width:420px;">{$info.TestRecipients|default:''}</textarea>
                                    &nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                                                       onclick="window.location='./?m=newsletters&o=send-test&NewsletterID={$smarty.get.NewsletterID}';" class="formstyle">
                                </td>
                            </tr>
                        {/if}
                        <tr>
                            <td>&nbsp;</td>
                            <td nowrap="nowrap">
                                {if !empty($smarty.get.NewsletterID)}
                                    <input type="submit" value="Salveaza" class="formstyle">
                                {else}
                                    <input type="submit" value="Adauga stire" class="formstyle">
                                {/if}
                                &nbsp;&nbsp;<input type="button" value="Inapoi" onclick="window.location='./?m=newsletters';" class="formstyle">
                            </td>
                            <td>&nbsp;</td>
                        </tr>

                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>

    </table>
</form>

<script type="text/javascript">
    {if $smarty.get.o=='edit-intern'}
    showInfo('ajax.php?o=recipients-internal&CompanyID=' + this.value + '&NewsletterID=' + {$smarty.get.NewsletterID} +'&rand=' + parseInt(Math.random() * 999999999), 'div_RecipientsInternal');
    {else}
    showInfo('ajax.php?o=recipients-external&CompanyID=' + this.value + '&NewsletterID=' + {$smarty.get.NewsletterID} +'&rand=' + parseInt(Math.random() * 999999999), 'div_RecipientsExternal');
    {/if}
</script>

{literal}
    <script>
        $(function () {
            $('.checkall').click(function () {
                if (this.checked) {
                    $('#div_RecipientsInternal').find(':checkbox').each(function () {
                        this.checked = true;
                    });

                    $('#div_RecipientsExternal').find(':checkbox').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('#div_RecipientsInternal').find(':checkbox').each(function () {
                        this.checked = false;
                    });

                    $('#div_RecipientsExternal').find(':checkbox').each(function () {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
{/literal}
