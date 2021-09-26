{if !empty($smarty.get.PersonID)}
    <div style="width:800px; margin:0px;">


        <p><b>{$info.CompanyName|default:'.......................'}</b><br/>

            <b>Adresa: {$info.CompanyAddress|default:'.......................'}</b><br/>

            <b>R.C.: {$info.RegComert|default:'...........................................'}</b><br/>

            <b>C.F.: {$info.CIF|default:'...........................................'}</b><br/>

            <b>Tel.: {$info.PhoneNumberA|default:'...........................................'}</b></p>


        <p style="text-align:center"><strong>NOTIFICARE</strong><br/>

            <strong>nr. ............../ {$smarty.now|date_format:'%d.%m.%Y'}</strong></p>


        <br/>

        <table width="100%" cellspacing="0" cellpadding="0" border="0">

            <tr>

                <td style="text-indent:25px; ">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{if $info.Sex == 'M'}D-nului{else}D-nei{/if} {$info.FullName},

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; ">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In conformitate cu art. 31 alin. 3 din Codul Muncii, {$info.CompanyName|default:'..............................'}, reprezentata
                    legal de {if $info.LegalSex == 'M'}d-nul{else}d-na{/if} {$info.LegalFullName|default:'........................................'} in functia de Director General,<br/><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; text-align:center; ">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>DECIDE:</strong><br/><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; ">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Incetarea contractului individual de munca nr. {$info.ContractNo|default:'.......................'},
                    al {if $info.Sex == 'M'}d-nului{else}d-nei{/if} {$info.FullName}, incepand cu data
                    de {if $info.WorkStopDate != '00.00.0000'}{$info.WorkStopDate|default:'.......................'}{else}.......................{/if}, contract ce are inclusa
                    perioada de proba de {$info.ContractProbationPeriod|default:'................'} zile calendaristice.<br/><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; ">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pentru perioada lucrata la {$info.CompanyName|default:'..............................'}
                    , {if $info.Sex == 'M'}d-nul{else}d-na{/if} {$info.FullName} va primi toate drepturile legale ce i se cuvin.<br/><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; "><b>{$info.CompanyName|default:'..............................'}</b><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; "><b>Reprezentant legal,</b><br/>

                </td>

            </tr>

            <tr>

                <td style="text-indent:25px; ">

                    <b>{$info.LegalFullName|default:'........................................'}</b><br/><br/><br/>

                </td>

            </tr>

            <tr>

                <td style="">Am luat la cunostinta, <br/>{$info.FullName|default:'................................'}


                    <br/><br/><br/>........................................................<br/><br/>

                </td>

            </tr>

        </table>

    </div>
{/if}