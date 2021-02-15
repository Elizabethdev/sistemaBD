import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tablealc.vue';
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
            {name:'Estado', visible: true},
            {name:'Consejo de Cuenca', visible: false},
            {name:'Subcuenca', visible: false},
            {name:'Región Económica', visible: false},
            {name:'Municipio', visible: false},
            {name:'Localidad', visible: true},
            {name:'Tipo de Población 2020', visible: true},
            {name:'Volúmen de descarga 2010', visible: true},
            {name:'Volúmen de descarga 2015', visible: true},
            {name:'Volúmen de descarga 2020', visible: true},
            {name:'Volúmen de descarga 2030', visible: true}
        ],
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
            tipo: [],
            rcobertura: [],
            rpoblacion: [],
            año: [],
            pi: [],
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
            POBTOT_10:'POBTOT_10', 
            TIPO_10:'TIPO_10',
            POBTOT_15:'POBTOT_15', 
            TIPO_15:'TIPO_15',   
            POBTOT_20:'POBTOT_20', 
            TIPO_20:'TIPO_20', 
            POBTOT_30:'POBTOT_30', 
            TIPO_30:'TIPO_30', 
            DEM_ALC_10:'DEM_ALC_10', 
            DEM_ALC_15:'DEM_ALC_15',
            DEM_ALC_20:'DEM_ALC_20',
            DEM_ALC_30:'DEM_ALC_30', 
        }
    },
    methods: {
        filterchange2(tipo, value){
            // this.show = true
            this.tipoVista = tipo
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
            axios.post('/alc/consultarbyfiltros',{filtros: this.filtros, page: 'demanda'})
            .then((response)=>{
                this.show = false
                var aux = response.data.datos
                aux.push(response.data.total[0])
                this.newdtotales = aux
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
            axios.post('/ap/export',{datos: data, page: 'demanda'}
            , {
                responseType: 'blob'
            })
            .then((response)=>{
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'demanda_alc.xlsx')
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
