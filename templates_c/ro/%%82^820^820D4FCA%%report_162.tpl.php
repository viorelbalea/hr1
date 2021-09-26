<?php /* Smarty version 2.6.18, created on 2021-08-17 10:06:32
         compiled from report_162.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'report_162.tpl', 7, false),array('modifier', 'date_format', 'report_162.tpl', 10, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
    <div style="width:800px; margin:0px;">

        <p style="text-align:left; margin:0px;">
            ANEXA 1^1
            <br/><br/>
            Denumirea angajatorului <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
<br/>
            Cod Fiscal (CUI/CNP angajator/persoana fizica): <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '......................................') : smarty_modifier_default($_tmp, '......................................')); ?>
<br/>
            Nr. de inregistrare la registrul comertului: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RegComert'])) ? $this->_run_mod_handler('default', true, $_tmp, '........................') : smarty_modifier_default($_tmp, '........................')); ?>
<br/>
            <b>Nr. ............. / <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b>
        </p>
        <br/>

        <p style="text-align:center; font-size:14pt;"><b>ADEVERINTA</b></p>

        <br/>

        <p style="text-indent:0px; text-align:left; margin:0px;">
            Prin prezenta se certifica faptul ca <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>domnul<?php else: ?>doamna<?php endif; ?> <?php echo $this->_tpl_vars['info']['FullName']; ?>
, cnp <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '................................') : smarty_modifier_default($_tmp, '................................')); ?>
, act
            de<br/>
            identitate seria <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BISerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '.........') : smarty_modifier_default($_tmp, '.........')); ?>
 nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BINumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '...............') : smarty_modifier_default($_tmp, '...............')); ?>
, eliberat de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BIEmitent'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>

            la data de <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['info']['BIStartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')))) ? $this->_run_mod_handler('default', true, $_tmp, '..................') : smarty_modifier_default($_tmp, '..................')); ?>
, cu domiciliul in<br/>
            <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, '......................') : smarty_modifier_default($_tmp, '......................')); ?>
, are calitatea de salariat si <b>i s-a retinut si virat lunar conributia pentru asigurari sociale de sanatate</b>,
            potrivit Legii nr. 95/2006 privind reforma in domeniul sanatatii, cu modificarile si completarile ulterioare.
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            Persoana mai sus mentionata figureaza in evidentele noastre cu urmatorii coasigurati (sot/sotie, parinti, aflati in intretinere):<br/>
            <?php if (! empty ( $this->_tpl_vars['info']['Coasig'] )): ?>
                <?php echo $this->_tpl_vars['info']['Coasig']; ?>

            <?php else: ?>
                .........................................................................................................................................................................
            <?php endif; ?>
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            Prezenta adeverinta are o valabilitate de 3 luni de la data emiterii. Sub sanctiunile aplicate faptei de fals in acte publice,<br/>
            declar ca datele din adeverinta sunt corecte si complete.
        </p>
        <br/>
        <p style="text-indent:0px; text-align:left; margin:0px;">
            <b>Numarul de zile de concediu medical</b> de care <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>angajatul<?php else: ?>angajata<?php endif; ?> <b>a beneficiat in ultimele 12 luni</b> este<br/>
            de <?php echo $this->_tpl_vars['info']['CM']['0']; ?>
 zile, pana la data <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 aferente fiecarei afectiuni in parte*, dupa cum urmeaza:
        </p>

        <br/>

        <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr>
                <td width="30%" align="center"><b>Cod indemnizatie</b></td>
                <td width="70%" align="center"><b>Numar zile concediu medical in ultimele 12 luni</b></td>
            </tr>
            <?php $_from = $this->_tpl_vars['info']['CM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['cm']):
?>
                <?php if ($this->_tpl_vars['k'] > 0): ?>
                    <tr>
                        <td><?php echo $this->_tpl_vars['cm']['CodInd']; ?>
</td>
                        <td><?php echo $this->_tpl_vars['cm']['DaysNo']; ?>
</td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </table>

        <br/><br/>

        <table width="100%" align="center">
            <tr>
                <td width="65%">Reprezentant legal<br/><br/></td>
            </tr>
            <tr>
                <td width="65%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['LegalFullName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.................') : smarty_modifier_default($_tmp, '.................')); ?>
<br/><br/>(semnatura si stampila)</td>
            </tr>
        </table>

        <br/>
        ------------
        <p style="text-indent:0px; text-align:left; margin:0px; font-size: 10px;">
            Anexa 1^1 a a fost introdusa de pct. 9 al art. I din ORDINUL nr. 903 din 19 noiembrie 2007, publicat in MONITORUL OFICIAL nr. 827 din 4 decembrie 2007.<br/>
            *Art.8, ORDINUL MS/CNAS nr. 130/351 din 9 februarie 2011 privind modificarea si completarea Normelor de aplicare a prevederilor Ordonantei de urgenta a Guvernului nr.
            158/2005
            privind concediile si indemnizatiile de asigurari sociale de sanatate, aprobate prin Ordinul ministrului sanatatii si presedintelui Casei nationale de Asigurari de
            Sanatate nr. 60/32/2006,
            publicat in MONITORUL OFICIAL nr. 141 din 24 februarie 2011
        </p>
    </div>
<?php endif; ?>