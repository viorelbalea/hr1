<?php /* Smarty version 2.6.18, created on 2020-09-07 08:07:43
         compiled from report_149.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_149.tpl', 1, false),array('modifier', 'default', 'report_149.tpl', 1, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>    <div style="width:800px; margin:0px;">        <?php if ($this->_tpl_vars['info']['CompanyID'] && $this->_tpl_vars['info']['CompanyPhoto']): ?>            <table width="100%" border="0" cellspacing="0" cellpadding="0">                <tr width="100%">                    <td align="center"><img src="<?php echo $this->_tpl_vars['info']['CompanyPhoto']; ?>
"/></td>                </tr>            </table>            <br clear="all"/>        <?php endif; ?>        <p style="text-align:center; margin-top:0px;">            <b>DECIZIA</b><br/>            <b>NR. .............. / <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b><br/>        </p>        <div style="width:100%; margin:0px;  line-height:150%;">            <p style="text-indent:40px; text-align:justify; margin:0px;">                Subscrisa <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
 cu sediul social declarat in                <?php if ($this->_tpl_vars['info']['DistrictName'] == 'Bucuresti'): ?>Bucuresti<?php else: ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..........................') : smarty_modifier_default($_tmp, '..........................')); ?>
<?php endif; ?>,                str. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..........................') : smarty_modifier_default($_tmp, '..........................')); ?>
,                nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetNumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............') : smarty_modifier_default($_tmp, '..............')); ?>
                , <?php if ($this->_tpl_vars['info']['DistrictName'] == 'Bucuresti'): ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, 'sector ..............') : smarty_modifier_default($_tmp, 'sector ..............')); ?>
<?php else: ?>judetul <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............') : smarty_modifier_default($_tmp, '..............')); ?>
<?php endif; ?>,                inregistrata la Reg. Comertului cu nr.                <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RegComert'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
, CUI: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
,                reprezentata                prin <?php if ($this->_tpl_vars['info']['LegalFullName']): ?><?php if ($this->_tpl_vars['info']['LegalSex'] == 'M'): ?>domnul<?php else: ?>doamna<?php endif; ?> <?php echo $this->_tpl_vars['info']['LegalFullName']; ?>
<?php else: ?>domnul .....................................................<?php endif; ?>                , Director General,            </p>            <p style="text-indent:40px; text-align:justify; margin:0px;">                Avand in vedere ca salariatul, <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>Domnul<?php else: ?>Doamna<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
                a solicitat incetarea contractului de munca prin acordul partilor, prin cererea nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ResignationDemandNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '.........') : smarty_modifier_default($_tmp, '.........')); ?>
                / <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['info']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')))) ? $this->_run_mod_handler('default', true, $_tmp, '....................') : smarty_modifier_default($_tmp, '....................')); ?>
            </p>            <p style="text-indent:40px; text-align:justify; margin:0px;">                Vizand si dispozitiile art. 55 lit. b din Codul Muncii (Legea 53/2003);            </p>            <p style="text-align:center">                <b>DECIDE:</b>            </p>            <p style="text-indent:40px; text-align:justify; margin:0px;">                <b>Art. 1.</b> Angajatorul este de acord ca incepand cu data de <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['info']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')))) ? $this->_run_mod_handler('default', true, $_tmp, '.....................') : smarty_modifier_default($_tmp, '.....................')); ?>
 contractul individual de                munca al                <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>salariatului<?php else: ?>salariatei<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
, avand functia de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................') : smarty_modifier_default($_tmp, '...........................')); ?>
                in cadrul <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.....................') : smarty_modifier_default($_tmp, '.....................')); ?>
 sa inceteze conform <b>art. 55 lit. b</b> din Codul Muncii.            </p>            <p style="text-indent:40px; text-align:justify; margin:0px;">                <b>Art. 2.</b> Ducerea la indeplinire a prezentei decizii se efectueaza de catre Compartimentul resurse umane - personal.            </p>            <p style="text-indent:40px; text-align:justify; margin:0px;">                <b>Art. 3.</b> Impotriva prezentei decizii de incetare a contractului de munca, subsemnatul se poate adresa cu contestatie la Tribunalul                in a carui circumscriptie teritoriala se afla domiciliul angajatului in termen de 45 de zile de la comunicare.            </p>            <p style="text-align:left">                <b>DIRECTOR GENERAL,<br/>                    <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['LegalFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.................................') : smarty_modifier_default($_tmp, '.................................')); ?>
</b>            </p>        </div>        <p style="text-align:right">            Luat la cunostinta:<br/>            Salariat: <?php echo $this->_tpl_vars['info']['FullName']; ?>
<br/>            Semnatura:.....................<br/>            Data: <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
        </p>    </div><?php endif; ?>