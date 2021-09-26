{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"> {translate label='Aprobari'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Aprobare concediu'}</legend>
                    <input type="radio" name="vacation_aprove" value="0" {if $settings.vacation_aprove == 0}checked{/if}> {translate label='fara aprobare'}
                    <br><br>
                    <input type="radio" name="vacation_aprove" value="1" {if $settings.vacation_aprove == 1}checked{/if}> {translate label='aprobarea managerului direct'}
                    <br><br>
                    <input type="submit" value="{translate label='Salveaza'}">
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Aprobare la nivel de training'}</legend>
                    <input type="radio" name="training_aprove" value="0" {if $settings.training_aprove == 0}checked{/if}> {translate label='fara aprobare'}
                    <br><br>
                    <input type="radio" name="training_aprove" value="1" {if $settings.training_aprove == 1}checked{/if}> {translate label='aprobarea managerului direct'}
                    <br><br>
                    <input type="submit" value="{translate label='Salveaza'}">
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Aprobare training la nivel de angajat'}</legend>
                    <input type="radio" name="training_person_aprove" value="0" {if $settings.training_person_aprove == 0}checked{/if}> {translate label='fara aprobare'}
                    <br><br>
                    <input type="radio" name="training_person_aprove" value="1"
                           {if $settings.training_person_aprove == 1}checked{/if}> {translate label='aprobarea managerului direct'}
                    <br><br>
                    <input type="submit" value="{translate label='Salveaza'}">
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><font color="#FFFFFF">&nbsp;</td>
        </tr>
    </table>
</form>
