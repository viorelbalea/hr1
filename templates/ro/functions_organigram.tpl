<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.treeview.js"></script>
<script type="text/javascript" src="./js/jquery.cookie.js"></script>
<script type="text/javascript" src="./js/jquery.orgchart.js"></script>
<script type="text/javascript" src="./js/jquery.textchildren.js"></script>
<link href="images/jquery.treeview.css" rel="stylesheet" type="text/css">
<link href="images/slickmap.css" rel="stylesheet" type="text/css">
<link href="images/jquery.orgchart.css" rel="stylesheet" type="text/css"/>
{if !isset($smarty.get.print)}{include file="functions_menu.tpl"}<br/>
    <div style="float:left">
        <fieldset>
            <legend>{translate label='Organigrama functii'}</legend>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" class="filter">
                <tr height="40">
                    <td style="padding-left: 4px;" width="75">{translate label='Companie'}:</td>
                    <td style="padding-left: 2px;" width="70"><select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;"
                                                                      onchange="window.location.href = './?m=functions&o=organigram&CompanyID=' + document.getElementById('CompanyID').value + '&Level=' + document.getElementById('Level').value">
                            <option value="0">{translate label='selecteaza'}</option>
                            {foreach from=$companies key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select></td>
                </tr>
                <tr height="40">
                    <td style="padding-left: 4px;" width="75">{translate label='Nivel'}:</td>
                    <td style="padding-left: 2px;" width="70"><select id="Level" name="Level" class="dropdown" style="width:120px;"
                                                                      onchange="window.location.href = './?m=functions&o=organigram&CompanyID=' + document.getElementById('CompanyID').value + '&mark={$smarty.get.mark}&mark2={$smarty.get.mark2}&mark3={$smarty.get.mark3}&Level=' + document.getElementById('Level').value">
                            <option value="-1">{translate label='selecteaza'}</option>
                            {foreach from=$levels key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.Level}selected{/if}>{$item}</option>
                            {/foreach}
                        </select></td>
                </tr>
            </table>
            <br/><br/>
            <!-- Left Functions Tree -->
            {foreach from=$companies key=key item=item}
                {if is_array($functions_tree.$key)}
                    <b>{$item}</b>
                    <br/>
                    <br/>
                    <div id="treecontrol_{$key}"><a href="#"> {translate label='Restrange toate'}</a> | <a href="#"> {translate label='Extinde toate'}</a> | <a
                                href="#">{translate label='Revenire toate'}</a></div>
                    <ul id="browser_{$key}" class="filetree">
                        {recurse_array array=$functions_tree.$key}
                    </ul>
                    <br/>
                    <br/>
                {/if}
            {/foreach}
        </fieldset>
    </div>
<div style="float:left; width:50%;">
    <fieldset>
        <legend>{translate label='Organigrama personal'}</legend>
        <a id="showHorizontal" class="selected" href="#">{translate label='Organigrama orizontala'}</a>
        [<a href="?m=functions&o=organigram&CompanyID={$smarty.get.CompanyID}&mark={$smarty.get.mark}&mark2={$smarty.get.mark2}&mark3={$smarty.get.mark3}&Level={$smarty.get.Level}&print=1">print</a>]
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a id="showVertical" href="#">{translate label='Organigrama verticala'}</a>
        [<a href="?m=functions&o=organigram&CompanyID={$smarty.get.CompanyID}&mark={$smarty.get.mark}&mark2={$smarty.get.mark2}&mark3={$smarty.get.mark3}&Level={$smarty.get.Level}&print=2">print</a>]
        <br/>
        {/if} <!-- Horizontal organizational  -->
        <h2 style="margin-bottom:0;">{$smarty.get.mark2}</h2>
        <div id="horizView" {if $smarty.get.print==2} style="display:none;"{/if}></div>
        {foreach from=$companies key=key item=item}
            {if is_array($persons_tree.$key)}
                <ul id="horizTree_{$key}" rel="{$item}" style="display:none;"><br/><br/>
                    {recurse_array_horiz array=$persons_tree.$key}
                </ul>
                {*<pre>{$key|@print_r}</pre>*}
            {/if}
        {/foreach} <!-- Vertical organizational  -->
        <div id="vertViewContainer" {if $smarty.get.print!=2} style="display:none;"{/if}>
            {foreach from=$companies key=key item=item}
                {if is_array($persons_tree.$key)}
                    <div style="float:left;">
                        <ul class="primaryNav col2"><br/><br/> {recurse_array_vert array=$persons_tree.$key}                        </ul>
                    </div>
                {/if}
            {/foreach}
            {if !isset($smarty.get.print)}
        </div>
    </fieldset>
</div>{/if}
<script type="text/javascript">
    // script for functions organigram
    {foreach from=$companies key=key item=item}
    $(document).ready(function () {ldelim}        $("#browser_{$key}").treeview({ldelim}
        animated: "fast",
        persist: "location",
        collapsed: true,
        control: "#treecontrol_{$key}"            {rdelim});        {rdelim});
    {/foreach}
</script>
{literal}
    <script>        // script for people organigram
        $(function () {
            $("#showVertical").click(function () {
                $(this).addClass('selected');
                $('#showHorizontal').removeClass('selected');
                $("#vertViewContainer").show();
                $("#horizView").hide();
                return false;
            });
            $("#showHorizontal").click(function () {
                $(this).addClass('selected');
                $('#showVertical').removeClass('selected');
                $("#vertViewContainer").hide();
                $("#horizView").show();
                return false;
            });
        });
    </script>
{/literal}
<script type="text/javascript">
    {foreach from=$companies key=key item=item}
    $(function () {ldelim}        $("#horizTree_{$key}").orgChart({ldelim}
        levels: -1,
        treeTitle: '{$item}',
        stack: true,
        nodeText: function ($node) {
            ldelim
        }
        return $node.textChildren();
        {rdelim}{rdelim}, $("#horizView"));        {rdelim})
    ;
    {/foreach}
</script>