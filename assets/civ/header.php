<?php
if(!session('access_token')) {
    header('Location: /noauth');
}
?>

<header id="header">
    <div id="container01" class="container columns full screen">
        <div class="inner">
            <div>
                <h2 id="text13"><a href="/" style="color: <?php fetchSetting('shareColor'); ?>" class="linkHide"><?php fetchSetting('nameSml');?> - Civilian</a></h2>
                <hr id="divider01">
            </div>
            <div>
                <ul id="buttons02" class="buttons">
                    <li>
                        <a href="/civ" class="button n01">Civilian</a>
                    </li><li>
                        <a href="/leo" class="button n02">Law Enforcement</a>
                    </li><li>
                        <a href="/fire" class="button n03">Fire Department</a>
                    </li><li>
                        <a href="/dispatch" class="button n04">Dispatch</a>
                    </li>
                    <?php
                    if(isStaff(1)) {
                    ?>
                        <li>
                            <a href="/staff" class="button n05">Staff Panel</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <hr id="divider03">
</header>
<script>
    console.log('Welcome to FaxCAD 2.0. Created by FAXES - http://faxes.zone\n\n')
</script>