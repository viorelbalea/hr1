<?php /* Smarty version 2.6.18, created on 2020-09-21 08:52:58
         compiled from dictionary_functions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_functions.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Coduri COR'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                        <div style="padding: 10px; margin-bottom: 15px;">
                            <b><?php echo smarty_function_translate(array('label' => 'Adauga functie noua'), $this);?>
:</b><br><br>
                            <div class="autosuggest">
                                <input autocomplete="off" type="text" id="Function" name="Function" value="" maxlength="255" style="width:600px;">
                                <div id="button_add" style="float: right; margin-top: 4px;"><a href="#"
                                                                                               onclick="window.location.href = './?m=dictionary&o=function&FunctionID=0&Cor=' + getCor(); return false;"
                                                                                               title="<?php echo smarty_function_translate(array('label' => 'Adauga functie'), $this);?>
"><b>Add</b></a></div>
                                <input type="hidden" name="nomID" id="nomID" autocomplete="off" disabled="disabled"/>
                            </div>

                        </div>
                    <?php endif; ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                                    <font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><b>#</b></td>
                                        <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</b></td>
                                        <td><b><?php echo smarty_function_translate(array('label' => 'COR'), $this);?>
</b></td>
                                        <td><b><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</b></td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                                        <tr>
                                            <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['item']['Function']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['item']['COR']; ?>
</td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <td align="center"><input type="text" id="FunctionObs_<?php echo $this->_tpl_vars['key']; ?>
" name="FunctionObs_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['FunctionObs']; ?>
" size="40"
                                                                      maxlength="128" class="cod"/></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Function_<?php echo $this->_tpl_vars['key']; ?>
').value) || document.getElementById('GroupID_<?php echo $this->_tpl_vars['key']; ?>
').selectedIndex == 0) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume functie sau Grupa de functii!'), $this);?>
'); else window.location.href = './?m=dictionary&o=function_group&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&Function=' + escape(document.getElementById('Function_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&FunctionObs=' + escape(document.getElementById('FunctionObs_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Statusf_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0) + '&GroupID=' + document.getElementById('GroupID_<?php echo $this->_tpl_vars['key']; ?>
').value; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica functie'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=function&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&delFunction=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge functie'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista functiilor care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>

<?php echo '
    <script type="text/javascript">
        $(document).ready(function () {
            $.fn.autosugguest({
                className: \'autosuggest\',
                methodType: \'POST\',
                minChars: 2,
                rtnIDs: true,
                dataFile: \'ajax.php?o=function&rand=\' + parseInt(Math.random() * 999999999)
            });
        });

        function getCor() {
            if (document.getElementById(\'Function\').value > \'\') {
                var elem = document.getElementById(\'Function\').value.split(\' | \');
                return elem[1];
            } else {
                return \'\';
            }
        }

    </script>
'; ?>
