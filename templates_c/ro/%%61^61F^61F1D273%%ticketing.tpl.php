<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:09
         compiled from ticketing.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'ticketing.tpl', 3, false),array('function', 'orderby', 'ticketing.tpl', 111, false),array('function', 'math', 'ticketing.tpl', 133, false),array('modifier', 'cat', 'ticketing.tpl', 12, false),array('modifier', 'default', 'ticketing.tpl', 28, false),array('modifier', 'date_format', 'ticketing.tpl', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ticketing_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</label>
    <select id="Type" name="Type" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip tichet'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Type']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <label>Status:</label>
    <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>&nbsp;
        <input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" <?php if (strstr ( $_GET['Status'] , ((is_array($_tmp=((is_array($_tmp='|')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '|') : smarty_modifier_cat($_tmp, '|')) )): ?>checked<?php endif; ?>>
        <label><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</label><?php endforeach; endif; unset($_from); ?>
    <select id="CompanyID" class="cod" style="width:200px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'companie'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['CompanyID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="Title" <?php if ($_GET['search_for'] == 'Title'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Titlu'), $this);?>
</option>
        <option value="Notes" <?php if ($_GET['search_for'] == 'Notes'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</option>
        <option value="Notes2" <?php if ($_GET['search_for'] == 'Notes2'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</option>
        <option value="TicketID" <?php if ($_GET['search_for'] == 'TicketID'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'ID tichet'), $this);?>
</option>
        <option value="ComputerName" <?php if ($_GET['search_for'] == 'ComputerName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume computer'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();">
    <br/>
    <label><?php echo smarty_function_translate(array('label' => 'Creat intre'), $this);?>
:</label> <input type="text" name="DateStart" id="DateStart" class="formstyle"
                                                           value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['DateStart'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                          border="0"/></A></label>
    <label><?php echo smarty_function_translate(array('label' => 'si'), $this);?>
</label>
    <input type="text" name="DateEnd" id="DateEnd" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['DateEnd'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
    <select id="AssignedPersonID" name="AssignedPersonID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Asignare'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['asignees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['AssignedPersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="CategoryID" name="CategoryID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Categoria'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CategoryID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="DepartmentID" name="DepartmentID" class="cod">
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
    <select id="AppVersionID" name="AppVersionID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Versiunea'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['application_version']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option <?php if ($this->_tpl_vars['item']['Status'] == 0): ?> style="color:gray;"<?php endif; ?> value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['AppVersionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['DisplayVersion']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
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
                    <input name="button" type="button" class="cod printFile" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'"
                           value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"/>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Ticketing&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'ID','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TicketID'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Solicitant','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Author'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Ticketing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Solicitat de','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Author'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Tip','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Type'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Status'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Prioritate','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Priority'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Importanta','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Importance'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data crearii','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CreateDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Asignare','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'AssignedFullName'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['tickets']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=ticketing&o=edit&TicketID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['TicketID']; ?>
</a></td>
                <td class="celulaMenuST"><a href="./?m=ticketing&o=edit&TicketID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['Author']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Ticketing']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CategoryID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['categories'][$this->_tpl_vars['item']['CategoryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Type'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['types'][$this->_tpl_vars['item']['Type']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Priority'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['priority'][$this->_tpl_vars['item']['Priority']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Importance'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['importance'][$this->_tpl_vars['item']['Importance']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CreateDate'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CreateDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CompanyID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['companies'][$this->_tpl_vars['item']['CompanyID']]['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'ProjectID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['projects'][$this->_tpl_vars['item']['ProjectID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'AppVersionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['DisplayVersion'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Title'): ?>
                                <p title="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Title'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Title'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</p>
                            <?php elseif ($this->_tpl_vars['field'] == 'Notes'): ?>
                                <p title="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['NotesX'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</p>
                            <?php elseif ($this->_tpl_vars['field'] == 'Notes2'): ?>
                                <p title="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Notes2'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Notes2X'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</p>
                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Author']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['types'][$this->_tpl_vars['item']['Type']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['priority'][$this->_tpl_vars['item']['Priority']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['importance'][$this->_tpl_vars['item']['Importance']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['CreateDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['AssignedFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest tichet?'), $this);?>
')) window.location.href='./?m=ticketing&o=del&TicketID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['tickets'] ) == 1): ?>
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
        window.location.href = './?m=ticketing' +
            '&Type=' + document.getElementById('Type').value +
            '&Status=|' + <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>(document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked == true ? '<?php echo $this->_tpl_vars['key']; ?>
|' : '') + <?php endforeach; endif; unset($_from); ?>
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&AssignedPersonID=' + document.getElementById('AssignedPersonID').value +
            '&CategoryID=' + document.getElementById('CategoryID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&AppVersionID=' + document.getElementById('AppVersionID').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>