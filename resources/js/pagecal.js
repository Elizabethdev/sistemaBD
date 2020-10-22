import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tablecal.vue'
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
            axios.post('/cal/consultarbyfiltros',{filtros: this.filtros})
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
