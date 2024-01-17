function loadStudents(){
    $.ajax({
        url: '../controller/admin/student-controller.php',
        method: 'POST',
        data:{
            id: $('#account-id').val(),
            fetch: 'students',
        },
        dataType: 'json',
        success: function(response){
            console.log(response)
            appendStudents(response)
        }
    })
}
$(function(){
    $('#search-student').keyup(function(){

        if($('#search-student').val() != ''){

            $.ajax({
                url: "/controller/admin/student-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    fetch: 'students',
                    search: $('#search-student').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    // 
                    appendStudents(response)

                }
            })
        }else{
            loadStudents()
        }
    })
});
function loadSem(){
    $.ajax({
        url: '../controller/admin/semester-controller.php',
        method: 'POST',
        data:{
            id: $('#account-id').val(),
            fetch: 'acad-year-semester',
        },
        dataType: 'json',
        success: function(response){
            console.log(response)
            $('.active-year').val(response.active_year)
            $('.active-sem').val(response.active_sem)
        }
    }) 
}


function appendStudents(stud){
    
    $('#student-thead').empty()

    var date = new Date();
    $('#student-thead').append(`
        <tr style="display:none" data-height="35">
                
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Student ID</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Email Address</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">First Name</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Middle Name</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Last Name</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Year</td>
            <td data-f-sz="12" data-f-bold="true" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000"data-b-b-s="thin" data-b-a-s="thin" data-b-t-s="thin">Section</td>
            
        </tr>
        <tr data-exclude="true" class="h5 mb-0 text-center text-truncate">
          
            <th data-exclude="true" style="display: none">Account No.</th>
            <th data-exclude="true">Student ID</th>
            <th data-exclude="true">Email</th>
            <th data-exclude="true">Full Name</th>
         
            <th data-exclude="true">Status</th>
            <th data-exclude="true">Action</th>
        </tr>
        <tr class="" style="display: none">
                
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${date.getFullYear()}XXXX</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">juan.delacruz.m@bulsu.edu.ph</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Juan</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Martinez</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">Dela Cruz</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">1</td>
        <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="D0CECE" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">A</td>
       
    </tr>
    `)

    $('#student-tbody').empty()

    if(stud.rowlimit <= 0){
        $('#student-tbody').append(`
        <tr class="h6 mb-0 text-center text-truncate align-middle">
           
            <td data-exclude="true">-</td>
            <td data-exclude="true">-</td>
            <td data-exclude="true">-</td>
            <td data-exclude="true">-</td>
            <td data-exclude="true">-</td>
           
           
        </tr>
        
        `)
    }else{
        for(i=0;i<stud.rowlimit;i++){
            i_status = stud.status[i] == 'Active' ? 'btn-success text-light bi bi-send-fill' : 'btn-success text-light bi bi-check-lg'
            i_class = stud.status[i] == 'Active' ? 'bg-success' : 'bg-danger'
            $('#student-tbody').append(`
            <tr class="h6 mb-0 text-center text-truncate align-middle">
                
                <td data-exclude="true" style="display: none">${stud.acctno[i]}</td>
                <td  data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${stud.studentid[i]}</td>
                <td  data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin">${stud.email[i]}</td>
                <td data-exclude="true">${stud.fullname[i]}</td>
             
                <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.firstname[i]}</td>
                <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.middlename[i]}</td>
                <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.lastname[i]}</td>
                <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.yearlevel[i]}</td>
                <td data-f-sz="12" data-a-h="center" data-a-v="middle" data-fill-color="FFFFFF" data-f-color="000000" data-f-color="000000" data-b-a-s="thin" style="display:none;">${stud.section[i]}</td>
                
                <td data-exclude="true">
                    <span class="badge ${i_class} fs-6 rounded-pill mb-0">${stud.status[i]}</span>
                </td>
                <td data-exclude="true">
                    <button class="btn ${i_status} btn-sm" onclick="ActivateEmail('${stud.studentid[i]}')"></button>
                </td>
            </tr>
            `)
        }
    }
}
$(function(){
    loadStudents()
    loadSem()
})

