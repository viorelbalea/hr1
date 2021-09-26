<!DOCTYPE HTML>
<html>
<head>
    <title>HR Executive</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="images/{$theme}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="images/layer.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="images/jquery.qtip.css">
    <!--[if IE]>
    <link rel="stylesheet" href="images/layer-ie.css" type="text/css"/>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="images/jquery.selectbox.css"/>
    <link rel="shortcut icon" href="images/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="images/jquery.confirm.css"/>
    <link rel="stylesheet" type="text/css" href="images/jquery-ui.css"/>
    <script language="javascript" src="js/functions.js"></script>
    <script language="javascript" src="js/checkdate.js"></script>
    <script language="javascript" src="js/CalendarPopup.js"></script>
    <script language="javascript" src="js/jquery.min.js"></script>
    <script language="javascript" src="js/jquery-migrate-1.2.1.js"></script>
    <script language="javascript" src="js/jquery.qtip.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/arnklint-jquery-contextMenu-f1f6648/jquery.contextMenu.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/jquery.selectbox-0.6.1.js"></script>
    <script language="javascript" src="js/jquery.confirm.js"></script>
    <link rel="stylesheet" type="text/css" href="images/autosuggest.css"/>
    {if !empty($prototype)}
        <script language="javascript" src="js/scriptaculous/lib/prototype.js"></script>
        <script language="javascript" src="js/scriptaculous/src/scriptaculous.js"></script>
    {/if}
    {if !empty($autocomplete)}
        <script language="javascript" src="js/utilities.js"></script>
        <script language="javascript" src="js/jquery.autosuggest.js"></script>
        <link href="images/autosuggest.css" rel="stylesheet" type="text/css">
    {/if}
    {literal}
        <script type="text/javascript">
            //$(document).ready(function() {
            //$("select[multiple!='multiple']").css("visibility", "hidden");
            //$("select[multiple!='multiple']").selectbox();
            /*$("select").each(function(){
                if(!$(this).attr('multiple'))
                    $(this).selectbox();
            });*/
            //});
        </script>
    {/literal}
</head>

