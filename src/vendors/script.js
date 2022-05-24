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