<?php /* Smarty version 2.6.18, created on 2020-09-07 08:07:58
         compiled from functions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'functions.tpl', 4, false),array('function', 'orderby', 'functions.tpl', 58, false),array('function', 'math', 'functions.tpl', 83, false),array('modifier', 'default', 'functions.tpl', 20, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "functions_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Functie superioara'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['parent_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ParentFunctionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="name"
                <?php if ($_GET['search_for'] == 'name'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume functie'), $this);?>
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
    <label>inregistrari</label>
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
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span
                    class="TitleBox"><?php echo smarty_function_orderby(array('label' => 'Functie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.Function",'asc_or_desc' => 'asc'), $this);?>
</span>
        </td>
        <td>
            <table cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="200"><span
                                class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Functie superioara'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span
                                class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii definite'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span
                                class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii ocupate'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii libere'), $this);?>
</span>
                    </td>
                    <td class="bkdTitleMenu" width="80"><span
                                class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Vechime in companie (ani)'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="80"><span
                                class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Vechime in functie (ani)'), $this);?>
</span></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['functions']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST">
                    <a href="./?m=functions&o=edit&FunctionID=<?php echo $this->_tpl_vars['item']['InternalFunctionID']; ?>
"
                       class="blue"><?php echo $this->_tpl_vars['item']['Function']; ?>
<?php if ($this->_tpl_vars['item']['FunctionObs'] != ''): ?>&nbsp;&nbsp;<i>(<?php echo $this->_tpl_vars['item']['FunctionObs']; ?>
)</i><?php endif; ?></a>
                </td>
                <td class="celulaMenuSTDR">
                    <?php if ($this->_tpl_vars['item']['Companies']): ?>
                        <table cellspacing="0" cellpadding="2" width="100%">
                            <?php $_from = $this->_tpl_vars['item']['Companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['c']):
        $this->_foreach['iter2']['iteration']++;
?>
                                <tr>
                                    <td width="200" class="celulaMenuST"
                                        style="border-left:none; <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>border-bottom:none;<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="200" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['parent_functions'][$this->_tpl_vars['c']['ParentFunctionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['Positions'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['PositionsOccupied'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['PositionsFree'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="80" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['CompanyAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="80" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['TotalAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    <?php else: ?>
                        &nbsp;
                    <?php endif; ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['functions'] ) == 1): ?>
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
        window.location.href = './?m=functions&ParentFunctionID=' + document.getElementById('ParentFunctionID').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value



        }
</script>