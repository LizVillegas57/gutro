<?php
  //If the form is submitted
  if(isset($_POST['submit'])) {

    //Check to make sure that the name field is not empty
    if(trim($_POST['contactname']) == '') {
      $hasError = true;
    } else {
      $name = trim($_POST['contactname']);
    }

    //Check to make sure that the subject field is not empty
    if(trim($_POST['phone']) == '') {
      $hasError = true;
    } else {
      $phone = trim($_POST['phone']);
    }

    //Check to make sure that the subject field is not empty
    if(trim($_POST['subject']) == '') {
      $hasError = true;
    } else {
      $subject = trim($_POST['subject']);
    }

    //Check to make sure sure that a valid email address is submitted
    if(trim($_POST['email']) == '')  {
      $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
      $hasError = true;
    } else {
      $email = trim($_POST['email']);
    }

    //Check to make sure comments were entered
    if(trim($_POST['message']) == '') {
      $hasError = true;
    } else {
      if(function_exists('stripslashes')) {
        $comments = stripslashes(trim($_POST['message']));
      } else {
        $comments = trim($_POST['message']);
      }
    }

    //If there is no error, send the email
    if(!isset($hasError)) {
      $emailTo = 'liz.villegas88@gmail.com'; //Put your own email address here
      $body = "Nombre:\n $name \n\nEmail:\n $email \n\nSubject:\n $subject \n\n Teléfono:\n $phone \n\nComments:\n $comments";
      $headers = 'From: Gutro<'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

      mail($emailTo, $subject, $body, $headers);
      $emailSent = true;
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />

    <title>Gutro</title>

    <link href="css/styles.css" type="text/css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        // validate signup form on keyup and submit
        var validator = $("#contactform").validate({
          rules: {
            contactname: {
              required: true,
              minlength: 2
            },
            email: {
              required: true,
              email: true
            },
            phone: {
              required: true,
              minlength: 10
            },
            subject: {
              required: true,
              minlength: 10
            },
            message: {
              required: true,
              minlength: 10
            }
          },
          messages: {
            contactname: {
              required: "Porfavor escribe tu nombre",
              minlength: $.format("Tu nombre debe tener al menos {0} letras")
            },
            email: {
              required: "Porfavor escribe un email válido",
              minlength: "Porfavor escribe un email válido"
            },
            phone: {
              required: "Necesitas escribir tu teléfono.",
              minlength: jQuery.format("Escribe al menos {0} numeros")
            },
            subject: {
              required: "Necesitas escribir un asunto",
              minlength: jQuery.format("Escribe al menos {0} letras")
            },
            message: {
              required: "Escribe algún comentario",
              minlength: jQuery.format("Escribe al menos {0} letras")
            }
          },
          // set this class to error-labels to indicate valid fields
          success: function(label) {
            label.addClass("checked");
          }
        });
      });
    </script>
  </head>
  <body>
    <!-- Content -->
    <div class="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default customNavigation" role="navigation">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index">
              <img src="images/logoHorizontal.png" alt="Gutro" class="fadeInDown animated logoDesktop">
              <img src="images/logoHorizontal_small.png" alt="Gutro" class="fadeInDown animated logoMobile">
            </a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="index">Inicio</a></li>
              <li><a href="empresa">Empresa</a></li>
              <li><a href="clientes">Clientes</a></li>
              <li><a href="servicios">Nuestros Servicios</a></li>
              <li><a href="contacto" class="active">Contacto</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
      <!-- Section  Contact -->
      <section class="contact clearfix">
        <h1>Contáctanos</h1>
        <article class="col-lg-3 col-md-3 col-sm-12">
          <h2>HABLEMOS DE NEGOCIOS</h2>
          <span>Cuéntanos de tu proyecto. Te estaremos contestando a la brevedad posible.</span>
        </article>
        <aside class="col-lg-9 col-md-9 col-sm-12">
          <?php if(isset($hasError)) { //If errors are found ?>
            <p class="error">Porfavor revisa que todos los campos tengan la información requerida e intenta de nuevo. Gracias.</p>
          <?php } ?>

          <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
            <div class="success">
              <p><strong>E-mail enviado exitosamente!</strong></p>
              <p>Gracias <strong><?php echo $name;?></strong>! Muy pronto estaremos en contacto contigo.</p>
            </div>
          <?php } ?>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
            <div class="contactForm">
              <div>
                <input type="text" name="contactname" id="contactname" value="" class="required" role="input" aria-required="true" placeholder="Escribe tu nombre">
              </div>
              <div>
                <input type="text" name="email" id="email" value="" class="required email" role="input" aria-required="true" placeholder="Escribe tu e-mail">
              </div>
              <div>
                <input type="text" name="phone" id="phone" value="" class="required" role="input" aria-required="true" placeholder="Escribe tu teléfono">
              </div>
              <div>
                <input type="text" name="subject" id="subject" value="" class="required asunto" role="input" aria-required="true" placeholder="Asunto">
              </div>
              <div class="textArea">
                <textarea id="mensaje" name="message" id="message" class="required" role="textbox" aria-required="true" placeholder="Escribe tu mensaje"></textarea>
              </div>
              <div class="buttone">
                <input type="submit" class="button" value="Enviar" name="submit" id="submitButton" title="Da click aquí para enviar el mensaje!" />
              </div>
            </div>
          </form>
        </aside>
      </section>

      <footer class="clearfix">
        <div class="colRight">
          <div class="block">
            <ul>
              <li>
                <span class="icons phone"></span>
                <h4>Teléfonos</h4>
                <div class="clearfix"></div>
                <p>+52 01 (55) 2637-5971</p>
                <p>+52 01 (55) 2637-5972</p>
                <p>+52 01 (55) 2637-5974</p>
                <p>01-800-8-21-59-71</p>
              </li>
            </ul>
          </div>
          <div class="block">
            <ul>
              <li>
                <span class="icons location"></span>
                <h4>Ubicación</h4>
                <div class="clearfix"></div>
                <p>Ejército Nacional 838 | Los Morales 11540 | Ciudad de México, Distrito Federal</p>
              </li>
            </ul>
          </div>
          <div class="block">
            <ul>
              <li>
                <span class="icons contact"></span>
                <h4>Contacto</h4>
                <div class="clearfix"></div>
                <p>luis.g@gutro.com</p>
                <p>luis@gutro.com</p>
                <p>contacto@gutro.com</p>
              </li>
            </ul>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="copyrights">&copy; 2014 Gutro | Todos los derechos reservados.</div>
        <div class="colLeft">
          <img src="images/imagotipoGray.png" alt="Gutro">
        </div>
      </footer>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>-->

    <!-- Include all compiled plugins (below), or include individual files as needed -->
  </body>
</html>