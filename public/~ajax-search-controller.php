<?php
// Fill up array with names
$username = array ("Anna",
            "Brittany",
            "Cinderella",
            "Diana",
            "Eva",
            "Fiona",
            "Gunda",
            "Hege",
            "Inga",
            "Johanna",
            "Kitty",
            "Linda",
            "Nina",
            "Ophelia",
            "Petunia",
            "Amanda",
            "Raquel",
            "Cindy",
            "Doris",
            "Eve",
            "Evita",
            "Sunniva",
            "Tove",
            "Unni",
            "Violet",
            "Liza",
            "Elizabeth",
            "Ellen",
            "Wenche",
            "Vicky"
    );

$content = array("Skyrim Glitch", "Youtube", "9GAG", "Chuck Norris", "iPhone");

$nofilter = $username;
foreach ($content as $value) {
    $nofilter[] = $value;
}

//get the q parameter from URL
$q = $_GET["q"];
$f = $_GET["f"];

if ($f == "filter-none") {
    $a = $nofilter;
} else if ($f == "filter-user") {
    $a = $username;
} else if ($f == "filter-cont") {
    $a = $content;
}

//lookup all hints from array if length of q>0
if (strlen($q) > 0) {
    $hint = "";
    for ($i = 0; $i < count($a); $i++) {
        if (strtolower($q) == strtolower(substr($a[$i], 0, strlen($q)))) {
            if ($hint == "") {
                $hint = "<li>" . "<a href='user-profile_view.php'>" . $a[$i] . '</a>' . "</li>";
            } else {
                $hint = $hint . "<li>" . "<a href=''>" . $a[$i] . '</a>' . "</li>";
            }
        }
    }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "") {
    $response = "No Suggestion";
} else {
    $response = $hint;
}

//output the response
echo $response;

