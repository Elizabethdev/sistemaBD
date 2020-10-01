@extends('layouts.website.app')
@section('title')
Agua Potable
@stop

@section('menu')
    @include('layouts.website.menuap')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>AGUA POTABLE</h2>
            <p>Se denomina agua potable o agua apta para el consumo de los humanos al agua que puede ser consumida sin restricción para beber o preparar alimentos.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper" id="app">
        <div class="inner">
            <section>
                <h3 class="major">Demanda m3 Anuales</h3>
            </section>
            <section >
                <h4>Filtrar por:</h4> 
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    <filtros-component 
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        :dlocalidades= "{{$localidades}}"
                    >  
                    </filtros-component>
                </div>
            </section>
            <section>										
                <div class="table-wrapper my-4">
                   <table-component :dtotales="{{$datos_total}}" :headers-table="headersTable"></table-component>
                </div>
            </section>
            <section>										
                <ul class="actions">
                    <li><a href="#" class="button primary icon solid fa-save">Guardar</a></li>
                    <li><a href="#" class="button primary icon solid fa-print">Imprimir</a></li>
                </ul>
            </section>
        </div>
    </div>
</section>
    
@endsection