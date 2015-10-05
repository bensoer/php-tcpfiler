<?php
/**
 * Created by PhpStorm.
 * User: bensoer
 * Date: 01/10/15
 * Time: 8:16 PM
 */
?>


<!DOCTYPE html>
    <html>
        <head>
            <!--Import Google Icon Font-->
            <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

            <!-- Compiled and minified CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

            <!--Let browser know website is optimized for mobile-->
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        </head>
        <style>
            /*body{
                background: linear-gradient(246deg, #ba68c8, #b388ff , #e83114, #e814d7, #ff5722, #c3c62b, #4caf50, #ffeb3b );
                background-size: 1200% 1200%;

                -webkit-animation: AnimationName 55s ease infinite;
                -moz-animation: AnimationName 55s ease infinite;
                animation: AnimationName 55s ease infinite;
            }


            @-webkit-keyframes AnimationName {
                0%{background-position:58% 0%}
                50%{background-position:43% 100%}
                100%{background-position:58% 0%}
            }
            @-moz-keyframes AnimationName {
                0%{background-position:58% 0%}
                50%{background-position:43% 100%}
                100%{background-position:58% 0%}
            }
            @keyframes AnimationName {
                0%{background-position:58% 0%}
                50%{background-position:43% 100%}
                100%{background-position:58% 0%}
            }*/
        </style>

        <body id="gradient">

            <div class="container">


                <h1>The TCP Filer</h1>



                <div class="row">
                    <form class="col s12" method="POST" action="executeRequest.php" enctype="multipart/form-data">
                        <div class="card-panel z-depth-5">
                            <div class="row">
                                <div class="col s6">
                                    <h6>Enter the File Name to retrieve or be stored on the Server</h6>

                                    <div class="input-field col s6">
                                        <input id="file_name" name="file_name" type="text" class="validate">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <h6>Set The Mode of The Action you are doing</h6>
                                    <br>
                                    <div class="switch">
                                        <label>
                                            GET
                                            <input type="checkbox" name="mode_switch">
                                            <span class="lever"></span>
                                            SEND
                                        </label>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s6">
                                    <h6>If you are using the SEND mode, select a file to send</h6>
                                    <br>
                                    <div class="file-field input-field">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" name="file_upload">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" name="file_upload_text">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col s3 offset-s9">
                                    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>

                            </div>

                        </div>




                    </form>


                </div>

            </div>


            <!--Import jQuery before materialize.js-->
            <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
            <!-- Compiled and minified JavaScript -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>

            <script src="gradient-engine.js"></script>

        </body>
</html>