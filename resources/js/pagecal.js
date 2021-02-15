import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tablecal.vue';
import btnComponent from './components/generales/btn.vue';
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
        BOverlay
    },
    data: {
        show:false,
        busy:false,
        headersTable: [
            {name:'Estado', visible: true, class: ''},
            {name:'Consejo de Cuenca', visible: false, class: ''},
            {name:'Subcuenca', visible: false, class: ''},
            {name:'Región Económica', visible: false, class: ''},
            {name:'Municipio', visible: false, class: ''},
            {name:'Localidad', visible: true, class: ''},
            {name:'Tipo', visible: true, class: ''},
            {name:'Cve_u', visible: true, class: ''},
            {name:'Población total', visible: true, class: ''},
            {name:'Total de Viviendas Habitadas', visible: true, class: ''},
            {name:'Viviendas Particulares Habitadas', visible: true, class: ''},
            {name:'Viviendas con Agua', visible: true, class: ''},
            {name:'Viviendas con Drenaje', visible: true, class: ''},
            {name:'Latitud', visible: true, class: ''},
            {name:'Longitud', visible: true, class: ''},
            {name:'Hipocloradores', visible: true, class: ''},
            {name:'Programa', visible: true, class: ''},
        ],
        newdtotalesStatic: {},
        newdtotales: [],
        visible: {
            municipio: false,
            consejo: false,
            subcuenca: false,
            region: false
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
            POBTOT:'POBTOT_10', 
            POBTOT_10:'POBTOT_10', 
            TIPO_10:'TIPO_10', 
            TVIVHAB:'TVIVHAB', 
            VIVPAR_HAB:'VIVPAR_HAB',
            VPH_AGUADV:'VPH_AGUADV',
            VPH_DRENAJ:'VPH_DRENAJ', 
            LATITUD:'LATITUD', 
            LONGITUD:'LONGITUD', 
            HIPOCLORADORES:'HIPOCLORADORES', 
            PROGRAMA:'PROGRAMA', 
        }
    },
    methods: {
        filterchange2(tipo, value){
            // this.show = true
            switch (tipo) {
                case 'consejo':
                    this.filtros.consejo = value
                    this.visible.consejo = value.length > 0 ? true : false
                    this.headersTable[1].visible = value.length > 0 ? true : false
                    // this.getDatosByFiltros()
                    break;
                case 'subcuenca':
                    this.filtros.subcuenca = value
                    this.visible.subcuenca = value.length > 0 ? true : false
                    this.headersTable[2].visible = value.length > 0 ? true : false
                    // this.getDatosByFiltros()
                    break;
                case 'region':
                    this.filtros.region = value
                    this.visible.region = value.length > 0 ? true : false
                    this.headersTable[3].visible = value.length > 0 ? true : false
                    // this.getDatosByFiltros()
                    break;
                case 'municipio':
                    this.filtros.municipio = value
                    this.visible.municipio = value.length > 0 ? true : false
                    this.headersTable[4].visible = value.length > 0 ? true : false
                    // this.getDatosByFiltros()
                    break;
                case 'estado':
                    this.filtros.estado = value
                    // this.getDatosByFiltros()
                    break;
                case 'tipo':
                    this.filtros.tipo = value
                    // this.getDatosByFiltros()
                    break;
                default:
                    break;
            }
        },
        getDatosByFiltros(){
            axios.post('/cal/consultarbyfiltros',{filtros: this.filtros})
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
            axios.post('/ap/export',{datos: data, page: 'calidad'}
            , {
                responseType: 'blob'
            })
            .then((response)=>{
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'calidad_agua_datos.xlsx')
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
