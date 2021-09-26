<div class="submeniu">
    {if $smarty.session.USER_RIGHTS2.9.1 == 3 || $smarty.session.USER_ID == 1}
        <a href="./?m=performance&o=divizii"
           class="{if empty($smarty.get.o) || $smarty.get.o == 'divizii'}selected{else}unselected{/if}">{translate label='Actiuni divizii'}</a>
        <a href="./?m=performance&o=objective"
           class="{if $smarty.get.o == 'objective'}selected{else}unselected{/if}">{translate label='Obiective angajati'}</a>
    {else}
        {if $smarty.session.ACCESSPERF == 1 || $smarty.session.ACCESSPERF == 3}
            <a href="./?m=performance&o=divizii"
               class="{if empty($smarty.get.o) || $smarty.get.o == 'divizii'}selected{else}unselected{/if}">{translate label='Actiuni divizii'}</a>
            <a href="./?m=performance&o=plan"
               class="{if $smarty.get.o == 'plan'}selected{else}unselected{/if}">{translate label='Plan actiuni'}</a>
        {/if}
        {if $smarty.session.ACCESSPERF == 2 || $smarty.session.ACCESSPERF == 3}
            <a href="./?m=performance&o=objective"
               class="{if $smarty.get.o == 'objective'}selected{else}unselected{/if}">{translate label='Obiective angajati'}</a>
            <a href="./?m=performance&o=goals"
               class="{if $smarty.get.o == 'goals'}selected{else}unselected{/if}">{translate label='Obiective proprii'}</a>
        {/if}
    {/if}
</div>