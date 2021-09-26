{foreach from=$rights_level_3.30.1 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.30.1.$key > 0}
        <a href="./?m=ticketing&o={$item.o}&TicketID={$smarty.get.TicketID}"
           class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{translate label=$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
    {/if}
{/foreach}
{if $smarty.get.TicketID > 0}
    &nbsp;&nbsp;|&nbsp;&nbsp;
    <a target="_blank" href="./?m=ticketing&o=print-report&TicketID={$smarty.get.TicketID}"
       {if $smarty.get.o == 'print-report'}class="selected"
       {else}class="unselected"{/if}>{translate label='Print raport tichet'}</a>
{/if}