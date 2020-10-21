import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/tablesan.vue'
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
            {name:'Programa construyo', visible: true, class: ''},
            {name:'Cuerpo Receptor', visible: true, class: ''},
            {name:'Diagnostico', visible: true, class: ''}
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
            })
        }
    }
});
