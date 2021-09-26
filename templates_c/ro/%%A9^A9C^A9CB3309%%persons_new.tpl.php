<?php /* Smarty version 2.6.18, created on 2021-09-13 03:46:55
         compiled from persons_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_new.tpl', 13, false),array('function', 'display_success', 'persons_new.tpl', 19, false),array('function', 'display_error', 'persons_new.tpl', 24, false),array('modifier', 'translate', 'persons_new.tpl', 19, false),array('modifier', 'default', 'persons_new.tpl', 166, false),array('modifier', 'date_format', 'persons_new.tpl', 230, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <?php if (! empty ( $_GET['PersonID'] )): ?>
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['info']['FullName']; ?>
</span></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adaugare persoana'), $this);?>
</span></td>
            </tr>
        <?php endif; ?>
        <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR"
                    style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_display_success(array('message' => ((is_array($_tmp='Datele persoanei au fost salvate!')) ? $this->_run_mod_handler('translate', true, $_tmp) : smarty_modifier_translate($_tmp))), $this);?>
</td>
            </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
            <tr>
                <td colspan="2" class="celulaMenuSTDR"><?php echo smarty_function_display_error(array('errors' => $this->_tpl_vars['err']->getErrors()), $this);?>
</td>
            </tr>
        <?php endif; ?>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="40%">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Status persoana'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="160"><b><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
:*</b></td>
                            <td>
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <input type="hidden" name="OldStatus" value="<?php echo $this->_tpl_vars['info']['Status']; ?>
"/>
                                            <select name="Status" onchange="setSubStatus(this.value);">
                                                <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['Status'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </td>
                                        <td style="padding-left: 10px;">
                                            <div id="div_role">
                                                <?php if (! empty ( $this->_tpl_vars['roles'] )): ?>
                                                    <select name="RoleID">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege role...'), $this);?>
</option>
                                                        <?php $_from = $this->_tpl_vars['roles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                            <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['ROLEALLOC'] )): ?>
                                                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['RoleID'] ) && $this->_tpl_vars['info']['RoleID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                            <?php endif; ?>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                            <?php if (empty ( $this->_tpl_vars['info']['Status'] ) || ( ! empty ( $this->_tpl_vars['info']['Status'] ) && in_array ( $this->_tpl_vars['info']['Status'] , array ( 2 , 7 , 9 , 10 ) ) )): ?>
                                                <script language="javascript">document.getElementById('div_role').style.display = 'none';</script>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php if (! empty ( $_GET['PersonID'] )): ?>
                            <tr>
                                <td colspan="2">
                                    <div id="calif">
                                        <b><?php echo smarty_function_translate(array('label' => 'Calificativ'), $this);?>
:</b>
                                        <select name="Qualify" style="margin-left: 98px">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['qualify']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['Qualify']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="institutie">
                                        <b><?php echo smarty_function_translate(array('label' => 'Institutie solicitanta'), $this);?>
:</b>
                                        <select name="InstitutieID" style="margin-left: 33px">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['institutii']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item']['CompanyID']; ?>
" <?php if ($this->_tpl_vars['item']['CompanyID'] == $this->_tpl_vars['info']['InstitutieID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $_GET['PersonID'] ) && $this->_tpl_vars['info']['Status'] == 1): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Status CV'), $this);?>
:</b></td>
                                <td>
                                    <select name="CVStatus">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['cvstatus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                    <?php if (( ! empty ( $this->_tpl_vars['info']['CVStatus'] ) && $this->_tpl_vars['info']['CVStatus'] != 0 && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['CVStatus'] ) || ( ! empty ( $this->_tpl_vars['info']['SubStatus'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['SubStatus'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?>
                                    </select>
                                    <?php echo '
                                        <script language="javascript">
                                            function setSubStatus(index) {
                                                if (index == 2 || index == 7 || index == 9 || index == 10) {
                                                    document.getElementById(\'div_role\').style.display = \'block\';
                                                } else {
                                                    document.getElementById(\'div_role\').style.display = \'none\';
                                                }
                                            }
                                        </script>
                                    '; ?>

                                    <script language="javascript">setSubStatus(1);</script>
                                    <input type="hidden" id="SubStatus" name="SubStatus" value="0">
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
:</b></td>
                                <td>
                                    <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <div id="Status_<?php echo $this->_tpl_vars['key']; ?>
" style="display: none;">
                                            <select onchange="if (this.value>0) document.getElementById('SubStatus').value = this.value;">
                                                <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                <?php $_from = $this->_tpl_vars['substatus'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"
                                                            <?php if ($this->_tpl_vars['info']['Status'] == $this->_tpl_vars['key'] && ! empty ( $this->_tpl_vars['info']['SubStatus'] ) && $this->_tpl_vars['key2'] == $this->_tpl_vars['info']['SubStatus']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </div>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php echo '
                                    <script language="javascript">
                                        function setSubStatus(index) {
                                            '; ?>

                                            <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').style.display = 'none';
                                            <?php endforeach; endif; unset($_from); ?>
                                            <?php echo '
                                            document.getElementById(\'Status_\' + index).style.display = \'block\';
                                            if (index == 7 || index == 9) {
                                                document.getElementById(\'calif\').style.display = \'none\';
                                                document.getElementById(\'div_role\').style.display = \'block\';
                                                document.getElementById(\'institutie\').style.display = \'none\';
                                            } else if (index == 2) {
                                                document.getElementById(\'calif\').style.display = \'none\';
                                                document.getElementById(\'div_role\').style.display = \'block\';
                                                document.getElementById(\'institutie\').style.display = \'none\';
                                            } else if (index == 10) {
                                                document.getElementById(\'calif\').style.display = \'block\';
                                                document.getElementById(\'institutie\').style.display = \'block\';
                                                document.getElementById(\'div_role\').style.display = \'none\';
                                            } else {
                                                document.getElementById(\'institutie\').style.display = \'none\';
                                                document.getElementById(\'calif\').style.display = \'none\';
                                                document.getElementById(\'div_role\').style.display = \'block\';
                                            }
                                        }
                                    </script>
                                    '; ?>

                                    <script language="javascript">setSubStatus(<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Status'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
);</script>
                                    <input type="hidden" id="SubStatus" name="SubStatus" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['SubStatus'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Persoana este pensionar'), $this);?>
:</b></td>
                            <td>
                                <input type="checkbox" <?php if ($this->_tpl_vars['info']['Pensionat'] == 1): ?>checked="checked"<?php endif; ?> id="Pensionat" name="Pensionat" value="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                <?php if (! empty ( $_GET['PersonID'] )): ?>
                                    <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Date identificare'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
:*</b></td>
                            <td><input type="text" name="LastName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['LastName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="127"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
:*</b></td>
                            <td><input type="text" name="FirstName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FirstName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="127"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sarbatoare'), $this);?>
:</b></td>
                            <td>
                                <select name="Sarbatoare">
                                    <option value="">- alege -</option>
                                    <?php $_from = $this->_tpl_vars['sarbatori']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                <?php if (( ! empty ( $this->_tpl_vars['info']['Sarbatoare'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Sarbatoare'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
:</b></td>
                            <td><input type="text" name="FullNameBeforeMariage" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FullNameBeforeMariage'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td width="160"><b><?php echo smarty_function_translate(array('label' => 'Nationalitate'), $this);?>
:</b></td>
                            <td>
                                <select name="Nationality">
                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                <?php if (( ! empty ( $this->_tpl_vars['info']['Nationality'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Nationality'] ) || ( empty ( $this->_tpl_vars['info']['Nationality'] ) && $this->_tpl_vars['key'] == 181 )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Nationality']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data nasterii'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="DateOfBirth" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['DateOfBirth'] ) && $this->_tpl_vars['info']['DateOfBirth'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['DateOfBirth'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.DateOfBirth,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                                   title="<?php echo smarty_function_translate(array('label' => 'selecteaza data'), $this);?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td width="90"><b><?php echo smarty_function_translate(array('label' => 'Tara nastere'), $this);?>
:</b></td>
                            <td>
                                <select name="BirthCountryID">
                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                <?php if (( ! empty ( $this->_tpl_vars['info']['BirthCountryID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['BirthCountryID'] ) || ( empty ( $this->_tpl_vars['info']['BirthCountryID'] ) && $this->_tpl_vars['key'] == 181 )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['CountryName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Judet nastere'), $this);?>
:</b></td>
                            <td>
                                <select id="BirthDistrictID" name="BirthDistrictID"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=birth_city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_BirthCityID');">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['BirthDistrictID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['BirthDistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Localitate nastere'), $this);?>
:</b></td>
                            <td>
                                <div id="div_BirthCityID">
                                    <select name="BirthCityID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['BirthCityID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['BirthCityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                                <script type="text/javascript">showInfo('ajax.php?o=birth_city&districtID=<?php echo $this->_tpl_vars['info']['BirthDistrictID']; ?>
&CityID=<?php echo $this->_tpl_vars['info']['BirthCityID']; ?>
&rand=' + parseInt(Math.random() * 999999999), 'div_BirthCityID');</script>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
:*</b></td>
                            <td><input type="text" name="CNP" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="13"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sex'), $this);?>
:</b></td>
                            <td>
                                <input type="radio" name="Sex" value="M" <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>checked<?php endif; ?>> M
                                <input type="radio" name="Sex" value="F" <?php if ($this->_tpl_vars['info']['Sex'] == 'F'): ?>checked<?php endif; ?>> F
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CI serie/ numar'), $this);?>
:</b></td>
                            <td><input type="text" name="BISerie" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BISerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="2" maxlength="2"> / <input type="text" name="BINumber"
                                                                                                                                      value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BINumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="8"
                                                                                                                                      maxlength="8"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CI - eliberat la data'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="BIStartDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['BIStartDate'] ) && $this->_tpl_vars['info']['BIStartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['BIStartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.BIStartDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CI - expira la data'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="BIStopDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['BIStopDate'] ) && $this->_tpl_vars['info']['BIStopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['BIStopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.BIStopDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CI - emis de'), $this);?>
:</b></td>
                            <td><input type="text" name="BIEmitent" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BIEmitent'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Adresa de domiciliu'), $this);?>
</b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="90"><b><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
:</b></td>
                            <td>
                                <select name="Country">
                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                <?php if (( ! empty ( $this->_tpl_vars['info']['Country'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Country'] ) || ( empty ( $this->_tpl_vars['info']['Country'] ) && $this->_tpl_vars['key'] == 181 )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['CountryName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
:*</b></td>
                            <td>
                                <select id="DistrictID" name="DistrictID"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID');">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['DistrictID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
:*</b></td>
                            <td>
                                <div id="div_CityID">
                                    <select name="CityID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['CityID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                                <?php if ($_GET['o'] == 'new' && ! empty ( $this->_tpl_vars['info']['CityID'] )): ?>
                                    <script type="text/javascript">showInfo('ajax.php?o=city&districtID=<?php echo $this->_tpl_vars['info']['DistrictID']; ?>
&CityID=<?php echo $this->_tpl_vars['info']['CityID']; ?>
&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Cod postal'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="StreetCode" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetCode'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="16"
                                       onblurx="showInfo('ajax.php?o=street&districtID=' + document.getElementById('DistrictID').value + '&city=' + escape(document.getElementById('CityName').value) + '&code=' + escape(this.value) + '&rand=' + parseInt(Math.random()*999999999), 'StreetNameID')">
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Strada'), $this);?>
:</b></td>
                            <td>
                                <div id="StreetNameID"><input type="text" name="StreetName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></div>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nr'), $this);?>
:</b></td>
                            <td><input type="text" name="StreetNumber" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetNumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="8" maxlength="8" style="width:40px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
:</b></td>
                            <td>
                                <b><?php echo smarty_function_translate(array('label' => 'Bl.'), $this);?>
</b><input type="text" name="Bl" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Bl'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8" style="width:30px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Sc.'), $this);?>
</b><input type="text" name="Sc" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Sc'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8" style="width:20px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Et.'), $this);?>
</b><input type="text" name="Et" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Et'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8" style="width:20px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Ap.'), $this);?>
</b><input type="text" name="Ap" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Ap'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8" style="width:25px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
:</b></td>
                            <td><input type="text" name="Phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon interior'), $this);?>
:</b></td>
                            <td><input type="text" name="PhoneInt" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneInt'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Mobil serviciu'), $this);?>
:</b></td>
                            <td><?php echo $this->_tpl_vars['info']['Mobile']; ?>


                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Mobil personal'), $this);?>
:</b></td>
                            <td><input type="text" name="MobilePersonal" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['MobilePersonal'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Alt numar de contact'), $this);?>
:</b></td>
                            <td><input type="text" name="MobileOther" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['MobileOther'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
                            <td><input type="text" name="Email" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="64" size="30"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Fax'), $this);?>
:</b></td>
                            <td><input type="text" name="Fax" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Fax'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Yahoo ID'), $this);?>
:</b></td>
                            <td><input type="text" name="Yahoo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Yahoo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Skype ID'), $this);?>
:</b></td>
                            <td><input type="text" name="Skype" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Skype'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <?php if (! empty ( $_GET['PersonID'] )): ?>
                    <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?>
                        <div align="center"><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"> <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                                onclick="window.location='./?m=persons'"
                                                                                                                                class="formstyle"></div><?php endif; ?>
                <?php else: ?>
                    <div align="center"><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Adauga persoana'), $this);?>
" class="formstyle"> <input type="button"
                                                                                                                                   value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                                   onclick="window.location='./?m=persons'"
                                                                                                                                   class="formstyle"></div>
                <?php endif; ?>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Stare civila'), $this);?>
:</b></td>
                            <td>
                                <select name="MaritalStatus">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['maritalstatus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['MaritalStatus'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['MaritalStatus']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select></td>
                        </tr>
                        <tr valign="top">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nr. copii'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="NumberOfChildren" id="NumberOfChildren" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['NumberOfChildren'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="2" maxlength="2"
                                       <?php if ($_GET['o'] == 'edit'): ?>onchange="if (this.value > 0) document.getElementById('div_NumberOfChildren').style.display = 'block'; else document.getElementById('div_NumberOfChildren').style.display = 'none';"<?php endif; ?>>
                                <?php if ($_GET['o'] == 'edit'): ?>
                                    <div id="div_NumberOfChildren">
                                        <br>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td><?php echo smarty_function_translate(array('label' => 'Nume copil'), $this);?>
</td>
                                                <td style="padding-left: 10px;" colspan="2"><?php echo smarty_function_translate(array('label' => 'Data nasterii'), $this);?>
</td>
                                                <td style="padding-left: 10px;"><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</td>
                                                <td style="padding-left: 10px;" colspan="3">&nbsp;</td>
                                            </tr>
                                            <?php $_from = $this->_tpl_vars['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['child']):
        $this->_foreach['child']['iteration']++;
?>
                                                <tr>
                                                    <td><input type="text" id="ChildName_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
" value="<?php echo $this->_tpl_vars['child']['ChildName']; ?>
" size="24" maxlength="32"></td>
                                                    <td style="padding-left: 10px;">
                                                        <input type="text" id="ChildBirthDate_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
" class="formstyle"
                                                               value="<?php echo ((is_array($_tmp=$this->_tpl_vars['child']['ChildBirthDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
">
                                                            var cal1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
 = new CalendarPopup();
                                                            cal1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
.isShowNavigationDropdowns = true;
                                                            cal1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
.setYearSelectStartOffset(10);
                                                            //writeSource("js1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
");
                                                        </SCRIPT>
                                                    </td>
                                                    <td>
                                                        <A HREF="#"
                                                           onClick="cal1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
.select(document.getElementById('ChildBirthDate_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
"><img src="./images/cal.png" border="0"></A></td>
                                                    <td style="padding-left: 10px;"><input type="text" id="ChildCNP_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
" value="<?php echo $this->_tpl_vars['child']['ChildCNP']; ?>
" size="13"
                                                                                           maxlength="13"></td>
                                                    <td style="padding-left: 10px;">
                                                        <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (document.getElementById('ChildName_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value && document.getElementById('ChildBirthDate_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value && checkDate(document.getElementById('ChildBirthDate_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value, 'Data nasterii copil') && (document.getElementById('ChildCNP_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value == '' || (document.getElementById('ChildCNP_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value && check_cnp(document.getElementById('ChildCNP_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value)))) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_child&ChildID=<?php echo $this->_tpl_vars['child']['ChildID']; ?>
&ChildName=' + escape(document.getElementById('ChildName_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value) + '&ChildBirthDate=' + document.getElementById('ChildBirthDate_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value + '&ChildCNP=' + escape(document.getElementById('ChildCNP_<?php echo $this->_tpl_vars['child']['ChildID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numele, Data nasterii si CNP-ul corect ale copilului!'), $this);?>
'); return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Editeaza copil'), $this);?>
"><b>Mod</b></a></div>
                                                        <?php else: ?>
                                                            &nbsp;
                                                        <?php endif; ?>                                </td>
                                                    <td style="padding-left: 2px;">
                                                        <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest copil?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_child&ChildID=<?php echo $this->_tpl_vars['child']['ChildID']; ?>
'; return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge copil'), $this);?>
"><b>Del</b></a></div>
                                                        <?php else: ?>
                                                            &nbsp;
                                                        <?php endif; ?>                                </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            <?php endforeach; endif; unset($_from); ?>
                                            <tr>
                                                <td><input type="text" id="ChildName_0" value="" size="24" maxlength="32"></td>
                                                <td style="padding-left: 10px;">
                                                    <input type="text" id="ChildBirthDate_0" class="formstyle" value="" size="10" maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                        var cal1_0 = new CalendarPopup();
                                                        cal1_0.isShowNavigationDropdowns = true;
                                                        cal1_0.setYearSelectStartOffset(10);
                                                        //writeSource("js1_0");
                                                    </SCRIPT>
                                                </td>
                                                <td>
                                                    <A HREF="#" onClick="cal1_0.select(document.getElementById('ChildBirthDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"
                                                       NAME="anchor1_0" ID="anchor1_0"><img src="./images/cal.png" border="0"></A></td>
                                                <td style="padding-left: 10px;"><input type="text" id="ChildCNP_0" value="" size="13" maxlength="13"></td>
                                                <td style="padding-left: 10px;" colspan="2">
                                                    <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                        <div id="button_add"><a href="#"
                                                                                onclick="if (<?php echo $this->_foreach['child']['total']; ?>
 < document.pers.NumberOfChildren.value) <?php echo '{'; ?>
 if (document.getElementById('ChildName_0').value && document.getElementById('ChildBirthDate_0').value && checkDate(document.getElementById('ChildBirthDate_0').value, 'Data nasterii copil') && (document.getElementById('ChildCNP_0').value == '' | (document.getElementById('ChildCNP_0').value && check_cnp(document.getElementById('ChildCNP_0').value)))) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_child&ChildName=' + escape(document.getElementById('ChildName_0').value) + '&ChildBirthDate=' + document.getElementById('ChildBirthDate_0').value + '&ChildCNP=' + escape(document.getElementById('ChildCNP_0').value) + '&NumberOfChildren=' + document.getElementById('NumberOfChildren').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numele, Data nasterii si CNP-ul corect ale copilului!'), $this);?>
'); <?php echo '}'; ?>
 else alert('<?php echo smarty_function_translate(array('label' => 'Nu mai puteti adauga copii!'), $this);?>
'); return false;"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga copil'), $this);?>
"><b>Add</b></a></div>
                                                    <?php else: ?>
                                                        &nbsp;
                                                    <?php endif; ?>                                </td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </div>
                                    <script language="javascript">if (document.pers.NumberOfChildren.value > 0) document.getElementById('div_NumberOfChildren').style.display = 'block'; else document.getElementById('div_NumberOfChildren').style.display = 'none';</script>
                                <?php endif; ?>                    </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Certificat casatorie'), $this);?>
:</b></td>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume Prenume sot / sotie'), $this);?>
</td>
                                        <td style="padding-left: 4px;"><?php echo smarty_function_translate(array('label' => 'CNP sot / sotie'), $this);?>
</td>
                                        <td style="padding-left: 4px;" colspan="2"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                        <td style="padding-left: 4px;"><?php echo smarty_function_translate(array('label' => 'Numar'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['cc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="CC_Nume_<?php echo $this->_tpl_vars['item']['CCID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Nume']; ?>
" size="24" maxlength="32"></td>
                                            <td style="padding-left: 4px;"><input type="text" id="CC_CNP_<?php echo $this->_tpl_vars['item']['CCID']; ?>
" value="<?php echo $this->_tpl_vars['item']['CNP']; ?>
" size="15" maxlength="13"></td>
                                            <td style="padding-left: 4px;">
                                                <input type="text" id="CC_Data_<?php echo $this->_tpl_vars['item']['CCID']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Data'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
">
                                                    var cal1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
 = new CalendarPopup();
                                                    cal1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
");
                                                </SCRIPT>
                                            </td>
                                            <td><A HREF="#"
                                                   onClick="cal1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
.select(document.getElementById('CC_Data_<?php echo $this->_tpl_vars['item']['CCID']; ?>
'),'anchor1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
" ID="anchor1_cc_<?php echo $this->_tpl_vars['item']['CCID']; ?>
"><img src="./images/cal.png" border="0"></A></td>
                                            <td style="padding-left: 4px;"><input type="text" id="CC_Nr_<?php echo $this->_tpl_vars['item']['CCID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Nr']; ?>
" size="6" maxlength="16"></td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td style="padding-left: 10px;" colspan="2">
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CC_Nume_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value && document.getElementById('CC_CNP_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value && checkDate(document.getElementById('CC_Data_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value, 'Data') && document.getElementById('CC_Nr_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_cc&CCID=<?php echo $this->_tpl_vars['item']['CCID']; ?>
&Nume=' + escape(document.getElementById('CC_Nume_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value) + '&CNP=' + document.getElementById('CC_CNP_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value + '&Data=' + document.getElementById('CC_Data_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value + '&Nr=' + document.getElementById('CC_Nr_<?php echo $this->_tpl_vars['item']['CCID']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Nume sot / sotie, CNP, Data, Numar!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta inregistrare?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_cc&CCID=<?php echo $this->_tpl_vars['item']['CCID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>                            </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td><input type="text" id="CC_Nume_0" size="24" maxlength="32"></td>
                                        <td style="padding-left: 4px;"><input type="text" id="CC_CNP_0" size="15" maxlength="13"></td>
                                        <td style="padding-left: 4px;">
                                            <input type="text" id="CC_Data_0" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cc_0">
                                                var cal1_cc_0 = new CalendarPopup();
                                                cal1_cc_0.isShowNavigationDropdowns = true;
                                                cal1_cc_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_cc_0");
                                            </SCRIPT>
                                        </td>
                                        <td><A HREF="#" onClick="cal1_cc_0.select(document.getElementById('CC_Data_0'),'anchor1_cc_0','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_cc_0" ID="anchor1_cc_0"><img src="./images/cal.png" border="0"></A></td>
                                        <td style="padding-left: 4px;"><input type="text" id="CC_Nr_0" size="6" maxlength="16"></td>
                                        <td style="padding-left: 10px;" colspan="2">
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CC_Nume_0').value && document.getElementById('CC_CNP_0').value && checkDate(document.getElementById('CC_Data_0').value, 'Data') && document.getElementById('CC_Nr_0').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_cc&Nume=' + escape(document.getElementById('CC_Nume_0').value) + '&CNP=' + document.getElementById('CC_CNP_0').value + '&Data=' + document.getElementById('CC_Data_0').value + '&Nr=' + document.getElementById('CC_Nr_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Nume sot / sotie, CNP, Data, Numar!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a></div>
                                            <?php else: ?>
                                                &nbsp;
                                            <?php endif; ?>                                </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Religie'), $this);?>
:</b></td>
                            <td>
                                <select name="Religion">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['religion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['Religion'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Religion']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
<br><?php echo smarty_function_translate(array('label' => 'stare civila'), $this);?>
:</b></td>
                            <td><textarea name="MaritalStatusNotes" rows="2" cols="62"><?php echo $this->_tpl_vars['info']['MaritalStatusNotes']; ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Alte observatii'), $this);?>
:</b></td>
                            <td><textarea name="Notes" rows="2" cols="62"><?php echo $this->_tpl_vars['info']['Notes']; ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Foto'), $this);?>
:</b></td>
                                        <td><input type="file" name="photo"></td>
                                        <td rowspan="4" align="center"><?php if (isset ( $this->_tpl_vars['info']['photo'] )): ?><a href="<?php echo $this->_tpl_vars['info']['photoBig']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'mareste poza'), $this);?>
" target="_blank">
                                                <img style="padding:2px; margin-left:10px; border:solid 1px #666;" src="<?php echo $this->_tpl_vars['info']['photo']; ?>
" width="100"></a>
                                                <br/>
                                                <a href="#"
                                                   onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta imagine?'), $this);?>
')) window.location.href='./?m=persons&o=del_photo&PersonID=<?php echo $_GET['PersonID']; ?>
'; return false;"
                                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
 class=" blue
                                                "><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a><?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson1'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson1']), $this);?>
:</b></td>
                                <td><input type="text" name="CustomPerson1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CustomPerson1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="255"></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson2'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson2']), $this);?>
:</b></td>
                                <td><input type="text" name="CustomPerson2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CustomPerson2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="255"></td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson3'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson3']), $this);?>
:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson3" name="CustomPerson3" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['CustomPerson3'] ) && $this->_tpl_vars['info']['CustomPerson3'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['CustomPerson3'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson3">
                                        var cal_CustomPerson3 = new CalendarPopup();
                                        cal_CustomPerson3.isShowNavigationDropdowns = true;
                                        cal_CustomPerson3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomPerson3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson3.select(document.getElementById('CustomPerson3'),'anchor_CustomPerson3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson3" ID="anchor_CustomPerson3"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson4'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson4']), $this);?>
:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson4" name="CustomPerson4" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['CustomPerson4'] ) && $this->_tpl_vars['info']['CustomPerson4'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['CustomPerson4'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson4">
                                        var cal_CustomPerson4 = new CalendarPopup();
                                        cal_CustomPerson4.isShowNavigationDropdowns = true;
                                        cal_CustomPerson4.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomPerson4");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson4.select(document.getElementById('CustomPerson4'),'anchor_CustomPerson4','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson4" ID="anchor_CustomPerson4"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson5'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson5']), $this);?>
:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson5" name="CustomPerson5" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['CustomPerson5'] ) && $this->_tpl_vars['info']['CustomPerson5'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['CustomPerson5'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson5">
                                        var cal_CustomPerson5 = new CalendarPopup();
                                        cal_CustomPerson5.isShowNavigationDropdowns = true;
                                        cal_CustomPerson5.setYearSelectStartOffset(10);
                                        writeSource("js_CustomPerson5");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson5.select(document.getElementById('CustomPerson5'),'anchor_CustomPerson5','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson5" ID="anchor_CustomPerson5"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson6'] )): ?>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson6']), $this);?>
:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson6" name="CustomPerson6" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['CustomPerson6'] ) && $this->_tpl_vars['info']['CustomPerson6'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['CustomPerson6'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson6">
                                        var cal_CustomPerson6 = new CalendarPopup();
                                        cal_CustomPerson6.isShowNavigationDropdowns = true;
                                        cal_CustomPerson6.setYearSelectStartOffset(10);
                                        writeSource("js_CustomPerson6");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson6.select(document.getElementById('CustomPerson6'),'anchor_CustomPerson6','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson6" ID="anchor_CustomPerson6"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Sursa CV [valabil pentru candidati]'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Sursa CV'), $this);?>
:</b></td>
                            <td>
                                <select name="CVSource" onchange="document.getElementById('CVSourceRecc').style.display = this.value == 'recomandare' ? '' : 'none';">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege sursa'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['cvsource']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['CVSource']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <select id="CVSourceRecc" name="CVSourceRecc">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege persoana care recomanda'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['CVSourceRecc'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <script type="text/javascript">
                                    <?php if ($this->_tpl_vars['info']['CVSource'] != 'recomandare'): ?>
                                    document.getElementById('CVSourceRecc').style.display = 'none';
                                    <?php endif; ?>
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Detalii'), $this);?>
:</b></td>
                            <td><textarea name="CVSourceDetails" rows="2" cols="62"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CVSourceDetails'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="120"><b>CV:</b></td>
                                        <td><input type="file" name="cvfile"></td>
                                        <td rowspan="4" align="center">
                                            <?php if (isset ( $this->_tpl_vars['info']['CVFileName'] )): ?>
                                                <a href="<?php echo $this->_tpl_vars['info']['CVFileName']; ?>
" title="<?php echo $this->_tpl_vars['info']['CVFileName']; ?>
" target="_blank">
                                                    &nbsp;&nbsp;&nbsp;<img src="images/document_view.png" width="32" height="32" alt="Vizualizeaza document" /> Vizualizare CV
                                                </a>
                                                <br />
                                                <a href="#" onclick="if (confirm('Sunteti sigur ca doriti stergerea documentului?')) window.location.href='./?m=persons&o=del_person_cv&PersonID=<?php echo $_GET['PersonID']; ?>
'; return false;"
                                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
 class=" blue">
                                                    <img src="images/document_delete.png" width="32" height="32" alt="Sterge document" /> Stergere CV
                                                </a>
                                            <?php endif; ?>
                                       </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Parinti'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Nume/ Prenume tata'), $this);?>
:</b></td>
                            <td><input type="text" name="FatherLastName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FatherLastName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"> / <input type="text"
                                                                                                                                                      name="FatherFirstName"
                                                                                                                                                      value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FatherFirstName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                                                                                                                      size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nume/ Prenume mama'), $this);?>
:</b></td>
                            <td><input type="text" name="MotherLastName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['MotherLastName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"> / <input type="text"
                                                                                                                                                      name="MotherFirstName"
                                                                                                                                                      value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['MotherFirstName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                                                                                                                      size="30" maxlength="32"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Persoana de contact'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Nume si prenume'), $this);?>
:</b></td>
                            <td><input type="text" name="CPFullName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CPFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Adresa este aceeasi cu a salariatului'), $this);?>
:</b></td>
                            <td><input type="checkbox" name="CPSameAddress" <?php if (( $this->_tpl_vars['info']['CPSameAddress'] == 1 )): ?>checked="checked"<?php endif; ?> value="yes"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sau completeaza alta adresa'), $this);?>
:</b></td>
                            <td><textarea name="CPAddress" rows="2" cols="62"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CPAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</b></td>
                            <td><input type="text" name="CPPhone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CPPhone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Mobil'), $this);?>
:</b></td>
                            <td><input type="text" name="CPMobile" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CPMobile'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
                            <td><input type="text" name="CPEmail" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CPEmail'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
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

<?php echo '
<script type="text/javascript">
    function validateForm(f) {
        return (is_empty(f.DateOfBirth.value) ? true : checkDate(f.DateOfBirth.value, \'Data nasterii\')) &&
            (is_empty(f.BIStartDate.value) ? true : checkDate(f.BIStartDate.value, \'BI - eliberat la data\')) &&
            (is_empty(f.BIStopDate.value) ? true : checkDate(f.BIStopDate.value, \'BI - expira la data\'))
                '; ?>
<?php if (! empty ( $this->_tpl_vars['customfields']['CustomPerson3'] )): ?> && (is_empty(f.CustomPerson3.value) ? true : checkDate(f.CustomPerson3.value, '<?php echo $this->_tpl_vars['customfields']['CustomPerson3']; ?>
'))<?php endif; ?><?php echo '
            ;
    }
</script>
'; ?>
