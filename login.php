<?php
session_start();
if (isset($_SESSION['unique_id'])) { // if user is already logged in
  header('location: users.php');
}
?>
<?php include_once 'header.php' ?>

<body>
  <div class="wrapper">
    <section class="form login">
      <header>ChatBox</header>
      <form action="#">
        <div class="error-txt"></div>
        <div class="field input">
          <label>Email</label>
          <input type="email" name="email" placeholder="Enter your email address">
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password">
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup Now</a></div>
    </section>
  </div>
</body>

<script src="./javascript/password-show-hide.js"></script>
<script src="./javascript/login.js"></script>

</html>