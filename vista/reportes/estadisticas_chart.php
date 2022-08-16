<!-- EMBARAZADAS -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Estadistica de Embarazadas</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        <!-- card-body -->
        <div class="card-body">
            <div class="card-block">
                <div class="form-group row justify-content-center">
                    <div class="col-md-12 mt-2">
                        <div id="embarazadas" style="height: 370px; width: 100%;"></div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            var chart = new CanvasJS.Chart("embarazadas", {
                                theme: "light2",
                                animationEnabled: true,
                                title: {
                                    text: "Reporte de Mujeres Embarazadas"
                                },
                                data: [{
                                    type: "doughnut",
                                    indexLabel: "{symbol} - {y}",
                                    yValueFormatString: "#,##0.0\"%\"",
                                    showInLegend: true,
                                    legendText: "{label} : {y}",
                                    dataPoints: <?php echo json_encode($this->datos_embarazadas, JSON_NUMERIC_CHECK); ?>
                                }]
                            });
                            chart.render();
                        });
                        </script>
                    </div>
                </div>
            </div>
        </div>


        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

