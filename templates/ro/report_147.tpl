{if !empty($smarty.get.PersonID)}    <div style="width:800px; margin:0px;">        {if $info.CompanyID && $info.CompanyPhoto}            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px;">                <tr width="100%">                    <td align="center"><img src="{$info.CompanyPhoto}"/></td>                </tr>            </table>            <br style="height:0px;" clear="all"/>        {/if}        <p style="text-align:right; margin-top:0px;"><b>Nr. de inregistrare ........... /{$smarty.now|date_format:'%d.%m.%Y'}</b></p>        <p style="text-align:center"><strong>ADEVERINTA</strong></p>        <p style="text-indent:40px; text-align:justify; margin:0px;">            Prin prezenta se atesta faptul ca {if $info.Sex == 'M'}Domnul{else}Doamna{/if} <b>{$info.FullName}</b>, {if $info.Sex == 'M'}domiciliat{else}domiciliata{/if} in            <b>Loc. {$info.CityName|default:'.........................'}, Str. {$info.PersonStreetName|default:'................................'}                Nr. {$info.PersonStreetNumber|default:'............'}, Bl. {$info.PersonBl|default:'............'}, Sc. {$info.PersonSc|default:'............'},                Et. {$info.PersonEt|default:'........'}, Ap. {$info.PersonAp|default:'........'}, Judet/Sector {$info.PersonDistrict|default:'............'},</b>            {if $info.Sex == 'M'}posesor{else}posesoare{/if} al CI, seria {$info.BISerie|default:'.........'}, nr. {$info.BINumber|default:'....................'},            CNP {$info.CNP|default:'...........................................'}, este {if $info.Sex == 'M'}angajatul{else}angajata{/if} societatii            {$info.CompanyName|default:'..............................'}, CUI {$info.CIF|default:'..............................'}            cu sediul social in <b>{$info.CityName|default:'..........................'}, Str. {$info.StreetName|default:'..........................'},                Nr. {$info.StreetNumber|default:'..............'}, Judet/Sector {$info.DistrictName|default:'..............'},</b>            in baza contractului individual de munca cu norma intreaga de {$info.WorkNorm|default:'........'} ore/zi, incheiat pe durata {$info.ContractType}            inregistrat la Inspectoratul Teritorial de Munca Bucuresti cu nr. ....................., in funcţia/ meseria            de {$info.Function|default:'...........................................'}            de la data de {$info.StartDate|default:'.............................'} conform carnetului de munca seria .........., nr. ..................... .        </p>        <p style="text-indent:40px; text-align:justify; margin:0px;">            Pe durata executarii contractului individual de munca, dupa data de 01.01.2011 - data abrogarii Decretului nr. 92/1976            privind carnetul de munca au intervenit urmatoarele mutatii (incheierea, modificarea, suspendarea si incetarea contractului individual de munca):        </p>        <br/>        <table width="100%" border="1" cellspacing="0" cellpadding="3" style="text-align:center;">            <tr>                <td style="font-weight:bold;">Nr. crt.</td>                <td style="font-weight:bold;">Mutatia intervenita</td>                <td>                    <table width="100%" border="0" cellspacing="0" cellpadding="3" style="text-align:center;">                        <tr>                            <td style="border-bottom:solid 1px #333; font-weight:bold;">Anul</td>                        </tr>                        <tr>                            <td style="border-bottom:solid 1px #333; font-weight:bold;">Luna</td>                        </tr>                        <tr>                            <td style="font-weight:bold;">Ziua</td>                        </tr>                    </table>                </td>                <td style="font-weight:bold;">Meseria/Functia</td>                <td style="font-weight:bold;">Salariul de baza, <br/>inclusiv sporurile care intra<br/> in calculul punctajului<br/> mediu anual</td>                <td style="font-weight:bold;">Nr. si data actului pe baza caruia<br/> se face inscrierea si temeiul legal</td>            </tr>            <tr>                <td>1</td>                <td>Modificare<br/>salariu</td>                <td>                    <table width="100%" border="0" cellspacing="0" cellpadding="3" style="text-align:center;">                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td>..........</td>                        </tr>                    </table>                </td>                <td>...............</td>                <td>...............</td>                <td style="font-weight:bold;">Act aditional<br/>Nr. ......./......................</td>            </tr>            <tr>                <td>2</td>                <td>Modificat<br/>perioada<br/>contractului<br/>"prelungire<br/>....................."</td>                <td>                    <table width="100%" border="0" cellspacing="0" cellpadding="3" style="text-align:center;">                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td>..........</td>                        </tr>                    </table>                </td>                <td>...............</td>                <td>...............</td>                <td style="font-weight:bold;">Act aditional<br/>Nr. ......./......................</td>            </tr>            <tr>                <td>3</td>                <td>Modificare<br/>salariu</td>                <td>                    <table width="100%" border="0" cellspacing="0" cellpadding="3" style="text-align:center;">                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td style="border-bottom:solid 1px #333;">..........</td>                        </tr>                        <tr>                            <td>..........</td>                        </tr>                    </table>                </td>                <td>...............</td>                <td>...............</td>                <td style="font-weight:bold;">Act aditional<br/>Nr. ......./......................</td>            </tr>            <tr>                <td>4</td>                <td>Incetat contract<br/>de munca conf.<br/>.....................,<br/>din Codul Muncii</td>                <td>                    <table width="100%" border="0" cellspacing="0" cellpadding="3" style="text-align:center;">                        <tr>                            <td style="border-bottom:solid 1px #333; font-weight:bold;">{if $info.CM=='Da'}2011{else}{$info.StopDateYear|default:'..........'}{/if}</td>                        </tr>                        <tr>                            <td style="border-bottom:solid 1px #333; font-weight:bold;">{if $info.CM=='Da'}01{else}{$info.StopDateMonth|default:'..........'}{/if}</td>                        </tr>                        <tr>                            <td style="font-weight:bold;">{if $info.CM=='Da'}01{else}{$info.StopDateDay|default:'..........'}{/if}</td>                        </tr>                    </table>                </td>                <td>&nbsp;</td>                <td>&nbsp;</td>                <td style="font-weight:bold;">Decizia nr.<br/>......./......................</td>            </tr>        </table>        <br/>        <p style="text-indent:40px; text-align:justify; margin:0px;">            Incepand cu data de {$info.StopDate|default:'..........................'} contractul individual de munca            al {if $info.Sex == 'M'}domnului{else}doamnei{/if} {$info.FullName}            a incetat la data de {$info.StopDate|default:'..........................'}, in baza prevederilor .............................., din Legea nr.53/2003 - Codul muncii,            modificata si completata astfel cum rezulta din decizia nr. ........din data de ....................... .        </p>        <p style="text-indent:40px; text-align:justify; margin:0px;">            In perioada lucrata a avut {$info.THours_Abs|default:'0'} zile de absente nemotivate si ............. zile concediu fara plata.        </p>        <br/>        <table width="100%" align="center" style="margin-bottom:0px;">            <tr>                <td width="60%"><b>Director general, </b></td>                <td width="40%" align="center"><b>Intocmit: </b></td>            </tr>            <tr>                <td width="60%"><b>Marius BADINA</b></td>                <td width="40%" align="center"><b>Popescu Luiza</b></td>            </tr>            <tr>                <td width="60%">&nbsp;</td>                <td width="40%" align="center"><b>Sef Serviciu Resurse Umane</b></td>            </tr>        </table>    </div>{/if}