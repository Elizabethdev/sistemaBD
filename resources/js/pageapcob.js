import filtrosComponent from './components/generales/filtros.vue';
import rangosComponent from './components/generales/filtrosrangos.vue';
import tableComponent from './components/generales/tableapcob.vue';
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
        rangosComponent,
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
            {name:'Cobertura de Agua 2010', visible: true},
            {name:'Cobertura de Agua 2015', visible: true},
            {name:'Cobertura de Agua 2020', visible: true},
            {name:'Cobertura de Agua 2030', visible: true}
        ],
        newdtotalesStatic: {},
        newdtotales: [],
        newdmunicipios: {},
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
            order: 5
        },
        headersFile: {
            cve_u:"cve_u",
            cve_edo: 'cve_edo',
            estado:"estado",
            consejo_cuenca: 'consejo_cuenca',
            cve_mun: 'cve_mun',
            municipio:"municipio",
            cve_subcuenca:'cve_subcuenca', 
            subcuenca:'subcuenca', 
            reg_economica:'reg_economica', 
            num_region:'num_region', 
            localidad:'localidad', 
            POBTOT:'POBTOT', 
            TIPO_20:'TIPO_20', 
            COB_AP_10:'COB_AP_10', 
            COB_AP_15:'COB_AP_15', 
            COB_AP_20:'COB_AP_20', 
            COB_AP_30:'COB_AP_30'
        }
    },
    methods: {
        filterchange2(tipo, value){
            this.show = true
            switch (tipo) {
                case 'consejo':
                    var order = value.length > 0 ? 1 : 5
                    this.filtros.order = this.filtros.order > order ? order : this.filtros.order
                    this.filtros.consejo = value
                    this.visible.consejo = value.length > 0 ? true : false
                    this.headersTable[1].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'subcuenca':
                    var order = value.length > 0 ? 2 : 5
                    this.filtros.order = this.filtros.order > order ? order : this.filtros.order
                    this.filtros.subcuenca = value
                    this.visible.subcuenca = value.length > 0 ? true : false
                    this.headersTable[2].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'region':
                    var order = value.length > 0 ? 3 : 5
                    this.filtros.order = this.filtros.order > order ? order : this.filtros.order
                    this.filtros.region = value
                    this.visible.region = value.length > 0 ? true : false
                    this.headersTable[3].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'municipio':
                    var order = value.length > 0 ? 4 : 5
                    this.filtros.order = this.filtros.order > order ? order : this.filtros.order
                    this.filtros.municipio = value
                    this.visible.municipio = value.length > 0 ? true : false
                    this.headersTable[4].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'estado':
                    this.filtros.estado = value
                    this.getDatosByFiltros()
                    break;
                case 'tipo':
                    this.filtros.tipo = value
                    this.getDatosByFiltros()
                    break;
                case 'cobertura':
                    this.filtros.rcobertura = value
                    if(this.filtros.año.length > 0)
                        this.getDatosByFiltros()
                    else
                        this.show = false
                    break;
                case 'poblacion':
                    this.filtros.rpoblacion = value
                    if(this.filtros.año.length > 0)
                        this.getDatosByFiltros()
                    else
                        this.show = false
                    break;
                case 'PI':
                    this.filtros.pi = value
                    this.getDatosByFiltros()
                    break;
                case 'año':
                    this.filtros.año = value
                    if(this.filtros.rcobertura.length > 0 || this.filtros.rpoblacion.length > 0)
                        this.getDatosByFiltros()
                    else
                        this.show = false
                    break;
                default:
                    break;
            }
        },
        rangochange(tipo, value, año){
            this.show = true
            switch (tipo) {
                case 'cobertura':
                    this.filtros.rcobertura = value
                    this.filtros.año = año
                    this.getDatosByFiltros()
                    break;
                case 'poblacion':
                    this.filtros.rpoblacion = value
                    this.filtros.año = año
                    this.getDatosByFiltros()
                    break;
                case 'PI':
                    this.filtros.pi = value
                    this.getDatosByFiltros()
                    break;
                default:
                    break;
            }
        },
        getDatosByFiltros(){
            axios.post('/ap/consultarbyfiltros',{filtros: this.filtros, page: 'cobertura'})
            .then((response)=>{
                this.show = false
                var aux = response.data.datos
                aux.push(response.data.total[0])
                this.newdtotales = aux
            })
            .catch(error => {
                console.log(error)
                this.show = false
            })
        },
        guardarexcel(){
            let data = [...this.newdtotales]
            data.splice(0,0,this.headersFile)
            this.busy = true
            axios.post('/ap/export',{datos: data, page: 'cobertura'}
            , {
                responseType: 'blob'
            })
            .then((response)=>{
                const url = URL.createObjectURL(new Blob([response.data], {
                    type: 'application/vnd.ms-excel'
                }))
                const link = document.createElement('a')
                link.href = url
                link.setAttribute('download', 'calculos.xlsx')
                document.body.appendChild(link)
                link.click()
                this.busy = false
            })
            .catch(error => {
                console.log(error)
                this.busy = false
            })
        }
    }
});
