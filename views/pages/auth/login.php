<?php
include_once ("views/includes/auth-header.php");
?>

<div class="container flex items-center justify-center mt-20 py-10">

    <?php
    // show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            foreach ($login->errors as $error) {

                echo "
                <script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: '$error',
                    })
                </script>
                ";

            }
        }
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo "
                <script>
                    Swal.fire({
                      title: 'Message',
                      text: '$message',
                      icon: 'success',
                    })
                </script>
                ";
            }
        }
    }
    ?>

    <div class="w-full md:w-1/2 xl:w-1/3">
        <div class="mx-5 md:mx-10">
            <h2 class="uppercase">It’s Great To See You!</h2>
            <h4 class="uppercase">Login Here</h4>
        </div>
        <form method="post" class="card mt-5 p-5 md:p-10">
            <div class="mb-5">
                <label class="label block mb-2" for="email">Email</label>
                <input id="email" type="text" name="user_name" class="form-control" placeholder="example@example.com">
            </div>
            <div class="mb-5">
                <label class="label block mb-2" for="password">Password</label>
                <label class="form-control-addon-within">
                    <input id="password" type="password" name="user_password" class="form-control border-none" value="password">

                    <span class="flex items-center ltr:pr-4 rtl:pl-4">
                            <button type="button"
                                    class="btn btn-link text-gray-300 dark:text-gray-700 la la-eye text-xl leading-none"
                                    data-toggle="password-visibility"></button>
                    </span>
                </label>
            </div>
            <div class="flex items-center">
                <a href="auth-forgot-password.html" class="text-sm uppercase">Forgot Password?</a>
                <button type="submit" name="login" class="btn btn_primary ltr:ml-auto rtl:mr-auto uppercase">Login</button>
            </div>
        </form>
    </div>
</div>

<?php include_once ("views/includes/auth-footer.php");?>
