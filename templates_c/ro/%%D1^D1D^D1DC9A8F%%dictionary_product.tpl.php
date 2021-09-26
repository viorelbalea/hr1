<?php /* Smarty version 2.6.18, created on 2020-10-07 11:29:57
         compiled from dictionary_product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_product.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Categorii produse'), $this);?>
</span></td>
    </tr>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Categorii'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                    <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>
                                </tr>
                                <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="Name_<?php echo $this->_tpl_vars['key']; ?>
" name="Name_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Name']; ?>
" size="20" maxlength="128"></td>
                                        <td><input type="text" id="Descr_<?php echo $this->_tpl_vars['key']; ?>
" name="Descr_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Descr']; ?>
" size="30" maxlength="255"></td>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=product&CatID=<?php echo $this->_tpl_vars['key']; ?>
&Name=' + escape(document.getElementById('Name_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Descr=' + escape(document.getElementById('Descr_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica categoria'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a) ca vreti sa stergeti aceasta categorie?'), $this);?>
')) window.location.href = './?m=dictionary&o=product&CatID=<?php echo $this->_tpl_vars['key']; ?>
&delCat=1'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge categoria'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <tr>
                                        <td><input type="text" id="Name_0" name="Name_0" size="20" maxlength="128"></td>
                                        <td><input type="text" id="Descr_0" name="Descr_0" size="30" maxlength="255"></td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=product&CatID=0&Name=' + escape(document.getElementById('Name_0').value) + '&Descr=' + escape(document.getElementById('Descr_0').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga categorie'), $this);?>
"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Subcategorii'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="cats" onchange="if (this.value>0) window.location.href='./?m=dictionary&o=product&CatID=' + this.value">
                                <option value=""><?php echo smarty_function_translate(array('label' => 'alege categoria'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CatID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Name']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <?php if (! empty ( $_GET['CatID'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>Nume</td>
                            <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['subcats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td><input type="text" id="Name__<?php echo $this->_tpl_vars['key']; ?>
" name="Name_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Name']; ?>
" size="20" maxlength="128"></td>
                                <td><input type="text" id="Descr__<?php echo $this->_tpl_vars['key']; ?>
" name="Descr_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Descr']; ?>
" size="30" maxlength="255"></td>
                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=product&PCatID=<?php echo $_GET['CatID']; ?>
&CatID=<?php echo $this->_tpl_vars['key']; ?>
&Name=' + escape(document.getElementById('Name__<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Descr=' + escape(document.getElementById('Descr__<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica subcategoria'), $this);?>
"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a) ca vreti sa stergeti aceasta subcategorie?'), $this);?>
')) window.location.href = './?m=dictionary&o=product&PCatID=<?php echo $_GET['CatID']; ?>
&CatID=<?php echo $this->_tpl_vars['key']; ?>
&delCat=1'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge subcategoria'), $this);?>
"><b>Del</b></a></div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <tr>
                                <td><input type="text" id="Name__0" name="Name__0" size="20" maxlength="128"></td>
                                <td><input type="text" id="Descr__0" name="Descr__0" size="30" maxlength="255"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=dictionary&o=product&PCatID=<?php echo $_GET['CatID']; ?>
&CatID=0&Name=' + escape(document.getElementById('Name__0').value) + '&Descr=' + escape(document.getElementById('Descr__0').value); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga subcategorie'), $this);?>
"><b>Add</b></a></div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'categorii & subcategorii produse'), $this);?>
</span></td>
    </tr>
</table>