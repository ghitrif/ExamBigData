
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/login1/css/style.css">

   <style>
      :root{
        --vprimary: #910fc5;
        
      }
     
  </style>

</head>
<body style="background:#dfe4ed">
  <div class="container" style="    margin: 0px;
    padding: 0px;
    width: 100%;
    max-width: 100%;
    overflow: hidden;">
    <!--login form -->
    <div id="login" class="row">
      
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 login-form" style="height: 100vh;    height: 100vh;
    background: linear-gradient(
212.38deg, rgb(242 57 127 / 39%) 0%, rgb(175 70 189 / 67%) 100%), url(/images/login.jpg);
    background-repeat: no-repeat;
    background-size: 100% 100%;">
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12 login-form" style="height: 100vh;    display: flex;
    align-content: center;
    align-items: center;
    justify-content: center;">
        
            <form class="login-form" method="POST" action="{{ route('plogin') }}" style="width:100%">
            <h4>Welcome Back !</h4>
         @if (session('message'))
            <div class="alert alert-danger" style="color: #f73c74;">
                {{ session('message') }}
            </div>
            @endif
            @csrf
            <div class="form-group">
              <input  required name="email"  type="text" class="form-control_  form-control-lg" placeholder="Username">
             

              @if ($errors->has('email'))
                <span style="color: #f73c74;" class="error">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="form-group">
              <input  required name="password"  type="password" class="form-control_ form-control-lg" placeholder="Password">
                      
              @if ($errors->has('password'))
                <span style="color: #f73c74;" class="error">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="remember-forgot-div">
              
              <span class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Remember
                  </label>
                </span>
              <a href="/password/forget">Forgot password?</a>
            </div>
            <div class="login-btn">
              <button class="btn btn-primary" style="    border-radius: 27px;
    height: 47px;">Log in</button>
            </div>
          </form>
      </div>
    </div>
    
  </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript" src="/login1/js/login.js"></script>
  <style>
      .form-control_{
        border-radius: 30px;
        background: transparent !important;
        background-color: transparent !important;
        width: 100%;
        border: 1px solid #00000026;
      }
  </style>
</body>
</html>