{include file="reports_maker_menu.tpl"}

{if !empty($smarty.post)}

    {include file="reports_maker_new_view.tpl"}

{else}
    <script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="./js/jquery.coolMultiple.js"></script>
{literal}
    <style>
        .coolmulti-scrollbox {
            background: none repeat scroll 0 0 #FFFFFF;
            float: left;
            height: 250px;
            margin-bottom: 5px;
            overflow-y: auto;
            padding: 5px 0;
            text-decoration: none;
            width: 250;
        }

        .coolmulti-values {
            display: none;
            float: left;
            font-weight: bold;
            margin-left: 15px;
            width: 300;
        }
    </style>
{/literal}
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
            <tr>
                <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label="Raport nou"}</span> <br></td>
            </tr>
            {foreach from=$categories key=key item=item name=iter}
                {if $smarty.foreach.iter.iteration%4==1}<tr>{/if}
                <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
                    <fieldset>
                        <legend>{translate label=$item}</legend>
                        <div>
                            <select name="Fields[{$key}][]" id="Fields{$key}" multiple="multiple">
                                {foreach from=$fields.$key key=key2 item=item2}
                                    <option value="{$key2}" {if in_array($key2, $smarty.session.REPORT_MAKER.FIELDS.$key)}selected{/if}>{translate label=$item2}</option>
                                {/foreach}
                            </select>
                        </div>
                    </fieldset>
                </td>
                {if $smarty.foreach.iter.iteration%4==0 || $smarty.foreach.iter.last}</tr>{/if}
            {/foreach}
        </table>
        <div align="center"><input type="submit" name="generate" value="{translate label='Genereaza raport'}"></div>
    </form>
    <script language="JavaScript" type="text/javascript">
        {foreach from=$categories key=key item=item}
        $('#Fields{$key}').coolMultiple();
        {/foreach}
    </script>
    <script type="text/javascript">
        $().ready(function () {ldelim}
            $('form').hide();
            $(':form [name="{$smarty.get.list}"]').show();
            {rdelim});

        function refresh_opener() {ldelim}
            window.opener.document.location.reload();
            {rdelim}
    </script>
{/if}