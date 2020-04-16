@extends('layout.main')

@section('header-content')
    <div class=" p-t-100">

        <div class="wrapper wrapper--w900">

            <div class="card card-6">

                <div class="card-heading">

                    <h2 class="title">Apply for resume</h2>

                </div>

                <div class="card-body">

                    <form method="post" enctype="multipart/form-data" id="quote-form" name="quote-form" >
                        @csrf
                        @if(Session::has('status'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success!</strong> {{Session::get('status')}}
                                </div>
                        @endif
                        <div class="form-row">

                            <div class="name">*Full name</div>

                            <div class="value">

                                <input class="input--style-6" type="text" name="name" required>

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="name">*Email address</div>

                            <div class="value">

                                <input class="input--style-6" type="email" name="email" placeholder="example@email.com" required>

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="name">*Number</div>

                            <div class="value phone-number">
                                <span>+60</span>
                                <input class="input--style-6" type="text" name="phone_number" placeholder="" required>

                            </div>

                        </div>
                        
                        <div class="form-row">

                            <div class="name">*Experience Level</div>

                            <div class="value">

                                <select id="experience" name="experience" class="input--style-6 select--style-6" required>

                                    <option value="0-5">0-5 years of experience</option>

                                    <option value="6-15">6-15 years of experience</option>


                                  </select>

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="name">*Industry</div>

                            <div class="value">

                                <select id="industry" name="industry" class="input--style-6 select--style-6" required>

                                    <option value="">Choose One</option>

                                    <option value="IT">IT</option>

                                    <option value="Finance">Finance</option>

                                    <option value="HR">HR</option>
                                    
                                    <option value="Engineering">Engineering</option>

                                  </select>

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="name">*Services </div>

                            <div class="value">

                                <label class="margin-15r">
                                    <input type="checkbox" name="service[]" value="Fix my resume" /> Fix my resume
                                </label>
                                <label class="margin-15r">
                                    <input type="checkbox" name="service[]" value="I need a cover letter" /> I need a cover letter
                                </label>
                                <label class="margin-15r">
                                    <input type="checkbox" name="service[]" value="Fix my LinkedIn profile" /> Fix my LinkedIn profile
                                </label>
                                <label class="margin-15r">
                                    <input type="checkbox" name="service[]" value="Career Guidance" /> Career Guidance
                                </label>

                            </div>

                        </div>

                        

                            

                        <div class="form-row">

                           <div class="name">*Upload CV</div>

                            <div class="value">
                                
                                <div class="upload-cv">

                                    <div class="input-group js-input-file">
    
                                        <input class="input-file" type="file" name="resume" id="file" required >
    
                                    </div>
    
                                    
    
                                    <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 5 MB</div>
                                </div>
                                <input type="checkbox" class="upload-cv-toggle" name="have_cv" value="1"> I don’t have a Resumes

                            </div>

                        </div>

                        <div class="form-row">

                            <div class="name"><input type="checkbox" required></div>

                            <div class="value">

                                <div class="input-group">
										<br>
                                    	I have read and agree to the website <a href="terms.html" target="_blank">terms and conditions</a> *

                                </div>

                            </div>

                        </div>

                        <input class="btn subscribe" name="submit" type="submit" class="btn btn--radius-2 btn--blue-2" style="background-color: #827676;">
                        
                    </form>

                </div>

                

            </div>

        </div>

    </div>
@endsection

@section('script')
    <script>
        $('#quote-form [name="have_cv"]').on('change', function() {
            $('#quote-form [name="resume"]')[0].required = !$(this).prop('checked');
            if($(this).prop('checked')) {
                $('.upload-cv').hide()
            }
            else {
                $('.upload-cv').show()

            }
        })

        
    </script>
@endsection