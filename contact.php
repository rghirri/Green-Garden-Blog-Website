<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHP/PHPMailer/src/Exception.php';
require 'vendor/PHP/PHPMailer/src/PHPMailer.php';
require 'vendor/PHP/PHPMailer/src/SMTP.php';

require 'includes/header.php';

$name = '';
$email = '';
$subject = '';
$message = '';
$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name    = $_POST['name'];
  $email   = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $errors = [];

    if ($name == '') {
        $errors[] = 'Please enter a name';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email address';
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    if ($message == '') {
        $errors[] = 'Please enter a message';
    }

    if (empty($errors)) {
      $mail = new PHPMailer(true);

        try {

          $mail->isSMTP();
          $mail->Host = SMTP_HOST;
          $mail->SMTPAuth = true;
          $mail->Username = SMTP_USER;
          $mail->Password = SMTP_PASS;
          $mail->SMTPSecure = 'tls';
          $mail->Port = 25;

          $mail->setFrom($email);
          $mail->addAddress('rayaa_ghirri@yahoo.com');
          $mail->addReplyTo($email);
          $mail->Name = $name;
          $mail->Subject = $subject;
          $mail->Body = $message;

          $mail->send();

          $sent = true;

        } catch (Exception $e) {

            $errors[] = $mail->ErrorInfo;

        }
    }
}

?>


<!-- Confirmation message -->
<?php if ($sent) : ?>
<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay__lighter">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/contact-us-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1>Thank You</h1>
  </div>
</div>
<!-- Hero Banner End  -->
<section class="wrapper  wrapper--narrow">
  <p>Your Message has been sent and someone will be contacting you soon!</p>
</section>
<?php else: ?>
<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay__lighter">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/contact-us-banner-1295x264-min.png" alt="" />
  </picture>

  <div class="hero-banner__title">
    <h1>Contact Us</h1>
  </div>
</div>
<!-- Hero Banner End  -->
<!-- Contact Form Start -->
<section class="wrapper  wrapper--narrow">
  <div class="mb-5">
    <h2>Contact form</h2>
    <p>I would love to here from you! Please fill in the following form with you query</p>
  </div>
  <!-- Validation -->
  <?php if (! empty($errors)) : ?>
  <ul>
    <?php foreach ($errors as $error) : ?>
    <li><?= $error ?></li>
    <?php endforeach; ?>
  </ul>
  <?php endif; ?>
  <form method="post" id="formContact">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input name="name" type="text" class="form-control" id="name" placeholder="name"
        value="<?= htmlspecialchars($name) ?>">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input name="email" type="email" class="form-control" id="emai" placeholder="name@example.com"
        value="<?= htmlspecialchars($email) ?>">
    </div>
    <div class="mb-3">
      <label for="subject" class="form-label">Subject</label>
      <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject"
        value="<?= htmlspecialchars($subject) ?>">
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Message</label>
      <textarea name="message" class="form-control" id="message" rows="3"
        placeholder="Message"><?= htmlspecialchars($message) ?></textarea>
    </div>
    <button class="btn mt-3 mx-2 add_article_btn">Send</button>
  </form>
  <!-- Contact Form End -->
</section>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>