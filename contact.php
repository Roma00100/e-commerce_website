<?php

session_start();

require_once './php_db/db_connect.php';
require_once './php_db/query.php';
require_once './php_db/upload.php';
require_once './php_db/function.php';

?>

<!-- ------------------------------------------------ -->
<!-- ----------------HTML START---------------------- -->
<!-- ------------------------------------------------- -->

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- ---------------------------------------------------------- -->
  <!-- -------------INCLUDES COMMON HEAD . START----------------- -->

  <head>
    <?php include './components/header.html' ?>
  </head>

  <link rel="stylesheet" href="/css/contact.css">
  <!-- -------------INCLUDES COMMON HEAD . END------------------- -->
  <!-- ---------------------------------------------------------- -->

</head>

<body>

  <!-- ----------------------------------------------------------------- -->
  <!-- --------------INCLUDES COMMON COMPONENTS . START----------------- -->


  <?php include '_navbar.php' ?>

  <!-- --------------INCLUDES COMMON COMPONENTS . END------------------- -->
  <!-- ----------------------------------------------------------------- -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container bootstrap snippets bootdeys mt-5">
    <div id="h1">
      <h1 class="test">Contact Us</h1>
    </div>
    <div class="row text-center mt-5 mb-3">
      <div class="col-sm-4">
        <div class="contact-detail-box">
          <i class="fa fa-th fa-2x text-colored mb-3"></i>
          <h4>Get In Touch</h4>
          <abbr title="Phone">P:</abbr> (123) 456-7890<br>
          E: <a href="mailto:email@email.com" class="text-muted">office@lifestylelab.at</a>
        </div>
      </div><!-- end col -->

      <div class="col-sm-4">
        <div class="contact-detail-box">
          <i class="fa fa-map-marker fa-2x text-colored mb-3"></i>
          <h4>Our Location</h4>

          <address>
            720 Broadway<br>
            New York, NY 10003<br>
          </address>
        </div>
      </div><!-- end col -->

      <div class="col-sm-4">
        <div class="contact-detail-box">
          <i class="fa fa-book fa-2x text-colored mb-3"></i>
          <h4>24x7 Support</h4>


          <h4 class="text-muted">+1234 567 890</h4>
        </div>
      </div><!-- end col -->

    </div>
    <!-- end row -->

    <div class="container mt-4">
      <div class="row flex-column-reverse flex-md-row">
        <div class="col-12 col-md-6 p-4">
          <div class="contact-map">
            <iframe width="100%" height="450" style="Border:0" Loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/view?zoom=17&center=40.7291%2C-73.9935&key=AIzaSyB9YmNltd1wX02CC9TO61AuvG4vobeMh5o"></iframe>
          </div>
        </div><!-- end col -->

        <!-- Contact form -->
        <div class="col-12 col-md-6 p-4">
          <form role="form" name="ajax-form" id="ajax-form" action="https://formsubmit.io/send/coderthemes@gmail.com" method="post" class="form-main">

            <div class="form-group">
              <br>
              <label for="name2">Name</label>
              <input class="form-control" id="name2" name="name" onblur="if(this.value == '') this.value='Name'" onfocus="if(this.value == 'Name') this.value=''" type="text" value="Name">
              <div class="error" id="err-name" style="display: none;">Please enter name</div>
            </div> <!-- /Form-name -->

            <div class="form-group">
              <label for="email2">Email</label>
              <input class="form-control" id="email2" name="email" type="text" onfocus="if(this.value == 'E-mail') this.value='';" onblur="if(this.value == '') this.value='E-mail';" value="E-mail">
              <div class="error" id="err-emailvld" style="display: none;">E-mail is not a valid format</div>
            </div> <!-- /Form-email -->

            <div class="form-group">
              <label for="message2">Message</label>
              <textarea class="form-control" id="message2" name="message" rows="5" onblur="if(this.value == '') this.value='Message'" onfocus="if(this.value == 'Message') this.value=''">Message</textarea>

              <div class="error" id="err-message" style="display: none;">Please enter message</div>
            </div> <!-- /col -->

            <div class="row">
              <div class="col-xs-12">
                <div id="ajaxsuccess" class="text-success">E-mail was successfully sent.</div>
                <div class="error" id="err-form" style="display: none;">There was a problem validating the form please check!</div>
                <div class="error" id="err-timedout">The connection to the server timed out!</div>
                <div class="error" id="err-state"></div>
                <br><br>
                <button type="submit" class="btn btn-info btn-shadow btn-rounded w-md" id="send">Submit</button>

              </div> <!-- /col -->
            </div> <!-- /row -->

          </form> <!-- /form -->
        </div> <!-- end col -->

      </div> <!-- end row -->
    </div>
  </div>
</body>

</html>







<!-- ------------------------------------------------------------ -->
<!-- -------------INCLUDES COMMON FOOTER . START----------------- -->

<?php include './components/footer.html' ?>


<!-- -------------INCLUDES COMMON FOOTER . END------------------- -->
<!-- ------------------------------------------------------------ -->

</body>

</html