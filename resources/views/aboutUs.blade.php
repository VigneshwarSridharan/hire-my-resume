@extends('layout.main')

@section('content')
    <section class="p-t-20">
    <div style="background-color: #f5f5f5;">
        <div class="container">
            <div class="row" style="display: flex; align-items: center">
                <div class="col-sm-6" style="padding-right: 0">
                    <img src="{{url('/assets/img/about-bg-1.jpg')}}" class="img-responsive" />
                </div>
                <div class="col-sm-6">
                    <h2 style="margin: 16px 0; color: #4bc3de">Professional Recruiters for Malaysians</h2>
                    <p>Our strength is in our team. With experienced recruiters on your side, your chance of being noticed increases dramatically. Having a great resume and platform provides you the advantage over the rest. Our team is thrilled to help you level-up and get noticed by your potential employers.</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="container">
            <div class="row" style="margin-bottom: 16px; display: flex; align-items: center">
                <div class="col-sm-6">
                    <h2 style="margin: 16px 0; color: #4bc3de">Build your brand, your future</h2>
                    <p>Every job seeker is on a career path, the same way that every job seeker is his or her own brand. Just like how great products are made by great brands, your documents and personal profile deserve a great write up. Most Malaysians skip this section, which is why you have the opportunity to take that next step and build your own brand with HireMyResume. We do not just write resumes; we pride ourselves in building you your own brand!</p>
                </div>
                <div class="col-sm-6" style="padding-left: 0">
                    <img src="{{url('/assets/img/about-bg-2.jpg')}}" class="img-responsive" />
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection