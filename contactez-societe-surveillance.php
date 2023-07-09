
<?php  
require 'dbconnection.php';
require_once 'recaptcha/src/autoload.php';



if(isset($_POST["demandADevis"])){
    $name_prenome = $_POST["nameAndLastName"];
    $Ville = $_POST["senderVille"];
    $tel = $_POST["tel"];
    $Email = $_POST["Email"];
    $Type_de_local = $_POST["ProOrPar"];
    $messageSubject1 = $_POST["messageSubject1"];
    $messageSubject3 = $_POST["messageSubject3"];
    $message = $_POST["message"];

    


    $query = "INSERT INTO contact1 VALUES('$name_prenome','$Ville','$tel','$Email','$Type_de_local','$messageSubject1','$messageSubject3','$message')";
    mysqli_query($conn,$query);

    
}






?>

<?php
use ReCaptcha\ReCaptcha;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get your reCAPTCHA secret key from the reCAPTCHA website
$recaptchaSecretKey = '6LfQco8mAAAAAB7e6hOjBM26LQjIZyDzS3OJq5K-';
$recaptcha = new ReCaptcha($recaptchaSecretKey);

if (isset($_POST["demandADevis"])) {
    // Verify reCAPTCHA response
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaResult = $recaptcha->verify($recaptchaResponse);

    if ($recaptchaResult->isSuccess()) {
        // reCAPTCHA verification passed

        // Get form data
        $name_prenome = $_POST["nameAndLastName"];
        $Ville = $_POST["senderVille"];
        $tel = $_POST["tel"];
        $Email = $_POST["Email"];
        $Type_de_local = $_POST["ProOrPar"];
        $messageSubject1 = $_POST["messageSubject1"];
        $messageSubject3 = $_POST["messageSubject3"];
        $message = $_POST["message"];

        // Insert form data into the database
        $sql =  "INSERT INTO contact1 VALUES('$name_prenome','$Ville','$tel','$Email','$Type_de_local','$messageSubject1','$messageSubject3','$message')";

        if (mysqli_query($conn, $sql)) {
            echo "Data saved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

        // Send the data in the email
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';

        

        // Function to sanitize form inputs
        function sanitizeInput($input)
        {
            return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get form data and sanitize inputs
            $name = sanitizeInput($_POST['nameAndLastName']);
            $ville = sanitizeInput($_POST['senderVille']);
            $tel = sanitizeInput($_POST['tel']);
            $email = sanitizeInput($_POST['Email']);
            $subject = sanitizeInput($_POST['ProOrPar'] ?? $_POST['messageSubject1'] ?? $_POST['messageSubject3']);
            $message = sanitizeInput($_POST['message']);

            // Create a new PHPMailer instance
            $mail = new PHPMailer(true);

            try {
                // Configure SMTP settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Your SMTP server host (Gmail)
                $mail->SMTPAuth = true;
                $mail->Username = 'bohanyou0@gmail.com'; // Your Gmail email address
                $mail->Password = 'btlfhxppvwpwatlf'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Set email content and recipients
                $mail->setFrom('bohanyou0@gmail.com', 'just me'); // Sender email and name
                $mail->addAddress('bohanyou0@gmail.com', 'hamza karrassi'); // Recipient email and name
                $mail->Subject = 'Form Submission'; // Email subject
                $mail->Body = "Name: $name\nVille: $ville\nTél: $tel\nEmail: $email\nSubject: $subject\n\nMessage: $message"; // Email body

                // Send the email
                $mail->send();

                // Redirect to a success page
                echo "<script>alert('Good job!')</script>";
                header("Location: devis-societe-surveillance.php");
                

                //header("Location: success.html");
                exit();
            } catch (Exception $e) {
                // Display an error message
                echo 'Email could not be sent. Error: ', $mail->ErrorInfo;
            }
        } else {
            // Redirect to the form page if accessed directly
            header("Location: index.html");
            exit();
        }
    } else {
        // echo"<br> you most check you are not robot first \n";
        // echo '<br>';
        // // reCAPTCHA verification failed
        // // Handle the error or display an error message to the user
         $errors = $recaptchaResult->getErrorCodes();
         echo "reCAPTCHA verification failed. Error: \n " . implode(", ", $errors);
         
    }
} else {
    // Handle the case when the form is not submitted
}
	?>




<!DOCTYPE html>
<html>
<!--<![endif]-->

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="google-site-verification" content="moH3eIIcXw150DLxdlRF-z1aXr3pyBinwZjjtn4SuFI" />
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date(); a = s.createElement(o),
                m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '../www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-53772008-1', 'auto');
        ga('send', 'pageview');

    </script>
    <title>Société de dératisation à Casablanca Maroc - HVNET ANTINUISIBLES</title>

    <meta name="keywords"
        content="société de dératisation casablanca, société de dératisation à casablanca, dératisation casablanca, deratisation casablanca, societe deratisation casablanca, société de dératisation, societe de deratisation, désinsectisation casablanc, desinsectisation casablanca, déreptilisation casablanca, entreprise dératisation casablanca, société dératisation Casablanca, entreprise désinfection casablanca, entreprise désinsectisation casablanca, société désinsectisation casablanca, traitements antiparasitaires casablanca, anti-cafard casablanca, anti-mouche casablanca, société dératisation, entreprise dératisation, nuisibles, rat, souris, rongeurs, loirs, surmulots, mulots, lérots, cafards, blattes, punaises de lit, puces parquet, tiques, fourmis, araignées, poissons d'argent, anthrènes, mouches, moustiques, pigeons, insectes, serpents, lézards, scorpions, entreprise, société, casablanca Maroc.">

    <meta name="description"
        content="Société de dératisation à Casablanca Maroc : service de dératisation, désinsectisation, désinfection et déreptilisation sur Casablanca. Notre societe de dératisation à Casablanca Maroc HVNET ANTINUISIBLES">
    <meta name="Coverage" content="Worldwide" />
    <meta name="revisit-after" content="3 days" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="GOOGLEBOT" content="INDEX,FOLLOW,ALL" />
    <meta name="copyright" content="deratisation-casablanca.com 2013" />
    <meta name="viewport" content="width=device-width">
    <meta name="Owner" content="Nizar , l homme de toute ma vie lol" />
    <meta name="Publisher " content="Ka, la femme de sa vie lol" />
    <meta name="identifier-URL" content="https://www.deratisation-desinsectisation-casablanca.com" />
    <meta name="Reply-to" content="mailto:hvnet.antinuisibles.maroc@gmail.com" />


    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /><!-- Google Fonts -->
    <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet"
        type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" /> -->
    <!-- Library CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.html" rel="stylesheet" />
    <link href="css/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/animations.css" media="screen" rel="stylesheet" />
    <link href="css/superfish.css" media="screen" rel="stylesheet" />
    <link href="css/revolution-slider/css/settings.css" media="screen" rel="stylesheet" />
    <link href="css/prettyPhoto.css" media="screen" rel="stylesheet" /><!-- Theme CSS -->
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/footercss.css" rel="stylesheet" /><!-- Skin -->
    <link href="css/style.contact.css" rel="stylesheet" /><!-- Skin -->
    <link href="css/footercss.css" rel="stylesheet" /><!-- Skin -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!--<link class="colors" href="css/colors/blue.css" rel="stylesheet" />-->
    <!-- Responsive CSS -->
    <link href="css/theme-responsive.css" rel="stylesheet" /><!-- Switcher CSS -->
    <link href="css/switcher.css" rel="stylesheet" />
    <link href="css/spectrum.css" rel="stylesheet" />
    <link href="css/StyleContact.css" rel="stylesheet" />
    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
              integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
        <!-- Font Awesome Icons  -->
        <link rel="stylesheet" href="../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="../use.fontawesome.com/releases/v5.5.0/css/all.css"
           integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


            
      <link rel="stylesheet" href="../use.fontawesome.com/releases/v5.5.0/css/all.css"
      integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/6.4.0/css/bootstrap.min.css">

    <!-- Favicons -->
    <link href="img/ico/LOGO-FOOTER-HVNET-ANTINUISIBLE-1.ico" rel="shortcut icon" />
    <link href="img/ico/apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="img/ico/apple-touch-icon-72.png" rel="apple-touch-icon" sizes="72x72" />
    <link href="img/ico/apple-touch-icon-114.png" rel="apple-touch-icon" sizes="114x114" />
    <link href="img/ico/apple-touch-icon-144.png" rel="apple-touch-icon" sizes="144x144" />
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lc-KpgmAAAAAKcBGqQG81IQABSqRyx4MBBBad8Q"></script>





    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
         <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
         <script src="js/respond.min.js"></script>
         <![endif]-->
    <!--[if IE]>
         <link rel="stylesheet" href="css/ie.css">
         <![endif]-->
    
    <!-- button phone -->

    <script>
  function onClick(e) {
    e.preventDefault();
    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute('6Lc-KpgmAAAAAKcBGqQG81IQABSqRyx4MBBBad8Q', {action: 'LOGIN'});
      // IMPORTANT: The 'token' that results from execute is an encrypted response sent by
      // reCAPTCHA Enterprise to the end user's browser.
      // This token must be validated by creating an assessment.
      // See https://cloud.google.com/recaptcha-enterprise/docs/create-assessment
    });
  }
</script>

    <script>
        function hover() {
            document.getElementById("button-phone").style.color = "#000";
            document.getElementById("icon-phone").style.color = "#000";

            document.getElementById("icon-phone").style.backgroundcolor = "#000";
        }

        function out() {
            document.getElementById("button-phone").style.color = "#FFF";
            document.getElementById("icon-phone").style.color = "#FFF";

            document.getElementById("button-phone").style.backgroundcolor = "#FFF";
            document.getElementById("icon-phone").style.backgroundcolor = "#FFF";
        }
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js">
    </script>

    <script type="text/javascript">
        (function () {
            emailjs.init("YOUR_PUBLIC_KEY");
        })();
    </script>

    <script>
        function sendEmail() {

            expressionReguliereEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            expressionReguliereTelephone = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;

            document.getElementById('Succes').innerHTML = "";

            nomEmail = document.getElementById("nom").value;
            emailEmail = document.getElementById("email").value;
            telEmail = document.getElementById("tel").value;
            villeEmail = document.getElementById("ville").value;
            sujetEmail = document.getElementById("sujet").value;
            messageEmail = document.getElementById("message").value;

            var succe = true;

            if (nomEmail == '') {
                document.getElementById('nom-required').style.color = "#F00";
                document.getElementById('nom-required').innerHTML = "le nom est obligatoire";
                succe = false;
            } else {
                document.getElementById('nom-required').innerHTML = "";
            }


            if (emailEmail == '') {
                document.getElementById('email-required').style.color = "#F00";
                document.getElementById('email-required').innerHTML = "l'email est obligatoire";
                succe = false;
            } else if (!expressionReguliereEmail.test(emailEmail)) {
                document.getElementById('email-required').style.color = "#F00";
                document.getElementById('email-required').innerHTML = "l'email n'est pas valide";
                succe = false;
            } else {
                document.getElementById('email-required').innerHTML = "";
            }


            if (telEmail == '') {
                document.getElementById('tel-required').style.color = "#F00";
                document.getElementById('tel-required').innerHTML = "le tel est obligatoire";
                succe = false;
            } else if (!expressionReguliereTelephone.test(telEmail)) {
                document.getElementById('tel-required').style.color = "#F00";
                document.getElementById('tel-required').innerHTML = "le tel n'est pas valide";
                succe = false;
            } else {
                document.getElementById('tel-required').innerHTML = "";
            }


            if (villeEmail == '') {
                document.getElementById('ville-required').style.color = "#F00";
                document.getElementById('ville-required').innerHTML = "la ville est obligatoire";
                succe = false;
            } else {
                document.getElementById('ville-required').innerHTML = "";
            }


            if (sujetEmail == '') {
                document.getElementById('sujet-required').style.color = "#F00";
                document.getElementById('sujet-required').innerHTML = "le sujet est obligatoire";
                succe = false;
            } else {
                document.getElementById('sujet-required').innerHTML = "";
            }


            if (messageEmail == '') {
                document.getElementById('message-required').style.color = "#F00";
                document.getElementById('message-required').innerHTML = "le message est obligatoire";
                succe = false;
            } else {
                document.getElementById('message-required').innerHTML = "";
            }


            if (succe) {

                var v = grecaptcha.getResponse();

                if (v.length == 0) {
                    document.getElementById('captcha').style.color = "#F00";
                    document.getElementById('captcha').innerHTML = "Vous ne pouvez pas ignorer le Captcha";
                }
                else {
                    document.getElementById('captcha').innerHTML = "";

                    var emailSend = {

                        nom: document.getElementById("nom").value,
                        email: document.getElementById("email").value,
                        tel: document.getElementById("tel").value,
                        ville: document.getElementById("ville").value,
                        sujet: document.getElementById("sujet").value,
                        message: document.getElementById("message").value
                    }

                    emailjs.send("service_iz8zhj9", "template_gn9gqkc", emailSend, "e4_owQIIPNCt1Xfvr").then(

                        document.getElementById('Succes').style.color = "#28B463",
                        document.getElementById('Succes').innerHTML = "Merci de nous contacter, votre message a etait envoyé",

                        document.getElementById("nom").value = "",
                        document.getElementById("email").value = "",
                        document.getElementById("tel").value = "",
                        document.getElementById("ville").value = "",
                        document.getElementById("sujet").value = "",
                        document.getElementById("message").value = "",

                    );




                }
            }





        }
    </script>

    <!-- Recaptcha script -->
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>

        function get_action(form) {
            var v = grecaptcha.getResponse();
            if (v.length == 0) {
                document.getElementById('captcha').style.color = red;
                document.getElementById('captcha').innerHTML = "You can't leave Captcha Code empty";
                return false;
            }
            else {
                document.getElementById('captcha').style.color = green;
                document.getElementById('captcha').innerHTML = "Captcha completed";
                return true;
            }
        }

    </script>




