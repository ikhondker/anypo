<style>
	/** Define the margins of your page **/
	@page{
		margin-top: 50px; /* create space for header */
		margin-bottom: 60px; /* create space for footer */
	}
	
	@font-face {
        font-family: 'Lato';
        font-weight: normal;
        font-style: normal;
        font-variant: normal;
		src: url("fonts/lato/Lato-Regular.ttf") format('truetype');
    }

	body {
		font-family: "Lato", sans-serif;	
	  	font-size: 12px;
	  	/* color: green; */
	}

	.letterhead {
		font-family: "Lato", sans-serif;	
	  	font-size: 12px;
	  	padding: 0px;
	  	vertical-align: bottom;
	}

	#my-header-table {
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		padding-bottom: 8px;
	}
	#my-header-table h1, h2, h3 {
		margin-top: 0px;
		margin-bottom: 1px;
		/* color: #1F9BCF; */
	}
	/* #my-header-table td {
		text-align: center;
	} */
	#my-header-table td {
		border: 1px solid #white;
	}

	.header, .footer {
		width: 100%;
		text-align: center;
		position: fixed;
	}

	.header {
		top: 0px;
	}
	
	.footer {
		font-size: 10px;
		bottom: 0px;
	}

	#report-footer {
		border-collapse: collapse;
		width: 100%;
		font-size: 10px;
		padding-bottom: 2px;
		color: #808080;
	}
	#report-footer tr {
		padding-top: 4px;
		border-top: 1px solid #C0C0C0;
	}

	.pagenum:before {
		content: counter(page);
	}

	#my-summary-table {
		border-collapse: collapse;
		border: 0px solid white;
		width: 100%;
		padding-bottom: 10px;
	}

	#my-summary-table th, {
		border: 1px solid #1F9BCF;
		font-weight: normal;
		font-size: 14px;
		padding: 10px;
	}

	#my-table {
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
	}

	#my-table td, #my-table th {
		border: 1px solid #adb5bd;
		padding: 5px;
	}

	/* #my-table tr:nth-child(even){background-color: #f2f2f2;}

	#my-table tr:hover {background-color: #FFFFFF;} */

	#my-table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: left;
		background-color: #adb5bd;
		border: 1px solid #adb5bd;
		color: #020202;
	}

	#my-total-table {
		border-collapse: collapse;
		width: 100%;
		font-size: 12px;
		/* padding-bottom: 8px; */
	}

	#my-total-table td {
		border: 0px solid #f2f2f2;
		padding: 5px;
	}

	#my-total-table th {
		border: 1px solid #1F9BCF;
		padding: 5px;
	}
	/* table.shipToFrom td, table.shipToFrom th{text-align:left} */

   
</style>