<!-- Section-->
<style>
    #main-header {
        border: none;
        /*height: 90vh;*/
    }

    .book-cover {
        object-fit: contain !important;
        height: auto !important;
    }

    #myCarousel {
        height: 100%;
        width: 100%;
        position: relative;
    }

    /* .carousel-indicators {
    margin-bottom: 8px;
  } */

    .carousel-indicators>li {
        width: 10px;
        height: 10px;
        border-radius: 100%;

    }

    .carousel-indicators li {
        width: 10px;
        height: 10px;
        background-color: gray;
        bottom: 100%;
        position: center;
        bottom: -50px;
        border-radius: 100%;
    }

    .carousel-indicators .active {
        background-color: black;
    }

    .carousel-inner {
        height: 100%;
        position: relative;
        border-radius: 30px;
        text-overflow: ellipsis;
        max-height: 500px;
        overflow-y: auto;
    }

    .carousel-item {
        text-align: center;
        position: relative;
    }

    .parent {
        min-height: 500px;
        position: relative;
    }

    .carousel-item img {
        display: block;
        margin: auto;
        height: 100%;
        width: 100%;
        border-radius: 30px;

    }

    .carousel-control-prev-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
    }

    .carousel-control-next-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23000' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
    }

    .carousel-control-prev {
        opacity: 0.5;
        width: 100px;
    }


    .carousel-control-next {
        opacity: 0.5;
        width: 100px;
    }

    .container {
        border-radius: 40px;
        margin-bottom: 10px;
        /*max-height: 700px;*/
        overflow: hidden;
        background: #f0f0f0;
    }

    /*.marquee {*/
    /*    animation: animate 5s linear infinite;*/
    /*    display: inline-block;*/
    /*    padding-left: 100%;*/
    /*}*/

    @keyframes animate {
        100% {
            transform: translate(-100%, 0);
        }
    }

    .content-header {
        background-color: #eeedeb;
    }

    #headline {
        /* border: 3px solid yellow; */
        /* background-color: lightgreen; */
        height: 100%;
    }

    video {
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
    }

    .video-wrapper {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header {
        position: relative;
        color: yellow;
        text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.6);
        font-family: 'Lobster', 'cursive';
    }

    h3 {
        font-family: 'Anton', sans-serif;
    }

    .carousel-container {
        height: 90%;
        width: 90%;
    }

    img {
        image-rendering: 'high-quality';
    }


    /* .carousel-content {
    position: absolute;
    bottom: 10%;
    left: 5%;
    z-index: 20;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, .6);
  } */
    #carousel_image {
        width: 100px;
        height: 100px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        bottom: 10%;
    }

    .carousel-inner::-webkit-scrollbar {
        width: 3px;
    }

    .carousel-inner::-webkit-scrollbar-thumb {
        background-color: gray;
    }

    .reveal {
        position: relative;
        transform: translateY(150px);
        opacity: 0;
        transition: 1s all ease;
    }

    .reveal.active {
        transform: translateY(0);
        opacity: 1;
    }

    @media (max-width: 900px) {
        #carousel {
            padding: 0 auto;
            margin: 0 auto;
            margin-top: 90px;
        }

        iframe {
            width: 100%;
            margin: 0 auto;
        }

        #main-header {
            border: none;
            height: 50vh;
        }

    }

    #announcement {
        margin: 20px auto;
    }
</style>

<!-- Header-->
<header class="bg-dark py-5" id="main-header">
    <div class="container px-4 px-lg-5 my-5" style="border:none; background: none;">
        <div class="text-center text-white">
            <h4 class="display-5  fw-bolder">Halina't tangkilikin ang sariling atin!<br>
                Tara na sa CvSU Agri-Eco Tourism Park!</h4>
        </div>
    </div>
</header>

