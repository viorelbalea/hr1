<?php /* Smarty version 2.6.18, created on 2021-07-13 07:13:57
         compiled from report_85.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'report_85.tpl', 18, false),array('modifier', 'date_format', 'report_85.tpl', 20, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
    <div style="width: 800px">

        <?php if ($this->_tpl_vars['info']['CompanyID']): ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="400">&nbsp;</td>
                    <td align="right"><img src="<?php echo $this->_tpl_vars['info']['CompanyPhoto']; ?>
"/></td>
                </tr>
            </table>
            <br clear="all"/>
        <?php endif; ?>

        <h3>Nr ........ Din .................</h3>
        <br>
        <h1 style="text-align: center;">ADEVERINTA</h1>
        <br>
        <p style="text-indent:20px;">Adeverim prin prezenta ca <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>d-l<?php else: ?>d-na<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
, avand CNP <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
,
            <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>posesor<?php else: ?>posesoare<?php endif; ?> a cartii de identitate seria si numarul <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BISerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BINumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
 eliberate
            de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BIEmitent'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
 la data de <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['info']['BIStartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')))) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
,
            domiciliat<?php if ($this->_tpl_vars['info']['Sex'] == 'F'): ?>a<?php endif; ?> in <?php echo $this->_tpl_vars['info']['PersonCity']; ?>
, strada <?php echo $this->_tpl_vars['info']['PersonStreet']; ?>
, nr.<?php echo $this->_tpl_vars['info']['PersonStreetNumber']; ?>
, bl. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonBl'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
,
            sc. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonSc'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
, et. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonEt'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
,
            apt. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonAp'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
<?php if ($this->_tpl_vars['info']['PersonDistrict'] != 'Bucuresti'): ?>, judetul <?php echo $this->_tpl_vars['info']['PersonDistrict']; ?>
<?php endif; ?> a
            fost <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>angajat al<?php else: ?>angajata a<?php endif; ?> <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '......................................................') : smarty_modifier_default($_tmp, '......................................................')); ?>
,
            CUI <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '........................') : smarty_modifier_default($_tmp, '........................')); ?>
, cu sediul social
            in <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................................................................................................') : smarty_modifier_default($_tmp, '..............................................................................................................')); ?>
, in baza contractului
            individual de munca inregistrat la ITM/REVISAL cu numarul <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContractNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '........') : smarty_modifier_default($_tmp, '........')); ?>

            / <?php if ($this->_tpl_vars['info']['ContractDate'] && $this->_tpl_vars['info']['ContractDate'] != '00.00.0000'): ?><?php echo $this->_tpl_vars['info']['ContractDate']; ?>
<?php else: ?>...............<?php endif; ?>.</p>
        <p style="text-indent:20px;">Pe durata executarii contractului individual de munca au intervenit urmatoarele mutatii (incheierea/modificarea/suspendarea/incetarea
            contractului de munca):</p>
        <br/>
        <table width="100%" border="1" cellspacing="0" cellpadding="3">
            <tr>
                <td>Nr. crt.</td>
                <td>Mutatia intervenita</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Anul</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Luna</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">Ziua</td>
                        </tr>
                    </table>
                </td>
                <td>Meseria/Functia</td>
                <td>Salariul de baza, <br/>inclusiv sporurile care intra<br/> in calculul punctajului<br/> mediu anual</td>
                <td>Nr. si data actului pe baza caruia<br/> se face inscrierea si temeiul legal</td>
            </tr>
            <tr>
                <td>1</td>
                <td>Incheiere</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;"><?php if ($this->_tpl_vars['info']['CM'] == 'Da'): ?>2011<?php else: ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StartDateYear'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?></td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;"><?php if ($this->_tpl_vars['info']['CM'] == 'Da'): ?>01<?php else: ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StartDateMonth'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?></td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;"><?php if ($this->_tpl_vars['info']['CM'] == 'Da'): ?>01<?php else: ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StartDateDay'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?></td>
                        </tr>
                    </table>
                </td>
                <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CurrSalary'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td>Contract <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContractNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '........') : smarty_modifier_default($_tmp, '........')); ?>

                    / <?php if (! empty ( $this->_tpl_vars['info']['ContractDate'] ) && $this->_tpl_vars['info']['ContractDate'] != '00.00.0000'): ?><?php echo $this->_tpl_vars['info']['ContractDate']; ?>
<?php else: ?>...............<?php endif; ?></td>
            </tr>
            <tr>
                <td>2</td>
                <td>&nbsp;</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>3</td>
                <td>&nbsp;</td>
                <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border-bottom:solid 1px #333;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>

        <p style="text-indent:20px;">Contractul individual de munca al <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>d-nului<?php else: ?>d-nei<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
 inceteaza la data
            de <?php if ($this->_tpl_vars['info']['fStopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['fStopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>..........................<?php endif; ?>, in baza prevederilor art.55 lit.b, din Legea
            nr.53/2003 - Codul muncii, modificata si completata, astfel cum rezulta din decizia nr. ................................ .</p>
        <p style="text-indent:20px;">Mentionam ca <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>angajatul<?php else: ?>angajata<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
 a fost <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>incadrat<?php else: ?>incadrata<?php endif; ?> pe
            codul COR nr. <?php echo $this->_tpl_vars['info']['CodCor']; ?>
 - <?php echo $this->_tpl_vars['info']['NumeCor']; ?>
.</p>
        <p style="text-indent:20px;">S-a eliberat prezenta in baza documentelor detinute de angajator, pentru stabilirea vechimii in munca dupa ......................</p>
        <br>
        <p align="left">Reprezentant legal,<br/>
            <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['LegalFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '...............................') : smarty_modifier_default($_tmp, '...............................')); ?>
</p><br/><br/><br/>
        <p align="left"> Sef departament Resurse Umane,<br/><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['HRFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '................................') : smarty_modifier_default($_tmp, '................................')); ?>
<br></p>
        <br/>
    </div>
<?php endif; ?>