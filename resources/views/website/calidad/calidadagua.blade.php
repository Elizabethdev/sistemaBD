@extends('layouts.website.app')
@section('title')
Calidad del Agua
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pagecal.js') }}" defer></script>
@stop

@section('menu')
    @include('layouts.website.menusan')
@stop

@section('content')
<section id="wrapper">
    <header>
        <div class="inner">
            <h2>CALIDAD DEL AGUA</h2>
            <h3><p>Es una medida de la condición del agua en relación con los requisitos de una o más especies bióticas o a cualquier necesidad humana o propósito.</p>
        </div>
    </header>

    <!-- Content -->
    <div class="wrapper">
    <div class="inner" id="app">
            <section id="section1">
                <h3 class="major">Datos</h3>
            </section>
            <section id="section2">
                <h4>Filtrar por:</h4>
                <div class="" style="border: solid 2px rgba(255, 255, 255, 0.125); padding: 1rem; border-radius: 5px;">
                    <filtros-component
                        :destados= "{{$estados}}"
                        :dconsejos= "{{$consejos}}"
                        :dmunicipios= "{{$municipios}}"
                        :dsubcuencas= "{{$subcuencas}}"
                        :dregiones= "{{$regionesEco}}"
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                    <div class="row justify-content-end pr-3">
                        <button v-if="show" class="button primary icon solid fa-search" disabled>
                            Consultar
                        </button>
                        <btn-component v-else v-on:btnclick="consultar" :disabled="show" name="Consultar" classbtn="fa-search"></btn-component>
                    </div>
                </div>
            </section>
            <section id="header-fixed">										
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            </section>
            <section id="section3">										
                <ul class="actions">
                    <li>
                        <b-overlay
                            :show="busy"
                            rounded
                            opacity="0.6"
                            spinner-small
                            spinner-variant="primary"
                            class="d-inline-block"
                        >
                            <btn-component v-on:btnclick="guardarexcel" name="Guardar" classbtn="fa-save"></btn-component>
                        </b-overlay>
                    </li>
                    <li>
                        <btn-component v-on:btnclick="print('header-fixed')" name="Imprimir" classbtn="fa-print"></btn-component>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</section>
    
@endsection

@section('scripts')
<!-- <script>
function printDiv(nombreDiv) {
    var contenido= document.getElementById(nombreDiv).innerHTML;
    var contenidoOriginal= document.body.innerHTML;
    document.body.innerHTML = contenido;
    window.print();
    document.body.innerHTML = contenidoOriginal;
}
</script> -->
@endsection