<?php /* Smarty version 2.6.18, created on 2020-10-07 12:19:18
         compiled from pontaj_phours.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_phours.tpl', 11, false),array('modifier', 'default', 'pontaj_phours.tpl', 38, false),array('modifier', 'date_format', 'pontaj_phours.tpl', 95, false),array('modifier', 'cat', 'pontaj_phours.tpl', 204, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pontaj_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (empty ( $_GET['export'] ) && empty ( $_GET['export_doc'] )): ?>
<?php echo '
    <style type="text/css">
        .grid td {
            font-size: 10px;
        }
    </style>
'; ?>

    <div class="filter">
        <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
:</label>
        <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=pontaj&o=pphours' +
	                                                                            	    '&DistrictID=' + document.getElementById('DistrictID').value + 
	                                                                                    '&CityID=' + document.getElementById('CityID').value + 
											    '&Status=' + document.getElementById('Status').value + 
											    '&CompanyID=' + document.getElementById('CompanyID').value + 
											    '&DivisionID=' + document.getElementById('DivisionID').value + 
											    '&DepartmentID=' + document.getElementById('DepartmentID').value + 
											    '&CostCenterID=' + document.getElementById('CostCenterID').value + 
											    '&search_for=' + document.getElementById('search_for').value + 
											    '&keyword=' + escape(document.getElementById('keyword').value) + 
											    '&StartDate=' + escape(document.getElementById('StartDate').value) + 
											    '&EndDate=' + escape(document.getElementById('EndDate').value)" class="cod">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <select id="CityID" name="CityID" class="cod" style="width:200px;">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <select id="Status" name="Status" class="cod" style="width:200px;">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == ((is_array($_tmp=@$_GET['Status'])) ? $this->_run_mod_handler('default', true, $_tmp, 2) : smarty_modifier_default($_tmp, 2))): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <select name="select" class="cod" id="search_for" nume="search_for">
            <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
            <option value="LastName" <?php if ($_GET['search_for'] == 'lastname'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</option>
            <option value="FirstName" <?php if ($_GET['search_for'] == 'firstname'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
</option>
            <option value="CNP" <?php if ($_GET['search_for'] == 'cnp'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
        </select>
        <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
               onkeypress="if(getKeyUnicode(event)==13) filterList();">
        <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_COMPANYSELF'] )): ?>
            <select id="CompanyID" name="CompanyID" class="dropdown">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie self'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" id="CompanyID" value="0">
        <?php endif; ?>
        <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
            <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=pontaj&o=pphours' +
	                                                                        	'&DistrictID=' + document.getElementById('DistrictID').value + 
	                                                                                '&CityID=' + document.getElementById('CityID').value + 
											'&Status=' + document.getElementById('Status').value + 
											'&CompanyID=' + document.getElementById('CompanyID').value + 
											'&DivisionID=' + document.getElementById('DivisionID').value + 
											'&DepartmentID=' + document.getElementById('DepartmentID').value + 
											'&CostCenterID=' + document.getElementById('CostCenterID').value + 
											'&search_for=' + document.getElementById('search_for').value + 
											'&keyword=' + escape(document.getElementById('keyword').value) + 
											'&StartDate=' + escape(document.getElementById('StartDate').value) + 
											'&EndDate=' + escape(document.getElementById('EndDate').value)" class="dropdown">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" name="DivisionID" id="DivisionID" value="0">
        <?php endif; ?>
        <select id="DepartmentID" name="DepartmentID" class="dropdown">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <select id="CostCenterID" name="CostCenterID" class="dropdown">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CostCenterID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <label><?php echo smarty_function_translate(array('label' => 'Perioada intre '), $this);?>
</label>
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['StartDate'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['def_start']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['def_start'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                  title="Data de inceput"><img src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
        <label>si</label>
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['EndDate'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['def_end']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['def_end'])))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                        src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
        <input type="button" class="cod" value="<?php echo smarty_function_translate(array('label' => 'Recalcul'), $this);?>
" onclick="window.location.reload();">
        <input type="button" class="cod" value="<?php echo smarty_function_translate(array('label' => 'Ore noapte'), $this);?>
" onclick="toggleNHours();">
        <input type="button" class="cod" value="<?php echo smarty_function_translate(array('label' => 'Finalizare planificare'), $this);?>
"
               onclick="if(confirm('Finalizarea planificarii nu va mai permite sa reveniti pe tipul de ore (adaugare/modificare/stergere). Sunteti sigur?')) window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=validate'; return false;">
        <input type="button" value="Cauta" class="cod" onclick="filterList();">
        <br/>

        <div class="outputZone outputZoneOne">
            <div>
                <ul>
                    <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                    <li>
                        <input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'">
                    </li>
                    <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'">
                        <!--</li><li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'">-->
                    </li>
                    <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza'), $this);?>
"
                               onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="layer_hp" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Activitate'), $this);?>
</h3>
        <div id="layer_hp_content" class="layerContent"></div>
    </div>
    <div id="layer_hp_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_hp').style.display = 'none'; document.getElementById('layer_hp_x').style.display = 'none';">x
    </div>
    <?php if (! empty ( $_GET['msg'] )): ?>

        <?php if ($_GET['msg'] == 1): ?>
            <div style="text-align: center; color: #0000FF;"><?php echo smarty_function_translate(array('label' => 'Planificarea a fost validata.'), $this);?>
</div>
        <?php elseif ($_GET['msg'] == 2): ?>
            <div style="text-align: center; color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'Planificarea nu a putut fi validata.<br />Va rugam verificati ca perioada selectata sa nu fi fost deja planificata.'), $this);?>
</div>
        <?php endif; ?>

    <?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $_GET['StartDate'] ) && ! empty ( $_GET['EndDate'] )): ?>
    <table width="100%" cellspacing="0" cellpadding="0" class="grid">
        <!--        <tr>
            <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</b></td>
            <td class="celulaMenuST" colspan="2">&nbsp;</td>
            <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['hour']):
        $this->_foreach['hfor']['iteration']++;
?>
                <?php if ($this->_foreach['hfor']['iteration']%2 != 0): ?>
                    <td colspan="2" class="celulaMenuST" <?php if ($this->_foreach['hfor']['iteration'] < 12 || $this->_foreach['hfor']['iteration'] > 43): ?>name="NHours"<?php endif; ?> style="<?php if ($this->_foreach['hfor']['iteration'] < 12 || $this->_foreach['hfor']['iteration'] > 43): ?>display:none;<?php endif; ?>border-left: 1px solid #a4a4a4;">&nbsp;</td>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;">&nbsp;</td>
            <td class="celulaMenuST">&nbsp;</td>
            <td class="celulaMenuSTDR">&nbsp;</td>
        </tr>-->
        <?php $_from = $this->_tpl_vars['dm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['dpmfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dpmfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['DptID'] => $this->_tpl_vars['department']):
        $this->_foreach['dpmfor']['iteration']++;
?>
            <tr>
            <!--<td rowspan="<?php echo $this->_tpl_vars['department']['RSpan']; ?>
" valign="top" style="border-bottom: 3px solid #a4a4a4;"><?php echo $this->_tpl_vars['departments'][$this->_tpl_vars['DptID']]; ?>
</td>-->
            <?php $_from = $this->_tpl_vars['department']['Dates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['dfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['dfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['dateval'] => $this->_tpl_vars['day']):
        $this->_foreach['dfor']['iteration']++;
?>

                <?php if ($this->_foreach['dfor']['iteration'] > 1): ?>
                    </tr><tr>
                <?php endif; ?>


                <?php $this->assign('yearval', ((is_array($_tmp=$this->_tpl_vars['dateval'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y'))); ?>
                <?php $this->assign('monthval', ((is_array($_tmp=$this->_tpl_vars['dateval'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m') : smarty_modifier_date_format($_tmp, '%m'))); ?>
                <?php $this->assign('weekval', ((is_array($_tmp=$this->_tpl_vars['dateval'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%W') : smarty_modifier_date_format($_tmp, '%W'))); ?>
                <?php $this->assign('weekval', $this->_tpl_vars['wtrans'][$this->_tpl_vars['dateval']]); ?>
                <?php $this->assign('dayofweek', ((is_array($_tmp=$this->_tpl_vars['dateval'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%w') : smarty_modifier_date_format($_tmp, '%w'))); ?>
                <td class="celulaMenuST" rowspan="<?php echo $this->_tpl_vars['department']['DayPersonCount'][$this->_tpl_vars['dateval']]; ?>
" valign="top" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">
                    <b><?php echo $this->_tpl_vars['departments'][$this->_tpl_vars['DptID']]; ?>
</b><br><br><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['days_labels'][$this->_tpl_vars['dayofweek']]), $this);?>
<br><?php echo ((is_array($_tmp=$this->_tpl_vars['dateval'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 (W<?php echo $this->_tpl_vars['weekval']; ?>
)<?php if (! empty ( $this->_tpl_vars['legal'][$this->_tpl_vars['dateval']] )): ?>
                <br>(<?php echo smarty_function_translate(array('label' => 'SL'), $this);?>
)<?php endif; ?></td>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Angajat'), $this);?>
</b></td>
                <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['hour']):
        $this->_foreach['hfor']['iteration']++;
?>
                    <?php if ($this->_foreach['hfor']['iteration']%2 != 0): ?>
                        <td colspan="2" class="celulaMenuST" <?php if ($this->_foreach['hfor']['iteration'] < 12 || $this->_foreach['hfor']['iteration'] > 43): ?>name="NHours"<?php endif; ?>
                            style="<?php if ($this->_foreach['hfor']['iteration'] < 12 || $this->_foreach['hfor']['iteration'] > 43): ?>display:none;<?php endif; ?>border-left: 1px solid #a4a4a4;"><b><?php echo $this->_tpl_vars['hour']; ?>
</b>
                        </td>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;"><b><?php echo smarty_function_translate(array('label' => 'T.<br />zi'), $this);?>
</b></td>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'R.<br />sapt'), $this);?>
</b></td>
                <td class="celulaMenuSTDR"><b><?php echo smarty_function_translate(array('label' => 'R.<br />luna'), $this);?>
</b></td>
                </tr>
                <tr>
                <?php $_from = $this->_tpl_vars['day']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['persfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['persfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['PersonID'] => $this->_tpl_vars['personhours']):
        $this->_foreach['persfor']['iteration']++;
?>
                    <?php $this->assign('RowID', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['DptID'])) ? $this->_run_mod_handler('cat', true, $_tmp, '-') : smarty_modifier_cat($_tmp, '-')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['dateval']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['dateval'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '-') : smarty_modifier_cat($_tmp, '-')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['PersonID']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['PersonID']))); ?>
                    <?php if ($this->_foreach['persfor']['iteration'] > 1): ?>
                        </tr><tr>
                    <?php endif; ?>
                    <td class="celulaMenuST" style="<?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 1px solid #a4a4a4;<?php endif; ?>"><?php echo $this->_tpl_vars['persons'][$this->_tpl_vars['DptID']][$this->_tpl_vars['PersonID']]['FullName']; ?>
</td>
                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hsfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hsfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['hour']):
        $this->_foreach['hsfor']['iteration']++;
?>
                        <?php $this->assign('hour_val', $this->_tpl_vars['personhours'][$this->_tpl_vars['hour']]); ?>
                        <td id="<?php echo $this->_tpl_vars['RowID']; ?>
-<?php echo $this->_tpl_vars['hour']; ?>
" class="celulaMenuST" <?php if ($this->_foreach['hsfor']['iteration'] < 13 || $this->_foreach['hsfor']['iteration'] > 44): ?>name="NHours"<?php endif; ?>
                            style="<?php if ($this->_foreach['hsfor']['iteration'] < 13 || $this->_foreach['hsfor']['iteration'] > 44): ?>display:none;<?php endif; ?><?php if ($this->_foreach['hsfor']['iteration']%2 != 0): ?>border-left: 1px solid #a4a4a4;<?php endif; ?><?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 1px solid #a4a4a4;<?php endif; ?>text-align: center;<?php echo $this->_tpl_vars['styles'][$this->_tpl_vars['hour_val']]; ?>
" <?php if (empty ( $this->_tpl_vars['restrict'][$this->_tpl_vars['hour_val']] )): ?>onclick="regClick('<?php echo $this->_tpl_vars['PersonID']; ?>
','<?php echo $this->_tpl_vars['dateval']; ?>
','<?php echo $this->_tpl_vars['hour']; ?>
', '<?php echo $this->_tpl_vars['RowID']; ?>
');"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['texts'][$this->_tpl_vars['hour_val']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <?php endforeach; endif; unset($_from); ?>
                    <td class="celulaMenuST"
                        style="<?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 1px solid #a4a4a4;<?php endif; ?> border-left:1px solid #a4a4a4;<?php if ($this->_tpl_vars['department']['Days'][$this->_tpl_vars['dateval']][$this->_tpl_vars['PersonID']] > 10): ?>background-color:#ff0000; color:#e8e8e8;<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Days'][$this->_tpl_vars['dateval']][$this->_tpl_vars['PersonID']])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
</td>
                    <td class="celulaMenuST"
                        style="<?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 1px solid #a4a4a4;<?php endif; ?> <?php if (( $this->_tpl_vars['department']['Weeks'][$this->_tpl_vars['yearval']][$this->_tpl_vars['weekval']][$this->_tpl_vars['PersonID']] < 0 && $this->_tpl_vars['department']['Weeks_ref'][$this->_tpl_vars['yearval']][$this->_tpl_vars['weekval']][$this->_tpl_vars['PersonID']] < 40 ) || ( $this->_tpl_vars['department']['Weeks'][$this->_tpl_vars['yearval']][$this->_tpl_vars['weekval']][$this->_tpl_vars['PersonID']] < -8 && $this->_tpl_vars['department']['Weeks_ref'][$this->_tpl_vars['yearval']][$this->_tpl_vars['weekval']][$this->_tpl_vars['PersonID']] >= 40 )): ?> background-color:#ff0000; color:#e8e8e8;<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Weeks'][$this->_tpl_vars['yearval']][$this->_tpl_vars['weekval']][$this->_tpl_vars['PersonID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuSTDR"
                        style="<?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 1px solid #a4a4a4;<?php endif; ?><?php if ($this->_tpl_vars['department']['Months'][$this->_tpl_vars['yearval']][$this->_tpl_vars['monthval']][$this->_tpl_vars['PersonID']] < 0): ?> background-color:#ff0000; color:#e8e8e8;<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Months'][$this->_tpl_vars['yearval']][$this->_tpl_vars['monthval']][$this->_tpl_vars['PersonID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <?php endforeach; endif; unset($_from); ?>
                </tr>
                <tr>
                    <td class="celulaMenuST" style="border-bottom: 3px solid #a4a4a4;"><b><?php echo smarty_function_translate(array('label' => 'Total angajati'), $this);?>
</b></td>
                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['hsfor'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['hsfor']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['hour']):
        $this->_foreach['hsfor']['iteration']++;
?>
                        <?php $this->assign('hour_val', $this->_tpl_vars['personhours'][$this->_tpl_vars['hour']]); ?>
                        <td class="celulaMenuST" <?php if ($this->_foreach['hsfor']['iteration'] < 13 || $this->_foreach['hsfor']['iteration'] > 44): ?>name="NHours"<?php endif; ?>
                            style="<?php if ($this->_foreach['hsfor']['iteration'] < 13 || $this->_foreach['hsfor']['iteration'] > 44): ?>display:none;<?php endif; ?><?php if ($this->_foreach['hsfor']['iteration']%2 != 0): ?>border-left: 1px solid #a4a4a4;<?php endif; ?><?php if (($this->_foreach['persfor']['iteration'] == $this->_foreach['persfor']['total'])): ?>border-bottom: 3px solid #a4a4a4;<?php endif; ?>text-align: center;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Totals'][$this->_tpl_vars['dateval']][$this->_tpl_vars['hour']])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
</td>
                    <?php endforeach; endif; unset($_from); ?>
                    <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Sums']['Days'][$this->_tpl_vars['dateval']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Sums']['Weeks'][$this->_tpl_vars['weekval']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuSTDR" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['department']['Sums']['Months'][$this->_tpl_vars['monthval']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
            </tr>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php echo '
    <script type="text/javascript">
        var click
        var styles;
        var texts;
        var selected_cell;

        function regClick(persid, data, hour, rowid) {
            if (selected_cell !== undefined && selected_cell !== null && selected_cell.length > 1) {
                var elem = document.getElementById(selected_cell[0]);
                elem.style.background = selected_cell[1];
            }

            selected_cell = new Array();

            selected_cell[0] = rowid + "-" + hour;
            var elem = document.getElementById(selected_cell[0]);
            selected_cell[1] = elem.style.background;
            elem.style.background = "#1BA5E0";

            if (!click || click[0] != persid || click[1] != data) {
                click = new Array();
                click[0] = persid;
                click[1] = data;
                click[2] = hour;
            } else {
                showInfo(\'./?m=pontaj&o=pphours_act&PersonID=\' + persid + \'&StartDate=\' + data + \'&StartHour=\' + click[2] + \'&EndHour=\' + hour + \'&RowID=\' + rowid, \'layer_hp_content\');
                document.getElementById(\'layer_hp\').style.display = \'block\';
                document.getElementById(\'layer_hp_x\').style.display = \'block\';
                click = null;
                selected_cell = null;
            }
        }

        function toggleNHours() {
            var cval = null;
            var elems = document.getElementsByName("NHours");
            for (i = 0; i < elems.length; i++) {
                if (elems[i].style.display == "none") {
                    elems[i].style.display = "table-cell";
                    cval = 1;
                } else {
                    elems[i].style.display = "none";
                    cval = 0;
                }
            }
            if (cval != null) {
                setCookie(\'nhours\', cval, 1);
            }
        }

        function winReload() {
            setTimeout(function () {
                window.location.reload();
            }, 100);
        }


        function updateRow(rowId, rowDate, startHour, endHour, type) {
            var dateParts = rowDate.split(\'-\');
            var shParts = startHour.split(\':\');
            var ehParts = endHour.split(\':\');

            var initDate = new Date(dateParts[0], dateParts[1], dateParts[2], shParts[0], shParts[1]);
            var endDate = new Date(dateParts[0], dateParts[1], dateParts[2], ehParts[0], ehParts[1]);

            if (initDate.getTime() > endDate.getTime()) {
                var tmp = initDate;
                initDate = endDate;
                endDate = tmp;
            }

            while (initDate.getTime() <= endDate.getTime()) {
                var elem = document.getElementById(rowId + \'-\' + pad(initDate.getHours(), 2) + \':\' + pad(initDate.getMinutes(), 2));

                if (type == \'delete-cell\') {
                    elem.innerHTML = \'&nbsp;\';
                    elem.style[\'background\'] = \'transparent\';
                    elem.style[\'color\'] = \'#000;\'
                } else {
                    elem.innerHTML = texts[type];
                    var styleParts = styles[type].split(\';\');
                    for (var i = 0; i < styleParts.length; i++) {
                        var styleInstr = styleParts[i].split(\':\');
                        if (styleInstr[0].length > 0) {
                            styleInstr[0] = styleInstr[0].replace(\'-color\', \'\');
                            elem.style[styleInstr[0]] = styleInstr[1];
                        }
                    }
                }

                initDate = new Date(initDate.getTime() + 1800 * 1000);
            }
        }

        function pad(number, length) {
            var str = \'\' + number;
            while (str.length < length) {
                str = \'0\' + str;
            }
            return str;
        }

        function validAct(id) {
            if (is_empty(document.getElementById(\'StartDate_\' + id).value)) {
                alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat data de inceput'), $this);?>
<?php echo '!\');
                return false;
            }
            if (is_empty(document.getElementById(\'StartHour_\' + id).value)) {
                alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat ora de inceput'), $this);?>
<?php echo '!\');
                return false;
            }
            if (is_empty(document.getElementById(\'EndDate_\' + id).value)) {
                alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat data de sfarsit'), $this);?>
<?php echo '!\');
                return false;
            }
            if (is_empty(document.getElementById(\'EndHour_\' + id).value)) {
                alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat ora de sfarsit'), $this);?>
<?php echo '!\');
                return false;
            }
            if (document.getElementById(\'Type_\' + id).value == 0) {
                alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat tipul de pontaj'), $this);?>
<?php echo '!\');
                return false;
            }
            return true;
        }

        function setCookie(c_name, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = c_name + "=" + c_value;
        }

        function getCookie(c_name) {
            var i, x, y, ARRcookies = document.cookie.split(";");
            for (i = 0; i < ARRcookies.length; i++) {
                x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                x = x.replace(/^\\s+|\\s+$/g, "");
                if (x == c_name) {
                    return unescape(y);
                }
            }
        }

        window.onload = function () {
            var nhc = getCookie(\'nhours\');
            if (nhc != null && nhc != "" && nhc != 0) {
                toggleNHours();
            }
            styles = new Array();
            texts = new Array();


            '; ?>

            <?php $_from = $this->_tpl_vars['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['style']):
?>
            <?php echo 'styles[\''; ?>
<?php echo $this->_tpl_vars['key']; ?>
<?php echo '\'] = '; ?>
'<?php echo $this->_tpl_vars['style']; ?>
';
            <?php endforeach; endif; unset($_from); ?>
            <?php $_from = $this->_tpl_vars['texts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['text']):
?>
            <?php echo 'texts[\''; ?>
<?php echo $this->_tpl_vars['key']; ?>
<?php echo '\'] = '; ?>
'<?php echo $this->_tpl_vars['text']; ?>
';
            <?php endforeach; endif; unset($_from); ?>
            <?php echo '



        }


    </script>
'; ?>

<?php endif; ?>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=pontaj&o=pphours' +
            '&DistrictID=' + document.getElementById('DistrictID').value +
            '&CityID=' + document.getElementById('CityID').value +
            '&Status=' + document.getElementById('Status').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&CostCenterID=' + document.getElementById('CostCenterID').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&StartDate=' + escape(document.getElementById('StartDate').value) +
            '&EndDate=' + escape(document.getElementById('EndDate').value)
        }
</script>