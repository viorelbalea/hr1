{foreach from=$rights_level_3.26.1 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.26.1.$key > 0}
        <a href="javascript:return false;"
           class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
    {/if}
{/foreach}