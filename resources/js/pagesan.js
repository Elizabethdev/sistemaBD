import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tablesan.vue';
import btnComponent from './components/generales/btn.vue';
import btnC from './components/generales/btnC.vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import axios from './client/client.js';
import { BOverlay} from 'bootstrap-vue';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        filtrosComponent,
        tableComponent,
        btnComponent,
        btnC,
        BOverlay
    },
    data: {
        show:false,
        busy:false,
        headersTable: [
            {name:'Estado', visible: true, class: ''},
            {name:'Consejo de Cuenca', visible: true, class: ''},
            {name:'Subcuenca', visible: true, class: ''},
            {name:'Región Económica', visible: true, class: ''},
            {name:'Municipio', visible: true, class: ''},
            {name:'Localidad', visible: true, class: ''},
            {name:'Estatus', visible: true, class: ''},
            {name:'Clave Inegi', visible: true, class: ''},
            {name:'Capacidad instalada (l/s)', visible: true, class: ''},
            {name:'Caudal tratado', visible: true, class: ''},
            {name:'Población total', visible: true, class: ''},
            {name:'Organismo Operador', visible: true, class: ''},
            {name:'Proceso de tratamiento del agua', visible: true, class: ''},
            {name:'Descripción del proceso de tratamiento', visible: true, class: 'thWidth'},
            {name:'Observaciones', visible: true, class: 'thWidth'},
            {name:'Inversión de construcción', visible: true, class: ''},
            {name:'Programa', visible: true, class: ''},
            {name:'Cuerpo Receptor', visible: true, class: ''},
            {name:'Diagnóstico', visible: true, class: ''}
        ],
        newdtotalesStatic: {},
        newdtotales: [],
        newdmunicipios: {},
        titulo: 'ESTATUS',
        tipos: [
            { value: 'Activa', text: 'Activa' },
            { value: 'Baja', text: 'Baja' },
            { value: 'En proceso', text: 'En proceso' },
            { value: 'Fuera de operacion', text: 'Fuera de operación' },
            { value: 'No construida', text: 'No construida' },
            { value: 'Operando ineficientemente', text: 'Operando ineficientemente' },
        ],
        visible: {
            municipio: true,
            consejo: true,
            subcuenca: true,
            region: true
        },
        filtros: {   
            municipio: [],
            consejo: [],
            subcuenca: [],
            region: [],
            estado: [],
            tipo: []
        },
        headersFile: {
            cve_u:"cve_u",
            cve_edo: 'cve_edo',
            estado:"estado",
            consejo_cuenca: 'consejo_cuenca',
            cve_mun: 'cve_mun',
            municipio:'municipio',
            cve_subcuenca:'cve_subcuenca', 
            subcuenca:'subcuenca', 
            reg_economica:'reg_economica', 
            num_region:'num_region', 
            localidad:'localidad',
            ESTATUS:'ESTATUS',
            CVE_INEGI:'CVE_INEGI', 
            CAP_INSTALADA:'CAP_INSTALADA',
            CAUDAL_TRATADO:'CAUDAL_TRATADO',
            POBTOT_20:'POBTOT_20', 
            TIPO_20:'TIPO_20', 
            ORG_OPERADOR:'ORG_OPERADOR', 
            PROC_TRATAMIENTO:'PROC_TRATAMIENTO', 
            DESC_PROC_TRATAMIENTO:'DESC_PROC_TRATAMIENTO', 
            Observaciones:'Observaciones', 
            Inversion_Construccion:'Inversion_Construccion', 
            Programa_Construyo:'Programa_Construyo', 
            Cuerpo_Receptor:'Cuerpo_Receptor', 
            Diagnostico:'Diagnostico', 
        }
    },
    methods: {
        filterchange2(tipo, value){
            switch (tipo) {
                case 'consejo':
                    this.filtros.consejo = value
                    // this.visible.consejo = value.length > 0 ? true : false
                    // this.headersTable[1].visible = value.length > 0 ? true : false
                    break;
                case 'subcuenca':
                    this.filtros.subcuenca = value
                    // this.visible.subcuenca = value.length > 0 ? true : false
                    // this.headersTable[2].visible = value.length > 0 ? true : false
                    break;
                case 'region':
                    this.filtros.region = value
                    // this.visible.region = value.length > 0 ? true : false
                    // this.headersTable[3].visible = value.length > 0 ? true : false
                    break;
                case 'municipio':
                    this.filtros.municipio = value
                    // this.visible.municipio = value.length > 0 ? true : false
                    // this.headersTable[4].visible = value.length > 0 ? true : false
                    break;
                case 'estado':
                    this.filtros.estado = value
                    break;
                case 'tipo':
                    this.filtros.tipo = value
                    break;
                default:
                    break;
            }
        },
        filterDatos(filtros){
            const totales = this.newdtotalesStatic
            const result = {}
            if(filtros.length > 0){
                filtros.forEach(function(elem, index){
                    if (totales.hasOwnProperty(elem)){
                        result[elem] = totales[elem];
                    }
                });
                this.newdtotales = result
            } else{ this.newdtotales = totales}
            this.show = false
        },
        getDatosByFiltros(){
            axios.post('/san/consultarbyfiltros',{filtros: this.filtros})
            .then((response)=>{
                this.show = false
                this.newdtotales = response.data.datos
            })
            .catch(error => {
                console.log(error)
                this.show = false
                this.newdtotales = []
            })
        },
        guardarexcel(){
            let data = [...this.newdtotales]
            data.splice(0,0,this.headersFile)
            this.busy = true
            axios.post('/ap/export',{filtros: this.filtros, datos: data, page: 'saneamiento', headerTable: this.headersFile}
            , {
                responseType: 'blob'
            })
            .then((response)=>{
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'saneamiento_datos.xlsx')
                document.body.appendChild(link)
                link.click()
                this.busy = false
            })
            .catch(error => {
                console.log(error)
                this.busy = false
            })
        },
        print(nombreDiv){
            var w = window.open();
            w.document.write('<html><head>');
            w.document.write('<style>.tabla{width:100%;border-collapse:collapse;margin:16px 0 16px 0;}.tabla th{border:1px solid #ddd;padding:4px;background-color:#4c5c96;text-align:left;font-size:15px;color: #fff;}.tabla td{border:1px solid #ddd;text-align:left;padding:6px;}</style>');
            w.document.write('</head><body>');
            w.document.write(document.getElementById(nombreDiv).innerHTML);
            w.document.write('</body></html>');
            w.document.close(); // necesario para IE >= 10
            w.focus(); // necesario para IE >= 10
            w.print();
            w.close();
            return true;
        },
        consultar(){
            this.show = true
            if(this.filtros.consejo.length > 0 || this.filtros.subcuenca.length > 0 || this.filtros.region.length > 0 || this.filtros.municipio.length > 0 || this.filtros.estado.length > 0 || this.filtros.tipo.length > 0)
                this.getDatosByFiltros()
            else
                this.show = false
        }
    }
});
