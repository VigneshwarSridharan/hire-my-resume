<?php

namespace App\Http\Controllers;

use App\Star;
use App\Rating;
use App\Resume;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $ratings = Rating::all()->toArray();
        $star = Star::where('resume_id','=', $id)->get()->toArray();
        $ratings = array_map(function($item)use($star) {
            $inx = array_search($item['id'], array_column($star, 'rating_id'));
            if($inx === false) {
                $item['stars'] = '0';
            }
            else {
                $item['stars'] = $star[$inx]['stars'];
            }
            return $item;
        },$ratings);
        return view('admin.reviewResume')->with([
            "ratings" => $ratings
        ]);
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
    public function store(Request $request,$id)
    {
        $data = [];
        $resume = Resume::find($id);
        if($resume->status != 'RATED') {
            $resume->status = 'RATED';
            $resume->save();
            $total=0;
            foreach ($request->rating as $key => $value) {
                $data[] = [
                    "resume_id" => $id,
                    "rating_id" => $key,
                    "stars" => $value,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ];
                $total += $value;
            }
            Star::insert($data);
            $average = $total / count($request->rating);

            $mailData= ['name' => $resume->name];
            if($average > 4) {
                $mailData['msg'] = "Your CV has been assessed! We have found obvious areas of improvement although in general, this is a good start! In order to bring your CV to the next level, you can consider one of our promotions for a full CV 'makeover' here. (Our Get Hired Fast! kit offers our advise on which employers & industries you should be specifically targeting with your CV. 30 day callback guaranteed or you shall receive a full refund)";
            }
            else if($average >= 3 && $average <= 4) {
                $mailData['msg'] = "Your CV has been assessed! We believe your resume might encounter some challenges in the market today due to some fundamental flaws. We highly recommend you to improve your chances by allowing our expert to provide you a full CV 'makeover' here. (Our Get Hired Fast! kit offers our advise on which employers & industries you should be specifically targeting with your CV. 30 day callback guaranteed or you shall receive a full refund)";
                
            }
            else {
                $mailData['msg'] = "Your CV has been assessed! Unfortunately your resume requires a complete redo in order to be presentable. We strongly urge you to take advantage of our promotion and allow our experts to write your CV from scratch and make it presentable and attractive to your potential employers! Get started here. (Our Get Hired Fast! kit offers our advise on which employers & industries you should be specifically targeting with your CV. 30 day callback/interview is guaranteed or you shall receive a full refund)";

            }
            Mail::send('mail.basic', $mailData, function($message) use ($resume) {
                $message->to($resume->email, $resume->name)
                        ->subject(setting('site.title'));
                $message->from('admin@gmail.com',setting('site.title'));
            });
        }
        return redirect()->route('voyager.resumes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
