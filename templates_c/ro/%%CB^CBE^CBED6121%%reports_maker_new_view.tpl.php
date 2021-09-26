<?php /* Smarty version 2.6.18, created on 2020-10-06 16:49:29
         compiled from reports_maker_new_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'reports_maker_new_view.tpl', 26, false),array('function', 'translate', 'reports_maker_new_view.tpl', 60, false),array('function', 'math', 'reports_maker_new_view.tpl', 126, false),)), $this); ?>
<?php echo '
    <style>
        select {
            width: 95px;
            font-size: 11px;
        }

        #div_CityID select {
            width: 95px;
            font-size: 11px;
        }
    </style>
'; ?>

<br>
<form action="./?m=reports_maker&o=new" method="post">
    <table cellspacing="0" cellpadding="2" class="grid">
        <tr valign="bottom">
            <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
            <?php $_from = $_SESSION['REPORT_MAKER']['FIELDS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                    <td class="bkdTitleMenu" width="100" align="center">
                        <span class="TitleBox"><?php echo $this->_tpl_vars['fields'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]; ?>
</span>
                        <br>
                        <select name="operators[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]">
                            <option value="=">=</option>
                            <option value=">" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == '>'): ?>selected<?php endif; ?>>&gt;
                            </option>
                            <option value=">=" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == '>='): ?>selected<?php endif; ?>>
                                &gt;=
                            </option>
                            <option value="<" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == '<'): ?>selected<?php endif; ?>>&lt;
                            </option>
                            <option value="<=" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == '<='): ?>selected<?php endif; ?>>
                                &lt;=
                            </option>
                            <option value="<>" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == '<>'): ?>selected<?php endif; ?>>&lt;&gt;</option>
                            <option value="BETWEEN"
                                    <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == 'BETWEEN'): ?>selected<?php endif; ?>>BETWEEN
                            </option>
                            <option value="LIKE" <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == 'LIKE'): ?>selected<?php endif; ?>>
                                LIKE
                            </option>
                            <option value="NOT LIKE"
                                    <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == 'NOT LIKE'): ?>selected<?php endif; ?>>NOT LIKE
                            </option>
                            <option value="IS NULL"
                                    <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == 'IS NULL'): ?>selected<?php endif; ?>>IS NULL
                            </option>
                            <option value="IS NOT NULL"
                                    <?php if (((is_array($_tmp=@$_POST['operators'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == 'IS NOT NULL'): ?>selected<?php endif; ?>>IS NOT
                                NULL
                            </option>
                        </select>
                        <?php if (isset ( $this->_tpl_vars['fields_values'][$this->_tpl_vars['item2']] )): ?>
                            <p>
                                <?php if ($this->_tpl_vars['item2'] == 'persons__EducationalLevel'): ?>
                                <select name="values[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['fields_values'][$this->_tpl_vars['item2']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                        <optgroup label="<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key3']), $this);?>
">
                                            <?php $_from = $this->_tpl_vars['item3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key4'] => $this->_tpl_vars['item4']):
?>
                                                <?php if (is_array ( $this->_tpl_vars['item4'] )): ?>
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key4']), $this);?>
">
                                                        <?php $_from = $this->_tpl_vars['item4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key5'] => $this->_tpl_vars['item5']):
?>
                                                            <option value="<?php echo $this->_tpl_vars['key5']; ?>
"
                                                                    <?php if (((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == $this->_tpl_vars['key5']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item5']), $this);?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option value="<?php echo $this->_tpl_vars['key4']; ?>
"
                                                            <?php if (((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == $this->_tpl_vars['key4']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item4']), $this);?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </optgroup>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <?php elseif ($this->_tpl_vars['item2'] == 'address_district__County'): ?>
                                <select name="values[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]"
                                        onchange="if (this.value>0) showInfo('ajax_report.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID');">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['fields_values'][$this->_tpl_vars['item2']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key3']; ?>
"
                                                <?php if (((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == $this->_tpl_vars['key3']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item3']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <?php elseif ($this->_tpl_vars['item2'] == 'address_city__City'): ?>
                            <div id="div_CityID">
                                <select name="values[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['fields_values'][$this->_tpl_vars['item2']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key3']; ?>
"
                                                <?php if (((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == $this->_tpl_vars['key3']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item3']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </div>
                        <?php if (! empty ( $_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']] )): ?>
                            <script type="text/javascript">showInfo('ajax_report.php?o=city&districtID=<?php echo $_POST['values'][$this->_tpl_vars['key']]['address_district__County']; ?>
&CityID=<?php echo $_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]; ?>
&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                        <?php elseif (! empty ( $_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']] )): ?>
                            <script type="text/javascript">showInfo('ajax_report.php?o=city&districtID=<?php echo $_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']]['address_district__County']; ?>
&CityID=<?php echo $_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]; ?>
&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                        <?php endif; ?>
                        <?php else: ?>
                            <select name="values[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['fields_values'][$this->_tpl_vars['item2']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key3']; ?>
"
                                            <?php if (((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) == $this->_tpl_vars['key3']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item3']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        <?php endif; ?>
                            </p>
                            <p>&nbsp;</p>
                        <?php else: ?>
                            <p><input type="text" name="values[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]"
                                      value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_POST['values'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])))) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                      style="width: 95px; font-size: 11px;"></p>
                            <p><input type="text" name="values2[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['item2']; ?>
]"
                                      value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_POST['values2'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])) ? $this->_run_mod_handler('default', true, $_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES2'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']]) : smarty_modifier_default($_tmp, @$_SESSION['REPORT_MAKER']['FIELDS_VALUES2'][$this->_tpl_vars['key']][$this->_tpl_vars['item2']])))) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                      style="width: 95px; font-size: 11px;"></p>
                        <?php endif; ?>
                    </td>
                <?php endforeach; endif; unset($_from); ?>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php $_from = $this->_tpl_vars['results']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <tr>
                <td><?php echo smarty_function_math(array('equation' => "x+1",'x' => $this->_tpl_vars['key']), $this);?>
</td>
                <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                    <td><?php echo $this->_tpl_vars['item2']; ?>
</td>
                <?php endforeach; endif; unset($_from); ?>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
    <br>
    <div>
        <input type="submit" name="view" value="<?php echo smarty_function_translate(array('label' => 'Vezi raport'), $this);?>
">&nbsp;&nbsp;
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Refacere selectie'), $this);?>
" onclick="window.location.href = './?m=reports_maker&o=new&action=remake';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="report" value="<?php echo smarty_function_translate(array('label' => 'Nume raport'), $this);?>
" size="40">
        <input type="submit" name="save" value="<?php echo smarty_function_translate(array('label' => 'Salveaza raport'), $this);?>
">
    </div>
</form>