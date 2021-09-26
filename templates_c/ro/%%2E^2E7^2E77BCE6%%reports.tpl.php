<?php /* Smarty version 2.6.18, created on 2020-09-07 08:07:41
         compiled from reports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'reports.tpl', 3, false),)), $this); ?>
<?php if (empty ( $_GET['export_doc'] ) && empty ( $_GET['print'] )): ?>
    <div class="submeniu">
        <a href="./?m=reports" class="selected"><?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</a>
        <a href="./?m=reports_maker&o=new" class="unselected"><?php echo smarty_function_translate(array('label' => 'Raport nou'), $this);?>
</a>
        <a href="./?m=reports_maker&o=myreports" class="unselected"><?php echo smarty_function_translate(array('label' => 'Rapoartele mele'), $this);?>
</a>
    </div>
    <div class="filter">
        <select id="GroupID" name="GroupID" onchange="window.location.href = './?m=reports&GroupID=' + this.value;">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege grupa...'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['GroupID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <select name="o" onchange="if (this.value>0) window.location.href = './?m=reports&GroupID=' + document.getElementById('GroupID').value + '&rep=' + this.value" class="cod"
                style="width:300px">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege raport...'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <?php if ($_SESSION['USER_ID'] == 1 || ( $this->_tpl_vars['item']['Type'] == 0 || ( $this->_tpl_vars['item']['Type'] == 1 && ( in_array ( 8 , $_SESSION['USER_RIGHTS'] ) ) ) )): ?>
                    <option value="<?php echo $this->_tpl_vars['item']['ReportID']; ?>
" <?php if ($_GET['rep'] == $this->_tpl_vars['item']['ReportID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Report']; ?>
</option>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <?php if (! empty ( $_GET['rep'] )): ?><label><b><?php echo smarty_function_translate(array('label' => 'Raport Nr.'), $this);?>
 <?php echo $_GET['rep']; ?>
</b></label><?php endif; ?>
        <?php if (! empty ( $_GET['rep'] ) && ! in_array ( $_GET['rep'] , array ( 47 , 48 ) )): ?>
            <br/>
            <div class="outputZone outputZoneOne">
                <div>
                    <ul>
                        <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>

                        <li><input type="button" class="cod printFile" onclick="window.open('<?php echo $_SERVER['REQUEST_URI']; ?>
&print=1', 'print')" value="<?php echo smarty_function_translate(array('label' => 'Printeaza'), $this);?>
">
                        </li>
                        <li><input type="button" class="cod exportFile" onclick="window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&export=1'" value="Export .xls">
                        </li>
                        <li><input type="button" class="cod exportFile" onclick="window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&export_doc=1'" value="Export .doc">
                            <?php if (! empty ( $this->_tpl_vars['personalise'] )): ?></li>
                        <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare Coloane'), $this);?>
"
                                   onclick="popUp('./?m=reports&o=personalisedlist&rep=<?php echo $_GET['rep']; ?>
&type=popup','',300,400)"><?php endif; ?>
                            <?php if (! empty ( $this->_tpl_vars['personaliseFilters'] )): ?></li>
                        <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare Filtre'), $this);?>
"
                                   onclick="popUp('./?m=reports&o=personalisedfilters&rep=<?php echo $_GET['rep']; ?>
&type=popup','',300,400)"><?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php if (! empty ( $this->_tpl_vars['rep_adv'] )): ?>
        <div class="filter">
            <?php if (! empty ( $this->_tpl_vars['self'] )): ?>
                <label><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
:</label>
                <select id="CompanyID" onchange="window.location.href = './?m=reports&GroupID=<?php echo $_GET['GroupID']; ?>
&rep=<?php echo $_GET['rep']; ?>
&CompanyID=' + this.value;">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['CompanyID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php endif; ?>
            <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>daf
                <label><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
:</label>
                <select id="DivisionID"
                        onchange="window.location.href = './?m=reports&GroupID=<?php echo $_GET['GroupID']; ?>
&rep=<?php echo $_GET['rep']; ?>
&CompanyID=<?php echo $_GET['CompanyID']; ?>
&DivisionID=' + this.value;">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['DivisionID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php endif; ?>
            <label><?php echo smarty_function_translate(array('label' => 'Persoana'), $this);?>
:</label>
            <select id="PersonID"
                    onchange="window.location.href = './?m=reports&GroupID=<?php echo $_GET['GroupID']; ?>
&rep=<?php echo $_GET['rep']; ?>
&CompanyID=<?php echo $_GET['CompanyID']; ?>
&DivisionID=<?php echo $_GET['DivisionID']; ?>
&PersonID=' + this.value;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['PersonID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </div>
        <br>
    <?php endif; ?>
<?php endif; ?>
<?php if (! empty ( $_GET['rep'] )): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['report_file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>