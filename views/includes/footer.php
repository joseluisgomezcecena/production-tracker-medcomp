<!-- Footer -->
<footer class="mt-auto">
    <div class="footer">
        <span class='uppercase'>&copy; 2022 Yeti Themes</span>
        <nav>
            <a href="mailto:Yeti Themes<info@yetithemes.net>?subject=Support">Support</a>
            <span class="divider">|</span>
            <a href="http://yeti.yetithemes.net/docs" target="_blank">Docs</a>
        </nav>
    </div>
</footer>

</main>

<!-- Scripts -->
<script src="./views/assets/js/vendor.js"></script>
<script src="./views/assets/js/script.js"></script>
<script src="./views/assets/js/jquery.js"></script>
<script src="./views/assets/js/chart.min.js"></script>


<!-- Datatables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>


<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>




<script>

    (function refreshContent() {
        $.ajax({
            url: 'index.php',
            success: function(data) {
                $("#refresh").load(location.href+" #refresh>*","");
            },
            complete: function() {
                setTimeout(refreshContent, 5000);
            }
        });
    })();

</script>

<?php
//getting data
$year = date("Y");
$query = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-03-01' AND '$year-03-30')  AND site_id=1;";
$run = mysqli_query($connection, $query);
$row = mysqli_fetch_array($run);

?>



<script>
    var ctx = document.getElementById("productionChart").getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Jan",	"Feb",	"Mar",	"Apr",	"May",	"Jun",	"Jul","Aug",	"Sep","Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Side A', // Name the series
                data: [0,	0,	<?php echo $row[0] ?>,	0,	0,	0,	0,	0,	0, 0], // Specify the data values array
                fill: true,
                borderColor: '#2196f3', // Add custom color border (Line)
                backgroundColor: 'rgba(33,150,243,0.78)', // Add custom color background (Points and Fill)
                borderWidth: 1 // Specify bar border width
            },
                {
                    label: 'Side B', // Name the series
                    data: [0,	0,	0,	0,	0,	0,	0,	0,	0, 0], // Specify the data values array
                    fill: true,
                    borderColor: '#ca2950', // Add custom color border (Line)
                    backgroundColor: 'rgba(202,41,80,0.63)', // Add custom color background (Points and Fill)
                    borderWidth: 1 // Specify bar border width
                }]
        },
        options: {
            responsive: true, // Instruct chart js to respond nicely.
            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
        }
    });

</script>

</body>

</html>
