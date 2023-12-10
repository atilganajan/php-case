<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="<?php echo $_SESSION['csrf_token']; ?>">

    <title>Student Grade Tracking System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="../assets/css/student_grade/style.css">

</head>
<body>

<div class="top-nav">
    <div class="logo">
        <p>Student Grade Tracking System</p>
    </div>
</div>

<div class="top-action row w-100 m-0 ">
    <div class="card col-lg-4">
        <div class="text-center" onclick="openStudentCreateModal()">
            <p><i class="fa-solid fa-user"></i> Create Student</p>
        </div>
    </div>
    <div class="card col-lg-4 ">
        <div class="text-center" onclick="openGradeCreateModal()">
            <p><i class="fa-solid fa-pencil"></i> Create Grade</p>
        </div>
    </div>

    <div class="card col-lg-4 ">
        <div class=" text-center" onclick="openLessonCreateModal()">
            <p><i class="fa-solid fa-book"></i> Create Lesson</p>
        </div>
    </div>

</div>

<div class="w-100 d-flex mt-4 justify-content-center">
    <div class="grid-container">
        <div class="grid-item">
            <div class="table-title">
                <h3>Students</h3>
            </div>
            <table class="table table-striped table-class student-table" id="studentTable">
                <thead>
                <tr class="text-center header-tr">
                    <th>Full Name</th>
                    <th>Number</th>
                    <th>Grade Average</th>
                    <th>Action</th>
                </tr>
                </thead>
                <thead>
                <tr>

                    <th><input type="text" class="form-control shadow-sm filterStudentInput "
                               placeholder="Search name..."></th>

                    <th><input type="text" class="form-control shadow-sm filterStudentInput "
                               oninput="positiveNumberFormat(this)" placeholder="Search number..."></th>
                    <th><input type="text" class="form-control shadow-sm filterStudentInput "
                               oninput="gradeInputFormat(this)" placeholder="Search Average..."></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
        <div class="grid-item">
            <div class="table-title">
                <h3>Grades</h3>
            </div>
            <table class="table table-striped table-class student-table" id="gradeTable">
                <thead>
                <tr class="text-center header-tr">
                    <th>Student</th>
                    <th>Lesson</th>
                    <th>Grade</th>
                    <th>Action</th>

                </tr>
                </thead>
                <thead>
                <tr>
                    <th>
                        <select type="text" class="form-control shadow-sm filterGradeInput"
                                id="gradeStudentFilterSelect"
                                placeholder="Search Student...">

                        </select>
                    </th>
                    <th>
                        <select type="text" class="form-control shadow-sm filterGradeInput "
                                id="gradeLessonFilterSelect"
                                placeholder="Search Lesson...">

                        </select>
                    </th>
                    <th>
                        <input type="text" class="form-control shadow-sm filterGradeInput "
                               placeholder="Search Grade..." oninput="gradeInputFormat(this)">
                    </th>
                    <th></th>

                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
        <div class="grid-item">
            <div class="table-title">
                <h3>Lessons</h3>
            </div>
            <table class="table table-striped table-class student-table" id="lessonTable">
                <thead>
                <tr class="text-center header-tr">
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th><input type="text" class="form-control shadow-sm filterLessonInput "
                               placeholder="Search name..."></th>
                    <th></th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Student create modal Start-->
<div class="modal fade" id="studentCreateModal" tabindex="-1" aria-labelledby="studentCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Create Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createStudentForm">

                    <div>
                        <label for="createStudentNameInput">Name:</label>
                        <input class="form-control shadow-sm" id="createStudentNameInput" type="text" maxlength="100"
                               name="name">
                    </div>
                    <div class="mt-2">
                        <label for="createStudentSurnameInput">Surname:</label>
                        <input class="form-control shadow-sm" id="createStudentSurnameInput" type="text" maxlength="100"
                               name="surname">
                    </div>
                    <div class="mt-2">
                        <label for="createStudentNumberInput">Number:</label>
                        <input class="form-control shadow-sm" id="createStudentNumberInput" type="text" maxlength="20"
                               oninput="positiveNumberFormat(this)" name="student_number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveStudent()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Student create modal End-->

