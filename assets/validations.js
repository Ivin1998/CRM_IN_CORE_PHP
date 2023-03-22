         function highlight(button) {
            var row = button.parentNode.parentNode; //one parentnode for tr and one parentNode for td
            row.classList.add("highlighted");
        }
        function checkDelete(id, name) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'delete.php',
                        data: { id: id },
                        success: function (data) {
                            swal.fire({
                                text: "User details deleted successfully!",
                                icon: "success",
                            });
                            location.reload();
                        },
                    });
                }
            })
        }
        function savecontact() {
            var first_name = document.forms["contact"]["firstName"].value;
            const numeric = /^[0-9]/;
            const noalphabets = /^[A-Za-z]+$/;
            if (first_name == "" || !noalphabets.test(first_name)) {
                swal.fire({
                    text: "Please enter a valid first name!",
                    icon: "info"
                });
                return false;
            }
            let last_name = document.forms["contact"]["lastName"].value;
            if (last_name == "" || !noalphabets.test(last_name)) {
                swal.fire({
                    text: "Please enter a valid last name!",
                    icon: "info"
                });
                return false;
            }
            let mobile_number = document.forms["contact"]["mobileNumber"].value;
            if (mobile_number == "" || !numeric.test(mobile_number)) {
                swal.fire({
                    text: "Please enter a valid contact number!",
                    icon: "info"
                });

                return false;
            }
            let office_number = document.forms["contact"]["officeNumber"].value;
            if (office_number) {
                if (!numeric.test(office_number)) {
                    swal.fire({
                        text: "Please enter a valid office number!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let email_id = document.forms["contact"]["Email"].value;
            if (email_id) {
                if (noalphabets.test(email_id)) {
                    swal.fire({
                        text: "Please enter a valid email id!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let twitter_id = document.forms["contact"]["Twitter"].value;
            if (twitter_id) {
                if (noalphabets.test(twitter_id)) {
                    swal.fire({
                        text: "Please enter a valid Twitter handle!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let linkedin_id = document.forms["contact"]["Linkedin"].value;
            if (linkedin_id) {
                if (!noalphabets.test(linkedin_id)) {
                    swal.fire({
                        text: "Please enter a valid Linkedin profile!",
                        icon: "info"
                    });
                    return false;
                }
            }
            let facebook_id = document.forms["contact"]["Facebook"].value;
            if (facebook_id) {
                if (!noalphabets.test(facebook_id)) {
                    swal.fire({
                        text: "Please enter a valid Facebook profile!",
                        icon: "info"
                    });
                    return false;
                }
            }
            $.ajax({
                type: "POST",
                url: 'add_data.php',
                /* dataType : 'json', */
                data: $('#mycontact').serialize(),
                success: function (data) {
                    swal.fire({
                        text: "User details saved successfully!",
                        icon: "success",
                    });
                    location.reload();
                    $('.edit_data').hide();
                },
            });
        }
        /* Edit in popup modal*/
        $(document).on('click', '.edit_data', function () {
            var user_id = $(this).attr("id");

            var row = $(this).closest('tr');
            row.addClass("highlighted");
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: { id: user_id },
                dataType: "json",
                success: function (data) {
                    $('#firstName').val(data.first_name);
                    $('#lastName').val(data.last_name);
                    $('#department_name').val(data.department_id);
                    $('#mobileNumber').val(data.mobile_number);
                    $('#officeNumber').val(data.office_number);
                    $('#Email').val(data.email_id);
                    $('#Instagram').val(data.instagram_id);
                    $('#Twitter').val(data.twitter_id);
                    $('#Linkedin').val(data.linkedin_id);
                    $('#Facebook').val(data.facebook_id);
                    $('#id').val(user_id);
                    $('#add_con').click()
                    $('.modal-title').html('Edit Details');
                    $('#update-btn').show();
                    $('#Add').hide();
                    $('#reload').click(function () {
                        location.reload();
                    });
                }
            });
        });
       
        $(document).ready(function () {
            $("#update-btn").click(function () {
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: $('#mycontact').serialize(),
                    success: function (data) {
                        swal.fire({
                            text: "User details Updated successfully!",
                            icon: "success",
                        });
                        location.reload();
                    },
    
                });
            });
            $("#add_con").click(function () {
                $('#update-btn').hide();
                $('#Add').show();
            });
        });
        $(document).on('click', '.view_data', function () {
            var user_id = $(this).attr("id");
            if (user_id != '') {
                $.ajax({
                    url: "select.php",
                    method: "POST",
                    data: { id: user_id },
                    success: function (data) {
                        $('#myForm').html(data);
                        $('#add_con').click();
                        $('.modal-title').html('User Details');
                        $('#reload').click(function () {
                            location.reload();
                        });
                    }
                });
            }
        });
        //Datatypes
        $(document).ready(function () {
            $('#mytable').DataTable({
                dom: 'Blfrtip',
                pagingType: 'full_numbers',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
        


        $(document).ready(function () {
            $(".import").click(function () {
                $('#Feed_input').hide();
                $('#importing').show();
            });
            $("#submit").click(function () {
                $.ajax({
                    url: "import.php",
                    type: "POST",
                    data: $('#mycontact').serialize(),
                    success: function (data) {
                        swal.fire({
                            text: "User details Added successfully!",
                            icon: "success",
                        });
                        location.reload();
                    },
                });
                location.reload();
            });
        });


        $(document).ready(function () {
            $("#add_con").click(function () {
                $('#importing').hide();
                $('#Feed_input').show();
            });

            $("#dept_add").click(function(){
                $.ajax({
                    url: "add_departments.php",
                    type: "POST",
                    data: $('#mycontact').serialize(),
                    success: function (data) {
                        swal.fire({
                            text: "User details added successfully!",
                            icon: "success",
                        });
                        location.reload();
                    },
    
                });
            })
        });


   