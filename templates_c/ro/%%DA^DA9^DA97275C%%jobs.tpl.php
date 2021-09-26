<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:04
         compiled from jobs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'jobs.tpl', 3, false),array('function', 'orderby', 'jobs.tpl', 75, false),array('function', 'math', 'jobs.tpl', 96, false),array('modifier', 'default', 'jobs.tpl', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "job_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
</label>

    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=jobs&DistrictID=' + this.value"
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
    <select id="CityID" name="CityID" class="cod">
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
    <select id="Status" name="Status" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
        <option value="activ" <?php if ($_GET['Status'] == 'activ'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</option>
        <option value="inactiv"
                <?php if ($_GET['Status'] == 'inactiv'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Inactiv'), $this);?>
</option>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="JobTitle"
                <?php if ($_GET['search_for'] == 'JobTitle'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'JobTitle'), $this);?>
</option>
        <option value="CompanyName"
                <?php if ($_GET['search_for'] == 'CompanyName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20"
           maxlength="30" class="cod" onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
"
                    <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select><label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">


    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .doc"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
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
                <li>
                    <input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Job&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>

</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Denumire concurs','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'JobTitle','asc_or_desc' => 'asc'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Companie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CompanyName'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Job']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Judet','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DistrictName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Localitate','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CityName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Numar candidati','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'no_persons'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data de inceput','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'start_date'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data de sfarsit','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'stop_date'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'status'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['jobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['jobs']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST">
                    <a href="./?m=jobs&o=edit&JobID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['JobTitle']; ?>
</a>
                </td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Job']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'JobDomainID'): ?>
                                <?php echo $this->_tpl_vars['jobdomains'][$this->_tpl_vars['item']['JobDomainID']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'RequiredExperience'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['experiences'][$this->_tpl_vars['item']['RequiredExperience']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'JobType'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtypes'][$this->_tpl_vars['item']['JobType']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'JobDictionaryID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtitles'][$this->_tpl_vars['item']['JobDictionaryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FunctionIDRecr'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions_recr'][$this->_tpl_vars['item']['FunctionIDRecr']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FunctionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
 - <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['no_persons']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['start_date']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['stop_date'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['item']['status']; ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <a href="#"
                       onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest job?'), $this);?>
')) window.location.href='./?m=jobs&o=del&JobID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['jobs'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu"><?php echo $this->_tpl_vars['pagination']; ?>
</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=jobs&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&Status=' + document.getElementById('Status').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>