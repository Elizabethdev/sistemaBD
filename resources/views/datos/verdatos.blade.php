@extends('layouts.app')

@section('title')
Ver Datos
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop

@section('contenido')
    <!-- <upload-component></upload-component> -->
    
    <div class="row">
        <div class="col col-md-12 mb-4">
            <h1 class="h3 mb-2 text-gray-800">Cálculos</h1>
            <!-- <p class="mb-4">Selecciona el archivo Excel con los datos que desea guardar en la base de datos.</p> -->

        </div>
        <div class="col col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Tabla de datos de la hoja calculos.</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>CVE_MUN</th>
                                    <th>MUNICIPIO</th>
                                    <th>LOC</th>
                                    <th>CVE_U</th>
                                    <th>NOMBRE_LOC</th>
                                    <th>POBTOT</th>
                                    <th>P3YM_HLI</th>
                                    <th>CONSEJO_CUENCA</th>
                                    <th>CLAVE</th>
                                    <th>SUBCUENCA</th>
                                    <th>REGIÓN</th>
                                    <th>CUENCA</th>
                                    <th>DOF</th>
                                    <th>REGION_ECO</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>CVE_MUN</th>
                                    <th>MUNICIPIO</th>
                                    <th>LOC</th>
                                    <th>CVE_U</th>
                                    <th>NOMBRE_LOC</th>
                                    <th>POBTOT</th>
                                    <th>P3YM_HLI</th>
                                    <th>CONSEJO_CUENCA</th>
                                    <th>CLAVE</th>
                                    <th>SUBCUENCA</th>
                                    <th>REGIÓN</th>
                                    <th>CUENCA</th>
                                    <th>DOF</th>
                                    <th>REGION_ECO</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                

                                    <td>099</td>
                                    <td>La Trinitaria</td>
                                    <td>0059</td>
                                    <td>070990059</td>
                                    <td>LAS DELICIAS</td>
                                    <td>2121</td>
                                    <td>1</td>
                                    <td>RÍOS GRIJALVA Y USUMACINTA</td>
                                    <td>300602</td>
                                    <td>Lagartero</td>
                                    <td>Río Grijalva</td>
                                    <td>Grijalva - La Concordia</td>
                                    <td>I</td>
                                    <td>Meseta Comiteca Tojolabal</td>
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
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@stop