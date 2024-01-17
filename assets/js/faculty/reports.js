

var localCategory = localStorage.getItem('category')
var page = 10;
$(function(){
    

    $.fn.dataTable.ext.errMode = 'none';
    
    loadSubjects()

    loadReports()

    if(localStorage.getItem('category')){
        $('#select-category-list').val(localCategory)
    }else{
        $('#select-category-list').val('')
    }




    $('#search-report-list').keyup(function(){
    
        let category = $('select#select-category-list option:selected').val()

        if(category == 'Attendance'){
            attendance.search($(this).val()).draw();
        }else if(category == 'Absentees'){
            absentees.search($(this).val()).draw();
        }else if(category == 'Drop List'){
            droplist.search($(this).val()).draw();
        }else if(category == 'Student List'){
            students.search($(this).val()).draw();
        }else if(category == 'Vaccine Status'){
            vaccine.search($(this).val()).draw();
        }

    })
    
    $('select').change(function(){

        let categoryVal = $('select#select-category-list option:selected').val()
        let subjectVal = $('select#select-subject-list option:selected').val()
        let sectionVal = $('select#select-section-list option:selected').val()

        localStorage.setItem('category', categoryVal)

        $.ajax({
            url: '/controller/faculty/reports-controller.php',
            method: 'POST',
            data:{
                id: $('#account-id').val(),
                table: categoryVal,
                subject: subjectVal,
                section: sectionVal,
            },
            dataType: 'json',
            success: function(response){

                console.log(response)
                tableStructure(categoryVal, response)

                $('#search-report-list').val('')

            }
        })
    })
})

function tableStructure(category, response){

    if(category == 'Attendance'){
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').removeClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').addClass('d-none')
    }else if(category == 'Absentees'){
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').addClass('d-none')
        $('.absentees-form').removeClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').addClass('d-none')
    }else if(category == 'Drop List'){
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').addClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').removeClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').addClass('d-none')
    }else if(category == 'Student List'){
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').addClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').removeClass('d-none')
        $('.vaccine-form').addClass('d-none')
    }else if(category == 'Vaccine Status'){
        $('#reports-table-name').text(category)
        $('.category-form').addClass('d-none')
        $('.attendance-form').addClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').removeClass('d-none')
    }else{
        $('.category-form').removeClass('d-none')
        $('.attendance-form').addClass('d-none')
        $('.absentees-form').addClass('d-none')
        $('.droplist-form').addClass('d-none')
        $('.student-list-form').addClass('d-none')
        $('.vaccine-form').addClass('d-none')
    }

    if(response !== undefined){
        if(category == 'Attendance'){
            appendAttendances(response)
        }else if(category == 'Absentees'){
            appendAbsentees(response)
        }else if(category == 'Drop List'){
            appendDroplists(response)
        }else if(category == 'Student List'){
            appendStudents(response)
        }else if(category == 'Vaccine Status'){
            appendVaccines(response)
        }
    }
}

