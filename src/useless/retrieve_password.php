<?php
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

$delta = 86400;
// Check to see if link has expired
if ($_SERVER["REQUEST_TIME"] - $tstamp > $delta) {
    throw new Exception("Token has expired.");
}

// do one-time action here, like activating a user account
$query = $db->prepare(
    "UPDATE Users
	SET LOCKED = 'false'
	WHERE Name = ?",
);
$query->execute(
    array(
        $username,
        $token,
        $tstamp
    )
);

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
?>