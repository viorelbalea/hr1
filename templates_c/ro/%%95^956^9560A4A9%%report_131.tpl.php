<?php /* Smarty version 2.6.18, created on 2021-06-09 07:47:11
         compiled from report_131.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_131.tpl', 13, false),array('modifier', 'default', 'report_131.tpl', 14, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
    <div style="width:800px; margin:0px;">

        <?php if ($this->_tpl_vars['info']['CompanyID'] && $this->_tpl_vars['info']['CompanyPhoto']): ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr width="100%">
                    <td align="center"><img src="<?php echo $this->_tpl_vars['info']['CompanyPhoto']; ?>
"/></td>
                </tr>
            </table>
            <br clear="all"/>
        <?php endif; ?>

        <p style="text-align:center"><strong>ACT ADITIONAL NR. ............. / <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</strong><br/><br/><br/>
            La contractul individual de munca incheiat si inregistrat sub nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContractNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '.....') : smarty_modifier_default($_tmp, '.....')); ?>

            /<?php if (! empty ( $this->_tpl_vars['info']['ContractDate'] ) && $this->_tpl_vars['info']['ContractDate'] != '00.00.0000'): ?><?php echo $this->_tpl_vars['info']['ContractDate']; ?>
<?php else: ?>..................<?php endif; ?>
            in registrul de evidenta a salariatilor
            <br/><br/>
        </p>

        <p style="text-indent:40px;">Incheiat astazi <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
 intre:</p>

        <p style="text-indent:40px; text-align:justify;">
            Angajator - persoana juridica <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
 cu sediul in <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>

            , <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, '.....................................') : smarty_modifier_default($_tmp, '.....................................')); ?>
,
            inregistrata la Registrul Comertului din Bucuresti sub nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RegComert'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
, cod fiscal <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>

            , telefon <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberA'])) ? $this->_run_mod_handler('default', true, $_tmp, '......................') : smarty_modifier_default($_tmp, '......................')); ?>
, reprezentata legal prin <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['LegalFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '........................................') : smarty_modifier_default($_tmp, '........................................')); ?>
, in
            calitate de Director General
        </p>
        Si
        <p style="text-indent:40px; text-align:justify;">
            <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>Salariatul - Domnul<?php else: ?>Salariata - Doamna<?php endif; ?> <b><?php echo $this->_tpl_vars['info']['FullName']; ?>
</b>, <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>domiciliat<?php else: ?>domiciliata<?php endif; ?> in
            <strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Str. ................ Nr. ...., Bl. ...... Sc. ...., Et. ...., Ap ....., Judet/Sector ..............  ') : smarty_modifier_default($_tmp, 'Str. ................ Nr. ...., Bl. ...... Sc. ...., Et. ...., Ap ....., Judet/Sector ..............  ')); ?>
</strong>, <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>posesor al<?php else: ?>posesoare a<?php endif; ?>
            CI <strong>seria <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BISerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '.........') : smarty_modifier_default($_tmp, '.........')); ?>
 nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BINumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '....................') : smarty_modifier_default($_tmp, '....................')); ?>
</strong>, eliberata de
            <b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BIEmitent'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
</b>, la data de <b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BIStartDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '..................') : smarty_modifier_default($_tmp, '..................')); ?>
</b>,
            <b>CNP <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
</b>.
        </p>

        <p style="text-indent:40px; text-align:justify;">
            In temeiul art. 17 (4) coroborat cu art. 41 (1) din Legea nr. 53/2003, partile HOTARASC:
        </p>

        <p>
        <ol>
            <li>Se modifica elementul: <i>** DURATA CONTRACTULUI </i>al contractului individual de munca se prelungeste din data
                de <?php if (! empty ( $this->_tpl_vars['info']['ActeAd']['StartDate'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ActeAd']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>............................<?php endif; ?> pana in data
                de <?php if (! empty ( $this->_tpl_vars['info']['ActeAd']['StopDate'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ActeAd']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>...............................<?php endif; ?> .
            </li>
        </ol>
        </p>

        <p style="text-indent:40px; text-align:justify;">
            Prezentul act aditional a fost incheiat in 2 exemplare, cate un exemplar pentru fiecare parte, urmand sa-si produca efectele incepand cu data
            de <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 .
        </p>

        <br/><br/>

        <table width="100%" align="center" style="margin-bottom:0px;">
            <tr>
                <td width="50%"><strong>ANGAJATOR, </strong></td>
                <td width="50%" align="right"><strong>ANGAJAT, </strong></td>
            </tr>
            <tr>
                <td width="50%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
</td>
                <td width="50%" align="right"><?php echo $this->_tpl_vars['info']['FullName']; ?>
</td>
            </tr>
            <tr>
                <td width="50%">_______________________________</td>
                <td width="50%" align="right">_______________________________</td>
            </tr>
        </table>

    </div>
<?php endif; ?>