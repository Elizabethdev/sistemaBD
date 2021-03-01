import uploadComponent from './components/uploadfileComponent.vue';
import axios from './client/client.js';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        uploadComponent
    },
    data: {
        datos:''
    },
    methods:{
        calcular(){
            console.log('calcular')
            axios.post('/ap/calculardatosAP',{page: 'demanda'})
            .then((response)=>{
                // this.show = false
                this.datos = response.data.datos
               
            })
            .catch(error => {
                console.log(error)
            })
        }

    }
});
