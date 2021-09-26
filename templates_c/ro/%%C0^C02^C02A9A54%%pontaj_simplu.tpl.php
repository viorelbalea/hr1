<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:13
         compiled from pontaj_simplu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_simplu.tpl', 3, false),array('function', 'orderby', 'pontaj_simplu.tpl', 95, false),array('function', 'math', 'pontaj_simplu.tpl', 108, false),array('modifier', 'cat', 'pontaj_simplu.tpl', 23, false),array('modifier', 'default', 'pontaj_simplu.tpl', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pontaj_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
:</label>
    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=pontaj&o=psimple&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
            class="cod">
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
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php $_from = $this->_tpl_vars['substatus'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['key2']; ?>
" <?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key2']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key2'])) == $_GET['Status']): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
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
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>
    <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
        <select id="DivisionID" name="DivisionID"
                onchange="window.location.href = './?m=pontaj&o=psimple&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value" class="dropdown">
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
        <input type="hidden" name="DivisionID" value="0">
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
    <select id="Sex" name="Sex" class="cod">
        <option value="">Sex</option>
        <option value="M" <?php if ($_GET['Sex'] == 'M'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Masculin'), $this);?>
</option>
        <option value="F" <?php if ($_GET['Sex'] == 'F'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Feminin'), $this);?>
</option>
    </select>
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select><label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
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
                <li>
                    <input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Persoane','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FullName','asc_or_desc' => 'asc'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Pontaj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Email','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Email'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Telefon','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Phone'), $this);?>
</td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST" width="30"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['persons']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=pontaj&o=psimple_day&PersonID=<?php echo $this->_tpl_vars['item']['PersonID']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Pontaj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'DivisionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['divisions'][$this->_tpl_vars['item']['DivisionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['costcenter'][$this->_tpl_vars['item']['CostCenterID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'JobDictionaryID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtitles'][$this->_tpl_vars['item']['JobDictionaryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FunctionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
 - <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['persons'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nici o persoana!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu"><?php echo $this->_tpl_vars['pagination']; ?>
</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=pontaj&o=psimple&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&Status=' + document.getElementById('Status').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&CostCenterID=' + document.getElementById('CostCenterID').value + '&Sex=' + document.getElementById('Sex').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>