{foreach from=$rights_level_3.14.5 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.14.5.$key > 0}
        <a href="./?m=sales&o={$item.o}&DailyID={$smarty.get.DailyID}"
           class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{translate label=$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
    {/if}
{/foreach}