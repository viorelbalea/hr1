{include file="candidates_menu.tpl"}
<div id="layer_candidates_scroll">
    <table cellspacing="0" cellpadding="7">


        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Nume'}:</td>
            <td class="celulaMenuDR"><b>{$info.FirstName} {$info.LastName}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Telefon'}:</td>
            <td class="celulaMenuDR"><b>{$info.Phone|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Mobil'}:</td>
            <td class="celulaMenuDR"><b>{$info.Mobile|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Email'}:</td>
            <td class="celulaMenuDR"><b>{$info.Email|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Url'}:</td>
            <td class="celulaMenuDR"><b>{$info.Url|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Varsta'}:</td>
            <td class="celulaMenuDR"><b>{$info.Age|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Ultima companie'}:</td>
            <td class="celulaMenuDR"><b>{$info.LastCompany|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Experienta'}:</td>
            <td class="celulaMenuDR"><b>{$info.Experience|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Ultimul loc de munca'}:</td>
            <td class="celulaMenuDR"><b>{$info.LastWorkPlace|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Data aplicarii'}:</td>
            <td class="celulaMenuDR"><b>{$info.ApplyDate|default:'-'}</b></td>
        </tr>

        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Data nasterii'}:</td>
            <td class="celulaMenuDR"><b>{$info.BirthDate|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Sex'}:</td>
            <td class="celulaMenuDR"><b>{$info.Gender|default:'-'}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Stare civila'}:</td>
            <td class="celulaMenuDR"><b>{$info.MaritalStatusName}</b></td>
        </tr>
        <tr>
            <td class="celulaMenuST" id="layer_candidates_colst">{translate label='Adresa'}:</td>
            <td class="celulaMenuDR">
                {if !empty($addresses)}
                    {foreach from=$addresses item=adr}
                        <b>{$adr.Address}, {$adr.CityName}</b>
                        <br/>
                    {/foreach}
                {else}
                    -
                {/if}
            </td>
        </tr>
        {if !empty($work_exp)}
            <tr>
                <td class="celulaMenuSTDR" colspan="2">
                    <b>{translate label='Experienta profesionala'}:</b>
                    <br>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td>{translate label='Data de inceput'}</td>
                            <td>{translate label='Data de sfarsit'}</td>
                            <td>{translate label='Companie'}</td>
                            <td>{translate label='Domeniu'}</td>
                            <td>{translate label='Denumire Job'}</td>
                        </tr>
                        {foreach from=$work_exp item=item}
                            <tr>
                                <td><b>{$item.FromDate|date_format:'%d.%m.%Y'}</b></td>
                                <td><b>{$item.ToDate|date_format:'%d.%m.%Y'}</b></td>
                                <td><b>{$item.Employer|default:'-'}</b></td>
                                <td><b>{$item.Domain|default:'-'}</b></td>
                                <td><b>{$item.Position|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td colspan="5">{translate label='Descriere'}: {$item.Description|default:'-'}</td>
                            </tr>
                            <tr>
                                <td colspan="5">{translate label='Recomandari'}: {$item.Recomandation|default:'-'}</td>
                            </tr>
                        {/foreach}
                    </table>
                </td>
            </tr>
        {/if}
        {if !empty($education)}
            <tr>
                <td class="celulaMenuSTDR" colspan="2">
                    <b>Studii:</b>
                    <br>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td id="layer_candidates_colst">{translate label='Studii'}</td>
                            <td>{translate label='Specializare'}</td>
                        </tr>
                        {foreach from=$education item=item}
                            <tr>
                                <td id="layer_candidates_colst">{$item.Studies|default:'-'}</td>
                                <td>{$item.Skills|default:'-'}</td>
                            </tr>
                        {/foreach}
                    </table>
                </td>
            </tr>
        {/if}
        {if !empty($lang_read)|| !empty($lang_write) ||!empty($lang_speak)}
            <tr>
                <td class="celulaMenuSTDR" colspan="2">
                    <b>{translate label='Limbi straine'}:</b>
                    <br>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td id="layer_candidates_colst">{translate label='Limba straina'}</td>
                            <td>{translate label='Citit'}</td>
                            <td>{translate label='Scris'}</td>
                            <td>{translate label='Vorbit'}</td>
                        </tr>
                        <tr>
                            <td id="layer_candidates_colst">{foreach from=$lang_read item=lang}
                                    <b>{$lang.LanguageName|default:'-'}</b>
                                    <br/>
                                {/foreach}
                            </td>
                            <td>{foreach from=$lang_read item=lang}
                                    {$lang.LanguageLevelName|default:'-'}
                                    <br/>
                                {/foreach}
                            </td>
                            <td>{foreach from=$lang_write item=lang}
                                    {$lang.LanguageLevelName|default:'-'}
                                    <br/>
                                {/foreach}
                            </td>
                            <td>{foreach from=$lang_speak item=lang}
                                    {$lang.LanguageLevelName}
                                    <br/>
                                {/foreach}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        {/if}

    </table>
</div>
<div class="saveObservatii" id="layer_candidates_save">
    <input type="button" class="cod" value="Printeaza" onClick="PrintDiv('layer_candidates_scroll');"/>
    <input type="submit" name="importBtn" value="Delete"
           onclick="getCv('./?m=candidates&o=viewcv&CvId={$nextCand}&action=preview&preDelete={$smarty.get.CvId}&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}');"
    />

    <input type="submit" name="importBtn" value="Import"
           {if $info.ImportStatus!='1'}onclick="getCv('./?m=candidates&o=import&CvId={$smarty.get.CvId}&rePreview={$nextCand}&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}');"{/if}
            {if $info.ImportStatus=='1'}disabled="disabled" style="background-color:#666;"{/if} />

    <input type="submit" name="nextBtn" value="Next"
           onclick="getCv('./?m=candidates&o=viewcv&CvId={$nextCand}&action=preview&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}'); return false;"/>
</div>
