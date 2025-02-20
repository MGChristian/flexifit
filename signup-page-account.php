<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flexifit</title>
  <link rel="stylesheet" href="css/signup-page.css" />
  <link rel="icon" href="loginimages/logo.png" />
</head>

<body>
  <div class="left-section">
    <div class="branding">
      <a href=""><img src="loginimages/logo.png" alt="" /></a>
      <h1>FLEXIFIT</h1>
    </div>
    <div class="motto">
      <h2>
        YOU CAN HAVE <br />
        RESULT OR EXCUSES <br />
        NOT BOTH
      </h2>
      <p>Our goal is to help you achieve the body of your dreams.</p>
    </div>
  </div>
  <div class="right-section">
    <div class="nav">
      <a href="#">ABOUT</a>
      <span>|</span>
      <a href="login-page.html">LOG IN</a>
    </div>
    <div class="form-container">
      <div class="progress-bar">
        <div class="step"></div>
        <div class="line"></div>
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step"></div>
      </div>
      <h2>SIGN UP</h2>
      <form>
        <input type="text" placeholder="Username" required />
        <input type="password" placeholder="Password" required />
        <input type="password" placeholder="Confirm Password" required />

        <div class="divider">EMERGENCY CONTACT</div>

        <input type="text" placeholder="Contact Name" required />
        <input type="text" placeholder="Contact Number" required />
        <button
          type="submit"
          onclick="window.location.href='signup-page-otp.php'">
          CONTINUE
        </button>
      </form>
    </div>
  </div>
</body>

</html>