<!--Student update modal Start-->
<div class="modal fade" id="studentUpdateModal" tabindex="-1" aria-labelledby="studentUpdateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateStudentForm">
                    <input type="hidden" id="updateStudentIdInput" name="student_id" value="">
                    <div>
                        <label for="updateStudentNameInput">Name:</label>
                        <input class="form-control shadow-sm" id="updateStudentNameInput" type="text" maxlength="100"
                               name="name">
                    </div>
                    <div class="mt-2">
                        <label for="updateStudentSurnameInput">Surname:</label>
                        <input class="form-control shadow-sm" id="updateStudentSurnameInput" type="text" maxlength="100"
                               name="surname">
                    </div>
                    <div class="mt-2">
                        <label for="updateStudentNumberInput">Number:</label>
                        <input class="form-control shadow-sm" id="updateStudentNumberInput" type="text" maxlength="20"
                               oninput="positiveNumberFormat(this)" name="student_number">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="updateStudent()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Student update modal End-->

<!--Lesson create modal Start-->
<div class="modal fade" id="lessonCreateModal" tabindex="-1" aria-labelledby="lessonCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Create Lesson</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createLessonForm">
                    <div>
                        <label for="createLessonNameInput">Name:</label>
                        <input class="form-control shadow-sm" id="createLessonNameInput" type="text" maxlength="100"
                               name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveLesson()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Lesson create modal End-->

<!--Lesson create modal Start-->
<div class="modal fade" id="lessonUpdateModal" tabindex="-1" aria-labelledby="lessonUpdateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Lesson</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateLessonForm">
                    <input type="hidden" id="updateLessonIdInput" name="lesson_id">
                    <div>
                        <label for="updateLessonNameInput">Name:</label>
                        <input class="form-control shadow-sm" id="updateLessonNameInput" type="text" maxlength="100"
                               name="name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="updateLesson()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Lesson create modal End-->

<!--Grade create modal Start-->
<div class="modal fade" id="gradeCreateModal" tabindex="-1" aria-labelledby="gradeCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Create Grade</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createGradeForm">
                    <div>
                        <label for="createGradeStudentSelect">Student:</label>
                        <div>
                            <select class="js-example-basic-single" id="createGradeStudentSelect" name="student_id">
                                <?php
                                foreach ($students as $student) {
                                    echo "<option value='{$student["id"]}' >{$student["full_name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label for="createGradeLessonSelect">Lesson:</label>
                        <div>
                            <select class="js-example-basic-single" id="createGradeLessonSelect" name="lesson_id">
                                <?php
                                foreach ($lessons as $lesson) {
                                    echo "<option value='{$lesson["id"]}' >{$lesson["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="createGradeInput">Grade:</label>
                            <input class="form-control shadow-sm" id="createGradeInput" oninput="gradeInputFormat(this)"
                                   type="number" name="grade">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveGrade()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Grade create modal End-->

<!--Grade update modal Start-->
<div class="modal fade" id="gradeUpdateModal" tabindex="-1" aria-labelledby="gradeUpdateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Update Grade</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateGradeForm">
                    <input type="hidden" id="updateGradeIdInput" name="grade_id">
                    <div>
                        <label for="updateGradeStudentSelect">Student:</label>
                        <div>
                            <select class="js-example-basic-single " id="updateGradeStudentSelect" name="student_id">
                                <?php
                                foreach ($students as $student) {
                                    echo "<option value='{$student["id"]}' >{$student["full_name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <label for="updateGradeLessonSelect">Lesson:</label>
                        <div>
                            <select class="js-example-basic-single " id="updateGradeLessonSelect" name="lesson_id">
                                <?php
                                foreach ($lessons as $lesson) {
                                    echo "<option value='{$lesson["id"]}' >{$lesson["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for="updateGradeInput">Grade:</label>
                            <input class="form-control shadow-sm" id="updateGradeInput" oninput="gradeInputFormat(this)"
                                   type="number" name="grade">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="updateGrade()">Save</button>
            </div>
        </div>
    </div>
</div>
<!--Grade update modal End-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../assets/js/global/format.js"></script>
<script src="../assets/js/global/alertMessages.js"></script>
<script src="../assets/js/student_grade/student_grade.js"></script>

<script>
    $(document).ready(function () {

        const csrf_token = "<?php echo $_SESSION['csrf_token']; ?>";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrf_token
            }
        });


        const studentTable = $('#studentTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        });

        const lessonTable = $('#lessonTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        });

        const gradeTable = $('#gradeTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true
        });

        $('.filterStudentInput').on('keyup', function () {
            studentTable.columns($(this).parent().index()).search(this.value).draw();
        });

        $('.filterLessonInput').on('keyup', function () {
            lessonTable.columns($(this).parent().index()).search(this.value).draw();
        });

        $('.filterGradeInput').on('keyup change', function () {
            gradeTable.columns($(this).parent().index()).search(this.value).draw();
        });


        getStudentsForTable();
        getLessonsForTable();
        getGradesForTable();


    });
</script>


</body>
</html>
