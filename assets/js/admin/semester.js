$(function(){
    // If the website is loaded, run loadSemester function -> fetch data from another page
    loadSemester();

    // If the website is loaded, run loadSubjects function -> fetch data from another page
    loadSubjects();
})

$(function(){
    $('select').change(function(){

        console.log( $('#select-yl').val() ,  $('#select-sem').val() )
        if( $('#select-yl').val() != null &&  $('#select-sem').val() != null){

            yrVal = $('#select-yl').val()
            semVal = $('#select-sem').val()

            // Fetch data from the semester-controller
            $.ajax({
                url: "/controller/admin/semester-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    // no: $('#account-no').val(),
                    category: 'subjects',
                    yearlevel: yrVal,
                    semester: semVal,
                    search: '',
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    localStorage.setItem('yearlevel', yrVal)
                    localStorage.setItem('semester', semVal)
                    appendSubjects(response)
                }
            })
        }

    })
})

function DeleteSem(value){
    console.log(value)
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {

            $('#search-record').val('')

            $.ajax({
                url: "/controller/admin/semester-activate.php",
                method: "POST",
                data: {
                    id: value,
                    action: 'delete',
                },
                success: function(response) {
                    // console.log(response)
                    Swal.fire(
                        'Delete Success',
                        'You have successfully delete row',
                        'success',
                    )
                    loadSemester();
                    loadSubjects();
                }
            })
        }
    })
}

$(function(){
    $('#search-record').keyup(function(){

        $("select#select-yl option").each(function(){
            if($(this).val() == localStorage.getItem('yearlevel')){
                $(this).removeAttr("selected");
            }
        });
    
        $("select#select-sem option").each(function(){
            if($(this).val() == localStorage.getItem('semester')){
                $(this).removeAttr("selected");
            }
        });

        localStorage.removeItem('yearlevel')
        localStorage.removeItem('semester')

        $('#select-yl').val('').trigger('change');
        $('#select-sem').val('').trigger('change');

        if($('#search-record').val() != ''){

            $.ajax({
                url: "/controller/admin/semester-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    category: 'semester',
                    search: $('#search-record').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    appendSemester(response)

                }
            })
        }else{
            loadSemester()
        }
    })
});

$(function(){
    $('#search-subject').keyup(function(){

        if($('#search-subject').val() != ''){
            $.ajax({
                url: "/controller/admin/semester-controller.php",
                method: "POST",
                data: {
                    id: $('#account-id').val(),
                    category: 'subjects',
                    search: $('#search-subject').val(),
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    appendSubjects(response)
                }
            })
        }else{
            loadSubjects()
        }
    })
});

function loadSemester(){
    // Fetch data from the semester-controller
    $.ajax({
        url: "/controller/admin/semester-controller.php",
        method: "POST",
        data: {
            id: $('#account-id').val(),
            fetch: 'semester',
        },
        dataType: 'json',
        success: function(response) {
            console.log(response)
            appendSemester(response)
        }
    })
}       

function loadSubjects(){
    // Fetch data from the semester-controller
    $.ajax({
        url: "/controller/admin/semester-controller.php",
        method: "POST",
        data: {
            id: $('#account-id').val(),
            fetch: 'subjects',
        },
        dataType: 'json',
        success: function(response) {
            // console.log(response)
            appendSubjects(response)
        }
    })
}

function appendSemester(sem){
    // Process the data from the semester-controller then add it into the HTML

  

        $('#semester-thead').empty()
        $('#semester-thead').append(`
            <tr class="h5 mb-0 text-center text-truncate">
                <th>No.</th>
                <th>Academic Year</th>
                <th>Semester</th>
                <th>Status</th>
                <th>Activate</th>
            
            </tr>
        `)
        
        active_year = sem.active_year == null ? '' : sem.active_year
        active_sem = sem.active_sem == null ? '' : sem.active_sem
        $('#active-term').text(active_year+' '+active_sem)

        $('#semester-tbody').empty()
        if(sem.rowlimit > 0){
            for(i=0;i<sem.rowlimit;i++){

            if(sem.status[i] == 'Inactive'){
                button_class = "btn btn-sm btn-danger bi bi-x-lg";
                badge_status = "badge fs-6 mb-0 bg-danger rounded-pill";
            }else{
                button_class = "btn btn-sm btn-success bi bi-check-lg";
                badge_status = "badge fs-6 mb-0 bg-success rounded-pill";
            }
            $('#semester-tbody').append(`
                <tr class="h6 mb-0 text-center text-truncate align-middle">
                    <td>${i+1}</td>
                    <td>${sem.acad_year[i]}</td>
                    <td>${sem.semester[i]}</td>
                    <td><span class="${badge_status}">${sem.status[i]}</span></td>
                    <td>
                        <button class="${button_class}" type="button" onclick="ActivateSem('${sem.id[i]}', '${sem.acad_year[i]}', '${sem.semester[i]}')"></button>
                    </td>
                    
                </tr>
                `)
            }
        }else if(sem.rowlimit <= 0){
            $('#semester-tbody').append(`
            <tr class="h5 mb-0 text-center text-truncate">
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
                <th>-</th>
            
            </tr>
        `)
        }
   
}

