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
        tableComponent
    },
    data: {
        headersTable: ['Estado',
            'Consejo de Cuenca',
            'Municipio',
            'Subcuenca',
            'Región Económica',
            'Localidad',
            'Tipo de Población 2020',
            'Demanda de Agua 2010',
            'Demanda de Agua 2015',
            'Demanda de Agua 2020',
            'Demanda de Agua 2030'
        ],
        newdtotales: {}

    },
    methods: {
        filterchange(tipo, value){
            console.log(tipo,'---', value)
            switch (tipo) {
                case 'consejo':
                    this.consultarByconsejo(value)
                    break;
                case 'municipio':
                    this.consultarByMun(value)
                    break;
                case 'subcuenca':
                    this.consultarBysubcuenca(value)
                    break;
                case 'region':
                    this.consultarByregionEco(value)
                    break;
                default:
                    break;
            }
        },
        consultarByconsejo(value){
            axios.post('/consultaapconsejo',{consejos: value})
            .then((response)=>{
                this.newdtotales = response.data.consejos
            })
        },
        consultarByMun(value){
            axios.post('/consultaapmun',{municipios: value})
            .then((response)=>{
                this.newdtotales = response.data.municipios
            })
        },
        consultarBysubcuenca(value){
            axios.post('/consultaapsubcuenca',{subcuencas: value})
            .then((response)=>{
                this.newdtotales = response.data.subcuencas
            })
        },
        consultarByregionEco(value){
            axios.post('/consultaapregion',{regiones: value})
            .then((response)=>{
                this.newdtotales = response.data.regiones
            })
        },
    }
});
