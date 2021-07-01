<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/header.php';

$email = '';
$subject = '';
$message = '';
$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $errors = [];

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
            $mail->Host = 'your mail server';
            $mail->SMTPAuth = true;
            $mail->Username = 'username';
            $mail->Password = 'password';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sender@example.com');
            $mail->addAddress('recipient@example.com');
            $mail->addReplyTo($email);
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

<!-- Hero Banner Start  -->
<div class="hero-banner container-fluid container-xl">
  <picture class="hero-banner__overlay">
    <img class="hero-banner__overlay-image img-fluid" src="/uploads/Green-Garden-hero-banner-1295x264-min.png" alt="" />
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
    <p>We would love to here from you! Please fill in the following form with you query</p>
  </div>
  <!-- Confirmation message -->
  <?php if ($sent) : ?>
  <p>Message sent.</p>
  <?php else: ?>
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
  <?php endif; ?>
</section>
<!-- Contact Form End -->

<?php require 'includes/footer.php'; ?>