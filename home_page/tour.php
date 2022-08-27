<head>
    <style>
        .map {
            position: relative;
        }

        .imageMap .area {
            z-index: 1;
            position: relative;
        }

        /* .area .content::before {
            content: '';
            position: relative;
            width: 30px;
            height: 30px;
            max-height: 100px;
            background: #ffff;
            transform: rotate(45deg);
        } */

        /* .area:hover .content {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(0px);
        } */

        /* .popup {
            position: absolute;
            z-index: 3;
            top: 0px;
            left: 0px;
            display: none;
            background-color: #dd8;
            border: 1px solid;
            width: 300px;
            height: 300px;
        } */

        .content img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .content img:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */


        /* Modal Content (image) */


        /* Caption of Modal Image */
        #caption {
            margin: auto;
            font-size: 50px;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        img p {
            margin: auto;
            font-size: 20px;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            /* padding: 5px; */
            height: 200px;
            max-height: 500px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */


        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        .area .content {
            position: absolute;
            /* bottom: 400px; */
            width: 400px;
            background: #ffff;
            padding: 10px;
            text-align: center;
            box-sizing: border-box;
            border-radius: 20px;
            visibility: hidden;
            opacity: 0;
            transition: .5s;
            transform: translateX(-50%) translateY(-50px);
        }

        .area .content img {
            width: 100%;
            max-width: 300px;
            height: 20%;
            border-radius: 15px;
            max-height: 300px;
        }

        .area .content::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 30px;
            max-height: 100px;
            background: #ffff;
            transform: rotate(45deg);
        }

        .area:hover .content {
            visibility: visible;
            opacity: 1;
            transform: translateX(-50%) translateY(0px);
        }
    </style>
</head>


<div class="map">
    <img name="parkMap" src="<?php echo base_url . 'AGRIECOMAP.gif' ?>" id="image" usemap="#image-map" border="0" width="100%">


    <map name="image-map" class="imageMap">
        <div class="area">
            <area target="" shape="rect" coords="218, 123, 254, 168" title="Kubo">
            <div class="content" id="kubo">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/k0ZVxPF/kubos.jpg" alt="Kapihan sa Kubo <br>"></center>
                <h3>Kapihan sa Kubo</h3>
                <p>
                    Feel the breeze of nature as you rest at the Eco Park Kubo!
                </p>
            </div>
        </div>
        <!-- <a href="https://ibb.co/XC8YMkc"><img src="https://i.ibb.co/6WBXLJj/suka.jpg" alt="suka" border="0"></a> -->
        <div class="area">
            <area target="" shape="rect" coords="266, 195, 300, 222" title="Bee">
            <div class="content" id="bee">
                <center><img onclick="myFunc(this)" id="myImg2" src="https://i.ibb.co/tJ7cSns/bee.jpg" alt="Agri-Eco Park Bee Program <br>"></center>
                <h3>Bee Program</h3>
                <p>
                    Know more about the fascinating bees residing at Park!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="184, 214, 215, 232" title="Bridge">
            <div class="content" id="bridge">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/yYV1qSf/bridge.jpg" alt="Hanging Bridge"></center>
                <h3>Hanging Bridge</h3>
                <p>
                    Feel the suspense as you walk through the Eco Park Hanging Bridge!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="155, 211, 180, 240" title="Hagdan">
            <div class="content" id="hagdan">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/zZ8gYfL/hagdan.jpg" alt="Hagdan ng Karunungan"></center>
                <h3>Hagdan ng Karunungan</h3>
                <p>
                    Learn more about the University's history as youwalk the path of knowledge!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="185, 268, 222, 292" title="Gate">
            <div class="content" id="gate">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/L5dLzsR/gate2.jpg" alt="Eco Park Entrance Gate"></center>
                <h3>Eco Park Entrance Gate</h3>
                <p>
                    This is where the fun begins!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="175, 304, 205,  333" title="Parking">
            <div class="content" id="parking">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/VYWrmyj/logo.jpg" alt="Parking Lot"></center>
                <h3>Parking Lot</h3>
                <p>

                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="192, 352, 233, 429" title="Lagoon">
            <div class="content" id="lagoon">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/qjWBYq2/lagoon2.jpg" alt="Lagoon"></center>
                <h3>Lagoon</h3>
                <p>
                    Enjoy the view!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="353, 303, 379, 324" title="Charms">
            <div class="content" id="charms">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/YDnQwBy/charms.jpg" alt="Charms"></center>
                <h3>Charms</h3>
                <p>
                    Learn about charms!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="478, 345, 500, 379" title="SPRINT">
            <div class="content" id="sprint">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/7pT07V4/sprint.jpg" alt="SPRINT Center"></center>
                <h3>SPRINT</h3>
                <p>
                    SPRINT Center produces best quality Kaong products!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="414, 71, 430, 89" title="Livestock">
            <div class="content" id="livestock">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/VSNrXxG/livestock.jpg" alt="Livestock"></center>
                <h3>Livestock</h3>
                <p>

                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="436, 79, 451, 92" title="Ornamental">
            <div class="content" id="ornamental">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/CK0srLj/ornamental.jpg" alt="Ornamental"></center>
                <h3>Ornamental</h3>
                <p>
                    Heal!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="431, 56, 449, 72" title="Aviary">
            <div class="content" id="aviary">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/VYWrmyj/logo.jpg" alt="Aviary"></center>
                <h3>Aviary</h3>
                <p>
                    Birdie!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="458, 72, 483, 89" title="Villa">
            <div class="content" id="villa">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/CvwQgp8/villa2.jpg" alt="Eco Park Villa"></center>
                <h3>Eco Park Villa</h3>
                <p>
                    Sleep!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="487, 60, 511, 82" title="Dragonfruit">
            <div class="content" id="dragonfruit">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/Kbg3fQj/dragonfruit.jpg" alt="Dragonfruit Farm"></center>
                <h3>Dragonfruit Farm</h3>
                <p>
                    Eat!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="473, 29, 509, 57" title="Macapuno">
            <div class="content" id="macapuno">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/3rCDLQX/macapuno.jpg" alt="Macapuno"></center>
                <h3>Macapuno</h3>
                <p>
                    Produce!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="525, 52, 546, 85" title="Fishery">
            <div class="content" id="fishery">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/6yKtrwR/fish.jpg" alt="Fishery"></center>
                <h3>Fishery</h3>
                <p>
                    Fish!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="500, 97, 525, 118" title="Ecotrail">
            <div class="content" id="ecotrail">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/4ds5BZp/ecotrail.jpg" alt="Ecotrail"></center>
                <h3>NCRDEC Ecotrail</h3>
                <p>
                    Explore!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="531, 163, 559, 190" title="Central">
            <div class="content" id="central">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/VYWrmyj/logo.jpg" alt="Central Experiment Station"></center>
                <h3>Central Experiment Station</h3>
                <p>
                    Research!
                </p>
            </div>
        </div>

        <div class="area">
            <area target="" shape="rect" coords="609, 186, 645, 219" title="NCRDEC">
            <div class="content" id="ncrdec">
                <center><img onclick="myFunc(this)" id="myImg" src="https://i.ibb.co/jVggHr4/ncrdec.jpg" alt="NCRDEC"></center>
                <h3>NCRDEC</h3>
                <p>
                    Coffee Time!
                </p>
            </div>
        </div>


        <!-- <area target="" shape="rect" coords=" 204, 245, 233, 264"  title="Info Center"> -->

    </map>
