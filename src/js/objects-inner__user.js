import '../../node_modules/materialize-css/sass/materialize.scss';
import '../../node_modules/materialize-css/dist/js/materialize.js';
import '../../node_modules/chart.js/dist/chart.js';
import '../scss/objects-inner__user.scss';
import {burger, tabs} from '../vendors/script';
$(() =>{
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
});