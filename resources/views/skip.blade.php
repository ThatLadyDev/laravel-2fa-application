<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Skip 2FA</title>
</head>
<body>
    <div class="faq container" style="display: flex;align-items: center;height: 100vh;">
        <div class="faq-layouting layout-spacing" style="width: 100%;">
            <div class="fq-comman-question-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center pb-3 mb-3" style="border-bottom: 1px solid #191e3a;">Protect your account with 2FA</h3>
                        <p class="text-center text-white" style="font-size: 16px;letter-spacing: 1px;">An extra security will only help!</p>
                        <p class="text-center mb-5" style="font-size: 14px;">We care about the safety of your assets on this platform so, we strongly recommend you add an extra layer of security using a two factor authenticator application like <strong class="text-danger">Google Authenticator</strong>.</p>
                        
                        <div class="row mb-5">
                            <div class="col-md-6 text-center mb-lg-0 mb-4">
                                <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">
                                    <img src="{{ asset('assets/img/android.png') }}">
                                </a>
                            </div>
                            <div class="col-md-6 text-center">
                                <a href="https://itunes.apple.com/us/app/google-authenticator/id388497605?mt=8">
                                    <img src="{{ asset('assets/img/iphone.png') }}">  
                                </a>
                            </div>
                        </div>
                        <div class="row mb-5 mx-5">
                            <div class="col-6">
                                <a id="setUp2Fa" href="javascript:void(0);" class="btn btn-success btn-lg col-12 mr-5">
                                    <i class="fa fa-user-secret"></i> Setup 2FA
                                </a>
                            </div>
                            <div class="col-6">
                                <a id="skip2Fa" href="javascript:void(0);" class="btn btn-danger btn-lg col-12">Skip</a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
<script>
    $('#setUp2Fa').on('click', function(){
        $.post('/user/setup/2fa',{
            _token  :   $('meta[name="csrf-token"]').attr('content'),
            setup   :   'YES'
        },
        function(response){
            if(response.success == 'true'){
                location.reload();
            }
            else{
                swal({
                    title: 'Error!',
                    text: "An Error Occured With The System! Please Try Again",
                    type: 'warning',
                    padding: '2em'
                });
                $(document).on('click', function(){
                    location.reload();
                });
            }
        });
    });

    $('#skip2Fa').on('click', function(){
        $.post('/user/skip/2fa',{
            _token  :   $('meta[name="csrf-token"]').attr('content'),
            skip    :   'YES'
        },
        function(response){
            if(response.success == 'true'){
                location.reload();
            }
        });
    });
</script>
</html>