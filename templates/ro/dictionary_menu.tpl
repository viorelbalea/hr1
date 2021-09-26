<div class="submeniu">
    {if $rights_level_3.20.1|@count > 13}
        {foreach from=$rights_level_3.20.1 key=key item=item name=iter}

            {if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS3.20.1.$key)}
                <a href="./?m=dictionary&o={$item.o}" {if $smarty.get.o == $item.o}class="selected"
                   {else}class="unselected"{/if}>{translate label=$item.name}</a>
            {/if}

        {/foreach}
    {else}
        {foreach from=$rights_level_3.20.1 key=key item=item}
            {if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS3.20.1.$key)}
                <a href="./?m=dictionary&o={$item.o}" {if $smarty.get.o == $item.o}class="selected"
                   {else}class="unselected"{/if}>{translate label=$item.name}</a>
            {/if}
        {/foreach}
    {/if}
</div>