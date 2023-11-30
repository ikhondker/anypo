<!DOCTYPE html>
<html>
<head>
    
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />

<style>
    /** Define the margins of your page **/
    @page{
        margin-top: 50px; /* create space for header */
        margin-bottom: 60px; /* create space for footer */
    }

    body {
      font-family: "Lato", sans-serif;
      font-size: 12px;
    }

    
    .letterhead {
      font-size: 10px;
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
        color: #1F9BCF;
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
</head>
<body>
    {{-- <div class="header">
        Page <span class="pagenum"></span>
    </div> --}}
    <div class="footer">
        <table id="report-footer">
            <tr>
                <td>
                    Printed at {{ date('d-M-Y: h:i:s') }} by {{ auth()->user()->name}}
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
                <h1>{{ $setup->name }}</h1>
            </td>
            <td style="text-align:right">
                @if ( $setup->logo == "")
                    <img src="{{ asset('/logo/logo.png')}}" width="75px" height="75px"/><br>
                @else
                    <img src="{{ storage_path('app/logo/logo.png') }}" style="width: 75px"><br>
                @endif
            </td>
        </tr>
        <tr>
            <td width="60%" style="text-align:left; vertical-align: bottom;">
                <span class="letterhead">
                    {{ $setup->address1 }}</br>
                    @if ($setup->address2 <> "")
                        {{ $setup->address2 }}</br>
                    @endif 
                    {{ $setup->city.', '.$setup->state.', '.$setup->zip. ', '.$setup->country  }}</br>
                    Phone: {{ $setup->cell }}, email: {{ $setup->email }}, </br>
                    Website: {{ $setup->website }}
                </span>
            </td>
            <td style="text-align:right; vertical-align: bottom;">
                <h2>PURCHASE REQUISITION</h2>
                REQUISITION NO: <strong>[ {{ $pr->id}} ]</strong></br>
                DATE: {{ date('d-M-Y') }}
            </td>
        </tr>
    </table>

    <table id="my-summary-table">
        <tr>
            <th colspan="3">[PR#{{ $pr->id}}] {{ $pr->summary }}  amount {{ number_format($pr->amount,2) }} {{ $pr->currency }}.</th>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
            <td style="width:40%; text-align:left;"><strong>REQUESTOR</strong></th>
            <td style="width:20%; text-align:left"></th>
            <td style="width:40%; text-align:right;"><strong>PROPOSED VENDOR</strong></th>
        </tr>
        <tr>
            <td width="50%" style="text-align:left; vertical-align: top;">
                Approval: {{ strtoupper($pr->auth_status->value) }}<br/>
                @if ($setup->auth_date <> "")
                    Approval Date: {{ strtoupper(date('d-M-y', strtotime($pr->auth_date))) }}<br/>
                @endif 
                Requestor: {{ $pr->requestor->name }}<br>
                Title: {{ $pr->requestor->designation_name->name }}, {{ $pr->requestor->dept_name->name }}<br>
                Project : {{ $pr->project_id }} <br>
                Amount: {{ number_format($pr->amount,2) }} {{ $pr->currency }}<br/>
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
            <th width="10%" style="text-align:right">QTY</th>
            <th width="15%" style="text-align:right">PRICE (USD)</th>
            <th width="15%" style="text-align:right">AMOUNT (USD)</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Office Equipment Maintenance</td>
            <td>Each</td>
            <td style="text-align:right">1</td>
            <td style="text-align:right">100.00</td>
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
            <td width="65%" style="padding-right: 10px; vertical-align: top;">
                <strong>Comments or Special Instructions:</strong> <br>
                {{ $pr->notes}} 
            </td>
            <td style="vertical-align: top;">
                <table id="my-total-table">
                    <tr>
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
                    <tr>
                        <td style="text-align:right; background-color: #1F9BCF;"><h3 style="color:#FFFFFF">TOTAL (USD)<h3></td>
                        <td style="text-align:right; background-color: #1F9BCF;"><h3 style="color:#FFFFFF">3,100.00</h3></td>
                    </tr>
                </table>
            </td>
        </tr>

        
    </table>

</body>
</html>


