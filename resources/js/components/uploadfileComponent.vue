<template>
    <div class="row">
        <div class="col col-md-12 mb-4">
            <h1 class="h3 mb-2 text-gray-800">Cargar archivo</h1>
            <!-- <p class="mb-4">Selecciona el archivo Excel con los datos que desea guardar en la base de datos.</p> -->

        </div>
        <div class="col col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Selecciona el archivo Excel con los datos que desea guardar en la base de datos.</h6>
                </div>
                <div class="card-body">
                    <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
                </div>
              </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

    export default {
        name:"upload",
        props:{
            titulo: ''
        },
        components: {
            vueDropzone: vue2Dropzone,
        },
        mounted() {
            console.log('Component upload mounted')
        },
        data: function () {
            return {
                dropzoneOptions: {
                    url: 'https://httpbin.org/post',
                    // thumbnailWidth: 200,
                    // thumbnailHeight: 250,
                    uploadMultiple: false,
                    maxNumberOfFiles: 1,
                    acceptedFileTypes: 'application/xlsx,.csv',
                    // maxFilesize: 0.5,
                    headers: { "My-Awesome-Header": "header value" },
                    addRemoveLinks: true,
                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> Seleccionar archivo"
                }
            }
        }
    }
</script>

<style>
    @import url("https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
</style>
