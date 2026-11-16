<x-layout>

    <x-page-heading>Moje aplikacje</x-page-heading>

    @if($applications->isEmpty())
        <div class="mt-6 text-gray-400">
            Nie aplikowałeś jeszcze na żadną ofertę.
        </div>
    @else

        <div class="mt-6 overflow-x-auto">
            <table class="min-w-full bg-gray-600 rounded-lg overflow-hidden shadow">

                <thead class="bg-gray-800 text-left text-sm uppercase tracking-wider text-white">
                <tr>
                    <th class="px-6 py-3">Oferta</th>
                    <th class="px-6 py-3">Data aplikacji</th>
                    <th class="px-6 py-3">CV</th>
                    <th>Status</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-white">

                @foreach($applications as $application)

                    <tr class="hover:bg-gray-500 transition">

                        <td class="px-6 py-4 font-medium">
                            <a
                                href="{{ route('jobs.show', $application->job) }}"
                                class="text-red-600 hover:underline"
                            >
                                {{ $application->job->title }}
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            {{ $application->created_at->format('d.m.Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <a
                                href="{{ asset('storage/'.$application->cv) }}"
                                target="_blank"
                                class="text-green-600 hover:underline"
                            >
                                Pobierz CV
                            </a>
                        </td>

                        <td>

                            @if($application->status === 'pending')
                                <span class="text-yellow-600 font-semibold">Oczekuje</span>
                            @endif

                            @if($application->status === 'accepted')
                                <span class="text-green-600 font-semibold">Zaakcpetowane</span>
                            @endif

                            @if($application->status === 'rejected')
                                <span class="text-red-600 font-semibold">Odrzucone</span>
                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>
        </div>

    @endif

</x-layout>
