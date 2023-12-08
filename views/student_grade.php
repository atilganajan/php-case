<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <link rel="stylesheet" href="../assets/css/student_grade/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js"></script>

    <script src="../assets/js/global.js" ></script>
    <script src="../assets/js/student_grade/student.js" ></script>

</head>
<body>

<div class="top-nav">
    <div class="logo">
        <p>Student Grade Tracking System</p>
    </div>
</div>

<div class="top-action row justify-content-center w-100">
    <div class="card col-sm-6 col-md-4 col-lg-3 text-center" onclick="openStudentCreateModal()" >
        <p ><i class="fa-solid fa-user"></i> Create Student</p>
    </div>
    <div class="card col-sm-6 col-md-4 col-lg-3 text-center">
        <p ><i class="fa-solid fa-book"></i> Create Lesson</p>
    </div>
</div>

<div class="table-section">
    <table class="table table-striped table-class" id= "table-id">

        <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Class</th>
            <th>Grade</th>
            <th>Action</th>
        </tr>

        </thead>

        <tbody>
        <tr>
            <td>Rajah Armstrong</td>
            <td>erat.neque@noncursusnon.ca</td>
            <td>1-636-140-1210</td>
            <td>Oct 26, 2015</td>
            <td>Oct 26, 2015</td>
        </tr>
        <tr>
            <td>Kuame Parsons</td>
            <td>non.sapien@in.com</td>
            <td>1-962-122-8834</td>
            <td>Aug 2, 2015</td>
            <td>Oct 26, 2015</td>
        </tr>
        <tr>
            <td>Ira Parker</td>
            <td>Vivamus.molestie.dapibus@quisturpisvitae.edu</td>
            <td>1-584-906-8572</td>
            <td>Sep 15, 2015</td>
            <td>Oct 26, 2015</td>
        </tr>
        <tr>
            <td>Dante Carlson</td>
            <td>dis.parturient@mi.co.uk</td>
            <td>1-364-156-9666</td>
            <td>Nov 28, 2015</td>
            <td>Oct 26, 2015</td>
        </tr>

        </tbody>

    </table>
</div>

<!--Student create modal Start-->
<div class="modal fade" id="studentCreateModal" tabindex="-1" aria-labelledby="studentCreateModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" >Create Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createStudentForm">
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div>
                        <label for="createStudentNameInput">Name:</label>
                        <input class="form-control shadow-sm" id="createStudentNameInput" type="text" maxlength="100" name="name" required>
                    </div>
                    <div class="mt-2">
                        <label for="createStudentSurnameInput">Surname:</label>
                        <input class="form-control shadow-sm" id="createStudentSurnameInput" type="text" maxlength="100" name="surname" required>
                    </div>
                    <div class="mt-2" >
                        <label for="createStudentNumberInput">Number:</label>
                        <input class="form-control shadow-sm" id="createStudentNumberInput" type="text" maxlength="20" oninput="positiveNumberFormat(this)" name="studentNumber" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success"  onclick="saveStudent()">Save</button>
            </div>
        </div>
    </div>
</div>

<!--Student create modal End-->


</body>
</html>
