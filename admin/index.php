<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">        
    <title>DASHBOARD</title>
    <style>
        .dashbord-tables{
            animation: transitionIn-Y-over 0.5s;
        }
        .filter-container{
            animation: transitionIn-Y-bottom  0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }
    }else{
        header("location: ../login.php");
    }

    include("../connection.php");
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="30%" style="padding-left:20px" >
                                    <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <!-- nanti tukar jadikan responsive for all users -->
                                    <p class="profile-title">Administrator</p>
                                    <p class="profile-subtitle">admin@edoc.com</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../logout.php" ><input type="button" value="Log Keluar" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-dashbord menu-active menu-icon-dashbord-active" >
                        <a href="index.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Dashboard</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor ">
                        <a href="pegawai.php" class="non-style-link-menu"><div><p class="menu-text">Pegawai</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-schedule">
                        <a href="jadual.php" class="non-style-link-menu"><div><p class="menu-text">Jadual</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="janjitemu.php" class="non-style-link-menu"><div><p class="menu-text">Janji Temu</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-patient">
                        <a href="organisasi.php" class="non-style-link-menu"><div><p class="menu-text">Organisasi</p></a></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >                        
                        <tr >                            
                            <td colspan="2" class="nav-bar" >                                
                                <form action="pegawai.php" method="post" class="header-search">        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Carian nama Juruteknik atau emel" list="juruteknik">&nbsp;&nbsp;                                    
                                    <?php
                                        echo '<datalist id="juruteknik">';
                                        $list11 = $database->query("select  docname,docemail from  doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["docname"];
                                            $c=$row00["docemail"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };        
                                    echo ' </datalist>';
                                    ?>
                                    <input type="Submit" value="Cari" class="login-btn btn-primary-soft btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                </form>                                
                            </td>
                            <td width="15%">
                                <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                                    Tarikh Hari Ini
                                </p>
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                        date_default_timezone_set('Asia/Kuala_Lumpur');
                                        $today = date('d-m-y');
                                        echo $today;

                                        $patientrow = $database->query("select * from patient;");
                                        $doctorrow = $database->query("select * from doctor;");
                                        $appointmentrow = $database->query("select * from appointment where appodate>='$today';");
                                        $schedulerow = $database->query("select * from schedule where scheduledate='$today';");
                                    ?>
                                </p>
                            </td>
                            <td width="10%">
                                <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                            </td>
                        </tr>
                <tr>
                    <td colspan="4">                        
                        <center>
                        <table class="filter-container" style="border: none;" border="0">
                            <tr>
                                <td colspan="4">
                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Status</p>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php echo $doctorrow->num_rows  ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Pegawai &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/doctors-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div class="dashboard-items" style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php echo $patientrow->num_rows  ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Organisasi &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/patients-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php echo $appointmentrow ->num_rows  ?>
                                            </div><br>
                                            <div class="h3-dashboard">
                                                Tempahan Baharu &nbsp;&nbsp;
                                            </div>
                                        </div>
                                            <div class="btn-icon-back dashboard-icons" style="margin-left: 0px;background-image: url('../img/icons/book-hover.svg');"></div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
                                        <div>
                                            <div class="h1-dashboard">
                                                <?php    echo $schedulerow ->num_rows  ?>
                                            </div><br>
                                            <div class="h3-dashboard" style="font-size: 18px">
                                                Sesi Hari Ini &nbsp;&nbsp;&nbsp;&nbsp;
                                            </div>
                                        </div>
                                            <div class="btn-icon-back dashboard-icons" style="background-image: url('../img/icons/session-iceblue.svg');"></div>
                                    </div>
                                </td>                                
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                    <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Janji Temu akan datang sehingga <?php  
                                        echo date("l",strtotime("+1 week"));
                                        ?> hadapan
                                    </p>
                                    <p style="padding-bottom:19px;padding-left:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Berikut adalah akses pantas ke Janji Temu untuk 7 hari akan datang. Maklumat lanjut boleh didapati di laman sesawang bahagian Janji Temu.
                                    </p>

                                </td>
                                <td>
                                    <p style="text-align:left;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        Sesi akan datang sehingga <?php  
                                        echo date("l",strtotime("+1 week"));
                                        ?> hadapan
                                    </p>
                                    <p style="padding-bottom:19px;text-align:left;padding-right:50px;font-size:15px;font-weight:500;color:#212529e3;line-height: 20px;">
                                        Berikut adalah akses pantas ke sesi yang dijadualkan untuk 7 hari akan datang. Maklumat lanjut boleh didapati di laman sesawang bahagian Jadual.
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>    
                                                <th class="table-headin" style="font-size: 12px;">                                                       
                                                    No. Janji Temu                                                    
                                                </th>
                                                <th class="table-headin">
                                                    Organisasi
                                                </th>
                                                <th class="table-headin">                                                                                                
                                                    Pegawai                                                    
                                                </th>
                                                <th class="table-headin">                                                                                                    
                                                    Jadual Sesi                                                   
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select appointment.appoid,schedule.scheduleid,schedule.title,doctor.docname,patient.pname,schedule.scheduledate,schedule.scheduletime,appointment.apponum,appointment.appodate from schedule inner join appointment on schedule.scheduleid=appointment.scheduleid inner join patient on patient.pid=appointment.pid inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today'  and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc";

                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Maaf, Kami tidak dapat mencari apa-apa yang berkaitan dengan kata kunci anda!</p>
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $appoid=$row["appoid"];
                                                    $scheduleid=$row["scheduleid"];
                                                    $title=$row["title"];
                                                    $docname=$row["docname"];
                                                    $scheduledate=$row["scheduledate"];
                                                    $scheduletime=$row["scheduletime"];
                                                    $pname=$row["pname"];
                                                    $apponum=$row["apponum"];
                                                    $appodate=$row["appodate"];
                                                    echo '<tr>
                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$apponum.'                                                            
                                                        </td>
                                                        <td style="font-weight:600;"> &nbsp;'.                                                    
                                                        substr($pname,0,25)
                                                        .'</td >
                                                        <td style="font-weight:600;"> &nbsp;'.                                                    
                                                        substr($docname,0,25)
                                                        .'</td >                                                                                                                   
                                                        <td>
                                                        '.substr($title,0,15).'
                                                        </td>
                                                    </tr>';                                                    
                                                }
                                            }                                                
                                            ?>                 
                                            </tbody>                
                                        </table>
                                        </div>
                                        </center>
                                </td>
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                        <tr>
                                            <th class="table-headin">                                                                                            
                                                No. Sesi                                            
                                            </th>                                            
                                            <th class="table-headin">
                                                Pegawai
                                            </th>
                                            <th class="table-headin">                                                
                                                Jadual bagi Tarikh & Masa                                                
                                            </th>                                                
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("y-m-d",strtotime("+1 week"));
                                            $sqlmain= "select schedule.scheduleid,schedule.title,doctor.docname,schedule.scheduledate,schedule.scheduletime,schedule.nop from schedule inner join doctor on schedule.docid=doctor.docid  where schedule.scheduledate>='$today' and schedule.scheduledate<='$nextweek' order by schedule.scheduledate desc"; 
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
                                                    <img src="../img/notfound.svg" width="25%">                                                    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Maaf, Kami tidak dapat mencari apa-apa yang berkaitan dengan kata kunci anda!</p>                                                    
                                                    </center>
                                                    <br><br><br><br>
                                                    </td>
                                                    </tr>';                                                    
                                                }
                                                else{
                                                for ( $x=0; $x<$result->num_rows;$x++){
                                                    $row=$result->fetch_assoc();
                                                    $scheduleid=$row["scheduleid"];
                                                    $title=$row["title"];
                                                    $docname=$row["docname"];
                                                    $scheduledate=$row["scheduledate"];
                                                    $scheduletime=$row["scheduletime"];
                                                    $nop=$row["nop"];
                                                    echo '<tr>
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($title,0,30)
                                                        .'</td>
                                                        <td>
                                                        '.substr($docname,0,20).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($scheduledate,0,10).' '.substr($scheduletime,0,5).'
                                                        </td>  
                                                    </tr>';                                                    
                                                }
                                            }                                                 
                                            ?>                 
                                        </tbody>                
                                        </table>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <a href="janjitemu.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Papar semua Janji Temu</button></a><br><br>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="jadual.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Papar semua Sesi</button></a><br><br>
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                        </table>
                        </center>
                        </td>
                </tr>
            </table>
        </div>
    </div>
  
</body>
</html>