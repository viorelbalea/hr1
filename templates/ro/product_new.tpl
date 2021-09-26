{include file="product_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="product" onsubmit="return validateForm(this);" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.ProductID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="product_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare produs'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Adaugare produs'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Producator'}:</b></td>
                            <td>
                                <select name="CompanyID">
                                    <option value="0">{translate label='alege'}</option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}" {if $info.CompanyID==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Categorie'}:</b></td>
                            <td>
                                <select name="CategoryID">
                                    <option value="0">{translate label='alege'}</option>
                                    {foreach from=$categories.0 key=PCatID item=item}
                                        <option value="{$PCatID}" {if $info.CategoryID==$PCatID}selected{/if}>{$item}</option>
                                        {if !empty($categories.$PCatID)}
                                            {foreach from=$categories.$PCatID key=CatID item=item2}
                                                <option value="{$CatID}" {if $info.CategoryID==$CatID}selected{/if}>&nbsp;&nbsp;&nbsp;{$item2}</option>
                                            {/foreach}
                                        {/if}
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Promotie'}:</b></td>
                            <td>
                                <select name="Promo">
                                    <option value="0">{translate label='Nu'}</option>
                                    <option value="1" {if $info.Promo==1}selected{/if}>{translate label='Da'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Second Hand'}:</b></td>
                            <td>
                                <select name="SecondHand">
                                    <option value="0">{translate label='Nu'}</option>
                                    <option value="1" {if $info.SecondHand==1}selected{/if}>{translate label='Da'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Lichidare de stoc'}:</b></td>
                            <td>
                                <select name="StocOff">
                                    <option value="0">{translate label='Nu'}</option>
                                    <option value="1" {if $info.StocOff==1}selected{/if}>{translate label='Da'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Pret'} Lei:</b></td>
                            <td><input type="text" name="Price" value="{$info.Price|default:''}" size="10" maxlength="10" style="text-align: right"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Pret'} Euro:</b></td>
                            <td><input type="text" name="PriceEur" value="{$info.PriceEur|default:''}" size="10" maxlength="10" style="text-align: right"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Discount maxim'}:</b></td>
                            <td><input type="text" name="MaxDiscount" value="{$info.MaxDiscount|default:''}" size="10" maxlength="10" style="text-align: right">&nbsp;(%)</td>
                        </tr>
                        {if !empty($customfields.CustomProduct1)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomProduct1}:</b></td>
                                <td><input type="text" name="CustomProduct1" value="{$info.CustomProduct1|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomProduct2)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomProduct2}:</b></td>
                                <td><input type="text" name="CustomProduct2" value="{$info.CustomProduct2|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomProduct3)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomProduct3}:</b></td>
                                <td>
                                    <input type="text" id="CustomProduct3" name="CustomProduct3" class="formstyle"
                                           value="{if !empty($info.CustomProduct3) && $info.CustomProduct3 != '0000-00-00 00:00:00'}{$info.CustomProduct3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomProduct3">
                                        var cal_CustomProduct3 = new CalendarPopup();
                                        cal_CustomProduct3.isShowNavigationDropdowns = true;
                                        cal_CustomProduct3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomProduct3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomProduct3.select(document.getElementById('CustomProduct3'),'anchor_CustomProduct3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomProduct3" ID="anchor_CustomProduct3"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
                <br>
                <div align="center">
                    {if !empty($smarty.get.ProductID)}
                        {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    {else}
                        <input type="submit" value="{translate label='Adauga produs'}" class="formstyle">
                    {/if}
                </div>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Adaugare produs'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Denumire produs'}:</b></td>
                            <td><input type="text" name="Title" value="{$info.Title|default:''}" size="30" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Descriere'}:</b></td>
                            <td><textarea name="Description" rows="10" cols="60">{$info.Description|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Unitate de masura'}:</b></td>
                            <td>
                                <select name="UnitID">
                                    {foreach from=$measurement_units key=key item=item}
                                        <option value="{$key}" {if $info.UnitID==$key}selected{/if}>{$item.Unit}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Poza'}:</b></td>
                            <td><input type="file" name="photo"></td>
                        </tr>
                        {if isset($info.photo)}
                            <tr>
                                <td></td>
                                <td>
                                    <a href="{$info.photoBig}" title="{translate label='mareste poza'}" target="_blank"><img style="padding:2px; border:solid 1px #666;"
                                                                                                                             src="{$info.photo}" width="100"></a>
                                    <p><a href="#"
                                          onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta poza?'}')) window.location.href='./?m=products&o=del_photo&ProductID={$smarty.get.ProductID}'; return false;"
                                          title="{translate label='Sterge'} class=" blue">{translate label='sterge'}</a></p>
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
