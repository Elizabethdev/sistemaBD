import vistaComponent from './components/generales/tipoVista.vue';
import filtrosComponent from './components/generales/filtros.vue';
import tableComponent from './components/generales/table.vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
// import axios from 'axios'
import axios from './client/client.js';
import { BOverlay} from 'bootstrap-vue'

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        filtrosComponent,
        tableComponent,
        vistaComponent,
        BOverlay
    },
    data: {
        show:false,
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
            this.show = true
            switch (value) {
                case 'consejo':
                    this.headersTable.splice(1, 1, 'Consejo de Cuenca');
                    this.getDatosVista('vwDemanda_AP_BY_CONSEJO', 'consejo_cuenca')
                    break;
                case 'municipio':
                    this.headersTable.splice(1, 1, 'Municipio');    
                    this.getDatosVista('vwDemanda_AP_by_mun','cve_mun')
                    break;
                case 'subcuenca':
                    this.headersTable.splice(1, 1, 'Subcuenca');
                    this.getDatosVista('vwDemanda_AP_BY_subcuenca','cve_subcuenca')
                    break;
                case 'region':
                this.headersTable.splice(1, 1, 'Región Económica');
                this.getDatosVista('vwDemanda_AP_BY_region_eco', 'num_region')
                    break;
                default:
                    break;
            }
        },
        filterchange2(tipo, value){
            this.show = !this.show
            switch (tipo) {
                case 'consejo':
                    this.filtros.consejo = value
                    if(this.tipoVista == tipo){
                        this.filterDatos(this.filtros.consejo)
                    } else{
                        this.getDatosByFiltros()
                    }
                    break;
                case 'municipio':
                    this.filtros.municipio = value
                    if(this.tipoVista == tipo){
                        this.filterDatos(this.filtros.municipio)
                    } else{
                        this.getDatosByFiltros()
                    }
                    break;
                case 'subcuenca':
                    this.filtros.subcuenca = value
                    if(this.tipoVista == tipo){
                        this.filterDatos(this.filtros.subcuenca)
                    } else{
                        this.getDatosByFiltros()
                    }
                    break;
                case 'region':
                    this.filtros.region = value
                    if(this.tipoVista == tipo){
                        this.filterDatos(this.filtros.region)
                    } else{
                        this.getDatosByFiltros()
                    }
                    break;
                default:
                    break;
            }
        },
        getDatosVista(vista, groupby){
            axios.post('/ap/consultabyvista',{vista: vista, tipo: groupby})
            .then((response)=>{
                this.newdtotales = response.data.datos
                this.newdtotalesStatic = response.data.datos
                this.visible = true
                this.show = !this.show
            })
            .catch(error => {
                console.log(error)
                this.show = !this.show
            })
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
            this.show = !this.show
        },
        getDatosByFiltros(){
            axios.post('/ap/consultarmunbyfiltros',{filtros: this.filtros, tipoVista: this.tipoVista})
            .then((response)=>{
                this.newdtotales = response.data.datos
                this.newdtotalesStatic = response.data.datos
                this.show = !this.show
            })
            .catch(error => {
                console.log(error)
                this.show = !this.show
            })
        }
    }
});
