<?php /* Smarty version 2.6.18, created on 2020-09-21 09:01:06
         compiled from dictionary_sites.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_sites.tpl', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">Locatii & sali</span></td>
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
                <legend><?php echo smarty_function_translate(array('label' => 'Locatii'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <?php $_from = $this->_tpl_vars['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="Site_<?php echo $this->_tpl_vars['key']; ?>
" name="Site_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']; ?>
" size="25" maxlength="128"></td>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=sites&SiteID=<?php echo $this->_tpl_vars['key']; ?>
&Site=' + escape(document.getElementById('Site_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica locatie'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Stergerea unei locatii implica stergerea tuturor salilor aferente.\nSunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=sites&SiteID=<?php echo $this->_tpl_vars['key']; ?>
&delSite=1'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge locatie'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <tr>
                                        <td><input type="text" id="Site_0" name="Site_0" size="25" maxlength="128"></td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=sites&SiteID=0&Site=' + escape(document.getElementById('Site_0').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga locatie'), $this);?>
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
                <legend><?php echo smarty_function_translate(array('label' => 'Locatii si sali'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="sites" onchange="if (this.value>0) window.location.href='./?m=dictionary&o=sites&SiteID=' + this.value">
                                <option value=""><?php echo smarty_function_translate(array('label' => 'alege locatia'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['SiteID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <?php if (! empty ( $_GET['SiteID'] )): ?>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Sali'), $this);?>
</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Denumire sala'), $this);?>
</td>
                                <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['rooms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text" id="Room_<?php echo $this->_tpl_vars['key']; ?>
" name="Room_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Room']; ?>
" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_<?php echo $this->_tpl_vars['key']; ?>
" name="Notes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
" size="30" maxlength="255"></td>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=sites&SiteID=<?php echo $_GET['SiteID']; ?>
&RoomID=<?php echo $this->_tpl_vars['key']; ?>
&Room=' + escape(document.getElementById('Room_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica sala'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=sites&SiteID=<?php echo $_GET['SiteID']; ?>
&RoomID=<?php echo $this->_tpl_vars['key']; ?>
&delRoom=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge sala'), $this);?>
"><b>Del</b></a></div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <tr>
                                    <td><input type="text" id="Room_0" name="Room_0" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_0" name="Notes_0" size="30" maxlength="255"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=sites&SiteID=<?php echo $_GET['SiteID']; ?>
&RoomID=0&Room=' + escape(document.getElementById('Room_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga sala'), $this);?>
"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'locatii & sali'), $this);?>
</span></td>
    </tr>
</table>