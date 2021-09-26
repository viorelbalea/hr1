{include file="pontaj_menu.tpl"}

<div class="filter">
    <label>{translate label='Perioada intre '}</label>
    <input type="text" name="StartDate" id="StartDate" class="formstyle"
           value="{if !empty($smarty.get.StartDate)}{$smarty.get.StartDate|date_format:'%d.%m.%Y'}{else}{$smarty.now|date_format:'01-%m-%Y'}{/if}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
    <label>si</label>
    <input type="text" name="StopDate" id="StopDate" class="formstyle" value="{$smarty.get.StopDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal2 = new CalendarPopup();
        cal2.isShowNavigationDropdowns = true;
        cal2.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal2.select(document.getElementById('StopDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
    <input type="button" value="Genereaza" class="cod" onclick="window.location.href = './?m=pontaj&o=precalc' +
											   '&StartDate=' + escape(document.getElementById('StartDate').value) + 
											   '&StopDate=' + escape(document.getElementById('StopDate').value) + 
											   '&recalc=1'">
</div>

{if !empty($success)}
    {translate label='Recalculare finalizata'}!
{/if}