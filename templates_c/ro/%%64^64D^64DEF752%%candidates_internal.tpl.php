<?php /* Smarty version 2.6.18, created on 2020-10-14 07:05:56
         compiled from candidates_internal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'candidates_internal.tpl', 3, false),array('function', 'orderby', 'candidates_internal.tpl', 181, false),array('function', 'math', 'candidates_internal.tpl', 210, false),array('modifier', 'default', 'candidates_internal.tpl', 34, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "candidates_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
:</label>
    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=candidates&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
            class="cod" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="CityID" name="CityID" class="cod" style="width:200px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="status" nume="status" class="cod">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
        <option value="LastName" <?php if ($_GET['search_for'] == 'LastName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</option>
        <option value="FirstName" <?php if ($_GET['search_for'] == 'FirstName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
</option>
        <option value="FullNameBeforeMariage" <?php if ($_GET['search_for'] == 'FullNameBeforeMariage'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
</option>
        <option value="CNP" <?php if ($_GET['search_for'] == 'CNP'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
        <option value="CVQualifRel" <?php if ($_GET['search_for'] == 'CVQualifRel'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Calificari relevante'), $this);?>
</option>
        <option value="Responsabilities" <?php if ($_GET['search_for'] == 'Responsabilities'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Responsabilitati'), $this);?>
</option>
        <option value="Company" <?php if ($_GET['search_for'] == 'Company'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="30" class="cod">
    <select id="PostId" name="PostId" class="cod">
        <option value="0">Post</option>
        <?php $_from = $this->_tpl_vars['Posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']['PostId']; ?>
" <?php if (( $this->_tpl_vars['item']['PostId'] == $_GET['PostId'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['PostName']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
" class="cod" onclick="window.location.href = './?m=candidates&DistrictID=' + document.getElementById('DistrictID').value +
    	                                                                                   '&CityID=' + document.getElementById('CityID').value + 
    	                                                                                   '&CVStatus=' + document.getElementById('CVStatus').value +
																						   '&Qualify=' + document.getElementById('Qualify').value +
																						   '&CVSource=' + document.getElementById('CVSource').value +
    	                                                                                   '&Sex=' + document.getElementById('Sex').value + 
																						   '&DomainIDStd=' + document.getElementById('DomainIDStd').value +
																						   '&DomainIDProf=' + document.getElementById('DomainIDProf').value +
																						   '&FunctionIDRecr=' + document.getElementById('FunctionIDRecr').value +
																						   '&FunctionIDRecrProf=' + document.getElementById('FunctionIDRecrProf').value +
    	                                                                                   '&Lang=' + document.getElementById('Lang').value + 
    	                                                                                   '&Localitate=' + document.getElementById('Localitate').value + 
    	                                                                                   '&Tara=' + document.getElementById('Tara').value + 
																						   '&Lang=' + document.getElementById('Lang').value + 
																						   '&ReadLevel=' + document.getElementById('ReadLevel').value +
																						   '&WriteLevel=' + document.getElementById('WriteLevel').value +
																						   '&SpeakLevel=' + document.getElementById('SpeakLevel').value +
    	                                                                                   '&search_for=' + document.getElementById('search_for').value + 
    	                                                                                   '&keyword=' + escape(document.getElementById('keyword').value) + 
																						   '&PostId=' +
																						   escape(document.getElementById('PostId').value) +
    	                                                                                   '&res_per_page=' + document.getElementById('res_per_page').value">
    <br/>
    <label><?php echo smarty_function_translate(array('label' => 'Cauta in CV'), $this);?>
:</label>
    <select id="Sex" name="Sex" class="cod">
        <option value=""><?php echo smarty_function_translate(array('label' => 'Sex'), $this);?>
</option>
        <option value="M" <?php if ($_GET['Sex'] == 'M'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Masculin'), $this);?>
</option>
        <option value="F" <?php if ($_GET['Sex'] == 'F'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Feminin'), $this);?>
</option>
    </select>
    <select id="CVStatus" name="CVStatus" class="cod" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Status CV'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['cvstatus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CVStatus']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="Qualify" id="Qualify" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Calificativ'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['qualify']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Qualify']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="CVSource" id="CVSource">
        <option value=""><?php echo smarty_function_translate(array('label' => 'Sursa CV'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['cvsource']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CVSource']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Lang" name="Lang">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Limbi straine'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Lang']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="ReadLevel" id="ReadLevel">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Citit'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['ReadLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="WriteLevel" id="WriteLevel">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Scris'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['WriteLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="SpeakLevel" id="SpeakLevel">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Vorbit'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['SpeakLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <br/><label><?php echo smarty_function_translate(array('label' => 'Experienta'), $this);?>
:</label>
    <select name="DomainIDProf" id="DomainIDProf" class="dropdown" style="width:120px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Domeniul'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['jobdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['DomainIDProf']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="FunctionIDRecrProf" id="FunctionIDRecrProf" class="dropdown" style="width:120px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['FunctionIDRecrProf']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Tara" name="Tara">
        <option value=""><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['tari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['Tara']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Localitate" name="Localitate">
        <option value=""><?php echo smarty_function_translate(array('label' => 'Localitatea'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['localitati']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['Localitate']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="DomainIDStd" id="DomainIDStd" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Studii in domeniul'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['jobdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['DomainIDStd']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select name="FunctionIDRecr" id="FunctionIDRecr" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Pozitie interes'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $_GET['FunctionIDRecr']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
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
    </select> <label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .xls" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .doc"
                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Candidate&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Nume','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'LastName','asc_or_desc' => 'asc'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Prenume','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FirstName'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Candidate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu">
                    <?php if ($this->_tpl_vars['field'] == 'AddressName'): ?>
                        <span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
</span>
                    <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                        <?php echo smarty_function_orderby(array('label' => 'Centru de cost','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CostCenters'), $this);?>

                    <?php else: ?>
                        <?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>

                    <?php endif; ?></td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Judet','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DistrictName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Oras','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CityName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Varsta','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'varsta'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'CNP','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CNP'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Status'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status CV','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CVStatus'), $this);?>
</td>
        <?php endif; ?>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Evaluari'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Export in personal'), $this);?>
</span></td>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['persons']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=candidates&o=edit&PersonID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['LastName']; ?>
</a></td>
                <td class="celulaMenuST"><a href="./?m=candidates&o=edit&PersonID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['FirstName']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Candidate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'MaritalStatus'): ?>
                                <?php echo $this->_tpl_vars['maritalstatus'][$this->_tpl_vars['item']['MaritalStatus']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CVStatus'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['cvstatus'][$this->_tpl_vars['item']['CVStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'RoleID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['roles'][$this->_tpl_vars['item']['RoleID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CityName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['varsta'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['cvstatus'][$this->_tpl_vars['item']['CVStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <?php endif; ?>
                <td class="celulaMenuST"><a href="./?m=candidates-eval&o=forms&PersonID=<?php echo $this->_tpl_vars['key']; ?>
"><?php echo smarty_function_translate(array('label' => 'Vezi evaluari'), $this);?>
</a></td>
                <td class="celulaMenuST"><?php if (empty ( $this->_tpl_vars['item']['ImportStatus'] ) && empty ( $this->_tpl_vars['item']['ExportedPersonID'] )): ?><a
                        href="./?m=candidates&o=export-person&PersonID=<?php echo $this->_tpl_vars['key']; ?>
"><?php echo smarty_function_translate(array('label' => 'Exporta'), $this);?>
</a><?php else: ?><a
                        href="./?m=persons&o=edit&PersonID=<?php echo $this->_tpl_vars['item']['ExportedPersonID']; ?>
"><?php echo smarty_function_translate(array('label' => 'Vezi in personal'), $this);?>
</a><?php endif; ?></td>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta persoana?'), $this);?>
')) window.location.href='./?m=candidates&o=del&PersonID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['persons'] ) == 1): ?>
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