import vistaComponent from './components/generales/tipoVista.vue';
import filtrosComponent from './components/generales/filtros.vue';
import filtrosComponent2 from './components/generales/filtrosv2.vue';
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
        filtrosComponent2
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
        mostrarCol: 'municipio',
        tipoVista: 'municipio'

    },
    methods: {
        vistaChange(value){
            this.tipoVista = value
            switch (value) {
                case 'consejo':
                    this.headersTable.splice(1, 1, 'Consejo de Cuenca');
                    this.mostrarCol = value
                    axios.post('/consultaporvista',{vista: value})
                    .then((response)=>{
                        this.newdtotales = response.data.datos
                        this.newdtotalesStatic = response.data.datos
                    })
                    break;
                case 'municipio':
                    this.headersTable.splice(1, 1, 'Municipio');    
                    this.mostrarCol = value
                    axios.post('/consultaporvista',{vista: value})
                    .then((response)=>{
                        this.newdtotales = response.data.datos
                        this.newdtotalesStatic = response.data.datos
                    })
                    break;
                case 'subcuenca':
                    this.headersTable.splice(1, 1, 'Subcuenca');
                    this.mostrarCol = value
                    break;
                case 'region':
                this.headersTable.splice(1, 1, 'Región Económica');
                    this.mostrarCol = value
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
                    axios.post('/consultarMunByConsejo',{consejos: value})
                    .then((response)=>{
                        this.newdmunicipios = response.data.municipios
                        this.filterDatos()
                    })
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
        filterDatos(){
            const muns = Object.keys(this.newdmunicipios)
            const totales = this.newdtotalesStatic
            const result = {}
            muns.forEach(function(elem, index){
                if (totales.hasOwnProperty(elem)){
                    result[elem] = totales[elem];
                }
            });
            this.newdtotales = result
        }
    }
});