function ViewStudent(acctno,studid,email,fullname,subjects,profilesrc,teachers){
    $('#view-account-no').val(acctno)
    $('#view-student-id').val(studid)
    $('#view-email').val(email)
    $('#view-fullname').val(fullname)
    // $('#view-subjects').val(subjects)
    profile = profilesrc == '' ? '../assets/img/AttenVax.png' : profilesrc
    $('#view-profile-img').attr('src', profile)
    // $('#view-teachers').val(teachers)
    $('#view-students-info').modal('show');
    console.log(profile)
}

function DeleteStudent(acc){

    Swal.fire({
        title: 'Are you sure?',
        html: "Do you want to delete ID: <span class=\"fw-bolder\">" + acc + '</span>?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '../controller/admin/student-controller.php',
                method: 'POST',
                data:{
                    id: $('#account-id').val(),
                    action: 'single-delete',
                    acctno: acc,
                },
                success: function(response){

                    // console.log(response)

                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                    loadStudents()
                }
            })

        }
    })
}

function MultiDeleteStudents(){

    var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked').length;

    var ids = [];
    $(".form-check-input").each(function(){
        if ($(this).is(":checked")) {
            ids.push($(this).val());
        }
    });

    if(checkboxes > 0){
        Swal.fire({
        title: 'Are you sure?',
        html: "Do you want to delete <span class='fw-bolder text-danger h5'>" + checkboxes  + " item/s</span>?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed){
            $.ajax({
                url: "/controller/admin/student-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    stud: ids,
                    action: 'multi-delete'
                },
                success: function(response){
                    // console.log(response)
                    loadStudents()
                }
            });
        }
      });
    }else{
      Swal.fire({
        icon: 'warning',
        title: 'Delete Error!',
        html: 'There is no <span class="fw-bolder text-danger h5">row</span> that is selected.'
      })
    }
}

$(function(){
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
            // console.log(yearlevel.substr(1,1))
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
    loadActiveSubjects()
})

function RevertToSelect(that){
    that.remove()
    $('select#select-subject option').each(function(){
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
            // console.log(response)

            $('#select-subject').empty()
            $('#select-subject').append(`<option disabled selected value="" class="dropdown-header">- Select Subjects -</option>`)
            for(i = 0; i < response.rowlimit; i++){
               $('#select-subject').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }

          
        }
    })
}

$(function(){
    $("form#form-import-students").submit(function(evt){   

        evt.preventDefault();
        var formData = new FormData($(this)[0]);
  
        $.ajax({
            url: '/controller/admin/import-controller.php',
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
                $('#input-xlsx').val('')


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
                
                loadStudents()
            }
         });


         return false;

      });
  
})

function ExportTableXLSX(){

    var filename = 'Students-Account-Report-'+CurrentDatetime()+'.xlsx';

    TableToExcel.convert(document.querySelector("table#table-students"), {
        name: filename,
        sheet: {
            name: "Students-Account-Report"
        }
    });
}

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

$(function(){
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

                loadStudents()
            }
        })
    })
})

function ActivateEmail(acctid){
    $('#loading-modal').modal('show')
    $('#loading-title').text('Sending Email!')
    $('#loading-text').text('This will take less than a second...')

    $.ajax({
        url: '/controller/admin/import-controller.php',
        method: 'post',
        data:{
            id: acctid,
            action: 'activate-student',
        },
        // dataType: 'json',
        success: function(response){


            $('#loading-modal').modal('hide')

            console.log( 'ahaha')

            Swal.fire({
                title: 'Email Sent',
                text: 'Account ' + acctid + ' is activated.',
                icon: 'success',
            })

            console.log(response)
            
            loadStudents()
        },
        error: function(e){
            console.log(e)
            $('#loading-modal').modal('hide')
        }
    })

    
}