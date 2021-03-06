<?php
include_once ("views/includes/header.php");
require_once ("functions/mail.php");
?>
<?php sendEmail(); ?>
<main class="workspace overflow-hidden">

    <!-- Breadcrumb -->
    <section class="breadcrumb">
        <h1>Dashboard</h1>
        <ul>
            <li><a href="#">Home</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Dashboard</li>
        </ul>
    </section>

    <div class="grid lg:grid-cols-2 gap-5">

        <!-- Summaries -->
        <div id="refresh" class="grid sm:grid-cols-3 gap-5">
            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none la la-lightbulb-o"></span>
                    <p class="mt-2">Andon events</p>
                    <div class="text-primary mt-5 text-3xl leading-none">
                        <?php
                        $query = "SELECT COUNT(*) FROM andon_events";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_array($result);
                        echo $row['0'];
                        ?>
                    </div>
                </div>
            </div>

            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none la la-project-diagram"></span>
                    <p class="mt-2">Duralock Side A</p>
                    <div  class="text-primary mt-5 text-3xl leading-none">
                        <?php
                        $today = date("Y-m-d");
                        $query_a = "SELECT SUM(count) FROM item_counter 
                        WHERE 
                        site_id= 1037 
                        AND date_create BETWEEN '$today 00:00:00' AND '$today 23:59:59'; ";

                        $result_a = mysqli_query($connection, $query_a);

                        $row_a = mysqli_fetch_array($result_a);

                        $side_a = $row_a[0];
                        if($side_a == NULL)
                        {
                            $side_a = "0";
                        }

                        echo $side_a;


                        ?>
                    </div>
                </div>
            </div>

            <div
                class="card px-4 py-8 flex justify-center items-center text-center lg:transform hover:scale-110 hover:shadow-lg transition-transform duration-200">
                <div>
                    <span class="text-primary text-5xl leading-none la la-project-diagram"></span>
                    <p class="mt-2">Duralock Side B</p>
                    <div class="text-primary mt-5 text-3xl leading-none">
                        <?php
                        $today = date("Y-m-d");
                        $query_b = "SELECT SUM(count) FROM item_counter 
                        WHERE 
                        site_id= 1038 
                        AND date_create BETWEEN '$today 00:00:00' AND '$today 23:59:59'; ";

                        $result_b = mysqli_query($connection, $query_b);

                        $row_b = mysqli_fetch_array($result_b);

                        $side_b = $row_b[0];
                        if($side_b == NULL)
                        {
                            $side_b = "0";
                        }

                        echo $side_b;


                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lines
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            <div class="card p-5">
                <h6 class="chart-heading uppercase"></h6>
                <h4 class="chart-value text-2xl mt-2"></h4>
                <small class="chart-label uppercase"></small>
                <canvas id="lineWithAnnotationChart1" class="mt-5"></canvas>
            </div>
            <div class="card p-5">
                <h6 class="chart-heading uppercase"></h6>
                <h4 class="chart-value text-2xl mt-2"></h4>
                <small class="chart-label uppercase"></small>
                <canvas id="lineWithAnnotationChart2" class="mt-5"></canvas>
            </div>
            <div class="card p-5">
                <h6 class="chart-heading uppercase"></h6>
                <h4 class="chart-value text-2xl mt-2"></h4>
                <small class="chart-label uppercase"></small>
                <canvas id="lineWithAnnotationChart3" class="mt-5"></canvas>
            </div>
            <div class="card p-5">
                <h6 class="chart-heading uppercase"></h6>
                <h4 class="chart-value text-2xl mt-2"></h4>
                <small class="chart-label uppercase"></small>
                <canvas id="lineWithAnnotationChart4" class="mt-5"></canvas>
            </div>
        </div>
        -->

        <!-- Visitors -->
        <div class="card p-5 min-w-0">
            <h3>Monthly Production</h3>
            <div class="mt-5 min-w-0">
                <canvas id="productionChart"></canvas>
            </div>
        </div>

        <!-- Recent Posts -->
        <div class="card p-5 flex flex-col">
            <h3>Current Events</h3>
            <table class="table table_list mt-3 w-full">
                <thead>
                <tr>
                    <th style="width: 30%" class="ltr:text-left rtl:text-right uppercase">Event</th>
                    <th style="width: 30%" class="w-px uppercase">Location</th>
                    <th style="width: 40%" class="w-px uppercase">Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $get_andon = "SELECT * FROM andon_events";
                $run_get_andon = mysqli_query($connection, $get_andon);
                if(mysqli_num_rows($run_get_andon) == 0):
                ?>
                <tr>
                    <td></td>
                    <td>No Andon Events.</td>
                    <td></td>
                </tr>
                <?php
                endif;
                while ($row_andon = mysqli_fetch_array($run_get_andon)):
                ?>
                <tr>
                    <td><?php echo $row_andon['error_category_nombre']; ?></td>
                    <td class="text-center"><?php echo $row_andon['departamento_nombre'] ?> | <?php echo $row_andon['maquina_nombre'] ?></td>
                    <td class="text-center">
                        <div class="badge badge_outlined badge_secondary uppercase">
                            <?php
                            if($row_andon['inprocess_flag'] == 0 && $row_andon['soved_flag'] == 0)
                            {
                                echo "Pending Attention";
                            }
                            elseif ($row_andon['inprocess_flag'] == 1 && $row_andon['soved_flag'] == 0)
                            {
                                echo "Pending Solution";
                            }
                            else
                            {
                                echo "Pending";
                            }
                            ?>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>

                </tbody>
            </table>
            <div class="mt-auto">
                <a href="#" target="_blank" class="btn btn_primary mt-5">Go to Andon</a>
            </div>
        </div>

        <!-- Categories
        <div class="card p-5 flex flex-col min-w-0">
            <h3>Categories</h3>
            <div class="flex-auto mt-5 min-w-0">
                <canvas id="categoriesChart"></canvas>
            </div>
        </div>
