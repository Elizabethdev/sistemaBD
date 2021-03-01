@extends('layouts.dashboard.app')

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
        <div class="col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardDemAP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardDemAP">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Demanda AP</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardDemAP" style="">
                    <div class="card-body">
                        <a v-on:click="calcular" href="javascript:void(0);" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Calcular</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardPobAP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardPobAP">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Población AP</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardPobAP" style="">
                    <div class="card-body">
                        <a href="#" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Calcular</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardCobAP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardCobAP">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Cobertura AP</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardCobAP" style="">
                    <div class="card-body">
                        <a href="#" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Calcular</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col col-md-12 mb-4">
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
                                    <th>TVIVHAB</th>
                                    <th>TVIVPAR</th>
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
                                    <th>TVIVHAB</th>
                                    <th>TVIVPAR</th>
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
                                    <td>519</td>
                                    <td>631</td>
                                    <td>RÍOS GRIJALVA Y USUMACINTA</td>
                                    <td>300602</td>
                                    <td>Lagartero</td>
                                    <td>Río Grijalva</td>
                                    <td>Grijalva - La Concordia</td>
                                    <td>I</td>
                                    <td>Meseta Comiteca Tojolabal</td>
                                </tr>
                                <tr>
                                    <td>052</td>
                                    <td>Las Margaritas</td>
                                    <td>0052</td>
                                    <td>070520052</td>
                                    <td>Jalisco</td>
                                    <td>1915</td>
                                    <td>1781</td>
                                    <td>257</td>
                                    <td>273</td>
                                    <td>RÍOS GRIJALVA Y USUMACINTA</td>
                                    <td>3006510</td>
                                    <td>Margaritas</td>
                                    <td>Río Usumacinta</td>
                                    <td>Río Lacantún</td>
                                    <td>LVII</td>
                                    <td>Meseta Comiteca Tojolabal</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@stop