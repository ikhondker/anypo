<!DOCTYPE html>
<html>
<head>
<style>

#runfshop {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

#runfshop td, #runfshop th {
  border: 1px solid #ddd;
  padding: 5px;
}

#runfshop tr:nth-child(even){background-color: #f2f2f2;}

#runfshop tr:hover {background-color: #ddd;}

#runfshop th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #6495ED;
  color: white;
}

#report-header {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
  padding-bottom: 8px;
}
#report-header h1,h3 {
    margin-top: 0px;
    margin-bottom: 1px;
}
#report-header td {
  text-align: center;
}
#report-header table, th, td {
  border: 0px solid black;
}

#report-footer {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 9px;
  padding-bottom: 2px;
  color: #808080;
}
#report-footer  tr {
    padding-top: 4px;
    border-top: 1px solid #C0C0C0;
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
.pagenum:before {
    content: counter(page);
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
                    Printed By: 
                    @if(Auth::check())
                        {{ Auth::user()->name }}
                    @else
                        Guest    
                    @endif
                     at: {{ now()->format('d-M-Y H:i:s') }} From: {{ URL::current(); }}
                </td>
                <td style="text-align:right">
                    Page <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </div>

    <table id="report-header">
        <tr>
            <td>
                <h1>{{ $title }}</h1>
                Report Date: {{ $date}}
            </td>
        </tr>
    </table>


    <!-- Report main content -->
    <section class="content">
        @yield('body')
    </section>
    <!-- /.content -->
    

</body>
</html>


