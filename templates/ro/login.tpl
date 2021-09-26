<link href="images/style.css" rel="stylesheet" type="text/css"/>


<div id="loginPageNew" class="loginPageNew">

    <div class="logoHreLogin">
        <img src="images/logo.png" alt=""/>
        <p style="margin-top:20px;">
            {if $err->getErrors()}<font color="#FF0000"><b>{$err->getErrors()}</b></font>{/if}
        </p>
    </div>
    <div align="center" class="loginHolder">

        <div class="fieldsHolder">
            <form action="{if !isset($smarty.get.doChangePassword)}./{/if}" method="post">
                {literal}
                    <input type="text" id="username" class="username" name="username" onfocus="if(this.value == 'Nume utilizator') { this.value = ''; }"
                           onblur="if(this.value == '') {this.value = 'Nume utilizator';}" value="Nume utilizator" size="27">
                    <input type="password" id="password" class="password" name="password" onfocus="if(this.value == 'Parola') { this.value = ''; }"
                           onblur="if(this.value == '') {this.value = 'Parola';}" value="Parola">
                {/literal}
                {if !isset($smarty.get.doChangePassword)}
                    <select name="area_id" class="loginSelect">
                        {foreach from=$areas key=key item=item}
                            <option value="{$key}">{translate label=$item}</option>
                        {/foreach}
                    </select>
                {else}
                    <input type="hidden" name="area_id" value="{$smarty.get.area_id}"/>
                    <p class="loginText">{translate label='Confirma parola'}: </p>
                    <input type="password" class="password" name="password2" size="27">
                {/if}

        </div>

        <div class="loginAuthBtn">
            <input id="loginAuthBtn" class="loginAuthBtn" type="submit" value="{if !isset($smarty.get.doChangePassword)}Intra in cont{else}{translate label='Modifica'}{/if}">
        </div>
        <div class="loginForgotBtn">
            <a href="#" class="forgotPass" onclick="window.location.href = './?doRecoverPassword';">{translate label='Am uitat parola'}</a>
        </div>
        </form>
        <br style="clear:both;"/>
    </div>
    <div align="center" class="allRights">
        <p align="center">{$smarty.now|date_format:"%Y"} Ka&Te Associates. All rights reserved </p>
    </div>
</div>


<!--
<div align="center" class="loginPage">
<br clear="left" />
	{*<img src="images/hr1.png" alt=""/>*}
	<div>
	<form action="{if !isset($smarty.get.doChangePassword)}./{/if}" method="post">
		<table  class="loginBox" border="0" cellpadding="0" cellspacing="0" align="center">
			
			<tr>
				<td width="150" height="22" align="left" valign="top" ><p class="loginText"><b>{if !isset($smarty.get.doChangePassword)}{translate label='Autentificare'}{else}{translate label='Schimbare parola'}{/if}</b></p> </td>
				<td height="22" align="left"  valign="top">{if $err->getErrors()}<font color="#FF0000"><b>{$err->getErrors()}</b></font>{/if}</td>
			</tr>
			<tr>


			<tr>
				<td align="left" height="30"><p class="loginText">{translate label='Username'}:</p> </td>
				<td align="left" height="30"><input type="text" class="loginInput" name="username" id="username" value="{$smarty.post.username|default:''}" size="27"></td>
			</tr>
			<tr>
				<td height="30" align="left"><p class="loginText">{translate label='Parola'}: </p></td>
				<td align="left"><input type="password" class="loginInput" name="password" size="27"></td>
			</tr>
			{if !isset($smarty.get.doChangePassword)}
			<tr>
				<td height="30"  align="left">
					<p class="loginText">{translate label='Zona aplicatie'}</p>
				</td>
                                
				<td  align="left">
					<select name="area_id" class="loginSelect">
					{foreach from=$areas key=key item=item}
					<option value="{$key}">{translate label=$item}</option>
					{/foreach}
					</select>
				</td>
			</tr>
                        {else}
                        <tr>
                        <input type="hidden" name="area_id" value="{$smarty.get.area_id}" />
                            <td height="30" align="left"><p class="loginText">{translate label='Confirma parola'}: </p></td>
                            <td align="left"><input type="password" class="loginInput" name="password2" size="27"></td>
			</tr>
                        {/if}
			<tr>
				<td  height="30" colspan="2" align="left">
				    <p align="right" style="margin: 11px 23px 0 0;"><input id="loginSubmit" type="submit" value="{if !isset($smarty.get.doChangePassword)}Login{else}{translate label='Modifica'}{/if}" class="loginSubmit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Am uitat parola'}" class="loginSubmit" onclick="window.location.href = './?doRecoverPassword';"></p>
				</td>
			</tr>
			<tr>
				<td  height="160" colspan="2" align="left" valign="top"><p align="center" style="margin-top: 30px;">{$smarty.now|date_format:"%Y"} Ka&Te Associates. All rights reserved  </p></td>
			</tr>
		</table>
	</form>
	</div>
</div>


-->
