{if empty($smarty.get.export_doc) && empty($smarty.get.print)}
    <div class="submeniu">
        <a href="./?m=reports" class="selected">{translate label='Rapoarte'}</a>
        <a href="./?m=reports_maker&o=new" class="unselected">{translate label='Raport nou'}</a>
        <a href="./?m=reports_maker&o=myreports" class="unselected">{translate label='Rapoartele mele'}</a>
    </div>
    <div class="filter">
        <select id="GroupID" name="GroupID" onchange="window.location.href = './?m=reports&GroupID=' + this.value;">
            <option value="0">{translate label='alege grupa...'}</option>
            {foreach from=$groups key=key item=item}
                <option value="{$key}" {if $smarty.get.GroupID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        <select name="o" onchange="if (this.value>0) window.location.href = './?m=reports&GroupID=' + document.getElementById('GroupID').value + '&rep=' + this.value" class="cod"
                style="width:300px">
            <option value="0">{translate label='alege raport...'}</option>
            {foreach from=$reports item=item}
                {if $smarty.session.USER_ID == 1 || ($item.Type == 0 || ($item.Type == 1 && (in_array(8, $smarty.session.USER_RIGHTS))))}
                    <option value="{$item.ReportID}" {if $smarty.get.rep == $item.ReportID}selected{/if}>{$item.Report}</option>
                {/if}
            {/foreach}
        </select>
        {if !empty($smarty.get.rep)}<label><b>{translate label='Raport Nr.'} {$smarty.get.rep}</b></label>{/if}
        {if !empty($smarty.get.rep) && !in_array($smarty.get.rep, array(47,48))}
            <br/>
            <div class="outputZone outputZoneOne">
                <div>
                    <ul>
                        <li class="header"><label>{translate label='Output'}</label></li>

                        <li><input type="button" class="cod printFile" onclick="window.open('{$smarty.server.REQUEST_URI}&print=1', 'print')" value="{translate label='Printeaza'}">
                        </li>
                        <li><input type="button" class="cod exportFile" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export=1'" value="Export .xls">
                        </li>
                        <li><input type="button" class="cod exportFile" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export_doc=1'" value="Export .doc">
                            {if !empty($personalise)}</li>
                        <li><input type="button" class="cod options" value="{translate label='Personalizare Coloane'}"
                                   onclick="popUp('./?m=reports&o=personalisedlist&rep={$smarty.get.rep}&type=popup','',300,400)">{/if}
                            {if !empty($personaliseFilters)}</li>
                        <li><input type="button" class="cod options" value="{translate label='Personalizare Filtre'}"
                                   onclick="popUp('./?m=reports&o=personalisedfilters&rep={$smarty.get.rep}&type=popup','',300,400)">{/if}
                        </li>
                    </ul>
                </div>
            </div>
        {/if}
    </div>
    {if !empty($rep_adv)}
        <div class="filter">
            {if !empty($self)}
                <label>{translate label='Companie'}:</label>
                <select id="CompanyID" onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID=' + this.value;">
                    <option value="0">{translate label='alege'}</option>
                    {foreach from=$self key=key item=item}
                        <option value="{$key}" {if $smarty.get.CompanyID==$key}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            {/if}
            {if !empty($divisions)}daf
                <label>{translate label='Divizie'}:</label>
                <select id="DivisionID"
                        onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID={$smarty.get.CompanyID}&DivisionID=' + this.value;">
                    <option value="0">{translate label='alege'}</option>
                    {foreach from=$divisions key=key item=item}
                        <option value="{$key}" {if $smarty.get.DivisionID==$key}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            {/if}
            <label>{translate label='Persoana'}:</label>
            <select id="PersonID"
                    onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID={$smarty.get.CompanyID}&DivisionID={$smarty.get.DivisionID}&PersonID=' + this.value;">
                <option value="0">{translate label='alege'}</option>
                {foreach from=$persons key=key item=item}
                    <option value="{$key}" {if $smarty.get.PersonID==$key}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </div>
        <br>
    {/if}
{/if}
{if !empty($smarty.get.rep)}
    {include file=$report_file}
{/if}