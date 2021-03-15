import filtrosComponent from './components/generales/filtros.vue';
import rangosComponent from './components/generales/filtrosrangos.vue';
import tableComponent from './components/generales/tableapcob.vue';
import btnComponent from './components/generales/btn.vue';
import btnC from './components/generales/btnC.vue';
import paginateComponent from './components/generales/paginate.vue';
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
        rangosComponent,
        btnComponent,
        btnC,
        paginateComponent,
        BOverlay
    },
    data: {
        show:false,
        currentPage: 1,
        datostotales: [],
        busy:false,
        headersTable: [
            {name:'Estado', visible: true},
            {name:'Consejo de Cuenca', visible: true},
            {name:'Subcuenca', visible: true},
            {name:'Región Económica', visible: true},
            {name:'Municipio', visible: true},
            {name:'Localidad', visible: true},
            {name:'Tipo de Población 2020', visible: true},
            {name:'Cobertura de Agua 2010', visible: true},
            {name:'Cobertura de Agua 2015', visible: true},
            {name:'Cobertura de Agua 2020', visible: true},
            {name:'Cobertura de Agua 2030', visible: true},
            {name:'Rango Cobertura 2015', visible: true},
            {name:'Rango Cobertura 2020', visible: true},
            {name:'Rango Cobertura 2030', visible: true},
            {name:'Rango Población 2015', visible: true},
            {name:'Rango Población 2020', visible: true},
            {name:'Rango Población 2030', visible: true},
            {name:'Rango Población Indígena', visible: true},
        ],
        newdtotales: {},
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
            RANGO_PI:'Rango_PI', 
            POBTOT_20:'POBTOT_20', 
            TIPO_20:'TIPO_20', 
            PO_CON_AP_15:'PO_CON_AP_15', 
            PO_CON_AP_20:'PO_CON_AP_20',
            PO_CON_AP_30:'PO_CON_AP_30',
            R_POB_15: 'R_POB_15',
            R_POB_20: 'R_POB_20',
            R_POB_30: 'R_POB_30',
            COB_AP_10:'COB_AP_10', 
            COB_AP_15:'COB_AP_15', 
            COB_AP_20:'COB_AP_20', 
            COB_AP_30:'COB_AP_30',
            R_COB_AP_15:'R_COB_AP_15',
            R_COB_AP_20:'R_COB_AP_20',
            R_COB_AP_30:'R_COB_AP_30',
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
                case 'cobertura':
                    this.filtros.rcobertura = value
                    // if(this.filtros.año.length > 0)
                    //     this.getDatosByFiltros()
                    // else
                    //     this.show = false
                    break;
                case 'poblacion':
                    this.filtros.rpoblacion = value
                    // if(this.filtros.año.length > 0)
                    //     this.getDatosByFiltros()
                    // else
                    //     this.show = false
                    break;
                case 'PI':
                    this.filtros.pi = value
                    // this.getDatosByFiltros()
                    break;
                case 'año':
                    this.filtros.año = value
                    // if(this.filtros.rcobertura.length > 0 && this.filtros.año.length > 0 || this.filtros.rpoblacion.length > 0 && this.filtros.año.length > 0)
                    //     this.getDatosByFiltros()
                    // else
                    //     this.show = false
                    break;
                default:
                    break;
            }
        },
        getDatosByFiltros(){
            axios.post('/ap/consultarbyfiltros',{filtros: this.filtros, pagina: 'cobertura', page: 1})
            .then((response)=>{
                this.show = false
                this.newdtotales = response.data.datos
                this.datostotales = response.data.datostotales
                this.currentPage = this.newdtotales.current_page
            })
            .catch(error => {
                console.log(error)
                this.show = false
                this.newdtotales = {}
            })
        },
        guardarexcel(){
            let data = [...this.datostotales]
            data.splice(0,0,this.headersFile)
            this.busy = true
            axios.post('/ap/export',{filtros: this.filtros, datos: data, page: 'cobertura', headerTable: this.headersFile}
            , {
                responseType: 'blob'
            })
            .then((response)=>{
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'cobertura_ap.xlsx')
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
            if(this.filtros.consejo.length > 0 || this.filtros.subcuenca.length > 0 || this.filtros.region.length > 0 || this.filtros.municipio.length > 0 || this.filtros.estado.length > 0 || this.filtros.tipo.length > 0 || this.filtros.pi.length > 0 || this.filtros.rcobertura.length > 0 && this.filtros.año.length > 0 || this.filtros.rpoblacion.length > 0 && this.filtros.año.length > 0)
                this.getDatosByFiltros()
            else
                this.show = false
        },
        getpage(page){
            this.show = true
            axios.post('/ap/consultarbyfiltros',{filtros: this.filtros, pagina: 'cobertura', page: page})
            .then((response)=>{
                this.show = false
                this.newdtotales = response.data.datos
                this.currentPage = this.newdtotales.current_page
            })
            .catch(error => {
                console.log(error)
                this.show = false
                this.newdtotales = {}
            })
        },
    }
});
