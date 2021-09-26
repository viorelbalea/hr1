<html>
<head>
    <title></title>
    <link href="images/style.css" rel="stylesheet" type="text/css">
</head>

<body topmargin="5">

<form action="{$smarty.server.REQUEST_URI}" method="post">
    <b>{$phases.Candidat}</b>

    <br><br>
    {if $phases.Phase1 > 0}
        <b>{translate label='Faza 1'}</b>
        : {if $phases.Phase1 == 1}{translate label='CV depus'}{elseif $phases.Phase1 == 2}{translate label='Interviu obtinut in urma unei intrevederi cu angajatorul'}{/if}
        <br>
        <br>
        {if $phases.Phase2 > 0}
            <b>{translate label='Faza 2'}:</b>
            : {if $phases.Phase2 == 1}{translate label='Angajatorul a respins CV-ul'}{elseif $phases.Phase2 == 2}{translate label='Angajatorul a acceptat CV-ul, urmeaza interviul'}{/if}
            {if $phases.Phase2 > 1}
                <br>
                <br>
                {if $phases.Phase3 > 0}
                    <b>{translate label='Faza 3'}:</b>
                    : {if $phases.Phase3 == 1}{translate label='Candidatul nu s-a prezentat la interviu'}{elseif $phases.Phase3 == 2}{translate label='Candidatul a respins angajatorul la interviu '}{elseif $phases.Phase3 == 3}{translate label='Angajatorul a respins candidatul la interviu'}{elseif $phases.Phase3 == 4}{translate label='Candidatul a fost angajat in perioada de proba in urma interviului'}{/if}
                    <br>
                    <br>
                    {if $phases.Phase3 > 3}
                        {if $phases.Phase4 > 0}
                            <b>{translate label='Faza 4'}:</b>
                            : {if $phases.Phase4 == 1}{translate label='Candidatul a fost angajat permanent in urma perioadei de proba'}{elseif $phases.Phase4 == 2}{translate label='Candidatul nu s-a prezentat pentru perioada de proba'}{elseif $phases.Phase4 == 3}{translate label='Candidatul a refuzat jobul in urma perioadei de proba'}{elseif $phases.Phase4 == 4}{translate label='Angajatorul a refuzat candidatul in urma perioadei de proba'}{/if}
                            <br>
                            <br>
                        {else}
                            <b>Faza 4:</b>
                            <br>
                            <input type="radio" name="Phase[4]" value="1">
                            {translate label='Candidatul a fost angajat permanent in urma perioadei de proba'}
                            <br>
                            <input type="radio" name="Phase[4]" value="2">
                            {translate label='Candidatul nu s-a prezentat pentru perioada de proba'}
                            <br>
                            <input type="radio" name="Phase[4]" value="3">
                            {translate label='Candidatul a refuzat jobul in urma perioadei de proba'}
                            <br>
                            <input type="radio" name="Phase[4]" value="4">
                            {translate label='Angajatorul a refuzat candidatul in urma perioadei de proba'}
                        {/if}
                    {/if}
                {else}
                    <b>Faza 3:</b>
                    <br>
                    <input type="radio" name="Phase[3]" value="1">
                    {translate label='Candidatul nu s-a prezentat la interviu'}
                    <br>
                    <input type="radio" name="Phase[3]" value="2">
                    {translate label='Candidatul a respins angajatorul la interviu'}
                    <br>
                    <input type="radio" name="Phase[3]" value="3">
                    {translate label='Angajatorul a respins candidatul la interviu'}
                    <br>
                    <input type="radio" name="Phase[3]" value="4">
                    {translate label='Candidatul a fost angajat in perioada de proba in urma interviului'}
                {/if}
            {/if}
        {else}
            <b>Faza 2:</b>
            <br>
            <input type="radio" name="Phase[2]" value="1">
            {translate label='Angajatorul a respins CV-ul'}
            <br>
            <input type="radio" name="Phase[2]" value="2">
            {translate label='Angajatorul a acceptat CV-ul, urmeaza interviul'}
        {/if}
    {else}
        <b>Faza 1</b>
        <br>
        <input type="radio" name="Phase[1]" value="1">
        {translate label='CV depus'}
        <br>
        <input type="radio" name="Phase[1]" value="2">
        {translate label='Interviu obtinut in urma unei intrevederi cu angajatorul'}
    {/if}

    <br><br>
    {if $phases.Phase4 == 0}
    {if $phases.Phase3 > 3}
        <input type="submit" value="{translate label='Finalizare'}">
    {else}
        {if $phases.Phase2 == 1 || ($phases.Phase3 > 0 && $phases.Phase3 <= 3)}{else}<input type="submit" value="{translate label='Pasul urmator'}">{/if}
    {/if}
    &nbsp;&nbsp;{/if}<input type="button" value="{translate label='Inchide'}" onClick="window.close();">
</form>

</body>
</html>