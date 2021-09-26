<div id="layer_products_table" class="layerContent">
    <table id="products_table" cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
            <td align="left"><b>{translate label="Produs"}</b></td>
            <td align="center"><b>{translate label="Pret"} (Lei)</b></td>
            <td align="center"><b>{translate label="Cantitate"}</b></td>
            <td align="center"><b>{translate label="Suma"} (Lei)</b></td>
            <td align="center"><b>{translate label="Discount"}(%)</b></td>
            <td align="center"><b>{translate label="Valoare"} (Lei)</b></td>
            <td align="center"></td>
            <td align="center"></td>
        </tr>
        {assign var="tstoc" value="0"}
        {assign var="tsum" value="0"}
        {assign var="tvalue" value="0"}
        {foreach from=$offer_products key=key item=item}
            <tr>
                <td>
                    
                <span id="ProductID_{$key}_Title">{$item.Title}<span>
                <input type="hidden" id="ProductID_{$key}" value="{$item.ProductID}"/>

                </td>
                <td align="center">
                    <span id="Price_{$key}_display">{$item.Price}</span>
                    <input type="hidden" id="Price_{$key}" value="{$item.Price}">
                    <input type="hidden" id="MaxDiscount_{$key}" value="{$item.maxdiscount}">
                </td>
                <td>
                    <input type="text" id="Stoc_{$key}" value="{$item.Stoc}" size="6" maxlength="10" align="center">
                </td>
                <td align="center">{math equation="x*y" x=$item.Price y=$item.Stoc format="%.2f"}</td>
                <td>
                    <input type="text" id="Discount_{$key}" value="{$item.Discount}" size="6" maxlength="10">
                </td>
                <td align="center">{math equation="x*y*(1-z/100)" x=$item.Price y=$item.Stoc z=$item.Discount format="%.2f"}</td>
                <td>
                    <div id="button_mod"><a href="#"
                                            onclick="if (parseInt(document.getElementById('Discount_{$key}').value) > parseInt(document.getElementById('MaxDiscount_{$key}').value)) jQuery('#Discount_{$key}').val(jQuery('#MaxDiscount_{$key}').val()); showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&ActProdID={$key}&OfferIndex={$smarty.get.OfferIndex}' +
                                                    '&ProductID=' + document.getElementById('ProductID_{$key}').value +
                                                    '&Price=' + document.getElementById('Price_{$key}').value +
                                                    '&Discount=' + document.getElementById('Discount_{$key}').value +
                                                    '&Stoc=' + document.getElementById('Stoc_{$key}').value + '&rnd={$smarty.now}', 'layer_products_content'); return false;"><b>Mod</b></a>
                    </div>
                </td>
                <td>
                    <div id="button_del"><a href="#"
                                            onclick="showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&ActProdID={$key}&OfferIndex={$smarty.get.OfferIndex}&delete=1&rnd={$smarty.now}', 'layer_products_content'); return false;"><b>Del</b></a>
                    </div>
                </td>
            </tr>
            {math equation="x+y" x=$tstoc y=$item.Stoc assign="tstoc"}
            {math equation="x+y*z" x=$tsum y=$item.Price z=$item.Stoc assign="tsum" format="%.2f"}
            {math equation="x+y*z*(1-t/100)" x=$tvalue y=$item.Price z=$item.Stoc t=$item.Discount assign="tvalue" format="%.2f"}
        {/foreach}
        <tr>
            <td>
                <input id="val_search" class="ui-autocomplete-input" type="text" onfocus="autocomplete_products(this,'{$products_suggest}')"/>

                <input type="hidden" id="ProductID_0" value=""/>
                <input type="hidden" id="MaxDiscount_0" value=""/>

            </td>
            <td align="right">
                <span id="Price_0_display"></span>
                <input type="hidden" id="Price_0" value="">
            </td>
            <td>
                <input type="text" id="Stoc_0" value="1" size="6" maxlength="10">
            </td>
            <td></td>
            <td>
                <input type="text" id="Discount_0" value="" size="6" maxlength="10">
            </td>
            <td></td>
            <td>
                <div id="button_add"><a href="#"
                                        onclick="if (parseInt(document.getElementById('Discount_0').value) > parseInt(document.getElementById('MaxDiscount_0').value)) jQuery('#Discount_0').val(jQuery('#MaxDiscount_0').val()); showInfo('ajax.php?o=offer_products&ActivityDetID={$smarty.get.ActivityDetID}&ActProdID=0&OfferIndex={$smarty.get.OfferIndex}' +
                                                '&ProductID=' + document.getElementById('ProductID_0').value +
                                                '&Price=' + document.getElementById('Price_0').value +
                                                '&Discount=' + document.getElementById('Discount_0').value +
                                                '&Stoc=' + document.getElementById('Stoc_0').value + '&rnd={$smarty.now}', 'layer_products_content');  return false;"><b>Add</b></a>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
</div>
<div>
    <hr style="1px solid #cccccc;"/>
    <table cellspacing="4" cellpadding="6" border="0" width="100%" style=" padding-right:104px; padding-left: 50px">
        <tr>
            <td colspan="3" width="41%"><b>{translate label="Total"}</b></td>
            <td align="left" width="14%" style="padding-left:8px;"><b>{$tstoc}</b></td>
            <td align="right" width="15%"><b>{$tsum}</b></td>
            <td align="right" width="30%"><b>{$tvalue}</b></td>
        </tr>
        <tr>
            <td colspan="5"><b>{translate label="Valoare totala oferta"}</b></td>
            <td align="right"><b>{$tvalue}</b></td>
        </tr>
    </table>
</div>

<hr style="1px solid #cccccc;"/>
  	