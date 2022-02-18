</div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
    Copyright © 2010<script>if (new Date().getFullYear() > 2010){document.write("-" + new Date().getFullYear());}</script>
       
            </span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Made by <a href="https://www.duromedia.com.ng/" target="_blank">Duromedia.com.ng</a> </span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    
    
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    
    
    
    
    
    
    <script type=text/javascript>

(function($) {
    'use strict';
    $.fn.andSelf = function() {
        return this.addBack.apply(this, arguments);
    }
    $(function() {
        if ($("#currentBalanceCircle").length) {
            var bar = new ProgressBar.Circle(currentBalanceCircle, {
                color: '#000',
                // This has to be the same size as the maximum width to
                // prevent clipping
                strokeWidth: 12,
                trailWidth: 12,
                trailColor: '#0d0d0d',
                easing: 'easeInOut',
                duration: 1400,
                text: {
                    autoStyleContainer: false
                },
                from: { color: '#d53f3a', width: 12 },
                to: { color: '#d53f3a', width: 12 },
                // Set default step function for all animate calls
                step: function(state, circle) {
                    circle.path.setAttribute('stroke', state.color);
                    circle.path.setAttribute('stroke-width', state.width);

                    var value = Math.round(circle.value() * 100);
                    circle.setText('');

                }
            });

            bar.text.style.fontSize = '1.5rem';
            bar.animate(0.4); // Number from 0.0 to 1.0
        }
        if ($('#audience-map').length) {
            $('#audience-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: 'transparent',
                panOnDrag: true,
                focusOn: {
                    x: 0.5,
                    y: 0.5,
                    scale: 1,
                    animate: true
                },
                series: {
                    regions: [{
                        scale: ['#3d3c3c', '#f2f2f2'],
                        normalizeFunction: 'polynomial',
                        values: {

                            "BZ": 75.00,
                            "US": 56.25,
                            "AU": 15.45,
                            "GB": 25.00,
                            "RO": 10.25,
                            "GE": 33.25
                        }
                    }]
                }
            });
        }
        if ($("#transaction-history").length) {
            var areaData = {
                labels: ["Primary school", "Secondary school"],
                datasets: [{
                    data: [<?php echo (mysqli_num_rows($query)/(mysqli_num_rows($query) + mysqli_num_rows($query_sec))),
                    mysqli_num_rows($query_sec)/(mysqli_num_rows($query) + mysqli_num_rows($query_sec)); ?>],
                    backgroundColor: [
                        "#00d25b", "#df4759"
                    ]
                }]
            };
            var areaOptions = {
                responsive: true,
                maintainAspectRatio: true,
                segmentShowStroke: false,
                cutoutPercentage: 70,
                elements: {
                    arc: {
                        borderWidth: 0
                    }
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
            var transactionhistoryChartPlugins = {
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = 1;
                    ctx.font = fontSize + "rem sans-serif";
                    ctx.textAlign = 'left';
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#ffffff";

                    var text = "<?php echo mysqli_num_rows($query) + mysqli_num_rows($query_sec); ?>",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2.4;

                    ctx.fillText(text, textX, textY);

                    ctx.restore();
                    var fontSize = 0.75;
                    ctx.font = fontSize + "rem sans-serif";
                    ctx.textAlign = 'left';
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#6c7293";

                    var texts = "Total students",
                        textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
                        textsY = height / 1.7;

                    ctx.fillText(texts, textsX, textsY);
                    ctx.save();
                }
            }
            var transactionhistoryChartCanvas = $("#transaction-history").get(0).getContext("2d");
            var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
                type: 'doughnut',
                data: areaData,
                options: areaOptions,
                plugins: transactionhistoryChartPlugins
            });
        }
        if ($("#transaction-history-arabic").length) {
            var areaData = {
                labels: ["Paypal", "Stripe", "Cash"],
                datasets: [{
                    data: [55, 25, 20],
                    backgroundColor: [
                        "#111111", "#00d25b", "#ffab00"
                    ]
                }]
            };
            var areaOptions = {
                responsive: true,
                maintainAspectRatio: true,
                segmentShowStroke: false,
                cutoutPercentage: 70,
                elements: {
                    arc: {
                        borderWidth: 0
                    }
                },
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: true
                }
            }
            var transactionhistoryChartPlugins = {
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = 1;
                    ctx.font = fontSize + "rem sans-serif";
                    ctx.textAlign = 'left';
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#ffffff";

                    var text = "$1200",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2.4;

                    ctx.fillText(text, textX, textY);

                    ctx.restore();
                    var fontSize = 0.75;
                    ctx.font = fontSize + "rem sans-serif";
                    ctx.textAlign = 'left';
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = "#6c7293";

                    var texts = "مجموع",
                        textsX = Math.round((width - ctx.measureText(text).width) / 1.93),
                        textsY = height / 1.7;

                    ctx.fillText(texts, textsX, textsY);
                    ctx.save();
                }
            }
            var transactionhistoryChartCanvas = $("#transaction-history-arabic").get(0).getContext("2d");
            var transactionhistoryChart = new Chart(transactionhistoryChartCanvas, {
                type: 'doughnut',
                data: areaData,
                options: areaOptions,
                plugins: transactionhistoryChartPlugins
            });
        }
        if ($('#owl-carousel-basic').length) {
            $('#owl-carousel-basic').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                autoplay: true,
                autoplayTimeout: 4500,
                navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        }
        var isrtl = $("body").hasClass("rtl");
        if ($('#owl-carousel-rtl').length) {
            $('#owl-carousel-rtl').owlCarousel({
                loop: true,
                margin: 10,
                dots: false,
                nav: true,
                rtl: isrtl,
                autoplay: true,
                autoplayTimeout: 4500,
                navText: ["<i class='mdi mdi-chevron-right'></i>", "<i class='mdi mdi-chevron-left'></i>"],
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });
        }
    });
})(jQuery);


    </script>
    <!-- End custom js for this page -->
  </body>
</html>



