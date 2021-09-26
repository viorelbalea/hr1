{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        {if $info.CompanyID}
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="400">&nbsp;</td>
                    <td align="right"><img src="{$info.CompanyPhoto}"/></td>
                </tr>
            </table>
            <br clear="all"/>
        {/if}

        <h3>Nr ........ Din .................</h3>
        <br>
        <h1 style="text-align: center;">ADEVERINTA</h1>
        <br>
        <p style="text-indent:20px;">Adeverim prin prezenta ca {if $info.Sex == 'M'}d-l{else}d-na{/if} {$info.FullName}, avand CNP {$info.CNP|default:'-'},
            {if $info.Sex == 'M'}posesor{else}posesoare{/if} a cartii de identitate seria si numarul {$info.BISerie|default:'-'} {$info.BINumber|default:'-'} eliberate
            de {$info.BIEmitent|default:'-'} la data de {$info.BIStartDate|date_format:'%d.%m.%Y'|default:'-'},
            domiciliat{if $info.Sex == 'F'}a{/if} in {$info.PersonCity}, strada {$info.PersonStreet}, nr.{$info.PersonStreetNumber}, bl. {$info.PersonBl|default:'-'},
            sc. {$info.PersonSc|default:'-'}, et. {$info.PersonEt|default:'-'},
            apt. {$info.PersonAp|default:'-'}{if $info.PersonDistrict != 'Bucuresti'}, judetul {$info.PersonDistrict}{/if} a
            fost {if $info.Sex == 'M'}angajat al{else}angajata a{/if} {$info.CompanyName|default:'......................................................'},
            CUI {$info.CIF|default:'........................'}, cu sediul social
            in {$info.CompanyAddress|default:'..............................................................................................................'}, in baza contractului
            individual de munca inregistrat la ITM/REVISAL cu numarul {$info.ContractNo|default:'........'}
            / {if $info.ContractDate && $info.ContractDate != '00.00.0000'}{$info.ContractDate}{else}...............{/if}.</p>
        <p style="text-indent:20px;">Pe durata executarii contractului individual de munca au intervenit urmatoarele mutatii (incheierea/modificarea/suspendarea/incetarea
            contractului de munca):</p>
        <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="3">
            <tr>
                <td>Nr. crt.</td>
                <td>Mutatia intervenita</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Anul</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Luna</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Ziua</td>
                        </tr>
                    </table>
                </td>
                <td>Meseria/Functia</td>
                <td>Salariul de baza, <br/>inclusiv sporurile care intra<br/> in calculul punctajului<br/> mediu anual</td>
                <td>Nr. si data actului pe baza caruia<br/> se face inscrierea si temeiul legal</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Incheiere</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">{if $info.CM=='Da'}2011{else}{$info.StartDateYear|default:'&nbsp;'}{/if}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">{if $info.CM=='Da'}01{else}{$info.StartDateMonth|default:'&nbsp;'}{/if}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">{if $info.CM=='Da'}01{else}{$info.StartDateDay|default:'&nbsp;'}{/if}</td>
                        </tr>
                    </table>
                </td>
                <td>{$info.Function|default:'&nbsp;'}</td>
                <td>{$info.CurrSalary|default:'&nbsp;'}</td>
                <td>Contract {$info.ContractNo|default:'........'}
                    / {if !empty($info.ContractDate) && $info.ContractDate != '00.00.0000'}{$info.ContractDate}{else}...............{/if}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>&nbsp;</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>3</td>
                <td>&nbsp;</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p style="text-indent:20px;">Contractul individual de munca al {if $info.Sex == 'M'}d-nului{else}d-nei{/if} {$info.FullName} inceteaza la data
            de {if $info.fStopDate != '0000-00-00'}{$info.fStopDate|date_format:'%d.%m.%Y'}{else}..........................{/if}, in baza prevederilor art.55 lit.b, din Legea
            nr.53/2003 - Codul muncii, modificata si completata, astfel cum rezulta din decizia nr. ................................ .</p>
        <p style="text-indent:20px;">Mentionam ca {if $info.Sex == 'M'}angajatul{else}angajata{/if} {$info.FullName} a fost {if $info.Sex == 'M'}incadrat{else}incadrata{/if} pe
            codul COR nr. {$info.CodCor} - {$info.NumeCor}.</p>
        <p style="text-indent:20px;">S-a eliberat prezenta in baza documentelor detinute de angajator, pentru stabilirea vechimii in munca dupa ......................</p>
        <br>
        <p align="left">Reprezentant legal,<br/>
            {$info.LegalFullName|default:'...............................'}</p><br/><br/><br/>
        <p align="left"> Sef departament Resurse Umane,<br/>{$info.HRFullName|default:'................................'}<br></p>
        <br/>
    </div>
{/if}