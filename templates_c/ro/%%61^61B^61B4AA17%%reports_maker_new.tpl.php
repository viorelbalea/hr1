<?php /* Smarty version 2.6.18, created on 2020-10-06 16:48:57
         compiled from reports_maker_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'reports_maker_new.tpl', 35, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reports_maker_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! empty ( $_POST )): ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reports_maker_new_view.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php else: ?>
    <script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="./js/jquery.coolMultiple.js"></script>
<?php echo '
    <style>
        .coolmulti-scrollbox {
            background: none repeat scroll 0 0 #FFFFFF;
            float: left;
            height: 250px;
            margin-bottom: 5px;
            overflow-y: auto;
            padding: 5px 0;
            text-decoration: none;
            width: 250;
        }

        .coolmulti-values {
            display: none;
            float: left;
            font-weight: bold;
            margin-left: 15px;
            width: 300;
        }
    </style>
'; ?>

    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
            <tr>
                <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Raport nou'), $this);?>
</span> <br></td>
            </tr>
            <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                <?php if ($this->_foreach['iter']['iteration']%4 == 1): ?><tr><?php endif; ?>
                <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</legend>
                        <div>
                            <select name="Fields[<?php echo $this->_tpl_vars['key']; ?>
][]" id="Fields<?php echo $this->_tpl_vars['key']; ?>
" multiple="multiple">
                                <?php $_from = $this->_tpl_vars['fields'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if (in_array ( $this->_tpl_vars['key2'] , $_SESSION['REPORT_MAKER']['FIELDS'][$this->_tpl_vars['key']] )): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']), $this);?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </div>
                    </fieldset>
                </td>
                <?php if ($this->_foreach['iter']['iteration']%4 == 0 || ($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?></tr><?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </table>
        <div align="center"><input type="submit" name="generate" value="<?php echo smarty_function_translate(array('label' => 'Genereaza raport'), $this);?>
"></div>
    </form>
    <script language="JavaScript" type="text/javascript">
        <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        $('#Fields<?php echo $this->_tpl_vars['key']; ?>
').coolMultiple();
        <?php endforeach; endif; unset($_from); ?>
    </script>
    <script type="text/javascript">
        $().ready(function () {
            $('form').hide();
            $(':form [name="<?php echo $_GET['list']; ?>
"]').show();
            });

        function refresh_opener() {
            window.opener.document.location.reload();
            }
    </script>
<?php endif; ?>