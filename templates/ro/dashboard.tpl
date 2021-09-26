<table width="100%" border="0">

    <tr>

        <td width="50%" valign="top"><h3>{translate label='Bugete'}</h3>

            <img src="graphs/dashboard_total_graph.png"/>

        </td>

        <td width="35%" valign="top"><h3>{translate label='Alerte'}</h3>

            <div style="height:420px; overflow:auto;">

                <table width="100%" border="0">
                    {foreach from=$alerts item=item key=key}
                        <tr>
                            <td><b>{$item.Subject|strip_tags}</b> | {$item.FullName|strip_tags} | {$item.CreateDate|date_format:"%D"|strip_tags}</td>
                        </tr>
                        <tr>
                            <td><p style="margin-top:0;" title="{'<br />'|str_replace:'':$item.Message}">{$item.Message|truncate:280|strip_tags}</p></td>
                        </tr>
                        {foreachelse}
                        {translate label='Nu exista inregistrari!'}
                    {/foreach}
                </table>

            </div>

        </td>

        <td width="15%" valign="top"><h3>{translate label='Tichete'}</h3>

            <div style="height:420px; overflow:auto;">


                <table width="100%" border="0">

                    <tr>

                        <td class="bkdTitleMenu"><b>{translate label='Status'}</b></td>

                        <td class="bkdTitleMenu"><b>{translate label='Numar'}</b></td>

                    </tr>

                    {foreach from=$dashboard_tickets item=item key=key}

                        {if $key>0}
                            <tr>

                                <td>{$item.StatusName}</td>

                                <td><a href="./?m=ticketing&Status=|{$key}|" target="_blank">{$item.NoTickets}</a></td>

                            </tr>
                        {/if}

                        {foreachelse}
                        <tr>

                            <td colspan="2">{translate label='Nu exista inregistrari!'}</td>

                        </tr>
                    {/foreach}

                    {if $dashboard_tickets.0}
                        <tr>

                            <td><b>{translate label='Total'}</b></td>

                            <td>{$dashboard_tickets.0}</td>

                        </tr>
                    {/if}

                </table>

            </div>

        </td>

    </tr>

    <tr>

        <!-- Angajati -->

        <td width="50%" valign="top">

            <div style="height:250px; overflow:auto;">

                <h3>{translate label='Angajati la data'} {$smarty.now|date_format:"%d.%m.%Y"}</h3>

                <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">

                    <!-- Fields -->

                    <tr>

                        <td rowspan="2" class="bkdTitleMenu"><b>#</b></td>

                        <td rowspan="2" class="bkdTitleMenu"><b>{translate label='Companie'}</b></td>

                        <td colspan="3" align="center" class="bkdTitleMenu"><b>{translate label='Angajati'}</b></td>

                        <td rowspan="2" align="center" class="bkdTitleMenu"><b title="{translate label='Colaboratori'}">{translate label='Colab.'}</b></td>

                        <td colspan="2" align="center" class="bkdTitleMenu"><b>{translate label='In AN curent'}</b></td>


                    </tr>

                    <tr>

                        <td class="bkdTitleMenu"><b title="{translate label='Determinat'}">{translate label='Det.'}</b></td>

                        <td class="bkdTitleMenu"><b title="{translate label='Nedeterminat'}">{translate label='NeDet.'}</b></td>

                        <td class="bkdTitleMenu"><b>{translate label='Total'}</b></td>

                        <td class="bkdTitleMenu"><b>{translate label='In'}</b></td>

                        <td class="bkdTitleMenu"><b>{translate label='Out'}</b></td>

                    <tr>


                        <!-- Values -->

                        {foreach from=$dashboard_employees item=emp key=ekey name=ename }

                    <tr>

                        <td>{$smarty.foreach.ename.iteration}</td>

                        <td>{$emp.CompanyName}</td>

                        <td>{$emp.NoEmployeesDet}</td>

                        <td>{$emp.NoEmployeesUndet}</td>

                        <td>{$emp.TotalEmployees}</td>

                        <td>{$emp.TotalCollaborators}</td>

                        <td>{$emp.TotalIN}</td>

                        <td>{$emp.TotalOUT}</td>

                    </tr>

                    {foreachelse}

                    <tr height="30">
                        <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
                    </tr>

                    {/foreach}

                </table>

            </div>

        </td>

        <!-- Concedii -->

        <td width="50%" valign="top" colspan="2">

            <div style="height:250px; overflow:auto;">

                <h3>{translate label='Concedii la data'} {$smarty.now|date_format:"%d.%m.%Y"}</h3>

                <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1">

                    <tr>

                        <td class="bkdTitleMenu"><b>#</b></td>

                        {foreach from=$fields_vacations item=field}

                            {if !empty($field.sort)&&!empty($field.label)}

                                {if $field.sort === 'asc'}
                                    <td class="bkdTitleMenu"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                                {elseif $field.sort === 'desc'}
                                    <td class="bkdTitleMenu"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                                {else}
                                    <td class="bkdTitleMenu"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                                {/if}

                            {else}

                                {if !empty($field.label)}
                                    <td class="bkdTitleMenu" width="12%"><b>{translate label=$field.label}</b></td>{/if}

                            {/if}

                        {/foreach}

                        <!--<td class="bkdTitleMenu"><b>{translate label='Comentariu'}</b></td> -->

                        <!--<td class="bkdTitleMenu"><b>{translate label='Actiuni'}</b></td> -->

                    </tr>

                    {foreach from=$fields_data_vacations item=item key=key name=iter}
                        <tr>

                            <form name="Vacation" action="" method="post" enctype="application/x-www-form-urlencoded">

                                <input type="hidden" name="VacationID" value="{$vacations[$key].VacationID}"/>

                                <td>{$smarty.foreach.iter.iteration}</td>


                                {foreach from=$fields_vacations item=field}

                                    {assign var=field_name value=$field.name}

                                    {if !empty($item.$field_name)}
                                        <td{if $field.align} align="{$field.align}"{/if} width="12%">{$item.$field_name|default:'&nbsp'}</td>
                                    {/if}

                                {/foreach}

                                <!--<td class="celulaMenuST"><textarea name="Notes" cols="35">{$vacations[$key].Notes}</textarea></td>-->

                                <!--

					<td class="celulaMenuSTDR">

						{if $vacations[$key].Aprove==0}

							<input type="submit" name="Aprove1" value="{translate label='Aproba'}" />

							<input type="submit" name="AproveR" value="{translate label='Respinge'}" />

						{elseif $vacations[$key].Aprove==1}

							<input type="submit" name="AproveR" value="{translate label='Respinge'}" />

						{elseif $vacations[$key].Aprove==-1}

							<input type="submit" name="Aprove1" value="{translate label='Aproba'}" />

						{/if}

					</td>

					-->

                            </form>

                        </tr>
                        {foreachelse}
                        <tr height="30">
                            <td colspan="100">{translate label='Nu exista concedii!'}</td>
                        </tr>
                    {/foreach}

                </table>

        </td>

        </td>

    </tr>

</table>

