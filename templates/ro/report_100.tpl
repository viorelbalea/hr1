{translate label='Document creat intre'}

<input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">

<SCRIPT LANGUAGE="JavaScript" ID="js1">

    var cal1 = new CalendarPopup();

    cal1.isShowNavigationDropdowns = true;

    cal1.setYearSelectStartOffset(10);

    //writeSource("js1");

</SCRIPT>

<A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
   title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>

{translate label='si'}

<input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">

<SCRIPT LANGUAGE="JavaScript" ID="js2">

    var cal2 = new CalendarPopup();

    cal2.isShowNavigationDropdowns = true;

    cal2.setYearSelectStartOffset(10);

    //writeSource("js2");

</SCRIPT>

<A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="{translate label='Data de sfarsit'}"><img
            src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A>

&nbsp;&nbsp;&nbsp;

Masina: <select name="CarID" id="CarID">

    <option value="0">{translate label='Toate'}</option>

    {foreach from=$cars item=item key=key item=item}
        <option value="{$key}" {if $key==$smarty.get.CarID}selected{/if}>{$item}</option>
    {/foreach}

</select>

&nbsp;&nbsp;&nbsp;

Tip cost: <select name="CostDictID" id="CostDictID">

    <option value="0">{translate label='Toate'}</option>

    {foreach from=$cost_types item=item key=key item=item}
        <option value="{$key}" {if $key==$smarty.get.CostDictID}selected{/if}>{$item}</option>
    {/foreach}

</select>

&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&CostDictID=' + document.getElementById('CostDictID').value+'&CarID=' + document.getElementById('CarID').value;">

{if !empty($smarty.get.StartDate)}
    <br>
    <br>
    <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1">

        <tr>

            <td><b>#</b></td>

            <td><b>{translate label='Tip reparatie'}</b></td>

            <td><b>{translate label='Furnizor'}</b></td>

            <td><b>{translate label='Document'}</b></td>

            <td><b>{translate label='Data document'}</b></td>

            <td><b>{translate label='Nr. Km'}</b></td>

            <td><b>{translate label='Valoare'}</b></td>

            <td><b>{translate label='Moneda'}</b></td>

            <td><b>{translate label='TVA'}</b></td>

            <td><b>{translate label='Observatii'}</b></td>

            <td><b>{translate label='Utilizator'}</b></td>

            <td><b>{translate label='Rol'}</b></td>

        </tr>

        {foreach from=$costs item=item name=iter}
            <tr>

                <td class="celulaMenuST">{$smarty.foreach.iter.iteration}</td>

                <td class="celulaMenuST">{$item.CostDetail|default:'-'}</td>

                <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>

                <td class="celulaMenuST">{$item.ReceiptNo|default:'-'}</td>

                <td class="celulaMenuST">{$item.CostDate|default:'-'}</td>

                <td class="celulaMenuST">{$item.Km|default:'-'}</td>

                <td class="celulaMenuST">{$item.Cost|default:'-'}</td>

                <td class="celulaMenuST">{$item.Coin|default:'-'}</td>

                <td class="celulaMenuST">{$item.CostVAT|number_format:2:",":"."|default:'-'}</td>

                <td class="celulaMenuST">{$item.Notes|default:'-'}</td>

                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>

                <td class="celulaMenuST">{$item.UserName|default:'-'}</td>

            </tr>
            {foreachelse}
            <tr height="30">

                <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>

            </tr>
        {/foreach}

    </table>
{/if}