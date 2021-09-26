<?php /* Smarty version 2.6.18, created on 2020-09-24 09:14:21
         compiled from pontaj_detaliat.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_detaliat.tpl', 3, false),array('modifier', 'default', 'pontaj_detaliat.tpl', 31, false),array('modifier', 'date_format', 'pontaj_detaliat.tpl', 94, false),array('modifier', 'count', 'pontaj_detaliat.tpl', 213, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pontaj_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
:</label>
    <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=pontaj&o=pdetail' +
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
											    '&EndDate=' + escape(document.getElementById('EndDate').value) + 
											    '&res_per_page=' + document.getElementById('res_per_page').value" class="cod">
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
        <option value="2_6_5" <?php if ('2_6_5' == ((is_array($_tmp=@$_GET['Status'])) ? $this->_run_mod_handler('default', true, $_tmp, 2) : smarty_modifier_default($_tmp, 2))): ?>selected<?php endif; ?>>Angajat + Plecat + Disp.</option>
    </select>
    <span>
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
          </span>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>
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
        <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=pontaj&o=pdetail' +
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
											'&EndDate=' + escape(document.getElementById('EndDate').value) + 
											'&res_per_page=' + document.getElementById('res_per_page').value" class="dropdown">
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
    <input type="text" name="StartDate" id="StartDate" class="formstyle"
           value="<?php if (! empty ( $_GET['StartDate'] )): ?><?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '01-%m-%Y') : smarty_modifier_date_format($_tmp, '01-%m-%Y')); ?>
<?php endif; ?>" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
    <label>si</label>
    <input type="text" name="EndDate" id="EndDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['EndDate'])) ? $this->_run_mod_handler('default', true, $_tmp, time()) : smarty_modifier_default($_tmp, time())))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal2 = new CalendarPopup();
        cal2.isShowNavigationDropdowns = true;
        cal2.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
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
                </li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>

<?php if (! empty ( $_GET['StartDate'] ) && ! empty ( $_GET['EndDate'] )): ?>
    <div id="layer_p" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Activitate'), $this);?>
</h3>
        <div id="layer_p_content" class="layerContent"></div>
    </div>
    <div id="layer_p_x" class="butonX" style="display: none" title="Inchide"
         onclick="document.getElementById('layer_p').style.display = 'none'; document.getElementById('layer_p_x').style.display = 'none'; window.location.reload();">x
    </div>
    <div id="layer_s" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Raport perioada'), $this);?>
</h3>
        <div id="layer_s_content" class="layerContent"></div>
    </div>
    <div id="layer_s_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_s').style.display = 'none'; document.getElementById('layer_s_x').style.display = 'none'; window.location.reload();">x
    </div>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
        <table width="100%" cellspacing="0" cellpadding="4" class="grid">
            <tr valign="bottom">
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuST">&nbsp;</td>
                <?php $this->assign('ZL', '0'); ?>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
        $this->_foreach['iter']['iteration']++;
?>
                    <td class="celulaMenuST"
                        style="text-align: center;<?php if (isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>background-color:#99CCFF;<?php elseif ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S'): ?> background-color: #fcde63;<?php endif; ?>">
                        <b><?php echo ((is_array($_tmp=$this->_tpl_vars['data'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%e') : smarty_modifier_date_format($_tmp, '%e')); ?>
</b></td>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['11']['4']['1'] == 2): ?>
                    <td class="celulaMenuSTDR" style="text-align:center"><input type="submit" name="valid" value="<?php echo smarty_function_translate(array('label' => 'Validare'), $this);?>
"></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="celulaMenuST" width="20"><b>#</b></td>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Nume prenume'), $this);?>
</b></td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td class="celulaMenuST"
                        style="text-align: center;<?php if (isset ( $this->_tpl_vars['pdisplacements'][$this->_tpl_vars['persid']][$this->_tpl_vars['data']] )): ?>background-color:#68DE95<?php elseif (isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>background-color:#99CCFF;<?php elseif ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S'): ?> background-color: #fcde63;<?php endif; ?>">
                        <b><?php echo $this->_tpl_vars['wday']; ?>
</b></td>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['11']['4']['1'] == 2): ?>
                    <td class="celulaMenuSTDR" style="text-align:center"><a href="#" onclick="checkAll(); return false;">check</a> | <a href="#"
                                                                                                                                        onclick="uncheckAll(); return false;">uncheck</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['persid'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <?php if ($this->_tpl_vars['persid'] > 0): ?>
            <tr bgcolor="#ffffff">
                <td class="celulaMenuST" stylex="border-top: 1px solid #000000;"><?php echo $this->_foreach['iter']['iteration']-1; ?>
</td>
                <td class="celulaMenuST"><a href="#" onclick="getStat(<?php echo $this->_tpl_vars['persid']; ?>
, '<?php echo $_GET['StartDate']; ?>
', '<?php echo $_GET['EndDate']; ?>
'); return false;"
                                            title="<?php echo smarty_function_translate(array('label' => 'raport pontaj'), $this);?>
"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</a></td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td class="celulaMenuST"
                        style="text-align: center;<?php if (isset ( $this->_tpl_vars['pdisplacements'][$this->_tpl_vars['persid']][$this->_tpl_vars['data']] )): ?>background-color:#68DE95<?php elseif (isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>background-color:#99CCFF;<?php elseif ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S'): ?> background-color: #fcde63;<?php endif; ?>">
                        <?php if ($this->_tpl_vars['data'] <= ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d') : smarty_modifier_date_format($_tmp, '%Y-%m-%d'))): ?>
                            <a href="#" onclick="getAct(<?php echo $this->_tpl_vars['persid']; ?>
, '<?php echo $this->_tpl_vars['data']; ?>
'); return false;"
                               title="<?php echo smarty_function_translate(array('label' => 'pontaj pentru'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['data'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</a>
                        <?php else: ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['11']['4']['1'] == 2): ?>
                    <td class="celulaMenuSTDR" style="text-align:center"><input type="checkbox" id="pvalid_<?php echo $this->_tpl_vars['persid']; ?>
" name="pvalid[<?php echo $this->_tpl_vars['persid']; ?>
]" value="<?php echo $this->_tpl_vars['item']['CompanyID']; ?>
"></td>
                <?php endif; ?>
            <tr>
                <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
                <?php if (count($this->_tpl_vars['persons']) <= 1): ?>
            <tr>
                <td class="celulaMenuSTDR" colspan="100"><?php echo smarty_function_translate(array('label' => 'Niciun rezultat!'), $this);?>
</td>
            </tr>
            <?php endif; ?>
        </table>
    </form>
<?php echo '
    <script type="text/javascript">
        function getAct(persid, data) {
            showInfo(\'./?m=pontaj&o=pdetail_act&PersonID=\' + persid + \'&StartDate=\' + data, \'layer_p_content\');
            document.getElementById(\'layer_p\').style.display = \'block\';
            document.getElementById(\'layer_p_x\').style.display = \'block\';
        }

        function getStat(persid, start_date, end_date) {
            showInfo(\'./?m=pontaj&o=pdetail_stat&PersonID=\' + persid + \'&StartDate=\' + start_date + \'&EndDate=\' + end_date, \'layer_s_content\');
            document.getElementById(\'layer_s\').style.display = \'block\';
            document.getElementById(\'layer_s_x\').style.display = \'block\';
        }

        function checkAll() {
            '; ?>

            <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['persid'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <?php if ($this->_tpl_vars['persid'] > 0): ?>
            document.getElementById('pvalid_<?php echo $this->_tpl_vars['persid']; ?>
').checked = true;
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            <?php echo '
        }

        function uncheckAll() {
            '; ?>

            <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['persid'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <?php if ($this->_tpl_vars['persid'] > 0): ?>
            document.getElementById('pvalid_<?php echo $this->_tpl_vars['persid']; ?>
').checked = false;
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            <?php echo '
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
    </script>
'; ?>


<?php endif; ?>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=pontaj&o=pdetail' +
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
            '&EndDate=' + escape(document.getElementById('EndDate').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value;
        }
</script>