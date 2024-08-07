<?php
include 'connect.php';
$dept = $_GET['dept'];
$year = $_GET['year'];

if ($year == '2027') $years = 1;
elseif ($year == '2026') $years = 2;
elseif ($year == '2025') $years = 3;
elseif ($year == '2024') $years = 4;

if ($dept == 'CSE') {
    $fdept = "COMPUTER SCIENCE & ENGINEERING";
} elseif ($dept == 'ECE') {
    $fdept = "ELECTRONICS & COMMUNICATION ENGINEERING";
} elseif ($dept == 'EEE') {
    $fdept = "ELECTRICAL & ELECTRONICS ENGINEERING";
} elseif ($dept == 'MECH') {
    $fdept = "MECHANICAL ENGINEERING";
} elseif ($dept == 'CIVIL') {
    $fdept = "CIVIL ENGINEERING";
} elseif ($dept == 'IT') {
    $fdept = "INFORMATION TECHNOLOGY";
} elseif ($dept == 'CSBS') {
    $fdept = "COMPUTER SCIENCE & BUSINESS SYSTEMS";
} elseif ($dept == 'CSD') {
    $fdept = "COMPUTER SCIENCE & DESIGN";
} elseif ($dept == 'AIML') {
    $fdept = "ARTIFICIAL INTELLIGENCE & MACHINE LEARNING";
} elseif ($dept == 'AIDS') {
    $fdept = "ARTIFICIAL INTELLIGENCE & DATA SCIENCE";
} elseif ($dept == 'CSIT') {
    $fdept = "COMPUTER SCIENCE & INFORMATION TECHNOLOGY";
} elseif ($dept == 'CIC') {
    $fdept = "IOT & CYBER SECURITY INCLUDING BLOCK CHAIN TECHNOLOGY";
}

