<?php /* Smarty version 2.6.18, created on 2020-09-07 08:07:53
         compiled from projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'projects.tpl', 3, false),array('function', 'orderby', 'projects.tpl', 69, false),array('function', 'math', 'projects.tpl', 85, false),array('modifier', 'default', 'projects.tpl', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "projects_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</label>
    <select name="ProjectID" id="ProjectID" onchange="window.location.href = './?m=projects&o=projects&ProjectID=' + this.value;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Cod proiect'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($this->_tpl_vars['key'] > 0): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ProjectID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Code']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="ProjectID2" onchange="window.location.href = './?m=projects&o=projects&ProjectID=' + this.value;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Nume proiect'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($this->_tpl_vars['key'] > 0): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ProjectID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Name']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="PhaseID" id="PhaseID">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Faza'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['phases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($this->_tpl_vars['key'] > 0): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                        <?php if (( ! empty ( $_GET['PhaseID'] ) && $this->_tpl_vars['key'] == $_GET['PhaseID'] ) || ( empty ( $_GET['PhaseID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['projects'][$_GET['ProjectID']]['Phase'] )): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="Tags" <?php if ($_GET['search_for'] == 'Tags'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Taguri'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod">
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select> <label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=projects&o=projects&ProjectID=' + document.getElementById('ProjectID').value +
	                                                                                                                         '&PhaseID=' + document.getElementById('PhaseID').value + 
																 '&search_for=' + document.getElementById('search_for').value + 
																 '&keyword=' + escape(document.getElementById('keyword').value) + 
																 '&res_per_page=' + document.getElementById('res_per_page').value"><br/>
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
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Denumire proiect','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Name','asc_or_desc' => 'asc'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Partener','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CompanyName'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Cod proiect','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Code'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data de inceput','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.StartDate"), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data de incheiere','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.EndDate"), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Statut','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Type'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Faza','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Phase'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data crearii','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.CreateDate"), $this);?>
</td>
        <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_SETTINGS']['11_1'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
</span></td><?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_SETTINGS']['11_1'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['projects']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=projects&o=edit_project&ProjectID=<?php echo $this->_tpl_vars['item']['ProjectID']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['Name']; ?>
</a></td>
                <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Code']; ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['start_date']; ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['end_date']; ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['types'][$this->_tpl_vars['item']['Type']]; ?>
</td>
                <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['phases'][$this->_tpl_vars['item']['Phase']]; ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['create_date']; ?>
</td>
                <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_SETTINGS']['11_1'] == 1): ?>
                    <td class="celulaMenuST" style="text-align: center;">
                    <div id="button_mod"><a href="./?m=projects&o=edit_project&ProjectID=<?php echo $this->_tpl_vars['item']['ProjectID']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'Modifica proiect'), $this);?>
"><b>Mod</b></a></div>
                    </td><?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_SETTINGS']['11_1'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=projects&o=delete_project&ProjectID=<?php echo $this->_tpl_vars['item']['ProjectID']; ?>
'; return false;"
                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge proiect'), $this);?>
"><b>Del</b></a></div></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['projects'] ) == 1): ?>
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