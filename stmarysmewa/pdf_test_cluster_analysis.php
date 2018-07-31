<?php

include('includes/dbconnector.php');
include 'includes/DAO.php';
include 'includes/SubjectTally.php';
require('rotation.php');

class PDF extends PDF_Rotate {

    function RotatedText($xx, $yy, $txt, $angle) {
        //Text rotated around its origin
        $this->Rotate($angle, $xx, $yy);
        $this->Text($xx, $yy, $txt);
        $this->Rotate(0);
    }

//Page header
    function Header() {
        $details = mysql_query("select * from schoolname");
        while ($de = mysql_fetch_array($details)) {// get names
            $schoolname = $de['schname'];
        }
        $form = $_GET['form'];
        $term = $_GET['term'];
        $year = $_GET['year'];
        $this->SetFont('arial', '', 10);
        $this->SetFont('times', '', 12);
        $this->Text(70, 17, $schoolname);
        $this->Text(70, 22, 'Subjects Cluster Grade Analysis Form ' . $form . ' Term ' . $term . ' Year ' . $year);
        $this->Ln(5);
    }

//Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Page number
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }

}

function round_up($value, $precision) {

    $pow = pow(10, $precision);

    return ( ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value)) ) / $pow;
}

$form = $_GET['form'];
$strm = $_GET['class'];
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
$date = date("j, F, Y");

$query = ("select distinct (stream) from streams ");
$result = mysql_query($query);



$allStreams = array("G", "H", "L", "M", "S");
//DEFINE AN ARRAY WITH ALL SUBJECTS
$subjects = array("english", "mathematics", "kiswahili",
    "biology", "chemistry", "physics", "history",
    "geography", "cre", "agriculture", "businesStudies",
    "french", "computer", "home");



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->open();

$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
$y = $pdf->GetY();
$x = 15;
$pdf->setXY($x, $y);
$fill = 0;
$pdf->SetFillColor(204, 255, 204); //gray
$pdf->setFont("times", "", "10");
$pdf->setXY(15, 20);

$pdf->setFont("times", "", "9");


$pdf->Ln(0);
$pdf->setX(15);



//THE FOLLOWING CODE DRIVES THE EXECUTION OF THIS PHP CODE
$loopcounter = 1;
foreach ($subjects AS $subject) {

    $sbt = strtoupper($subject);
    $pdf->Ln(7);
    $pdf->setX(15);
    $pdf->Cell(101, 6, "$sbt", 1, 0, "L", 1);
    $pdf->Ln(5);
    $pdf->setX(15);

    $pdf->Cell(10, 6, "", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "Entry", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "A", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "A-", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "B+", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "B", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "B-", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "C+", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "C", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "C-", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "D+", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "D", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "D-", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "E", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "Mean", 1, 0, "L", 1);
    $pdf->Cell(13, 6, "G", 1, 0, "L", 1);
    $pdf->Cell(25, 6, "Teacher", 1, 0, "L", 1);
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
        createRowForEachStream($strm, $noOfStudents, $retGrades, $mean, $meangrade, $teachers, $pdf);
    }//END GET STREAMS
    //HAVING COLLECTED ALL DATA, LETS NOW PRINT IT OUT BEFORE MOVING TO THE NEXT SUBJECT

    if ($loopcounter > 0 && (($loopcounter % 4) == 0)) {
        $pdf->AddPage('L');
        $pdf->SetAutoPageBreak(false);
        $pdf->SetFillColor(0, 0, 0); //black
        $pdf->SetDrawColor(0, 0, 0); //black
        $y = $pdf->GetY();
        $x = 15;
        $pdf->setXY($x, $y);
        $fill = 0;
        $pdf->SetFillColor(204, 255, 204); //gray
        $pdf->setFont("times", "", "10");
        $pdf->setXY(15, 20);
        $pdf->setFont("times", "", "9");
        $pdf->Ln(0);
        $pdf->setX(15);
    }
    $loopcounter++;
}//END SUBJECTS LOOP
//close field sets at the end

function createRowForEachStream($stream, $noStudents, $gradesArry, $meanscore, $meangrade, $teachers, $pdf) {
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
    $pdf->Ln(6);
    $pdf->setX(15);
    $pdf->Cell(10, 6, $stream, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $noStudents, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $A, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $Aminus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $bplus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $bplain, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $bminus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $cplus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $cplain, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $cminus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $dplus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $dplain, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $dminus, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $e, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $meanscore, 1, 0, "L", 0);
    $pdf->Cell(13, 6, $meangrade, 1, 0, "L", 0);
    $pdf->Cell(25, 6, $teachers, 1, 0, "L", 0);
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

    $englishtallys = $stally->getGradesPerSubjectMock($subject1, $subjectGrade, $term1, $year1, $form1, $stream1);

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
 * if a grade is missing it is inserted and given a value of zero.
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

$pdf->Output();
?>

