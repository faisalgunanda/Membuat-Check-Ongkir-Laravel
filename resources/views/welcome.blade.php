<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Ongkir</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Check Ongkir
            </div>
            <div class="card-body">
                <form class="form-horizontal" role="form" action="/" method="post">
                    {{ csrf_field() }}
                    <div class="form-group-sm">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Provinsi Asal</label>
                                <select name="province_origin" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provincies as $province => $value )
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kota Asal</label>
                                <select name="city_origin" class="form-control">
                                    <option value="">--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Provinsi Tujuan</label>
                                <select name="province_destination" class="form-control">
                                    <option value="">--Provinsi--</option>
                                    @foreach ($provincies as $province => $value )
                                        <option value="{{ $province }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kota Tujuan</label>
                                <select name="city_destination" class="form-control">
                                    <option value="">--Kota--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kurir</label>
                                <select name="courier" class="form-control">
                                    @foreach ($couriers as $courier => $value)
                                        <option value="{{ $courier }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Berat (g)</label>
                                <input type="number" name="weight" id="" class="form-control" value="1000">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('select[name="province_origin"]').on('change', function(){
            let provinceId = $(this).val();
            if(provinceId){
                jQuery.ajax({
                    url: '/province/'+provinceId+'/cities',
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('select[name="city_origin"]').empty();
                        $.each(data, function(key,value){
                            $('select[name="city_origin"]').append('<option value="'+key+'">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('select[name="city_origin"]').empty();
            }
        });
        $('select[name="province_destination"]').on('change', function(){
            let provinceId = $(this).val();
            if(provinceId){
                jQuery.ajax({
                    url: '/province/'+provinceId+'/cities',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        console.log(data)
                        $('select[name="city_destination"]').empty();
                        $.each(data, function(key,value){
                            $('select[name="city_destination"]').append('<option value="'+key+'">' + value + '</option>');
                        });
                    },
                })
            } else {
                $('select[name="city_destination"]').empty();
            }
        });
    });
</script>
</body>
</html>
