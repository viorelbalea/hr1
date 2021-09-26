<?php /* Smarty version 2.6.18, created on 2020-09-09 11:52:17
         compiled from functions_organigram.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'functions_organigram.tpl', 12, false),array('function', 'recurse_array', 'functions_organigram.tpl', 45, false),array('function', 'recurse_array_horiz', 'functions_organigram.tpl', 68, false),array('function', 'recurse_array_vert', 'functions_organigram.tpl', 77, false),)), $this); ?>
<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.treeview.js"></script>
<script type="text/javascript" src="./js/jquery.cookie.js"></script>
<script type="text/javascript" src="./js/jquery.orgchart.js"></script>
<script type="text/javascript" src="./js/jquery.textchildren.js"></script>
<link href="images/jquery.treeview.css" rel="stylesheet" type="text/css">
<link href="images/slickmap.css" rel="stylesheet" type="text/css">
<link href="images/jquery.orgchart.css" rel="stylesheet" type="text/css"/>
<?php if (! isset ( $_GET['print'] )): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "functions_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><br/>
    <div style="float:left">
        <fieldset>
            <legend><?php echo smarty_function_translate(array('label' => 'Organigrama functii'), $this);?>
</legend>
            <table cellspacing="0" cellpadding="0" width="100%" border="0" class="filter">
                <tr height="40">
                    <td style="padding-left: 4px;" width="75"><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
:</td>
                    <td style="padding-left: 2px;" width="70"><select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;"
                                                                      onchange="window.location.href = './?m=functions&o=organigram&CompanyID=' + document.getElementById('CompanyID').value + '&Level=' + document.getElementById('Level').value">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select></td>
                </tr>
                <tr height="40">
                    <td style="padding-left: 4px;" width="75"><?php echo smarty_function_translate(array('label' => 'Nivel'), $this);?>
:</td>
                    <td style="padding-left: 2px;" width="70"><select id="Level" name="Level" class="dropdown" style="width:120px;"
                                                                      onchange="window.location.href = './?m=functions&o=organigram&CompanyID=' + document.getElementById('CompanyID').value + '&mark=<?php echo $_GET['mark']; ?>
&mark2=<?php echo $_GET['mark2']; ?>
&mark3=<?php echo $_GET['mark3']; ?>
&Level=' + document.getElementById('Level').value">
                            <option value="-1"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['levels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Level']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select></td>
                </tr>
            </table>
            <br/><br/>
            <!-- Left Functions Tree -->
            <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <?php if (is_array ( $this->_tpl_vars['functions_tree'][$this->_tpl_vars['key']] )): ?>
                    <b><?php echo $this->_tpl_vars['item']; ?>
</b>
                    <br/>
                    <br/>
                    <div id="treecontrol_<?php echo $this->_tpl_vars['key']; ?>
"><a href="#"> <?php echo smarty_function_translate(array('label' => 'Restrange toate'), $this);?>
</a> | <a href="#"> <?php echo smarty_function_translate(array('label' => 'Extinde toate'), $this);?>
</a> | <a
                                href="#"><?php echo smarty_function_translate(array('label' => 'Revenire toate'), $this);?>
</a></div>
                    <ul id="browser_<?php echo $this->_tpl_vars['key']; ?>
" class="filetree">
                        <?php echo smarty_function_recurse_array(array('array' => $this->_tpl_vars['functions_tree'][$this->_tpl_vars['key']]), $this);?>

                    </ul>
                    <br/>
                    <br/>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </fieldset>
    </div>
<div style="float:left; width:50%;">
    <fieldset>
        <legend><?php echo smarty_function_translate(array('label' => 'Organigrama personal'), $this);?>
</legend>
        <a id="showHorizontal" class="selected" href="#"><?php echo smarty_function_translate(array('label' => 'Organigrama orizontala'), $this);?>
</a>
        [<a href="?m=functions&o=organigram&CompanyID=<?php echo $_GET['CompanyID']; ?>
&mark=<?php echo $_GET['mark']; ?>
&mark2=<?php echo $_GET['mark2']; ?>
&mark3=<?php echo $_GET['mark3']; ?>
&Level=<?php echo $_GET['Level']; ?>
&print=1">print</a>]
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a id="showVertical" href="#"><?php echo smarty_function_translate(array('label' => 'Organigrama verticala'), $this);?>
</a>
        [<a href="?m=functions&o=organigram&CompanyID=<?php echo $_GET['CompanyID']; ?>
&mark=<?php echo $_GET['mark']; ?>
&mark2=<?php echo $_GET['mark2']; ?>
&mark3=<?php echo $_GET['mark3']; ?>
&Level=<?php echo $_GET['Level']; ?>
&print=2">print</a>]
        <br/>
        <?php endif; ?> <!-- Horizontal organizational  -->
        <h2 style="margin-bottom:0;"><?php echo $_GET['mark2']; ?>
</h2>
        <div id="horizView" <?php if ($_GET['print'] == 2): ?> style="display:none;"<?php endif; ?>></div>
        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if (is_array ( $this->_tpl_vars['persons_tree'][$this->_tpl_vars['key']] )): ?>
                <ul id="horizTree_<?php echo $this->_tpl_vars['key']; ?>
" rel="<?php echo $this->_tpl_vars['item']; ?>
" style="display:none;"><br/><br/>
                    <?php echo smarty_function_recurse_array_horiz(array('array' => $this->_tpl_vars['persons_tree'][$this->_tpl_vars['key']]), $this);?>

                </ul>
                            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?> <!-- Vertical organizational  -->
        <div id="vertViewContainer" <?php if ($_GET['print'] != 2): ?> style="display:none;"<?php endif; ?>>
            <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <?php if (is_array ( $this->_tpl_vars['persons_tree'][$this->_tpl_vars['key']] )): ?>
                    <div style="float:left;">
                        <ul class="primaryNav col2"><br/><br/> <?php echo smarty_function_recurse_array_vert(array('array' => $this->_tpl_vars['persons_tree'][$this->_tpl_vars['key']]), $this);?>
                        </ul>
                    </div>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            <?php if (! isset ( $_GET['print'] )): ?>
        </div>
    </fieldset>
</div><?php endif; ?>
<script type="text/javascript">
    // script for functions organigram
    <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
    $(document).ready(function () {        $("#browser_<?php echo $this->_tpl_vars['key']; ?>
").treeview({
        animated: "fast",
        persist: "location",
        collapsed: true,
        control: "#treecontrol_<?php echo $this->_tpl_vars['key']; ?>
"            });        });
    <?php endforeach; endif; unset($_from); ?>
</script>
<?php echo '
    <script>        // script for people organigram
        $(function () {
            $("#showVertical").click(function () {
                $(this).addClass(\'selected\');
                $(\'#showHorizontal\').removeClass(\'selected\');
                $("#vertViewContainer").show();
                $("#horizView").hide();
                return false;
            });
            $("#showHorizontal").click(function () {
                $(this).addClass(\'selected\');
                $(\'#showVertical\').removeClass(\'selected\');
                $("#vertViewContainer").hide();
                $("#horizView").show();
                return false;
            });
        });
    </script>
'; ?>

<script type="text/javascript">
    <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
    $(function () {        $("#horizTree_<?php echo $this->_tpl_vars['key']; ?>
").orgChart({
        levels: -1,
        treeTitle: '<?php echo $this->_tpl_vars['item']; ?>
',
        stack: true,
        nodeText: function ($node) {
        return $node.textChildren();
        }}, $("#horizView"));        })
    ;
    <?php endforeach; endif; unset($_from); ?>
</script>