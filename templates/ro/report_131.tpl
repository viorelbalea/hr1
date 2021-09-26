{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">

        {if $info.CompanyID && $info.CompanyPhoto}
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr width="100%">
                    <td align="center"><img src="{$info.CompanyPhoto}"/></td>
                </tr>
            </table>
            <br clear="all"/>
        {/if}

        <p style="text-align:center"><strong>ACT ADITIONAL NR. ............. / {$smarty.now|date_format:'%d.%m.%Y'}</strong><br/><br/><br/>
            La contractul individual de munca incheiat si inregistrat sub nr. {$info.ContractNo|default:'.....'}
            /{if !empty($info.ContractDate) && $info.ContractDate != '00.00.0000'}{$info.ContractDate}{else}..................{/if}
            in registrul de evidenta a salariatilor
            <br/><br/>
        </p>

        <p style="text-indent:40px;">Incheiat astazi {$smarty.now|date_format:"%d.%m.%Y"} intre:</p>

        <p style="text-indent:40px; text-align:justify;">
            Angajator - persoana juridica {$info.CompanyName|default:'..............................'} cu sediul in {$info.DistrictName|default:'.......................'}
            , {$info.CompanyAddress|default:'.....................................'},
            inregistrata la Registrul Comertului din Bucuresti sub nr. {$info.RegComert|default:'.......................'}, cod fiscal {$info.CIF|default:'.......................'}
            , telefon {$info.PhoneNumberA|default:'......................'}, reprezentata legal prin {$info.LegalFullName|default:'........................................'}, in
            calitate de Director General
        </p>
        Si
        <p style="text-indent:40px; text-align:justify;">
            {if $info.Sex == 'M'}Salariatul - Domnul{else}Salariata - Doamna{/if} <b>{$info.FullName}</b>, {if $info.Sex == 'M'}domiciliat{else}domiciliata{/if} in
            <strong>{$info.PersonAddress|default:'Str. ................ Nr. ...., Bl. ...... Sc. ...., Et. ...., Ap ....., Judet/Sector ..............  '}</strong>, {if $info.Sex == 'M'}posesor al{else}posesoare a{/if}
            CI <strong>seria {$info.BISerie|default:'.........'} nr. {$info.BINumber|default:'....................'}</strong>, eliberata de
            <b>{$info.BIEmitent|default:'.......................'}</b>, la data de <b>{$info.BIStartDate|default:'..................'}</b>,
            <b>CNP {$info.CNP|default:'.......................'}</b>.
        </p>

        <p style="text-indent:40px; text-align:justify;">
            In temeiul art. 17 (4) coroborat cu art. 41 (1) din Legea nr. 53/2003, partile HOTARASC:
        </p>

        <p>
        <ol>
            <li>Se modifica elementul: <i>** DURATA CONTRACTULUI </i>al contractului individual de munca se prelungeste din data
                de {if !empty($info.ActeAd.StartDate)}{$info.ActeAd.StartDate|date_format:'%d.%m.%Y'}{else}............................{/if} pana in data
                de {if !empty($info.ActeAd.StopDate)}{$info.ActeAd.StopDate|date_format:'%d.%m.%Y'}{else}...............................{/if} .
            </li>
        </ol>
        </p>

        <p style="text-indent:40px; text-align:justify;">
            Prezentul act aditional a fost incheiat in 2 exemplare, cate un exemplar pentru fiecare parte, urmand sa-si produca efectele incepand cu data
            de {$smarty.now|date_format:'%d.%m.%Y'} .
        </p>

        <br/><br/>

        <table width="100%" align="center" style="margin-bottom:0px;">
            <tr>
                <td width="50%"><strong>ANGAJATOR, </strong></td>
                <td width="50%" align="right"><strong>ANGAJAT, </strong></td>
            </tr>
            <tr>
                <td width="50%">{$info.CompanyName|default:'.......................'}</td>
                <td width="50%" align="right">{$info.FullName}</td>
            </tr>
            <tr>
                <td width="50%">_______________________________</td>
                <td width="50%" align="right">_______________________________</td>
            </tr>
        </table>

    </div>
{/if}