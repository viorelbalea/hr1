<?php /* Smarty version 2.6.18, created on 2020-10-05 06:28:17
         compiled from admin_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_menu.tpl', 2, false),)), $this); ?>
<div class="submeniu">
    <a href="./?m=admin&o=users" <?php if ($_GET['o'] == 'users'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Utilizatori'), $this);?>
</a>
    <a href="./?m=admin&o=reports" <?php if ($_GET['o'] == 'reports'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</a>
    <a href="./?m=admin&o=customfields" <?php if ($_GET['o'] == 'customfields'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Campuri custom'), $this);?>
</a>
    <a href="./?m=admin&o=alert" <?php if ($_GET['o'] == 'alert'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Alerte'), $this);?>
</a>
    <a href="./?m=admin&o=aprove" <?php if ($_GET['o'] == 'aprove'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Aprobari'), $this);?>
</a>
    <a href="./?m=admin&o=budgets" <?php if ($_GET['o'] == 'budgets'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Bugete'), $this);?>
</a>
    <a href="./?m=admin&o=import" <?php if ($_GET['o'] == 'import'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import persoane'), $this);?>
</a>
    <a href="./?m=admin&o=import_saga" <?php if ($_GET['o'] == 'import_saga'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import SAGA'), $this);?>
</a>
    <a href="./?m=admin&o=import_salary" <?php if ($_GET['o'] == 'import_salary'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import stat salarii'), $this);?>
</a>
    <a href="./?m=admin&o=import-cars" <?php if ($_GET['o'] == 'import-cars'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import masini'), $this);?>
</a>
    <a href="./?m=admin&o=translate" <?php if ($_GET['o'] == 'translate'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Traduceri'), $this);?>
</a>
    <a href="./?m=admin&o=settings" <?php if ($_GET['o'] == 'settings'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Setari pe companie'), $this);?>
</a>
    <a href="./?m=admin&o=currency" <?php if ($_GET['o'] == 'currency'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</a>
    <a href="./?m=admin&o=ticketing" <?php if ($_GET['o'] == 'ticketing'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Ticketing'), $this);?>
</a>
    <a href="./?m=admin&o=import_cand_ext" <?php if ($_GET['o'] == 'import_cand_ext'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import candidati externi'), $this);?>
</a>
    <a href="./?m=admin&o=import_charisma" <?php if ($_GET['o'] == 'import_charisma'): ?>class="selected" <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Import Charisma'), $this);?>
</a>
</div>