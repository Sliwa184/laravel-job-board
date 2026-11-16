<!doctype html>
<html lang="en" xmlns:div="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NowaRobota</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-neutral-900 text-white pb-20">

    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10">

            <div class="space-x-6 font-bold">
                <a href="/">Strona główna</a>
            </div>

            @auth
                <div class="space-x-6 font-bold flex">
                    @if(auth()->user()->role === 'employer')
                        <a href="{{ route('employer.applications') }}">
                            Aplikacje
                        </a>
                        <a href="/jobs/create">Dodaj ofertę</a>
                    @endif

                    @if(auth()->user()->role === 'candidate')
                        <a href="{{ route('applications.my') }}">
                            Moje aplikacje
                        </a>
                    @endif


                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')
                        <button>Wyloguj się</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register">Rejestracja</a>
                    <a href="/login">Logowanie</a>
                </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[1280px] mx-auto">
            {{ $slot  }}
        </main>
    </div>

</body>
</html>
