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


import './custom'

//import moment from "moment";
//window.moment = moment();
//import moment from 'moment';
//window.moment = moment;

// import 'jquery-ui/dist/jquery-ui.min.js'
// import 'jquery-ui/ui/widgets/datepicker.js';
// import 'jquery-ui/ui/widgets/autocomplete.js';
// import 'jquery-ui/ui/widgets/datepicker.js';
// import 'jquery-ui/themes/base/all.css';
// $('.datepicker').datepicker();
