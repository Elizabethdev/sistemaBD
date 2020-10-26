@extends('layouts.website.app')
@section('title')
Agua Potable
@stop

@section('css')
<!-- Scripts para vue-->
<script src="{{ asset('js/pageapcob.js') }}" defer></script>
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
                <h3 class="major">Cobertura (%) Anuales</h3>
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
                        v-on:filterchange2="filterchange2"
                    >  
                    </filtros-component>
                    <rangos-component v-on:rangochange="filterchange2"></rangos-component>
                </div>
            </section>
            <section id="header-fixed">		
            <b-overlay :show="show" rounded="sm" spinner-variant="primary">								
                <div class="table-wrapper my-4">
                   <table-component :newdtotales="newdtotales" :headers-table="headersTable" :visible="visible"></table-component>
                </div>
            </b-overlay>
            </section>
            <section>										
                <ul class="actions">
                    <li><a href="#" class="button primary icon solid fa-save">Guardar</a></li>
                    <!-- <li><a href="#" class="button primary icon solid fa-print">Imprimir</a> -->
                    <li>
                    <!-- <input type="button" class="button primary icon solid fa-print" onclick="printDiv('header-fixed')" value="imprimir" /> -->
                    <a href="javascript:void(0);" class="button primary icon solid fa-print" onclick="printDiv('header-fixed')" >Imprimir</a>
                    </li>
                </ul>
            </section>
        </div>
    </div>
</section>
    
@endsection

@section('scripts')
<script>
function printDiv(nombreDiv) {

    var w = window.open();
    w.document.write('<html><head>');
	w.document.write('<style>.tabla{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.tabla th{border:1px solid #ddd;padding:4px;background-color:#4c5c96;text-align:left;font-size:15px;color: #fff;}.tabla td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
    w.document.write('</head><body >');
    w.document.write(document.getElementById(nombreDiv).innerHTML);
    w.document.write('</body></html>');
    w.document.close(); // necesario para IE >= 10
    w.focus(); // necesario para IE >= 10
    w.print();
    w.close();
    return true;
}
</script>

@endsection