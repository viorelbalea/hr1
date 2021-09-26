<div class="submeniu">
    <a href="./?m=admin&o=users" {if $smarty.get.o == 'users'}class="selected" {else}class="unselected"{/if}>{translate label='Utilizatori'}</a>
    <a href="./?m=admin&o=reports" {if $smarty.get.o == 'reports'}class="selected" {else}class="unselected"{/if}>{translate label='Rapoarte'}</a>
    <a href="./?m=admin&o=customfields" {if $smarty.get.o == 'customfields'}class="selected" {else}class="unselected"{/if}>{translate label='Campuri custom'}</a>
    <a href="./?m=admin&o=alert" {if $smarty.get.o == 'alert'}class="selected" {else}class="unselected"{/if}>{translate label='Alerte'}</a>
    <a href="./?m=admin&o=aprove" {if $smarty.get.o == 'aprove'}class="selected" {else}class="unselected"{/if}>{translate label='Aprobari'}</a>
    <a href="./?m=admin&o=budgets" {if $smarty.get.o == 'budgets'}class="selected" {else}class="unselected"{/if}>{translate label='Bugete'}</a>
    <a href="./?m=admin&o=import" {if $smarty.get.o == 'import'}class="selected" {else}class="unselected"{/if}>{translate label='Import persoane'}</a>
    <a href="./?m=admin&o=import_saga" {if $smarty.get.o == 'import_saga'}class="selected" {else}class="unselected"{/if}>{translate label='Import SAGA'}</a>
    <a href="./?m=admin&o=import_salary" {if $smarty.get.o == 'import_salary'}class="selected" {else}class="unselected"{/if}>{translate label='Import stat salarii'}</a>
    <a href="./?m=admin&o=import-cars" {if $smarty.get.o == 'import-cars'}class="selected" {else}class="unselected"{/if}>{translate label='Import masini'}</a>
    <a href="./?m=admin&o=translate" {if $smarty.get.o == 'translate'}class="selected" {else}class="unselected"{/if}>{translate label='Traduceri'}</a>
    <a href="./?m=admin&o=settings" {if $smarty.get.o == 'settings'}class="selected" {else}class="unselected"{/if}>{translate label='Setari pe companie'}</a>
    <a href="./?m=admin&o=currency" {if $smarty.get.o == 'currency'}class="selected" {else}class="unselected"{/if}>{translate label='Moneda'}</a>
    <a href="./?m=admin&o=ticketing" {if $smarty.get.o == 'ticketing'}class="selected" {else}class="unselected"{/if}>{translate label='Ticketing'}</a>
    <a href="./?m=admin&o=import_cand_ext" {if $smarty.get.o == 'import_cand_ext'}class="selected" {else}class="unselected"{/if}>{translate label='Import candidati externi'}</a>
    <a href="./?m=admin&o=import_charisma" {if $smarty.get.o == 'import_charisma'}class="selected" {else}class="unselected"{/if}>{translate label='Import Charisma'}</a>
</div>
