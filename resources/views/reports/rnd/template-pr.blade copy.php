<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
<style>
    /* body {
      font-family: "Sofia", sans-serif;
    } */

    /** Define the margins of your page **/
    @page{
        margin-top: 50px; /* create space for header */
        margin-bottom: 50px; /* create space for footer */
    }
      
    #my-header-table {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Poppins", sans-serif; */
        border-collapse: collapse;
        border: 0px solid white;
        width: 100%;
        font-size: 12px;
        padding-bottom: 8px;
    }
    #my-header-table h1,h2,h3 {
        font-family: Arial, Helvetica, sans-serif;
        margin-top: 0px;
        margin-bottom: 1px;
        color: #1F9BCF;
    }
    /* #my-header-table td {
        text-align: center;
    } */
    #my-header-table td {
        border: 1px solid #FFFFFF;
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
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        bottom: 0px;
    }

    #report-footer {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Poppins", sans-serif; */
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
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Poppins", sans-serif; */
        border-collapse: collapse;
        border: 0px solid white;
        width: 100%;
        font-size: 12px;
        padding-bottom: 10px;
    }

    #my-summary-table table, th, {
        border: 1px solid #1F9BCF;
        padding: 10px;
        
    }

    #my-table {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Poppins", sans-serif; */
        border-collapse: collapse;
        width: 100%;
        font-size: 12px;
    }

    #my-table td, #my-table th {
        border: 1px solid #f2f2f2;
        padding: 5px;
    }

    #my-table tr:nth-child(even){background-color: #f2f2f2;}

    #my-table tr:hover {background-color: #FFFFFF;}

    #my-table th {
        padding-top: 8px;
        padding-bottom: 8px;
        text-align: left;
        background-color: #ced4da;
        border: 1px solid #FFFFFF;
        color: #1F9BCF;
    }

    #my-total-table {
        font-family: Arial, Helvetica, sans-serif;
        /* font-family: "Poppins", sans-serif; */
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

    #one td {
        border: 1px solid #1F9BCF; 
    }

</style>
</head>
<body>
    {{-- <div class="header">
        Page <span class="pagenum"></span>
    </div> --}}
    <div class="footer">
        <table id="report-footer">
            <tr>
                <td>
                    Printed at 8-Jun-22 by Iqbal H. Khondker 
                </td>
                <td style="text-align:right">
                    Page <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </div>


    <table id="my-header-table">
        <tr>
            <td width="60%" style="text-align:left; vertical-align: bottom;">
                <h1>{{ $title }}</h1>
            </td>
            <td style="text-align:right">
                <img src="{{ storage_path('app/logo/logo.png') }}" style="width: 75px"><br>
            </td>
        </tr>
        <tr>
            <td width="60%" style="text-align:left;">
                Flat#C3, Plot# 222, Road# 8,Block-C</br>
                Bashundhara R/A , Dhaka -1229</br>
                Phone: 01911310509 email: info@khondker.com, </br>
                Website: https://www.anypo.net
            </td>
            <td style="text-align:right; vertical-align: bottom;">
                <h2>PURCHASE REQUISITION</h2>
                <span>REQUISITION NO: <strong>[ 1234 ]</strong></span>
                DATE: 4-AUG-2023
            </td>
        </tr>
    </table>

    <table id="my-summary-table">
        <tr>
            <th colspan="3">Purchase Requisition for : This is summary of a test Requisition amount 999.00 USD</th>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="width:40%; text-align:left;"><h3>REQUESTOR</h3></th>
            <td style="width:20%; text-align:left"></th>
            <td style="width:40%; text-align:right;"><h3>VENDOR</h3></th>
        </tr>
        <tr>
            <td width="50%" style="text-align:left">
                Requestor: Iqbal H khondker<br>
                Dept: HR & Admin <br>
                Project X: GB08 <br>
                Amount: 999.00 USD<br/>
                Approval: DRAFT<br/>
            </td>
        <td>
        </td>
            <td style="text-align:right">
                Apollo Painting & Wallcovering<br/>
                ATTN: <br/>
                535 N. Eucalyptus Ave.<br/>
                Inglewood, CA 90302<br/>
                Phone (310)672-3080
            </td>
        </tr>
    </table>
    
    <table id="my-table">
        <tr>
            <th width="5%">SL#</th>
            <th width="50%">ITEM</th>
            <th width="5%">UNIT</th>
            <th width="10%">QTY</th>
            <th width="15%">PRICE (USD)</th>
            <th width="15%">AMOUNT (USD)</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td> Uniform For The Employees</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td>100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td>1</td>
            <td style="text-align:right">100.00</td>
            <td style="text-align:right">100.00</td>
        </tr>
        <tr>
            <th width="15%" colspan="5" style="text-align:right">SUB TOTAL</th>
            <th width="15%" style="text-align:right">1,999.99</th>
        </tr>
    </table>
    <table id="my-total-table">
        <tr>
            <td width="65%" rowspan="4" style=" padding-right: 20px; vertical-align: top;">
                <strong>Comments or Special Instructions:</strong> <br>
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada.
            </td>
            <td style="text-align:right">Sales Tax (12%):</td>
            <td width="15%" style="text-align:right">1100.00</td>
        </tr>
        <tr>
            <td style="text-align:right">Shipping:</td>
            <td style="text-align:right">1100.00</td>
        </tr>
        <tr>
            <td style="text-align:right">Discount (5%):</td>
            <td style="text-align:right">1100.00</td>
        </tr>
        <tr id="one">
            <td style="text-align:right;"><h3>TOTAL (USD)<h3></td>
            <td  style="text-align:right;"><h3>3,100.00</h3></td>
        </tr>
    </table>
</body>
</html>


