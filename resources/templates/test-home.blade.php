{{--
  Template Name: Home test
--}}


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  <title>Home Page</title>
</head>
<body>

    <section class="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">
          <div class="container-fluid m-3">
            <a class="navbar-brand" href="#"><img src="assets/logo.svg" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">Premast Templates</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Premast Plus</a>
                </li>
                <ul class="contact">
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#">Contact Us</a>
                  </li>
                </ul>
              </ul>
            </div>
          </div>
        </nav>

        <?php

    $home = pods( 'home_page' );
    $headline = $home->display( 'headline' );
    $subheadline = $home->display('sub_headline');
    $postid = $home->field('blog_posts');

    if ( ! empty( $postid ) ) {
foreach ( $postid as $post ) {

    $id = $post[ 'ID' ];
    echo $id;


}
    }

    echo $headline;
    echo $subheadline;
    echo $postid->ID;
    print_r($postid->ID);

//    print_r($home);


     ?>

        <div class="heading text-center">
          <h1>{{ $headline }}</h1>
          <h5>{{ $subheadline }}</h5>
          <button type="button" class="btn btn-primary">Explore</button>
        </div>
        <div class="blog">
        </div>
    </section>
    <!-- <section class="templates text-center mt-5">
      <img src="assets/templates.svg">
      <h6>Introducing plenty of ready-made presentation templates that are built to fit <br>all areas your work may need.</h6>
    </section> -->


  </body>
</html>







































<section class="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
      <div class="container-fluid m-3">
        <a class="navbar-brand" href="#"><img src="assets/logo.svg" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Premast Templates</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="#">Premast Plus</a>
            </li>
            <ul class="contact">
              <li class="nav-item">
                <a class="nav-link active" href="#">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Contact Us</a>
              </li>
            </ul>
          </ul>
        </div>
      </div>
    </nav>
    <div class="heading text-center">
      <h1>A Whole New World Built For <br>Presentations</h1>
      <h5>Better quality, bigger options, faster outcomes and sleeker designs!</h5>
      <button type="button" class="btn btn-primary">Explore</button>
    </div>
    <div class="blog">
    </div>
</section>
<!-- <section class="templates text-center mt-5">
  <img src="assets/templates.svg">
  <h6>Introducing plenty of ready-made presentation templates that are built to fit <br>all areas your work may need.</h6>
</section> -->


</body>


<style>

nav.navbar.navbar-expand-lg.navbar-light.bg-light {
  background-color: transparent!important;
}

section.header {
  background-image: url(assets/bg.png);
  background-size: cover;
  background-repeat: no-repeat;
}
ul.contact {
  list-style: none;
  display: flex;
  position: absolute;
  right: 7%;
}
a.navbar-brand {
  padding-right: 90px;
}
.navbar-expand-lg .navbar-nav .nav-link {
  padding-right: 2.5rem!important;
}

a.nav-link.active {
  font-family: 'Roboto' , sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 19px;
  line-height: 22px;
  letter-spacing: 0.015em;
  color: #1B1B1E!important;
}
.heading h1{
 font-family: 'Roboto' , sans-serif;
 font-style: normal;
 font-weight: bold;
 font-size: 72px;
 line-height: 84px;
 text-align: center;
 text-transform: capitalize;
 color: #282F39;
 margin-top: 60px;
}

.heading h5{
font-family:'Roboto' , sans-serif;
 font-style: normal;
 font-weight: normal;
 font-size: 24px;
 line-height: 145.69%;
 text-align: center;
 color: #4B4D51;
 padding: 30px 0 60px 0;
}
button.btn.btn-primary {
  background: #282F39;
  border-radius: 15px;
  padding: 14px 70px 15px 72px;
  font-family:'Roboto' , sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 18px;
  line-height: 145.69%;
  color: #FFFFFF;
  margin-bottom:50px;
}
.btn-primary {
  border-color:transparent!important;
}
.btn-primary .btn:focus {
  box-shadow: none!important;
}
.btn-primary:focus {
  box-shadow: none!important;
}
.templates h6 {
font-family: 'Roboto' , sans-serif;
font-style: normal;
font-weight: normal;
font-size: 24px;
line-height: 140.7%;
text-align: center;
color: #595E65;
padding-top:30px;
}

</style>
