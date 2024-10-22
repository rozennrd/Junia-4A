<?php
$nb = 0;
$token = sha1(random_int ( 0, 99999999999999999999));

$query = "UPDATE users SET chmod = '".$token."' WHERE mail = '".$this->mail."'"


// retrieve token
if (isset($_GET["token"]) && preg_match('/^[0-9A-F]{40}$/i', $_GET["token"])) {
    $token = $_GET["token"];
}
else {
    throw new Exception("Valid token not provided.");
}

// verify token
$query = $db->prepare("SELECT username, tstamp FROM pending_users WHERE token = ?");
$query->execute(array($token));
$row = $query->fetch(PDO::FETCH_ASSOC);
$query->closeCursor();

if ($row) {
    extract($row);
}
else {
    throw new Exception("Valid token not provided.");
}

// do one-time action here, like activating a user account
// ...

// delete token so it can't be used again
$query = $db->prepare(
    "DELETE FROM pending_users WHERE username = ? AND token = ? AND tstamp = ?",
);
$query->execute(
    array(
        $username,
        $token,
        $tstamp
    )
);