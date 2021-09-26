<?php /* Smarty version 2.6.18, created on 2020-09-02 08:46:59
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'md5', 'index.tpl', 69, false),array('modifier', 'date_format', 'index.tpl', 85, false),array('function', 'translate', 'index.tpl', 77, false),)), $this); ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>HR Executive</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="images/<?php echo $this->_tpl_vars['theme']; ?>
" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="images/layer.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="images/jquery.qtip.css">
    <!--[if IE]>
    <link rel="stylesheet" href="images/layer-ie.css" type="text/css"/>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="images/jquery.selectbox.css"/>
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="images/jquery.confirm.css"/>
    <link rel="stylesheet" type="text/css" href="images/jquery-ui.css"/>
    <script language="javascript" src="js/functions.js"></script>
    <script language="javascript" src="js/checkdate.js"></script>
    <script language="javascript" src="js/CalendarPopup.js"></script>
    <script language="javascript" src="js/jquery.min.js"></script>
    <script language="javascript" src="js/jquery-migrate-1.2.1.js"></script>
    <script language="javascript" src="js/jquery.qtip.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/arnklint-jquery-contextMenu-f1f6648/jquery.contextMenu.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.selectbox-0.6.1.js"></script>
    <script language="javascript" src="js/jquery.confirm.js"></script>
    <link rel="stylesheet" type="text/css" href="images/autosuggest.css"/>
    <?php if (! empty ( $this->_tpl_vars['prototype'] )): ?>
        <script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
        <script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
    <?php endif; ?>
    <?php if (! empty ( $this->_tpl_vars['autocomplete'] )): ?>
        <script language="javascript" src="js/utilities.js"></script>
        <script language="javascript" src="js/jquery.autosuggest.js"></script>
        <link href="images/autosuggest.css" rel="stylesheet" type="text/css">
    <?php endif; ?>
    <?php echo '
        <script type="text/javascript">
            //$(document).ready(function() {
            //$("select[multiple!=\'multiple\']").css("visibility", "hidden");
            //$("select[multiple!=\'multiple\']").selectbox();
            /*$("select").each(function(){
                if(!$(this).attr(\'multiple\'))
                    $(this).selectbox();
            });*/
            //});
        </script>
    '; ?>

</head>

<?php if (! empty ( $_GET['m'] ) && ( $_GET['m'] == 'reports' || $_GET['m'] == 'functions' ) && ! empty ( $_GET['print'] )): ?>
    <body onLoad="window.print();">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['center_file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </body>
<?php else: ?>

    <?php if (! empty ( $_SESSION['USER_ID'] )): ?>
        <body>

        <div class="topTableWrapper">
            <table class="topTable" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td class="logoLeftCell">
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>
"><img src="images/logo.png" border="0" align="bottom"></a>
                    </td>
                    <td class="logoRightCell" align="right">
                        <div class="lrcWrapper">
                            <div class="borderRight">
                                <?php if (! empty ( $_SESSION['PERS'] )): ?>
                                    <img src="photos/persons/<?php echo ((is_array($_tmp=$_SESSION['PERS'])) ? $this->_run_mod_handler('md5', true, $_tmp) : md5($_tmp)); ?>
.jpg" width="34" height="34"/>
                                <?php endif; ?>
                                <span class="TextSus"><b><?php echo $_SESSION['USER_NAME']; ?>
</b></span>
                                <?php if (empty ( $_SESSION['PERS'] )): ?>
                                    &nbsp;|&nbsp;
                                <?php else: ?>
                                    <br/>
                                <?php endif; ?>
                                <a class="logoutLink" href="./?doLogout=1"><?php echo smarty_function_translate(array('label' => 'Logout'), $this);?>
</a>
                                <?php if (empty ( $_SESSION['PERS'] )): ?>
                                    <br/>
                                    <a href="./?doChangePasswd=1"><?php echo smarty_function_translate(array('label' => 'Schimbare parola'), $this);?>
</a>
                                <?php endif; ?>
                            </div>
                            <div class="currentDate">
                                <div class="currentDay">
                                    <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d') : smarty_modifier_date_format($_tmp, '%d')); ?>

                                </div>
                                <div class="monthYearBlock">
                                    <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>

                                    <br/>
                                    <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B') : smarty_modifier_date_format($_tmp, '%B')); ?>

                                </div>
                            </div>
                            <div style="clear: both; float: none;"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td height="27" valign="top" class="borderMenu">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr height="20">
                            <td style="padding-left: 20px;"><a href="./" class="<?php if (empty ( $_GET['m'] )): ?>meniuSusOn<?php else: ?>meniuSus<?php endif; ?>"><?php echo smarty_function_translate(array('label' => 'Home'), $this);?>
</a>
                            </td>
                            <?php $_from = $this->_tpl_vars['modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <?php if ($this->_tpl_vars['key'] != 33): ?>
                                    <?php if (! empty ( $this->_tpl_vars['modules_txt'][$this->_tpl_vars['key']] ) && ( $_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_RIGHTS'] ) )): ?>
                                        <td><a
                                                    href="./?m=<?php echo $this->_tpl_vars['item']; ?>
<?php if ($this->_tpl_vars['item'] == 'pontaj'): ?>&o=psimple<?php endif; ?>"
                                                    class="<?php if ($_GET['m'] == $this->_tpl_vars['item']): ?>meniuSusOn<?php else: ?>meniuSus<?php endif; ?>"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['modules_txt'][$this->_tpl_vars['key']]), $this);?>
</a>
                                        </td>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                            <?php if (! empty ( $_SESSION['PERS'] )): ?>
                                <td><a
                                        href="./?m=persons&o=auth&PersonID=<?php echo $_SESSION['PERS']; ?>
"
                                        class="<?php if ($_GET['o'] == 'auth'): ?>meniuSusOn<?php else: ?>meniuSus<?php endif; ?>"><?php echo smarty_function_translate(array('label' => 'Date autentificare'), $this);?>
</a>
                                </td><?php endif; ?>
                        </tr>
                    </table>
                </td>
                <td height="27" colspan="2" valign="top" class="borderMenu" align="right" style="padding-right: 20px;">
                    <a href="./?m=help"
                       class="<?php if ($_GET['m'] == 'help'): ?>meniuSusOn<?php else: ?>meniuSus<?php endif; ?>" style="float:right"><?php echo smarty_function_translate(array('label' => 'Help'), $this);?>
</a>
                    <?php if ($_SESSION['USER_ID'] == 1): ?>
                        <a href="./?m=admin" class="<?php if ($_GET['m'] == 'admin'): ?>meniuSusOn<?php else: ?>meniuSus<?php endif; ?>" style="float:right"><?php echo smarty_function_translate(array('label' => 'Admin'), $this);?>
</a>
                    <?php endif; ?>

                </td>
            </tr>
        </table>
        <div class="zoneDetails">
            <div class="zoneName"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['areas'][$_SESSION['AREA_ID']]), $this);?>
