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
    </head>
    <body>
        <section class="grid h-screen place-content-center">
          <form action="{{ route('post_reset', ['token' => $token]) }}" method="POST">
            @csrf
            <div class="mb-10 text-center text-indigo-400">
              <h1 class="text-3xl font-bold tracking-widest">Reset ur passwrd</h1>
            </div>
            <div class="flex flex-col items-center justify-center space-y-6">
              <input type="password" id="password" name="password" placeholder="Password" class="w-80 border-0 p-2 px-4" />
              <div>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" class="w-80 border-0 p-2 px-4" />
                <p id="validation" class="text-center text-orange-500 italic text-sm"></p>
              </div>
              <button id="showPw" class="rounded-xl bg-indigo-500 p-2 px-36 text-white hover:bg-orange-500">Save</button>
            </div>
          </form>
          </section>
    </body>
</html>