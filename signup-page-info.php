<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FlexiFit</title>
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
        <div class="step active"></div>
        <div class="line"></div>
        <div class="step"></div>
        <div class="line"></div>
        <div class="step"></div>
      </div>
      <h2>SIGN UP</h2>
      <form>
        <input
          name="firstName"
          type="text"
          placeholder="First name"
          autocomplete="off"
          id="firstName"
          required />
        <input
          name="lastName"
          type="text"
          placeholder="Last name"
          autocomplete="off"
          id="lastName"
          required />
        <input
          name="birthdate"
          type="date"
          autocomplete="off"
          id="birthdate"
          required />
        <input name="email" type="email" placeholder="Email" autocomplete="off" id="email" required />
        <div class="phone">
          <span>+63</span>
          <input name="contactNumber" type="number" placeholder="Contact Number" id="contactNumber" required />
        </div>
        <select name="gender" id="gender" required>
          <option value="" disabled selected style="color: #ccc">
            Gender
          </option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
        <button
          type="submit"
          onclick="window.location.href='signup-page-account.php'">
          CONTINUE
        </button>
      </form>
    </div>
  </div>
  <script src="js/signup.js"></script>
</body>

</html>