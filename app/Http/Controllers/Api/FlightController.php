<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FlightData;
use App\Models\Traveller;
use App\Models\Country;


use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function __construct(){
        $this->section = new \stdClass();
        $this->section->title = 'City Tour';
        $this->section->heading = 'City Tour';
        $this->section->slug = 'cityTour';
        $this->section->Baseurl=  "https://test.api.amadeus.com/v2/";
        $this->section->Baseurl2=  "https://test.api.amadeus.com/v1/";
        $this->section->Baseurl3=  "https://airlabs.co/api/v9/";

    }

    public function index()
    {
        echo "dddd";
    }

    //first search flights 1st
    public function flightsearchOffer(Request $request){
        //dd($request->all());

        $token=$this->accessToken();
        $section=$this->section;
        $base=$section->Baseurl;
//        dd($base);
        if($request->returnDate && $request->nonStop){
            //return 2;
            $mainurl=$base."shopping/flight-offers?originLocationCode=".$request->originLocationCode."&destinationLocationCode=".$request->destinationLocationCode."&departureDate=".$request->departureDate."&returnDate=".$request->returnDate."&adults=".$request->adults."&children=".$request->children."&infants=".$request->infants."&max=".$request->max."&nonStop=".$request->nonStop."&currencyCode=".$request->currencyCode;
        }elseif($request->returnDate){
            //return 4;
            $mainurl=$base."shopping/flight-offers?originLocationCode=".$request->originLocationCode."&destinationLocationCode=".$request->destinationLocationCode."&departureDate=".$request->departureDate."&returnDate=".$request->returnDate."&adults=".$request->adults."&children=".$request->children."&infants=".$request->infants."&max=".$request->max."&currencyCode=".$request->currencyCode;
        }elseif($request->nonStop){
            //return 3;
            $mainurl=$base."shopping/flight-offers?originLocationCode=".$request->originLocationCode."&destinationLocationCode=".$request->destinationLocationCode."&departureDate=".$request->departureDate."&adults=".$request->adults."&children=".$request->children."&infants=".$request->infants."&max=".$request->max."&nonStop=".$request->nonStop."&currencyCode=".$request->currencyCode;

        }else{
            // return 5;
            $mainurl=$base."shopping/flight-offers?originLocationCode=".$request->originLocationCode."&destinationLocationCode=".$request->destinationLocationCode."&departureDate=".$request->departureDate."&adults=".$request->adults."&children=".$request->children."&infants=".$request->infants."&max=".$request->max."&currencyCode=".$request->currencyCode;
        }

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
                'Authorization: Bearer '.$token
            ),
        ));
        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        return $response;

    }

    // for flight pricing  2nd
    public function flightOfferPrice(Request $request){

        $section = $this->section;
        $base = $section->Baseurl2;

        $jsonData = $request->all();

        $token = $this->accessToken();
        $curl = curl_init();
        $apiUrl = $base.'shopping/flight-offers/pricing';
        $requestMethod = 'POST';
        $headers = array(
            'X-HTTP-Method-Override: GET',
            'Content-Type: application/json',
            'Authorization: Bearer '.$token, // Replace with your Amadeus API key
        );

        $requestData = json_encode($jsonData);

        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        return $response;


    }

    //for flight ki body jai gi  3rd
    public function flightOfferCreate(Request $request) {
        $section = $this->section;
        $base = $section->Baseurl2;
        $jsonData = $request->all();

        if (!($jsonData['data']['travelers'])) {
            return response()->json(['error' => 'Missing or empty "travelers" array'], 400);
        }
        foreach ($jsonData['data']['travelers'] as $traveler) {
        if (!empty($traveler['documents'][0])) {

            foreach($traveler['documents'] as $document){
                // dd('burhan');
                 $documentType = $document['documentType'];
                 $issuanceLocation = $document['issuanceLocation'];
                 $issuanceDate = $document['issuanceDate'];
                 $passport_number = $this->isValidPassportExpiry($document['number']);
                 $expiryDate = $document['expiryDate'];
                 $issuanceCountry = $document['issuanceCountry'];
                 $validityCountry = $document['validityCountry'];
                 $nationality = $document['nationality'];
                 $holder = $document['holder'];
                 $rr=$this->isPassportValidForSixMonths($expiryDate);
                 if($rr == 0){
                     return "passport is not valid or it should be valid till 6 months";
                 }
                 if($passport_number == 0){
                     return "passport number is not valid";
                 }
                 if (!preg_match('/^[A-Z]{2}$/', $nationality)) {
                    return "Nationality must be a valid two-letter country code.";
                }
                if (!preg_match('/^[A-Z]{2}$/', $validityCountry)) {
                    return "validity Country must be a valid two-letter country code.";
                }
                if (!preg_match('/^[A-Z]{2}$/', $issuanceCountry)) {
                    return "issuance Country must be a valid two-letter country code.";
                }
            }

        }else{
            return response()->json(['error' => 'All document fields must be provided for each traveler'], 400);

                }

            }


        $token = $this->accessToken();
        $curl = curl_init();
        $apiUrl = $base . 'booking/flight-orders';
        $requestMethod = 'POST';
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $token,
        ];
        $requestData = json_encode($jsonData);
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $requestMethod);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (curl_errno($curl)) {
            return response()->json(['error' => 'Curl error: ' . curl_error($curl)], $httpStatus);
        }
        if ($httpStatus >= 400) {
            return response()->json(['error' => $response], $httpStatus);
        }
        curl_close($curl);
        $responseData = json_decode($response, true);
        return response()->json($responseData, $httpStatus);
    }
    function isValidPassportExpiry($passportExpiry) {
        return preg_match('/^[A-Za-z0-9]{9}$/', $passportExpiry);
    }

