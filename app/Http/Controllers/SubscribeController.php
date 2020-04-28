<?php

namespace App\Http\Controllers;

use Config;
use App\Resume;
use App\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscribeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('apply');
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
        $resume = new Resume;
        $checkUser = Resume::where('email','=',$request->email)->get()->toArray();
        $resume->name = $request->name;
        $resume->email = $request->email;
        // $resume->phone_number = $request->phone_number;
        // $resume->experience = $request->experience;
        // $resume->industry = $request->industry;
        // if(isset($request->service)) {
        //     $resume->service = implode(",",$request->service);
        // }
        // else {
        //     $resume->service = '';
        // }
        // $resume->have_cv = isset($request->have_cv);
        if($request->hasFile('resume')) {
            $directory = 'resume/'.Carbon::now()->format('FY').'/';
            $path = $request->file('resume')->store($directory,'public');
            $resume->resume = $path;
        }
        $resume->status = 'NOT_RATED';
        $resume->save();
        $request->session()->flash('status', 'Thanks for submiting!');

        if(count($checkUser) == 0) {
            $mailData = [];
            $from = config('mail.from.address');
            Mail::send('mail.welcome', $mailData, function($message) use($resume,$from) {
                $message->to($resume->email, $resume->name)
                        ->subject(setting('site.title'));
                $message->from($from,setting('site.title'));
            });
        }
        return redirect()->route('resume');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        //
    }
}