function appendSubjects(sub){



        $('#subject-thead').empty()
        $('#subject-thead').append(`
            <tr class="h5 mb-0 text-center text-truncate">
                <th>No.</th>
                <th>Year Level</th>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Unit Lec</th>
                <th>Unit Lab</th>
            </tr>
        `)

        $('#subject-tbody').empty()

        if(sub.rowlimit > 0){
            for(i=0;i<sub.rowlimit;i++){

                unitlab = sub.unitlab[i] == 0 ? '-' : parseFloat(sub.unitlab[i]).toFixed(1)
                $('#subject-tbody').append(`
                    <tr class="h6 mb-0 text-center text-truncate align-middle">
                        <td>${i+1}</td>
                        <td>${sub.yearlevel[i]}</td>
                        <td>${sub.subcode[i]}</td>
                        <td>${sub.subname[i]}</td>
                        <td>${parseFloat(sub.unitlec[i]).toFixed(1)}</td>
                        <td>${unitlab}</td>
                    </tr>
                    `)
            }
        }else{
            $('#subject-tbody').append(`
                <tr class="h5 mb-0 text-center text-truncate">
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                    <th>-</th>
                </tr>
            `)
        }
}

function ActivateSem(value,year,semester){


    if(semester == 'First Semester'){
        sem = '1st Sem';
    }else if(semester == 'Second Semester'){
        sem = '2nd Sem';
    }
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to activate " + year + ', ' + sem + '?',
        
        showCancelButton: true,
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Activate',
        confirmButtonColor: '#0d6efd',
       
           icon: 'info',
    }).then((result) => {
        if(result.isConfirmed) {

            $.ajax({
                url: "/controller/admin/semester-activate.php",
                method: "POST",
                data: {
                    id: value,
                    action: 'activate',
                    sync: 'false',
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)

                    Swal.fire({
                        title: response.title,
                        html: response.html,
                        icon: response.icon,
                    })
                }
            })

        }else if(result.isDenied){

            $.ajax({
                url: "/controller/semester-activate.php",
                method: "POST",
                data: {
                    id: value,
                    action: 'activate',
                    sync: 'true',
                },
                dataType: 'json',
                success: function(response){

                    console.log(response)

                    Swal.fire({
                        title: response.title,
                        html: response.html,
                        icon: response.icon,
                    })
                }
            })
        }
        loadSemester();
        loadSubjects();
    })
}

$(function(){
    $('#btn-save-record').click(function(){
        
        var academicVal = $('#select-academic-year').val();
        var semesterVal = $('#select-semester').val();

        if(academicVal != null && semesterVal != null){
            $.ajax({
                url: "/controller/admin/semester-activate.php",
                method: "POST",
                data: {
                    action: 'add',
                    academic: academicVal,
                    semester: semesterVal
                },
                dataType: 'json',
                success: function(response) {
                    // console.log(response)
                    $('#semester-modal').modal('hide')
                    
                    Swal.fire({
                        title: response.title,
                        html: response.html,
                        icon: response.icon,
                    })
                    loadSemester();
                }
            });
        }else{
            Swal.fire('Submit Error!', 'You still haven\'t selected ','error')
        }
    })
})

$(function(){
    $('#select-academic-year').empty()
    $('#select-academic-year').append(`<option disabled selected value="" class="dropdown-header">- Select Academic Year -</option>`)
    
    var date = new Date();

    for(yr = 2022; yr <= date.getFullYear(); yr++){
        $('#select-academic-year').append(`
            <option value="${yr}-${yr+1}">${yr}-${yr+1}</option>
        `)
    }
})
