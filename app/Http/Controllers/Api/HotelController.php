<?php

namespace App\Http\Controllers\Api;

use App\Models\AdminData;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->section = new \stdClass();
        $this->section->title = 'Hotel Search';
        $this->section->heading = 'Hotel Search';
        $this->section->slug = 'hotelsearch';
        $this->section->Baseurl =  "https://test.api.amadeus.com/v1/";
        $this->section->SearchBaseurl =  "https://test.api.amadeus.com/v3/";
    }




    public function hotelsearchCity(Request $request)
    {
        // dd($request->all());

        $token = $this->accessToken();
        $section = $this->section;
        $base = $section->Baseurl;
        // dd($base);
        $mainurl = $base . "reference-data/locations/hotels/by-city?cityCode=" . $request->cityCode . "&ratings=" . $request->ratings . "";



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $mainurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        //return $response;
        $responseq = json_decode($response, true); // Convert JSON to an associative array

        $hotelBatches = array_chunk($responseq['data'], 10);
        $multi = [];
        foreach ($hotelBatches as $batch) {
            $placeResponses = Http::pool(function ($pool) use ($batch) {
                $requests = [];
                foreach ($batch as $res) {
                    $name = explode(' ', $res['name']);
                    $lati = $res['geoCode']['latitude'];
                    $long = $res['geoCode']['longitude'];

                    $url = $this->getPlaceIdUrl($name[0], $lati, $long);
                    $maxRetries = 3;
                    $retryCount = 0;
                    while ($retryCount < $maxRetries) {
                        try {
                            $requests[] = $pool->get($url);
                            break;
                        } catch (Exception $e) {
                            $retryCount++;
                            sleep(2);
                        }
                    }
                }
                return $requests;
            });

            foreach ($batch as $key => $res) {
                $name = explode(' ', $res['name']);
                $data['name'] = $name[0];
                $data['latitude'] = $res['geoCode']['latitude'];
                $data['longitude'] = $res['geoCode']['longitude'];
                $data['hotelId'] = $res['hotelId'];
                $data['rating'] = $res['rating'];

                $tmpResponse = $placeResponses[$key]?->json() ?? [];
                $data['imagess'] = $this->processPlaceResponse($tmpResponse);
                $multi[] = $data;
            }

            // sleep(3);
        }

        if (!empty($multi)) {
            return $multi;
        } else {
            return $responseq['errors'];
        }

        // // return $responseq['data'][0]['name'];
        // //return $responseq['data'][0]['geoCode']['latitude'];
        // return $responseq['data'][0]['geoCode']['longitude'];


    }




    public function hotelsearch(Request $request)
    {

        //dd($request->all());

        $token = $this->accessToken();
        $section = $this->section;

        $base = $section->SearchBaseurl;
        // dd($base);
        $mainurl = $base . "shopping/hotel-offers?hotelIds=" . $request->hotelIds . "&adults=" . $request->adults . "&checkinDate=" . $request->checkinDate . "&checkOutDate=" . $request->checkOutDate . "&roomQuantity=" . $request->roomQuantity . "&includeClosed=" . $request->includeClosed ."";



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $mainurl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $token
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


    //hotel booking
    public function hotelbooking(Request $request)
    {
        $token = $this->accessToken();
        $url = 'https://test.api.amadeus.com/v1/booking/hotel-bookings';

        // Use $request->input() to get data from the request
        $jsonData = $request->all();

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        ];

        $requestData = json_encode($jsonData);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestData, // Remove the extra json_encode here
            CURLOPT_HTTPHEADER => $headers,
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }


    public function adminData(Request $request){
        $admin=[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'hotelName'=>$request->hotelName,
            'noOfAdult'=>$request->noOfAdult,
            'noOfRoom'=>$request->noOfRoom,
            'price'=>$request->price,
            'reference'=>$request->reference,
            'bookingId'=>$request->bookingId,
            'providerConfirmationId'=>$request->providerConfirmationId,
            'checkin'=>$request->checkin,
        ];
        $adminData=AdminData::create($admin);
        return $adminData;
    }


    // Example usage:

    public function getMapData(Request $request)
    {

        $amadeusHotelData = $base . "reference-data/locations/hotels/by-city?cityCode=" . $request->cityCode . "&ratings=" . $request->ratings . "";
        $googlePlacesData =  "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . $request->input('query') . "&location=" . $request->input('location') . "&radius=" . $request->input('radius') . "&key=" . $apiKey;

        // Merge data based on city or location (longitude and latitude).
        $mergedData = [];

        foreach ($amadeusHotelData as $hotel) {
            $hotelLocation = $hotel['longitude'] . ',' . $hotel['latitude'];

            // Search for corresponding place data in Google Places data based on location.
            $correspondingPlace = null;
            foreach ($googlePlacesData as $place) {
                if ($place['location'] === $hotelLocation) {
                    $correspondingPlace = $place;
                    break;
                }
            }

            // Merge hotel and place data.
            if ($correspondingPlace) {
                $mergedData[] = [
                    'hotel_name' => $hotel['name'],
                    'hotel_location' => $hotelLocation,
                    'place_name' => $correspondingPlace['name'],
                    'place_type' => $correspondingPlace['type'],
                    // Include other relevant data.
                ];
            }
        }

        // Return the merged data as JSON or in your desired format.
        echo json_encode($mergedData);
    }




    public function getPlaceIdUrl($name, $lati, $long)
    {
        $apiKey = 'AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4';
        return "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . urlencode($name) . "&location=" . $lati . "," . $long . "&radius=10&key=" . $apiKey;
    }

    public function processPlaceResponse($placeResponse)
    {
        $results = isset($placeResponse['results']) ? $placeResponse['results'] : [] ;
        $places = [];
        foreach ($results as $res) {
            $place = [];
            $place['name'] = $res['name'];
            if (isset($res['photos'])) {
                $photo = $res['photos'];
            } else {
                $photo = null;
            }
            $place['photo_reference'] = $photo;
            $place['place_id'] = $res['place_id'];
            if (isset($res['user_ratings_total'])) {
                $user_ratings_total = $res['user_ratings_total'];
            } else {
                $user_ratings_total = null;
            }
            $place['user_ratings_total'] = $user_ratings_total;
            $places[] = $place;
        }

        return $places;
    }


    public function getPlaceId($name, $lati, $long)
    {
        // Replace 'your-api-key-here' with your actual Google API key
        $apiKey = 'AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4';
        $baseUrl = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . urlencode($name) . "&location=" . $lati . "," . $long . "&radius=10&key=" . $apiKey;

        //  $baseUrl = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=".$name."&location=".$lati.",".$long."&radius=10&key=".$apiKey;

        $url = $baseUrl;

        $response = Http::get($url);
        $jsonResponse = $response->json();

        $results = $jsonResponse['results'];

        $places = [];

        foreach ($results as $res) {
            // return $res;
            $place = [];
            $place['name'] = $res['name'];
            if (isset($res['photos'])) {
                $photo = $res['photos'];
            } else {
                $photo = null;
            }
            $place['photo_reference'] = $photo; // Assuming you want the first photo reference
            $place['place_id'] = $res['place_id'];
            if (isset($res['user_ratings_total'])) {
                $user_ratings_total = $res['user_ratings_total'];
            } else {
                $user_ratings_total = null;
            }
            $place['user_ratings_total'] = $user_ratings_total;
            $places[] = $place;
        }

        return $places;
    }





    public function placeDetails($placeId)
{
    // Replace 'your-api-key-here' with your actual Google API key
    $apiKey = 'AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4';

    $baseUrl = 'https://maps.googleapis.com/maps/api/place/details/json';

    $params = [
        'place_id' => $placeId,
        'key' => $apiKey,
    ];

    $response = Http::get($baseUrl, $params);

    if ($response->successful()) {
        $jsonResponse = $response->json();

        if (isset($jsonResponse['result']['photos'])) {
            $photoReferences = [];
            foreach ($jsonResponse['result']['photos'] as $photo) {
                $photoReferences[] = 'https://developer-ma.com/ag_website/api/place-photos/' . $photo['photo_reference'];
            }

            return $photoReferences;
        } else {
            return ['No photos available.'];
        }
    } else {
        return ['Error fetching place details.'];
    }
}


    public function placePhotos($photoReference)
    {
        // Replace 'your-api-key-here' with your actual Google API key
        $apiKey = 'AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4';

        $url = 'https://maps.googleapis.com/maps/api/place/photo';
        $params = [
            'maxwidth' => 400, // Set the desired image width
            'photoreference' => $photoReference,
            'key' => $apiKey,
        ];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            // Return the image as a response with the correct content type.
            return response($response->body(), 200)->header('Content-Type', 'image/jpeg');
        } else {
            // Handle the case where the request to fetch the photo was not successful.
            return response('Error fetching place photo', 500); // Return a 500 Internal Server Error status.
        }
    }




    public function main()
    {
        $placeId = $this->getPlaceId();
        $photoReferences = $this->placeDetails($placeId);
        $photos = $this->placePhotos($photoReferences[0]);

        // You can return or further process the $photos here
    }


    public function TrendingHotels()
    {
        $api_key = 'AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4';
        $location = '24.8607,67.0011';
        $radius = '5000';
        $keyword = 'hotel';
        $type = 'lodging';


        $url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?location={$location}&radius={$radius}&keyword={$keyword}&type={$type}&key={$api_key}";


        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $hotels = [];

        foreach ($data['results'] as $place) {
            $name = $place['name'];
            $rating = isset($place['rating']) ? $place['rating'] : 'N/A';
            $hotels[] = [
                'Name' => $name,
                'Rating' => $rating,
            ];
        }

        return response()->json(['hotels' => $hotels]);
    }




    function accessToken()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://test.api.amadeus.com/v1/security/oauth2/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'client_id=APswhARrY6Ol6DRwatMX9JgQjoVEyfT7&client_secret=CxGei6Z7UKogBAES&grant_type=client_credentials',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        //return $response;
        $responseArray = json_decode($response, true);
        if ($responseArray !== null) {
            $accessToken = $responseArray['access_token'];
            return $accessToken;
        }
    }
}
