<template>
    <div class="row gtr-uniform">

        <div class="field col-4 col-12-xsmall">
            <b-dropdown text="Estados " class="m-2 w-100"  menu-class="drop-overflow w-100" no-flip boundary="scrollParent">
                <b-form-group>
                    <b-form-checkbox-group
                        v-model="estadoSelected"
                        :options="estados"
                        name="estados"
                        class="ml-3"
                        stacked
                    ></b-form-checkbox-group>
                </b-form-group>
            </b-dropdown>

            <span>Selected: {{ estadoSelected }}</span>
        </div>

        <div class="field col-4 col-12-xsmall">
            <label for="consejo">Consejo de cuenca: </label>
            <select v-model="consejoSelected" id="consejo" size="4" multiple>
                <option v-for="option in consejos" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="field col-4 col-12-xsmall">
            <label for="municipio">Municipio: </label>
            <select v-model="municipioSelected" id="municipio" size="4" multiple>
                <option v-for="option in municipios" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="field col-3 col-12-xsmall">
            <label for="subcuenca">Subcuenca: </label>
            <select v-model="municipioSelected" id="subcuenca" :size="6" multiple>
                <option v-for="(option, index) in subcuencas" :key="index"  v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="field col-3 col-12-xsmall">
            <label for="subcuenca">Región Económica: </label>
            <select v-model="municipioSelected" id="subcuenca" size="4" multiple>
                <option v-for="option in subcuencas" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="field col-3 col-12-xsmall">
            <label for="subcuenca">Localidad: </label>
            <select v-model="municipioSelected" id="subcuenca" size="4" multiple>
                <option v-for="option in subcuencas" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        <div class="field col-3 col-12-xsmall">
            <label for="subcuenca">Tipo: </label>
            <select v-model="municipioSelected" id="subcuenca" size="4" multiple>
                <option v-for="option in tipos" v-bind:value="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>
        
    </div>
</template>

<script>
import { BFormCheckboxGroup, BDropdown, BFormGroup  } from 'bootstrap-vue'
// Vue.component('b-form-checkbox-group', BFormCheckboxGroup)

    export default {
        name:"filtros",
        props:{
            titulo: ''
        },
        components: {
            BFormCheckboxGroup,
            BDropdown,
            BFormGroup
        },
        mounted() {
            console.log('Component filtros mounted.')
        },
        data() {
            return {
                estadoSelected: [],
                consejoSelected: [],
                municipioSelected: [],
                estados: [
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                    { value: 'a', text: 'Chiapas' },
                    { value: 'b', text: 'Tabasco' },
                ],
                consejos: [
                    { value: 'a', text: 'Ríos Grijalva y Usumacinta' },
                    { value: 'b', text: 'COSTA DE CHIAPAS' },
                ],
                municipios: [
                    { value: 'a', text: 'La Trinitaria' },
                    { value: 'b', text: 'Tapachula' },
                    { value: 'c', text: 'Chamula' },
                    { value: 'd', text: 'San Cristóbal de Las Casas' }
                ],
                subcuencas: [
                    { value: 'a', text: 'Lagartero' },
                    { value: 'b', text: 'Puerto Madero' },
                    { value: 'c', text: 'Hondo' },
                ],
                tipos: [
                    { value: 'urbana', text: 'Urbana' },
                    { value: 'rural', text: 'Rural' },
                ],
            }
        }
    }
</script>


<style >
    .drop-overflow{
        height: 200px;
        overflow-x: auto;
    }
</style>