</head>




<body class="home">
    <div class="wrap">
        <!-- Header Start -->
        <header id="header">



            <!-- Main Header Start -->
            <div class="main-header">
   
               <!-- Header Top Bar Start -->
               <div class="top-bar">
                  <div class="slidedown collapse">
                     <div class="container">
                        <div class="phone-email pull-left">
   
   
   
                           <a href="tel:+212630078072" id="button-phone"><i class="icon-phone" id="icon-phone">
                           </i>+212 696-170-704<a href=""><i class="fa-solid fa-envelope">

                           </i> Email: example657gmail.com</a>
   
                        </div>
                        <div class="pull-right">
                           <ul class="social pull-left">
                              <li class="facebook"><a href=""><i
                                       class="icon-facebook"></i></a></li>
   
                              <li class="twitter"><a href="#"><i class="icon-twitter"></i></a></li>
                              <li class="dribbble"><a href="#"><i class="icon-dribbble"></i></a></li>
                              <li class="linkedin"><a href="#"><i class="icon-linkedin"></i></a></li>
                              <li class="rss"><a href="#"><i class="icon-rss"></i></a></li>
                           </ul>
                           <!--<div id="search-form" class="pull-right">
                     <form action="#" method="get">
                        <input type="text" class="search-text-box">
                     </form>
                  </div>-->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Header Top Bar End -->
   
               <div class="container">
                  <!-- TopNav Start -->
                  <div class="topnav navbar-header">
                     <a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
                        <i class="icon-angle-down icon-current"></i>
                     </a>
                  </div>
                  <!-- TopNav End -->
                  <!-- Logo Start -->
   
                  <div class="logo pull-left">
                     <a href="index1.html"><img id="image-phone"
                           alt="Société de dératisation à Casablanca Maroc" height="80"
                           src="img/logo1.png" width="150" /></a>
                  </div>
                  <!-- Logo End -->
                  <!-- Mobile Menu Start -->
   
                  <div class="mobile navbar-header">
                     <a id="button-lidt-phone" class="navbar-toggle" data-toggle="collapse" href=".navbar-collapse">
                        <i class="icon-reorder icon-2x"></i>
                     </a>
                  </div>
                  <!-- Mobile Menu End -->
                  <!-- Menu Start -->
   
                  <div class="">
                     <nav class="collapse navbar-collapse menu ">
   
                        <ul class="nav navbar-nav sf-menu">
                           <li><a href="index1.html">Accueil
                                 <span class="sf-sub-indicator"> </span> </a></li>
                           <li><a class="sf-with-ul" href="apropos-nous.html">A props <span
                                    class="sf-sub-indicator"> </span> </a></li>
                           <li><a class="sf-with-ul" href="societe-camera-surveillance-particuliers-casablanca.html">Particuliers <span
                                    class="sf-sub-indicator"> </span> </a></li>
                           <li><a class="sf-with-ul" href="societe-camera-surveillance-professionnel-casablanca.html">Professionnels <span
                                    class="sf-sub-indicator"> </span> </a></li>
   
                                    <li>
                                       <a href="#" onclick="" id="current">services
                                          <i class=" fas fa-caret-down" style="margin-left: 5px;"></i>
                                       </a>
                                       <ul class="nav-scroll-bar">
            
                                          <li><a href="Installation-Cameras-de-surveillance.html">Installation Cameras de surveillance</a></li>
                                          <li><a href="Installation-Contrôle-daccès.html">Installation Contrôle d'accès</a></li>
                                          <li><a href="Installation-Porte-automatique.html">Installation Porte automatique</a></li>
            
            
            
                                          <li><a href="Installation-Porte-blindée.html">Installation Porte blindée</a></li>
                                          <li><a href="Installation-Porte-Coulissantes.html">Installation Porte Coulissantes</a></li>
                                          <li><a href="Installation-Porte-domotique.html">Installation Porte domotique</a></li>
                                          <li><a href="Installation-Porte-de-garage-domotique.html">Installation Porte de garage domotique</a></li>
            
            
            
                                          <li><a href="Installation-Porte-Rapide.html">Installation Porte Rapide</a></li>
                                          <li><a href="Installation-Porte-sectionnelle-industrielle.html">Installation Porte sectionnelle industrielle</a></li>
                                          <li><a href="Installation-Porte-sectionnelle-residentielle.html">Installation Porte sectionnelle residentielle</a></li>
            
            
            
                                       </ul>
                                    </li>
            
            
                                    <li>
                                       <a href="#" onclick="" id="current">ACTIVITIES
                                          <i class=" fas fa-caret-down" style="margin-left: 5px;"></i>
                                       </a>
                                       <ul class="nav-scroll-bar">
            
                                          <li><a href="Installation-Porte-battantes.html">Installation Porte battantes</a></li>
                                          <li><a href="Installation-Surveillance-renovation.html">Installation Surveillance renovation</a>
                                          </li>
                                          <li><a href="Installation-Système-dalarme.html">Installation Système d'alarme</a></li>
            
            
            
                                          <li><a href="Installation-Système-de-pointage.html">Installation Système de pointage</a></li>
                                          <li><a href="Installation-Système-incendie-anti-intrusion.html">Installation Système incendie anti-intrusion</a>
                                          </li>
                                          <li><a href="Installation-Système-Anti-vol.html">Installation Système Anti-vol</a></li>
                                          <li><a href="Installation-Système-de-télésurveillancee.html">Installation Système de télésurveillancee</a></li>
            
            
            
                                          <li><a href="Installation-Volet-roulant-La-domotique.html">Installation Volet roulant La domotique</a></li>
                                          <li><a href="Installation-Volets-roulants.html">Installation Volets roulants</a></li>
                                         
            
            
                                       </ul>
                                    </li>
   
                            <li><a href="contactez-societe-surveillance.php">Contact</a></li>
                           <li><a href="devis-societe-surveillance.php">DEMANDEZ DEVIS</a></li>
                           
                        </ul>
                     </nav>
                  </div>
   
                  <!-- Menu End -->
               </div>
            </div>
            <!-- Main Header End -->
         </header>
       




        <!-- Content Start -->
        <div id="main">



            <!-- fixed div start-->
           <!-- fixed div start-->
            <div class="fixed-div">
   
               <div class="fixed-btn-1">
                  <a href="devis-societe-surveillance.php"><i class="fas fa-comment-alt" aria-hidden="true"></i></a>
               </div>
   
   
               <div class="fixed-btn-2">
                  <a href="tel:+212 696-170-704"><i class="fa fa-phone" aria-hidden="true"></i></a>
               </div>
   
   
               <div class="fixed-btn-3">
                  <a href="https://api.whatsapp.com/send?phone=0696170704">
                     <i class="fab fa-whatsapp"></i></a>
               </div>
   
            </div>
            <!-- fixed div end-->
            <!-- fixed div end-->
            <!-- Title, Breadcrumb Start-->
            <div class="breadcrumb-wrapper">
                <div class="container" >
                                             <h2 class="title" style="text-align: center;">Contact</h2>
                       
                </div>
            </div>
            <!-- Title, Breadcrumb End-->
            <!-- Main Content start-->
            <div class="content">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 section1contact" id="contact-form">
                            <h3 class="title">DEVIS GRATUIT</h3>
                            <p>
                                Pour plus d'informations, un devis gratuit, une question sur nos compétences
                                ou sur nos installation de Cameras, contrôle d'accès, portes, porte coulissante
                                et
                                à casablanca et partout au maroc, n'hésitez pas à nous contacter, notre équipe est à
                                votre
                                disposition.

                                Nous prendrons contact avec vous dès réception de votre message
                            </p>
                            <p style="margin-bottom: 4%;">
                                N'hésitez pas à nous contacter pour un devis personnalisé gratuit.
                            </p>


                            <div class="col-sm-8">
                            <form id="devisForm" method="POST" acttion="" > 
                                <div>
                                </div>
        
    <div >
            <label  for="">Nom/Prenom <span class="necessary">*</span></label> <br/>
            <input  name="nameAndLastName" type="text" placeholder="Nom prenom" required="">
        </div>
        <div >
            <label for="">Ville <span class="necessary">*</span></label><br>
            <select  name="senderVille"  required="">
                <option value='' disabled selected hidden>Choisi la Ville</option>
                                <option value="Agadir"> Agadir </option>
                                <option value="Beni Mellal"> Beni Mellal </option>
                                <option value="Berkane"> Berkane </option>
                                <option value="Casablanca"> Casablanca </option>
                                <option value="El Jadida"> El Jadida </option>
                                <option value="Fes"> Fes </option>
                                <option value="Kenitra"> Kenitra </option>
                                <option value="Khemisset"> Khemisset </option>
                                <option value="Khouribga"> Khouribga </option>
                                <option value="laayoune"> laayoune </option>
                                <option value="Marrakech"> Marrakech </option>
                                <option value="Meknes"> Meknes </option>
                                <option value="Mohammedia"> Mohammedia </option>
                                <option value="Nador"> Nador </option>
                                <option value="Oujda"> Oujda </option>
                                <option value="Rabat"> Rabat </option>
                                <option value="Safi"> Safi </option>
                                <option value="Sale"> Sale </option>
                                <option value="Tanger"> Tanger </option>
                                <option value="Taza"> Taza </option>
                                <option value="Temara"> Temara </option>
                                <option value="Tetouan"> Tetouan </option>
                            </select>
        </div>
        <div >
            <label for="">Tel<span class="necessary">*</span></label><br/>
            <input  name="tel" type="text" placeholder="Tél" maxlength="10" onkeypress="return onlyNumberKey(event)" required="">
        </div>
        <div >
            <label for="">Email<span class="necessary">*</span></label><br/>
            <input  name="Email" type="text" placeholder="Email" required="">
        </div>
        <div>
            <label for="">Type de local<span class="necessary">*</span></label><br>
            <select  name="ProOrPar" id="TypeLocal" required="">
                <option value='' disabled selected hidden>Choisi le Type de local</option>
                                <option value="Particulier"> Particulier </option>
                                <option value="Professionnel"> Professionnel </option>
                            </select>
        </div>
        <div class="inputAndLabelCon" id="Part">
                    <label for="">Sujet <span class="necessary">*</span></label><br>
                    <select  name="messageSubject1" id="pr">
                        <option value='' disabled selected hidden>Choisi le Sujet</option>
                                                <option value="Studio"> Studio </option>
                                                <option value="Appartement"> Appartement </option>
                                                <option value="Maison"> Maison </option>
                                                <option value="Villa"> Villa </option>
                                                <option value="Autre"> Autre </option>
                                                <option value="Magasin"> Magasin </option>
                                                <option value="Showroom"> Showroom </option>
                                                <option value="Supermarche"> Supermarche </option>
                                                <option value="usine"> usine </option>
                                            </select>
                </div>


                <div class="inputAndLabelCon" id="atre">
                    <label for="">Autre <span class="necessary">*</span></label><br>
                    <input  type="text" name="messageSubject3" id="atr" placeholder="Autre">
                </div>


