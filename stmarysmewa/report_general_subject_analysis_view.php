<?php
require_once('auth.php');
$username = $_SESSION['SESS_MEMBER_ID_'];
$usercat = $_SESSION['SESS_CATEGORY_'];
include 'includes/SubjectTally.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content=" text/html; charset=utf-8" />
        <title>content</title>
        <link href="css/style_blue.css" type="text/css" rel="stylesheet" />
        <link href="css/pages_layout.css" type="text/css" rel="stylesheet" />
        <link href='css/opa-icons.css' rel='stylesheet' />
        <style type="text/css" class="init">

        </style>
        <script type="text/javascript" language="JavaScript" src="media/js/jquery.js"></script>
        <script type="text/javascript" language="JavaScript" class="init">
            $(document).ready(function () {
                $('#example').dataTable({
                    "columnDefs": [
                        {
                        },
                    ]
                });
            });

            function deleteConfirm() {
                doIt = confirm('You are about to delete this record\n\nDo you wish to proceed?');
                if (doIt) {
                    //window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
                } else {
                    return false
                }

            }
            function download() {
                window.location = 'licenses.xls';
            }

            var xmlhttp;
            function loadXMLDoc(url, cfunc)
            {
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = cfunc;
                xmlhttp.open("GET", url, true);
                xmlhttp.send();
            }

            function commonFunction(id) {
                loadXMLDoc(id, function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("new_Area").innerHTML = xmlhttp.responseText;
                    }
                });
            }

            function searchFunction(str)
            {
                if (str == "")
                {
                    document.getElementById("display_Area").innerHTML = "";
                    return;
                }
                if (window.XMLHttpRequest)
                {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else
                {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function ()
                {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                    {
                        document.getElementById("display_Area").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "getLicenseDetailsSearch.php?q=" + str, true);
                xmlhttp.send();
            }

            printDivCSS = new String('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML = printDivCSS + document.getElementById(divId).innerHTML
                window.frames["print_frame"].window.focus()
                window.frames["print_frame"].window.print()
            }
        </script>
        <script type='text/javascript'>//<![CDATA[ 
            $(window).load(function () {
                setTimeout(function () {
                    $("#blocker").hide();
                }, 1000);

            });//]]>  

        </script>
    </head>
    <body>
        <div id="blocker">
            <div><img src="images/loading.gif" />Loading...</div>
        </div>
        <div class="clear"></div>
        <div id="display_Area">
            <div id="page_tabs_content">
                <!--*********************************************************************************-->
                <?php
                include('includes/dbconnector.php');
                $form = $_GET['form'];
                $term = $_GET['term'];
                $year = $_GET['year'];


                $myformis = $form;
                if ($form == 1) {
                    $myform = 'Form 1';
                }
                if ($form == 2) {
                    $myform = 'Form 2';
                }
                if ($form == 3) {
                    $myform = 'Form 3';
                }
                if ($form == 4) {
                    $myform = 'Form 4';
                }

                include 'includes/functions.php';
                $func = new Functions();
                $activity = "Generated Cluster Spread sheet" . $myform . " " . $year . " " . $term;
                $func->addAuditTrail($activity, $username);
                $date = date("j, F, Y");

                function round_up($value, $precision) {
                    $pow = pow(10, $precision);
                    return ( ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value)) ) / $pow;
                }
                ?>
                <div class="clear"></div>
                <table class="borders" cellpadding="5" cellspacing="0">
                    <tr style="height:30px;">
                        <td class="dataListHeader"> SUBJECT GRADE ANALYSIS :- Form <?php echo $form ?> - Term <?php echo $term ?> - Year <?php echo $year ?>
                            <div style="float:right; margin-right:5px;">
                                <table width="100%">
                                    <tr>
                                        <td align="left"><a href="javascript:printDiv('div_print_analysis')" title="Print Report"><i class="icon icon-green icon-print"></i>Print Subjects Analysis</a> </td>
                                        <td align="left"><a href="pdf_test_gen.php?form=<?php echo $form?>&class=<?php echo $stream?>&term=<?php echo $term?>&year=<?php echo $year?>" title="Print PDF Report"><i class="icon icon-red icon-pdf"></i>Export PDF</a> </td>
              
                                    </tr>
                                </table>
                            </div></td>
                    </tr>
                    <tr>
                        <td>
                            <form  method='get' name='pdiv' id="pdiv">
                                <div id="div_print_analysis">
                                    <?php
                                    $query = ("select distinct (stream) from streams ");
                                    $result = mysql_query($query);

                                    //get all streams
                                    $allStreams = array("G", "H", "L", "M", "S");




                                    //DEFINE AN ARRAY WITH ALL SUBJECTS
                                    $subjects = array("english", "mathematics", "kiswahili",
                                        "biology", "chemistry", "physics", "history",
                                        "geography", "cre", "agriculture", "businesStudies",
                                        "french", "computer", "home");



                                    //THE FOLLOWING CODE DRIVES THE EXECUTION OF THIS PHP CODE

                                    $loopcounter = 0;
                                    foreach ($subjects AS $subject) {
                                        $allStreamRowData = array();

                                        foreach ($allStreams as $strm) {

                                            $subgrade = $subject . "grade";
                                            if ($subject == "mathematics") {
                                                $subgrade = "mathimaticsgrade";
                                            }
                                            //GET GRADES
                                            $retGrades = getGrades($subject, $form, $strm, $term, $year, $subgrade);
                                            //GET STUDENTS
                                            //$noOfStudents = getStudentsInClass($form, $strm, $term, $year, "totalygradedmarks");
                                            $noOfStudents = getEntries($retGrades);
                                            //GET MEAN
                                            $mean = calculateMean($retGrades, $noOfStudents);
                                            //GET MEAN GRADE
                                            $subtally = new SubjectTally();
                                            $meangrade = $subtally->getFinalGrate($mean);
                                            //GET TEACHER
                                            $teachers = "-";

                                            $engint = mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='$subject'");
                                            while ($roweng = mysql_fetch_array($engint)) {// get admno
                                                $teachers = $roweng['initials'];
                                            }
                                            //CREATE A ROW OF THE DATA
                                            $dataCreated = createRowForEachStream($strm, $noOfStudents, $retGrades, $mean, $meangrade, $teachers);
                                            $allStreamRowData[$strm] = $dataCreated;
                                        }//END GET STREAMS
                                        //HAVING COLLECTED ALL DATA, LETS NOW PRINT IT OUT BEFORE MOVING TO THE NEXT SUBJECT
                                        printGradeHeader($subject, $allStreamRowData);
                                        if ($loopcounter > 0) {
                                            echo "</fieldset>";
                                        }
                                        $loopcounter++;


                                        echo "</fieldset>";
                                    }//END SUBJECTS LOOP
                                    //close field sets at the end

                                    function createRowForEachStream($stream, $noStudents, $gradesArry, $meanscore, $meangrade, $teachers) {
                                        $A = $gradesArry["A"];
                                        $Aminus = $gradesArry["A-"];
                                        $bplus = $gradesArry["B+"];
                                        $bplain = $gradesArry["B"];
                                        $bminus = $gradesArry["B-"];
                                        $cplus = $gradesArry["C+"];
                                        $cplain = $gradesArry["C"];
                                        $cminus = $gradesArry["C-"];
                                        $dplus = $gradesArry["D+"];
                                        $dplain = $gradesArry["D"];
                                        $dminus = $gradesArry["D-"];
                                        $e = $gradesArry["E"];
                                        $rowData = "<tr>
                                    <td align=center colspan=2> $stream </td>
                                    <td align=center colspan=2>$noStudents</td>
                                    <td align=center colspan=2>$A</td>
                                    <td align=center colspan=2>$Aminus</td>
                                    <td align=center colspan=2>$bplus</td>
                                    <td align=center colspan=2>$bplain</td>
                                    <td align=center colspan=2>$bminus</td>
                                    <td align=center colspan=2>$cplus</td>
                                    <td align=center colspan=2>$cplain</td>
                                    <td align=center colspan=2>$cminus</td>
                                    <td align=center colspan=2>$dplus</td>
                                    <td align=center colspan=2>$dplain</td>
                                    <td align=center colspan=2>$dminus</td>
                                    <td align=center colspan=2>$e</td>
                                    <td align=center colspan=2>$meanscore</td>
                                    <td align=center colspan=2>$meangrade</td>
                                    <td align=center colspan=2>$teachers</td>
                                </tr>";
                                        return $rowData;
                                    }

                                    /**
                                     * Function to get students in a class
                                     */
                                    function getStudentsInClass($form1, $stream1, $term1, $year1, $table) {
                                        $studentsare = 0;
                                        $getstudents = mysql_query("select count(adm) as adms from $table where term='$term1' and year='$year1' and form='$form1' and classin='$stream1'");
                                        while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
                                            $studentsare = $rowstud['adms'];
                                        }
                                        return $studentsare;
                                    }

                                    function getGrades($subject1, $form1, $stream1, $term1, $year1, $subjectGrade) {
                                        $stally = new SubjectTally();
                                        $gradesArray = array();

                                        $englishtallys = $stally->getGradesPerSubject($subject1, $subjectGrade, $term1, $year1, $form1, $stream1);

                                        foreach ($englishtallys as $key => $values) {

                                            if ($englishtallys[$key][0] == 'A') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["A"] = $grad;
                                            }

                                            if ($englishtallys[$key][0] == 'A-') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["A-"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'B+') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["B+"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'B') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["B"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'B-') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["B-"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'C+') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["C+"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'C') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["C"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'C-') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["C-"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'D+') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["D+"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'D') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["D"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'D-') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["D-"] = $grad;
                                            }
                                            if ($englishtallys[$key][0] == 'E') {
                                                $grad = $englishtallys[$key][1];
                                                $gradesArray["E"] = $grad;
                                            }
                                        }
                                        return fixMissingGrades($gradesArray);
                                    }

                                    /**
                                     * The function calculates the 
                                     * no of students who sat for a certain exam
                                     * depending on the number of reported grades
                                     * @param type $gradesArray
                                     * @return type
                                     */
                                    function getEntries($gradesArray) {
                                        $Apoints = $gradesArray["A"];
                                        $Aminus = $gradesArray["A-"];
                                        $Bplus = $gradesArray["B+"];
                                        $Bplain = $gradesArray["B"];
                                        $Bminus = $gradesArray["B-"];
                                        $Cplus = $gradesArray["C+"];
                                        $Cplain = $gradesArray["C"];
                                        $Cminus = $gradesArray["C-"];
                                        $Dplus = $gradesArray["D+"];
                                        $Dplain = $gradesArray["D"];
                                        $Dminus = $gradesArray["D-"];
                                        $Eplain = $gradesArray["E"];
                                        $totalPoints = $Apoints + $Aminus + $Bplus + $Bplain + $Bminus + $Cplus + $Cplain + $Cminus + $Dplus + $Dplain + $Dminus + $Eplain;
                                        return $totalPoints;
                                    }

                                    /**
                                     * This method is just a utility function to clear
                                     * up the array; it checks if the grades are recorded in the received array
                                     * ; if a grade is missing it is inserted and given a value of zero.
                                     * Meaning zero students got that grade. Helps to avoid exceptions
                                     * @param int $gradesArray
                                     * @return int
                                     * @author Moses Nyota <mosesnyota@gmail.com>
                                     */
                                    function fixMissingGrades($gradesArray) {
                                        $gradesRef = array("A", "A-", "B+", "B", "B-", "C+", "C", "C-", "D+", "D", "D-", "E");

                                        foreach ($gradesRef as $grade) {
                                            if (!array_key_exists($grade, $gradesArray)) {
                                                $gradesArray[$grade] = 0;
                                            }
                                        }
                                        return $gradesArray;
                                    }

                                    /**
                                     * The function calculates mean from the
                                     * passed parameters
                                     * @param type $gradesArray
                                     * @param type $noOfStudents
                                     * @return type
                                     */
                                    function calculateMean($gradesArray, $noOfStudents) {
                                        $Apoints = $gradesArray["A"] * 12;
                                        $Aminus = $gradesArray["A-"] * 11;
                                        $Bplus = $gradesArray["B+"] * 10;
                                        $Bplain = $gradesArray["B"] * 9;
                                        $Bminus = $gradesArray["B-"] * 8;
                                        $Cplus = $gradesArray["C+"] * 7;
                                        $Cplain = $gradesArray["C"] * 6;
                                        $Cminus = $gradesArray["C-"] * 5;
                                        $Dplus = $gradesArray["D+"] * 4;
                                        $Dplain = $gradesArray["D"] * 3;
                                        $Dminus = $gradesArray["D-"] * 2;
                                        $Eplain = $gradesArray["E"] * 1;
                                        $totalPoints = $Apoints + $Aminus + $Bplus + $Bplain + $Bminus + $Cplus + $Cplain + $Cminus + $Dplus + $Dplain + $Dminus + $Eplain;

                                        if ($noOfStudents == 0) {
                                            return 0;
                                        } else {
                                            return round_up(($totalPoints / $noOfStudents), 4);
                                        }
                                    }

                                    function printGradeHeader($subject, $dataToPrint) {
                                        echo "<fieldset> <legend> $subject </legend>
                                            <table id='example' class='table table-striped table-bordered' cellspacing='0' width='100%'>
                                                    <tr>";
                                        echo "<td align=center colspan=2></td>
                                                <td align=center colspan=2>Entry</td>
                                                <td align=center colspan=2>A</td>
                                                <td align=center colspan=2>A-</td>
                                               <td align=center colspan=2>B+</td>
                                               <td align=center colspan=2>B</td>
                                               <td align=center colspan=2>B-</td>
                                               <td align=center colspan=2>C+</td>
                                               <td align=center colspan=2>C</td>
                                               <td align=center colspan=2>C-</td>
                                               <td align=center colspan=2>D+</td>
                                               <td align=center colspan=2>D</td>
                                               <td align=center colspan=2>D-</td>
                                               <td align=center colspan=2>E</td>
                                               <td align=center colspan=2>Mean</td>
                                               <td align=center colspan=2>G</td>
                                               <td align=center colspan=2>Teacher</td>
                                               </tr>";

                                        foreach ($dataToPrint as $key) {
                                            echo $key;
                                        }
                                        echo " </table>";
                                    }
                                    ?>

                                </div>    
                                <!-- end of whole prints div-->
                            </form>
                            <iframe src="about:blank" name="print_frame" width="0" height="0" frameborder="0" id="print_frame"></iframe>
                        </td>
                    </tr>
                </table>

                <!-----************************************************************************************-->
            </div>
        </div>
        <!--end of display area. 
        This area changes when a user searches for an item-->
    </body>
</html>
