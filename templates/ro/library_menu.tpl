<div class="submeniu">
    {foreach from=$rights_level_2.10 key=key item=item}
        {if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.10.$key)}
            <a href="./?m=library{if !empty($item.o)}&o={$item.o}{/if}" {if $smarty.get.o == $item.o}class="selected" {else}class="unselected"{/if}>{translate label=$item.name}</a>
        {/if}
    {/foreach}
</div>
