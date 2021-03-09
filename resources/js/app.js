import uploadComponent from './components/uploadfileComponent.vue';
import axios from './client/client.js';
import { BAlert } from 'bootstrap-vue'

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        uploadComponent,
        BAlert
    },
    data: {
        datos:'',
        mensaje:'',
        variant:'',
        showDismissibleAlert: false,
        disable:'',
        url:'/ap/calculardatosAPDEM'
    },
    methods:{
        calcularap(page){
            this.disable = 'disabled'
            switch (page) {
                case 'cobertura':
                    this.url = '/ap/calculardatosAPCOB';
                    break;
                case 'demanda':
                    this.url = '/ap/calculardatosAPDEM';
                    break;
                case 'poblacion':
                    this.url = '/ap/calculardatosAPPOB';
                    break;
                default:
                    break;
            }
            axios.post(this.url,{page: page})
            .then((response)=>{
                this.disable = ''
                this.showDismissibleAlert = true
                this.mensaje = response.data.msg
                this.variant = response.data.variant
            })
            .catch(error => {
                console.log(error)
                this.disable = ''
                this.showDismissibleAlert = true
                this.mensaje = response.data.msg
                this.variant = response.data.variant
            })
        },
        calcularalc(page){
            this.disable = 'disabled'
            switch (page) {
                case 'cobertura':
                    this.url = '/ap/calculardatosALCCOB';
                    break;
                case 'demanda':
                    this.url = '/ap/calculardatosALCDEM';
                    break;
                case 'poblacion':
                    this.url = '/ap/calculardatosALCPOB';
                    break;
                default:
                    break;
            }
            axios.post(this.url,{page: page})
            .then((response)=>{
                this.disable = ''
                this.showDismissibleAlert = true
                this.mensaje = response.data.msg
                this.variant = response.data.variant
            })
            .catch(error => {
                console.log(error)
                this.disable = ''
                this.showDismissibleAlert = true
                this.mensaje = response.data.msg
                this.variant = response.data.variant
            })
        }

    }
});
