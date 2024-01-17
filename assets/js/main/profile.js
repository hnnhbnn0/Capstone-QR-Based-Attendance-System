$(function(){
    loadProfile()   
    

})

function loadProfile() {
    // $.ajax({
    //     url:'../controller/main/profile-display.php',
    //     method:'POST',
    //     data: {
    //         acctid: $('#account-id').val(),
    //         fetch: 'profile',

    //     },
    //     dataType: 'json',
    //     success: function(response){
    //         console.log(response)
    //         // appendProfile(response);
    //     }
    // })
}

// function appendProfile(prof){
//     console.log(prof)


//     $('#account-id').val(prof.acctid)

//     $('#view-fullname').val(prof.fullname)
//     $('#group-firstname').val(prof.firstname)
//     $('#group-middle').val(prof.middlename)
//     $('#group-lastname').val(prof.lastname)

//     $('#view-gender').val(prof.gender)
//     $('#view-birthday').val(prof.birthday)
//     $('#view-vaxstatus').val(prof.vaxstat)
//     $('#edit-image').attr('src', prof.profilesrc)
//     $('#display-id').text(prof.acctid)

//     $('#view-email').val(prof.email)


// }


$(function() {
    $("#save-pro,#cancel-pro,#edit-profile").hide()
        $("#edit-pro").click(function(){
            $(this).hide();  
            $("#save-pro,#cancel-pro,#edit-profile").show();
        });
        $("#save-pro").click(function(){
            $(this).hide();  
            $("#cancel-pro,#edit-profile").hide();  
            $("#edit-pro").show();
        });
        $("#cancel-pro").click(function(){
            $(this).hide();  
            $("#save-pro,#edit-profile").hide();  
            $("#edit-pro").show();
        });

    $("#save-info,#cancel-info, .view-namegroup").hide()

    $("#edit-info").click(function(){

        
        $("#edit-info").hide();
        $("#save-info, #cancel-info, .view-namegroup").show()  
        // $('#view-namegroup , #view-gender, #view-birthday, #view-vaxstatus').attr('required', 'required')
        // $('#view-namegroup').removeAttr('disabled', 'disabled')
        // $('#view-gender').removeAttr('disabled', 'disabled')
        // $('#view-birthday').removeAttr('disabled', 'disabled')
        // $('#view-vaxstatus').removeAttr('disabled', 'disabled')
        $(".view-personal-info").prop('disabled', false)
        $(".view-personal-info").prop('required', true)
        

    });

    $("#save-info").click(function(){

        // $('.view-namegroup').attr('required', 'required')
        // $('#view-gender').attr('required', 'required')
        // $('#view-birthday').attr('required', 'required')
        // $('#view-vaxstatus').attr('required', 'required')
        $(".view-personal-info").prop('required', true)
        // $(".view-personal-info").prop('disabled', true)


        $("form#personal-info").submit()
    });

    $("#cancel-info").click(function() {
        $(this).hide();  
        $("#save-info, .view-namegroup").hide();  
        $("#edit-info, #view-fullname").show();
        // $('#view-fullname').attr('disabled', 'disabled')
        // $('#view-gender').attr('disabled', 'disabled')
        // $('#view-birthday').attr('disabled', 'disabled')
        // $('#view-vaxstatus').attr('disabled', 'disabled')
        // $(".view-personal-info").prop('required', false)
        $(".view-personal-info").prop('disabled',true)
        $('.view-personal-info').removeClass('is-valid')

        $('.view-personal-info').removeClass('is-invalid')
        $('.view-personal-info').removeClass('is-valid')
        
    });

    $("#save-acct, #cancel-acct").hide()
    $("#edit-acct").click(function(){
        $(this).hide();
        $("#save-acct, #cancel-acct").show();
        // $('#view-email').removeAttr('disabled', 'disabled')
        // $('#view-password').removeAttr('disabled', 'disabled')

        $(".account-info").prop('disabled', false)

    });

    $("#save-acct").click(function(){
        // $(this).hide();
        // $('#view-email').attr('required', 'required')
        // $('#view-password').attr('required', 'required')
        $(".view-personal-info").prop('required', true)
        $(".account-info").prop('disabled', false)


        $('form#account-info').submit()
    });

    $("#cancel-acct").click(function(){
        $(this).hide();
        $("#save-acct").hide();
        $("#edit-acct").show();
        $(".account-info").prop('disabled', true)
        $(".view-personal-info").prop('required', false)

        $('.account-info').removeClass('is-invalid')
        $('.account-info').removeClass('is-valid')
    });

    $('#view-email').keyup(function(){
        checkEmail()
    })

})



