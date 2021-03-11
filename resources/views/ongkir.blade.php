<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cek Ongkir</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">LARAVEL CEK ONGKIR</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark " href="#">CEK ONGKIR</a>
        </nav>
    </div>

    <div class="container">
        <div class="card">
            <form action="{{ url('/') }}" method="get">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <h6>Nama Anda:</h6>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Kirim dari:</h6>
                                <select name="province_from" class="form-control">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach ($provinsi as $result)
                                    <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="origin" class="form-control">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <h6>Kirim ke:</h6>
                                <select name="province_to" class="form-control">
                                    <option value="" holder>Pilih Provinsi</option>
                                    @foreach ($provinsi as $result)
                                    <option value="{{ $result->id }}">{{ $result->province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="destination" class="form-control">
                                    <option value="" holder>Pilih Kota</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h6>Berat Paket:</h6>
                            <input name="weight" type="text" class="form-control">
                            <small>Contoh: 1700 / 1,7kg</small>
                        </div>
                        <div class="col-sm-6">
                            <h6>Pilih Kurir:</h6>
                            <select name="courier" id="" class="form-control">
                                <option value="" holder>Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS Indonesia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Cek Ongkir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if($cekongkir)
            <div class="row">
                <div class="col">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Estimasi</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cekongkir as $result)
                            <tr> 
                                <td>{{ $result['service'] }}</td>
                                <td>{{ $result['description'] }}</td>    
                                <td>{{ $result['cost'][0]['value'] }}</td>   
                                <td>{{ $result['cost'][0]['etd'] }}</td>   
                                <td>{{ $result['cost'][0]['note'] }}</td>   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            @else

            @endif
        </div>
    </div>





    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="province_from"]').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="origin"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="origin"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="origin"]').empty();
                }
            });

            $('select[name="province_to"]').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="destination"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="destination"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="destination"]').empty();
                }
            });
        });

    </script>
</body>

</html>