-->
        <!-- Quick Post -->
        <div class="card p-5">
            <h3>Contact Support</h3>
            <div class="mt-5">
                <p>This message will be delivered to MMW Software development and Automation personnel. </p>
                <form method="post">
                    <div class="mb-5">
                        <label class="label block mb-2" for="title">Title</label>
                        <input id="title" name="title" type="text" class="form-control">
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="content">Content</label>
                        <textarea id="content" name="content" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="mb-5">
                        <label class="label block mb-2" for="category">Category</label>
                        <div class="custom-select">
                            <select class="form-control" name="category">
                                <option>Select</option>
                                <option>Software Issue</option>
                                <option>Hardware Issue</option>
                                <option>Unknown Issue</option>
                            </select>
                            <div class="custom-select-icon la la-caret-down"></div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button type="submit" name="send_message" class="btn btn_primary uppercase">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<?php include_once ("views/includes/footer.php"); ?>



    <?php
    //getting data
    $year = date("Y");

    $jan_end = cal_days_in_month(CAL_GREGORIAN,1,$year);
    $feb_end = cal_days_in_month(CAL_GREGORIAN,2,$year);
    $march_end = cal_days_in_month(CAL_GREGORIAN,3,$year);
    $apr_end = cal_days_in_month(CAL_GREGORIAN,4,$year);
    $may_end = cal_days_in_month(CAL_GREGORIAN,5,$year);
    $jun_end = cal_days_in_month(CAL_GREGORIAN,6,$year);
    $jul_end = cal_days_in_month(CAL_GREGORIAN,7,$year);
    $aug_end = cal_days_in_month(CAL_GREGORIAN,8,$year);
    $sept_end = cal_days_in_month(CAL_GREGORIAN,9,$year);
    $oct_end = cal_days_in_month(CAL_GREGORIAN,10,$year);
    $nov_end = cal_days_in_month(CAL_GREGORIAN,11,$year);
    $dec_end = cal_days_in_month(CAL_GREGORIAN,12,$year);

    $query_mar = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-01-01' AND '$year-01-$jan_end')  AND site_id=1037;";
    $run_mar = mysqli_query($connection, $query_mar);
    $row_mar = mysqli_fetch_array($run_mar);

    $query_mar = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-02-01' AND '$year-02-$feb_end')  AND site_id=1037;";
    $run_mar = mysqli_query($connection, $query_mar);
    $row_mar = mysqli_fetch_array($run_mar);

    $query_mar = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-03-01' AND '$year-03-$march_end')  AND site_id=1037;";
    $run_mar = mysqli_query($connection, $query_mar);
    $row_mar = mysqli_fetch_array($run_mar);

    $query_apr = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-04-01' AND '$year-04-$apr_end')  AND site_id=1037;";
    $run_apr = mysqli_query($connection, $query_apr);
    $row_apr = mysqli_fetch_array($run_apr);

    $query_may = "SELECT SUM(count), date_create, site_id FROM `item_counter` WHERE (date_create BETWEEN '$year-05-01' AND '$year-05-30')  AND site_id=1037;";
    $run_may = mysqli_query($connection, $query_may);
    $row_may = mysqli_fetch_array($run_may);


    ?>



    <script>
        var ctx = document.getElementById("productionChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Jan",	"Feb",	"Mar",	"Apr",	"May",	"Jun",	"Jul","Aug",	"Sep","Oct", "Nov", "Dec"],
                datasets: [{
                    label: 'Side A', // Name the series
                    data: [0,	0,	<?php echo $row_mar[0] ?>,	<?php echo $row_apr[0] ?>,	<?php echo $row_may[0] ?>,	0,	0,	0,	0, 0], // Specify the data values array
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
