<?php

require_once "./includes/config_session.inc.php";

$isLoggedIn = isset($_SESSION['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Instructors</title>
  <?php require_once "./components/global_css.php" ?>
  <link rel="stylesheet" href="css/instructors.css" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <!-- Navigation Header -->
  <?php require_once "./components/navbar.php" ?>

  <header class="header">
    <div class="header-content">
      <h1>INSTRUCTORS</h1>
    </div>
  </header>

  <main class="trainer-section">
    <!-- Card 1 -->
    <div class="trainer-card dark-card">
      <div class="trainer-text">
        <p>
          Jelli is a Certified Lagree Instructor and 200hr Certified Hatha
          Vinyasa Yoga Teacher. She has been using both movement and music as
          a way to release tension for more than a decade, and has been
          teaching group classes all over Sydney, such as in Lagree Fitness
          Australia and Virgin Active Australia. Jelli loves teaching
          beginners: "This is your practice of self-empowerment, self-love and
          mindful movement, for all body shapes, sizes, and backgrounds!"
          Whether you are seeking to de-stress or to get stronger or both,
          Jelli's classes will take you to that post-Lagree glow.
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Patricia Gatus" />
        <h2>JELLI JANTE</h2>
        <p>Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>

    <!-- Card 2 -->
    <div class="trainer-card light-card">
      <div class="trainer-text">
        <p>
          Its never too late to start! Set your goals, keep yourself
          motivated, and go at your own pace. Keep trying, keep pushing. A
          little progress is better than no progress at all.
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Sam Corrales" />
        <h2>JAI LAWAN</h2>
        <p>Yoga Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>

    <!-- Card 3 -->
    <div class="trainer-card light-card">
      <div class="trainer-text">
        <p>
          AG has been in the fitness industry as instructor since 2018 with a
          background of teaching indoor cycling. Doing Lagree was a love at
          first shake for him when he discovered how humbling and challenging
          yet euphoric the workout is, and it made him pursue it even more to
          be certified and to teach. Aside from being a coach, he is also a
          registered nurse and a full time Health IT professional in The
          Medical City where he leads a team revolutionizing how healthcare
          works.  He bring his passion for healthcare and change to fitness
          and movement, and he’s ready to celebrate with you what your body
          can do. #LagreeWithAG”
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Sam Corrales" />
        <h2>AG MOLINA</h2>
        <p>Yoga Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>

    <!-- Card 4 -->
    <div class="trainer-card dark-card">
      <div class="trainer-text">
        <p>
          Pao aka buffdad. He is Personal Fitness and wellness coach. He also
          have a deep love for martial arts, specifically jiu jitsu. Fitness
          for him is much more than self care. It is a tool for inspiring
          others to be the best version of themselves.  For him, the most
          important part of starting your fitness jounrey isn't on how hard
          you go in the workout room but it's how consistent you are in
          building healthy habits.  His clients can always expect good
          vibrations!  We're here to feel that shake and sweat. I'll be with
          them every step of the way.
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Sam Corrales" />
        <h2>PAOLO SALVADOR</h2>
        <p>Yoga Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>

    <!-- Card 5 -->
    <div class="trainer-card dark-card">
      <div class="trainer-text">
        <p>
          Pat is a fitness & nutrition coach and former basketball athlete.
          She has been using fitness & sports as movement and activity to keep
          her body kit, active & healthy. She enjoys teaching strength and
          resistance training, most specially to women, as she is a certified
          women's fitness specialist and pre & post natal trainer as well. 
          Pat’s goal is to make every person fell good, strong, health,
          empowered in all aspects of one's life through holistic fitness. 
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Sam Corrales" />
        <h2>PATRICIA GATUS</h2>
        <p>Yoga Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>

    <!-- Card 6 -->
    <div class="trainer-card light-card">
      <div class="trainer-text">
        <p>
          If you're looking for a boost of energy and good vibes, Sam is the
          instructor for you! She is an ACE Certified Group Fitness Instructor
          and former member of the UP Pep Squad, winning multiple awards in
          the local and international scene. With her background in dance,
          gymnastics and cheerleading, she can guide you through each movement
          with emphasis on proper form and tempo. For her, Lagree is a form of
          meditation and a way to unlock physical and mental strength. Expect
          to be challenged yet fulfilled after a #SamCore class 
        </p>
      </div>
      <div class="trainer-image">
        <img src="assets/back.jpg" alt="Sam Corrales" />
        <h2>SAM CORRALES</h2>
        <p>Yoga Instructor</p>
      </div>
      <button class="view-btn">VIEW</button>
    </div>
  </main>

  <?php require_once "./components/footer.php" ?>
  <?php require_once "./components/navbar_scripts.php" ?>
</body>

</html>