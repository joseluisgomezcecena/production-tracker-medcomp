<?php include_once ("views/includes/header.php"); ?>
<?php lineConfig(); ?>
<!-- Workspace -->
<main class="workspace overflow-hidden">


    <!-- Breadcrumb -->
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Daily Reports</h1>
            <ul>
                <li><a href="#">Reports</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>Daily Report</li>
            </ul>
        </div>

        <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">

            <!-- Layout -->


            <!-- Search -->
            <form method="post" class="flex flex-auto items-center" >
                <label class="form-control-addon-within rounded-full">
                    <input type="date" name="date" class="form-control border-none" placeholder="Search">
                    <!--
                    <button type="button"
                            class="btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4">
                    </button>
                    -->
                </label>


            <div class="flex gap-x-2">



                <!-- Add New -->
                <button type="submit" name="search" class="btn btn_primary uppercase">Search</button>
            </div>
            </form>
        </div>

    </section>

    <!-- List -->
    <div class="card p-5">
        <div class="overflow-x-auto">
            <table id="example" class="table table-auto table_hoverable w-full">
                <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">Line or Cell</th>
                    <th class="text-center uppercase">Output</th>
                    <th class="text-center uppercase">Desired Output (Hourly)</th>
                    <th class="text-center uppercase">Desired Output (Overall)</th>
                    <th class="text-center uppercase">% Completed</th>
                </tr>
                </thead>


                <tbody>

                <?php

                $today = date("Y-m-d");

                $desired_a = 0;
                $desired_b = 0;

                if(isset($_POST['search']))
                {
                    $date_to_search = $_POST['date'];

                    $query = "SELECT SUM(count) AS done, COUNT(site_id) AS cuenta, site_id, date_create, nombre, martech_departamentos.id, 
                    martech_departamentos.desired_output FROM item_counter 
                    LEFT JOIN martech_departamentos ON item_counter.site_id = martech_departamentos.id 
                    WHERE date_create BETWEEN '$date_to_search 00:00:00' AND '$date_to_search 23:59:59' GROUP BY martech_departamentos.id";
                }
                else
                {
                    $query = "SELECT SUM(count) AS done, COUNT(site_id) AS cuenta, site_id, date_create, nombre, martech_departamentos.id, 
                    martech_departamentos.desired_output FROM item_counter 
                    LEFT JOIN martech_departamentos ON item_counter.site_id = martech_departamentos.id 
                    WHERE date_create BETWEEN '$today 00:00:00' AND '$today 23:59:59' GROUP BY martech_departamentos.id";
                }


                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($result)):



                    ?>

                    <tr>
                        <form method="post">
                            <td><?php echo $row['nombre'] ?></td>
                            <td class="text-center"><?php echo $row['done'] ?></td>
                            <td class="text-center"><?php echo $row['desired_output'] ?></td>
                            <td class="text-center"><?php echo $total_desired =  $row['cuenta'] * $row['desired_output'] ?></td>
                            <td class="text-center"><?php echo round(($row['done'] / $total_desired) * 100 , 1)  ?>%</td>
                        </form>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>

    <div  class="grid sm:grid-cols-2 gap-5 mt-5">
        <div class="card p-5">
            <div class="overflow-x-auto">
                <table id="site-a" class="table table-auto table_hoverable w-full">
                    <thead>
                    <tr>
                        <th class="text-center uppercase">Time Block</th>
                        <th class="ltr:text-left rtl:text-right uppercase">Line or Cell</th>
                        <th class="text-center uppercase">Output</th>
                        <th class="text-center uppercase">% Completed</th>
                    </tr>
                    </thead>


                    <tbody>

                            <?php
                            $countoverall = 0;
                            $desitedoverall = 0;
                            if(isset($_POST['search']))
                            {
                                $date_to_search = $_POST['date'];

                                $query = "SELECT * FROM item_counter 
                                LEFT JOIN martech_departamentos ON martech_departamentos.id = item_counter.site_id 
                                WHERE item_counter.date_create 
                                BETWEEN '$date_to_search 00:00:00' AND '$date_to_search 23:59:59' 
                                AND site_id = 1037 
                                GROUP BY time_slot ORDER BY time_slot";


                            }
                            else
                            {

                                $query = "SELECT * FROM item_counter 
                                LEFT JOIN martech_departamentos ON martech_departamentos.id = item_counter.site_id 
                                WHERE item_counter.date_create BETWEEN '$today 00:00:00' AND '$today 23:59:59' 
                                GROUP BY time_slot ORDER BY time_slot";

                            }
                                $run = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_array($run)):
                                $countoverall += $row['count'];
                                $desitedoverall += $row['desired_output'];
                                ?>

                            <tr>
                                <td class="text-center"><?php echo $row['time_slot'] ?>:00 - <?php echo $row['time_slot']+1 ?>:00</td>
                                <td class="text-center"><?php echo $row['nombre'] ?></td>
                                <td class="text-center"><?php echo $row['count']  ?> / <?php echo $row['desired_output']  ?> </td>
                                <td class="text-center">
                                    <?php
                                    if($row['desired_output'] != "0")
                                    {
                                        echo round(($row['count']/$row['desired_output']) * 100, 1);
                                    }
                                    else
                                    {
                                        echo "0";
                                    }
                                    ?>%
                                </td>
                            </tr>

                            <?php endwhile; ?>
                            <tr>
                                <td class="text-center">Overall</td>
                                <td class="text-center">Site A</td>
                                <td class="text-center"><?php echo $countoverall ?> / <?php echo $desitedoverall ?> </td>
                                <td class="text-center">
                                    <?php
                                    if($desitedoverall > 0)
                                    {
                                        echo  round(($countoverall/$desitedoverall) * 100, 1);
                                    }
                                    else
                                    {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>


            </div>
        </div>





        <div class="card p-5">
            <div class="overflow-x-auto">
                <table id="site-b" class="table table-auto table_hoverable w-full">
                    <thead>
                    <tr>
                        <th class="text-center uppercase">Time Block</th>
                        <th class="ltr:text-left rtl:text-right uppercase">Line or Cell</th>
                        <th class="text-center uppercase">Output</th>
                        <th class="text-center uppercase">% Completed</th>
                    </tr>
                    </thead>


                    <tbody>

                    <?php
                    $countoverallb = 0;
                    $desitedoverallb = 0;
                    if(isset($_POST['search']))
                    {
                        $date_to_search = $_POST['date'];

                        $query = "SELECT * FROM item_counter 
                                LEFT JOIN martech_departamentos ON martech_departamentos.id = item_counter.site_id 
                                WHERE item_counter.date_create 
                                BETWEEN '$date_to_search 00:00:00' AND '$date_to_search 23:59:59' 
                                AND site_id = 1038 
                                GROUP BY time_slot ORDER BY time_slot";


                    }
                    else
                    {

                        $query = "SELECT * FROM item_counter 
                                LEFT JOIN martech_departamentos ON martech_departamentos.id = item_counter.site_id 
                                WHERE item_counter.date_create BETWEEN '$today 00:00:00' AND '$today 23:59:59' 
                                GROUP BY time_slot ORDER BY time_slot";

                    }
                    $run = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($run)):
                    $countoverallb += $row['count'];
                    $desitedoverallb += $row['desired_output'];
                    ?>


                        <tr>
                            <td class="text-center"><?php echo $row['time_slot'] ?>:00 - <?php echo $row['time_slot']+1 ?>:00</td>
                            <td class="text-center"><?php echo $row['nombre'] ?></td>
                            <td class="text-center"><?php echo $row['count']  ?> / <?php echo $row['desired_output']  ?> </td>
                            <td class="text-center">
                                <?php
                                if($row['desired_output'] != "0")
                                {
                                    echo round(($row['count']/$row['desired_output']) * 100, 1);
                                }
                                else
                                {
                                    echo "0";
                                }
                                ?>%
                            </td>
                        </tr>

                    <?php endwhile; ?>
                    <tr>
                        <td class="text-center">Overall</td>
                        <td class="text-center">Site B</td>
                        <td class="text-center"><?php echo $countoverallb ?> / <?php echo $desitedoverallb ?> </td>
                        <td class="text-center">
                            <?php
                            if($desitedoverallb > 0)
                            {
                                echo  round(($countoverallb/$desitedoverallb) * 100, 1);
                            }
                            else
                            {
                                echo "0";
                            }
                            ?>
                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>
        </div>




    </div>

    <div class="mt-5">


        <!-- Footer Bar -->
        <div class="footer-bar">
            <div class="flex items-center uppercase">
                <span class="badge badge_primary ltr:mr-2 rtl:ml-2">!</span>
                If no date parameter is set values are set for today.
            </div>
            <!--
            <div class="ltr:ml-auto rtl:mr-auto">
                <button class="btn btn_danger uppercase">
                    <span class="la la-trash-alt text-xl leading-none ltr:mr-2 rtl:ml-2"></span>
                    Remove
                </button>
            </div>
            -->
        </div>

        <?php include_once ("views/includes/footer.php"); ?>