$(function(){
    $('#edit-profile, #edit-image').click(function(){
        $('#edit-file').trigger('click')
    })

    $('#edit-file').change(function(e){
        var src = URL.createObjectURL(e.target.files[0])
        $('#edit-image').attr('src', src)

        var filename = $('#edit-file')[0].files[0].name;
        Swal.fire({
            title: 'Replace Profile Image?',
            html:`Do you want to upload ${filename}?`,
            icon: 'info',
            showConfirmButton: true,
        }).then((result) => {
            if(result.isConfirmed){
                $('form#profile-upload').submit()
                Swal.fire({
                    title: 'Upload Success!',
                    text: 'You have successfully uploaded the image.',
                    icon: 'success',
                })
            }   
        })
    })

    $("form#personal-info").submit(function(evt){   

        var count = 0;

        // if($('.view-namegroup').val() != ''){
        //     $('.view-namegroup').addClass('is-valid')
        //     $('.view-namegroup').removeClass('is-invalid')
        //     count++;
        // }else{
        //     $('.view-namegroup').addClass('is-invalid')
        //     $('.view-namegroup').removeClass('is-valid')
        // }

        // if($('#view-gender').val() != ''){
        //     $('#view-gender').addClass('is-valid')
        //     $('#view-gender').removeClass('is-invalid')
        //     count++;
        // }else{
        //     $('#view-gender').addClass('is-invalid')
        //     $('#view-gender').removeClass('is-valid')
        // }

        // if($('#view-birthday').val() != ''){
        //     $('#view-birthday').addClass('is-valid')
        //     $('#view-birthday').removeClass('is-invalid')
        //     count++;
        // }else{
        //     $('#view-birthday').addClass('is-invalid')
        //     $('#view-birthday').removeClass('is-valid')
        // }

        if($('#view-vaxstatus').val() != ''){
            $('#view-vaxstatus').addClass('is-valid')
            $('#view-vaxstatus').removeClass('is-invalid')
            count++;
        }else{
            $('#view-vaxstatus').addClass('is-invalid')
            $('#view-vaxstatus').removeClass('is-valid')
        }

        if(count == 1){
            evt.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '/controller/main/profile-update.php',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                             
                    $('#save-info').hide();  
                    $("#cancel-info , .view-namegroup").hide();  
                    $("#edit-info, #view-fullname").show();
                    $('#view-fullname').attr('disabled', 'disabled')
                    // $('#view-contactno').attr('disabled', 'disabled')
                    // $('#view-birthday').attr('disabled', 'disabled')
                    // $('#view-gender').attr('disabled', 'disabled')
                    // $('#view-address').attr('disabled', 'disabled')
                    
                    $(".view-personal-info").prop('disabled', true)
                    $('.view-personal-info').removeClass('is-valid')


                    loadUser()

                    Swal.fire({
                        title: response.title,
                        html:  response.html,
                        icon:  response.icon,
                    })

                    // loadInventory()
                }
            });
                return false;  
        }else{
            Swal.fire({
                title: 'Input Error!',
                html: 'You have ' + Math.abs(parseInt(count-1)) + ' missing inputs',
                icon: 'warning',
            })
            return false
        }
    });

    $("form#account-info").submit(function(evt){   

        evt.preventDefault()

        var count = 0;
        checkEmail()

        
        

        // if($('#view-email').val() != ''){
        //     $('#view-email').addClass('is-valid')
        //     $('#view-email').removeClass('is-invalid')
        //     count++;
        // }else{
        //     $('#view-email').addClass('is-invalid')
        //     $('#view-email').removeClass('is-valid')
        //     $('#invalid-email').text('Invalid email format.')
        // }

        if($('#view-password').val() != ''){
            $('#view-password').addClass('is-valid')
            $('#view-password').removeClass('is-invalid')
            count++;
        }else if($('#view-password').val().length < 8){
            $('#view-password').addClass('is-invalid')
            $('#view-password').removeClass('is-valid')
            
            $('#invalid-password').text('This password must be greater or equal to 8 chars.')
        }else{
            $('#view-password').addClass('is-invalid')
            $('#view-password').removeClass('is-valid')
            $('#invalid-password').text('This password is invalid.')
        }


        if(count == 1){
            evt.preventDefault();
            var formData = new FormData($(this)[0]);

            $.ajax({
                url: '/controller/main/profile-update.php',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function (response) {
                    console.log(response);

                    $(".account-info").prop('disabled', true)
                    $('.account-info').removeClass('is-valid')

                    $('#save-acct').hide();  
                    $("#cancel-acct").hide();  
                    $("#edit-acct").show();
                    

                    Swal.fire({
                        title: 'Update Success!',
                        html: 'You have successfully updated your account information.',
                        icon: 'success',
                    })


                    loadUser()

                }
            });
                return false;  
        }else{
            Swal.fire({
                title: 'Input Error!',
                html: 'You have ' + Math.abs(parseInt(count-1)) + ' missing inputs',
                icon: 'warning',
            })
            return false
        }
    });


    $('form#profile-upload').submit(function(e){

        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: '/controller/main/profile-update.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            enctype: 'multipart/form-data',
            processData: false,
            success: function (response) {

                console.log(response);

                Swal.fire({
                    title: 'Update Success!',
                    html: 'You have successfully updated your profile image.',
                    icon: 'success',
                })

                loadUser()

            }
        });
            return false;
    })
})
$(function(){

    let account_id = $('#account-id').val()
    $('.personal_id').val(account_id)
    
})

function checkEmail() {
    console.log('haha')
    var pattern = /^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{2,3})+$/;
    var email = $('#view-email').val();
    var validEmail = pattern.test(email);

    if (!validEmail){
        $('#view-email').addClass('is-invalid')
        $('#view-email').removeClass('is-valid')
        $('#invalid-email').text('Your email address is invalid.');
        return false;
    }else if(email == ''){
        $('#view-email').addClass('is-invalid')
        $('#view-email').removeClass('is-valid')
        $('#invalid-email').text('Please enter your email address.');
        return false;
    }else{
        $('#view-email').addClass('is-valid')
        $('#view-email').removeClass('is-invalid')
        $('#invalid-email').text('Your email is valid.');
        return true;
    }
}

