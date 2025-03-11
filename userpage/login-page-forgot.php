<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FlexiFit</title>
    <link rel="stylesheet" href="css/login-page.css" />
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
        <a href="signup-page-info.html">SIGN UP</a>
      </div>
      <div class="form-container">
        <h2>FORGOT PASSWORD</h2>
        <form>
          <input type="email" placeholder="Email" autocomplete="off" required />
          <input
            type="text"
            placeholder="Username"
            autocomplete="off"
            required
          />
          <button
            type="submit"
            onclick="window.location.href='login-page-email.html'"
          >
            RESET PASSWORD
          </button>
          <p>
            Go back to <a href="login-page.html" class="reset-link">LOGIN</a>
          </p>
        </form>
      </div>
    </div>
  </body>
</html>
