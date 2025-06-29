<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Document</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container align-middle">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Product List
            </div>
            <div class="card-body">
                <div class="table-responsive rounded">
                    <table class="table table-hover table-bordered">
                        <thead style="background-color: #40217a">
                            <th class="text-white">No</th>
                            <th class="text-white">Produk</th>
                            <th class="text-white">Deskripsi Produk</th>
                            <th class="text-white">Gambar Produk</th>
                            <th class="text-white">Aksi</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="2">1</td>
                                <td rowspan="2">Obat</td>
                                <td>Obat Batuk</td>
                                <td>Gambar Produk</td>
                                <td>Aksi</td>
                            </tr>
                            <tr>
                                <td>Obat Batuk</td>
                                <td>Gambar Produk</td>
                                <td>Aksi</td>
                            </tr>
                            <tr>
                                <td rowspan="2">1</td>
                                <td rowspan="2">Obat</td>
                                <td>Obat Batuk</td>
                                <td>Gambar Produk</td>
                                <td>Aksi</td>
                            </tr>
                            <tr>
                                <td>Obat Batuk</td>
                                <td>Gambar Produk</td>
                                <td>Aksi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- nanti diappend tablenya pake javascript --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
        integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            alert('test');
        })
    </script>
</body>

</html>
