{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Campuri custom'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Personal'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120">{translate label='CustomPerson 1'}:</td>
                                        <td><input type="text" name="CustomPerson1" value="{$customfields.CustomPerson1|default:''}"
                                                   maxlength="32">{translate label='(camp de tip text)'} </td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomPerson 2'}:</td>
                                        <td><input type="text" name="CustomPerson2" value="{$customfields.CustomPerson2|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomPerson 3'}:</td>
                                        <td><input type="text" name="CustomPerson3" value="{$customfields.CustomPerson3|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomPerson 4'}:</td>
                                        <td><input type="text" name="CustomPerson4" value="{$customfields.CustomPerson4|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomPerson 5'}:</td>
                                        <td><input type="text" name="CustomPerson5" value="{$customfields.CustomPerson5|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomPerson 6'}:</td>
                                        <td><input type="text" name="CustomPerson6" value="{$customfields.CustomPerson6|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Companii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120">{translate label='CustomCompany 1'}:</td>
                                        <td><input type="text" name="CustomCompany1" value="{$customfields.CustomCompany1|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomCompany 2'}:</td>
                                        <td><input type="text" name="CustomCompany2" value="{$customfields.CustomCompany2|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomCompany 3'}:</td>
                                        <td><input type="text" name="CustomCompany3" value="{$customfields.CustomCompany3|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Joburi'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120">{translate label='CustomJob 1'}:</td>
                                        <td><input type="text" name="CustomJob1" value="{$customfields.CustomJob1|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomJob 2'}:</td>
                                        <td><input type="text" name="CustomJob2" value="{$customfields.CustomJob2|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomJob 3'}:</td>
                                        <td><input type="text" name="CustomJob3" value="{$customfields.CustomJob3|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Evenimente'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120">{translate label='CustomEvent 1'}:</td>
                                        <td><input type="text" name="CustomEvent1" value="{$customfields.CustomEvent1|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomEvent 2'}:</td>
                                        <td><input type="text" name="CustomEvent2" value="{$customfields.CustomEvent2|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip text)'}</td>
                                    </tr>
                                    <tr>
                                        <td>{translate label='CustomEvent 3'}:</td>
                                        <td><input type="text" name="CustomEvent3" value="{$customfields.CustomEvent3|default:''}"
                                                   maxlength="32"> {translate label='(camp de tip data)'}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Training'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0"
                        <tr>
                            <td width="120">{translate label='CustomTraining 1'}:</td>
                            <td><input type="text" name="CustomTraining1" value="{$customfields.CustomTraining1|default:''}" maxlength="32"> {translate label='(camp de tip text)'}
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='CustomTraining 2'}:</td>
                            <td><input type="text" name="CustomTraining2" value="{$customfields.CustomTraining2|default:''}" maxlength="32"> {translate label='(camp de tip text)'}
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='CustomTraining 3'}:</td>
                            <td><input type="text" name="CustomTraining3" value="{$customfields.CustomTraining3|default:''}" maxlength="32"> {translate label='(camp de tip data)'}
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
    </fieldset>
    <br>
    <fieldset>
        <legend>{translate label='Produse'}</legend>
        <table border="0" cellpadding="4" cellspacing="0" class="screen">
            <tr>
                <td>
                    <table border="0" cellpadding="4" cellspacing="0"
            <tr>
                <td width="120">{translate label='CustomProduct 1'}:</td>
                <td><input type="text" name="CustomProduct1" value="{$customfields.CustomProduct1|default:''}" maxlength="32"> {translate label='(camp de tip text)'}</td>
            </tr>
            <tr>
                <td>{translate label='CustomProduct 2'}:</td>
                <td><input type="text" name="CustomProduct2" value="{$customfields.CustomProduct2|default:''}" maxlength="32"> {translate label='(camp de tip text)'}</td>
            </tr>
            <tr>
                <td>{translate label='CustomProduct 3'}:</td>
                <td><input type="text" name="CustomProduct3" value="{$customfields.CustomProduct3|default:''}" maxlength="32"> {translate label='(camp de tip data)'}</td>
            </tr>
        </table>
        </td>
        </tr>
        </table>
    </fieldset>
    <br>
    <input type="submit" value="{translate label='Salveaza'}">
    </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de campuri custom care apar in aplicatie'}</span></td>
    </tr>
    </table>
</form>
