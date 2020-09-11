import exampleComponent from './components/ExampleComponent.vue';
import uploadComponent from './components/uploadfileComponent.vue';

window.Vue = require('vue');

const app = new Vue({
    el: '#app',
    components: {
        exampleComponent,
        uploadComponent
    }
});
