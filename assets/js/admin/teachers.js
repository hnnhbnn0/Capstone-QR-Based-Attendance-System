$(function(){

    loadActiveSubjects()

    $('#add-subjects').click(function(){
        if($('#select-subject').val() !== null){
            
            var yearlevel = $('#select-subject option:selected').text();
            var btn = '';
                
            if(yearlevel.substr(1,1) == 1){
                btn = 'btn-success';
            }else if(yearlevel.substr(1,1) == 2){
                btn = 'btn-warning';
            }else if(yearlevel.substr(1,1) == 3){
                btn = 'btn-danger';
            }else if(yearlevel.substr(1,1) == 4){
                btn = 'btn-primary';
            }
            console.log(yearlevel.substr(1,1))
            $('#lists-of-subjects').append(`
                <input readonly class="btn ${btn} mb-2 col-lg-2 mx-1 btn-sm" name="subject[]" value="${$('#select-subject').val()}" type="text" onclick="RevertToSelect(this)" title="${$('#select-subject option:selected').text()}" data-bs-toggle="tooltip" data-bs-placement="top"></input>
            `)
            $('select#select-subject option').each(function(){
                if($(this).val() == $('#select-subject').val()){
                    $(this).hide()
                }
            })
            $('#select-subject').val($('#select-subject option:selected').next().val()).trigger('change')
        }
    })

})

function RevertToSelect(that){
    that.remove()
    $('select#select-subject option').each(function(){
        if($(this).val() == that.value){
            $(this).show()
        }
    })
}

function RevertToEditSelect(that){
    that.remove()
    $('select#edit-select-subjects option').each(function(){
        if($(this).val() == that.value){
            $(this).show()
        }
    })
}

function loadActiveSubjects(){
    $.ajax({
        url: "/controller/admin/teacher-controller.php",
        method: "POST",
        data: {
            id: $('#account-id').val(),
            fetch: 'subjects',
            datalist: 'All',
        },
        dataType: 'json',
        success: function(response) {
            console.log(response)

            $('#select-subject').empty()
            $('#select-subject').append(`<option disabled selected value="" class="dropdown-header">- Select Subjects -</option>`)
            for(i = 0; i < r.rowlimit; i++){
               $('#select-subject').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }

            $('#edit-select-subjects').empty()
            $('#edit-select-subjects').append(`<option disabled selected value="" class="dropdown-header">- Select Subjects -</option>`)
            for(i = 0; i < response.rowlimit; i++){
               $('#edit-select-subjects').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }
            

        }
    })
}

$(function(){
    var edit_array = [];
    $('#edit-subjects').click(function(){
        if($('#edit-select-subjects').val() !== null){
            
            var yearlevel = $('#edit-select-subjects option:selected').text();
            var btn = '';
                
            if(yearlevel.substr(1,1) == 1){
                btn = 'btn-success';
            }else if(yearlevel.substr(1,1) == 2){
                btn = 'btn-warning';
            }else if(yearlevel.substr(1,1) == 3){
                btn = 'btn-danger';
            }else if(yearlevel.substr(1,1) == 4){
                btn = 'btn-primary';
            }
            console.log(yearlevel.substr(1,1))
            $('#edit-lists-of-subjects').append(`
                <input readonly class="btn ${btn} mb-2 col-lg-2 mx-1 btn-sm" name="subject[]" value="${$('#edit-select-subjects').val()}" type="text" onclick="RevertToEditSelect(this)" title="${$('#edit-select-subjects option:selected').text()}"></input>
            `)
            $('select#edit-select-subjects option').each(function(){
                if($(this).val() == $('#edit-select-subjects').val()){
                    $(this).hide()
                }
            })
            $('#edit-select-subjects').val($('#edit-select-subjects option:selected').next().val()).trigger('change')
        }
    })
})

$(function(){
    $('#search-teacher').keyup(function(){

        if($('#search-teacher').val() != ''){

            $.ajax({
                url: "/controller/admin/teacher-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    fetch: 'teachers',
                    search: $('#search-teacher').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    appendTeachers(response)

                }
            })
        }else{
            loadTeachers()
        }
    })
});
function loadTeachers(){
    $.ajax({
        url: '../controller/admin/teacher-controller.php',
        method: 'POST',
        data:{
            id: $('#account-id').val(),
            fetch: 'teachers',
        },
        dataType: 'json',
        success: function(response){
            console.log(response)
            appendTeachers(response)
        }
    })
}

