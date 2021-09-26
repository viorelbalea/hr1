<?php /* Smarty version 2.6.18, created on 2020-10-14 07:05:56
         compiled from dashboard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dashboard.tpl', 5, false),array('function', 'orderby', 'dashboard.tpl', 186, false),array('modifier', 'strip_tags', 'dashboard.tpl', 18, false),array('modifier', 'date_format', 'dashboard.tpl', 18, false),array('modifier', 'str_replace', 'dashboard.tpl', 21, false),array('modifier', 'truncate', 'dashboard.tpl', 21, false),array('modifier', 'default', 'dashboard.tpl', 223, false),)), $this); ?>
<table width="100%" border="0">

    <tr>

        <td width="50%" valign="top"><h3><?php echo smarty_function_translate(array('label' => 'Bugete'), $this);?>
</h3>

            <img src="graphs/dashboard_total_graph.png"/>

        </td>

        <td width="35%" valign="top"><h3><?php echo smarty_function_translate(array('label' => 'Alerte'), $this);?>
</h3>

            <div style="height:420px; overflow:auto;">

                <table width="100%" border="0">
                    <?php $_from = $this->_tpl_vars['alerts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <tr>
                            <td><b><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Subject'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</b> | <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['FullName'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
 | <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['CreateDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%D") : smarty_modifier_date_format($_tmp, "%D")))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</td>
                        </tr>
                        <tr>
                            <td><p style="margin-top:0;" title="<?php echo ((is_array($_tmp='<br />')) ? $this->_run_mod_handler('str_replace', true, $_tmp, '', $this->_tpl_vars['item']['Message']) : str_replace($_tmp, '', $this->_tpl_vars['item']['Message'])); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['item']['Message'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 280) : smarty_modifier_truncate($_tmp, 280)))) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>
</p></td>
                        </tr>
                        <?php endforeach; else: ?>
                        <?php echo smarty_function_translate(array('label' => 'Nu exista inregistrari!'), $this);?>

                    <?php endif; unset($_from); ?>
                </table>

            </div>

        </td>

        <td width="15%" valign="top"><h3><?php echo smarty_function_translate(array('label' => 'Tichete'), $this);?>
</h3>

            <div style="height:420px; overflow:auto;">


                <table width="100%" border="0">

                    <tr>

                        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</b></td>

                        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Numar'), $this);?>
</b></td>

                    </tr>

                    <?php $_from = $this->_tpl_vars['dashboard_tickets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <tr>

                                <td><?php echo $this->_tpl_vars['item']['StatusName']; ?>
</td>

                                <td><a href="./?m=ticketing&Status=|<?php echo $this->_tpl_vars['key']; ?>
|" target="_blank"><?php echo $this->_tpl_vars['item']['NoTickets']; ?>
</a></td>

                            </tr>
                        <?php endif; ?>

                        <?php endforeach; else: ?>
                        <tr>

                            <td colspan="2"><?php echo smarty_function_translate(array('label' => 'Nu exista inregistrari!'), $this);?>
</td>

                        </tr>
                    <?php endif; unset($_from); ?>

                    <?php if ($this->_tpl_vars['dashboard_tickets']['0']): ?>
                        <tr>

                            <td><b><?php echo smarty_function_translate(array('label' => 'Total'), $this);?>
</b></td>

                            <td><?php echo $this->_tpl_vars['dashboard_tickets']['0']; ?>
</td>

                        </tr>
                    <?php endif; ?>

                </table>

            </div>

        </td>

    </tr>

    <tr>

        <!-- Angajati -->

        <td width="50%" valign="top">

            <div style="height:250px; overflow:auto;">

                <h3><?php echo smarty_function_translate(array('label' => 'Angajati la data'), $this);?>
 <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</h3>

                <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">

                    <!-- Fields -->

                    <tr>

                        <td rowspan="2" class="bkdTitleMenu"><b>#</b></td>

                        <td rowspan="2" class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</b></td>

                        <td colspan="3" align="center" class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Angajati'), $this);?>
</b></td>

                        <td rowspan="2" align="center" class="bkdTitleMenu"><b title="<?php echo smarty_function_translate(array('label' => 'Colaboratori'), $this);?>
"><?php echo smarty_function_translate(array('label' => 'Colab.'), $this);?>
</b></td>

                        <td colspan="2" align="center" class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'In AN curent'), $this);?>
</b></td>


                    </tr>

                    <tr>

                        <td class="bkdTitleMenu"><b title="<?php echo smarty_function_translate(array('label' => 'Determinat'), $this);?>
"><?php echo smarty_function_translate(array('label' => 'Det.'), $this);?>
</b></td>

                        <td class="bkdTitleMenu"><b title="<?php echo smarty_function_translate(array('label' => 'Nedeterminat'), $this);?>
"><?php echo smarty_function_translate(array('label' => 'NeDet.'), $this);?>
</b></td>

                        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Total'), $this);?>
</b></td>

                        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'In'), $this);?>
</b></td>

                        <td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Out'), $this);?>
</b></td>

                    <tr>


                        <!-- Values -->

                        <?php $_from = $this->_tpl_vars['dashboard_employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ename'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ename']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ekey'] => $this->_tpl_vars['emp']):
        $this->_foreach['ename']['iteration']++;
?>

                    <tr>

                        <td><?php echo $this->_foreach['ename']['iteration']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['CompanyName']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['NoEmployeesDet']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['NoEmployeesUndet']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['TotalEmployees']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['TotalCollaborators']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['TotalIN']; ?>
</td>

                        <td><?php echo $this->_tpl_vars['emp']['TotalOUT']; ?>
</td>

                    </tr>

                    <?php endforeach; else: ?>

                    <tr height="30">
                        <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu exista inregistrari!'), $this);?>
</td>
                    </tr>

                    <?php endif; unset($_from); ?>

                </table>

            </div>

        </td>

        <!-- Concedii -->

        <td width="50%" valign="top" colspan="2">

            <div style="height:250px; overflow:auto;">

                <h3><?php echo smarty_function_translate(array('label' => 'Concedii la data'), $this);?>
 <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</h3>

                <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1">

                    <tr>

                        <td class="bkdTitleMenu"><b>#</b></td>

                        <?php $_from = $this->_tpl_vars['fields_vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

                            <?php if (! empty ( $this->_tpl_vars['field']['sort'] ) && ! empty ( $this->_tpl_vars['field']['label'] )): ?>

                                <?php if ($this->_tpl_vars['field']['sort'] === 'asc'): ?>
                                    <td class="bkdTitleMenu"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name'],'asc_or_desc' => 'asc'), $this);?>
</b></td>
                                <?php elseif ($this->_tpl_vars['field']['sort'] === 'desc'): ?>
                                    <td class="bkdTitleMenu"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name'],'asc_or_desc' => 'desc'), $this);?>
</b></td>
                                <?php else: ?>
                                    <td class="bkdTitleMenu"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name']), $this);?>
</b></td>
                                <?php endif; ?>

                            <?php else: ?>

                                <?php if (! empty ( $this->_tpl_vars['field']['label'] )): ?>
                                    <td class="bkdTitleMenu" width="12%"><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['field']['label']), $this);?>
</b></td><?php endif; ?>

                            <?php endif; ?>

                        <?php endforeach; endif; unset($_from); ?>

                        <!--<td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</b></td> -->

                        <!--<td class="bkdTitleMenu"><b><?php echo smarty_function_translate(array('label' => 'Actiuni'), $this);?>
</b></td> -->

                    </tr>

                    <?php $_from = $this->_tpl_vars['fields_data_vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                        <tr>

                            <form name="Vacation" action="" method="post" enctype="application/x-www-form-urlencoded">

                                <input type="hidden" name="VacationID" value="<?php echo $this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['VacationID']; ?>
"/>

                                <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>


                                <?php $_from = $this->_tpl_vars['fields_vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>

                                    <?php $this->assign('field_name', $this->_tpl_vars['field']['name']); ?>

                                    <?php if (! empty ( $this->_tpl_vars['item'][$this->_tpl_vars['field_name']] )): ?>
                                        <td<?php if ($this->_tpl_vars['field']['align']): ?> align="<?php echo $this->_tpl_vars['field']['align']; ?>
"<?php endif; ?> width="12%"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field_name']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp') : smarty_modifier_default($_tmp, '&nbsp')); ?>
</td>
                                    <?php endif; ?>

                                <?php endforeach; endif; unset($_from); ?>

                                <!--<td class="celulaMenuST"><textarea name="Notes" cols="35"><?php echo $this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['Notes']; ?>
</textarea></td>-->

                                <!--

					<td class="celulaMenuSTDR">

						<?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['Aprove'] == 0): ?>

							<input type="submit" name="Aprove1" value="<?php echo smarty_function_translate(array('label' => 'Aproba'), $this);?>
" />

							<input type="submit" name="AproveR" value="<?php echo smarty_function_translate(array('label' => 'Respinge'), $this);?>
" />

						<?php elseif ($this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['Aprove'] == 1): ?>

							<input type="submit" name="AproveR" value="<?php echo smarty_function_translate(array('label' => 'Respinge'), $this);?>
" />

						<?php elseif ($this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['Aprove'] == -1): ?>

							<input type="submit" name="Aprove1" value="<?php echo smarty_function_translate(array('label' => 'Aproba'), $this);?>
" />

						<?php endif; ?>

					</td>

					-->

                            </form>

                        </tr>
                        <?php endforeach; else: ?>
                        <tr height="30">
                            <td colspan="100"><?php echo smarty_function_translate(array('label' => 'Nu exista concedii!'), $this);?>
</td>
                        </tr>
                    <?php endif; unset($_from); ?>

                </table>

        </td>

        </td>

    </tr>

</table>
