@extends('layouts.dashboard.app')

@section('title')
Calcular Datos
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}">
@stop

@section('contenido')
    <div class="row">
        <div class="col col-md-12 mb-4">
            <h1 class="h3 mb-2 text-gray-800">Cálculos</h1>
        </div>
        <div class="col-lg-12 col-12">
            <b-alert v-model="showDismissibleAlert" :variant="variant" dismissible>
            @{{ mensaje }}  
            </b-alert>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card shadow mb-4">
                <a href="#collapseCardDemAP" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardDemAP">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Demanda AP</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardDemAP" style="">
                    <div class="card-body">
                        <a @click.prevent="calcularap('demanda')" href="#" class="btn btn-success btn-icon-split " :class="disable">
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
                        <a @click.prevent="calcularap('poblacion')" href="#" class="btn btn-success btn-icon-split " :class="disable">
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
                        <a @click.prevent="calcularap('cobertura')" href="#" class="btn btn-success btn-icon-split " :class="disable">
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
                <a href="#collapseCardDemALC" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardDemALC">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Demanda ALC</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardDemALC" style="">
                    <div class="card-body">
                        <a v-on:click="calcularap" href="javascript:void(0);" class="btn btn-success btn-icon-split">
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
                <a href="#collapseCardPobALC" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardPobALC">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Población ALC</h6>
                </a>
                <div class="collapse show" id="collapseCardPobALC" style="">
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
                <a href="#collapseCardCobALC" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardCobALC">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Cobertura ALC</h6>
                </a>
                <div class="collapse show" id="collapseCardCobALC" style="">
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
      
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/demo/datatables-demo.js') }}"></script>

@stop