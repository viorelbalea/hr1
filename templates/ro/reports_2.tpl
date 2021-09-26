<br>
<select name="o" onchange="if (this.value>0) window.location.href = './?m=reports_2&o=' + this.value">
    <option value="0">{translate label='alege raport...'}</option>
    <option value="1"
            {if $smarty.get.o==1}selected{/if}>{translate label='Numarul persoanelor contactate din totalul numarul persoanelor alocate unui Centru de cost sau Locatie'}</option>
    <option value="2" {if $smarty.get.o==2}selected{/if}>{translate label='Numarul persoanelor inscrise in program'}</option>
    <option value="3"
            {if $smarty.get.o==3}selected{/if}>{translate label='Numarul persoanelor repozitionate pe piata muncii prin intermediul serviciilor oferite de acest program'}</option>
</select>
<br><br>
{if !empty($smarty.get.o)}
    {include file=$report_file}
{/if}