// Styles (required)
import '../scss/app.scss'

// Common (required)
import "./modules/bootstrap";
import "./modules/css-variables";
import "./modules/lucide";
import "./modules/sidebar";
import "./modules/theme-toggle";

// Common (optional)
import "./modules/moment";
//import "./modules/dragula";
//import "./modules/notyf";

// Charts (optional)
//import "./modules/chartjs";
// IQBAL 26-MAR-2024
// default charjs with appstak4 is 2.9. which shows error 
// so don't import "./modules/chartjs"; install charjs4 and use vanilla one
import Chart from 'chart.js/auto';
window.Chart = Chart;
//import "./modules/apexcharts";

// Forms (optional)
import "./modules/daterangepicker"; // requires jQuery
import "./modules/tempus-dominus";
//import "./modules/fullcalendar";
import "./modules/mask"; 			// requires jQuery
//import "./modules/quill";
import "./modules/select2"; 		// requires jQuery
import "./modules/validation"; 		// requires jQuery
//import "./modules/wizard"; 		// requires jQuery

// Maps (optional)
//import "./modules/vector-maps";

// Tables (optional)
//import "./modules/datatables"; 	// requires jQuery

// IQBAL 25-MAR-2024
import swal from 'sweetalert2';
window.Swal = swal;
import './custom'


