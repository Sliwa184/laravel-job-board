<x-layout>

    <x-page-heading>Aplikacje do Twoich ofert</x-page-heading>

    @if($applications->isEmpty())

        <div class="mt-6 text-gray-400">
            Nie otrzymałeś jeszcze żadnych aplikacji.
        </div>

    @else

        <div class="mt-6 overflow-x-auto">

            <table class="min-w-full bg-gray-600 rounded-lg overflow-hidden shadow">

                <thead class="bg-gray-800 text-left text-sm uppercase tracking-wider text-white">
                <tr>
                    <th class="px-6 py-3">Oferta</th>
                    <th class="px-6 py-3">Kandydat</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Data</th>
                    <th class="px-6 py-3">CV</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Akcja</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                @foreach($applications as $application)

                    <tr class="hover:bg-gray-500 transition">

                        <td class="px-6 py-4 font-medium">
                            <a href="{{ route('jobs.show', $application->job) }}"
                               class="text-red-600 hover:underline">
                                {{ $application->job->title }}
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            {{ $application->candidate->first_name }}
                            {{ $application->candidate->last_name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $application->candidate->user->email }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $application->created_at->format('d.m.Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ asset('storage/'.$application->cv) }}"
                               target="_blank"
                               class="text-green-600 hover:underline">
                                Pobierz CV
                            </a>
                        </td>

                        <td class="px-6 py-4">

                            @if($application->status === 'pending')
                                <span class="text-yellow-600 font-semibold">Oczekuje</span>
                            @endif

                            @if($application->status === 'accepted')
                                <span class="text-green-600 font-semibold">Zaakceptowane</span>
                            @endif

                            @if($application->status === 'rejected')
                                <span class="text-red-600 font-semibold">Odrzucone</span>
                            @endif

                        </td>

                        <td class="px-6 py-4 space-x-2">

                            @if($application->status === 'pending')

                                <form action="{{ route('applications.status', [$application, 'accepted']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-green-600 hover:underline">
                                        Akceptuj
                                    </button>
                                </form>

                                <form action="{{ route('applications.status', [$application, 'rejected']) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-red-600 hover:underline">
                                        Odrzuć
                                    </button>
                                </form>

                            @endif

                        </td>

                    </tr>

                @endforeach

                </tbody>

            </table>

        </div>

    @endif

</x-layout>
