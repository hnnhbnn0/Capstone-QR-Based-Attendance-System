$(function(){
    $('#btn-save-announcement').click(function(){

        encoderVal = $('#account-id').val()
        titleVal = $('#input-title').val()
        contentVal = $('#input-content').val()
        subjectVal = $('#select-subject').val()
        yearlevelVal = $('#select-year').val()
        sectionVal = $('#select-section').val()

        if(titleVal != '' && contentVal != '' && subjectVal != '' && yearlevelVal != '' && sectionVal != ''){
            
            $.ajax({
                url: "/controller/faculty/announcement-controller.php",
                method: 'POST',
                data: {
                    encoder: encoderVal,
                    title: titleVal,
                    content: contentVal,
                    subject: subjectVal,
                    yearlevel: yearlevelVal,
                    section: sectionVal,
                },
                dataType: 'json',
                success: function(response){
                    console.log(response)


                    Swal.fire({
                        title: response.title,
                        html: response.html,
                        icon: response.icon,
                    })

                    $('#input-title').val('')
                    $('#input-content').val('')
                    $('#select-subject').val('')
                    $('#select-year').val('')
                    $('#select-section').val('')
                }
            })
        }else{
            count = 0;
            missing = []
            if(titleVal == ''){
                count+=1;
                missing.push(' Title')
            }if(contentVal == ''){
                count+=1;
                missing.push(' Content')
            }if(subjectVal == ''){
                count+=1;
                missing.push(' Subject')
            }if(yearlevelVal == ''){
                count+=1;
                missing.push(' Yearlevel')
            }if(sectionVal == ''){
                count+=1;
                missing.push(' Section')
            }
            Swal.fire({
                title: 'Missing Input!',
                html: 'There are '+count+' missing inputs. <br><span class="text-danger h6">' + missing + '</span>',
                icon: 'warning',
            })
        }
    })
})
$(function(){
    loadSubjects()
    setInterval(getRealData, 1000);
})

function getRealData() {
    $.ajax({
        
        type: "GET",
        url: "/controller/faculty/display-announcements.php",
        dataType: "html",
        method: "POST",
        data:{
            encoder: $('#account-id').val(),
            action: 'request',
        },
        success: function (data) {
            $("#announcements").html(data);
            console.log('hehe')
    }
    });
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
            console.log(response)

            $('#select-subject').empty()
            $('#select-subject').append(`<option disabled selected value="" class="dropdown-header">Subjects</option>`)
            for(i = 0; i < response.rowlimit; i++){
               $('#select-subject').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }
            // GenerateQRInit()
        }
    })

}
// });

// function getAnnouncements(){
//     $.ajax({
//         url: "/controller/faculty/announcement-controller.php",
//         method: 'POST',
//         data: {
//             encoder: $('#account-id').val(),
//             action: 'request',
//         },
//         success: function(response){
//             console.log(response)
    
//             // const ann = JSON.parse(response)

//             // $('#announcements').empty()

//             // for(i=0; i<ann.rowlimit;i++){
//             //     $('#announcements').append(`
                    
//             //     `)
//             // }

    
//         }
//     })
// }
// $(document).ready(function (){
//     setInterval(getAnnouncements, 3000);
// })


// setInterval(function(){//setInterval() method execute on every interval until called clearInterval()
//     $('#announcements').load("../controller/faculty/display-announcements.php").fadeIn("slow");
//     console.log('loaded')
// }, 1000);