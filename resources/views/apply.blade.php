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

                           <div class="name">*Upload CV</div>

                            <div class="value">
                                
                                <div class="upload-cv">

                                    <div class="input-group js-input-file">
    
                                        <input class="input-file" type="file" name="resume" id="file" accept="application/pdf,application/msword,.doc, .docx" required >
    
                                    </div>
    
                                    
    
                                    <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 5 MB</div>
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

        $('#quote-form [name="resume"]').on('change', function(e) {
            let target = e.target;
            if (target.files && target.files[0]) {
                const maxAllowedSize = 5 * 1024 * 1024;
                if (target.files[0].size > maxAllowedSize) {
                    alert("File is too big!");
                    $('#quote-form [name="resume"]').val('')
                }
            }
        })

        
    </script>
@endsection