?>
<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title><?php echo $years . " / 4 - " . $dept ?> - SRKR SPELLBEE LEADERBOARD</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">

    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-">

    <link rel="shortcut icon" href="favicon.ico">
    <!-- Fonts START -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Pathway+Gothic+One|PT+Sans+Narrow:400+700|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
    <!-- Fonts END -->
    <!-- Global styles BEGIN -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Global styles END -->
    <!-- Page level plugin styles BEGIN -->
    <link href="assets/pages/css/animate.css" rel="stylesheet">
    <link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
    <!-- Page level plugin styles END -->
    <!-- Theme styles BEGIN -->
    <link href="assets/pages/css/components.css" rel="stylesheet">
    <link href="assets/pages/css/slider.css" rel="stylesheet">
    <link href="assets/onepage/css/style.css" rel="stylesheet">
    <link href="assets/onepage/css/style-responsive.css" rel="stylesheet">
    <link href="assets/onepage/css/themes/red.css" rel="stylesheet" id="style-color">
    <link href="assets/onepage/css/custom.css" rel="stylesheet">
    <!-- Theme styles END -->


    <style type='text/css'>
        .blink {
            animation: blink-animation 3s steps(5, start) infinite;
            -webkit-animation: blink-animation 3s steps(5, start) infinite;
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        @-webkit-keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        td,
        th {
            padding: 5px;
            font-size: 13px;
        }

        /* Change the color of visited links */
        a:visited {
            color: #FFFFFF;
            /* Change to your desired color */
        }

        /* Change the color of links when hovered over */
        a:hover {
            color: rgb(201, 30, 62);
            /* Change to your desired color */
        }

        /* Change the color of active links (when clicked) */
        a:active {
            color: #FFFFFF;
            /* Change to your desired color */
        }

        /* Change the default link color */
        a {
            color: #FFFFFF;
            /* Change to your desired color */
        }
    </style>

</head>
<!--DOC: menu-always-on-top class to the body element to set menu on top -->

<body class="menu-always-on-top">

    <!-- Header BEGIN -->
    <?php include "header.php"; ?>
    <!-- Header END -->

    <!-- About block BEGIN -->
    <div class="about-block content content-center" id="about">
        <div class="container">
            <br>
            <h2><strong><b><?php echo $years . " / 4 - " . $dept; ?> LEADERBOARD</b></strong>
                <br><?php echo $fdept; ?>
            </h2>
        </div>
    </div>
    <!-- About block END -->
    <div class="valign-center-elem">
        <h2 align='center'>
            <img src="assets/onepage/img/portfolio/dept/<?php echo strtolower($dept); ?>.jpg" alt="<?php echo $fdept ?>" class="img-responsive">
        </h2>
    </div>

    <!-- Facts block BEGIN -->
    <div class="facts-block content content-center" id="a">
        <?php
        $sections = mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = '$dept' and `place` = '$year' GROUP BY `section`");
        $total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = '$dept' and `place` = '$year'"));
        $deptleader = mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = '$dept' and `place` = '$year' ORDER BY `points` DESC , `lastseen` DESC");
        ?>
        <h2>TOTAL REGISTRATIONS FROM <?php echo $dept; ?> : <?php echo $total; ?></h2>
        <div class="container">
            <div class="row">
                <?php while ($section_details = mysqli_fetch_assoc($sections)) { 
                    $noofreg = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `department` = '$dept' and `place` = '$year' and `section` = '{$section_details['section']}'")); ?>
                    <a href="section_leader_board.php?year=<?php echo $year.'&dept='. $dept . '&sec='. $section_details['section'] ?>">
                        <div class="col-md-3 col-sm-3 col-xs-6">
                            <div class="item">
                                <strong><?php echo $noofreg; ?></strong>
                                <?php echo "<span style='font-size:28px;'>".$section_details['section'] ?></span><br> SECTION
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- Facts block END -->

    <!-- Team block BEGIN -->
    <div class="team-block content content-center margin-bottom-40" id="team">
        <div class="container">
            <h2><?php echo $dept; ?> <strong>Leaderboard</strong></h2>
            <h4>The Leader Board has been generated for all participants who played from <strong><?php echo $dept; ?></strong> .<br>
                The Maximum score <strong>3000</strong>
            </h4>

            <div class="col-md-12">
                <center>
                    <table style='background-color:#FFFFFF;text-align:center;' border='1' cellspacing='1' cellpadding='3'>
                        <tr bgcolor='#DC143C' style='color:#FFFFFF;text-align:center;text-align:center;'>
                        <th>S.NO</th>
                            <th>ROLL NUMBER</th>
                            <th>STUDENT NAME</th>
                            <th>YEAR</th>
                            <th>SCORE</th>
                            <th>SECTION. RANK</th>
                            <th>DEPT. RANK</th>
                            <th>YEAR RANK</th>
                            <th>OVERALL RANK</th>
                        </tr>

                        <?php
                        $sino = 1;

                        while ($lbord = mysqli_fetch_assoc($deptleader)) {
                            $deptrank = 1;
                            $sectionrank = 1;
                            $yearrank = 1;
                            $overall = 1;
                            $overallrank = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `points` DESC , `lastseen` DESC");    
                            $sectionranks = mysqli_query($conn, "SELECT `pid` FROM `users` where `department` = '$dept' and `place` = '$year' and `section` = '{$lbord['section']}' ORDER BY `points` DESC , `lastseen` DESC");
                            $deptranks = mysqli_query($conn, "SELECT `pid` FROM `users` where `department` = '$dept' ORDER BY `points` DESC , `lastseen` DESC");
                            $yearranks = mysqli_query($conn, "SELECT `pid` FROM `users` where `place` = '$year' ORDER BY `points` DESC , `lastseen` DESC");
                            while ($orank = mysqli_fetch_assoc($deptranks)) {
                                if ($orank['pid'] == "{$lbord['pid']}") break;
                                else $deptrank++;
                            }
                            while ($orank = mysqli_fetch_assoc($yearranks)) {
                                if ($orank['pid'] == "{$lbord['pid']}") break;
                                else $yearrank++;
                            }
                            while ($orank = mysqli_fetch_assoc($sectionranks)) {
                                if ($orank['pid'] == "{$lbord['pid']}") break;
                                else $sectionrank++;
                            }
                            while ($orank = mysqli_fetch_assoc($overallrank)) {
                                if($orank['pid'] == "{$lbord['pid']}") break;
                                else $overall++;
                            }

                            if ($lbord['place'] == '2027') {
                                $yeark = "FIRST YEAR";
                            } elseif ($lbord['place'] == '2026') {
                                $yeark = "SECOND YEAR";
                            } elseif ($lbord['place'] == '2025') {
                                $yeark = "THIRD YEAR";
                            } elseif ($lbord['place'] == '2024') {
                                $yeark = "FOURTH YEAR";
                            }

                            if($lbord['points'] == NULL){
                                $lbord['points'] = "YET TO PLAY";
                                $sectionrank = "YET TO PLAY";
                                $deptrank = "YET TO PLAY";
                                $yearrank = "YET TO PLAY";
                                $overall = "YET TO PLAY";
                            }
                            print "<tr><td align='center'>" . $sino . "</td><td align='center'><font color='#DC143C'> " . strtoupper($lbord['regno']) . "</font></td><td style='text-align: left;'><b>" . strtoupper($lbord['player_name']) . "</b></td><td style='text-align: left;'>" . $yeark .  "</td><td align='center'>" . $lbord['points'] . "</td><td align='center'>" . $sectionrank .  "</td><td align='center'>" . $deptrank .  "</td><td align='center'>" . $yearrank .  "</td><td align='center'><strong>" . $overall . "</strong></td></tr>";
                            $sino++;
                        }

                        echo "</table></center><br><br>";
                        ?>

            </div>
            <h4>The Remaing registred Students haven't take you exam <br>
                You are requested to take your exam at any stall in our Campus</h4>


        </div>
    </div>
    <!-- Team block END -->

    <?php include "footer.php"; ?>

</body>

</html>