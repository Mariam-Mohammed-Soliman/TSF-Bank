<?php
include 'header.php';


    $stmt =$con->prepare("SELECT * FROM transfers ORDER BY processID");
    //Execute the statment
    $stmt->execute();
    //Assign to variable
    $transfers = $stmt->fetchAll();
    ?>

    <div class="history container">
    <div class="h2 text-capitalize text-center my-5">
                    history
                </div>
        <table class="table text-center">
            <thead class="table-dark">
                <tr class="table-dark text-capitalize">
                    <td>process no.</td>
                    <td>sender</td>
                    <td>amount</td>
                    <td>reciever</td>
                    <td>date&Time</td>                    
                </tr>
            </thead>
            <tbody>
                <?php
foreach($transfers as $transfer)
{
    $stmt2 =$con->prepare("SELECT userName FROM users WHERE userID=".$transfer['reciverID']."");
    //Execute the statment
    $stmt2->execute();
    //Assign to variable
    $receivers = $stmt2->fetch();

    $stmt3 =$con->prepare("SELECT userName FROM users WHERE userID=".$transfer['senderID']."");
    //Execute the statment
    $stmt3->execute();
    //Assign to variable
    $senders= $stmt3->fetch();
    echo '<tr>';
    echo '<td>'.$transfer['processID'].'</td>';
    echo '<td class=" text-capitalize">'.$senders['userName'].'</td>';
    echo '<td>'.$transfer['amount'].'</td>';
    echo '<td class=" text-capitalize">'.$receivers['userName'].'</td>';
    echo '<td>'.$transfer['processDate'].'</td>';
    echo '</tr>';
}
?>

            </tbody>
        </table>

    </div>

    <?php
include 'footer.php';
?>