<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:12
         compiled from tickets.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'tickets.tpl', 3, false),array('function', 'math', 'tickets.tpl', 68, false),array('function', 'orderby', 'tickets.tpl', 145, false),array('modifier', 'default', 'tickets.tpl', 33, false),array('modifier', 'date_format', 'tickets.tpl', 71, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tickets_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</label>
    <select id="Type" name="Type" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Type']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
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

    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="Comments" <?php if ($_GET['search_for'] == 'Comments'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>

    <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
        <td style="padding-left: 2px;" width="75">
            <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=tickets&DivisionID=' + this.value" class="dropdown">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select></td>
    <?php else: ?>
        <input type="hidden" name="DivisionID" id="DivisionID" value="0">
    <?php endif; ?>
    <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
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
    <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
        <?php echo smarty_function_math(array('equation' => "x-y",'x' => time(),'y' => 86400,'assign' => 'yesterday'), $this);?>

    <?php echo smarty_function_math(array('equation' => "x+y",'x' => time(),'y' => 86400,'assign' => 'tomorrow'), $this);?>

    <label><?php echo smarty_function_translate(array('label' => 'Creat intre'), $this);?>
:</label><input type="text" name="DateStart" id="DateStart" class="formstyle"
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
    <label><?php echo smarty_function_translate(array('label' => 'Data limita intre'), $this);?>
:</label><input type="text" name="NextDateStart" id="NextDateStart" class="formstyle"
                                                                value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['NextDateStart'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js3">
        var cal3 = new CalendarPopup();
        cal3.isShowNavigationDropdowns = true;
        cal3.setYearSelectStartOffset(10);
        //writeSource("js3");
    </SCRIPT>
    <label><A HREF="#" onClick="cal3.select(document.getElementById('NextDateStart'),'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img src="images/cal.png"
                                                                                                                                                              border="0"/></A></label>
    <label><?php echo smarty_function_translate(array('label' => 'si'), $this);?>
</label> <input type="text" name="NextDateEnd" id="NextDateEnd" class="formstyle"
                                                 value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['NextDateEnd'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js4">
        var cal4 = new CalendarPopup();
        cal4.isShowNavigationDropdowns = true;
        cal4.setYearSelectStartOffset(10);
        //writeSource("js4");
    </SCRIPT>
    <label><A HREF="#" onClick="cal4.select(document.getElementById('NextDateEnd'),'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img src="images/cal.png"
                                                                                                                                                            border="0"/></A></label>

    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select><label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label><br/>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Ticket&type=popup','',250,400)">
                </li>
                <ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Cerere','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Report'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Ticket']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Nume','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FullName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Tip','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TicketType'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TicketStatus'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Comentarii','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Comments'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TCreateDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data limita','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'TLimitDate'), $this);?>
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
                <td class="celulaMenuST">
                    <?php if ($this->_tpl_vars['item']['TicketType'] == 1): ?>
                        <a href="./?m=tickets&o=edit&TicketID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['Report']; ?>
</a>
                    <?php elseif ($this->_tpl_vars['item']['TicketType'] == 2): ?>
                        <a href="./?m=tickets&o=edit&TicketID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['services'][$this->_tpl_vars['item']['ReportID']]; ?>
</a>
                    <?php elseif ($this->_tpl_vars['item']['TicketType'] == 3): ?>
                        <a href="./?m=tickets&o=edit&TicketID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo smarty_function_translate(array('label' => 'Vizualizeaza'), $this);?>
</a>
                    <?php endif; ?>
                </td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Ticket']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['TicketStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Type'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['types'][$this->_tpl_vars['item']['TicketType']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CreateDate'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCreateDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'LimitDate'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TLimitDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CompanyID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['self'][$this->_tpl_vars['item']['CompanyID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DivisionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['divisions'][$this->_tpl_vars['item']['DivisionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'SubDepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['subdepartments'][$this->_tpl_vars['item']['SubDepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['FullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['types'][$this->_tpl_vars['item']['TicketType']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['TicketStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Comments'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCreateDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TLimitDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta cerere?'), $this);?>
')) window.location.href='./?m=tickets&o=del&TicketID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['cars'] ) == 1): ?>
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
        window.location.href = './?m=tickets&Type=' + document.getElementById('Type').value +
            '&Status=' + document.getElementById('Status').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&NextDateStart=' + document.getElementById('NextDateStart').value +
            '&NextDateEnd=' + document.getElementById('NextDateEnd').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>