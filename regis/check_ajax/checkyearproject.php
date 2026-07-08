<?php
include('../../connectdatabase.php');
header('Content-Type: application/json; charset=utf-8');

$idstudent = mysqli_real_escape_string($connect, $_GET['idstudent'] ?? '');

$result = mysqli_query($connect, "SELECT * FROM academicyear LIMIT 1");
$ay = mysqli_fetch_array($result);
$year = $ay[0];
$semester = $ay[1];

// statuses that mean "passed title exam" — anything after passing (6 onwards) except fail/cancel
$passedIn = "6,7,8,9,10,11,12,13,14,15,16,19,20,21,23,24";

// 1. Check for a passed year project from a previous semester
$q = "SELECT p.id_project, p.name_project, p.casestudy_project,
             p.engname_project, p.engcasestudy_project
      FROM project p JOIN manipulator m ON m.id_project=p.id_project
      WHERE m.id_student='$idstudent'
        AND p.project_type='year'
        AND p.id_statusproject IN ($passedIn)
        AND NOT (p.year_project='$year' AND p.semester_project='$semester')
      ORDER BY p.id_project DESC LIMIT 1";
$result = mysqli_query($connect, $q);
if (mysqli_num_rows($result) > 0) {
    $rs = mysqli_fetch_array($result);
    $parentId = $rs[0];

    // advisor is carried over automatically for round 2 (not re-selected), so tell the UI who it is
    $advisorName = '';
    $aq = mysqli_query($connect, "SELECT initials_academictitle,name_teacher,sname_teacher
        FROM committee,teacher,academictitle
        WHERE committee.id_teacher=teacher.id_teacher AND teacher.id_academictitle=academictitle.id_academictitle
          AND committee.id_project='$parentId' AND committee.position='ที่ปรึกษา' LIMIT 1");
    if ($ars = mysqli_fetch_array($aq)) {
        $advisorName = $ars[0].$ars[1]." ".$ars[2];
    }

    echo json_encode([
        'status'  => 'can_register_2nd',
        'data'    => [
            'id_project'          => $rs[0],
            'name_project'        => $rs[1],
            'casestudy_project'   => $rs[2],
            'engname_project'     => $rs[3],
            'engcasestudy_project'=> $rs[4],
            'advisor_name'        => $advisorName,
        ]
    ]);
    mysqli_close($connect);
    exit;
}

// 2. Check for a year project from a previous semester that has NOT passed yet (blocks 2nd reg)
$failCancel = "17,18,22,25";
$q2 = "SELECT p.id_project, p.name_project, sp.name_statusproject
       FROM project p
       JOIN manipulator m ON m.id_project=p.id_project
       JOIN statusproject sp ON sp.id_statusproject=p.id_statusproject
       WHERE m.id_student='$idstudent'
         AND p.project_type='year'
         AND p.id_statusproject NOT IN ($passedIn)
         AND p.id_statusproject NOT IN ($failCancel)
         AND NOT (p.year_project='$year' AND p.semester_project='$semester')
       ORDER BY p.id_project DESC LIMIT 1";
$result = mysqli_query($connect, $q2);
if (mysqli_num_rows($result) > 0) {
    $rs = mysqli_fetch_array($result);
    echo json_encode([
        'status'          => 'not_passed_yet',
        'id_project'      => $rs[0],
        'name_project'    => $rs[1],
        'status_name'     => $rs[2],
    ]);
    mysqli_close($connect);
    exit;
}

// 3. No previous year project (or previous one failed/cancelled) → 1st registration
echo json_encode(['status' => 'first_registration']);
mysqli_close($connect);
