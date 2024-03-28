

import './bootstrap';

// IQBAL 24-MAR-2024
import jQuery from 'jquery';
window.$ = jQuery;

// IQBAL 25-MAR-2024
import swal from 'sweetalert2';
window.Swal = swal;

// IQBAL 25-MAR-2024
import select2 from 'select2';
select2(); // <-- select2 must be called

// IQBAL 26-MAR-2024
import Chart from 'chart.js/auto';
window.Chart = Chart;

// IQBAL 28-MAR-2024
import feather from "feather-icons";
document.addEventListener("DOMContentLoaded", () => {
    feather.replace();
});
window.feather = feather;

//jquery-datetimepicker
//import 'jquery-ui/dist/jquery-ui.min.js'
//$('.datepicker').datepicker();

// import "node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker";

//import moment from 'moment';
//window.moment = moment;

//import "./feather";