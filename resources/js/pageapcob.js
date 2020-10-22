import filtrosComponent from './components/generales/filtros.vue';
import rangosComponent from './components/generales/filtrosrangos.vue';
import tableComponent from './components/generales/tableapcob.vue';
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
        BOverlay
    },
    data: {
        show:false,
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
        }
    },
    methods: {
        filterchange2(tipo, value){
            this.show = true
            switch (tipo) {
                case 'consejo':
                    this.filtros.consejo = value
                    this.visible.consejo = value.length > 0 ? true : false
                    this.headersTable[1].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'subcuenca':
                    this.filtros.subcuenca = value
                    this.visible.subcuenca = value.length > 0 ? true : false
                    this.headersTable[2].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'region':
                    this.filtros.region = value
                    this.visible.region = value.length > 0 ? true : false
                    this.headersTable[3].visible = value.length > 0 ? true : false
                    this.getDatosByFiltros()
                    break;
                case 'municipio':
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
            axios.post('/ap/consultarbyfiltros',{filtros: this.filtros, page: 'cobertura'})
            .then((response)=>{
                this.show = false
                this.newdtotales = response.data.datos
            })
            .catch(error => {
                console.log(error)
                this.show = false
            })
        }
    }
});
