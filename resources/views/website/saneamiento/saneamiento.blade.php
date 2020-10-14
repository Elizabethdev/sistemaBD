@extends('layouts.website.app')
@section('title')
Saneamiento
@stop
@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pagesan.js') }}" defer></script>
@stop

@section('menu')
    @include('layouts.website.menusan')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>SANEAMIENTO</h2>
            <h3><p>El saneamiento es imprescindible para prevenir numerosas enfermedades que sufren millones de personas, como las enfermedades diarreicas.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper" id="app">
        <div class="inner">
            <section>
                <h3 class="major">Datos</h3>
                
            </section>
            <section>
                <h4>Filtrar por:</h4>
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 2rem; border-radius: 5px;">
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        :titulof= "titulo"
                        :tiposf= "tipos"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                </div>
            </section>
            <section>										
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
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