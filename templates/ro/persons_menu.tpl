<div class="submeniu">
    {foreach from=$rights_level_2.1 key=key item=item}
        {if ($smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.1.$key)) && $key != 6}
            <a href="./?m=persons{if !empty($item.o)}&o={$item.o}{/if}" {if $smarty.get.o == $item.o && $smarty.get.m != 'candidates'}class="selected"
               {else}class="unselected"{/if}>{translate label=$item.name}</a>
        {/if}
    {/foreach}
</div>
