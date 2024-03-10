<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Evento</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

        <!-- Styles -->
        <style>
          /* btn search */
          button {
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            color: white;
            background-color: #171717;
            padding: 0.8rem 2em;
            border: none;
            border-radius: .6rem;
            position: relative;
            cursor: pointer;
            overflow: hidden;
          }

          button span:not(:nth-child(6)) {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            height: 30px;
            width: 30px;
            background-color: #0c66ed;
            border-radius: 50%;
            transition: .6s ease;
          }

          button span:nth-child(6) {
            position: relative;
          }

          button span:nth-child(1) {
            transform: translate(-3.3em, -4em);
          }

          button span:nth-child(2) {
            transform: translate(-6em, 1.3em);
          }

          button span:nth-child(3) {
            transform: translate(-.2em, 1.8em);
          }

          button span:nth-child(4) {
            transform: translate(3.5em, 1.4em);
          }

          button span:nth-child(5) {
            transform: translate(3.5em, -3.8em);
          }

          button:hover span:not(:nth-child(6)) {
            transform: translate(-50%, -50%) scale(4);
            transition: 1.5s ease;
          }
  
          /*  */
          .cards {
              padding: 2rem;
              display: flex;
              flex-wrap: wrap;
              justify-content: center;
              gap: 3rem;
          }

          .category-card {
              width: 10rem;
              height: 10rem;
              padding: 1rem;
              /* background-color: #ffe9da; */
              border-radius: 20px;
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              text-align: center;
              /* border: 1px solid black; */
          }

          .category-card img {
              width: 5rem;

          }

          .bout {
              display: flex;
              justify-content: center;
              padding: 1em;
          }

          .bout button {
              width: 10rem;
          }

          .search {
              display: flex;
              justify-content: center;
              gap: 1em;
              padding: 1rem;
          }

          select {
              -webkit-appearance: none;
              -moz-appearance: none;
              -ms-appearance: none;
              appearance: none;
              outline: 0;
              box-shadow: none;
              border: 0 !important;
              background: #f4fffe;
              background-image: none;
              flex: 1;
              padding: 0 .5em;
              cursor: pointer;
              font-size: 1em;
              font-family: 'Open Sans', sans-serif;
          }

          select::-ms-expand {
              display: none;
          }

          .select {
              position: relative;
              display: flex;
              width: 20em;
              height: 3em;
              line-height: 3;
              background: #5c6664;
              overflow: hidden;
              border-radius: .35em;
              border: 1px solid black;
          }

          option {
              text-align: center;
          }

          .select::after {
              content: '\25BC';
              position: absolute;
              top: 0;
              right: 0;
              padding: 0 1em;
              background: #f4fffe;
              height: 2px;
              /* border-bottom: 1px solid black; */

              cursor: pointer;
              pointer-events: none;
              transition: .25s all ease;
          }

          .select:hover::after {
              color: #00b9a8;
          }
        </style>
    </head>

    <body>

        <section class="relative mx-auto">
            <!-- navbar -->
            <nav class="flex justify-between bg-gray-900 text-white w-screen">
                <div class="px-5 xl:px-12 py-6 flex justify-between w-full items-center">
                    <a class="text-3xl font-bold font-heading" href="">
                    Evento
                    </a>
                    @auth
                    <ul class="hidden md:flex px-4 mx-auto font-semibold font-heading space-x-12">
                      @role('Administrateur')                        
                        <li><a class="hover:text-gray-200" href="/dashboard">Dashboard</a></li>
                        <li><a class="hover:text-gray-200" href="/event">Events</a></li>
                        <li><a class="hover:text-gray-200" href="/category">Categories</a></li>
                      @endrole
                      @role('Organisateur')
                      <li><a class="hover:text-gray-200" href="/addEvent">ADD Event</a></li>
                      <li><a class="hover:text-gray-200" href="/myEvents">My Events</a></li>
                      @endrole
                      <li><a class="hover:text-gray-200" href="/">Home</a></li>
                    </ul>
                    <!-- Header Icons -->
                    
                    <!-- Sign In / Register      -->
                    <div class="flex gap-5">
                      {{-- profil --}}
                        <a class="flex items-center hover:text-gray-200" href="/profil">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>      
                        {{-- logout --}}
                        <a class="flex items-center hover:text-gray-200" href="#">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark border border-gray-100 rounded-xl">Log out</button>
                            </form>
                        </a>                  
                    </div>
                    @else
                    <!-- Sign In / Register      -->
                    <div class="flex gap-5">
                      {{-- register --}}
                      <a class="flex items-center hover:text-gray-200" href="/register ">
                            <button type="submit" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark border border-gray-100 rounded-xl">S'enregistrer</button>                    
                      </a>        
                        {{-- login --}}
                        <a class="flex items-center hover:text-gray-200" href="/login">
                          <button type="submit" class="flex-no-grow flex-no-shrink relative py-2 px-4 leading-normal text-white no-underline flex items-center hover:bg-grey-dark border border-gray-100 rounded-xl">Se connecter</button>                           
                        </a>                  
                    </div>
                    @endauth
                </div>
            </nav>
        </section>
        {{-- end navbar --}}


            {{-- content goes here --}}
            @yield('content')

        <section>
            <div class="bg-gray-900">
                <div class="px-4 pt-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
                  <div class="grid row-gap-10 mb-8 lg:grid-cols-6">
                    <div class="grid grid-cols-2 gap-5 row-gap-8 lg:col-span-4 md:grid-cols-4">
                      <div>
                        <p class="font-medium tracking-wide text-gray-300">Category</p>
                        <ul class="mt-2 space-y-2">
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">News</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">World</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Games</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">References</a>
                          </li>
                        </ul>
                      </div>
                      <div>
                        <p class="font-medium tracking-wide text-gray-300">Apples</p>
                        <ul class="mt-2 space-y-2">
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Web</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">eCommerce</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Business</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Entertainment</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Portfolio</a>
                          </li>
                        </ul>
                      </div>
                      <div>
                        <p class="font-medium tracking-wide text-gray-300">Cherry</p>
                        <ul class="mt-2 space-y-2">
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Media</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Brochure</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Nonprofit</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Educational</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Projects</a>
                          </li>
                        </ul>
                      </div>
                      <div>
                        <p class="font-medium tracking-wide text-gray-300">Business</p>
                        <ul class="mt-2 space-y-2">
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Infopreneur</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Personal</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Wiki</a>
                          </li>
                          <li>
                            <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-200">Forum</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="md:max-w-md lg:col-span-2">
                      <span class="text-base font-medium tracking-wide text-gray-300">Subscribe for updates</span>
                      <form class="flex flex-col mt-4 md:flex-row">
                        <input
                          placeholder="Email"
                          required=""
                          type="text"
                          class="flex-grow w-full h-12 px-4 mb-3 transition duration-200 bg-white border border-gray-300 rounded shadow-sm appearance-none md:mr-2 md:mb-0 focus:border-deep-purple-accent-400 focus:outline-none focus:shadow-outline"
                        />
                        <button
                          type="submit"
                          class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                        >
                          Subscribe
                        </button>
                      </form>
                      <p class="mt-4 text-sm text-gray-500">
                        Bacon ipsum dolor amet short ribs pig sausage prosciuto chicken spare ribs salami.
                      </p>
                    </div>
                  </div>
                  <div class="flex flex-col justify-between pt-5 pb-10 border-t border-gray-800 sm:flex-row">
                    <p class="text-sm text-gray-500">
                      © Copyright 2020 Lorem Inc. All rights reserved.
                    </p>
                    <div class="flex items-center mt-4 space-x-4 sm:mt-0">
                      <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-teal-accent-400">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                          <path
                            d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"
                          ></path>
                        </svg>
                      </a>
                      <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-teal-accent-400">
                        <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                          <circle cx="15" cy="15" r="4"></circle>
                          <path
                            d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"
                          ></path>
                        </svg>
                      </a>
                      <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-teal-accent-400">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                          <path
                            d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z"
                          ></path>
                        </svg>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
        
        </section>

    </body>
</html>