</div>
            <select class="styled" name="area_id" onChange="window.location.href = './?area_id=' + this.value">
                <?php $_from = $this->_tpl_vars['areas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                            <?php if ($this->_tpl_vars['key'] == $_SESSION['AREA_ID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>

        </div>
        <div class="contentTable">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['center_file'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr align="center">
                <td>
                    <hr class="maincolor">
                </td>
            </tr>
            <tr align="center" height="15">
                <td>&copy; 2009 - <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y') : smarty_modifier_date_format($_tmp, '%Y')); ?>
 HR
                    Executive. <?php echo smarty_function_translate(array('label' => 'Toate drepturile rezervate'), $this);?>
</td>
            </tr>
        </table>
        </body>
    <?php elseif (isset ( $_GET['doRecoverPassword'] )): ?>
        <body onLoad="document.getElementById('username').focus();">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "recoverPassword.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </body>
    <?php else: ?>
        <body onLoad="document.getElementById('username').focus();">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "login.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </body>
    <?php endif; ?>
<?php endif; ?>

<div class="container" style="display:none;">
    <div class="my-sticky-element"><a href="#" onclick=" $('.container').hide(); <?php echo '$(\'body\').animate({scrollTop:0},\'slow\');'; ?>
">
            <img src="images/gotop.png" style="border:0; border-radius:10px 10px 0 0;"></a></div>
</div>
<script>
    <?php echo '
    //store the element
    var cache = jQuery(\'.my-sticky-element\');

    //store the initial position of the element
    var vTop = cache.offset().top - parseFloat(cache.css(\'margin-top\').replace(/auto/, 0));
    jQuery(window).scroll(function (event) {
        // what the y position of the scroll is
        var y = jQuery(this).scrollTop();

        // whether that\'s below the form
        if (y >= vTop + 10) {
            // if so, ad the fixed class
            cache.addClass(\'stuck\');
            jQuery(\'.container\').show();
        } else {
            // otherwise remove it
            cache.removeClass(\'stuck\');
            jQuery(\'.container\').show();
        }
    });


    // Inlocuire tooltips cu model custom. vezi clasa jquery.qtip.css .qtip.default si .qtip.content


    function tooltip_custom() {


        jQuery(\'a[title]\').qtip({

            position: {
                viewport: jQuery(window),
                target: \'mouse\',
                adjust: {
                    method: \'flip\',
                    x: 15,
                    y: 15,
                    mouse: false
                }
            },
            show: {
                effect: function () {
                    jQuery(this).fadeTo(200, 1);
                }
            },
            hide: {
                effect: function () {
                    jQuery(this).slideUp(200);
                }
            }
        });

        jQuery(\'p[title]\').qtip({

            position: {
                viewport: jQuery(window),
                target: \'mouse\',
                adjust: {
                    method: \'flip\',
                    x: 15,
                    y: 15,
                    mouse: false
                }
            },
            show: {
                effect: function () {
                    jQuery(this).fadeTo(200, 1);
                }
            },
            hide: {
                effect: function () {
                    jQuery(this).slideUp(200);
                }
            }
        });
    }

    jQuery(document).ready(
        function () {
            tooltip_custom();
        }
    );
</script>
'; ?>



</html>