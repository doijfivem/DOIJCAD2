<header id="header">
    <div id="container01" class="container columns full screen">
        <div class="inner">
            <div>
                <h2 id="text02"><a href="/" style="color: <?php fetchSetting('shareColor'); ?>" class="linkHide"><?php fetchSetting('nameSml');?> - Admin Panel</a></h2>
                <hr id="divider01">
            </div>
            <div>
                <ul id="buttons04" class="buttons">
                    <li>
                        <a href="/civ" class="button n01">Civilian</a>
                    </li><li>
                        <a href="/leo" class="button n02">Law Enforcement</a>
                    </li><li>
                        <a href="/fire" class="button n03">Fire Department</a>
                    </li><li>
                        <a href="/dispatch" class="button n04">Dispatch</a>
                    </li><li>
                        <a href="/staff" class="button n05">Staff Panel</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr id="divider22">
    <p id="text23">Admin Panel Menu</p>
    <ul id="buttons03" class="buttons">
        <li>
            <a href="/staff" class="button n01">Admin Home</a>
        </li>
        <?php
        if(isStaff(0)) {
        ?>
            <li>
                <a href="/staff/sitesettings" class="button n02">Site Settings</a>
            </li>
        <?php
        }
        ?>
        <li>
            <a href="/staff/verifications" class="button n03">Verifications</a>
        </li>
        <li>
            <a href="/staff/members" class="button n08">Classic Members</a>
        </li>
        <?php
        if(isStaff(0)) {
        ?>
        <li>
            <a href="/staff/adminsettings" class="button n04">Administrators</a>
        </li>
        <li>
            <a href="/staff/supersettings" class="button n05">Supervisors</a>
        </li>
        <li>
            <a href="/staff/departmentsettings" class="button n06">Departments</a>
        </li>
        <li>
            <a href="/staff/newssettings" class="button n07">News System</a>
        </li>
        <li>
            <a href="/staff/bans" class="button n07">User Bans</a>
        </li>
        <?php
        }
        ?>
        <li>
            <a href="/staff/reportmanager" class="button n08">Report Manager</a>
        </li>
    </ul>
    <hr id="divider10">
</header>
<script>
    console.log('Welcome to FaxCAD 2.0. Created by FAXES - http://faxes.zone')
</script>