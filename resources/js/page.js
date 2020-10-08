import vistaComponent from './components/generales/tipoVista.vue';
import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/table.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import axios from 'axios'
import axios from './client/client.js';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        filtrosComponent,
        tableComponent,
        vistaComponent,
    },
    data: {
        headersTable: ['Estado',
            'Municipio',
            'Tipo de Población 2020',
            'Demanda de Agua 2010',
            'Demanda de Agua 2015',
            'Demanda de Agua 2020',
            'Demanda de Agua 2030'
        ],
        newdtotalesStatic: {},
        newdtotales: {},
        newdmunicipios: {},
        tipoVista: 'municipio',
        visible: false,
        filtros: {   
            municipio: [],
            consejo: [],
            subcuenca: [],
            region: []
        }
        

    },
    methods: {
        vistaChange(value){
            this.tipoVista = value
            this.visible = true
            switch (value) {
                case 'consejo':
                    this.headersTable.splice(1, 1, 'Consejo de Cuenca');
                    this.getDatosVista('vwDemanda_AP_BY_CONSEJO')
                    break;
                case 'municipio':
                    this.headersTable.splice(1, 1, 'Municipio');    
                    this.getDatosVista('vwDemanda_AP_by_mun')
                    break;
                case 'subcuenca':
                    this.headersTable.splice(1, 1, 'Subcuenca');
                    this.getDatosVista('vwDemanda_AP_BY_subcuenca')
                    break;
                case 'region':
                this.headersTable.splice(1, 1, 'Región Económica');
                this.getDatosVista('vwDemanda_AP_BY_region_eco')
                    break;
                default:
                    break;
            }
        },
        filterchange(tipo, value){
            switch (tipo) {
                case 'consejo':
                    this.mostrarCol = tipo
                    this.consultarByconsejo(value)
                    break;
                case 'municipio':
                    this.mostrarCol = tipo
                    this.consultarByMun(value)
                    break;
                case 'subcuenca':
                    this.mostrarCol = tipo
                    this.consultarBysubcuenca(value)
                    break;
                case 'region':
                    this.mostrarCol = tipo
                    this.consultarByregionEco(value)
                    break;
                default:
                    break;
            }
        },
        filterchange2(tipo, value){
            switch (tipo) {
                case 'consejo':
                    this.filtros.consejo = value
                    if(this.tipoVista == tipo){
                        this.filterDatos(value)
                    } else{
                        this.getDatosByFiltros()
                    }
                    break;
                case 'municipio':
                    this.filtros.municipio = value
                    break;
                case 'subcuenca':
                    break;
                case 'region':
                    break;
                default:
                    break;
            }
        },
        consultarByconsejo(value){
            this.headersTable.splice(1, 1, 'Consejo de Cuenca');
            axios.post('/consultaapconsejo',{consejos: value})
            .then((response)=>{
                this.newdtotales = response.data.consejos
            })
        },
        consultarByMun(value){
            this.headersTable.splice(1, 1, 'Municipio');
            axios.post('/consultaapmun',{municipios: value})
            .then((response)=>{
                this.newdtotales = response.data.municipios
            })
        },
        consultarBysubcuenca(value){
            this.headersTable.splice(1, 1, 'Subcuenca');
            axios.post('/consultaapsubcuenca',{subcuencas: value})
            .then((response)=>{
                this.newdtotales = response.data.subcuencas
            })
        },
        consultarByregionEco(value){
            this.headersTable.splice(1, 1, 'Región Económica');
            axios.post('/consultaapregion',{regiones: value})
            .then((response)=>{
                this.newdtotales = response.data.regiones
            })
        },
        getDatosVista(vista){
            axios.post('/ap/consultabyvista',{vista: vista})
            .then((response)=>{
                this.newdtotales = response.data.datos
                this.newdtotalesStatic = response.data.datos
            })
        },
        filterDatos(filtro){
            const filtros = Object.keys(filtro)
            const totales = this.newdtotalesStatic
            const result = {}
            filtros.forEach(function(elem, index){
                if (totales.hasOwnProperty(elem)){
                    result[elem] = totales[elem];
                }
            });
            this.newdtotales = result
        },
        getDatosByFiltros(){
            axios.post('/ap/consultarmunbyfiltros',{filtros: this.filtros})
            .then((response)=>{
                this.newdtotales = response.data.municipios
            })
        }
    }
});
