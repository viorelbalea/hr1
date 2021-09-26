<?php /* Smarty version 2.6.18, created on 2020-09-02 09:33:35
         compiled from home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'home.tpl', 6, false),array('modifier', 'truncate', 'home.tpl', 28, false),)), $this); ?>
<table width="100%" cellspacing="0" cellpadding="0">
    <?php if (! empty ( $this->_tpl_vars['news1'] ) || ! empty ( $this->_tpl_vars['news2'] ) || ! empty ( $this->_tpl_vars['news3'] )): ?>
        <tr valign="top">
            <td width="30%" style="padding-top: 20px;">
                <form action="./" method="get">
                    <input type="text" name="keyword" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
..." size="20" onclick="if (this.value == '<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
...') this.value = '';">
                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
">
                </form>
            </td>
        </tr>
    <?php else: ?>
        <tr valign="top">
            <td align="center" height="500" style="padding-top: 100px;"><?php echo smarty_function_translate(array('label' => 'Bine ati venit!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <tr valign="top">
        <?php if (! empty ( $this->_tpl_vars['news1'] )): ?>
            <td width="30%" style="padding-top: 10px; padding-right:10px; border-right:solid 1px #999;">
                <h2><h2><?php echo $this->_tpl_vars['news_types']['1']; ?>
</h2></h2>
                <div style="height: 330px; padding-right:8px; overflow: auto;">
                    <?php $_from = $this->_tpl_vars['news1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i><?php echo $this->_tpl_vars['item']['data']; ?>
</i> - <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><strong><?php echo $this->_tpl_vars['item']['Title']; ?>
</strong></a>
                                <br>
                                <?php if ($this->_tpl_vars['item']['Image']): ?><img src="images/50/<?php echo $this->_tpl_vars['item']['Image']; ?>
" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" /><?php endif; ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 350) : smarty_modifier_truncate($_tmp, 350)); ?>
 <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </td>
        <?php endif; ?>
        <?php if (! empty ( $this->_tpl_vars['news2'] )): ?>
            <td width="30%" style="padding:10px 10px 0 10px; border-right:solid 1px #999;">
                <h2><h2><?php echo $this->_tpl_vars['news_types']['2']; ?>
</h2></h2>
                <div style="height: 330px; padding-right:8px; overflow: auto;">
                    <?php $_from = $this->_tpl_vars['news2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i><?php echo $this->_tpl_vars['item']['data']; ?>
</i> - <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><strong><?php echo $this->_tpl_vars['item']['Title']; ?>
</strong></a>
                                <br>
                                <?php if ($this->_tpl_vars['item']['Image']): ?><img src="images/50/<?php echo $this->_tpl_vars['item']['Image']; ?>
" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" /><?php endif; ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 350) : smarty_modifier_truncate($_tmp, 350)); ?>
 <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </td>
        <?php endif; ?>
        <?php if (! empty ( $this->_tpl_vars['news3'] )): ?>
            <td width="30%" style="padding-top: 10px; padding-left:10px;">
                <h2><h2><?php echo $this->_tpl_vars['news_types']['3']; ?>
</h2></h2>
                <div style="height:330px; padding-right:8px; overflow:auto;">
                    <?php $_from = $this->_tpl_vars['news3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <div align="justify" class="textcontent" style="padding-top: 20px;">
                                <i><?php echo $this->_tpl_vars['item']['data']; ?>
</i> - <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><strong><?php echo $this->_tpl_vars['item']['Title']; ?>
</strong></a>
                                <br>
                                <?php if ($this->_tpl_vars['item']['Image']): ?><img src="images/50/<?php echo $this->_tpl_vars['item']['Image']; ?>
" align="left" style="float:left; margin:5px 5px 5px 0; padding:1px; border:solid 1px #999;"
                                                     alt="" /><?php endif; ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 350) : smarty_modifier_truncate($_tmp, 350)); ?>
 <a href="<?php echo $this->_tpl_vars['request_uri']; ?>
&o=view&NewsID=<?php echo $this->_tpl_vars['item']['NewsID']; ?>
" class="blue"><b>&raquo;</b></a>
                            </div>
                            <br clear="left"/>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </td>
        <?php endif; ?>
    </tr>
</table>