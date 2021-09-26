{foreach from=$rights_level_3.1.1 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.1.1.$key > 0}
        {if ($info.Status == 1 && in_array($key, array(1,3,5,11,14,17,18,20,21,22))) || in_array($info.Status, array(2,7,9,10,12)) || ($info.Status > 2 && !in_array($key, array(15, 16, 17)))}
            <a href="./?m=persons&o={$item.o}&PersonID={$smarty.get.PersonID}"
               class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{translate label=$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
        {/if}
    {/if}
{/foreach}
