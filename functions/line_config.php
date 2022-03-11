<?php

function lineConfig()
{
    global $connection;

    if(isset($_POST['save_line_config']))
    {
        $id = $_POST['id'];
        $desired_output = $_POST['desired_output'];
        $current = $_POST['current'];

        if($desired_output != $current)
        {
            $query = "UPDATE martech_departamentos SET desired_output = $desired_output WHERE id = $id";
            $result = mysqli_query($connection, $query);
            if(!$result)
            {
                //echo "Error" . $query . "<br>" . mysqli_error($connection);
                echo "
            <script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'There was an error saving your changes.',
                    })
            </script>
            ";
            }
            else
            {
                echo "
            <script>
                    Swal.fire({
                      title: 'Message',
                      text: 'Your changes were saved successfully.',
                      icon: 'success',
                    })
            </script>
            ";
            }
        }
        else
        {
            echo "
            <script>
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'New desired output must be different from the value.',
                    })
            </script>
            ";
        }
    }
}


