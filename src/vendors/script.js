import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';

export function burger() {
    let burger = document.querySelector(".burger");
    burger.addEventListener("click", function () {
        let aside = document.querySelector(".aside");
        let bod = document.querySelector('.scroll');

        aside.classList.toggle("aside--active");
        bod.classList.toggle("fixed-scroll");
        burger.classList.toggle("burger-active");
    });
}
export function openClose(element, hide, open){
    $(element).on('click', function(){
        $(hide).removeClass('active');
        $(open).removeClass('hide-block');
    })
}
export function openModal(element, modal){
    $(element).on('click', function(){
        console.log('+');
        $(modal).addClass('modal-active');
        $("#root").addClass('fixed-scroll');
    })
    $('.modal__close').on('click', function(){
        $(modal).removeClass('modal-active');
        $("#root").removeClass('fixed-scroll');
    })
}
export function tabs() {
    $('.tabs__item').click(function () {
        var id = $(this).attr('data-tab'),
            content = $('.tab-content[data-tab="' + id + '"]');

        $('.tabs__item.tabs__item--active').removeClass('tabs__item--active');
        $(this).addClass('tabs__item--active');

        $('.tab-content.active').removeClass('active');
        content.addClass('active');
    });
}
export function setDate(element){
    let elem = document.querySelector(`.${element}`);
    new AirDatepicker(`.${element}`, {
       
        onSelect: function (dataText, inst) {
            var dateAsString = dataText.formattedDate;
            var input = elem;
            input.value = dateAsString;
            input.setAttribute('data-quantity', input.value);
        }
    });
    var input = elem;
    input.addEventListener('input', function () {
        input.setAttribute('data-quantity', input.value);
    });

}
