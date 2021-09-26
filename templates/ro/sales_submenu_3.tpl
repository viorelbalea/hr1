{foreach from=$rights_level_3.14.3 key=key item=item name=iter}
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.14.3.$key > 0}
        <a href="./?m=sales&o={$item.o}&CampaignID={$smarty.get.CampaignID}"
           class="subMeniuPage{if $item.o==$smarty.get.o}Activ{/if}">{translate label=$item.name}</a>{if !$smarty.foreach.iter.last}&nbsp;&nbsp;|&nbsp;&nbsp;{/if}
    {/if}
{/foreach}