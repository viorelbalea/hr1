<div class="submeniu">
    <a href="./?m=help&o=about" class="selected">{translate label='Despre HR Executive'}</a>
    <a href="./?m=help&o=help" class="unselected">{translate label='Ajutor'}</a>
</div>
<h3>HR Executive Version {$VERSION}</h3>
{if !empty($ln)}
    <h4>Aplicatia este licentiata catre firma {$fn} pe baza licentei nr. {$ln}</h4>
{/if}
<b>HR Executive versioning and version numbers</b>
<br><br>
The HR Executive project has two kinds of releases: bug-fix releases and feature releases. Bug-fix releases don't add any new functionality; they just contain bug fixes and small enhancements. Feature releases add new functionality and can also contain bug fixes.
<br><br>
HR Executive version numbers have two or three digits. All feature releases use two digits and they increment the second digit in the version number. For example version 2.0 was a feature release adding several new features. After that a bug-fix release 2.0.1 was released and it fixed some bugs that were present in 2.0 but it did not add any new features. Bug-fix releases (also known as dot releases) increment the third digit in the version number.
<br><br>
The first digit rarely changes. This happened with version 2.0 when we added a lot of new features and also changed the licensing and it was decided that this change is big enough to warrant incrementing the first digit! 
