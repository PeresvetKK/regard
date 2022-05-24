import '../../node_modules/materialize-css/sass/materialize.scss';
import '../../node_modules/materialize-css/dist/js/materialize.js';
import '../scss/authorization.scss';
import {burger, openClose} from '../vendors/script';
$(() =>{   
    function login(element, hide, open){
        $(element).on('click', function(e){
            e.preventDefault();
            $(hide).removeClass('active modal-active');
            $(open).toggleClass('modal-active active');
        })
    }
    openClose('.authorization__dase', '.login', '.recover');
    login('.complite-remember', '.modal', '.authorization');
    login('.btnLogin', '.authorization', '.modal');
});
