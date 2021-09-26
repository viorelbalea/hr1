<?php /* Smarty version 2.6.18, created on 2020-09-24 09:13:47
         compiled from training.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'training.tpl', 3, false),array('function', 'orderby', 'training.tpl', 66, false),array('function', 'math', 'training.tpl', 89, false),array('modifier', 'default', 'training.tpl', 28, false),array('modifier', 'date_format', 'training.tpl', 108, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "training_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
:</label>
    <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=training&DistrictID=' + this.value" class="cod">
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
    <select id="CompanyDomainID" name="CompanyDomainID" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Domeniu'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['companydomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyDomainID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="TrainingName" <?php if ($_GET['search_for'] == 'TrainingName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Denumire Training'), $this);?>
</option>
        <option value="CompanyName" <?php if ($_GET['search_for'] == 'CompanyName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume companie'), $this);?>
</option>
        <option value="Trainer" <?php if ($_GET['search_for'] == 'Trainer'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Trainer'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select><label>inregistrari</label>
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
                <li>
                    <input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Training&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Denumire training','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TrainingName','asc_or_desc' => 'asc'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Training']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Companie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CompanyName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Trainer','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FullName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Judet','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DistrictName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Localitate','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CityName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Domeniu activitate','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Domain'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data inceput','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'StartDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data finala','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'StopDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Status'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'User','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'UserName'), $this);?>
</td>
        <?php endif; ?>
        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Generare formular'), $this);?>
</b></td>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['trainings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter']['iteration'],'y' => 1,'z' => $this->_tpl_vars['trainings']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=training&o=edit&TrainingID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['TrainingName']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Training']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter1']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter1']['iteration'] == $this->_foreach['iter1']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>


                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Domain']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['item']['UserName']; ?>
</td>
                <?php endif; ?>
                <td class="celulaMenuST"><a href="./?m=training&o=evalAssign&TrainingID=<?php echo $this->_tpl_vars['key']; ?>
&Type=2"><b><?php echo smarty_function_translate(array('label' => 'Trainer'), $this);?>
</b></a> | <a
                            href="./?m=training&o=evalAssign&TrainingID=<?php echo $this->_tpl_vars['key']; ?>
&Type=1"><b><?php echo smarty_function_translate(array('label' => 'Cursant'), $this);?>
</b></a></td>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a) ca vreti sa stergeti acest training?'), $this);?>
')) window.location.href='./?m=training&o=del&TrainingID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['trainings'] ) == 1): ?>
        <tr height="30">
            <td colspan="12" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nici un training!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="12" valign="top" class="bkdTitleMenu">
    	    <span class="TitleBoxDown">
            <?php if ($this->_tpl_vars['trainings']['0']['page'] > 1): ?>&laquo; <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
" class="white">prima</a>&nbsp;<a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&page=<?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_tpl_vars['trainings']['0']['page'],'y' => 1), $this);?>
"
                                                                                                       class="white">inapoi</a><?php endif; ?>
            pagina <?php echo $this->_tpl_vars['trainings']['0']['page']; ?>
 din <?php echo $this->_tpl_vars['trainings']['0']['pageNo']; ?>

                <?php if ($this->_tpl_vars['trainings']['0']['page'] < $this->_tpl_vars['trainings']['0']['pageNo']): ?><a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&page=<?php echo smarty_function_math(array('equation' => "x+y",'x' => $this->_tpl_vars['trainings']['0']['page'],'y' => 1), $this);?>
"
                                                               class="white"><?php echo smarty_function_translate(array('label' => 'inainte'), $this);?>
</a>&nbsp;
                    <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&page=<?php echo $this->_tpl_vars['trainings']['0']['pageNo']; ?>
" class="white"><?php echo smarty_function_translate(array('label' => 'ultima'), $this);?>
</a>
                    &raquo;<?php endif; ?>
            </span>
        </td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=training&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>