{foreach from=$rights_level_3.5.1 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.5.1.$key > 0}
        <a href="./?m=training&o={$item.o}&TrainingID={$smarty.get.TrainingID}"
           class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{translate label=$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
    {/if}
{/foreach}