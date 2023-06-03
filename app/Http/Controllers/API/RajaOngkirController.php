<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Province;
use App\Models\Regency;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function cost(Request $request)
    {

        $client = new Client();

        $response = $client->post('https://api.rajaongkir.com/starter/cost', [
            'headers' => [
                'key' => '0e90c989952dff48a43db11819315d90'
            ],
            'form_params' => [
                'origin' => $request->origin,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body, true)['rajaongkir']['results'];

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
        //     CURLOPT_HTTPHEADER => array(
        //         "content-type: application/x-www-form-urlencoded",
        //         "key: 0e90c989952dff48a43db11819315d90"
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     echo $response;
        // }
        // return Province::all();
    }

    public function provinces()
    {
        $client = new Client();

        $response = $client->get('https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => '0e90c989952dff48a43db11819315d90'
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body, true)['rajaongkir']['results'];

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }
    public function regencies($provincies_id)
    {
        $client = new Client();

        $response = $client->get('https://api.rajaongkir.com/starter/city?province=' . $provincies_id, [
            'headers' => [
                'key' => '0e90c989952dff48a43db11819315d90'
            ]
        ]);

        $body = $response->getBody();
        $result = json_decode($body, true)['rajaongkir']['results'];

        return response()->json([
            'status' => 'success',
            'data' => $result
        ]);
    }
}
