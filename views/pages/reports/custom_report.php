<?php include_once ("views/includes/header.php"); ?>
<?php lineConfig(); ?>
<!-- Workspace -->
<main class="workspace overflow-hidden">


    <!-- Breadcrumb -->
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Daily Report</h1>
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
                    <th class="text-center uppercase">Desired Output</th>
                    <th class="text-center uppercase">% Completed</th>
                </tr>
                </thead>


                <tbody>

                <?php

                $today = date("Y-m-d");

                if(isset($_POST['search']))
                {
                    $date_to_search = $_POST['date'];

                    $query = "SELECT SUM(count) AS done, site_id, date_create, nombre, martech_departamentos.id, 
                    martech_departamentos.desired_output FROM item_counter 
                    LEFT JOIN martech_departamentos ON item_counter.site_id = martech_departamentos.id 
                    WHERE date_create BETWEEN '$date_to_search 00:00:00' AND '$date_to_search 23:59:59' GROUP BY martech_departamentos.id";
                }
                else
                {
                    $query = "SELECT SUM(count) AS done, site_id, date_create, nombre, martech_departamentos.id, 
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
                            <td class="text-center"><?php echo round(($row['done'] / $row['desired_output']) * 100)  ?>%</td>
                        </form>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">
        <!-- Pagination
        <div class="card lg:flex">
            <nav class="flex flex-wrap gap-2 p-5">
                <a href="#" class="btn btn_primary">First</a>
                <a href="#" class="btn btn_primary">1</a>
                <a href="#" class="btn btn_outlined btn_secondary">2</a>
                <a href="#" class="btn btn_outlined btn_secondary">3</a>
                <a href="#" class="btn btn_outlined btn_secondary">4</a>
                <a href="#" class="btn btn_outlined btn_secondary">5</a>
                <a href="#" class="btn btn_secondary">Last</a>
            </nav>
            <div class="flex items-center ltr:ml-auto rtl:mr-auto p-5 border-t lg:border-t-0 border-divider">
                Displaying 1-5 of 100 items
            </div>
            <div class="flex items-center gap-2 p-5 border-t lg:border-t-0 lg:ltr:border-l lg:rtl:border-r border-divider">
                <span>Show</span>
                <div class="dropdown">
                    <button class="btn btn_outlined btn_secondary" data-toggle="dropdown-menu">
                        5
                        <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#">5</a>
                        <a href="#">10</a>
                        <a href="#">15</a>
                    </div>
                </div>
                <span>items</span>
            </div>
        </div>
    </div>
    -->

        <!-- Footer Bar -->
        <div class="footer-bar">
            <div class="flex items-center uppercase">
                <span class="badge badge_primary ltr:mr-2 rtl:ml-2">!</span>
                Changes should be saved row by row, desired outputs are by hour.
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
