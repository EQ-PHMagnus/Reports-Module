<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>PHMagnus</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <link rel="stylesheet" href="{{asset('css/app.css')}}" />
    
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");
      html {
        font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      }

      body{
       background-image: url('landing/header.png');
      }
    </style>
  </head>

  <body class="leading-normal tracking-normal text-white-400  bg-cover bg-fixed">
    <div class="h-full">
      <!--Nav-->
      <div class="sticky top-0 w-full p-5 bg-indigo-200 bg-opacity-50">
        <div class=" w-full flex items-center justify-between">
          <a class="flex items-center text-indigo-400 no-underline hover:no-underline font-bold text-2xl lg:text-4xl" href="#">
            <span class="sr-only">Magnus</span>
            <img class="h-14 w-auto " src="{{asset('/assets/images/log-full.PNG')}}" alt="">
          </a>
        </div>
      </div>

       
      <div class="container w-full pt-24 md:pt-36 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full xl:w-2/5 justify-center lg:items-start overflow-y-hidden">
          <h1 class="my-4 text-3xl md:text-5xl text-white opacity-75 font-bold leading-tight text-center md:text-left">
            Empowering players on a whole new gaming experience
          </h1>
          <a
                class="bg-red-600 text-white font-bold mt-5 py-2 px-4 w-1/2 text-center rounded focus:ring transform transition hover:scale-105 duration-300 ease-in-out self-center"
                href="https://sir.vosa.dev"
              >
                Start Playing
              </a>
        </div>

        <!--Right Col-->
        <div class="w-full xl:w-3/5 overflow-hidden">
          <img class="mx-auto w-full  transform -rotate-6 transition hover:scale-105 duration-700 ease-in-out hover:rotate-6" src="{{asset('landing/sample2.png')}}" />
        </div>
      <!--Main-->
      </div>
    </div>

    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            A better way to play
          </p>
        </div>

        <div class="mt-10">
          <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-yellow-300 text-white">
                  <span class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    1
                  </span>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Side-by-side betting while watching the current fight</p>
              </dt>
            </div>

            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-yellow-300 text-white">
                  <span class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    2
                  </span>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Easy navigation to see fight details, user's points, payouts per fights, and betting status</p>
              </dt>
            </div>
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-yellow-300 text-white">
                  <span class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                    3
                  </span>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Bigger fight video screen</p>
              </dt>
            </div>
          </dl>
        </div>
      </div>
    </div>

    <!--Footer-->
    <div class="sticky bottom-0 p-5 text-white text-sm text-center md:text-left bg-blue-900 bg-opacity-50">
      &copy; {{date('Y')}} Magnus Gaming Systems Inc. All rights reserved.
    </div>
  </body>
</html>
