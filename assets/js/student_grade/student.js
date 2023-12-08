    function openStudentCreateModal(){
        $("#studentCreateModal").modal("show");

    }

    function saveStudent() {
        var formData = $('#createStudentForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'student/store',
            data: formData,
        }).done(function (data){
            console.log(data);
        }).fail(function (err){
            console.log(err);
        });
    }

