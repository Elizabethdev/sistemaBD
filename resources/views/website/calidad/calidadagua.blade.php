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
                    <li><a href="#" class="button primary icon solid fa-save">Guardar</a></li>
                    <li>
                    <input type="button" class="button primary icon solid fa-print" onclick="printDiv('header-fixed')" value="imprimir" />
                    <!-- <a href="javascript:void(0);" onclick="printDiv('areaImprimir')" >Imprimir</a> -->
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
    // var contenido= document.getElementById(nombreDiv).innerHTML;
   
    // var contenidoOriginal= document.body.innerHTML;

    // document.body.innerHTML = contenido;

    // window.print();

    // document.body.innerHTML = contenidoOriginal;

    // var printContents = document.getElementById(nombreDiv).innerHTML;
    // w = window.open();
    //     w.document.write(printContents);
    //     w.document.close(); // necessary for IE >= 10
    //     w.focus(); // necessary for IE >= 10
	// 	w.print();
	// 	w.close();
    //     return true;

    var mywindow = window.open();
    mywindow.document.write('<html><head>');
	mywindow.document.write('<style>.tabla{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.tabla th{border:1px solid #ddd;padding:4px;background-color:#4c5c96;text-align:left;font-size:15px;color: #fff;}.tabla td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(nombreDiv).innerHTML);
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necesario para IE >= 10
    mywindow.focus(); // necesario para IE >= 10
    mywindow.print();
    mywindow.close();
    return true;
}
</script>

<!-- <style type="text/css" media="print">
@media print {
header {display:none;}
#section1 {display:none;}
#section2 {display:none;}
#section3 {display:none;}
}
</style> -->
@endsection