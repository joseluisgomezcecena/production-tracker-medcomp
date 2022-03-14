<?php include_once ("views/includes/header.php"); ?>
<?php lineConfig(); ?>
<!-- Workspace -->
<main class="workspace overflow-hidden">

    <!-- Breadcrumb -->
    <section class="breadcrumb lg:flex items-start">
        <div>
            <h1>Line List</h1>
            <ul>
                <li><a href="#">Production Config</a></li>
                <li class="divider la la-arrow-right"></li>
                <li><a href="#">Lines and Cells</a></li>
                <li class="divider la la-arrow-right"></li>
                <li>List</li>
            </ul>
        </div>

        <div class="flex flex-wrap gap-2 items-center ltr:ml-auto rtl:mr-auto mt-5 lg:mt-0">

            <!-- Layout
            <div class="flex gap-x-2">
                <a href="#" class="btn btn-icon btn-icon_large btn_outlined btn_primary">
                    <span class="la la-bars"></span>
                </a>
                <a href="blog-list-card-rows.html" class="btn btn-icon btn-icon_large btn_outlined btn_secondary">
                    <span class="la la-list"></span>
                </a>
                <a href="blog-list-card-columns.html"
                   class="btn btn-icon btn-icon_large btn_outlined btn_secondary">
                    <span class="la la-th-large"></span>
                </a>
            </div>
            -->
            <!-- Search
            <form class="flex flex-auto items-center" action="#">
                <label class="form-control-addon-within rounded-full">
                    <input type="text" class="form-control border-none" placeholder="Search">
                    <button type="button"
                            class="btn btn-link text-gray-300 dark:text-gray-700 dark:hover:text-primary text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                </label>
            </form>
            -->
            <div class="flex gap-x-2">

                <!-- Sort By -->
                <div class="dropdown">
                    <button class="btn btn_outlined btn_secondary uppercase" data-toggle="dropdown-menu">
                        Sort By
                        <span class="ltr:ml-3 rtl:mr-3 la la-caret-down text-xl leading-none"></span>
                    </button>
                    <div class="dropdown-menu">
                        <a href="#">Ascending</a>
                        <a href="#">Descending</a>
                    </div>
                </div>

                <!-- Add New
                <button class="btn btn_primary uppercase">Add New</button>
                -->
            </div>
        </div>
    </section>

    <!-- List -->
    <div class="card p-5">
        <div class="overflow-x-auto">
            <table class="table table-auto table_hoverable w-full">
                <thead>
                <tr>
                    <th class="ltr:text-left rtl:text-right uppercase">Line or Cell</th>
                    <th class="text-center uppercase">Machines</th>
                    <th class="text-center uppercase">Desired Output</th>
                    <th class="uppercase"></th>
                </tr>
                </thead>


                <tbody>

                <?php
                $query = "SELECT departamento_id, martech_departamentos.nombre, martech_departamentos.id, martech_departamentos.desired_output,COUNT(*) as number 
                FROM `martech_maquinas` 
                LEFT JOIN martech_departamentos ON martech_maquinas.departamento_id = martech_departamentos.id 
                GROUP BY departamento_id;";

                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($result)):
                ?>

                <tr>
                    <form method="post">
                    <td><?php echo $row['nombre'] ?></td>
                    <td class="text-center"><?php echo $row['number'] ?></td>
                    <td class="text-center">
                        <input style="width: 100px;" type="number" name="desired_output" value="<?php echo $row['desired_output'] ?>" class="form-control">
                    </td>

                    <td class="ltr:text-right rtl:text-left whitespace-nowrap">
                        <div class="inline-flex ltr:ml-auto rtl:mr-auto">
                            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                            <input type="hidden" name="current" value="<?php echo $row['desired_output'] ?>">
                            <button type="submit" name="save_line_config" class="btn btn_primary uppercase">Save Changes.</button>
                        </div>
                    </td>
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
