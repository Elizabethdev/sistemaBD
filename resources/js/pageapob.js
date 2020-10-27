import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tableapob.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from './client/client.js';
import { BOverlay} from 'bootstrap-vue'

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        filtrosComponent,
        tableComponent,
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
            {name:'Población Con AP 2010', visible: true},
            {name:'Población Sin AP 2010', visible: true},
            {name:'Población Con AP 2015', visible: true},
            {name:'Población Sin AP 2015', visible: true},
            {name:'Población Con AP 2020', visible: true},
            {name:'Población Sin AP 2020', visible: true},
            {name:'Población Con AP 2030', visible: true},
            {name:'Población Sin AP 2030', visible: true}
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
                default:
                    break;
            }
        },
        getDatosByFiltros(){
            axios.post('/ap/consultarbyfiltros',{filtros: this.filtros, page: 'poblacion'})
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
        }
    }
});
