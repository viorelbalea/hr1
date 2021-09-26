<?php /* Smarty version 2.6.18, created on 2020-10-05 11:01:42
         compiled from library.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'library.tpl', 19, false),array('function', 'orderby', 'library.tpl', 57, false),array('function', 'math', 'library.tpl', 70, false),array('modifier', 'default', 'library.tpl', 23, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "library_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="filter">
    <select id="CatID" name="CatID" class="cod">
        <option value="0">Categorie</option>
        <?php $_from = $this->_tpl_vars['cats']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($_SESSION['USER_ID'] == 1 || isset ( $this->_tpl_vars['categories'][$this->_tpl_vars['key']] )): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['CatID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php if (is_array ( $this->_tpl_vars['cats'][$this->_tpl_vars['key']] )): ?>
                    <?php $_from = $this->_tpl_vars['cats'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($_GET['CatID'] == $this->_tpl_vars['key2']): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">cuvant cheie in</option>
        <option value="name" <?php if ($_GET['search_for'] == 'name'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume si descriere document'), $this);?>
</option>
        <option value="code" <?php if ($_GET['search_for'] == 'code'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Cod document'), $this);?>
</option>
        <option value="tags" <?php if ($_GET['search_for'] == 'tags'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Taguri'), $this);?>
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
    </select> <label>inregistrari</label>
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
                <ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Document','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DocName','asc_or_desc' => 'asc'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Categorie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CatName'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Cod document','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DocCode'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Versiune','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DocVersion'), $this);?>
</td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.CreateDate"), $this);?>
</td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
</span></td>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['docs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['docs']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="<?php echo $this->_tpl_vars['item']['curr_filename']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'Acceseaza fisierul'), $this);?>
 <?php echo $this->_tpl_vars['item']['FileName']; ?>
"><b><?php echo $this->_tpl_vars['item']['DocName']; ?>
</b></a></td>
                <td class="celulaMenuST"><?php if (! empty ( $this->_tpl_vars['item']['PCatName'] )): ?><?php echo $this->_tpl_vars['item']['PCatName']; ?>
 / <?php endif; ?><?php echo $this->_tpl_vars['item']['CatName']; ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DocCode']; ?>
</td>
                <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['DocVersion'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['DocDescr'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['data']; ?>
</td>
                <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>" style="text-align: center;"><?php if ($this->_tpl_vars['item']['rw'] == 1): ?>
                        <div id="button_mod"><a href="./?m=library&o=edit&DocID=<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php else: ?>-<?php endif; ?></td>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest document?'), $this);?>
')) window.location.href='./?m=library&o=del&DocID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge fisierul'), $this);?>
 <?php echo $this->_tpl_vars['item']['FileName']; ?>
"><b>Del</b></a></div></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['docs'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><label><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</label></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu"><?php echo $this->_tpl_vars['pagination']; ?>
</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {
        window.location.href = './?m=library&CatID=' + document.getElementById('CatID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>