{include file="news_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="news" id="news" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.NewsID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="news_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare stire'}</span></td>
            </tr>
        {/if}

        {if !empty($smarty.post) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Stirea a fost salvata!'}</td>
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
                            <td><b>{translate label='Titlu'}:*</b></td>
                            <td colspan="2"><input type="text" name="Title" value="{$info.Title|default:''}" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                        <tr>
                            <td><b>{translate label='Continut'}:*</b></td>
                            <td colspan="2">{$content}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data'}:</b></td>
                            <td>
                                <input type="text" name="CreateDate" class="formstyle"
                                       value="{if !empty($info.CreateDate) && $info.BIStartDate != '0000-00-00'}{$info.CreateDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.news.CreateDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                                   title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                            <td align="left" rowspan="3">
                                <div style="width:100%; height:70px; overflow:auto; white-space:nowrap;">
                                    {foreach from=$images key=key item=item}
                                        <div align="left" style="float:left; margin-top:2px; height:68px; ">
                                            <img src="images/50/{$item}" alt="" onclick="document.getElementById('Image_{$key}').checked='true';" style="cursor:pointer;"/>
                                            <br/>
                                            <input type="radio" name="Image" id="Image_{$key}" value="{$item}" {if $item==$info.Image} checked="checked"{/if} />
                                        </div>
                                    {/foreach}
                                    <div align="center" style="float:left; background-color:#FF0000;">
                                        <div align="center" style="height:35px; width:50px; color:#FFF; padding:0 3px; cursor:pointer; cursor:pointer;"
                                             onclick="document.getElementById('NoImage').checked='true';"><b>Fara <br/>imagine</b></div>
                                        <br/>
                                        <input type="radio" name="Image" id="NoImage" value="" {if $info.Image==''} checked="checked"{/if} />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="90"><b>{translate label='Tip'}:</b></td>
                            <td>
                                <select name="Type">
                                    {foreach from=$types key=key item=item}
                                        <option value="{$key}" {if $key == $info.Type}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td nowrap="nowrap">
                                {if !empty($smarty.get.NewsID)}
                                    <input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                                {else}
                                    <input type="submit" value="{translate label='Adauga stire'}" class="formstyle">
                                {/if}
                                &nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}" onclick="window.location='./?m=news';" class="formstyle">
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

