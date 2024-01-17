

// var localCategory = localStorage.getItem('category')
var page = 10;
$(function(){
    

    $.fn.dataTable.ext.errMode = 'none';
    
    loadTeacher()

    loadReports()

    // if(localStorage.getItem('category')){
    //     $('#select-category-list').val(localCategory)
    // }else{
    //     $('#select-category-list').val('')
    // }


    
    $('select').change(function(){

       
        let teacherVal = $('select#select-teacher-list option:selected').val()
     
        $.ajax({
            url: '/controller/admin/reports-controller.php',
            method: 'POST',
            data:{
                id: $('#account-id').val(),
               
                teacher: teacherVal,
               
            },
            dataType: 'json',
            success: function(response){

                console.log(response)
                tableStructure(response)

                $('#search-report-list').val('')

            }
        })
    })
})

function tableStructure(response){

   
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').removeClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').addClass('d-none')
}

function loadReports() {

    $.ajax({
        url: '/controller/admin/reports-controller.php',
        method: 'post',
        data: {
            id: $('#account-id').val(),
            teacher: '',
        },
        dataType: 'json',
        success: function(response){
            console.log(response)
            tableStructure(response)
        }
    })
}

function appendAttendances(json){

    $('#table-attendance-tbody').empty()

    if(json.rowlimit > 0){
        for(i=0; i<json.rowlimit; i++){
            $('#table-attendance-tbody').append(`
            
                <tr class="h6 mb-0 text-center text-truncate align-middle">
                    <td>${json.id[i]}</td>
                    <td>${json.fullname[i]}</td>
                    <td>${json.yearsec[i]}</td>
                    <td>${json.subcode[i]}</td>
                    <td>${json.status[i]}</td>
                    <td>${json.date[i]}</td>
                    <td>${json.time[i]}</td>
                </tr>
            `)
        }
    }else{
        $('#table-attendance-tbody').append(`
        <tr>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
        </tr>
    `)
    }

    attendance = $('#table-attendance').DataTable({"dom": 'rtBp', "pageLength": page, "order": [], buttons: ['csv', 'excel', 'pdf', 'print']})

    attendance.buttons().container().appendTo( '#table-attendance_wrapper .col-md-6:eq(0)');
}






function loadTeacher(){
    $.ajax({
        url: '/controller/admin/teacherid.php',
        method: 'post',
        data:{
            id: $('#account-id').val(),
            fetch: 'employeeid',
            datalist: 'Specific',
        },
        dataType: 'json',
        success: function(response){


            $('.teacher-list').empty()
            $('.teacher-list').append(`<option disabled selected value="" class="dropdown-header">Teacher ID</option>`)

            for(i = 0; i < response.rowlimit; i++){
                $('.teacher-list').append(`
                    <option value="${response.employeeid[i]}"</option>
                `)
            }
            
        }
    })
}
$(function(){
    $('#btn-export-att').click(function(){

        var filename = 'Attendance-Report-'+CurrentDatetime()+'.xlsx';
    
        TableToExcel.convert(document.querySelector("#table-attendance"), {
            name: filename,
            sheet: {
                name: "Attendance-Report"
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