<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script><script type="text/javascript" src="./js/jquery.coolMultiple.js"></script><link href="images/style.css" rel="stylesheet" type="text/css"><form action="./?m=reports&o=personalisedfilters&rep={$smarty.get.rep}" name="frm_reports_personalisedfilters" method="post"      onsubmit="setTimeout('refresh_opener()',1); setTimeout('window.close()',5); return true;">    <input type="hidden" name="saveFilters" id="do" value="save"/>    <table width="100%" cellspacing="0" cellpadding="0" height="30" class="search">        {foreach from=$list_filters_visibility key=key item=item name=tmp}            {assign var="filter_id" value=$item.filter_id}            <tr>                <td><input type="checkbox"                           name="field_visible[{$key}]" {if $list_filters_names.$filter_id.mandatory == true} disabled="disabled" checked="checked" {else} {if !empty($item.visible)} checked="checked" {/if} {/if}                           value="1"/>                <td {if $list_filters_names.$filter_id.mandatory == true} style="font-weight:bold;" {/if}>{$list_filters_names.$filter_id.label}</td>            </tr>        {/foreach}    </table>    <br/>    <input type="submit" name="personal" value="{translate label='Salveaza'}" class="cod"></form><script type="text/javascript">    function refresh_opener() {ldelim}        window.opener.document.location.reload();        {rdelim}</script>