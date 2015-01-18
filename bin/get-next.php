<?php

/**
 * Loads next meetup data via meetup.com API and saves a html snippet in
 * /source/_views/generated/next-meetup.html
 *
 * This snippet is included on the frontpage.
 *
 * Requires the ZGPHP_API_KEY environment variable to be populated with the
 * meetup.com API key.
 *
 * @see https://secure.meetup.com/meetup_api/key/
 */

$key = getenv("ZGPHP_API_KEY");
if (!$key) {
    die("meetup.com API key not defined in ZGPHP_API_KEY environment variable.");
}

$query = [
    "sign" => true,
    "key" => $key,
    "group_urlname" => "ZgPHP-meetup",
    "status" => "upcoming",
    "order" => "time",
    "visibility" => "public"
];


$url = "https://api.meetup.com/2/events";
$url .= "?" . http_build_query($query);

echo "Fetching data from API...\n";
$json = file_get_contents($url);
if ($json === false) {
    die("Failed fetching data");
}

echo "Processing data...\n";
$data = json_decode($json);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Failed decoding json data:" . jsone_last_error_msg());
}

if (empty($data->results)) {
    die("No pending meetups found.");
}

$meetup = $data->results[0];

$time = date("d.m.Y @ H:i", $meetup->time / 1000);
$address = urlencode($meetup->venue->address_1);
$city = urlencode($meetup->venue->city);
$lat = $meetup->venue->lat;
$lon = $meetup->venue->lon;
$mapURL = "https://www.google.com/maps/place/$address,+$city,+Croatia/@$lat,$lon,17z";

$html = <<<ENDHTML
<h4>Next meetup</h4>
<p>
    <b>{$meetup->name}</b><br />
    {$time}<br />
    <a href="$mapURL">
        {$meetup->venue->name}<br />
        {$meetup->venue->address_1}
    </a>
</p>

<a class="btn btn-default btn-block" href="{$meetup->event_url}">RSVP here</a>
ENDHTML;

$target = __DIR__ . '/../source/_views/generated/next-meetup.html';
$success = file_put_contents($target, $html);
if ($success) {
    echo "Saved next meetup snippet to: " . realpath($target);
} else {
    die ("Failed saving snippet to: " . $target);
}
