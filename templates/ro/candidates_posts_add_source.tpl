{include file="candidates_menu.tpl"}
{include file="candidates_posts_menu.tpl"}
<h1>Adauga sursa</h1>
<p>{$mesaj}</p>
<form method="POST" action="?m=candidates&o=posts&action=add_source">
    <label>Sursa</label>
    <input type="text" name="source"/>
    <input type="submit" name="submit" value="Adauga"/>
</form>