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