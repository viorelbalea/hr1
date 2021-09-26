{if !empty($smarty.get.PersonID)}
    <div style="width: 800px">

        <h3>Nr ........ Din .................</h3>

        <br>
        <h1 style="text-align: center;">ADEVERINTA</h1>

        <br>
        <p>Prin prezenta se adevereste ca {if $info.Sex == 'M'}domnul{else}doamna{/if} {$info.FullName}</p>
        <p>avand CNP {$info.CNP}, este {if $info.Sex == 'M'}salariat{else}salariata{/if} la <b>{$info.CompanyName}</b></p>
        <p>pe perioada {$info.ContractType}.</p>

        <br>
        <p>Venitul net realizat in luna ............................ este de .................. lei</p>

        <br>
        <p>Am eliberat prezenta adeverinta pentru a-i servi la Primarie pentru obtinerea<br/>
            alocatiei complementare.</p>

        <br/><br/>
        <p><b>Aprobat</b><br/>
            Functie: Administrator<br/>
            Nume si prenume:<br/>
            Semnatura:<br/>

            <br/><br/>
            <b>Intocmit</b><br/>
            Functie:<br/>
            Nume si prenume:<br/>
            Semnatura:
        </p>

        <table cellpacing="0" cellpadding="0" border="0">
            <tr>
                <td></td>
            </tr>
        </table>

    </div>
{/if}