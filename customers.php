<?php
include 'header.php';
session_start();

/**/

    $stmt =$con->prepare("SELECT * FROM users ORDER BY userID");
    //Execute the statment
    $stmt->execute();
    //Assign to variable
    $users = $stmt->fetchAll();
    if(isset($_SESSION['status']))  
        {
            if($_SESSION['status']=="done!"){
                ?>
                <div class="offcanvas offcanvas-top show alertCanvas" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasLabel"><i class="fa-solid fa-circle-check alertApperTrue"></i></h5>
                    <button type="button" class="btn-close alertClose" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body alertTextSuccess">
                    successfully!
                </div>
                </div>
                <?php
                unset($_SESSION['status']);
            }
        }
    ?>

    <div class="container">
    <div class="h2 text-capitalize text-center my-5">
                    customers
                </div>
        <table class="table text-center">
            <thead class="table-dark">
                <tr class="table-dark text-capitalize">
                    <td>#ID</td>
                    <td>name</td>
                    <td>email</td>
                    <td>palance</td>
                    <td>control</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
foreach($users as $user)
{
    echo '<tr>';
    echo '<td>'.$user['userID'].'</td>';
    echo '<td class=" text-capitalize">'.$user['userName'].'</td>';
    echo '<td>'.$user['userEmail'].'</td>';
    echo '<td>'.$user['currentPalance'].'</td>';
    echo '<td>
            <a href="transfer.php?userId='.$user['userID'].'" class="btn btn-success  text-capitalize">tranform</a>
        </td>';
    echo '</tr>';
}
?>

            </tbody>
        </table>

    </div>

    <?php
include 'footer.php';
?>