// $(function(){
//     $('#search-teacher').keyup(function(){

//         if($('#search-teacher').val() != ''){
//             $.ajax({
//                 url: "/controller/admin/teacher-controller.php",
//                 method: "POST",
//                 data: {
//                     id: $('#account-id').val(),
//                     category: 'teachers',
//                     search: $('#search-teacher').val(),
//                 },
//                 success: function(response) {
//                     console.log(response)
//                     appendTeachers(response)
//                 }
//             })
//         }else{
//             loadTeachers()
//         }
//     })
// });

function appendTeachers(tea){
    
    active_year = tea.acad_year == null ? '' : tea.acad_year + ''
    active_sem = tea.sem == null ? '' : tea.sem

    $('#acad-year-semester').text(active_year + '-'+ active_sem)
    $('#input-acad-year, .active-year').val(active_year)
    $('#input-semester, .active-sem').val(active_sem)
    $('#display-acad-year').val(active_year)
    $('#display-semester').val(active_sem)

    $('#teacher-thead').empty()
    $('#teacher-thead').append(`
        <tr style="display:none" data-height="35">
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-l-s="thin" data-b-t-s="thin">Employee ID</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-l-s="thin" data-b-t-s="thin">Email Address</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-l-s="thin" data-b-t-s="thin">First Name</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-l-s="thin" data-b-t-s="thin">Middle Name</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-l-s="thin" data-b-t-s="thin" data-b-r-s="thin">Last Name</td>
        </tr>
        <tr data-exclude="true" class="h5 mb-0 text-center text-truncate">
           
            <th data-exclude="true" >Employee ID</th>
            <th data-exclude="true" >Email</th>
            <th data-exclude="true" >Full Name</th>
            <th data-exclude="true" >Status</th>
            <th data-exclude="true" >Action</th>
        </tr>
        <tr class="" style="display: none">
            <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${(new Date).getFullYear()}XXXXXX</td>
            <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">juan.delacruz.m@bulsu.edu.ph</td>
            <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Juan</td>
            <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Martinez</td>
            <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Dela Cruz</td>
           
        </tr>
        
    `)

    

    $('#teacher-tbody').empty()
    if(tea.rowlimit <= 0){
        $('#teacher-tbody').append(`
        <tr class="h6 mb-0 text-center text-truncate align-middle">
          
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        `)
    }else{
        for(i=0;i<tea.rowlimit;i++){
            i_status = tea.status[i] == 'Active' ? 'btn-success text-light bi bi-send-fill' : 'btn-success text-light bi bi-check-lg'
            i_class = tea.status[i] == 'Active' ? 'bg-success' : 'bg-danger'
            status_class = tea.status[i] == 'Inactive' ? 'bg-danger' : 'bg-success';
            $('#teacher-tbody').append(`
                <tr class="h6 mb-0 text-center text-truncate align-middle">
                    <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${tea.employeeid[i]}</td>
                    <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${tea.email[i]}</td>
                    <td data-exclude="true">${tea.fullname[i]}</td>
                    <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.firstname[i]}</td>
                    <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.middlename[i]}</td>
                    <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${tea.lastname[i]}</td>
                    
                    <td data-exclude="true">
                        <span class="badge ${i_class} fs-6 rounded-pill mb-0">${tea.status[i]}</span>
                    </td>
                <td data-exclude="true">
                    
                    <button class="btn ${i_status} btn-sm" onclick="ActivateEmail('${tea.employeeid[i]}')"></button>
                </td>
                </tr>
            `)
        }
    }

}

