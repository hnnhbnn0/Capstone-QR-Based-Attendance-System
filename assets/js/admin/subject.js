$(function(){

    loadSubjects()

    loadTeachers()

    $("form#form-add-subjects").submit(function(evt){   

        evt.preventDefault();
        var formData = new FormData($(this)[0]);
  
        console.log(arr)
        if(arr != ''){
            $.ajax({
                url: '/controller/admin/faculty-assign-subjects.php',
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                dataType: 'json',
                success: function (response) {

                    console.log(response)
                    
                    // $('#import-data-modal').modal('hide')
                    $('#sub-add-modal').modal('hide')

                    // clear all data in arrays
                    arr.splice(0, arr.length)

                    loadTeachers()

                    loadSubjects()

                    Swal.fire({
                        title: response.title,
                        html: response.html,
                        icon: response.icon,
                    })
                }
            });
        }else{
            Swal.fire({
                title: 'Missing Subjects',
                text: 'Subjects are missing.',
                icon: 'warning',
            })
        }

         return false;

      });

})


function loadTeachers(){
    $.ajax({
        url: '/controller/admin/teacher-controller.php',
        method: 'post',
        data:{
            id: $('#account-id').val(),
            fetch: 'teachers',
            
        },
        dataType: 'json',
        success: function(a){
            console.log(a)
            appendProfile(a)
            arr.splice(0, arr.length)
        }
    })
}

function appendProfile(tchr){
  
    $('#tchr-thead').empty()

   
    $('#tchr-thead').append(`
        <tr class="h5 mb-0 text-center text-truncate">
            <th>Teacher Name</th>
            <th>Subjects</th>
            <th>Action</th>
        </tr>
    `)

    $('#tchr-tbody').empty()
    if(tchr.rowlimit <= 0){
        $('#tchr-tbody').append(`
            <tr class="h6 mb-0 text-center text-truncate align-middle">
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        `)
    }else{
        for(i=0;i<tchr.rowlimit;i++){
           
            $('#tchr-tbody').append(`
            <tr class="h6 mb-0 text-center text-truncate align-middle">
                <td>${tchr.fullname[i]}</td>
                <td>${tchr.subjects[i]}</td>
                <td>
                    <button class="btn btn-primary bi bi-plus-lg btn-sm" type="button" onclick="AddSubjects('${tchr.employeeid[i]}','${tchr.fullname[i]}')"></button>
                </td>
            </tr>
            `)
        }
    }
}

function AddSubjects(id, fullname){
    $('#sub-add-modal').modal('show')

    $('#add-fullname').val(fullname)

    $('#add-acct-id').val(id)

    $('#add-acct-display-id').val(id)
}

function loadSubjects(){
    $.ajax({
        url: '/controller/admin/teacher-controller.php',
        method: 'post',
        data:{
            id: $('#account-id').val(),
            fetch: 'subjects',
            datalist: 'All',
        },
        dataType: 'json',
        success: function(response){
            // console.log(response)
            $('.subject-lists').empty()
            $('.subject-lists').append(`<option disabled selected value="" class="dropdown-header">- Select Subjects -</option>`)
            for(i = 0; i < response.rowlimit; i++){
               $('.subject-lists').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }

        }
    })

}

var arr = Array();

$(function(){

    $('#add-subjects').click(function(){

        if($('select#select-subject').val() !== null && $('select#select-section').val() != null){
            
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

            if(arr.includes($('#select-subject').val() + '-' + yearlevel.substr(1,1)+ $('#select-section option:selected').val()) == false){

                arr.push($('#select-subject').val() + '-' + yearlevel.substr(1,1)+ $('#select-section option:selected').val())

                $('#lists-of-subjects').append(`
                    <input readonly class="btn ${btn} mb-2 col-lg-2 mx-1 btn-sm" name="subject[]" value="${$('#select-subject').val()}-${yearlevel.substr(1,1)}${$('#select-section option:selected').val()}" type="text" title="${$('#select-subject option:selected').text()}" data-bs-toggle="tooltip" data-bs-placement="top" onclick="SelfRemove(this)"></input>
                `);
            }

            console.log(arr)
            $('#select-subject').val('')
            $('#select-section').val('')

        }else if($('#select-subject').val() != null && $('#select-section').val() == null){
            console.log('sec')
            Swal.fire({
                title: 'Missing Input',
                text: 'Section input is missing',
                icon: 'warning',

            })
        }else if($('#select-subject').val() == null && $('#select-section').val() != null){
            console.log('sub')
            Swal.fire({
                title: 'Missing Input',
                text: 'Subject input is missing',
                icon: 'warning',
                
            })
        }else{
            Swal.fire({
                title: 'Missing Input',
                text: 'Subject and Section input is missing',
                icon: 'warning',
                
            })
        }
    })
})

function SelfRemove(that){
    that.remove()

    arr.pop(that.value)
    
    console.log(arr)
}

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