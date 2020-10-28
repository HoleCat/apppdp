@extends('layouts.app_guest')

@section('content')
<script src="{{ asset('assets/js/proyecto/efectos.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/tablas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/vistas.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/config.js') }}" defer></script>
<script src="{{ asset('assets/js/proyecto/alerts.js') }}" defer></script>
<div class="container-fluid">
    <div class="row" id="content">
        <div class="col-12 text-center">
            <h1 class="mx-auto">CODIGOS CONTABLES</h1>
        </div>
       <div class="col-12 py-2">
           <div class="col-12">
            <!--<form id="form_contabilidad_store" action="/contabilidad/store" enctype='multipart/form-data' method="GET" >-->
            <form id="form_contabilidad_store" enctype='multipart/form-data'>
                <div class="col-12 d-flex flex-wrap flex-reverse">
                    <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                        <label for="input-image">ARCHIVO</label>
                        <input type="file" class="form-control-file" id="input-image" name="myfile">
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                        <label>SEPARADOR</label>
                        <input type="text" class="form-control" id="input-image" name="separador">
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                        <label>CODIGO</label>
                        <input class="form-control" type="text" name="codigo">
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                        <label>DESCRIPCION</label>
                        <input class="form-control" type="text" name="descripcion">
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="custom-control custom-radio">
                            <input type="checkbox" id="csv_compras" name="csv" class="custom-control-input">
                            <label class="custom-control-label" for="csv_compras">CSV</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="checkbox" id="excel_compras" name="excel" class="custom-control-input">
                            <label class="custom-control-label" for="excel_compras">EXCEL</label>
                        </div>
                    </div>
                    
                    <div class="col-12 text-center mt-2">
                        <input class="btn btn-success mx-auto w-100" type="submit" value="IMPORTAR/AGREGAR">
                    </div>
                </div>
            </form>
           </div>
       </div>
       <div class="col-12 py-0">
           <div class="col-12" id="tabla-conta-div">
                <table class="table table-bordered" id="tabla-conta">
                    <thead class="bg-white">
                        <th class="col">ID</th>
                        <th class="col">CODIGO</th>
                        <th class="col">DESCRIPCION</th>
                        <th class="col">OPCIONES</th>
                    </thead>
                    <tbody class="body-real">
                        @foreach ($contabilidad as $contabilidad)
                        <tr class="bg-white">
                            <td class="col">
                                {{ $contabilidad->id }}
                            </td>
                            <td class="col">
                                {{ $contabilidad->codigo }}
                            </td>
                            <td class="col">
                                {{ $contabilidad->descripcion }}
                            </td>
                            <td class="col">
                                <form action="/contabilidad/delete">
                                    <input type="hidden" name="id" value="{{ $contabilidad->id }}">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
           </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/proyecto/codigocontable.js') }}" defer></script>
@endsection