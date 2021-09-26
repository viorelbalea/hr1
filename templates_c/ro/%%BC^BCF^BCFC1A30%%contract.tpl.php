<?php /* Smarty version 2.6.18, created on 2021-04-05 07:47:59
         compiled from contract.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'contract.tpl', 3, false),array('function', 'orderby', 'contract.tpl', 131, false),array('function', 'math', 'contract.tpl', 150, false),array('modifier', 'default', 'contract.tpl', 53, false),array('modifier', 'date_format', 'contract.tpl', 159, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "contract_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta dupa'), $this);?>
:</label>
    <select id="ContractTypeID" name="ContractTypeID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['contract_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ContractTypeID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="PartnerID" name="PartnerID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Partener'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['usedPartners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['PartnerID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>

    <script>
        <?php echo '
        function selecteazaResponsabili(x) {
            $(\'#TechnicalPersonID\').hide();
            $(\'#FinanciarPersonID\').hide();
            if (x == 1) $(\'#TechnicalPersonID\').show();
            if (x == 2) $(\'#FinanciarPersonID\').show();
        }
        '; ?>

    </script>

    <select id="Responsabili" name="Responsabili" class="cod" onchange="selecteazaResponsabili(this.value)">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Resonsabili'), $this);?>
</option>
        <option value="1"><?php echo smarty_function_translate(array('label' => 'Responsabil tehnic'), $this);?>
</option>
        <option value="2"><?php echo smarty_function_translate(array('label' => 'Responsabil financiar'), $this);?>
</option>
    </select>
    <select id="TechnicalPersonID" name="TechnicalPersonID" class="cod" style="display:none;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Responsabil tehnic'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['contracts_technical_persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['TechnicalPersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="FinanciarPersonID" name="FinanciarPersonID" class="cod" style="display:none;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Responsabil financiar'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['contracts_financiar_persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['FinanciarPersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>

    </select>

    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="ContractName" <?php if ($_GET['search_for'] == 'ContractName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume contract'), $this);?>
</option>
        <option value="CompanyName" <?php if ($_GET['search_for'] == 'CompanyName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume partener'), $this);?>
</option>
        <option value="ContractNo" <?php if ($_GET['search_for'] == 'ContractNo'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar contract'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30"
           class="cod">
    <input id="apasa" type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=contract&ContractTypeID=' + document.getElementById('ContractTypeID').value +
	                                                                                                                         '&PartnerID=' + document.getElementById('PartnerID').value +
																 '&Responsabili=' + document.getElementById('Responsabili').value +
																 '&TechnicalPersonID=' + document.getElementById('TechnicalPersonID').value +
																 '&FinanciarPersonID=' + document.getElementById('FinanciarPersonID').value +
																 '&CompanyID=' + document.getElementById('CompanyID').value +
																 '&CompanyRole=' + document.getElementById('CompanyRole').value +
																 '&PaymentType=' + document.getElementById('PaymentType').value +
																 '&Coin=' + document.getElementById('Coin').value +
																 '&Status=' + document.getElementById('Status').value +
																 '&search_for=' + document.getElementById('search_for').value + 
																 '&keyword=' + escape(document.getElementById('keyword').value) + 
																 '&res_per_page=' + document.getElementById('res_per_page').value">

    <select id="CompanyID" name="CompanyID" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie self'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="CompanyRole" name="CompanyRole" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Rol self'), $this);?>
</option>
        <option value="Beneficiar" <?php if ($_GET['CompanyRole'] == 'Beneficiar'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Beneficiar'), $this);?>
</option>
        <option value="Furnizor" <?php if ($_GET['CompanyRole'] == 'Furnizor'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Furnizor'), $this);?>
</option>
    </select>
    <select id="PaymentType" name="PaymentType" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip plata'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['payment_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['PaymentType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Coin" name="Coin" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['coins']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['Coin']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Stare contract'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>

    <select id="res_per_page" nume="res_per_page" class="cod">
        <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select><label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'">
                </li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'">
                </li>
                <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Contract&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>

</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Nume contract','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'ContractName','asc_or_desc' => 'asc'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Contract']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Tip contract','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'ContractType'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Partener','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CompanyName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data inceput','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'StartDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Data sfarsit','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'StopDate'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Valoare','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'ContractValue'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'User','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'UserName'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['contracts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['contracts']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=contract&o=edit&ContractID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['ContractName']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Contract']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['ContractType']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ContractValue'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
 <?php echo $this->_tpl_vars['item']['Coin']; ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['item']['UserName']; ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest contract?'), $this);?>
')) window.location.href='./?m=contract&o=del&ContractID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['contracts'] ) == 1): ?>
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