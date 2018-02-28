<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    /**
     * Main view
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        return view('index',['date' => \Carbon\Carbon::now() ]);
    }

    /**
     * Birthday controller
     *
     * @param Illuminate\Http\Request
     *
     * @return Illuminate\View\View
     */
    public function submit(Request $request)
    {
        $validatedData = $request->validate([
            'birthday' => 'required|date|after:'.\Carbon\Carbon::parse('-1 year')->toDateString().'|before:now'
        ]);

        //find entry or create new
        $birthday = \App\Birthday::firstOrCreate(['birthday' => $validatedData['birthday'] ]);
        $birthday->times_requested += 1;

        //only call API if entry has no exchange value yet
        if(is_null($birthday->rate)){
            //fetch API data
            try {
                $client = new \GuzzleHttp\Client();
                $res = $client->request('GET', 'https://api.fixer.io/'.\Carbon\Carbon::parse($validatedData['birthday'])->toDateString().'?base=GBP&symbols=EUR',['timeout' => 3]);
                $rate = json_decode($res->getBody());

                $birthday->rate = $rate->rates->EUR;
            } catch (\Exception $e) {
                return view('index',['date' => $validatedData['birthday']])->withErrors(['msg', 'API unavailabe']);
            }
        }
        $birthday->save();

        return view('index',['date' => $validatedData['birthday']]);
    }
}
