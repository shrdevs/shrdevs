<?php
session_start();
if (!$_SESSION["username"]) {

    header("Location: login.php"); //redirect to the login page to secure the welcome page without login access.  
} else {
    include_once 'connection.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <!-- <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css"> -->
    <style>        
footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #2F323A;
   color: white;
   text-align: center;
}
.blinking{
    animation:blinkingText 1.2s infinite;
}
@keyframes blinkingText{
    0%{     color: #000;    }
    49%{    color: #000; }
    60%{    color: transparent; }
    99%{    color:transparent;  }
    100%{   color: #000;    }
}
.blink {
        animation: blinker 0.6s linear infinite;
        color: #1c87c9;
        font-size: 30px;
        font-weight: bold;
        font-family: sans-serif;
      }
      @keyframes blinker {
        50% {
          opacity: 0;
        }
      }
</style>
</head>

<body>
    <div class="wrapper">
        <!--header menu start-->
        <div class="header">
            <div class="header-menu">
                <div class="title">AML & CFTD System <span>For Admin</span></div>
                <!-- <div class="sidebar-btn">
                    <i class="fa fa-bars"></i>
                </div> -->
                <!-- <ul>
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-bell"></i></a></li>
                    <li><a href="#"><i class="fa fa-power-off"></i></a></li>
                </ul> -->
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-3">
            <div class="sidebar">
                <div class="sidebar-menu">
                    <li class="item">
                        <a href="dashboard.php" class="menu-btn">
                            <i class="fa fa-desktop"></i><span>Dashboard</span>
                        </a>
                    </li>

                    <li class="item">
                        <a href="sentNoticeBox.php" class="menu-btn">
                            <i class="fa fa-envelope-o"></i><span>Sent Items</span>
                        </a>
                    </li>

                    <li class="item">
                        <a href="sendNotice.php" class="menu-btn">
                            <i class="fa fa-plus-square" aria-hidden="true"> </i> <span>Create Notice</span>
                        </a>
                    </li>

                    <li class="item" id="profile">
                        <a href="#profile" class="menu-btn">
                            <i class="fa fa-file-text-o"></i> <span>Statement <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="branchReplied.php"><i class="fa fa-image"></i><span>Status of Branch Reply</span></a>
                            <a href="noAccountFound.php"><i class="fa fa-address-card"></i><span>Nil Statement</span></a>
                            <a href="accountFound.php"><i class="fa fa-address-card"></i><span>A/C Found Statement</span></a>
                            <a href="reminderList.php"><i class="fa fa-address-card"></i><span>Reminder Status</span></a>
                        </div>
                    </li>
                    <li class="item" id="upload">
                        <a href="#upload" class="menu-btn">
                            <i class="fa fa-upload"></i><span>Upload Package <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="uploadPackage.php" class="menu-btn">
                                <i class="fa fa-cloud-upload" aria-hidden="true"> </i> <span>Upload Package</span>
                            </a>
                            <a href="uploadedPackageList.php" class="menu-btn">
                                <i class="fa fa-file-text-o" aria-hidden="true"> </i> <span>Package List</span>
                            </a>
                        </div>
                    </li>
                    <li class="item" id="settings">
                        <a href="#settings" class="menu-btn">
                            <i class="fa fa-cog"></i><span>Settings <i class="fa fa-chevron-down drop-down"></i></span>
                        </a>
                        <div class="sub-menu">
                            <a href="createUser.php"><i class="fa fa-user-circle"></i><span>Create User</span></a>
                            <a href="changePasswordAml.php"><i class="fa fa-key"></i><span>Change Password</span></a>
                        </div>
                    </li>
                    <li class="item">
                        <a href="about.php" class="menu-btn">
                            <i class="fa fa-info-circle"></i><span>About</span>
                        </a>
                    </li>
                    <li class="item">
                        <a href="logout.php" class="menu-btn">
                            <i class="fa fa-sign-out"></i><span>Log out</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
        <div class="col-md-9 content">
            <h2 style="color:#55B1F0;margin-left:200px;margin-top:70px;">About : AML & CFT</h2>
            <hr>
            <div class="content-body">
                <h3 style="color:#22B1AA;margin-left:100px;"> Anti Money Laundering & Combating Financing of Terrorism Activities </h4>
                    <p style="font-size:small"> <span style="font-size:medium;color:midnightblue;"> <b>Keeping pace with the modern advancement</b></span> of financial service facilities, money laundering and financing of terrorism are getting new dimensions day by day. As a responsible commercial bank, First Security Islami Bank Ltd. (FSIBL) is always agile and vigilant against all kinds of money laundering and financing of terrorism activities. Managing Director of the bank every year declares written clear commitment regarding Anti Money Laundering & Combating Financing of Terrorism for all the employees and ensures implementation of these activities. For effective prevention of money laundering and terrorist financing in the bank, an <span style="font-size:medium;color:midnightblue;"> <b> Additional Managing Director (AMD) as Chief Anti Money Laundering Compliance Officer (CAMLCO) </b></span> and a <span style="font-size:medium;color:midnightblue;"> Senior Vice President as Deputy Chief Anti Money Laundering Compliance Officer (D-CAMLCO) </span> of the bank have been duly assigned. However, a powerful <span style="font-size:medium;color:midnightblue;"> <b>“Central Compliance Committee (CCC)” </b></span> of senior executives and divisional heads and chaired by the aforesaid AMD has been continuously supervising overall anti money laundering & combating financing of terrorism activities of the bank. <br>
                        As per <span style="font-size:medium;color:midnightblue;"> <b>Bangladesh Financial Intelligence Unit (BFIU)</b> </span>guidelines, a full-fledged division named “Anti Money Laundering (AML) & Combating Financing of Terrorism (CFT) Division” headed by the D-CAMLCO has been working in the head office of the bank under the close supervision of CAMLCO. Circulars and circular letters issued by BFIU, Bangladesh Bank regarding AML & CFT compliance are instantly circulated to all the branches, divisions, zonal offices and training institutes of the bank. At the same time, bank issues necessary circulars in compliance with applicable laws, circulars, guidelines etc. of regulatory authorities in this regard.<br><br>
                        The bank has its own <span style="font-size:medium;color:midnightblue;"> <b> “Anti Money Laundering & Combating Financing of Terrorism Policy” </b></span>, <span style="font-size:medium;color:midnightblue;">“Customer Acceptance Policy”</span>, <span style="font-size:medium;color:midnightblue;"> “Money Laundering and Terrorist Financing Risk Management Guidelines for FSIBL”</span> and <span>“Guidelines for Prevention of Trade Based Money Laundering of FSIBL”</span> approved by the Board of Directors which are prepared in line with the prevailing laws, circulars, guidelines issued by the regulatory authorities. In accordance with the instruction of BFIU, a senior and experienced official or manager operation of every branch has been nominated as “Branch Anti Money Laundering Compliance Officer (BAMLCO)” by the CCC of the bank for preventing money laundering and terrorist financing at the branch, sub-branch and agent banking outlets. Bank’s AML & CFT Division inspects branches on a random basis in addition to Internal Control & Compliance Division’s audit of the branches for overseeing the implementation of AML & CFT activities at the branch level. Moreover, AML & CFT Division checks & submits monthly Cash Transaction Report (CTR) in due time and submits Suspicious Transaction Report (STR)/Suspicious Activity Report (SAR) to BFIU, Bangladesh Bank accurately as and when applicable.<br>
                        The bank conducts Customer Due Diligence (CDD) for every customer at the time of account opening and Enhanced Due Diligence (EDD) when required in compliance with the instruction of BFIU, Bangladesh Bank. The bank verifies NID information of every customer by using election commission’s database to ensure complete and accurate KYC of bank’s new and existing customers. As per “Guidelines on Electronic Know Your Customer (e-KYC)” issued by BFIU, bank has sucessfully launched e-KYC based solution "FSIBL FREEDOM" to facilitate bank account opening from anywhere, anytime instantly. Moreover, the bank has procured Politically Exposed Persons (PEPs) and Influtential Persons’ (IPs) and necessary adverse media news data from Accuity, a UK based international database provider for real time and automated identification of PEPs, IPs and suspicious persons involved with crimes by using automated <span style="font-size:medium;color:midnightblue;"> <b> Sanction Screening Software [S3] </b></span>.<br><br>
                        FSIBL’s own Training Institute in collaboration with AML & CFT Division regularly organizes training & workshop to the employees of the bank on the subject of Anti Money Laundering and Combating Financing of Terrorism where prevention of trade based money laundering gets special emphasis. In 2020, a day long workshop for all the BAMLCOs named BAMLCO Conference has been held at Dhaka on the topic of Anti Money Laundering and Combating Financing of Terrorism. However, bank’s officials & executives regularly get quality training on the topic of Anti Money Laundering and Combating Financing of Terrorism in home and abroad. The bank distributes adequate number of leaflets and hang posters on the topic of Anti Money Laundering and Combating Financing of Terrorism at every branch for building public awareness on these issues.<br><br><br><br><br>
                    </p>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <footer class="text-center" >
        <a style="color: #4CCEE8;font-weight: bold;" type="" class="btn blink" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span>Developed by Software Development Team</span>
        </a>
    </footer>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <p></p>
                    <h5 class="modal-title text-center" id="exampleModalLabel">Development Team</h5>
                    <p></p>
                </div>
                <div class="modal-body text-center">

                    <img src="images/dteam.png" alt="" width="750" height="550">


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
</body>

</html>