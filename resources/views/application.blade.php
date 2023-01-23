<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Examen Big Data</title>
    <link
      href="https://fonts.googleapis.com/css?family=Montez|Lobster|Josefin+Sans|Shadows+Into+Light|Pacifico|Amatic+SC:700|Orbitron:400,900|Rokkitt|Righteous|Dancing+Script:700|Bangers|Chewy|Sigmar+One|Architects+Daughter|Abril+Fatface|Covered+By+Your+Grace|Kaushan+Script|Gloria+Hallelujah|Satisfy|Lobster+Two:700|Comfortaa:700|Cinzel|Courgette"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="{{ asset(mix('css/main.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/iconfont.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/material-icons/material-icons.css')) }}">
    <link rel="stylesheet" href="/vuesax/vuesax.css">
    <link rel="stylesheet" href="{{ asset(mix('css/prism-tomorrow.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    
    <style>
      :root{
        --vprimary:  "#910fc5";
        --vblack: #000000
      }
      .line-vs-tabs {
        box-shadow: none !important;
        border: 2px solid var(--vprimary);
      }
    </style>
    <script>
      var user = "";
      var brand = "";
      var user_role = "";
      Date.prototype.yyyymmdd = function() {
          var mm = this.getMonth() + 1;
          var dd = this.getDate();

          return [this.getFullYear(),
                  (mm>9 ? '' : '0') + mm,
                  (dd>9 ? '' : '0') + dd
                ].join('');
        };
    </script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="">
  </head>
  <body>
    <noscript>
      <strong>We're sorry but Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
    </noscript>
    <div id="app">
    </div>

    <!-- <script src="js/app.js"></script> -->

    <script src="{{ asset(mix('js/app.js')) }}"></script>



  </body>
</html>
<style>
  body{
    padding:0px !important
  }
  .swal2-container{
    z-index: 999999 !important;
  }
  .paypal-button{
    height: 38px;
    display: flex;
    align-content: center;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    flex-wrap: nowrap;
  }
  .zoid-outlet{
    width: 100% !important;
  }
</style>