<script>
$(document).ready(function(){ $("#Part").hide();$("#Prof").hide();$("#atre").hide();});
</script>

<script>
    let sltplc = document.querySelector('#TypeLocal');
    sltplc.addEventListener('change',function(){

        if (this.value =='2'){
            $("#Prof").show();
            $("#atre").hide();
            $('#atr').val('');
            $("#Part").hide();
            $("#pr")[0].selectedIndex = 0;

            let slpf = document.querySelector("#pf");
            slpf.addEventListener('change',function(){
            if (this.value ==10){
                $("#atre").show();
            }
            else {
                $("#atre").hide();
                $('#atr').val('');
            }
            });
        }
        else 
            if (this.value =='1'){
                $("#Part").show();
                $("#atre").hide();
                $('#atr').val('');
                $("#Prof").hide();
                $("#pf")[0].selectedIndex = 0;

                let slpr = document.querySelector("#pr");
                slpr.addEventListener('change',function(){
                if (this.value ==5){
                    $("#atre").show();
                }
                else {
                    $("#atre").hide();
                    $('#atr').val('');
                    }
                });
            }
    });
</script>

        <div>
            <label for="">Message<span class="necessary">*</span></label><br/>
            <textarea style="height: 100px; " name="message" required=""></textarea>
        </div>

        <br>

        <div class="g-recaptcha" data-sitekey="6LfQco8mAAAAAIvw5JsWlVOAjk9wU0MfyGnzv2yk"></div>
                                       

                                            <br>


        <button id="submitButton" style="color:#fff; width: 300px ; background-color:#0072bd; font-weight:bold;" name="demandADevis" onclick="clickMe()">ENVOYER</button>

        </form>
                            </div>









                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                            
                            <div class="address widget">
                                <h3 class="title">Nos coordonnées </h3>
                                <ul class="contact-us">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        <p>
                                            <strong>Addresse:</strong> <br>
                                        </p>

                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <p>
                                            <strong>Téléphone:</strong><br>
                                        </p>
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <p>
                                            <strong>Fixe:</strong><br>
                                        </p>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <p>
                                            <strong>Email:</strong><a href="mailto:hbrilvbqbl@gmail.com"> </a>
                                        </p>
                                    </li>
                                </ul>
                            </div>

                            <div class="widget"  style="text-align: left; margin-top: 50px;">
                                <h3 class="title" style="text-align: start;">Heures de travail</h3>
                                <ul>
                                    <li><i class="icon-time"> </i>24H/24 et 7J/7</li>

                                </ul>
                            </div>
                            
                           
                            <div class="content-box-info" style="text-align: left; margin-top: 30px;">
                                <h4 class="title" style="color: #000;">Entreprise de Installation à casablanca</h4>

                                <ul class="check-list why">
                                    <li><a href="Installation-Cameras-de-surveillance.html">Installation Cameras de surveillance</a></li>
                                    <li><a href="Installation-Contrôle-daccès.html">Installation Contrôle d'accès</a></li>
                                    <li><a href="Installation-Porte-automatique.html">Installation Porte automatique</a></li>
      
      
      
                                    <li><a href="Installation-Porte-blindée.html">Installation Porte blindée</a></li>
                                    <li><a href="Installation-Porte-Coulissantes.html">Installation Porte Coulissantes</a></li>
                                    <li><a href="Installation-Porte-domotique.html">Installation Porte domotique</a></li>
                                    <li><a href="Installation-Porte-de-garage-domotique.html">Installation Porte de garage domotique</a></li>
      
      
      
                                    <li><a href="Installation-Porte-Rapide.html">Installation Porte Rapide</a></li>
                                    <li><a href="Installation-Porte-sectionnelle-industrielle.html">Installation Porte sectionnelle industrielle</a></li>
                                    <li><a href="Installation-Porte-sectionnelle-residentielle.html">Installation Porte sectionnelle residentielle</a></li>

                                    <li><a href="Installation-Porte-battantes.html">Installation Porte battantes</a></li>
                                    <li><a href="Installation-Surveillance-renovation.html">Installation Surveillance renovation</a>
                                    </li>
                                    <li><a href="Installation-Système-dalarme.html">Installation Système d'alarme</a></li>
      
      
      
                                    <li><a href="Installation-Système-de-pointage.html">Installation Système de pointage</a></li>
                                    <li><a href="Installation-Système-incendie-anti-intrusion.html">Installation Système incendie anti-intrusion</a>
                                    </li>
                                    <li><a href="Installation-Système-Anti-vol.html">Installation Système Anti-vol</a></li>
                                    <li><a href="Installation-Système-de-télésurveillancee.html">Installation Système de télésurveillancee</a></li>
      
      
      
                                    <li><a href="Installation-Volet-roulant-La-domotique.html">Installation Volet roulant La domotique</a></li>
                                    <li><a href="Installation-Volets-roulants.html">Installation Volets roulants</a></li>
      


                                </ul>
                            </div>

                            

                        </div>
                    </div>

                    <!-- Left Section End -->
                </div>
            </div>
            <div class="divider"></div>
        </div>
    </div>
    <!-- Main Content end-->
    </div>


    <!-- Content End -->


    <!-- Footer Top Start -->
    <footer id="footer">
        <!-- Footer Top Start -->
        <div class="footer-top">
           <div class="container">
              <div class="row">

                 <div class="col-md-1">
                    <div class="col">

                       <a href="index.html"><img id="image-phone"
                             style="margin-bottom: 50px;" alt="Société de dératisation à Casablanca Maroc"
                             height="70" src="img/logo1.png" width="190" /></a>

                       <p>
                          <strong><span style="color: #FFF;"> <a
                                   href="index.html">SURVEILLANCE </a> </span></strong>Société de deratisation à Casablanca Maroc expérimentée et compétitive au service des particuliers, des professionnels et des collectivités, spécialisée dans la deratisation, desinsectisation et desinfection à Casablanca et partout au Maroc.
                       </p>

                    </div>
                 </div>

                 <div class="col-md-5">
                    <h4 style=" color: #ad0c1a; left: 500px;">NOS SERVICES</h4>

                 </div>


                 <div class="col-md-4">
                    <div class="col col-social-icons">


                       <table class="table-footer">
                          <tbody>
                             <tr>
                                <td><a class="a-tableau"
                                      href="Installation-Cameras-de-surveillance.html">Installation Cameras de surveillance
                                   </a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Contrôle-daccès.html">
                                      <il> Installation Contrôle d'accès
                                   </a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau"
                                      href="Installation-Porte-automatique.html">
                                      <il> Installation Porte automatique
                                   </a></td>
                             </tr>

                             <tr>
                                <td>
                                   <li><a class="a-tableau"
                                         href="Installation-Porte-blindée.html">
                                         Installation Porte blindée
                                      </a>
                                </td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-Coulissantes.html">
                                   Installation Porte Coulissantes</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-domotique.html">
                                      <il>Installation Porte domotique
                                   </a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-de-garage-domotique.html">
                                      <il>Installation Porte de garage domotique
                                   </a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-Rapide.html">
                                      <il>Installation Porte Rapide
                                   </a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-sectionnelle-industrielle.html">
                                      <il>Installation Porte sectionnelle industrielle
                                   </a></td>
                             </tr>
                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-sectionnelle-residentielle.html">
                                      <il>Installation Porte sectionnelle residentielle
                                   </a></td>
                             </tr>
                          </tbody>
                       </table>


                       <p></p>
                    </div>
                 </div>


                 <div class="col-md-3">
                    <div class="col">
                       <table class="table-footer">
                          <tbody>
                             <tr>
                                <td><a class="a-tableau" href="Installation-Porte-battantes.html">Installation Porte battantes</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Surveillance-renovation.html">
                                   Installation Surveillance renovation</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Système-dalarme.html">Installation Système d'alarme</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Système-de-pointage.html">Installation Système de pointage</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Système-incendie-anti-intrusion.html">Installation Système anti-intrusion</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Système-Anti-vol.html">Installation Système Anti-vol</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Système-de-télésurveillancee.html">Installation Système de télésurveillancee</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Volet-roulant-La-domotique.html">Installation Volet roulant La domotique</a></td>
                             </tr>

                             <tr>
                                <td><a class="a-tableau" href="Installation-Volets-roulants.html">Installation Volets roulants</a></td>
                             </tr>
                          </tbody>
                       </table>


                    </div>
                 </div>


                 <div class="col-md-2">
                    <div class="col">

                       <h4 style=" color: #ad0c1a;">CONTACT</h4>

                       <ul>
                          <li>Adresse : <span style="color: #fff !important;">2EME ETG, 39 Rue Tahar Sebti,
                                Casablanca 20000</span></li>
                          <hr>
                          <li>Mobile : <span style="color: #fff !important;"><a href="tel:+212 696-170-704">+212
                                   696-170-704</a></span></li>
                          <hr>
                          <li> <a href="">Email: example657gmail.com</a>
                          </li>
                          <hr>
                       </ul>

                       <h4 style=" color: #ad0c1a;">A PROPOS DE NOUS </h4>

                       <p>Notre Installation Cameras de surveillance vous apporte des solutions concrètes.
                       une organisation rigoureuse et fiable,
                          une équipe de qualité et des équipements performants vous garantissent efficace.
                       </p>
                       <a href="index1.html">
                          <u>Société Installation Cameras surveillance</u></a>

                    </div>
                 </div>

              </div>

              <hr />
              <div class="row">
                 <div class="col-lg-9 copyright">
                    &copy; Copyright 2014 - 2023 by <a
                       href="index1.html">EXAMPLE  </a>. Tous
                    droits réservés.
                 </div>

                 <div class="col-lg-3 footer-logo"></div>
              </div>
           </div>
        </div>
        <!-- Footer Bottom End -->
     </footer>

<!-- Mirrored from www.desinsectisation-deratisation-casablanca.com/devis-societe-deratisation.php by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Oct 2022 13:45:33 GMT -->

</html>