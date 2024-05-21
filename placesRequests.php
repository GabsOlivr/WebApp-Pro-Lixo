<?php
function getCoordinates($address) {
    // Replace YOUR_API_KEY with your actual Google API key
    $apiKey = 'AIzaSyDjiJnJKpcL9tMRGfD9AGmPYZPmydig87g';
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key={$apiKey}";

    // Send GET request to Google Geocoding API
    $response = file_get_contents($url);
    $response = json_decode($response, true);

    if ($response['status'] == 'OK') {
        // Get the latitude and longitude from the response
        $latitude = $response['results'][0]['geometry']['location']['lat'];
        $longitude = $response['results'][0]['geometry']['location']['lng'];
        return array('latitude' => $latitude, 'longitude' => $longitude);
    } else {
        return false;
    }
}

// Example usage
$address = "Av. Tomaz Alves Figueiredo, 350 - Cidade Industrial, Lorena - SP, 12609-166";
$coordinates = getCoordinates($address);

if ($coordinates) {
    echo "Latitude: " . $coordinates['latitude'] . "\n";
    echo "Longitude: " . $coordinates['longitude'] . "\n";
} else {
    echo "Unable to get the coordinates for the provided address.";
}
?>
