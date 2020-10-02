import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/table.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import axios from 'axios'

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
        consultarByMun(datamun){
            console.log('emitiendo el evento')
            axios.post('/api/consultaapmun',{municipios: datamun})
            .then((response)=>{
                this.newdtotales = response.data.municipios
                // console.log(response.data)

            })
        }
    }
});
