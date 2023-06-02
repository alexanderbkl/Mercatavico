import './bootstrap';



window.Vue =  require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


const app = new Vue({
    el: '#app',
})





import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
