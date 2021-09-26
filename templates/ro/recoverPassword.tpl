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
            <form action="./?doRecoverPassword" method="post">
                {literal}
                    <input type="text" id="username" class="username" name="username" onfocus="if(this.value == 'Nume utilizator') { this.value = ''; }"
                           onblur="if(this.value == '') {this.value = 'Nume utilizator';}" value="Nume utilizator" size="27">
                {/literal}

        </div>

        <div class="loginRecover">
            <input id="loginRecover" class="loginRecover" type="submit" value="{translate label='Recupereaza Parola'}">
        </div>

        </form>

    </div>
    <div class="allRights">
        <p align="center">{$smarty.now|date_format:"%Y"} Ka&Te Associates. All rights reserved </p>
    </div>
</div>

<!--
<link href="images/style.css" rel="stylesheet" type="text/css" />
<div align="center" class="loginPage">
<br clear="left" />
	{*<img src="images/hr.png" alt=""/>*}
	<div>
	<form action="./?doRecoverPassword" method="post">
		<table class="loginBox" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="2" align="left" valign="top" height="80"><a href="./"><img src="images/logo.png" alt="" /></a></td>
			</tr>
			<tr>
				<td width="150" height="22" align="left" valign="top" ><p class="loginText"><b>{translate label='Recuperare parola'}</b></p> </td>
				<td height="22" align="left" valign="top">{if !empty($success)}{translate label='Verifica adresa de email pentru recuperarea parolei'}!{elseif $err->getErrors()}<font color="#FF0000"><b>{$err->getErrors()}</b></font>{else}&nbsp;{/if}</td>
			</tr>
			<tr>
				<td align="left" height="30"><p class="loginText">{translate label='Username'}:</p> </td>
				<td align="left" height="30"><input type="text" class="loginInput" name="username" id="username" value="{$smarty.post.username|default:''}" size="27"></td>
			</tr>
			<tr>
				<td height="30" colspan="2" align="left"><p align="center" style="margin-top: 11px;"><input id="loginSubmit" type="submit" value="{translate label='Trimite'}" class="loginSubmit"></p></td>
			</tr>
			<tr>
				<td height="145" colspan="2" align="left" valign="top"><p align="center" style="margin-top: 30px;">{$smarty.now|date_format:"%Y"} Ka&Te Associates. All rights reserved  </p></td>
			</tr>
		</table>
	</form>
	</div>
</div>
-->