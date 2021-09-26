{include file="candidates_menu.tpl"}
{include file="candidates_posts_menu.tpl"}

<h1>Lista posturi</h1>
<table cellspacing="0" cellpadding="2" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Sursa</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Post</span></td>
    </tr>
    {foreach from=$posts key=key item=item}
        <tr>
            <td>{$key}</td>
            <td>{$sourceID[$key]}</td>
            <td>{$item}</td>
        </tr>
    {/foreach}
</table> 