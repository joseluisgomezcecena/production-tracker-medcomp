<!-- Footer -->
<footer class="mt-auto">
    <div class="footer">
        <span class='uppercase'><?php echo date("Y") ?> Continuous improvement Software.</span>
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

    $(document).ready(function() {
        $('#site-a').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );

    $(document).ready(function() {
        $('#site-b').DataTable( {
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


</body>

</html>
