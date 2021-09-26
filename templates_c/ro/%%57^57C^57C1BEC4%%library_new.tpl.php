<?php /* Smarty version 2.6.18, created on 2021-03-25 08:11:37
         compiled from library_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'library_new.tpl', 10, false),array('modifier', 'default', 'library_new.tpl', 49, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "library_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <?php if (! empty ( $_GET['DocID'] )): ?>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "library_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adaugare document'), $this);?>
</span></td>
            </tr>
        <?php endif; ?>
        <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == ""): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Documentul a fost salvat!'), $this);?>
</td>
            </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Informatii document'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Categoria'), $this);?>
:*</b></td>
                            <td>
                                <select name="CatID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege categoria'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['cats']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <?php if ($_SESSION['USER_ID'] == 1 || isset ( $this->_tpl_vars['categories'][$this->_tpl_vars['key']] )): ?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['CatID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php if (is_array ( $this->_tpl_vars['cats'][$this->_tpl_vars['key']] )): ?>
                                                <?php $_from = $this->_tpl_vars['cats'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['info']['CatID'] == $this->_tpl_vars['key2']): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Cod document'), $this);?>
:*</b></td>
                            <td><input type="text" name="DocCode" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DocCode'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nume document'), $this);?>
:*</b></td>
                            <td><input type="text" name="DocName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DocName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="80" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Versiune'), $this);?>
:</b></td>
                            <td><input type="text" name="DocVersion" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DocVersion'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
:</b></td>
                            <td><textarea name="DocDescr" cols="80" rows="6" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DocDescr'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Taguri'), $this);?>
:</b><br><?php echo smarty_function_translate(array('label' => '(separate prin , )'), $this);?>
</td>
                            <td><textarea name="Tags" cols="80" rows="4" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Tags'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea><br><?php echo smarty_function_translate(array('label' => '(ex: economie, legislatie)'), $this);?>
</td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Document'), $this);?>
:*</b></td>
                            <td>
                                <input type="file" name="FileName">
                                <?php if (! empty ( $_GET['DocID'] )): ?>
                                    [ Acceseaza documentul
                                    <a href="<?php echo $this->_tpl_vars['info']['curr_filename']; ?>
" target="_blank"><?php echo $this->_tpl_vars['info']['FileName']; ?>
</a>
                                    ]
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Citire obligatorie'), $this);?>
:</b></td>
                            <td>
                                <input type="checkbox" name="MandatoryReading" id="MandatoryReading" style="float:left;"
                                       value="1" <?php if ($this->_tpl_vars['info']['MandatoryReading'] == 1): ?> checked="checked"<?php endif; ?> onchange="
							if (this.checked==false) 
								document.getElementById('div_InternalFunctions').style.display='none';
							if (this.checked==true) 
								document.getElementById('div_InternalFunctions').style.display='inline';"/>
                                <div id="div_InternalFunction" style="float:left; margin-left:20px;">
                                    <select name="InternalFunctions[]" multiple="multiple" size="10">
                                        <?php $_from = $this->_tpl_vars['internal_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                            <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
        $this->_foreach['iter2']['iteration']++;
?>
                                                <?php if (($this->_foreach['iter2']['iteration'] <= 1)): ?><optgroup label="<?php echo $this->_tpl_vars['item2']['GroupName']; ?>
"><?php endif; ?>
                                                <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['info']['InternalFunctions'][$this->_tpl_vars['key2']]): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['Function']; ?>
 [<?php echo $this->_tpl_vars['item2']['GroupName']; ?>

                                                    | <?php echo $this->_tpl_vars['item2']['Grad']; ?>
]
                                                </option>
                                                <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?></optgroup><?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                    <br/>* <?php echo smarty_function_translate(array('label' => 'Pentru selectie multipla tineti tasta <b>Ctrl</b> apasata'), $this);?>

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <?php if (! empty ( $_GET['DocID'] )): ?>
                                    <input type="hidden" name="curr_filename" value="<?php echo $this->_tpl_vars['info']['curr_filename']; ?>
">
                                    <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?>
                                <?php else: ?>
                                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Adauga document'), $this);?>
" class="formstyle">
                                <?php endif; ?>
                                &nbsp;&nbsp;<input type="button" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
" onclick="window.location='./?m=library';" class="formstyle">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    if (document.getElementById('MandatoryReading').checked == false)
        document.getElementById('div_InternalFunctions').style.display = 'none';
    if (document.getElementById('MandatoryReading').checked == true)
        document.getElementById('div_InternalFunctions').style.display = 'inline';
</script>
