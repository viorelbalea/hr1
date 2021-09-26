<?php /* Smarty version 2.6.18, created on 2020-09-21 08:33:53
         compiled from companies.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'companies.tpl', 3, false),array('function', 'orderby', 'companies.tpl', 74, false),array('function', 'math', 'companies.tpl', 92, false),array('modifier', 'default', 'companies.tpl', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</label>
    <select id="Judet" name="Judet"
            onchange="if (this.value>0) window.location.href = './?m=companies&Judet=' + this.value"
            class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Judet']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Oras" name="Oras"
            onchange="if (this.value>0) window.location.href = './?m=companies&Judet=<?php echo $_GET['Judet']; ?>
&Oras='+this.value"
            class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Oras']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
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
        <option value="CompanyName"
                <?php if ($_GET['search_for'] == 'CompanyName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume companie'), $this);?>
</option>
        <option value="CIF" <?php if ($_GET['search_for'] == 'CIF'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CIF'), $this);?>
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
    </select>
    <label><?php echo smarty_function_translate(array('label' => ' inregistrari'), $this);?>
</label>
    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
" class="cod" onclick="filterList();">
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .xls"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .doc"
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Company&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Nume companie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CompanyName','asc_or_desc' => 'asc'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Company']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
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
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Domeniu de activitate','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Domain'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'CIF','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CIF'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['companies']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST">
                    <a href="./?m=companies&o=edit&CompanyID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</a>
                </td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Company']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Domain']; ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <a href="#"
                       onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta companie?'), $this);?>
')) window.location.href='./?m=companies&o=del&CompanyID=<?php echo $this->_tpl_vars['key']; ?>
&back_url=' + escape('<?php echo $_SERVER['REQUEST_URI']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['companies'] ) == 1): ?>
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
        window.location.href = './?m=companies&Judet=' + document.getElementById('Judet').value + '&Oras=' + document.getElementById('Oras').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>