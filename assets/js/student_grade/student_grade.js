    function openStudentCreateModal(){
        $("#createStudentNameInput").val("");
        $("#createStudentSurnameInput").val("");
        $("#createStudentNumberInput").val("");

        $("#studentCreateModal").modal("show");
    }

    function saveStudent() {
        const formData = $('#createStudentForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'student/store',
            data: formData,
        }).done(function (data){
            AlertMessages.showSuccess(data.messages,2000);
            $("#studentCreateModal").modal("hide");

            getStudentsForTable();

        }).fail(function (err){
            AlertMessages.showError(err.responseJSON.errors,3500);
        });
    }

    function openStudentUpdateModal(id, name, surname, student_number) {
        $("#updateStudentIdInput").val(id);
        $("#updateStudentNameInput").val(name);
        $("#updateStudentSurnameInput").val(surname);
        $("#updateStudentNumberInput").val(student_number);

        $("#studentUpdateModal").modal("show");
    }

    function updateStudent() {
        const formData = $('#updateStudentForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'student/update',
            data: formData,
        }).done(function (data) {
            AlertMessages.showSuccess(data.messages, 2000);
            $("#studentUpdateModal").modal("hide");
            getStudentsForTable();
            getGradesForTable();
        }).fail(function (err) {
            AlertMessages.showError(err.responseJSON.errors, 3500);
        });
    }

    function deleteStudent(id){
        Swal.fire({
            title: "Are you sure?",
            html: "You won't be able to revert this! <br> (The student's grades will also be deleted)",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'student/delete',
                    data: {
                        id:id,
                    },
                }).done(function (data){
                    AlertMessages.showSuccess(data.messages,2000);
                    getStudentsForTable();
                    getGradesForTable();
                }).fail(function (err){
                    AlertMessages.showError(err.responseJSON.errors,3500);
                });
            }
        });
    }

    function openLessonCreateModal(){
        $("#createLessonNameInput").val("");

        $("#lessonCreateModal").modal("show");
    }

    function saveLesson() {
        const formData = $('#createLessonForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'lesson/store',
            data: formData,
        }).done(function (data){
            AlertMessages.showSuccess(data.messages,2000);
            $("#lessonCreateModal").modal("hide");
            getLessonsForTable();
        }).fail(function (err){
            AlertMessages.showError(err.responseJSON.errors,3500);
        });
    }

    function openLessonUpdateModal(id, name) {
        $("#updateLessonIdInput").val(id);
        $("#updateLessonNameInput").val(name);

        $("#lessonUpdateModal").modal("show");
    }

    function updateLesson() {
        const formData = $('#updateLessonForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'lesson/update',
            data: formData,
        }).done(function (data) {
            AlertMessages.showSuccess(data.messages, 2000);
            $("#lessonUpdateModal").modal("hide");
            getLessonsForTable();
            getGradesForTable();
        }).fail(function (err) {
            AlertMessages.showError(err.responseJSON.errors, 3500);
        });
    }

    function deleteLesson(id){
        Swal.fire({
            title: "Are you sure?",
            html: "You won't be able to revert this! <br> (The student's grades will also be deleted)",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'lesson/delete',
                    data: {
                        id:id,
                    },
                }).done(function (data){
                    AlertMessages.showSuccess(data.messages,2000);
                    getLessonsForTable();
                    getGradesForTable();
                }).fail(function (err){
                    AlertMessages.showError(err.responseJSON.errors,3500);
                });
            }
        });
    }

    function openGradeCreateModal(){
        $("#createGradeStudentSelect").val("").trigger("change");
        $("#createGradeLessonSelect").val("").trigger("change");
        $("#createGradeInput").val("");

        $("#gradeCreateModal").modal("show");
    }

    function saveGrade(){
        const formData = $('#createGradeForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'grade/store',
            data: formData,
        }).done(function (data){
            AlertMessages.showSuccess(data.messages,2000);
            $("#gradeCreateModal").modal("hide");
            getGradesForTable();
            getStudentsForTable();
        }).fail(function (err){
            AlertMessages.showError(err.responseJSON.errors,3500);
        });

    }

    function openGradeUpdateModal(id, student_id, lesson_id,grade) {
        $("#updateGradeIdInput").val(id);
        $("#updateGradeStudentSelect").val(student_id).trigger("change");
        $("#updateGradeLessonSelect").val(lesson_id).trigger("change");
        $("#updateGradeInput").val(grade);

        $("#gradeUpdateModal").modal("show");
    }

    function updateGrade() {
        const formData = $('#updateGradeForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'grade/update',
            data: formData,
        }).done(function (data) {
            AlertMessages.showSuccess(data.messages, 2000);
            $("#gradeUpdateModal").modal("hide");
            getGradesForTable();
            getStudentsForTable();
        }).fail(function (err) {
            AlertMessages.showError(err.responseJSON.errors, 3500);
        });
    }

    function deleteGrade(id){
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'grade/delete',
                    data: {
                        id:id,
                    },
                }).done(function (data){
                    AlertMessages.showSuccess(data.messages,2000);
                    getGradesForTable();
                }).fail(function (err){
                    AlertMessages.showError(err.responseJSON.errors,3500);
                });
            }
        });
    }

    function getStudentsForTable() {
        $.ajax({
            type: 'GET',
            url: 'student',
        }).done(function(data) {
            $('#studentTable').DataTable().clear();
            let options = [];
            $("#gradeStudentFilterSelect").html("<option value=''  >Search Student...</option>");
            data.students.forEach(function(student) {
                options.push({id:student.id, text:student.name + " " + student.surname});
                $("#gradeStudentFilterSelect").append(`<option value="${student.name}  ${student.surname}" >${student.name}  ${student.surname}</option>`);
                $('#studentTable').DataTable().row.add([
                    student.full_name,
                    student.student_number,
                    student.grade_average ?? "0.00",
                    `
                <button class="btn btn-sm bg-primary text-white me-2" onclick="openStudentUpdateModal(${student.id}, '${student.name}', '${student.surname}', ${student.student_number})"><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white" onclick="deleteStudent(${student.id})"><i class="fa-solid fa-trash"></i></button>`
                ]).draw();
            });
            $("#createGradeStudentSelect").empty();
            $("#createGradeStudentSelect").select2({
                data: options,
                dropdownParent: $("#gradeCreateModal"),
                width: "100%",
            });
            $("#updateGradeStudentSelect").empty();
            $("#updateGradeStudentSelect").select2({
                data: options,
                dropdownParent: $("#gradeUpdateModal"),
                width: "100%",
            });


        }).fail(function(err) {
            console.log(err);
        });
    }

    function getLessonsForTable() {
        $.ajax({
            type: 'GET',
            url: 'lesson',
        }).done(function(data) {
            $('#lessonTable').DataTable().clear();
            let options = [];
            $("#gradeLessonFilterSelect").html("<option value=''  >Search Lesson...</option>");

            data.lessons.forEach(function(lesson) {
                options.push({id:lesson.id, text:lesson.name });
                $("#gradeLessonFilterSelect").append(`<option value="${lesson.name}" >${lesson.name}</option>`);
                $('#lessonTable').DataTable().row.add([
                    lesson.name,
                    `<button class="btn btn-sm bg-primary text-white me-2" onclick="openLessonUpdateModal(${lesson.id}, '${lesson.name}')"><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white" onclick="deleteLesson(${lesson.id})"><i class="fa-solid fa-trash"></i></button>`
                ]).draw();
            });
            $("#createGradeLessonSelect").empty();
            $("#createGradeLessonSelect").select2({
                data: options,
                dropdownParent: $("#gradeCreateModal"),
                width: "100%",
            });

            $("#updateGradeLessonSelect").empty();
            $("#updateGradeLessonSelect").select2({
                data: options,
                dropdownParent: $("#gradeUpdateModal"),
                width: "100%",
            });

        }).fail(function(err) {
            console.log(err);
        });
    }

    function getGradesForTable() {
        $.ajax({
            type: 'GET',
            url: 'grade',
        }).done(function(data) {
            $('#gradeTable').DataTable().clear();

            data.grades.forEach(function(grade) {
                $('#gradeTable').DataTable().row.add([
                    grade.student_full_name,
                    grade.lesson_name,
                    grade.grade,
                    `<button class="btn btn-sm bg-primary text-white me-2" onclick="openGradeUpdateModal(${grade.id}, ${grade.student_id}, ${grade.lesson_id},${grade.grade} )"><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white" onclick="deleteGrade(${grade.id})"><i class="fa-solid fa-trash"></i></button>`
                ]).draw();
            });


        }).fail(function(err) {
            console.log(err);
        });
    }







