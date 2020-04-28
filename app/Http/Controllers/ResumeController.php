<?php

namespace App\Http\Controllers;

use Config;
use App\User;
use App\Resume;
use App\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('quote');
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
        $mailData = [];
        $resume = new Subscribe;
        $checkUser = Subscribe::where('email','=',$request->email)->get()->toArray();
        $resume->name = $mailData['name'] = $request->name;
        $resume->email = $mailData['email'] = $request->email;
        $resume->save();
        $mailData['phone_number'] = $request->phone_number;
        $mailData['experience'] = $request->experience;
        $mailData['industry'] = $request->industry;
        if(isset($request->service)) {
            $mailData['service'] = implode(", ",$request->service);
        }
        else {
            $mailData['service'] = '';
        }
        $mailData['have_cv'] = isset($request->have_cv);
        if($request->hasFile('resume')) {
            $directory = 'resume/'.Carbon::now()->format('FY').'/';
            $path = $request->file('resume')->store($directory,'public');
            $mailData['resume'] = asset($path);
        }
        $request->session()->flash('status', 'Thanks for submiting!');

        $from = config('mail.from.address');
        if(count($checkUser) == 0) {
            Mail::send('mail.welcome', [], function($message) use($resume,$from) {
                $message->to($resume->email, $resume->name)
                        ->subject(setting('site.title'));
                $message->from($from,setting('site.title'));            
            });
        }
        $admin_users = User::where('role_id','=',3)->get()->toArray();
        $admin_users = array_map(function($item) {
            return $item['email'];
        },$admin_users);
        Mail::send('mail.quote', $mailData, function($message) use($resume,$from,$admin_users) {
            $message->to($admin_users)
                    ->subject(setting('site.title'));
            $message->from($from,setting('site.title'));            
        });
        return redirect()->route('quote');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function edit(Resume $resume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resume $resume)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resume  $resume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resume $resume)
    {
        //
    }
}
