<html>
<head>
    <title>Fisa de interventie</title>
    <link href="images/style_ticket_report.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="800" style="margin:auto;" class="grid">
    <tr>
        <td><img src="images/sigla_raport_tichet.png" align="right" style="margin:5px 0px 5px 0px;"/></td>
    </tr>

    <tr>
        <td class="bkdTitle"><span class="TitleText">FISA DE INTERVENTIE</span></td>
    </tr>

    <tr>
        <td>
            <table cellspacing="0" cellpadding="2" width="100%" class="subTable">
                <tr class="bkdSubTitle">
                    <td class="subTd leftTd"><span class="Text"><b>NR. TICHET: </b>{$info.TicketID}</span></td>
                    <td class="subTd" colspan="2"><span
                                class="Text"><b>DATA: </b>{if !empty($info.InterventionEndDate) && $info.InterventionEndDate != '0000-00-00 00:00:00'}{$info.InterventionEndDate|date_format:"%d.%m.%Y"}{else} - {/if}</span>
                    </td>
                </tr>
                <tr>
                    <td class="subTd"><span class="Text"><b>Nume companie: </b>{$info.CompanyName|default:'-'}</span></td>
                    <td class="subTd" colspan="2"><span class="Text"><b>Nume delegat KaTe: </b>{$info.AssignedFullName}</span></td>
                </tr>
                <tr>
                    <td class="subTd" colspan="2"><span class="Text"><b>Adresa: </b>{$info.CompanyAddress|default:'-'}</span></td>
                    <td class="subTd"><span class="Text"><b>Telefon delegat: </b>{$info.AssignedMobile|default:'-'}</span></td>
                </tr>
                <tr>
                    <td class="subTd"><span class="Text"><b>Oras: </b>{$info.CompanyOras|default:'-'}</span></td>
                    <td class="subTd"><span class="Text"><b>Judet/Sector: </b>{$info.CompanyJudet|default:'-'}</span></td>
                    <td class="subTd"><span class="Text"><b>Telefon: </b>{$info.CompanyPhone|default:'-'}</span></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr class="whiteTd">
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>
            <table cellspacing="0" cellpadding="2" width="100%" class="subTable">
                <tr class="bkdSubTitle">
                    <td class="subTd" colspan="3" align="center"><span class="subTitle"><b>NATURA DEFECTIUNII </b></span></td>
                </tr>
                <tr>
                    <td class="subTd tallTd" colspan="3"><span class="Text"><b>Problema raportata: </b></span>
                        <div class="divInfo">{$info.Notes|default:' - '}</div>
                    </td>
                </tr>
                <tr>
                    <td class="subTd tallTd" colspan="3"><span class="Text"><b>Problema reala: </b></span></td>
                </tr>
                <tr>
                    <td class="subTd leftTd"><span class="Text"><b>Problema raportata de: </b>{$info.SolicitantFullName|default:' - '}</span></td>
                    <td class="subTd"><span class="Text"><b>Data: </b>{$info.CreateDate|date_format:'%d.%m.%Y'}</span></td>
                    <td class="subTd"><span class="Text"><b>Ora: </b>{$info.CreateDate|date_format:'%H:%M'}</span></td>
                </tr>
                <tr>
                    <td class="subTd" colspan="3"><span class="Text"><b>Localizarea echipamentului: </b>{$info.EquipmentLocation}</span></td>
                </tr>
                <tr>
                    <td class="subTd" colspan="3"><span class="Text"><b>Nume utilizator: </b>{$info.UserName}</span></td>
                </tr>
                <tr>
                    <td class="subTd leftTd"><span class="Text"><b>Echipament operational: </b></span></td>
                    <td class="subTd" colspan="2">
						<span class="Text"><b>Tip echipament: </b>
							<img src="images/check.png" style="margin:0 5px 0 5px;"/>Laptop
							<img src="images/check.png" style="margin:0 5px 0 5px;"/>Desktop
							<img src="images/check.png" style="margin:0 5px 0 5px;"/>Server <br/>
							<img src="images/check.png" style="margin:0 5px 0 106px;"/>Printer
							<img src="images/check.png" style="margin:0 5px 0 5px;"/>Retea
						</span>
                    </td>
                </tr>
                <tr>
                    <td class="subTd leftTd"><span class="Text"><b>Model: </b></span></td>
                    <td class="subTd"><span class="Text"><b>IP: </b></span></td>
                    <td class="subTd"><span class="Text"><b>Nume retea: </b></span></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr class="whiteTd">
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>
            <table cellspacing="0" cellpadding="2" width="100%" class="subTable">
                <tr class="bkdSubTitle">
                    <td class="subTd" colspan="4" align="center"><span class="subTitle"><b>DETALII INTERVENTIE </b></span></td>
                </tr>
                <tr>
                    <td class="subTd veryTallTd" colspan="4"><span class="Text"><b>Defectiuni depistate: </b>{$info.BusinessReason}</span></td>
                </tr>
                <tr>
                    <td class="subTd" colspan="4"><span class="Text"><b>Operatiuni efectuate: </b></span>
                        <img src="images/check.png" style="margin:0 5px 0 5px;"/>Instalare OS
                        <img src="images/check.png" style="margin:0 5px 0 55px;"/>Configurare OS
                        <img src="images/check.png" style="margin:0 5px 0 25px;"/>OS Update
                        <img src="images/check.png" style="margin:0 5px 0 65px;"/>Mentenanta OS<br/>
                        <img src="images/check.png" style="margin:0 5px 0 140px;"/>Scanare/Devirusare
                        <img src="images/check.png" style="margin:0 5px 0 17px;"/>Instalare MsOffice
                        <img src="images/check.png" style="margin:0 5px 0 11px;"/>Instalare periferice (scaner, printer, etc)<br/>
                        <img src="images/check.png" style="margin:0 5px 0 140px;"/>Soft de baza (Acrobat Reader, Adobe Flash, WinRar, Firefox, Thunderbird, Antivirus)<br/>
                        <img src="images/check.png" style="margin:0 5px 0 140px;"/>Back-up date
                        <img src="images/check.png" style="margin:0 5px 0 50px;"/>Recuperare date
                        <img src="images/check.png" style="margin:0 5px 0 16px;"/>Testare echipament
                        <img src="images/check.png" style="margin:0 5px 0 17px;"/>Cablare
                        <img src="images/check.png" style="margin:0 5px 0 55px;"/>Desprafuire<br/>
                        <img src="images/check.png" style="margin:0 5px 0 140px;"/>Altele:<br/>
                    </td>
                </tr>
                <tr>
                    <td class="subTd veryTallTd" colspan="4"><span class="Text"><b>Detalii: </b></span>
                        <div class="divInfo">{$info.Notes2}</div>
                    </td>
                </tr>
                <tr>
                    <td class="subTd veryTallTd" colspan="3"><span class="Text"><b>Comentarii si sugestii: </b></span></td>
                    <td class="subTd td4"><span class="Text">
						<b>Statut after service: </b></span><br/>
                        <img src="images/check.png" style="margin:0 5px 0 0px;"/>Complet<br/>
                        <img src="images/check.png" style="margin:0 5px 0 0px;"/>Incomplet<br/>
                        <img src="images/check.png" style="margin:0 5px 0 0px;"/>In asteptare de componente<br/>
                        <img src="images/check.png" style="margin:0 5px 0 0px;"/>Sub observatie<br/>
                    </td>
                </tr>
                <tr>
                    <td class="subTd td4"><span
                                class="Text">Ora inceput: {if !empty($info.InterventionStartDate) && $info.InterventionStartDate != '0000-00-00 00:00:00'}{$info.InterventionStartDate|date_format:'%H:%M'}{else} - {/if}</span>
                    </td>
                    <td class="subTd td4"><span
                                class="Text">Ora sfarsit: {if !empty($info.InterventionEndDate) && $info.InterventionEndDate != '0000-00-00 00:00:00'}{$info.InterventionEndDate|date_format:'%H:%M'}{else} - {/if}</span>
                    </td>
                    <td class="subTd td4"><span class="Text">Durata interventiei: {$info.InterventionDuration|default:' - '}</span></td>
                    <td class="subTd td4"><span class="Text">Timp efectiv: {$info.InterventionTotalDuration|default:' - '}</span></td>
                </tr>
                <tr>
                    <td class="subTd td4" colspan="2">
                        <span class="Text">Transport: </span>
                        <img src="images/check.png" style="margin:0 5px 0 15px;"/>Auto
                        <img src="images/check.png" style="margin:0 5px 0 15px;"/>Public
                        <img src="images/check.png" style="margin:0 5px 0 15px;"/>Personal
                    </td>
                    <td class="subTd td4"><span class="Text">Durata depl. la client: {math equation="x/2" x=$info.TransportTime|default:'0'} min</span></td>
                    <td class="subTd td4"><span class="Text">Durata depl. la sediu:  {math equation="x/2" x=$info.TransportTime|default:'0'} min</span></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr class="whiteTd">
        <td>&nbsp;</td>
    </tr>

    <tr>
        <td>
            <table cellspacing="0" cellpadding="2" width="100%" class="subTable">
                <tr class="bkdSubTitle">
                    <td class="subTd" colspan="3" align="center"><span class="subTitle"><b>FEEDBACK CLIENT</b></span></td>
                </tr>
                <tr>
                    <td class="subTd" colspan="3">
                        <span class="Text"><b>Evaluarea calitatii interventiei: </b></span>
                        <img src="images/check.png" style="margin:0 5px 0 5px;"/>Excelent
                        <img src="images/check.png" style="margin:0 5px 0 55px;"/>Bun
                        <img src="images/check.png" style="margin:0 5px 0 25px;"/>Satisfacator
                        <img src="images/check.png" style="margin:0 5px 0 25px;"/>Nemultumit
                    </td>
                </tr>
                <tr>
                    <td class="subTd veryTallTd" colspan="3"><span class="Text"><b>Cometarii si sugestii: </b></span></td>
                </tr>
                <tr>
                    <td class="subTd td4"><span class="Text"><b>Nume: </b></span></td>
                    <td class="subTd td4"><span class="Text"><b>Functie: </b></span></td>
                    <td class="subTd td4"><span class="Text"><b>Telefon: </b></span></td>
                </tr>

                <tr>
                    <td class="subTd leftTd"><span class="Text"><b>Email: </b></span></td>
                    <td class="subTd"><span class="Text"><b>Data: </b></span></td>
                    <td class="subTd" rowspan="2" valign="top"><span class="Text"><b>Semnatura: </b></span></td>
                </tr>

                <tr>
                    <td class="subTd" colspan="2">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>

</table>

</body>
</html>