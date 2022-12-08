<?php

namespace App\Http\Controllers;

use App\Jobs\MakeApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Auth;

class MakeApiRequestController extends Controller
{
    public function store(Request $request)
    {

        if (Auth::guard('api')->check()) {
            $csv    = file(public_path() . "/Sample-Data.csv");
            $chunks = array_chunk($csv, 1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new MakeApiRequest($data, $header));
            }
            $response = [
                'success' => true,
                'status_code' => 200,
                'message' => 'Job created successfully',
                'data'=>$batch
            ];
            return response()->json($response, 200);           
        }else{
            $response = [
                'success' => false,
                'status_code' => 401,
                'message' => 'Unauthorized'
            ];
            return response()->json($response, 401);
        }
    }
}
