{include file="candidates_menu.tpl"}
{include file="candidates_posts_menu.tpl"}
<h1>Adauga post</h1>
<p>{$mesaj}</p>
<form method="POST" action="?m=candidates&o=posts&action=add_post">
    <label>Post</label>
    <input type="text" name="post"/>
    <select name="id_source">
        {foreach from=$sources key=key item=item}
            <option value="{$key}">{$item}</option>
        {/foreach}
    </select>
    <input type="submit" name="submit" value="Adauga"/>
</form>