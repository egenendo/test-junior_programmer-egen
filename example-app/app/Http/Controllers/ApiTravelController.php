<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiTravelController extends Controller
{
    public function getData(Request $request)
    {
        $response = defaultAPIResponse();
        try {
            $response2 = 'hello';
            // \DB::beginTransaction();

            // $priceDropDown = [
            //     "0-500" => 'Semua',
            //     "0-25" => 'Dibawah 25 juta',
            //     "25-500" => 'Diatas 25 juta',
            // ];
            // $package_fit = [
            //     "2" => 'Semua',
            //     "1" => 'Individual',
            //     "0" => 'Group',
            // ];

            // $data = [
            //     "priceDropDowns" => $priceDropDown,
            //     "package_fit" => $package_fit,
            // ];

            // $response['status'] = 'success';
            // $response['code'] = 200;
            // $response['data'] = $data;
            return $response2;
            // \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            $error = error($e, getErrorMsg());
            $response = array('status' => 'error', 'code' => 500, 'message' => $error);
        }
        return $response2;

    }
}
