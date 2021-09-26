<?php /* Smarty version 2.6.18, created on 2020-10-06 10:06:59
         compiled from persons_docs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_docs.tpl', 13, false),array('function', 'orderby', 'persons_docs.tpl', 48, false),array('function', 'math', 'persons_docs.tpl', 58, false),array('modifier', 'default', 'persons_docs.tpl', 23, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
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
</table>
<br>
<table cellspacing="0" cellpadding="0" width="100%" border="0" class="filter">
    <tr height="40">
        <td style="padding-left: 4px;" width="75"><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</td>
        <td width="60">
            <select id="search_for" nume="search_for" class="cod">
                <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
                <option value="name" <?php if ($_GET['search_for'] == 'name'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume document'), $this);?>
</option>
                <option value="descr" <?php if ($_GET['search_for'] == 'descr'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Descriere document'), $this);?>
</option>
                <option value="code" <?php if ($_GET['search_for'] == 'code'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Cod document'), $this);?>
</option>
                <option value="tags" <?php if ($_GET['search_for'] == 'tags'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Taguri'), $this);?>
</option>
            </select>
        </td>
        <td style="padding-left: 4px;" width="60"><input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"></td>
        <td style="padding-left: 4px;" width="60"><input type="button" value="Cauta" class="cod"
                                                         onclick="window.location.href = './?m=persons&o=docs&PersonID=<?php echo $_GET['PersonID']; ?>
&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
        </td>
        <td>&nbsp;</td>
        <td align="right" style="padding-right: 4px;">
            <select id="res_per_page" nume="res_per_page" class="cod">
                <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select> inregistrari&nbsp;&nbsp;&nbsp;
            <input type="button" class="cod" value="Export" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action2=export'">
            <input type="button" class="cod" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action2=print_page'">
            <input type="button" class="cod" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action2=print_all'">
        </td>
    </tr>
    <tr height="40">
        <td colspan="6" style="padding-left: 4px;"><input type="button" value="Adauga document"
                                                          onclick="window.location.href = './?m=persons&o=docs&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new';"></td>
    </tr>
</table>
</br>
<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_orderby(array('label' => 'Nume document','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DocName'), $this);?>
</td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_orderby(array('label' => 'Cod document','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DocCode'), $this);?>
</td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_orderby(array('label' => 'Data','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => "a.CreateDate"), $this);?>
</td>
        <td class="bkdTitleMenu" style="text-align: center;"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
</span></td>
        <td class="bkdTitleMenu" style="text-align: center;"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td>
    </tr>
    <?php $_from = $this->_tpl_vars['docs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_foreach['iter1']['iteration'],'y' => 1), $this);?>
</td>
                <td class="celulaMenuST">

                    <a href="<?php echo $this->_tpl_vars['item']['curr_filename']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'Acceseaza fisierul'), $this);?>
 <?php echo $this->_tpl_vars['item']['FileName']; ?>
" target="_blank" class="target1"><b><?php echo $this->_tpl_vars['item']['DocName']; ?>
</b></a>

                </td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DocCode']; ?>
</td>
                <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['DocDescr'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['data']; ?>
</td>
                <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>" style="text-align: center;"<?php if ($this->_tpl_vars['item']['rw'] == 1): ?>
                <div id="button_mod"><a href="./?m=persons&o=docs&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&DocID=<?php echo $this->_tpl_vars['key']; ?>
" title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a>
                </div><?php else: ?>&nbsp;<?php endif; ?></td>
                <?php if ($this->_tpl_vars['item']['rw'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest document?'), $this);?>
')) window.location.href='./?m=persons&o=docs&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&DocID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge fisierul'), $this);?>
 <?php echo $this->_tpl_vars['item']['FileName']; ?>
"><b>Del</b></a></div></td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['docs'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">
    	    <span class="TitleBoxDown">
            <?php if ($this->_tpl_vars['docs']['0']['page'] > 1): ?>&laquo; <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&page=<?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_tpl_vars['docs']['0']['page'],'y' => 1), $this);?>
" class="white"><?php echo smarty_function_translate(array('label' => 'inapoi'), $this);?>
</a><?php endif; ?>
            pagina <?php echo $this->_tpl_vars['docs']['0']['page']; ?>
 din <?php echo $this->_tpl_vars['docs']['0']['pageNo']; ?>

                <?php if ($this->_tpl_vars['docs']['0']['page'] < $this->_tpl_vars['docs']['0']['pageNo']): ?><a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&page=<?php echo smarty_function_math(array('equation' => "x+y",'x' => $this->_tpl_vars['docs']['0']['page'],'y' => 1), $this);?>
" class="white"><?php echo smarty_function_translate(array('label' => 'inainte'), $this);?>
</a> &raquo;<?php endif; ?>
            </span>
        </td>
    </tr>
</table>
<?php echo '
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        '; ?>

        <?php if (( $_GET['alertemailsent'] == 1 )): ?>
        alert('Emailul a fost trimis.');
        <?php endif; ?>
        <?php echo '
        $(\'.target1\').contextMenu(\'context-menu-1\', {
            \'Download in browser\': {
                click: function (element) {  // element is the jquery obj clicked on when context menu launched
                    document.location = element.attr("href");
                },
                klass: "menu-item-1" // a custom css class for this menu item (usable for styling)
            },
            \'Trimite linkul pe mail\': {
                click: function (element) {
                    document.location = \'senddocumentbymail.php?doc=\' + element.attr("href") + \'&mail=\' + prompt(\'Catre ce email doriti trimiterea\') + \'&urlreturn=\' + encodeURIComponent(\'?m=persons&o=docs&PersonID='; ?>
<?php echo $_GET['PersonID']; ?>
<?php echo '\');
                },
                klass: "second-menu-item"
            }
        });


    });
</script>
    <style>
        /* all context menus have this class */
        .context-menu {
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;

            background-color: #f2f2f2;
            border: 1px solid #999;

            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .context-menu a {
            display: block;
            padding: 3px;
            text-decoration: none;
            color: #333;
        }

        .context-menu a:hover {
            background-color: #666;
            color: white;
        }

        /* second context menu */
        #context-menu-2 {
            border: 1px solid #333;
            background-color: orange;
            margin: 0;
            padding: 0;
        }
    </style>    '; ?>