</div>

<!-- The Modal -->
<div id="myModal" class="modal" style=" 
            display: none;
           
           position: fixed;
           
           z-index: 1;
         
           padding-top: 100px;
         
           left: 0;
           top: 0;
           width: 100%;
         
           height: 100%;
         
           overflow: auto;
        
           background-color: rgb(0, 0, 0);
         
           background-color: rgba(0, 0, 0, 0.9);
          
          ">
    <span class="close" style="position: absolute;
                top: 15px;
                right: 35px;
                color: #f1f1f1;
                font-size: 40px;
                font-weight: bold;
                transition: 0.3s;" onclick="modal.style.display = 'none'">&times;</span>
    <img class="modal-content" id="img01" style="margin: auto;
                display: block;
                width: 80%;
                max-height: 500px;
                max-width: 700px;">
    <div id="caption"></div>
    <div class="modal-body"></div>
</div>

<script>
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");

    function myFunc(el) {
        var ImgSrc = el.src;
        var altText = el.alt;
        modal.style.display = "block";
        modalImg.src = ImgSrc;
        captionText.innerHTML = altText;
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    // Pop-up Coordinates
    var d = document.getElementById('kubo');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('bee');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('bridge');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('hagdan');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('gate');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('parking');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('lagoon');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('charms');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('sprint');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('livestock');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('ornamental');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('aviary');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('villa');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('dragonfruit');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('macapuno');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('fishery');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('ecotrail');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('central');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';

    var d = document.getElementById('ncrdec');
    d.style.position = "fixed";
    d.style.left = 50 + '%';
    d.style.bottom = 0 + '%';
</script>


<!-- JavaScript Bundle with Popper -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url . 'js/imageMapResizer.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url . 'js/imageMapResizer.js' ?>"></script>

<script type="text/javascript">
    $('map').imageMapResize();

    // When the user clicks on div, open the popup
    // function myFunction() {
    //     var popup = document.getElementById("myPopup");
    //     popup.classList.toggle("show");
    // }

    // function secondFunction() {
    //     var popup = document.getElementById("myPopup");
    //     popup.classList.toggle("show");
    // }
</script>