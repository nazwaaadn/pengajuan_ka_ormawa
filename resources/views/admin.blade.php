@extends('components.main')
@include('layouts.head')
@include('components.navbar2staff')

@section('content')
    <div class="w-full px-4 py-6 mx-auto" id="content">
        <div class="flex justify-center">
            <ol class="items-center sm:flex">
                @foreach ($timelines as $timeline)
                <li class="relative mb-6 sm:mb-0" style="margin-center: 20px;">
                        <div class="flex justify-center">
                            <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white sm:ring-8 shrink-0">
                                <svg class="w-2.5 h-2.5 text-blue-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <div class="hidden sm:flex w-full bg-gray-200 h-0.5"></div>
                        </div>
                        <div class="mt-3 sm:pe-8 text-center">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $timeline->judul_timeline }}&nbsp;&nbsp;&nbsp;</h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400">{{ $timeline->tanggal_timeline_awal }} - {{ $timeline->tanggal_timeline_akhir }} &nbsp;&nbsp;&nbsp;</time>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    {{-- modal --}}
    <!-- Button to trigger the modal -->
    <!-- Inside your foreach loop -->
        <div class="container mx-auto mt-5">
            <h1 class="text-2xl font-semibold text-center mb-4">Timeline Data</h1>
            <!-- Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-4 py-2">Judul Timeline</th>
                        <th class="border px-4 py-2">Tanggal Awal</th>
                        <th class="border px-4 py-2">Tanggal Akhir</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timelines as $timeline)
                        <tr>
                            <td class="border px-4 py-2">{{ $timeline->judul_timeline }}</td>
                            <td class="border px-4 py-2">{{ $timeline->tanggal_timeline_awal }}</td>
                            <td class="border px-4 py-2">{{ $timeline->tanggal_timeline_akhir }}</td>
                            <td class="border px-4 py-2">
                                <!-- Edit Button -->
                                <button onclick="showEditForm({{ $timeline->id }}, '{{ $timeline->judul_timeline }}', '{{ $timeline->tanggal_timeline_awal }}', '{{ $timeline->tanggal_timeline_akhir }}')"
                                        class="text-blue-500 hover:underline">Edit</button>
                                <!-- Delete Button -->
                                <form action="{{ route('timeline.destroy', $timeline->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this timeline?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    {{--  modal 2--}}

    <!-- Modal -->
    <!-- Create Timeline Form -->
        <div class="flex flex-wrap bg-white">
            <!-- Create Timeline Form -->
            <section class="flex-1 bg-white p-4">
                <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                    <h2 class="mb-4 text-xl font-bold text-gray-900">Buat Timeline</h2>
                    -------------
                        <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                            @csrf
                            <div class="sm:col-span-2">
                                <label for="judul_timeline" class="block mb-2 text-sm font-medium text-gray-900">Judul Timeline</label>
                                <input type="text" id="judul_timeline" name="judul_timeline"
                                    class="w-full sm:w-[700px] block p-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="Type product name" required>
                            </div>
                            <div class="w-full">
                                <label for="tanggal_timeline_awal" class="form-label">Tanggal Awal</label>
                                <input type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    id="tanggal_timeline_awal" name="tanggal_timeline_awal" required>
                            </div>
                            <div class="w-full">
                                <label for="tanggal_timeline_akhir" class="form-label">Tanggal Akhir</label>
                                <input type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    id="tanggal_timeline_akhir" name="tanggal_timeline_akhir" required>
                            </div>
                            {{-- <button type="submit" --}}
                                {{-- class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-black bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 hover:bg-primary-800">Save Timeline</button> --}}
                            <button type="submit" class="bg-gradient-to-r from-[#32BB35] to-[#8BE52E] text-white py-2 px-4 rounded-lg shadow-lg font-extrabold transition duration-200 ease-in-out hover:-translate-y-1 mt-4">Save Timeline</button>

                        </div>
                    </form>
                </div>
            </section>

            <!-- Edit Timeline Form -->
            <section class="flex-1 bg-white p-4">
                <div id="editFormContainer" class="hidden mt-5 bg-gray-100 p-5 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">Edit Timeline</h2>
                    <form method="POST" action="" id="editForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editTimelineId" name="id">
                        <div class="mb-4">
                            <label for="editJudulTimeline" class="block text-sm font-medium">Judul Timeline</label>
                            <input type="text" id="editJudulTimeline" name="judul_timeline" class="block w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="editTanggalAwal" class="block text-sm font-medium">Tanggal Awal</label>
                            <input type="date" id="editTanggalAwal" name="tanggal_timeline_awal" class="block w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="editTanggalAkhir" class="block text-sm font-medium">Tanggal Akhir</label>
                            <input type="date" id="editTanggalAkhir" name="tanggal_timeline_akhir" class="block w-full p-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Update Timeline</button>
                        <button type="button" onclick="hideEditForm()" class="ml-2 bg-gray-500 text-black px-4 py-2 rounded">Cancel</button>
                    </form>
                </div>

            </section>
        </div>
    </div>

    <script>
        function showEditForm(id, judul, tanggalAwal, tanggalAkhir) {
            // Set action URL for form
            const form = document.getElementById('editForm');
            form.action = `/timelines/${id}`;

            // Fill the form fields with the timeline data
            document.getElementById('editTimelineId').value = id;
            document.getElementById('editJudulTimeline').value = judul;
            document.getElementById('editTanggalAwal').value = tanggalAwal;
            document.getElementById('editTanggalAkhir').value = tanggalAkhir;

            // Show the form
            document.getElementById('editFormContainer').classList.remove('hidden');
        }

        function hideEditForm() {
            document.getElementById('editFormContainer').classList.add('hidden');
        }
    </script>
@endsection