// Custom function to check if the passport is valid for at least 6 months before the flight
    function isPassportValidForSixMonths($passportExpiry, $referenceDate = null) {
        if ($referenceDate === null) {
            $referenceDate = date('Y-m-d');
        }

        $sixMonthsAhead = date('Y-m-d', strtotime('+6 months', strtotime($referenceDate)));

        return strtotime($passportExpiry) >= strtotime($sixMonthsAhead);
    }



    // 4th
    public function FlightOfferCreateDetails(Request $request) {
        $data = $request->all();


        $flightDetails = $data['flightDetails'];

       $flightdata=[
        'travelorId' => $flightDetails['travelorId'],
        'flightId' => $flightDetails['flightId'],
        'originLocation' => $flightDetails['originLocation'],
        'originDestination' => $flightDetails['originDestination'],
        'totalPrice' => $flightDetails['totalPrice'],
        'cabinClass' => $flightDetails['cabinClass'],
        'date' => $flightDetails['date'],
        'noOfTravelers' => $flightDetails['noOfTravelers'],
        'departureDate' => $flightDetails['departureDate'],
        'departureTerminal' => $flightDetails['departureTerminal'] ?? null,
        'arrivalDate' => $flightDetails['arrivalDate'] ?? null,
        'arrivalTerminal' => $flightDetails['arrivalTerminal'] ?? null,
        'carrierCode' => $flightDetails['carrierCode'],
        'flightNumber' => $flightDetails['flightNumber'],
        'adultId' => $flightDetails['adultId'],
        'childrenId' => $flightDetails['childrenId'],
        'infantsId' => $flightDetails['infantsId'],
        'associatedAdultId' => $flightDetails['associatedAdultId'],
        'Payment_status' => $flightDetails['Payment_status'],
        'Booking_status' => $flightDetails['Booking_status'],
        'txn_id' => $flightDetails['txn_id'],
        'customer_id' => $flightDetails['customer_id'],

       ];


      $insertflightData=FlightData::Create($flightdata);

       foreach($data['travelers'] as $travel){

            $travelData['firstName'] = $travel['firstName'];
            $travelData['lastName'] =$travel['lastName'];
            $travelData['passportNumber'] =$travel['passportNumber'];
            $travelData['phone'] = $travel['phone'][0]['number'];
            $travelData['email'] =$travel['email'];
            $travelData['dateOfBirth'] =$travel['dateOfBirth'];
            $travelData['flight_id'] =$insertflightData->id;
            $inserttravellerData=Traveller::Create($travelData);


        }



      return response()->json(['message' => 'Flight and traveler data inserted successfully']);
    }


    public function flightfiltersearch(Request $request)
    {

        //dd($request->all());

        $token = $this->accessToken();
        $section = $this->section;

        $base = $section->Baseurl3;
        // dd($base);
        $mainurl = $base . "suggest?q=" . $request->q . "&api_key=67d5bd50-b7b2-454a-8e38-28684f68c27b";



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

    public function getCitiesByISO2($query)
    {
        $countryCodeData = Country::where('city_ascii', $query)
            ->orWhere('country', $query)
            ->first();

        if (!$countryCodeData) {
            return response()->json(['error' => 'country code not found'], 404);
        }

        $countryCode = $countryCodeData->iso2;

        return response()->json(['country_code' => $countryCode]);
    }




    function accessToken(){

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
            CURLOPT_POSTFIELDS => 'client_id=RqTJah9DGB4PMxoBeU9HTDe1xTsY0sFu&client_secret=GJjTl1kvtPJTYi9s&grant_type=client_credentials',
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
