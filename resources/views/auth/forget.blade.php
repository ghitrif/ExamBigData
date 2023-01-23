
<!DOCTYPE html>
<html>
<head>
  <title>Reset password</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="/login1/css/style.css">

   <style>
      :root{
        --vprimary: #7367F0;
      }
  </style>

</head>
<body>
  <div class="container">
    <!--login form -->
    <div id="login" class="row col-lg-12 col-md-12 col-sm-12 col-12">
      
      <div class="col-lg-5 col-md-6 col-sm-12 col-12 login-form">
        <h4>Reset password</h4>
            @if (session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
            <form class="login-form" method="POST" action="/password/reset">

            @csrf
            <div class="form-group">
              <input required name="email"  type="text" class="form-control form-control-lg" placeholder="Enter your email">
              <svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>

              @if ($errors->has('email'))
                <span style="color: #f73c74;" class="error">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="login-btn">
              <button class="btn btn-primary">Reset</button>
            </div>
          </form>
      </div>
    </div>
    
  </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript" src="/login1/js/login.js"></script>

</body>
</html>