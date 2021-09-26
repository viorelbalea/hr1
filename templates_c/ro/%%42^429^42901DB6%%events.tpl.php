<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:06
         compiled from events.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'events.tpl', 4, false),array('function', 'orderby', 'events.tpl', 75, false),array('function', 'math', 'events.tpl', 98, false),array('modifier', 'default', 'events.tpl', 24, false),array('modifier', 'date_format', 'events.tpl', 27, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "event_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">

    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa:'), $this);?>
</label>
    <select id="EventType" name="EventType" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip intalnire'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['eventType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($this->_tpl_vars['key'] != 5 && $this->_tpl_vars['key'] != 6): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['EventType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="PersonID" name="PersonID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Personal'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['PersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="FullName" <?php if ($_GET['search_for'] == 'FullName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Reprezentant companie'), $this);?>
</option>
        <option value="Scope" <?php if ($_GET['search_for'] == 'Scope'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Scop'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <label><?php echo smarty_function_translate(array('label' => 'intre'), $this);?>
:</label>
    <input type="text" id="DateStart" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['DateStart'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
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
    <input type="text" id="DateEnd" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['DateEnd'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">

    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>

                <li><input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'"></li>
                <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'"></li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'"></li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'"></li>
                <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Event&type=popup','',250,400)"></li>
            </ul>
        </div>
    </div>

</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Scop','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Scope','asc_or_desc' => 'asc'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Event']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                <td class="bkdTitleMenu">
                    <?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>

                </td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Autor','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'UserName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Reprezentant companie','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FullName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Detalii','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Details'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'EventStatus'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Intre','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'EventRelation'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Tip','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'EventType'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'EventData'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['events']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter']['iteration'],'y' => 1,'z' => $this->_tpl_vars['events']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=events&o=edit&EventID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['Scope']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Event']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter1']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter1']['iteration'] == $this->_foreach['iter1']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'ConsultantID'): ?>
                                <?php echo $this->_tpl_vars['consultants'][$this->_tpl_vars['item']['ConsultantID']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'EventStatus'): ?>
                                <?php echo $this->_tpl_vars['eventStatus'][$this->_tpl_vars['item']['EventStatus']]; ?>


                            <?php elseif ($this->_tpl_vars['field'] == 'EventType'): ?>
                                <?php echo $this->_tpl_vars['eventType'][$this->_tpl_vars['item']['EventType']]; ?>


                            <?php elseif ($this->_tpl_vars['field'] == 'EventRelation'): ?>
                                <?php echo $this->_tpl_vars['eventRelation'][$this->_tpl_vars['item']['EventRelation']]; ?>


                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['UserName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Details'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['eventStatus'][$this->_tpl_vars['item']['EventStatus']]; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['eventRelation'][$this->_tpl_vars['item']['EventRelation']]; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['eventType'][$this->_tpl_vars['item']['EventType']]; ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['item']['fEventData']; ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest eveniment?'), $this);?>
')) window.location.href='./?m=events&o=del&EventID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['events'] ) == 1): ?>
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
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
        window.location.href = './?m=events&EventType=' + document.getElementById('EventType').value +
            '&PersonID=' + document.getElementById('PersonID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        }
</script>