<div class="container col-lg-11 py-2 my-4" style="border-radius: 30px;">
    <div class="row flex-lg-row py-5">
        <div class="col-lg-8" id="carousel-container">
            <div class="card-header" style="background: lightgreen;">
                <h3>ANNOUNCEMENT</h3>
            </div>
            <div id="newscarousel" class="carousel slide container-fluid" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php

                    $query = $conn->query("SELECT * FROM `headlines`");
                    $countrow = $query->num_rows;
                    if ($countrow > 0) {
                        for ($i = 0; $i < $countrow; $i++) {
                    ?>
                            <li data-target="#newscarousel" data-slide-to="<?php echo $i ?>" <?php if ($i === 0) {
                                                                                                    echo "class='active'";
                                                                                                } ?>></li>
                        <?php } ?>
                </ol>
                <div class="carousel-inner" style='overflow-y: auto;'>
                    <?php
                        $x = 0;
                        while ($row = mysqli_fetch_array($query)) {
                    ?>
                        <div class="carousel-item <?php if ($x === 0) {
                                                        echo "active";
                                                    } ?>">
                            <div class="parent justify-content-center pt-2">
                                <h2><b><?php echo $row['title']; ?></b></h2>
                                <h4><?php echo stripslashes(html_entity_decode($row['announcements'])); ?></h4>
                            </div>
                        </div>
                    <?php $x++;
                        } ?>


                    <a class="carousel-control-prev" href="#newscarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#newscarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon " aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php } else {
                    } ?>

            </div>
        </div>
        <div class="col-10 col-sm-8 col-lg-4" id="carousel">
            <div id="myCarousel" class="carousel slide container-fluid" data-ride="carousel" data-interval="3000">
                <div class="card-header" style="background: lightgreen;">
                    <h3>FEATURED PHOTO</h3>
                </div>
                <div>
                    <ol class="carousel-indicators">
                        <?php

                        $query = $conn->query("SELECT * FROM `image` where status = 1");
                        $countrow = $query->num_rows;
                        if ($countrow > 0) {
                            for ($i = 0; $i < $countrow; $i++) {
                        ?>
                                <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>" <?php if ($i === 0) {
                                                                                                    echo "class='active'";
                                                                                                } ?>></li>
                            <?php } ?>
                    </ol>

                    <div class="carousel-inner" style='overflow-y: auto;'>
                        <?php
                            $x = 0;
                            while ($row = mysqli_fetch_array($query)) {
                        ?>
                            <div class="carousel-item <?php if ($x === 0) {
                                                            echo "active";
                                                        } ?>">
                                <div class="parent justify-content-center pt-2">
                                    <img src="<?php echo base_url . ($row['upload_path'] . '/' . $row['image_name']) ?>" style="max-width:400px; max-height:300px;" alt="Nothing to see here.">
                                    <div>
                                        <h5 style="color: black;"><?php echo stripslashes(html_entity_decode($row['description'])); ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php $x++;
                            } ?>


                        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon " aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    <?php } else {
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container reveal col-lg-11 px-4 py-2 " style="border-radius: 30px;">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-lg-6">
            <h2 class="display-5 fw-bold lh-1 mb-3">Halina't tangkilikin ang sariling atin! 🍁🌿 <br>
                Tara na sa CvSU Agri-Eco Tourism Park!</h2>
            <p class="lead">Looking for a place to enjoy holidays around lush sceneries?
                Tara na sa CvSU Agri-Eco Tourism Park!
                Here, you'll find vast jog trails, Al Fresco dining, family villas for your overnight stay, pasalubong items and more!</p>
        </div>
        <div class="col-10 col-sm-8 col-lg-6">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/sPqXEUiwrxU?autoplay=1&mute=1&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="container reveal col-lg-11 px-4 py-2 my-4 " id="featured-3" style="text-align: center; border-radius: 30px;">
    <h3>Explore the Agri Eco Park Website Features!</h3>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
        <div class="feature col">
            <div class=" d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                <img class="bd-placeholder-img" width="50%" height="70%" src="https://i.ibb.co/QdVnYW9/cacao.jpg" style="border-radius: 50%;">
            </div>
            <h2>Map</h2>
            <p>The Map feature of the Agri-Eco Park website portrays map of the park.
                This map contains several points appointing some of the landmarks that can be seen at the park.
            </p>
            <p><a class="btn btn-secondary" href="<?php echo base_url . ('./?p=tour'); ?>">View details &raquo;</a></p>
        </div>
        <div class="feature col">
            <div class=" d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                <img class="bd-placeholder-img" width="50%" height="70%" src="https://i.ibb.co/y51JjFN/path.jpg" style="border-radius: 50%;">
            </div>
            <h2>Retail Market</h2>
            <p>Choose different products from diiferent partner organizations of the university!
                Support our local farmers and entrepreneurs by buying the products they sell in the university!
            </p>
            <p><a class="btn btn-secondary" href="<?php echo base_url . ('./?p=portal'); ?>">View details &raquo;</a></p>
        </div>
        <div class="feature col">
            <div class=" d-inline-flex align-items-center justify-content-center fs-2 mb-3">
                <img class="bd-placeholder-img" width="50%" height="70%" src="https://i.ibb.co/qjWBYq2/lagoon2.jpg" style="border-radius: 50%;">
            </div>
            <h2>Reservation</h2>
            <p>Enjoy yourself at the Agri-Eco Tourism Park! Choose different packages offered by the park and let yourself
                explore the beauty of nature! <br> Choose Now! </p>
            <p><a class="btn btn-secondary" href="<?php echo base_url . ('./?p=packages'); ?>">View details &raquo;</a></p>
        </div>
    </div>
</div>

<script>
    function reveal() {
        var reveals = document.querySelectorAll(".reveal");

        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var elementTop = reveals[i].getBoundingClientRect().top;
            var elementVisible = 150;

            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            } else {
                reveals[i].classList.remove("active");
            }
        }
    }

    window.addEventListener("scroll", reveal);
</script>