$(document).ready(e => {

    $('#first_seme').on('submit', e => {
        e.preventDefault();
        $('.submit').prop('disabled', true);
        let form = $('#first_seme');
        let urlink = form.attr("action");
        let _token = $('input[name="_token"]').val();
        let course = $('#course1').val();
        let course_ = $('#course1')
        let unit = $('#unit1').val();
        let grade = $('#grade1').val();
        let grade_alpha = $('#grade1 option:selected').text()
        let semester = $('#semester1').val();
        let tbody = $('.tbody_first tr:last-of-type');
        let gp = $('#gp1');
        let fsgp = $('#fsgp');

        ajax(form, urlink, _token, semester, course, course_, unit, grade, grade_alpha, tbody, gp, fsgp);

    });


    $('#second_seme').on('submit', e => {
        e.preventDefault();
        $('.submit').prop('disabled', true);
        let form = $('#second_seme');
        let urlink = form.attr("action");
        let _token = $('input[name="_token"]').val();
        let course = $('#course2').val();
        let course_ = $('#course2')
        let unit = $('#unit2').val();
        let grade = $('#grade2').val();
        let grade_alpha = $('#grade2 option:selected').text()
        let semester = $('#semester2').val();
        let tbody = $('.tbody_second tr:last-of-type');
        let gp = $('#gp2');
        let fsgp = $('#fsgp');

        ajax(form, urlink, _token, semester, course, course_, unit, grade, grade_alpha, tbody, gp, fsgp);

    });






    function ajax(form, urlink, _token, semester, course, course_, unit, grade, grade_alpha, tbody, gp, fsgp) {
        unit = [unit];
        grade = [grade];
        course = [course];
        grade_alpha = [grade_alpha];
        $.ajax({
            url: urlink,
            type: "POST",
            data: {
                _token: _token,
                semester: semester,
                course: course,
                unit: unit,
                grade: grade,
                grade_alpha: grade_alpha
            },
            success: function(response) {
                if (response == 'exists') {
                    alert('Course added already');
                    $('.submit').prop('disabled', false);
                } else {
                    tbody.before(`
        <tr>
                <td scope="row" class="fw-bold text-uppercase">
                    ${response.course}
                </td>
                <td>${response.unit}</td>
                <td>
                    ${response.grade_alpha}
                </td>
                <td>
                    <form
                        action="${response.remove_result}" method="post" class="delete_course">
                        <input type="hidden" name="_token" value="PpqjepM8fEKv3Qx4r69Sq5BorsOLLHdSMMHDCUsa">
                        <button class='btn btn-link shadow-none'><svg
                                xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-trash"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd"
                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg></button>
                    </form>
                </td>
            </tr>
            `);
                    gp.text(response.cgpa);
                    fsgp.text(response.fs_cgpa);
                    form.trigger('reset');
                    course_.focus();
                    $('.submit').prop('disabled', false);

                }
            },
            error: function(response) {
                alert('Something went wrong, Try again')
            }
        });


    }

    delete course
    $(document).on('submit', '.delete_course', function(e) {
        e.preventDefault();
        $('.delete').prop('disabled', true);
        let urlink = $(this).attr('action');
        let row = $(this).parent().parent()
        let _token = $('input[name="_token"]').val();
        let gp1 = $('#gp1');
        let gp2 = $('#gp2');
        let fsgp = $('#fsgp');
        $.ajax({
            url: urlink,
            type: "POST",
            _token: _token,
            data: {
                _token: _token,
            },
            success: function(response) {
                row.remove();
                if (response == 'result empty') {
                    gp1.text('X.XX');
                    gp2.text('X.XX');
                    fsgp.text('X.XX');
                } else if (response.semester == 'firstempty') {
                    gp1.text('X.XX');
                    fsgp.text(response.fs_cgpa);
                } else if (response.semester == 'secondempty') {
                    gp2.text('X.XX');
                    fsgp.text(response.fs_cgpa);
                } else if (response.cgpa1) {
                    gp1.text(response.cgpa1);
                    fsgp.text(response.fs_cgpa);
                } else if (response.cgpa2) {
                    gp2.text(response.cgpa2);
                    fsgp.text(response.fs_cgpa);
                }
                $('.delete').prop('disabled', false);
            },
            error: function(response) {
                alert('Something went wrong, Try again')
            }
        });
    });
});