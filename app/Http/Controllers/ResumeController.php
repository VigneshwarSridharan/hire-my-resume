<?php

namespace App\Http\Controllers;

use App\Resume;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $resume = new Resume;
        $resume->name = $request->name;
        $resume->email = $request->email;
        $resume->phone_number = $request->phone_number;
        $resume->experience = $request->experience;
        $resume->industry = $request->industry;
        if(isset($request->service)) {
            $resume->service = implode(",",$request->service);
        }
        else {
            $resume->service = '';
        }
        $resume->have_cv = isset($request->have_cv);
        if($request->hasFile('resume')) {
            $directory = 'resume/'.Carbon::now()->format('FY').'/';
            $path = $request->file('resume')->store($directory,'public');
            $resume->resume = $path;
        }
        $resume->status = 'NOT_RATED';
        $resume->save();
        $request->session()->flash('status', 'Thanks for submiting!');
        return view('quote');
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
