function randomInteger(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

$(function(){
    LoadDashboard();
})

function LoadDashboard(){
    $.ajax({
        url: '../controller/faculty/dashboard.php',
        method: 'POST',
        data:{
            acctid: $('#account-id').val()
        },
        success: function(response){
            console.log(response)
            appendDashboard(response)
        }
    })
}

function appendDashboard(json){
    // const stud = JSON.parse(JSON.stringify(json))
    // const res = JSON.parse(json)

    const res = JSON.parse(JSON.stringify(json))
    console.log(res)

    $('#thead_studsec').empty()
    $('#tbody_studsec').empty()

    $('#thead_studsec').append(`
        <tr class="h6 mb-0 text-center text-truncate">
            <th>Subject</th>
            <th>Year and Section</th>
           
        </tr>
    `)
    if(res.rowlimit <= 0){
        $('#tbody_studsec').append(`
            <tr class="h6 mb-0 text-center text-truncate align-middle">
                <td>-</td>
                <td>-</td>
              
            </tr>
        `)
    }else{
        for(i=0;i<res.rowlimit;i++){
           
            $('#tbody_studsec').append(`
            <tr class="h6 mb-0 text-center text-truncate align-middle">
                <td>${res.subname[i]}</td>
                <td>${res.yearsec[i]}</td>
               
            </tr>
            `)
        }
    }
    $('#tot-sub').text(res.active_subcode)
    $('#tot-class').text(res.active_section)
}