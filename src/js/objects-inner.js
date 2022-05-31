import '../../node_modules/materialize-css/sass/materialize.scss';
import '../../node_modules/materialize-css/dist/js/materialize.js';
import '../../node_modules/chart.js/dist/chart.js';
import AirDatepicker from 'air-datepicker';
import 'air-datepicker/air-datepicker.css';
import '../scss/objects-inner.scss';

import { burger, tabs, setDate, openModal} from '../vendors/script';
$(() => {
    burger();
    tabs();
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [10, 11, 12, 13, 14, 15, 16, 17, 18],
            datasets: [
                {
                label: "график 1",
                data: [-6.5, -6.2, 0.5, -4, -6, -1, -3, 0, 0.5],
                backgroundColor: [
                    'white'
                ],
                borderColor: [
                    '#5F41B2'
                ],
                borderWidth: 2,
            },
            {
                label: "график 2",
                data: [-6.5, -6.4, -0.5, -6, -2, 0.3, -3, -4, -6],
                backgroundColor: [
                    'white'
                ],
                borderColor: [
                    '#C05294'
                ],
                borderWidth: 2,
            }
        ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
    // myChart.Line(data, {
    //     onAnimationComplete: function () {
    //         var sourceCanvas = this.chart.ctx.canvas;
    //         var copyWidth = this.scale.xScalePaddingLeft - 5;
    //         var copyHeight = this.scale.endPoint + 5;
    //         var targetCtx = document.getElementById("myChartAxis").getContext("2d");
    //         targetCtx.canvas.width = copyWidth;
    //         targetCtx.drawImage(sourceCanvas, 0, 0, copyWidth, copyHeight, 0, 0, copyWidth, copyHeight);
    //     }
    // });
    setDate('date1');
    
    function addCicle(){
        $('.add-cicle').on('click', function(){
            let container = document.querySelector('.functional-table');
            container.insertAdjacentHTML("beforeend", 
            `
            <div class="table-box">
                        <div class="grid-container table">
                            <div class="th-header">№ цикла \ дата</div>
                            <div class="th-left">АБС значение</div>
                            <div class="th-right-top">Разность</div>
                            <div class="th-right-left">За цикл</div>
                            <div class="th-right-right">Общая</div>
                        </div>
                        <div class="table-inputs">
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                            <div class="table-row">
                                <div class="table-item table-item--long">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text one">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text two">
                                </div>
                                <div class="table-item">
                                    <input placeholder="Значение" id="" type="text" class="validate input-text three">
                                </div>
                            </div>
                        </div>
                    </div>
            `);
        });
    }
    function removeCicle(){
        $('.remove-cicle').on('click', function(){
            let items = document.getElementsByClassName('table-box');
            let lastItem = items.length - 1;
            if(lastItem != 0){
                items[lastItem].remove();
            }
        });
    }
    function addRow(){
        $('.add-row').on('click', function(){
            
        });
    }
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    openModal('.add-row', '.modal');
    removeCicle();
    addCicle();
})