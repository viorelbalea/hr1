<html>
<head>
    <title>CV</title>
    {if $smarty.get.action=='print'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

{if $smarty.get.action=='print'}
<body topmargin="5" onLoad="window.print();">{/if}

<table cellspacing="0" cellpadding="6" width="100%">
    <tr>
        <td colspan="2" class="bkdTitleMenu"><span class="TitleBox">CV</span></td>
    </tr>
    {if !empty($info.photo)}
        <tr>
            <td class="celulaMenuST">{translate label='Poza'}:</td>
            <td class="celulaMenuDR"><img src="{$info.photo}" width="80"></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST">{translate label='Nume'}:</td>
        <td class="celulaMenuDR"><b>{$info.FullName}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Telefon'}:</td>
        <td class="celulaMenuDR"><b>{$info.Phone|default:'-'}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Mobil'}:</td>
        <td class="celulaMenuDR"><b>{$info.Mobile|default:'-'}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Email'}:</td>
        <td class="celulaMenuDR"><b>{$info.Email|default:'-'}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Stare civila'}:</td>
        <td class="celulaMenuDR"><b>{$marital_status[$info.MaritalStatus]}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Judet'}:</td>
        <td class="celulaMenuDR"><b>{$districts[$info.DistrictID]}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Localitate'}:</td>
        <td class="celulaMenuDR"><b>{$info.CityName}</b></td>
    </tr>
    <tr>
        <td class="celulaMenuST">{translate label='Adresa'}:</td>
        <td class="celulaMenuDR"><b>Cod postal: {$info.StreetCode}, Strada: {$info.StreetName}, Nr. {$info.StreetNumber}</b></td>
    </tr>
    {if !empty($trainings)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2">
                <b>{translate label='Traininguri efectuate'}</b>
                <br>
                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                    <tr>
                        <td>{translate label='Perioada'}</td>
                        <td>{translate label='Denumire training'}</td>
                        <td>{translate label='Companie training'}</td>
                    </tr>
                    {foreach from=$trainings item=item}
                        <tr>
                            <td>{$item.StartDate|date_format:'%d.%m.%Y'} : {$item.StopDate|date_format:'%d.%m.%Y'}</td>
                            <td>{$item.TrainingName}</td>
                            <td>{$item.CompanyName}</td>
                        </tr>
                    {/foreach}
                </table>
            </td>
        </tr>
    {/if}
    {if !empty($prof_exp)}
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
                        <td>{translate label='Localitate'}</td>
                        <td>{translate label='Tara'}</td>
                    </tr>
                    {foreach from=$prof_exp item=item}
                        <tr>
                            <td>{$item.StartDate|date_format:'%d.%m.%Y'}</td>
                            <td>{$item.StopDate|date_format:'%d.%m.%Y'}</td>
                            <td>{$item.Company}</td>
                            <td>{$jobdomains[$item.DomainID]}</td>
                            <td>{$jobs[$item.JobDictionaryID]}</td>
                            <td>{$item.City}</td>
                            <td>{$item.Country}</td>
                        </tr>
                        <tr>
                            <td colspan="7">{translate label='Responsabilitati'}: {$item.Responsabilities|default:'-'}</td>
                        </tr>
                    {/foreach}
                </table>
            </td>
        </tr>
    {/if}
    {if !empty($std)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2">
                <b>{translate label='Studii'}:</b>
                <br>
                <table cellspacing="0" cellpadding="4">
                    <tr>
                        <td>{translate label='Data de inceput'}</td>
                        <td>{translate label='Data de sfarsit'}</td>
                        <td>{translate label='Institutie'}</td>
                        <td>{translate label='Specializare'}</td>
                        <td>{translate label='Domeniu'}</td>
                        <td>{translate label='Diploma obtinuta'}</td>
                    </tr>
                    {foreach from=$std item=item}
                        <tr>
                            <td>{$item.StartDate}</td>
                            <td>{$item.StopDate|default:'-'}</td>
                            <td>{$item.Institution}</td>
                            <td>{$item.Specialization}</td>
                            <td>{$jobdomains[$item.DomainID]}</td>
                            <td>{$item.Diploma|default:'-'}</td>
                        </tr>
                    {/foreach}
                </table>
            </td>
        </tr>
    {/if}
    {if !empty($lang)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2">
                <b>{translate label='Limbi straine'}:</b>
                <br>
                <table cellspacing="0" cellpadding="4">
                    <tr>
                        <td>{translate label='Limba straina'}</td>
                        <td>{translate label='Citit'}</td>
                        <td>{translate label='Scris'}</td>
                        <td>{translate label='Vorbit'}</td>
                    </tr>
                    {foreach from=$lang item=item}
                        <tr>
                            <td>{$languages[$item.Lang]}</td>
                            <td>{$lang_level[$item.ReadLevel]}</td>
                            <td>{$lang_level[$item.WriteLevel]}</td>
                            <td>{$lang_level[$item.SpeakLevel]}</td>
                        </tr>
                    {/foreach}
                </table>
            </td>
        </tr>
    {/if}
    {if !empty($info.CVQualifRel)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2"><b>{translate label='Calificari relevante'}:</b><br>{$info.CVQualifRel}</td>
        </tr>
    {/if}
    {if !empty($info.CVCourses)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2"><b>{translate label='Cursuri'}:</b><br>{$info.CVCourses}</td>
        </tr>
    {/if}
    {if !empty($info.CVSkills)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2"><b>{translate label='Aptitudini'}:</b><br>{$info.CVSkills}</td>
        </tr>
    {/if}
    {if !empty($info.CVHobby)}
        <tr>
            <td class="celulaMenuSTDR" colspan="2"><b>{translate label='Hobbiuri'}:</b><br>{$info.CVHobby}</td>
        </tr>
    {/if}
</table>
<br>
{if $recruiter_eval}
    <table cellspacing="0" cellpadding="6" width="100%">
        <tr>
            <td colspan="2" class="bkdTitleMenu"><span class="TitleBox">{translate label='Evaluare recruiter'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuST" width="200"><b>{translate label='Caracteristici generale'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.General|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Competente'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Competences|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Profil'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Profile|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Sumar'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Summary|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Puncte tari'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Strong|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Puncte de imbunatatit'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Weak|default:'-'}</td>
        </tr>
        <tr>
            <td class="celulaMenuST"><b>{translate label='Motivatie'}:</b></td>
            <td class="celulaMenuDR">{$recruiter_eval.Motivation|default:'-'}</td>
        </tr>
    </table>
{/if}
</body>
</html>