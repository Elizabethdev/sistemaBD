@extends('layouts.app')

@section('title')
Resumen Demanda
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
                  <h6 class="m-0 font-weight-bold text-primary">Resumen demandas.</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>TIPO 2020</th>
                                    <th>Suma de DEM_A_2010</th>
                                    <th>Suma de DEM_A_2015</th>
                                    <th>Suma de DEM_A_2020</th>
                                    <th>Suma de DEM_A_2030</th>
                                    <th>Suma de DEM_ALC_2010</th>
                                    <th>Suma de DEM_ALC_2015</th>
                                    <th>Suma de DEM_ALC_2020</th>
                                    <th>Suma de DEM_ALC_2030</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                                <tr>
                                    <th>TIPO 2020</th>
                                    <th>Suma de DEM_A_2010</th>
                                    <th>Suma de DEM_A_2015</th>
                                    <th>Suma de DEM_A_2020</th>
                                    <th>Suma de DEM_A_2030</th>
                                    <th>Suma de DEM_ALC_2010</th>
                                    <th>Suma de DEM_ALC_2015</th>
                                    <th>Suma de DEM_ALC_2020</th>
                                    <th>Suma de DEM_ALC_2030</th>
                                </tr>
                            </tfoot> -->
                            <tbody>
                                <tr>
                                    <td>RURAL</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                    <td>108 956 606.25</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection

@section('scripts')
    <!-- <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script> -->
@stop