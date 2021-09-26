{literal}
    <style>
        select {
            width: 95px;
            font-size: 11px;
        }

        #div_CityID select {
            width: 95px;
            font-size: 11px;
        }
    </style>
{/literal}
<br>
<form action="./?m=reports_maker&o=new" method="post">
    <table cellspacing="0" cellpadding="2" class="grid">
        <tr valign="bottom">
            <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
            {foreach from=$smarty.session.REPORT_MAKER.FIELDS key=key item=item}
                {foreach from=$item key=key2 item=item2}
                    <td class="bkdTitleMenu" width="100" align="center">
                        <span class="TitleBox">{$fields.$key.$item2}</span>
                        <br>
                        <select name="operators[{$key}][{$item2}]">
                            <option value="=">=</option>
                            <option value=">" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == '>'}selected{/if}>&gt;
                            </option>
                            <option value=">=" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == '>='}selected{/if}>
                                &gt;=
                            </option>
                            <option value="<" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == '<'}selected{/if}>&lt;
                            </option>
                            <option value="<=" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == '<='}selected{/if}>
                                &lt;=
                            </option>
                            <option value="<>" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == '<>'}selected{/if}>&lt;&gt;</option>
                            <option value="BETWEEN"
                                    {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == 'BETWEEN'}selected{/if}>BETWEEN
                            </option>
                            <option value="LIKE" {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == 'LIKE'}selected{/if}>
                                LIKE
                            </option>
                            <option value="NOT LIKE"
                                    {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == 'NOT LIKE'}selected{/if}>NOT LIKE
                            </option>
                            <option value="IS NULL"
                                    {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == 'IS NULL'}selected{/if}>IS NULL
                            </option>
                            <option value="IS NOT NULL"
                                    {if $smarty.post.operators.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_OPERATORS.$key.$item2 == 'IS NOT NULL'}selected{/if}>IS NOT
                                NULL
                            </option>
                        </select>
                        {if isset($fields_values.$item2)}
                            <p>
                                {if $item2 == 'persons__EducationalLevel'}
                                <select name="values[{$key}][{$item2}]">
                                    <option value=""></option>
                                    {foreach from=$fields_values.$item2 key=key3 item=item3}
                                        <optgroup label="{translate label=$key3}">
                                            {foreach from=$item3 key=key4 item=item4}
                                                {if is_array($item4)}
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{translate label=$key4}">
                                                        {foreach from=$item4 key=key5 item=item5}
                                                            <option value="{$key5}"
                                                                    {if $smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2==$key5}selected{/if}>{translate label=$item5}</option>
                                                        {/foreach}
                                                    </optgroup>
                                                {else}
                                                    <option value="{$key4}"
                                                            {if $smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2==$key4}selected{/if}>{translate label=$item4}</option>
                                                {/if}
                                            {/foreach}
                                        </optgroup>
                                    {/foreach}
                                </select>
                                {elseif $item2 == 'address_district__County'}
                                <select name="values[{$key}][{$item2}]"
                                        onchange="if (this.value>0) showInfo('ajax_report.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID');">
                                    <option value=""></option>
                                    {foreach from=$fields_values.$item2 key=key3 item=item3}
                                        <option value="{$key3}"
                                                {if $smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2==$key3}selected{/if}>{$item3}</option>
                                    {/foreach}
                                </select>
                                {elseif $item2 == 'address_city__City'}
                            <div id="div_CityID">
                                <select name="values[{$key}][{$item2}]">
                                    <option value=""></option>
                                    {foreach from=$fields_values.$item2 key=key3 item=item3}
                                        <option value="{$key3}"
                                                {if $smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2==$key3}selected{/if}>{$item3}</option>
                                    {/foreach}
                                </select>
                            </div>
                        {if !empty($smarty.post.values.$key.$item2)}
                            <script type="text/javascript">showInfo('ajax_report.php?o=city&districtID={$smarty.post.values.$key.address_district__County}&CityID={$smarty.post.values.$key.$item2}&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                        {elseif !empty($smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2)}
                            <script type="text/javascript">showInfo('ajax_report.php?o=city&districtID={$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.address_district__County}&CityID={$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2}&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                        {/if}
                        {else}
                            <select name="values[{$key}][{$item2}]">
                                <option value=""></option>
                                {foreach from=$fields_values.$item2 key=key3 item=item3}
                                    <option value="{$key3}"
                                            {if $smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2==$key3}selected{/if}>{$item3}</option>
                                {/foreach}
                            </select>
                        {/if}
                            </p>
                            <p>&nbsp;</p>
                        {else}
                            <p><input type="text" name="values[{$key}][{$item2}]"
                                      value="{$smarty.post.values.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES.$key.$item2|default:''}"
                                      style="width: 95px; font-size: 11px;"></p>
                            <p><input type="text" name="values2[{$key}][{$item2}]"
                                      value="{$smarty.post.values2.$key.$item2|default:$smarty.session.REPORT_MAKER.FIELDS_VALUES2.$key.$item2|default:''}"
                                      style="width: 95px; font-size: 11px;"></p>
                        {/if}
                    </td>
                {/foreach}
            {/foreach}
        </tr>
        {foreach from=$results key=key item=item}
            <tr>
                <td>{math equation="x+1" x=$key}</td>
                {foreach from=$item key=key2 item=item2}
                    <td>{$item2}</td>
                {/foreach}
            </tr>
        {/foreach}
    </table>
    <br>
    <div>
        <input type="submit" name="view" value="{translate label='Vezi raport'}">&nbsp;&nbsp;
        <input type="button" value="{translate label='Refacere selectie'}" onclick="window.location.href = './?m=reports_maker&o=new&action=remake';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="report" value="{translate label='Nume raport'}" size="40">
        <input type="submit" name="save" value="{translate label='Salveaza raport'}">
    </div>
</form>
