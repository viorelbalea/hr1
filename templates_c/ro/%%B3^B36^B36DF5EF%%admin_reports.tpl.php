<?php /* Smarty version 2.6.18, created on 2020-10-13 10:46:07
         compiled from admin_reports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_reports.tpl', 7, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="layer_reports" class="layer" style="display: none;">
    <div class="eticheta">
        <?php echo $this->_tpl_vars['eticheta']; ?>

    </div>
    <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Drepturi raport'), $this);?>
 : <span id="reportTitle"></span></h3>

    <div class="layerContent" id="layer_reports_content"></div>

</div>
<div id="layer_reports_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_reports').style.display = 'none'; document.getElementById('layer_reports_x').style.display = 'none'; return false;">x
</div>

<div id="layer_reports_alloc" class="layer" style="display: none;">
    <div class="eticheta">
        <?php echo $this->_tpl_vars['eticheta']; ?>

    </div>
    <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Drepturi rapoarte'), $this);?>
</h3>
    <div class="layerContent" id="layer_reports_alloc_content"></div>
</div>
<div id="layer_reports_alloc_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_reports_alloc').style.display = 'none'; document.getElementById('layer_reports_alloc_x').style.display = 'none'; return false;">x
</div>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;" width="75%">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</legend>
                <p>
                    <?php echo smarty_function_translate(array('label' => 'Grupa rapoarte'), $this);?>
:
                    <select name="GroupID" id="GroupID" onchange="window.location.href = './?m=admin&o=reports&GroupID=' + 										document.getElementById('GroupID').value +
		 												'&Type=' + document.getElementById('Type').value;">
                        <option value="0">alege...</option>
                        <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['GroupID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?php echo smarty_function_translate(array('label' => 'Tip rapoarte'), $this);?>
:
                    <select name="Type" id="Type" onchange="window.location.href = './?m=admin&o=reports&GroupID=' + document.getElementById('GroupID').value +
		 												'&Type=' + document.getElementById('Type').value;">
                        <option value="0">alege...</option>
                        <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['Type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </p>
                <?php if (! empty ( $this->_tpl_vars['reports'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0" class="grid">
                                    <tr height="25">
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b><?php echo smarty_function_translate(array('label' => 'Modul'), $this);?>
</b></td>
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b><?php echo smarty_function_translate(array('label' => 'Raport'), $this);?>
</b></td>
                                        <td class="celulaMenuST" style="border-top: 1px solid #EDEDED;"><b><?php echo smarty_function_translate(array('label' => 'Drepturi'), $this);?>
</b></td>
                                        <td class="celulaMenuSTDR" style="border-top: 1px solid #EDEDED;"><input type="checkbox" id="alloc"></td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr height="25">
                                            <td class="celulaMenuST" width="80"><?php echo $this->_tpl_vars['modules_txt'][$this->_tpl_vars['item']['ModuleID']]; ?>
 </td>
                                            <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Report']; ?>
</td>
                                            <td class="celulaMenuST" style="text-align: center;">
                                                <div id="button_mod"><a href="./?m=admin&o=reports&ReportID=<?php echo $this->_tpl_vars['item']['ReportID']; ?>
"
                                                                        onclick="document.getElementById('layer_reports').style.display = 'block'; document.getElementById('layer_reports_x').style.display = 'block'; showInfo('ajax.php?o=reports_rights&ReportID=<?php echo $this->_tpl_vars['item']['ReportID']; ?>
', 'layer_reports_content'); document.getElementById('reportTitle').innerHTML = '<?php echo $this->_tpl_vars['item']['Report']; ?>
'; return false;"
                                                                        title="Drepturi"><b><?php echo smarty_function_translate(array('label' => 'Mod'), $this);?>
</b></a></div>
                                            </td>
                                            <td class="celulaMenuSTDR" style="text-align: center;"><input type="checkbox" value="<?php echo $this->_tpl_vars['item']['ReportID']; ?>
" class="allocr"></td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <?php echo smarty_function_translate(array('label' => 'Niciun raport asociat acestei grupe!'), $this);?>

                <?php endif; ?>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Grupe rapoarte'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="GroupName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']; ?>
" size="30" maxlength="128"></td>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=reports&action=edit&GroupID=<?php echo $this->_tpl_vars['key']; ?>
&GroupName=' + escape(document.getElementById('GroupName_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                    title="Modifica grupa rapoarte"><b><?php echo smarty_function_translate(array('label' => 'Mod'), $this);?>
</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=reports&action=del&GroupID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                    title="Sterge grupa rapoarte"><b><?php echo smarty_function_translate(array('label' => 'Del'), $this);?>
</b></a></div>
                                        </td>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <tr>
                                    <td><input type="text" id="GroupName_0" size="30" maxlength="128"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=reports&action=new&GroupID=0&GroupName=' + escape(document.getElementById('GroupName_0').value); return false;"
                                                                title="Adauga grupa rapoarte"><b><?php echo smarty_function_translate(array('label' => 'Add'), $this);?>
</b></a></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'administrare rapoarte'), $this);?>
</td>
    </tr>
</table>
<?php echo '
<script type="text/javascript">
    $(document).ready(function () {
        $("#alloc").change(function () {

            if ($(this).prop(\'checked\')) {
                var reports = \'|\';
                $(".allocr").each(function () {
                    if ($(this).prop(\'checked\')) {
                        reports += $(this).attr(\'value\') + \'|\';
                    }
                });
                if (reports.length > 1) {
                    $("#layer_reports_alloc").show();
                    $("#layer_reports_alloc_x").show();
                    $.get(\'ajax.php?o=reports_rights_alloc&reports=\' + reports, function (data) {
                        $("#layer_reports_alloc_content").html(data)
                    });
                } else {
                    alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ai ales rapoarte'), $this);?>
<?php echo '!\');
                }
            }
        });
    });
</script>
'; ?>