<?php /* Smarty version 2.6.18, created on 2020-10-13 12:16:51
         compiled from admin_settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_settings.tpl', 5, false),array('modifier', 'default', 'admin_settings.tpl', 27, false),array('modifier', 'replace', 'admin_settings.tpl', 128, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data">
    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Setari pe companie'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Setari'), $this);?>
</legend>
                    <br>
                    <select name="company_id" onchange="if (this.value > 0) window.location.href = './?m=admin&o=settings&company_id=' + this.value;">
                        <option value="0"><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['company_id'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <?php if (! empty ( $_GET['company_id'] )): ?>
                        <br>
                        <br>
                        <fieldset>
                            <legend><?php echo smarty_function_translate(array('label' => 'Pontaj'), $this);?>
</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Procent plata suplimentara zi normala'), $this);?>
:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_normal]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['company_settings']['pontaj']['proc_normal'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Procent plata suplimentara zi de weekend'), $this);?>
:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_weekend]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['company_settings']['pontaj']['proc_weekend'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Procent plata suplimentara zi de sarbatoare legala'), $this);?>
:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_legal]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['company_settings']['pontaj']['proc_legal'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Procent plata suplimentara ore de noapte'), $this);?>
:</td>
                                    <td><input type="text" name="company_settings[pontaj][proc_night]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['company_settings']['pontaj']['proc_night'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="3"
                                               maxlength="3"> %
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend><?php echo smarty_function_translate(array('label' => 'Concedii'), $this);?>
</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Managerul direct isi poate aproba propriul concediu'), $this);?>
:</td>
                                    <td><input type="checkbox" value="1"
                                               name="company_settings[vacation][manager_self_approve]" <?php if ($this->_tpl_vars['company_settings']['vacation']['manager_self_approve'] == 1): ?> checked="checked" <?php endif; ?>>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Grila vechime tine cont de'), $this);?>
:<br>
                                        <?php echo smarty_function_translate(array('label' => '(necesita rularea Recalculare concedii)'), $this);?>

                                    </td>
                                    <td>
                                        <input type="radio" name="company_settings[vacation][accepted_seniority]" value="1"
                                               id="company_settings[vacation][accepted_seniority]_1" <?php if ($this->_tpl_vars['company_settings']['vacation']['accepted_seniority'] != 2): ?> checked="checked"<?php endif; ?>><label
                                                for="company_settings[vacation][accepted_seniority]_1">Vechime in companie</label>
                                        <br>
                                        <input type="radio" name="company_settings[vacation][accepted_seniority]" value="2"
                                               id="company_settings[vacation][accepted_seniority]_2" <?php if ($this->_tpl_vars['company_settings']['vacation']['accepted_seniority'] == 2): ?> checked="checked"<?php endif; ?>><label
                                                for="company_settings[vacation][accepted_seniority]_2">Vechime anterioara + vechime in companie</label>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <br>
                        <br>
                        <fieldset>
                            <legend><?php echo smarty_function_translate(array('label' => 'Catering'), $this);?>
</legend>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Numar zile anterioare pentru posibilite modificare meniu fata de duminica urmatoare'), $this);?>
:</td>
                                    <td>
                                        <select name="company_settings[catering][menu_days_before]">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Alege'), $this);?>
</option>
                                            <?php unset($this->_sections['tmp']);
$this->_sections['tmp']['name'] = 'tmp';
$this->_sections['tmp']['start'] = (int)0;
$this->_sections['tmp']['loop'] = is_array($_loop=31) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tmp']['show'] = true;
$this->_sections['tmp']['max'] = $this->_sections['tmp']['loop'];
$this->_sections['tmp']['step'] = 1;
if ($this->_sections['tmp']['start'] < 0)
    $this->_sections['tmp']['start'] = max($this->_sections['tmp']['step'] > 0 ? 0 : -1, $this->_sections['tmp']['loop'] + $this->_sections['tmp']['start']);
else
    $this->_sections['tmp']['start'] = min($this->_sections['tmp']['start'], $this->_sections['tmp']['step'] > 0 ? $this->_sections['tmp']['loop'] : $this->_sections['tmp']['loop']-1);
if ($this->_sections['tmp']['show']) {
    $this->_sections['tmp']['total'] = min(ceil(($this->_sections['tmp']['step'] > 0 ? $this->_sections['tmp']['loop'] - $this->_sections['tmp']['start'] : $this->_sections['tmp']['start']+1)/abs($this->_sections['tmp']['step'])), $this->_sections['tmp']['max']);
    if ($this->_sections['tmp']['total'] == 0)
        $this->_sections['tmp']['show'] = false;
} else
    $this->_sections['tmp']['total'] = 0;
if ($this->_sections['tmp']['show']):

            for ($this->_sections['tmp']['index'] = $this->_sections['tmp']['start'], $this->_sections['tmp']['iteration'] = 1;
                 $this->_sections['tmp']['iteration'] <= $this->_sections['tmp']['total'];
                 $this->_sections['tmp']['index'] += $this->_sections['tmp']['step'], $this->_sections['tmp']['iteration']++):
$this->_sections['tmp']['rownum'] = $this->_sections['tmp']['iteration'];
$this->_sections['tmp']['index_prev'] = $this->_sections['tmp']['index'] - $this->_sections['tmp']['step'];
$this->_sections['tmp']['index_next'] = $this->_sections['tmp']['index'] + $this->_sections['tmp']['step'];
$this->_sections['tmp']['first']      = ($this->_sections['tmp']['iteration'] == 1);
$this->_sections['tmp']['last']       = ($this->_sections['tmp']['iteration'] == $this->_sections['tmp']['total']);
?>
                                                <option value="<?php echo $this->_sections['tmp']['index']; ?>
" <?php if ($this->_tpl_vars['company_settings']['catering']['menu_days_before'] == $this->_sections['tmp']['index']): ?> selected="selected"<?php endif; ?>><?php echo $this->_sections['tmp']['index']; ?>
</option>
                                            <?php endfor; endif; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="40">
                                    <td><?php echo smarty_function_translate(array('label' => 'Ora pana la care se poate alege meniu zilnic in ultima zi disponibila (setata anterior)'), $this);?>
:</td>
                                    <td>
                                        <select name="company_settings[catering][menu_max_hour]">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Alege'), $this);?>
</option>
                                            <?php unset($this->_sections['tmp']);
$this->_sections['tmp']['name'] = 'tmp';
$this->_sections['tmp']['start'] = (int)0;
$this->_sections['tmp']['loop'] = is_array($_loop=24) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tmp']['show'] = true;
$this->_sections['tmp']['max'] = $this->_sections['tmp']['loop'];
$this->_sections['tmp']['step'] = 1;
if ($this->_sections['tmp']['start'] < 0)
    $this->_sections['tmp']['start'] = max($this->_sections['tmp']['step'] > 0 ? 0 : -1, $this->_sections['tmp']['loop'] + $this->_sections['tmp']['start']);
else
    $this->_sections['tmp']['start'] = min($this->_sections['tmp']['start'], $this->_sections['tmp']['step'] > 0 ? $this->_sections['tmp']['loop'] : $this->_sections['tmp']['loop']-1);
if ($this->_sections['tmp']['show']) {
    $this->_sections['tmp']['total'] = min(ceil(($this->_sections['tmp']['step'] > 0 ? $this->_sections['tmp']['loop'] - $this->_sections['tmp']['start'] : $this->_sections['tmp']['start']+1)/abs($this->_sections['tmp']['step'])), $this->_sections['tmp']['max']);
    if ($this->_sections['tmp']['total'] == 0)
        $this->_sections['tmp']['show'] = false;
} else
    $this->_sections['tmp']['total'] = 0;
if ($this->_sections['tmp']['show']):

            for ($this->_sections['tmp']['index'] = $this->_sections['tmp']['start'], $this->_sections['tmp']['iteration'] = 1;
                 $this->_sections['tmp']['iteration'] <= $this->_sections['tmp']['total'];
                 $this->_sections['tmp']['index'] += $this->_sections['tmp']['step'], $this->_sections['tmp']['iteration']++):
$this->_sections['tmp']['rownum'] = $this->_sections['tmp']['iteration'];
$this->_sections['tmp']['index_prev'] = $this->_sections['tmp']['index'] - $this->_sections['tmp']['step'];
$this->_sections['tmp']['index_next'] = $this->_sections['tmp']['index'] + $this->_sections['tmp']['step'];
$this->_sections['tmp']['first']      = ($this->_sections['tmp']['iteration'] == 1);
$this->_sections['tmp']['last']       = ($this->_sections['tmp']['iteration'] == $this->_sections['tmp']['total']);
?>
                                                <option value="<?php echo $this->_sections['tmp']['index']; ?>
" <?php if ($this->_tpl_vars['company_settings']['catering']['menu_max_hour'] == $this->_sections['tmp']['index']): ?> selected="selected"<?php endif; ?>><?php echo $this->_sections['tmp']['index']; ?>

                                                    :00
                                                </option>
                                            <?php endfor; endif; ?>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        <div align="center"><br><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
"></div>
                    <?php endif; ?>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px; width: 50%;">
                <br>
                <?php if (! empty ( $_GET['company_id'] )): ?>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Logo companie'), $this);?>
</legend>
                        <br>
                        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                            <p style="color: #FF0000;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</p>
                        <?php endif; ?>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Foto'), $this);?>
:&nbsp;</td>
                                <td><input type="file" name="photo"></td>
                                <td>
                                    <?php if (isset ( $this->_tpl_vars['company_settings']['photo'] )): ?>
                                        <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['company_settings']['photo'])) ? $this->_run_mod_handler('replace', true, $_tmp, '_170_40', '') : smarty_modifier_replace($_tmp, '_170_40', '')); ?>
" title="<?php echo smarty_function_translate(array('label' => 'mareste poza'), $this);?>
" target="_blank"><img
                                                    style="padding:2px; margin-left:10px; border:solid 1px #666;" src="<?php echo $this->_tpl_vars['company_settings']['photo']; ?>
"></a>
                                        <a href="#"
                                           onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta imagine?'), $this);?>
')) window.location.href='./?m=admin&o=settings&company_id=<?php echo $_GET['company_id']; ?>
&del_photo=1'; return false;"
                                           title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
 class=" blue
                                        "><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><?php echo smarty_function_translate(array('label' => 'setari pe companie'), $this);?>
</td>
        </tr>
    </table>
</form>