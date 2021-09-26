<?php /* Smarty version 2.6.18, created on 2020-09-02 09:33:38
         compiled from _paginate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', '_paginate.tpl', 3, false),)), $this); ?>
<table border="0" cellpadding="0" cellspacing="0">
    <tr align="center">
        <td width="100" align="left" class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'Pagina'), $this);?>
 <?php echo $this->_tpl_vars['pag_current']; ?>
/<?php echo $this->_tpl_vars['nr_pages']; ?>
</td>
        <?php if ($this->_tpl_vars['nr_pages'] > 1): ?>
            <?php if ($this->_tpl_vars['limit_jos'] == 1): ?>
                <?php if ($this->_tpl_vars['pag_back'] > 1): ?>
                    <td width="22"><a href="<?php echo $this->_tpl_vars['url1']; ?>
"><img src="./images/doublebackarrow.png" border="0"/></a></td>
                <?php endif; ?>
                <td width="22"><a href="<?php echo $this->_tpl_vars['url_grup_jos']; ?>
"><img src="./images/backarrow.png" border="0"/></a></td>
            <?php endif; ?>

            <?php unset($this->_sections['tmp']);
$this->_sections['tmp']['name'] = 'tmp';
$this->_sections['tmp']['loop'] = is_array($_loop=$this->_tpl_vars['urls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tmp']['show'] = true;
$this->_sections['tmp']['max'] = $this->_sections['tmp']['loop'];
$this->_sections['tmp']['step'] = 1;
$this->_sections['tmp']['start'] = $this->_sections['tmp']['step'] > 0 ? 0 : $this->_sections['tmp']['loop']-1;
if ($this->_sections['tmp']['show']) {
    $this->_sections['tmp']['total'] = $this->_sections['tmp']['loop'];
    if ($this->_sections['tmp']['total'] == 0)
        $this->_sections['tmp']['show'] = false;
} else
    $this->_sections['tmp']['total'] = 0;
if ($this->_sections['tmp']['show']):

            for ($this->_sections['tmp']['index'] = $this->_sections['tmp']['start'], $this->_sections['tmp']['iteration'] = 1;
                 $this->_sections['tmp']['iteration'] <= $this->_sections['tmp']['total'];
                 $this->_sections['tmp']['index'] += $this->_sections['tmp']['step'], $this->_sections['tmp']['iteration']++):
$this->_sections['tmp']['rownum'] = $this->_sections['tmp']['iteration'];
$this->_sections['tmp']['index_prev'] = $this->_sections['tmp']['index'] - $this->_sections['tmp']['step'];
$this->_sections['tmp']['index_next'] = $this->_sections['tmp']['index'] + $this->_sections['tmp']['step'];
$this->_sections['tmp']['first']      = ($this->_sections['tmp']['iteration'] == 1);
$this->_sections['tmp']['last']       = ($this->_sections['tmp']['iteration'] == $this->_sections['tmp']['total']);
?>
                <?php if ($this->_tpl_vars['urls'][$this->_sections['tmp']['index']] != ''): ?>
                    <td width="13" align="center" valign="middle">
                        <a href="<?php echo $this->_tpl_vars['urls'][$this->_sections['tmp']['index']]; ?>
" class="white"><?php echo $this->_tpl_vars['pages'][$this->_sections['tmp']['index']]; ?>
</a>
                    </td>
                    <?php if (! $this->_sections['tmp']['last']): ?>
                        <td width="1" align="center" style="color:#F8F9F8;">|</td>
                    <?php endif; ?>
                <?php else: ?>
                    <td width="13" align="center" valign="middle">
                        <span class="TitleBoxDown"><b><?php echo $this->_tpl_vars['pages'][$this->_sections['tmp']['index']]; ?>
</b></span>
                    </td>
                    <?php if (! $this->_sections['tmp']['last']): ?>
                        <td width="1" align="center" style="color:#F8F9F8;">|</td>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; endif; ?>
            <?php if ($this->_tpl_vars['limit_sus'] == 1): ?>
                <td width="22"><a href="<?php echo $this->_tpl_vars['url_grup_sus']; ?>
"><img src="./images/nextarrow.png" border="0"/></a></td>
                <?php if ($this->_tpl_vars['nr_pages'] != $this->_tpl_vars['pag_next']): ?>
                    <td width="22"><a href="<?php echo $this->_tpl_vars['urllast']; ?>
"><img src="./images/doublenextarrow.png" border="0"/></a></td>
                <?php endif; ?>
            <?php endif; ?>
            <td class="TitleBoxDown">&nbsp;&nbsp;<?php echo smarty_function_translate(array('label' => 'Mergi la pagina'), $this);?>
 :&nbsp;
                <input type="text" name="goto" id="goto" value="<?php if ($_GET['page']): ?><?php echo $_GET['page']; ?>
<?php else: ?>1<?php endif; ?>" style="width:35px; text-align:center;"/>
                <input type="image" align="texttop" src="./images/go.png" onclick="
                        var page_nr=document.getElementById('goto').value;
                        if(isNaN(page_nr) || page_nr<1) alert('<?php echo smarty_function_translate(array('label' => 'Trebuie sa introduceti o valoare numerica pozitiva!'), $this);?>
');
                        else if(page_nr><?php echo $this->_tpl_vars['nr_pages']; ?>
) alert('<?php echo smarty_function_translate(array('label' => 'Valoarea introdusa este mai mare decat numarul de pagini (%s)!','values' => $this->_tpl_vars['nr_pages']), $this);?>
');
                        else window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&page='+page_nr; return false;"/>
            </td>
        <?php endif; ?>

    </tr>
</table>