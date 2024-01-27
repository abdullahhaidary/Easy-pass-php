<?php
include_once 'admin/header.php';
?>

    <script type="text/javascript">
        window.onload=loadDoc();
        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tableAll").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ajaxProcess/dbtable.php", true);
            xhttp.send();

        }
        setInterval(function(){
            loadDoc();
        },1000);
        window.load=loadDoc();
    </script>
<script>

</script>
    <div class="card">
        <div class="card-header border-0">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">General Distributions</h3>
                <a href="javascript:void(0);">View Report</a>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <p class="d-flex flex-column">
                    <span class="text-bold text-lg">9726</span>
                    <span>Distributions Since Application Was Created</span>
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-danger">
                                  <i class="fas fa-arrow-down"></i>0.070112179487182%
                                </span>
                    <span class="text-muted"></span>
                </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <div class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand">
                        <div class=""></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink"><div class="">
                        </div>
                    </div>
                </div>
                <canvas id="sales-chart" height="269" style="display: block; height: 200px; width: 679px;" width="916" class="chartjs-render-monitor"></canvas>
            </div>

            <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> Caseload
                          </span>

                <span>
                    <i class="fas fa-square text-gray"></i> Distributed
                  </span>
            </div>
        </div>
        <div class="d-block" style="cursor:pointer;" onclick="showExtraChart();">
        <span class="fa fa-arrow-down float-right mr-1 mb-1"></span>
        </div>
    </div>
    <div id="showExtraChart" style="display:none;">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">General Distributions</h3>
                    <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">9726</span>
                        <span>Distributions Since Application Was Created</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-danger">
                                  <i class="fas fa-arrow-down"></i>0.070112179487182%
                                </span>
                        <span class="text-muted"></span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class=""></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"><div class="">
                            </div>
                        </div>
                    </div>
                    <canvas id="sales-chart2" height="269" style="display: block; height: 200px; width: 679px;" width="916" class="chartjs-render-monitor"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> Caseload
                          </span>

                    <span>
                    <i class="fas fa-square text-gray"></i> Distributed
                  </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5" id="tableAll">
    </div>
<script>
    function showExtraChart(){
        var showExtraChart=document.getElementById('showExtraChart');
        if(showExtraChart.style.display=='none') {
            showExtraChart.style.display = 'block';
        }else{
            showExtraChart.style.display = 'none';
        }
    }
</script>
<?php
include_once 'admin/footer.php';
?>

<?php

?>