{if !empty($smarty.get.m) && ($smarty.get.m == 'reports' || $smarty.get.m == 'functions') && !empty($smarty.get.print)}
    <body onLoad="window.print();">
    {include file=$center_file}
    </body>
{else}

    {if !empty($smarty.session.USER_ID)}
        <body>

        <div class="topTableWrapper">
            <table class="topTable" width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td class="logoLeftCell">
                        <a href="{$smarty.server.PHP_SELF}"><img src="images/logo.png" border="0" align="bottom"></a>
                    </td>
                    <td class="logoRightCell" align="right">
                        <div class="lrcWrapper">
                            <div class="borderRight">
                                {if !empty($smarty.session.PERS)}
                                    <img src="photos/persons/{$smarty.session.PERS|md5}.jpg" width="34" height="34"/>
                                {/if}
                                <span class="TextSus"><b>{$smarty.session.USER_NAME}</b></span>
                                {if empty($smarty.session.PERS)}
                                    &nbsp;|&nbsp;
                                {else}
                                    <br/>
                                {/if}
                                <a class="logoutLink" href="./?doLogout=1">{translate label='Logout'}</a>
                                {if empty($smarty.session.PERS)}
                                    <br/>
                                    <a href="./?doChangePasswd=1">{translate label='Schimbare parola'}</a>
                                {/if}
                            </div>
                            <div class="currentDate">
                                <div class="currentDay">
                                    {$smarty.now|date_format:'%d'}
                                </div>
                                <div class="monthYearBlock">
                                    {$smarty.now|date_format:'%Y'}
                                    <br/>
                                    {$smarty.now|date_format:'%B'}
                                </div>
                            </div>
                            <div style="clear: both; float: none;"></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td height="27" valign="top" class="borderMenu">
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr height="20">
                            <td style="padding-left: 20px;"><a href="./" class="{if empty($smarty.get.m)}meniuSusOn{else}meniuSus{/if}">{translate label='Home'}</a>
                            </td>
                            {foreach from=$modules key=key item=item}
                                {if $key != 33}
                                    {if !empty($modules_txt.$key) && ($smarty.session.USER_ID == 1 || in_array($key, $smarty.session.USER_RIGHTS))}
                                        <td><a
                                                    href="./?m={$item}{if $item == 'pontaj'}&o=psimple{/if}"
                                                    class="{if $smarty.get.m == $item}meniuSusOn{else}meniuSus{/if}">{translate label=$modules_txt.$key}</a>
                                        </td>
                                    {/if}
                                {/if}
                            {/foreach}
                            {if !empty($smarty.session.PERS)}
                                <td><a
                                        href="./?m=persons&o=auth&PersonID={$smarty.session.PERS}"
                                        class="{if $smarty.get.o == 'auth'}meniuSusOn{else}meniuSus{/if}">{translate label='Date autentificare'}</a>
                                </td>{/if}
                        </tr>
                    </table>
                </td>
                <td height="27" colspan="2" valign="top" class="borderMenu" align="right" style="padding-right: 20px;">
                    <a href="./?m=help"
                       class="{if $smarty.get.m == 'help'}meniuSusOn{else}meniuSus{/if}" style="float:right">{translate label='Help'}</a>
                    {if $smarty.session.USER_ID == 1}
                        <a href="./?m=admin" class="{if $smarty.get.m == 'admin'}meniuSusOn{else}meniuSus{/if}" style="float:right">{translate label='Admin'}</a>
                    {/if}

                </td>
            </tr>
        </table>
        <div class="zoneDetails">
            <div class="zoneName">{translate label=$areas[$smarty.session.AREA_ID]}</div>
            <select class="styled" name="area_id" onChange="window.location.href = './?area_id=' + this.value">
                {foreach from=$areas key=key item=item}
                    <option value="{$key}"
                            {if $key == $smarty.session.AREA_ID}selected{/if}>{translate label=$item}</option>
                {/foreach}
            </select>

        </div>
        <div class="contentTable">
            {include file=$center_file}
        </div>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
            <tr align="center">
                <td>
                    <hr class="maincolor">
                </td>
            </tr>
            <tr align="center" height="15">
                <td>&copy; 2009 - {$smarty.now|date_format:'%Y'} HR
                    Executive. {translate label='Toate drepturile rezervate'}</td>
            </tr>
        </table>
        </body>
    {elseif isset($smarty.get.doRecoverPassword)}
        <body onLoad="document.getElementById('username').focus();">
        {include file="recoverPassword.tpl"}
        </body>
    {else}
        <body onLoad="document.getElementById('username').focus();">
        {include file="login.tpl"}
        </body>
    {/if}
{/if}

<div class="container" style="display:none;">
    <div class="my-sticky-element"><a href="#" onclick=" $('.container').hide(); {literal}$('body').animate({scrollTop:0},'slow');{/literal}">
            <img src="images/gotop.png" style="border:0; border-radius:10px 10px 0 0;"></a></div>
</div>
<script>
    {literal}
    //store the element
    var cache = jQuery('.my-sticky-element');

    //store the initial position of the element
    var vTop = cache.offset().top - parseFloat(cache.css('margin-top').replace(/auto/, 0));
    jQuery(window).scroll(function (event) {
        // what the y position of the scroll is
        var y = jQuery(this).scrollTop();

        // whether that's below the form
        if (y >= vTop + 10) {
            // if so, ad the fixed class
            cache.addClass('stuck');
            jQuery('.container').show();
        } else {
            // otherwise remove it
            cache.removeClass('stuck');
            jQuery('.container').show();
        }
    });


    // Inlocuire tooltips cu model custom. vezi clasa jquery.qtip.css .qtip.default si .qtip.content


    function tooltip_custom() {


        jQuery('a[title]').qtip({

            position: {
                viewport: jQuery(window),
                target: 'mouse',
                adjust: {
                    method: 'flip',
                    x: 15,
                    y: 15,
                    mouse: false
                }
            },
            show: {
                effect: function () {
                    jQuery(this).fadeTo(200, 1);
                }
            },
            hide: {
                effect: function () {
                    jQuery(this).slideUp(200);
                }
            }
        });

        jQuery('p[title]').qtip({

            position: {
                viewport: jQuery(window),
                target: 'mouse',
                adjust: {
                    method: 'flip',
                    x: 15,
                    y: 15,
                    mouse: false
                }
            },
            show: {
                effect: function () {
                    jQuery(this).fadeTo(200, 1);
                }
            },
            hide: {
                effect: function () {
                    jQuery(this).slideUp(200);
                }
            }
        });
    }

    jQuery(document).ready(
        function () {
            tooltip_custom();
        }
    );
</script>
{/literal}


</html>