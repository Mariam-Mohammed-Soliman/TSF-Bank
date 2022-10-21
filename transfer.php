<?php
include 'header.php';
session_start();

$do=isset($_GET['do']) ? $_GET['do'] :'manage';
    //If the page is main page
if($do =='manage'){
    $userId=isset($_GET["userId"])&& is_numeric($_GET["userId"]) ? intval($_GET["userId"]):0;

    $stmt=$con->prepare("SELECT * FROM  users WHERE userID=? LIMIT 1");

            //excute the data
            $stmt->execute(array($userId));
            $userInfo =$stmt->fetch();//get data from database in array row
            $count=$stmt->rowCount();

            if(isset($_SESSION['status']))  
        {
            if($_SESSION['status']=="error!"){
                ?>
                <div class="offcanvas offcanvas-top show alertCanvas" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasLabel"><i class="fa-solid fa-circle-xmark alertApper"></i></h5>
                    <button type="button" class="btn-close alertClose" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body alertText">
                    select customer!
                </div>
                </div>
                <?php
                unset($_SESSION['status']);
            }
        }
            //if count >0 user id is founded
            if($count>0)
            {
    ?>
    <section id="transfer">
        <div class="info">
            <div class="container">

                <div class="h2 text-capitalize text-center my-5">
                    client info
                </div>
                <table class="table text-center">
                    <thead class="table-dark">
                        <tr class="table-dark">
                            <td>#ID</td>
                            <td>name</td>
                            <td>email</td>
                            <td>palance</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $userInfo['userID']; ?></td>
                            <td><?php echo $userInfo['userName']; ?></td>
                            <td><?php echo $userInfo['userEmail']; ?></td>
                            <td><?php echo $userInfo['currentPalance']; ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        

        <hr class="m-5">

        <div class="operation">

            <div class="container">
            <form class="form card border-light mt-3" action="?do=insert&userId=<?php echo $userId;?>" method="POST" id = "transformation">
                <div class="h2 text-capitalize text-center my-5">
                    transformation
                </div>

                <div class="card-body py-1 mx-5 text-capitalize">

                    <div class="input-group mb-3">
                        <label class="col-sm-2 form-label py-1 ps-5 fs-5">transfer to :</label>
                        <div class="col-sm-10">
                            <select name="userNum"  class="form-control form-select" id = "selectLab">
                                <option value="0" hidden>Select customer</option>
                                
                                <?php
                                    $stmt2=$con->prepare("SELECT * FROM users");
                                    $stmt2->execute();
                                    $users=$stmt2->fetchAll();
                                    foreach($users as $user){
                                        echo '<option value="'.$user['userID'].'">'.$user['userName'].' (with   '.$user['currentPalance'].'$)</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Start amount Field -->
                <div class="form-group form-group-lg row pb-3">
                    <label class="col-sm-2 control-label py-1 ps-5 fs-5">amount</label>
                    <div class="col-sm-10">
                        <input type="text" name="amount"  class="form-control"  autocomplete="off"  placeholder="amount" required>
                    </div>
                </div>
                <!-- End amount Field-->
                
                    <!-- Start transfer data btn -->
                <div class="form-group form-group-lg pb-3 row">
                    <div class="col-md-12 offset-sm-5">
                        <input type="submit" value="transfer" class="btn">
                    </div>
                </div>
                <!-- End transfer Data -->

                </div>
            </form>
            </div>

        </div>

    </section>


    <?php
        }
}
elseif($do =='insert'){
    
    if($_SERVER['REQUEST_METHOD']=='POST')
            {
                //get data from the form
                $sender=isset($_GET["userId"])&& is_numeric($_GET["userId"]) ? intval($_GET["userId"]):0;

                $reciever        =intval($_POST['userNum']);
                $amount          =intval($_POST['amount']);

                //echo gettype($reciever)."<br>idSender=".$sender." <br>amount=".$amount." <br>recieverId=".$reciever;
                if($reciever>0){
                    /*for sender new palance*/
                    $stmt2=$con->prepare("SELECT * FROM users WHERE userID=? LIMIT 1");
                    $stmt2->execute(array($sender));
                    $userSender = $stmt2->fetch();

                    $newSenderPalance=$userSender['currentPalance']-$amount;


                    /*for reciever new palance*/
                    $stmt3=$con->prepare("SELECT * FROM users WHERE userID=? LIMIT 1");
                    $stmt3->execute(array($reciever));
                    $userReciever = $stmt3->fetch();

                    $newRecieverPalance=$userReciever['currentPalance']+$amount;


                    //update new palance for reciever
                    $stmt4=$con->prepare("UPDATE  users SET currentPalance=? WHERE userID=?");
                    $stmt4->execute(array($newRecieverPalance,$reciever));

                    //update new palance for sender
                    $stmt5=$con->prepare("UPDATE  users SET currentPalance=? WHERE userID=?");
                    $stmt5->execute(array($newSenderPalance,$sender));

                    //update new palance for sender
                    $stmt6=$con->prepare("INSERT INTO  transfers(amount,senderID,reciverID,processDate)
                    VALUES($amount,$sender,$reciever,now())");
                    $stmt6->execute();


                    $_SESSION['status']="done!";
                    header('Location:customers.php');
                    
                }else{
                    $_SESSION['status']="error!";
                    header('Location:transfer.php?do=manage&userId='.$sender.'');
                }
                
            
        }
}
include 'footer.php';
?>