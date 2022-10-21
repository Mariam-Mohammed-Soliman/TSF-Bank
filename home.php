<?php
include 'header.php';
?>
    
    <section id="home" class="">
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 mt-5 introText">
        <div class="h2 text-uppercase">
            the sparks foundation bank
          </div>
          <div class="h1">
            welcome!
          </div>
          <div class="btn p-3">
            <a href="customers.php">
            <i class="fa-solid fa-angles-right"></i>
            get started
            </a>
          
          </div>

          <div class="btn p-3">
            <a href="history.php">
            <i class="fa-solid fa-angles-right"></i>
            view history
            </a>
          
          </div>
          
        </div>

        <div class="col-md-6">
          <img src="img/bgBank.svg" alt="" srcset="">
        </div>

      </div>
    </div>
    </section>

    <section id="about">
      <div class="container py-5">

      <div class="introText">
        <div class="h2 text-uppercase text-center">
        about us
        </div>
      </div>
        <div class="row">
          <div class="col-md-6 aboutImg">
            <img src="img/E-Wallet-pana.svg" alt="">
          </div>
          <div class="col-md-6 infoText">
            <div class="infoText h4 text-capitalize pt-5 px-2 text-decoration-underline">
              basic bank system:-
            </div>
            <p>
            this basic bank for 10 customers to transfer money without a login page as it required.
            </p>
            <p>
            you can see every transfer from the history page which show sender and receiver customers, the amount that transfers, and the date with the time of the operation.
            </p>
          </div>
        </div>
      </div>
    </section>

<?php
include 'footer.php';
?>