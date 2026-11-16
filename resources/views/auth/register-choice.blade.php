<x-layout>
    <div class="max-w-md mx-auto mt-10 space-y-6 text-center">
        <h1 class="text-2xl font-bold">Rejestracja</h1>

        <p>Wybierz typ konta:</p>

        <div class="flex flex-col gap-4">
            <a href="{{ url('/register/candidate') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">
                Jestem kandydatem
            </a>

            <a href="{{ url('/register/employer') }}"
               class="px-4 py-2 bg-green-600 text-white rounded">
                Jestem pracodawcą
            </a>
        </div>
    </div>
</x-layout>
