import '../../node_modules/materialize-css/sass/materialize.scss';
import '../../node_modules/materialize-css/dist/js/materialize.js';
import '../scss/company-info.scss';
import {burger, openModal} from '../vendors/script';
$(() =>{
    burger();
    openModal('.btn-blue', '.modal');
});