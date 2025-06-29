<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container align-middle">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                Product List
                            </div>
                            <div class="card-body">
                                <div class="table-responsive rounded">
                                    <table class="table table-bordered">
                                        <thead style="background-color: #40217a">
                                            <th class="text-white">No</th>
                                            <th class="text-white">Produk</th>
                                            <th class="text-white">Deskripsi Produk</th>
                                            <th class="text-white">Gambar Produk</th>
                                            <th class="text-white">Aksi</th>
                                            <th class="text-white"></th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td rowspan="2">1</td>
                                                <td rowspan="2">Obat</td>
                                                <td>Obat Batuk</td>
                                                <td><i class="fa-solid fa-upload"></i></td>
                                                <td><i class="fa-solid fa-trash"></i></td>
                                                <td rowspan="2"><i class="fa-solid fa-trash"></i></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><i class="fa-solid fa-upload"></i></td>
                                                <td><i class="fa-solid fa-square-plus"></i></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td></td>
                                                <td></td>
                                                <td><i class="fa-solid fa-upload"></i></td>
                                                <td><i class="fa-solid fa-square-plus"></i></td>
                                                <td><i class="fa-solid fa-square-plus"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
{{-- <script>
    $(document).ready(function() {
        alert('test');
    })
</script> --}}
