<div class="submeniu">
    {foreach from=$rights_level_2.27 key=key item=item}
        {if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.27.$key)}
            <a href="./?m=cars{if !empty($item.o)}&o={$item.o}{/if}" {if $smarty.get.o == $item.o}class="selected" {else}class="unselected"{/if}>{translate label=$item.name}</a>
        {/if}
    {/foreach}
</div>
