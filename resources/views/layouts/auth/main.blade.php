<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            height: 100vh;
            padding: 40px;
            font-family: 'Roboto', sans-serif;
            /* background: url('https://www.omnihotels.com/-/media/images/hotels/nycber/destinations/nyc-aerial-skyline.jpg?h=660&la=en&w=1170')no-repeat center center; */
            background-size: cover;
        }

        /*Sign In Form*/
        .signin {
            position: relative;
            height: 600px;
            width: 500px;
            margin: auto;
            /* box-shadow: 0px 30px 100px -5px #000; */
        }

        /*Background Img*/
        .back-img {
            position: relative;
            width: 100%;
            height: 250px;
            background: url('https://www.omnihotels.com/-/media/images/hotels/nycber/destinations/nyc-aerial-skyline.jpg?h=660&la=en&w=1170')no-repeat center center;
            background-size: cover;
        }

        .layer {
            background-color: rgba(33, 150, 243, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .active {
            padding-left: 25px;
            color: #fff;
        }

        .nonactive {
            color: rgba(255, 255, 255, 0.6);
        }

        .sign-in-text {
            top: 175px;
            position: absolute;
            z-index: 1;
        }

        h2 {
            padding-left: 15px;
            font-size: 25px;
            text-transform: uppercase;
            display: block;
            font-weight: 300;
        }

        .point {
            position: absolute;
            z-index: 1;
            color: #fff;
            top: 235px;
            padding-left: 50px;
            font-size: 20px;
        }

        /*form-section*/
        .form-section {
            padding: 20px 90px 70px 90px;
        }



    </style>

</head>

<body class="bg-opacity-10 justify-center align-items-center">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            @yield('contents')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('template/js/scripts.js') }}"></script>
</body>

</html>
