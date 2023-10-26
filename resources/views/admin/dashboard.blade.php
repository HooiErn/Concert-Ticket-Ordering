@extends('layouts.admin')
@section('content')

<title>Admin Dashboard</title>
<style>
    @media (max-width: 767px) {
  .row .col-md-3 {
    flex: 0 0 50%;
    max-width: 50%;
  }
}
</style>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard 主页</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="downloadPageContent()">
        <i class="fas fa-download fa-sm text-white-50"></i>
        Generate Report 生成报告
    </a>
</div>

<!-- Data -->
@php
    use App\Models\Order;
    use Illuminate\Support\Facades\Storage;

    $orders = DB::table('orders')->get();
    $cash = $orders->where("waiter", '!=', null)->where('status', 1)->where("payment_method", 1)->count();
    $tng = $orders->where("waiter", '!=', null)->where('status', 1)->where("payment_method", 2)->count();
    
@endphp
<input type="hidden" id="cash" value="{{$cash}}">
<input type="hidden" id="tng" value="{{$tng}}">
<h4 class="text-dark twxt-uppercase m-2">Order Data</h4>
<div class="row">
    <div class="col-md-3 col-md-6">
        <div class="card card-body bg-primary text-white mb-3">
            <h5 class="card-title">Total Order (总订单)</h5>
            <h1>#</h1>
        </div>
    </div>
    <div class="col-md-3 col-md-6">
        <div class="card card-body bg-success text-white mb-3">
            <h5 class="card-title">Today Order (今天的订单)</h5>
            <h1>#</h1>
        </div>
    </div>
    <div class="col-md-3 col-md-6">
        <div class="card card-body bg-warning text-white mb-3">
            <h5 class="card-title">Monthly Order (月订单)</h5>
            <h1>#</h1>
        </div>
    </div>
    <div class="col-md-3 col-md-6">
        <div class="card card-body bg-danger text-white mb-3">
            <h5 class="card-title">Yearly Order (年订单)</h5>
            <h1>#</h1>
        </div>
    </div>
</div>

<h4 class="text-dark twxt-uppercase m-2">Earnings 收入</h4>
<div class="row">
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-dark shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h5 class="card-title">Total 总共</h5>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">RM 0</div>
                    </div>
                    <div class="col-auto">
                        <img src="https://cdn-icons-png.flaticon.com/128/5110/5110785.png" style="width:50px;height:50px;"><!-- Replace with your desired icon -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h5 class="card-title">Cash 现金</h5>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">RM 0</div>
                    </div>
                    <div class="col-auto">
                        <img src="https://cdn-icons-png.flaticon.com/512/2704/2704312.png" style="width:50px;height:50px;"> <!-- Replace with your desired icon -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-4 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <h5 class="card-title">Touch n Go 线上支付</h5>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">RM 0</div>
                    </div>
                    <div class="col-auto">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSexKLDtXeIwF9mdCt_befE61MAFvBNyQxH_xLzUdY&s" style="width:50px;height:50px;"> <!-- Replace with your desired icon -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<h4 class="text-dark twxt-uppercase m-2">Chart 图表</h4>
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart 面积图</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pie Chart 饼形图</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart" width="572" height="416"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Cash 现金
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Touch 'n Go 线上支付
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

<!-- Chart -->
<!-- <script>
    $(document).ready(function() {
        // Fetch the data from the database
        var orders = @json('');
        
        // Calculate monthly totals for cash and Touch 'n Go
        var monthlyTotals = {};
        
        orders.forEach(function(order) {
            var date = new Date(order.created_at);
            var month = date.toLocaleString('default', { month: 'long' });
            var year = date.getFullYear().toString();
            var monthYear = month + ' ' + year;
        
            var paymentMethod = order.payment_method;
        
            if (!monthlyTotals.hasOwnProperty(monthYear)) {
                monthlyTotals[monthYear] = {
                    cash: 0,
                    tng: 0
                };
            }
        
            if (paymentMethod === 1) {
                monthlyTotals[monthYear].cash += order.amount;
            } else if (paymentMethod === 2) {
                monthlyTotals[monthYear].tng += order.amount;
            }
        });
        
        // Get the current year
        var currentYear = new Date().getFullYear().toString();
        
        // Filter the monthly totals for the current year
        var filteredMonthlyTotals = Object.entries(monthlyTotals)
            .filter(function([monthYear, _]) {
                return monthYear.endsWith(currentYear);
            })
            .reduce(function(obj, [monthYear, value]) {
                obj[monthYear] = value;
                return obj;
            }, {});
        
        // Create an array of months from January to December of the current year
        var months = Array.from({ length: 12 }, function(_, index) {
            return new Date(currentYear, index, 1).toLocaleString('default', { month: 'long' });
        });
        
        // Retrieve the data for the chart
        var cashData = months.map(function(month) {
            var monthYear = month + ' ' + currentYear;
            return filteredMonthlyTotals[monthYear]?.cash.toFixed(2) || '0';
        });
        
        var tngData = months.map(function(month) {
            var monthYear = month + ' ' + currentYear;
            return filteredMonthlyTotals[monthYear]?.tng.toFixed(2) || '0';
        });
        
        // Create the chart
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: "Touch 'n Go",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: tngData,
                }, {
                    label: "Cash",
                    lineTension: 0.3,
                    backgroundColor: "rgba(28, 200, 138, 0.05)",
                    borderColor: "rgba(28, 200, 138, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(28, 200, 138, 1)",
                    pointBorderColor: "rgba(28, 200, 138, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(28, 200, 138, 1)",
                    pointHoverBorderColor: "rgba(28, 200, 138, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: cashData,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    },
                    y: {
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            callback: function(value, index, values) {
                                return '$' + value;
                            }
                        },
                        grid: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }
                },
                legend: {
                    display: true
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: true,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': $' + tooltipItem.yLabel;
                        }
                    }
                }
            }
        });


        var cashInput = parseFloat(document.getElementById("cash").value);
        var tngInput = parseFloat(document.getElementById("tng").value);

        var ctxPie = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: ["Cash", "Touch 'n Go"],
                datasets: [{
                    data: [cashInput, tngInput],
                    backgroundColor: ['#1cc88a', '#4e73df'],
                    hoverBackgroundColor: ['#17a673', '#2e59d9'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    });
</script>-->

<script>
    // Generate Report
    function downloadPageContent() {
        // Get the HTML content of the page
        const htmlContent = document.documentElement.outerHTML;
      
        // Create a Blob with the HTML content
        const blob = new Blob([htmlContent], { type: 'text/html;charset=utf-8' });
    
        // Save the file using FileSaver.js
        saveAs(blob, 'page_content.html');
    }
</script>

@endsection