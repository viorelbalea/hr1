<html>

<head>

    <title>{translate label='Soft Resurse Umane'}</title>

</head>


<body topmargin="5" onLoad="window.print();">
<div style="width: 1000px">
    <table border="1" cellpadding="4" cellspacing="0" class="screen" style="float: left;margin-right: 5px;display: inline" width="52%">
        <tr>
            <td style="font-weight: bold">Formular E - Planificarea obiectivelor pentru {$StartDate|date_format:"%Y"} </td>
        </tr>
        <td class="bkdTitleMenu">
            <table>
                <td>
                    EVALUAT (N) <BR>
                    Nume: {$person.FullName}<BR>
                    Pozitie: {$personInfo.Function}<BR>
                    Marca: {$personInfo.Marca}<BR>
                    Depart/Sucursala: {$personInfo.Department}<BR>
                    Data de la care detine pozitia actuala: {$personInfo.StartDate|date_format:"%d.%m.%Y"}<BR>
                    Perioada pentru care se face evaluarea: {$StartDate|date_format:"%d.%m.%Y"} - {$EndDate|date_format:"%d.%m.%Y"} <BR>
                </td>
                <td style="vertical-align: top">
                    EVALUATOR (Manager N+1):<BR>
                    Nume: {$managerInfo.Fullname} <BR>
                    Pozitie: {$managerInfo.Function} <BR>
                    Data de la care detine pozitia actuala: {$managerInfo.StartDate|date_format:"%d.%m.%Y"}<BR>
                </td>

            </table>
        </td>
    </table>

    <table cellpadding="4" cellspacing="0" class="screen" style="float: left; margin-left: 5px; display:inline" width="40%">
        <tr>
            <td style="text-align:center;font-weight: bold">Formular de planificare si evaluare a performantelor profesionale <br> (Pozitii de conducere)<br><br><br></td>
        </tr>
        <td>
            <table class='screen' border="1" cellspacing="0" cellpadding="4">
                <tr border='1px solid black'>
                    <td style="background-color: black; color: white;"> Calificativ</td>
                    <td> 1</td>
                    <td> 2</td>
                    <td> 3</td>
                    <td> 4</td>
                    <td> 5</td>
                </tr>
                <tr border='1px solid black'>
                    <td style="background-color: black; color: white;"> Masura in care obiectivele</td>
                    <td> Inacceptabil</td>
                    <td> Sub asteptari</td>
                    <td> Conform asteptarilor</td>
                    <td> Peste asteptari</td>
                    <td> Exceptional</td>
                </tr>
            </table>
        </td>
    </table>
</div>
<br style="clear: both;">
<form action="{$smarty.server.REQUEST_URI}" method="post" name="perf" onsubmit="return validForm(document.perf);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="1000px">

        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="padding: 10px; border-top: 1px solid #EDEDED;">
                <table width='1000px' style="border:1px solid black">
                    <tr>
                        <td width='500px' border='1' style="background-color: black; color: white; font-weight: bold; text-align: center;" colspan='3'> Planificare performanta</td>
                        <td width='500px' border='1' style='font-weight: bold; text-align: center;' colspan='5'> Evaluare performanta</td>
                    </tr>
                    <tr valign="top">
                        <td align="left" class="bkdTitleMenu" width="250px" style="background-color: black; color: white;"><b>{translate label='Nume sectiune'}</b></td>
                        <td align="center" class="bkdTitleMenu" width="50px" style="background-color: black; color: white;"><b>{translate label='Pondere'}</b></td>
                        <td align="center" class="bkdTitleMenu" width="167px" style="background-color: black; color: white;">
                            <b>{translate label='Indicatori de performanta<br>Rezultate asteptate'}</b></td>
                        <td align="center" width="150px" class="bkdTitleMenu" colspan="2" style="border:1px solid black">
                            <table width="100px">
                                <tr style='border-bottom: 1px solid;'>
                                    <td align="center" class="bkdTitleMenu" colspan='2'><b>{translate label='Finala<br>(Ianuarie)'}</b>
                                </tr>
                                <tr>
                                    <td style='border-right: 1px solid'>Calificativ</td>
                                    <td>Punctaj</td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" class="bkdTitleMenu" width="550px" style="border:1px solid black" colspan='3'>
                            <table>
                                <tr>
                                    <td colspan="3">
                                        <b>{translate label='Evidente care sustin calificativul final'}</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border-right: 1px solid black">Manager 1</td>
                                    <td style="text-align: center; border-right: 1px solid black">Manager 2</td>
                                    <td style="text-align: center;">Mediator</td>
                                </tr>
                            </table>
                        </td>

                    </tr>

                    {foreach from=$eval key=k item=section}
                        <tr>
                            <td colspan="8" style="border-bottom:1px solid #EDEDED; background-color:#FCFCFC;"><strong><br/>{$k}</strong>
                            </td>
                        </tr>
                        {foreach from=$section item=item}
                            <tr>
                                <td class="celulaMenuST">{$item.Question}</td>
                                <td align="center" class="celulaMenuST">{$item.Pondere}%</td>
                                <td class="celulaMenuST"> ind de perf(tb adaugat)</td>
                                <td class="celulaMenuST"> {$item.Mark} </td>
                                <td class="celulaMenuST"> {$item.Mark} </td>
                                <td class="celulaMenuSTDR">{$item.ManagerComment|default:'-'}</td>
                                <td class="celulaMenuSTDR">{$item.ManagerComment2|default:'-'}</td>
                                <td class="celulaMenuSTDR">{$item.MediatorComment|default:'-'}</td>
                            </tr>
                        {/foreach}
                    {/foreach}
                    <tr>
                        <td class="celulaMenuST"></td>
                        <td class="celulaMenuST"></td>
                        <td class="celulaMenuST"><b>Suma puncte ponderata</b></td>
                        <td class="celulaMenuST"> {$mark} </td>
                        <td class="celulaMenuST"></td>
                        <td class="celulaMenuSTDR" colspan="3"></td>
                    </tr>
                    <tr>
                        <td>Data planificare: ianuarie {$StartDate|date_format:"%Y"}<br>
                            <i>Semnatura angajat........................</i><br>
                            <b>Semnatura manager........................</b></td>
                    </tr>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="6" valign="top" class="bkdTitleMenu">&nbsp;</td>
        </tr>

    </table>
</form>

</body>
</html>