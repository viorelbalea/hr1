<br>
<select name="o" onchange="if (this.value>0) window.location.href = './?m=reports_1&o=' + this.value">
    <option value="0">{translate label='alege raport...'}</option>
    <option value="1" {if $smarty.get.o==1}selected{/if}>{translate label='Nr. intrevederi individuale/colective cu candidati/angajatori'}</option>
    <option value="2" {if $smarty.get.o==2}selected{/if}>{translate label='Nr. candidati in acompaniere'}</option>
    <option value="3" {if $smarty.get.o==3}selected{/if}>{translate label='Nr. candidati rezolvati'}</option>
    <option value="4" {if $smarty.get.o==4}selected{/if}>{translate label='Nr. angajatori contactati'}</option>
    <option value="5" {if $smarty.get.o==5}selected{/if}>{translate label='Nr. joburi identificate'}</option>
</select>
<br><br>
{if !empty($smarty.get.o)}
    {*{include file=$report_file}*}
{/if}