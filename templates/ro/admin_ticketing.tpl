{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Setari ticketing:'}</span></td>
    </tr>
    <tr>
        <td valign="top" align="center"><font color="green">{$mesajT}</font></td>
    </tr>
    <tr>
        <td>

            <form method="GET" action="">
                <input type="hidden" name="m" value="admin"/>
                <input type="hidden" name="o" value="ticketing"/>
                <label>Selectati categoria:</label>
                <select name="CategoryID" onchange="this.form.submit();">
                    <option value="0">Categorie</option>
                    {foreach from=$categories key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.CategoryID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
                <!--<input type="submit" name="submit" value="Select" />-->
            </form>

            {if isset($smarty.get.CategoryID) and $smarty.get.CategoryID!=0}
                <form method="GET" action="">
                    <input type="hidden" name="m" value="admin"/>
                    <input type="hidden" name="o" value="ticketing"/>
                    <input type="hidden" name="CategoryID" value="{$smarty.get.CategoryID}"/>
                    <label>Selectati valoarea initiala a persoanei asignate:</label>
                    <select name="assign_default" onchange="this.form.submit();">
                        {foreach from=$assign_defaults key=key item=item}
                            <option value="{$key}" {if $key==$assign_default}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>

                    <!--<input type="submit" name="submit" value="Select" />-->
                </form>
            {/if}

            {if isset($persons)}
                <form method="GET" action="">
                    <input type="hidden" name="m" value="admin"/>
                    <input type="hidden" name="o" value="ticketing"/>
                    <input type="hidden" name="CategoryID" value="{$smarty.get.CategoryID}"/>
                    <input type="hidden" name="assign_default" value="{$assign_default}"/>
                    <label>Selectati persoana asignata:</label>
                    <select name="assign_person">
                        <option value="0">selectati persoana</option>
                        {foreach from=$persons key=key item=item}
                            <option value="{$key}" {if $key==$assign_person}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>

                    <input type="submit" name="submit" value="Select"/>
                </form>
            {/if}
        </td>
    </tr>
    <tr>
        <td valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='... setari ticketing.'}</span></td>
    </tr>
</table>
</form>