function loadReports() {

    $.ajax({
        url: '/controller/faculty/reports-controller.php',
        method: 'post',
        data: {
            id: $('#account-id').val(),
            table: localCategory,
            subject: '',
            section: '',
        },
        dataType: 'json',
        success: function(response){
            console.log(response)
            tableStructure(localCategory, response)
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

function appendAbsentees(json){
    console.log('appendAbsentees()', json)

    $('#table-absentees-tbody').empty()
    
    if(json.rowlimit > 0){
        for(i=0; i<json.rowlimit; i++){
            $('#table-absentees-tbody').append(`
                <tr>
                    <td class="text-center">${json.id[i]}</td>
                    <td class="text-center">${json.fullname[i]}</td>
                    <td class="text-center">${json.yearsec[i]}</td>
                    <td class="text-center">${json.subcode[i]}</td>
                    <td class="text-center">${json.status[i]}</td>
                    <td class="text-center">${json.date[i]}</td>
                    <td class="text-center">${json.time[i]}</td>
                </tr>
            `)
        }
    }else{
        $('#table-absentees-tbody').append(`
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
    absentees = $('#table-absentees').DataTable({"dom": 'rtBp', "pageLength": page, "order": [], buttons: ['csv', 'excel', 'pdf', 'print']})

    absentees.buttons().container().appendTo( '#table-absentees_wrapper .col-md-6:eq(0)');
}

function appendDroplists(json){
    console.log('appendDroplists()', json)

    $('#table-droplist-tbody').empty()

    if(json.rowlimit > 0){
        for(i=0; i<json.rowlimit; i++){
            $('#table-droplist-tbody').append(`
                <tr>
                    <td class="text-center">${json.id[i]}</td>
                    <td class="text-center">${json.fullname[i]}</td>
                    <td class="text-center">${json.yearsec[i]}</td>
                    <td class="text-center">${json.subcode[i]}</td>
                    <td class="text-center">${json.absences[i]}</td>
                </tr>
            `)
        }
    }else{
        $('#table-droplist-tbody').append(`
        <tr>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
        </tr>
    `)
    }

    droplist = $('#table-droplist').DataTable({"dom": 'rtBp', "pageLength": page, "order": [], buttons: ['csv', 'excel', 'pdf', 'print']})

    droplist.buttons().container().appendTo( '#table-droplist_wrapper .col-md-6:eq(0)');
}

function appendStudents(json){
    console.log('appendStudents()', json)
    
    $('#table-student-list-tbody').empty()

    if(json.rowlimit > 0){
        for(i=0; i<json.rowlimit; i++){
            $('#table-student-list-tbody').append(`
                <tr>
                    <td class="text-center">${json.id[i]}</td>
                    <td class="text-center">${json.email[i]}</td>
                    <td class="text-center">${json.fullname[i]}</td>
                    <td class="text-center">${json.yearsec[i]}</td>
                    <td class="text-center">${json.subcode[i]}</td>
                </tr>
            `)
        }
    }else{
        $('#table-student-list-tbody').append(`
        <tr>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
        </tr>
    `)
    }

    students = $('#table-student-list').DataTable({"dom": 'rtBp', "pageLength": page, "order": [], buttons: ['csv', 'excel', 'pdf', 'print']})

    students.buttons().container().appendTo( '#table-student-list_wrapper .col-md-6:eq(0)');
}

function appendVaccines(json){
    console.log('appendVaccines()', json)

    $('#table-vaccine-tbody').empty()

    if(json.rowlimit > 0){
        for(i=0; i<json.rowlimit; i++){
            $('#table-vaccine-tbody').append(`
                <tr>
                    <td class="text-center">${json.id[i]}</td>
                    <td class="text-center">${json.fullname[i]}</td>
                    <td class="text-center">${json.email[i]}</td>
                    <td class="text-center">${json.yearsec[i]}</td>
                    <td class="text-center">${json.subcode[i]}</td>
                    <td class="text-center">${json.vaxstat[i]}</td>
                </tr>
            `)
        }
    }else{
        $('#table-vaccine-tbody').append(`
        <tr>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
            <td class="text-center">-</td>
        </tr>
    `)
    }
    vaccine = $('#table-vaccine').DataTable({"dom": 'rtBp', "pageLength": page, "order": [], buttons: ['csv', 'excel', 'pdf', 'print']})

    vaccine.buttons().container().appendTo( '#table-vaccine_wrapper .col-md-6:eq(0)');
}

function loadSubjects(){
    $.ajax({
        url: '/controller/admin/teacher-controller.php',
        method: 'post',
        data:{
            id: $('#account-id').val(),
            fetch: 'subjects',
            datalist: 'Specific',
        },
        dataType: 'json',
        success: function(response){


            $('.subject-list').empty()
            $('.subject-list').append(`<option disabled selected value="" class="dropdown-header">Subjects</option>`)

            for(i = 0; i < response.rowlimit; i++){
                $('.subject-list').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
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