$(document).ready(function () {
    $(".btn-approve").click(function (event) {
        event.preventDefault();
        $('#previewModal').modal('toggle');
        var url = $(this).data('url');
        var title = $(this).attr('title').toLowerCase();
        var name = $(this).data('name').toLocaleLowerCase();
        swal.fire({
            title: "Are you sure you want to " + title + " this " + name + "?",
            text: "You cannot revert this action.",
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (result.isConfirmed) {
                swal.fire({
                    title: "Loading...",
                    text: "Please wait while system is processing your request.",
                    button: false,
                    closeOnClickOutside: false,
                    showConfirmButton: false
                });

                $.ajax({
                    type: 'GET',
                    url: url
                }).done(function (response) {
                    var message = response.message;
                    var title = (response.status) ? "Success" : "Error";

                    swal.fire({
                        title: title + '!',
                        text: message,
                        icon: title.toLowerCase(),
                        button: false,
                        closeOnClickOutside: false
                    });

                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                });
            }
        });
    });

    $(".btn-update-process").click(function (event) {
        event.preventDefault();

        var process = $('#update-process').val();
        $('#previewModal').modal('toggle');
        var url = $(this).data('url');
        var title = $(this).attr('title').toLowerCase();

        swal.fire({
            title: "Are you sure you want to " + title + " this applicant?",
            text: "You cannot revert this action.",
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (result.isConfirmed) {
                swal.fire({
                    title: "Loading...",
                    text: "Please wait while system is processing your request.",
                    button: false,
                    closeOnClickOutside: false,
                    showConfirmButton: false
                });
                var token = $("meta[name='csrf-token']").attr('content');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        _token: token,
                        process: process,
                    },
                }).done(function (response) {
                    var message = response.message;
                    var title = (response.status) ? "Success" : "Error";

                    swal.fire({
                        title: title + '!',
                        text: message,
                        icon: title.toLowerCase(),
                        button: false,
                        closeOnClickOutside: false
                    });

                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                });
            }
        });
    });

    $("form").submit(function () {
        $(".loader-overlay").show();
    });

    $(".modal").on('hide.bs.modal', function () {
        $(this).find(':input').not('input[name="_token"],input[name="_method"]').val('');
    });

    $(document).on('click', '.btn-details-update', function(){
        
        var url = $(this).data('url');
        var name = $(this).data('name');
     
        fetchInfo(url).then(function (response) {
            var data = response.data;

            $('input[name=first_name]').val(data.first_name);
            $('input[name=last_name]').val(data.last_name);
            $('input[name=username]').val(data.username);
            $('input[name=email]').val(data.email);
            $('select > option#role'+data.role_id).attr('selected','selected');
            $('form').attr('action',baseUrl+'res/applicant/'+data.id)
            validateEmptyFields();
         });
          
    });

    
    $(document).on('click', '.btn-details', function(){
        var url = $(this).data('url');
        var name = $(this).data('name');
     
        fetchInfo(url).then(function (response) {
            var data = response.data;

            var currentTab = $('ul.nav-tabs > li > a[aria-selected="true"]').text();

            $('#btn-submit-approve').attr('data-url',adminUrl+'/system/'+name+'/approve/'+data.id);
            $('#btn-submit-approve').attr('data-user',data.id);
            $('#btn-submit-reject').attr('data-url',adminUrl+'/system/'+name+'/reject/'+data.id);
            $('#btn-submit-reject').attr('data-user',data.id);

            $('#btn-submit-update-process').attr('data-url',adminUrl+'/applicant/update-process/'+data.id);
            $('#update-process').val([]);
            $('#btn-submit-approve').show();
            $('#btn-submit-reject').show();
            $('#update-process').hide();
            $('#btn-submit-update-process').hide();
            if(currentTab == 'Approved' || currentTab == 'Rejected'){
                $('#btn-submit-approve').hide();
                $('#btn-submit-reject').hide();

                $('#update-process').show();
                $('#btn-submit-update-process').show();
                $('#update-process option[value="'+data.process+'"]').attr('selected', 'selected');
            }
            
            // step 1
            if(data['registration_type'] == 1){$('.p_regtype').text(' (Commissionship)');}
            if(data['registration_type'] == 2){$('.p_regtype').text(' (Enlistment)');}
            if(data.category == 1){$('.p_category').text('Technical Line Officer');}
            if(data.category == 2){ $('.p_category').text('General Line Officer'); }
            $('.p_first_name').text(data.first_name);
            $('.p_last_name').text(data.last_name);
            $('.p_middle_name').text(data.middle_name ? data.middle_name : "N/A");
            $('.p_name_ext').text(data.name_ext ? data.name_ext : "N/A");
            $('.p_province').text(data.province);
            $('.p_region_code_not_hidden').text(data.region_code ? data.region_code : "N/A");
            $('.p_city').text(data.city);
            $('.p_barangay').text(data.barangay);
            $('.p_birth_place').text(data.birth_place);
            $('.p_birth_date').text(data.birth_date);
            $('.p_age').text(data.applicant_age);
            $('.p_sex').text(data.sex);
            $('.p_marital_status').text(data.marital_status);
            $('.p_citizenship').text(data.citizenship);
            $('.p_height').text(data.height);
            $('.p_weight').text(data.weight);
            $('.p_profession').text(data.profession);
            $('.p_email').text(data.email);
            $('.p_mobile1').text(data.mobile_no ? data.mobile_no : "N/A");
            $('.p_mobile2').text(data.mobile_no_2 ? data.mobile_no_2 : "N/A");
            $('.p_profile').html(`<a class="fancybox" href="${storageUrl}${data.profile}" data-fancybox="image"><img width="100" src="${storageUrl}${data.profile}"></a>`);
             // step 2
            $('.p_school').text(data.college_name);
            $('.p_course').text(data.college_course);
            $('.p_remarks').text(data.remarks ? data.remarks : "N/A");
            $('.p_course_from').text(data.college_start_date);
            $('.p_course_to').text(data.college_end_date);
            $('.p_units').text(data.college_units_earned);
            $('.p_graduate').text(data.education_completion);
            $('.p_prc').text(data.civil_service_eligibility);
            $('.p_rating').text(data.rating);
        
            // valida documents
            $.each(JSON.parse(data.valid_document), function(index, value){
                if(openFile(value) == 'image'){
                    $('.p_'+index).html(`<a class="fancybox" href="${docsUrl}${data.id}/${index}" data-fancybox="image"><img width="100" src="${docsUrl}${data.id}/${index}"></a>`);
                }else if(openFile(value) == 'pdf'){
                    $('.p_'+index).html(`<a href="${docsUrl}${data.id}/${index}" target="_blank">View File</a>`);
                }else{
                    $('.p_'+index).html('N/A');
                }
            });

            var skills = [];
            $.each(JSON.parse(data.skills), function(index, value){
                skills.push(value);
            });
            $('.p_skills').text(skills);
            $('.p_other_skills').text(data.other_skill ? data.other_skill : "N/A");

            var cl = [];
            $.each(JSON.parse(data.competency_level), function(index, value){
                cl.push(value);
            });
            $('.p_competency_level').text(cl);

            var t_name = [];
            $.each(JSON.parse(data.tesda_course), function(index, value){
                t_name.push('<p>' + (value ? value : "N/A")  + '</p>');
            });
            $('.p_tesda').html(t_name);

            var t_from = [];
            $.each(JSON.parse(data.tesda_start_date), function(index, value){
                t_from.push('<p>' + (value ? value : "N/A")  + '</p>');
            });
            $('.p_tesda_from').html(t_from);

            var t_to = [];
            $.each(JSON.parse(data.tesda_end_date), function(index, value){
                t_to.push('<p>' + (value ? value : "N/A")  + '</p>');
            });
            $('.p_tesda_to').html(t_to);
            // step 4
            $('.p_username').text(data.username);

            validateEmptyFields();
         });
    });
});
