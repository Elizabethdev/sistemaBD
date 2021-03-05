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
        showDismissibleAlert: false
    },
    methods:{
        calcular(){
            console.log('calcular')
            axios.post('/ap/calculardatosAP',{page: 'demanda'})
            .then((response)=>{
                this.showDismissibleAlert = response.data.res
                this.mensaje = response.data.msg
            })
            .catch(error => {
                console.log(error)
            })
        }

    }
});
