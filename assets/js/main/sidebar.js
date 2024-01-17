$(function() {

    loadUser()

    if(document.title == 'Dashboard'){
        $('.dashboard-tab').addClass('active')
    }else if(document.title == 'Manage Semester'){
        $('.semester-tab').addClass('active')
    }else if(document.title == 'Accounts'){
        $('.accounts-tab').addClass('active')
    }else if(document.title == 'Subjects'){
        $('.assign-tab').addClass('active')
    }else if(document.title == 'Profile'){
        $('.profile-tab').addClass('active')
    }
});

$(function() {
    if(document.title == 'Dashboard'){
        $('.dashboard-tab').addClass('active')
    }else if(document.title == 'Scan QR'){
        $('.scan-qr-tab').addClass('active')
    }else if(document.title == 'Reports'){
        $('.reports-tab').addClass('active')
    }else if(document.title == 'Announcement'){
        $('.announcement-tab').addClass('active')
    }else if(document.title == 'Profile'){
        $('.profile-tab').addClass('active')
    }
});


$(function(){

    $('body').addClass(localStorage.getItem('interface'))

    $('#sidebar').attr('class', '')

    $('#sidebar').addClass('sidebar ' + localStorage.getItem('sidebar'))


    sidebarInit()


    $('.toggle').click(function(){

        $('#sidebar').toggleClass('close')

        if($('#sidebar').hasClass('close')){
            localStorage.setItem('sidebar', 'close')
        }else{
            localStorage.setItem('sidebar', 'open')
        }
    })

    $('.toggle-switch').click(function(){

        $('body').toggleClass('dark')

        sidebarInit()

    })
})

function sidebarInit(){
    if($('body').hasClass('dark')){
        $('.mode-text').text('Light Mode')
        localStorage.setItem('interface', 'dark')
        $('table').removeClass('table-light')
        $('table').addClass('table-dark')
    }else{
        $('.mode-text').text('Dark Mode')
        localStorage.setItem('interface', 'light')
        $('table').removeClass('table-dark')
        $('table').addClass('table-light')
    }
}

function loadUser(){
    console.log(1)
    $.ajax({
        url: '/controller/main/profile-display.php',
        method: 'post',
        dataType: 'json',
        data:{
            fetch: 'profile',
            acctid: $('#account-id').val(),
        },
        success: function(response){

            // $('#view-gender').val(response.gender)
            // // $('#view-vaxstatus').val(response.vaxstat)

            $('.prime-acctid').val(response.acctid)
            $('.prime-email').val(response.email)
            $('.prime-firstname').val(response.firstname)
            $('.prime-lastname').val(response.lastname)
            $('.prime-middlename').val(response.middlename)
            $('.prime-fullname').val(response.fullname)
            $('.prime-gender').val(response.gender)
            $('.prime-birthday').val(response.birthday)
            $('.prime-profilesrc').attr('src', response.profilesrc != '' ? response.profilesrc : '/assets/img/user.png')
            $('.prime-vaxstat').val(response.vaxstat)
            $('.prime-userlevel').text(response.userlevel)
            $('.prime-qr-id').val(response.qr_id)

            $('.prime-qr-download').attr('download', 'Student-'+response.acctid)

            var qrcode = new QRCode(document.querySelector("#view-qr-code"), {
                text: response.qr_id,
                width: 256,
                height: 256,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H,
            })

            var src = document.querySelector("#view-qr-code").children[0].toDataURL("image/png");
            console.log(src)
            $('.prime-qr-src').attr('src', src)
            $('.prime-qr-download').attr('href', src)

            
            $('.prime-acctid').text(response.acctid)
            $('.prime-email').text(response.email)
            $('.prime-firstname').text(response.firstname)
            $('.prime-lastname').text(response.lastname)
            $('.prime-middlename').text(response.middlename)
            $('.prime-fullname').text(response.fullname)
            // $('.prime-gender').text(response.gender)
            // $('.prime-birthday').text(response.birthday)
            // $('.prime-vaxstat').text(response.vaxstat)
            $('.prime-userlevel').text(response.userlevel)
            $('.prime-qr-id').text(response.qr_id)

        },
        error: function(response){
            console.log(response)
        }
    })
}

$(function(){
    $('#qr-download').click(function(){
        html2canvas(document.querySelector('#view-qr-code')).then(function(canvas){
            var a = document.createElement("a");
            document.body.appendChild(a);
            document.getElementById(prime-qr-download).appendChild(canvas);
            a.download = "filename.jpg";
            a.href = canvas.toDataURL();
            a.target = '_blank';
            a.click();
        })
    })
})