<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>CV - {$info.FullName}</title>
    <link rel="stylesheet" type="text/css" href="images/style_europass.css"></link>
</head>
<body onLoad="window.print();">
<table width="700" border="0" cellspacing="0" cellpadding="0" class="CV" summary="table layout">
    <tr>
        <td class="Logo" rowspan="2">&nbsp;</td>
        <td style="height:42px;">&nbsp;</td>
        <td colspan="4" rowspan="2">&nbsp;</td>
    </tr>
    <tr>
        <td class="Corner">&nbsp;</td>
    </tr>
    <tr>
        <td class="Heading1">&nbsp;</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">&nbsp;</td>
    </tr>
    <tr>
        <td class="Title">
            Curriculum Vitae</br>
            Europass
        </td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Label" colspan="11">

            {if !empty($info.photo)}
                <img src="{$info.photo}" width="113">
            {/if}

        </td>
    </tr>
    <tr>
        <td class="Heading1">&nbsp;</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">&nbsp;</td>
    </tr>
    <tr>
        <td class="Heading1">{translate label='Informaţii personale'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">&nbsp;</td>
    </tr>
    <tr>
        <td class="Label">{translate label='Nume / Prenume'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Heading2" colspan="11">{$info.FullName}</td>
    </tr>

    <tr>
        <td class="Label">{translate label='Adresa(e)'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">
            {$info.StreetName} {$info.StreetNumber} {$info.Bl} {$info.Sc} {$info.Et}{$info.Ap}<br/>
            {$info.StreetCode} {$info.CityName} {$info.DistrictName}  {$info.CountryName} <br/>
        </td>
    </tr>
    <tr>
        <td class="Label">{translate label='Telefon(oane)'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="5">{$info.Phone|default:'-'}</td>
        <td class="Label">{translate label='Mobil'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="5">{$info.Mobile|default:'-'}</td>

    </tr>
    <tr>
        <td class="Label">{translate label='Fax(uri)'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.Fax|default:'-'}</td>
    </tr>
    <tr>
        <td class="Label">{translate label='E-mail(uri)'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.Email|default:'-'}</td>
    </tr>
    <tr>
        <td class="Label">{translate label='Data naşterii'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.DateOfBirth|date_format:'%d/%m/%Y'}</td>
    </tr>
    <tr>
        <td class="Label">{translate label='Sex'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.Sex|default:'-'}</td>
    </tr>
    <tr>
        <td class="Label">{translate label='Stare civila'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$marital_status[$info.MaritalStatus]}</td>
    </tr>

    {if !empty($prof_exp)}
        <tr>
            <td class="Heading1">{translate label='Experienţa profesională'}</td>
            <td class="VerticalLine">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="Normal" colspan="11">&nbsp;</td>
        </tr>
        {foreach from=$prof_exp item=item}
            <tr>
                <td class="Label">{translate label='Perioada'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.StartDate|date_format:'%d/%m/%Y'} - {$item.StopDate|date_format:'%d/%m/%Y'}</td>
            </tr>
            <tr>
                <td class="Label">{translate label='Funcţia sau postul ocupat'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$functions_recr[$item.FunctionIDRecr]}</td>
            </tr>
            <tr>
                <td class="Label">{translate label='Activităţi si responsabilităţi principale'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.Responsabilities|default:'-'}</td>
            </tr>
            <tr>
                <td class="Label">{translate label='Numele şi adresa angajatorului'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.Company}<br/>{$item.City} {$item.Country}</td>
            </tr>
            <tr>
                <td class="Label">{translate label='Tipul activităţii sau sectorul de activitate'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$jobdomains[$item.DomainID]}</td>
            </tr>
            <tr>
                <td class="Label">&nbsp;</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">&nbsp;</td>
            </tr>
        {/foreach}
    {/if}

    {if !empty($std)}
        <tr>
            <td class="Heading1">{translate label='Educaţie şi formare'}</td>
            <td class="VerticalLine">&nbsp;</td>
            <td>&nbsp;</td>
            <td class="Normal" colspan="11">&nbsp;</td>
        </tr>
        {foreach from=$std item=item}
            <tr>
                <td class="Label">{translate label='Perioada'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.StartDate|date_format:'%d/%m/%Y'} - {$item.StopDate|date_format:'%d/%m/%Y'|default:'-'}</td>
            </tr>
            <tr>
                <td class="Label">{translate label='Calificarea/diploma obţinută'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.Diploma|default:'-'}</td>
            </tr>
            <tr>
                <td class="Label"{translate label='Disciplinele principale studiate/competenţele profesionale dobândite'}></td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">{$item.Specialization}<br/>{$jobdomains[$item.DomainID]}
                </td>
            </tr>
            <tr>
                <td class="Label">{translate label='Numele şi tipul instituţiei de învăţământ/furnizorului de formare'}</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11"> {$item.Institution}
                </td>
            </tr>
            <tr>
                <td class="Label">&nbsp;</td>
                <td class="VerticalLine">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="Normal" colspan="11">&nbsp;</td>
            </tr>
        {/foreach}
    {/if}
    <tr>
        <td class="Heading1">{translate label='Aptitudini şi competenţe personale'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="11" class="Normal">&nbsp;</td>
    </tr>
    {if !empty($lang)}
        <tr>
            <td class="Label">{translate label='Limbi străine cunoscute'}</td>
            <td class="VerticalLine">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="11" class="Normal">&nbsp;</td>
        </tr>
        <tr>
            <td class="Label">{translate label='Autoevaluare'}</td>
            <td class="VerticalLine">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="4" class="Heading2Center">{translate label='Înţelegere'}</td>
            <td colspan="4" class="Heading2Center">{translate label='Vorbire'}</td>
            <td colspan="2" class="Heading2Center">{translate label='Scriere'}</td>
            <td width="1%">&nbsp;</td>
        </tr>
        <tr>
            <td class="Label">{translate label='Nivel european'}</td>
            <td class="VerticalLine">&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2" class="NormalSmall">{translate label='Ascultare'}</td>
            <td colspan="2" class="NormalSmall">{translate label='Citire'}</td>
            <td colspan="2" class="NormalSmall">{translate label='Participare la conversaţie'}</td>
            <td colspan="2" class="NormalSmall">{translate label='Discurs oral'}</td>
            <td colspan="2" class="NormalSmall">&nbsp;</td>
            <td width="1%">&nbsp;</td>
        </tr>
        {foreach from=$lang item=item}
            <tr>
                <td class="Heading1Box">{$languages[$item.Lang]}</td>
                <td class="VerticalLineBox">&nbsp;</td>
                <td>&nbsp;</td>
                <td width="5%" class="NormalSmall">&nbsp;</td>
                <td class="NormalSmall">{$lang_level[$item.ReadLevel]}</td>
                <td width="5%" class="NormalSmall">&nbsp;</td>
                <td class="NormalSmall">{$lang_level[$item.ReadLevel]}</td>
                <td width="5%" class="NormalSmall">&nbsp;</td>
                <td class="NormalSmall">{$lang_level[$item.SpeakLevel]}</td>
                <td width="5%" class="NormalSmall">&nbsp;</td>
                <td class="NormalSmall">{$lang_level[$item.SpeakLevel]}</td>
                <td width="5%" class="NormalSmall">&nbsp;</td>
                <td class="NormalSmall">{$lang_level[$item.WriteLevel]}</td>
                <td width="1%">&nbsp;</td>
            </tr>
        {/foreach}
    {/if}
    <tr>
        <td class="Label">{translate label='Competenţe relevante'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.CVQualifRel}<br/>
        </td>
    </tr>
    <tr>
        <td class="Label">{translate label='Cursuri efectuate'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.CVCourses}<br/></td>
    </tr>
    <tr>
        <td class="Label">{translate label='Aptitudini'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.CVSkills}<br/>
        </td>
    </tr>
    <tr>
        <td class="Label">Hobby-uri</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.CVHobby}<br/></td>
    </tr>
    <tr>
        <td class="Label">{translate label='Permis de conducere'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">{$info.DrivingCategory|default:'-'}</td>
    </tr>
    <tr>
        <td class="Heading1">{translate label='Informaţii suplimentare'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">-<br/></td>
    </tr>
    <tr>
        <td class="Heading1">{translate label='Anexe'}</td>
        <td class="VerticalLine">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="Normal" colspan="11">-<br/></td>
    </tr>

</table>
</body>
</html>