$(function(){
    loadTeachers()

    $("form#form-add-faculty").submit(function(evt){   

        evt.preventDefault();
        var formData = new FormData($(this)[0]);
  
        $.ajax({
            url: '../controller/admin/import-faculty-controller.php',
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
                  
                $('#import-data-modal').modal('hide')
                // $('#input-xlsx').val('')
                if(response != ''){

                    Swal.fire({
                        title: response.title_1,
                        html: response.html_1,
                        icon: response.icon_1,
                        showCancelButton: true,
                    }).then((result) => {
                        if(result.isConfirmed) {
                            Swal.fire({
                                title: response.title_2,
                                html: response.html_2,
                                icon: response.icon_2,
                            })

                        }
                    })
                }
                loadTeachers()
                loadSem()
            }
         });


         return false;

      });
})

function ViewTeacher(acctno,empid,email,fullname,advisory,profile,subjects){
    $('#view-account-no').val(acctno)
    $('#view-employee-id').val(empid)
    $('#view-email').val(email)
    $('#view-fullname').val(fullname)
    $('#view-advisory').val(advisory)
    $('#view-subjects').val(subjects)
    $('#view-profile-image').attr('src', profile)

    $('#view-teachers-info').modal('show');
}

function DeleteTeacher(acctnum){

    Swal.fire({
        title: 'Are you sure?',
        html: "Do you want to delete ID: <span class=\"fw-bolder\">" + acctnum + '</span>?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '/controller/admin/teacher-controller.php',
                method: 'POST',
                data:{
                    id: $('#account-id').val(),
                    action: 'delete',
                    acctno: acctnum,
                },
                success: function(response){

                    console.log(response)

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                    loadTeachers()
                }
            })

        }
    })
}

$(function(){
    
    loadSem()

    $('#activate-send-mail').click(function(){

        $('#loading-modal').modal('show')
        $('#loading-title').text('Sending Email')
        $('#loading-text').text('This will take too much time...')

        $.ajax({
            url: '../controller/admin/import-controller.php',
            method: 'post',
            data:{
                count: '20',
                send: 'students',
            },
            dataType: 'json',
            success: function(response){
                
                $('#loading-modal').modal('hide')
                
                Swal.fire({
                    title: 'Email Sent',
                    text: response.sent + ' accounts has been activated.',
                    icon: 'success',
                })

                loadTeachers()
            }
        })
    })
})


function ActivateEmail(acctid){
    $('#loading-modal').modal('show')
    $('#loading-title').text('Sending Email')
    $('#loading-text').text('This will take less than a second.!..')
    $.ajax({
        url: '../controller/admin/import-controller.php',
        method: 'post',
        data:{
            id: acctid,
            action: 'activate-student',
        },
        success: function(response){
            $('#loading-modal').modal('hide')
            Swal.fire({
                title: 'Email Sent',
                text: 'Account ' + acctid + ' is activated.',
                icon: 'success',
            })
            
            console.log( 'ahaha')

            console.log(response)
            // console.log(acctid)
            loadTeachers()
        }
    })
}

function ViewTeacher(acctno,studid,email,fullname,subjects,profilesrc,teachers){
    $('#view-account-no').val(acctno)
    $('#view-student-id').val(studid)
    $('#view-email').val(email)
    $('#view-fullname').val(fullname)
    $('#view-subjects').val(subjects)
    profile = profilesrc == '' ? '../assets/img/AttenVax.png' : profilesrc
    $('#view-profile-img').attr('src', profile)
    $('#view-teachers').val(teachers)
    $('#view-students-info').modal('show');
    console.log(profile)
}

$(function(){
    $('#btn-export').click(function(){

        var filename = 'Faculty-Account-Report-'+CurrentDatetime()+'.xlsx';
    
        TableToExcel.convert(document.querySelector("table#table-faculty"), {
            name: filename,
            sheet: {
                name: "Faculty-Account-Report"
            }
        });
    })
})


function CurrentDatetime(){
    const calendar = new Date();
    var mm = String(calendar.getMonth()+1).padStart(2, '0');
    var dd = String(calendar.getDate()).padStart(2, '0');
    var yyyy = calendar.getFullYear();
    var min = String(calendar.getMinutes()).padStart(2, '0');
    var hr = String(Math.abs(calendar.getHours()-12)).padStart(2, '0');
    var meridiem = (calendar.getHours() < 12 ? 'AM' : 'PM');

    return mm+dd+yyyy+'-'+hr+min+meridiem;

}

