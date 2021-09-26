<?php /* Smarty version 2.6.18, created on 2020-10-06 05:30:24
         compiled from dictionary_domains.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_domains.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Domenii'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                        <div style="padding: 10px; margin-bottom: 15px;">
                            <b><?php echo smarty_function_translate(array('label' => 'Adauga domeniu nou'), $this);?>
:</b><br><br>
                            <div class="autosuggest">
                                <input autocomplete="off" type="text" id="Domain" name="Domain" value="" class="yui-ac-input" maxlength="255" style="width:600px;">
                                <div id="button_add" style="float: right; margin-top: 4px;"><a href="#"
                                                                                               onclick="window.location.href = './?m=dictionary&o=domains&JobDomainID=0&Caen=' + getCaen(); return false;"
                                                                                               title="<?php echo smarty_function_translate(array('label' => 'Adauga domeniu'), $this);?>
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
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume domeniu'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['domains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><?php echo $this->_tpl_vars['item']['Domain']; ?>
</td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=domains&JobDomainID=<?php echo $this->_tpl_vars['key']; ?>
&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica status domeniu'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=domains&JobDomainID=<?php echo $this->_tpl_vars['key']; ?>
&delDomain=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge domeniu'), $this);?>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de domenii care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>

<?php echo '
    <script type="text/javascript">
        function getCaen() {
            if (document.getElementById(\'Domain\').value > \'\') {
                var elem = document.getElementById(\'Domain\').value.split(\' | \');
                return elem[1];
            } else {
                return \'\';
            }
        }

        $(document).ready(function () {
            $.fn.autosugguest({
                className: \'autosuggest\',
                methodType: \'POST\',
                minChars: 2,
                rtnIDs: true,
                dataFile: \'ajax.php?o=domain&rand=\' + parseInt(Math.random() * 999999999)
            });
        });
    </script>
'; ?>