@extends('layouts.dashboard.app')

@section('title')
Resumen Rangos
@stop

@section('contenido')
<div class="row">
        <div class="col col-md-12 mb-4">
            <h1 class="h3 mb-2 text-gray-800">Filtros</h1>
            <p class="mb-4">Selecciona el FILTRO (AQUI VA EL COMPONENTE DE FILTROS).</p>

        </div>
        <div class="col col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Resumen por rango.</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>TIPO 2020</th>
                                    <th>R_POB_20</th>
                                    <th>Suma de PO CON AP 2020</th>
                                    <th>Suma de PO SIN AP 2020</th>
                                    <th>Suma de PO CON ALC 2020 V2</th>
                                    <th>Suma de PO SIN ALC 2020 V2</th>
                                    <th>Suma de COSTO EST AP</th>
                                    <th>Suma de COSTO EST ALC</th>
                                    <th>Suma de COSTO EST PTAR</th>
                                    <th>Suma de COSTO OBRA AP</th>
                                    <th>Suma de COSTO OBRA ALC</th>
                                    <th>Suma de COSTO OBRA PTAR</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <tr>
                                    <td rowspan="3">RURAL</td>
                                    <td> < 0.1 mil</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td>1,306,971.00</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <!-- <td>RURAL</td> -->
                                    <td> 0.1 - 0.4 mil</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td>2, 409, 051.00</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection