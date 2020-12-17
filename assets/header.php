<header id="header">
    <div id="container01" class="container columns full screen">
        <div class="inner">
            <div>
                <h2 id="text02" style="color: <?php fetchSetting('shareColor'); ?>"><a href="/" class="linkHide"><?php fetchSetting('nameSml');?> CAD</a></h2>
            </div>
            <div>
                <ul id="buttons04" class="buttons">
                    <?php 
                    if(!session('access_token')) {
                    ?>
                        <li>
                            <a href="<?php echo getloginShitLink()["loginLink"]; ?>" class="button n01">Login</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="/civ" class="button n02">Civilian</a>
                        </li><li>
                            <a href="/leo" class="button n03">Law Enforcement</a>
                        </li><li>
                            <a href="/fire" class="button n04">Fire Department</a>
                        </li><li>
                            <a href="/dispatch" class="button n05">Dispatch</a>
                        </li>
                        <?php
                        if(isStaff(1)) {
                        ?>
                        <li>
                            <a href="/staff" class="button n06">Staff Panel</a>
                        </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <hr id="divider10">
</header>
<script>
    console.log('Welcome to FaxCAD 2.0. Created by FAXES - http://faxes.zone\n\n')
</script>