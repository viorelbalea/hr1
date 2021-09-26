{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="persons_submenu.tpl"}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <h3>{$info.FullName}</h3>
            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                <tr valign="top">
                    <td style="padding-right: 20px; border-right: 1px solid #cccccc;" width="30%">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">{translate label='Data nasterii'}:</td>
                                <td><b>{$info.DateOfBirth|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Judet'}:</td>
                                <td><b>{$districts[$info.DistrictID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Localitate'}:</td>
                                <td><b>{$info.CityName}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Telefon fix'}:</td>
                                <td><b>{$info.Phone|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Mobil'}:</td>
                                <td><b>{$info.Mobile|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Fax'}:</td>
                                <td><b>{$info.Fax|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Email'}:</td>
                                <td><b>{$info.Email|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Yahoo'}:</td>
                                <td><b>{$info.Yahoo|default:'-'}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Skype'}:</td>
                                <td><b>{$info.Skype|default:'-'}</b></td>
                            </tr>
                        </table>
                        <br><br>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">{translate label='Status'}:</td>
                                <td><b>{$status[$info.Status]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Tip'}:</td>
                                <td><b>{$substatus[$info.Status][$info.SubStatus]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Evaluator direct'}:</td>
                                <td><b>{$managers[$info.ManagerID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Profesie'}:</td>
                                <td><b>{$jobs[$info.JobDictionaryID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Pregatire'}:</td>
                                <td><b>{$studies[$info.Studies]}</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="padding-left: 20px; padding-right: 20px; border-right: 1px solid #cccccc;" width="30%">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">{translate label='Centru cost'}:</td>
                                <td><b>{$costcenter[$info.CostCenterID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Manager direct'}:</td>
                                <td><b>{$directmanager[$info.DirectManagerID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Compania'}:</td>
                                <td><b>{$self[$info.CompanyID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Divizia'}:</td>
                                <td><b>{$divisions[$info.DivisionID]}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Departament'}:</td>
                                <td><b>{$departments[$info.DepartmentID].Department}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Functie'}:</td>
                                <td><b>{if !empty($info.FunctionID)}{$functions[$info.FunctionID].Function} - {$functions[$info.FunctionID].COR}{/if}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Grupa de munca'}:</td>
                                <td><b>{$info.WorkGroup}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Functia interna'}:</td>
                                <td><b>{$info.Function}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Fisa post'}:</td>
                                <td>
                                    {if isset($info.JDFilePath)}
                                        <a href="{$info.JDFilePath}" title="" target="_blank">{translate label='Vizualizeaza'}</a>
                                    {/if}
                                </td>
                            </tr>
                            <tr>
                                <td>{translate label='Locatie'}:</td>
                                <td><b>{$sites[$info.SiteID]}</b></td>
                            </tr>
                        </table>
                        <br><br>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">{translate label='Masina marca'}:</td>
                                <td><b>{$info.Marca}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Numar inmatriculare'}:</td>
                                <td><b>{$info.NoIm}</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="padding-left: 20px" width="40%">
                        {if !empty($info.photo)}<img src="{$info.photo}" width="80">{/if}
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><input type="button" value="{translate label='Printeaza'}" onclick="window.print();">&nbsp;&nbsp;<input type="button"
                                                                                                                                                          value="{translate label='Inapoi'}"
                                                                                                                                                          onclick="history.back();"></a>
                </tr>
            </table>
            <br>
        </td>
    </tr>
    <tr>
        <td valign="top" class="bkdTitleMenu">
        </td>
    </tr>
</table>    	
