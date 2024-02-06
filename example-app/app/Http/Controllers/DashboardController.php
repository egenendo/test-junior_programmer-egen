<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Travel;
use Validator;


class DashboardController extends Controller
{
    public function index(Request $request){
        \DB::beginTransaction();
        try {
            \DB::commit();

            $data = [
                
            ];
            // dd($data);
            return view('pages.dashboard', $data);
        } catch (\Throwable $e) {
            dd($e->getMessage());
            \DB::rollback();
            return redirect()->route('home')->with('error', 'Terjadi Kesalahan! (' . $e->getMessage() . ')');
        }

    }

    public function create(Request $request){
        \DB::beginTransaction();
        try {
            \DB::commit();
            $date = Carbon::now()->format('Y-d-m');

            $data = [
                "date" => $date,
            ];
            
            return view('pages.create', $data);
        } catch (\Throwable $e) {
            dd($e->getMessage());
            \DB::rollback();
            return redirect()->route('home')->with('error', 'Terjadi Kesalahan! (' . $e->getMessage() . ')');
        }

    }

    public function store(Request $request){
        \DB::beginTransaction();
        try {
            \DB::commit();
            $rules = [
                'travel_type' => 'required',
                'destination' => 'required',
                'reason' => 'required',
                'latter_date' => 'required',
                'startdate_enddate' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $travel = new Travel;
            $travel->travel_type = $request->travel_type;
            $travel->request_name = $request->request_name;
            $travel->destination = $request->destination;
            $travel->status_aproval = $request->status_aproval;
            $travel->reason = $request->reason;
            $travel->latter_date = $request->latter_date;
            $travel->startdate_enddate = $request->startdate_enddate;
            $travel->save();

            dd($travel);
            return redirect('/index');

        } catch (\Throwable $e) {
            dd($e->getMessage());
            \DB::rollback();
            return redirect()->route('home')->with('error', 'Terjadi Kesalahan! (' . $e->getMessage() . ')');
        }

    }
}
