
const video = document.getElementById('video-file');

const scanner = new QrScanner(video, result => setResult(result), {
    highlightScanRegion: true,
    highlightCodeOutline: true,
});

var session = '';

var interval = 1000;

var runMonitor = '';

$(function(){


    // loadMonitor()

    loadSubjects()

    console.log(typeof localStorage.getItem('scanned'))
    if(localStorage.getItem('session')){
        runMonitor = setInterval(loadMonitor, interval)
        console.log(localStorage.getItem('scanned'))
        $('#select-subject').val(localStorage.getItem('subject'));
        $('#close-camera').text('Stop Scan ['+localStorage.getItem('subject')+']')

        $('#session-text').html("<b>SESSION: </b>" + localStorage.getItem('session'))
        console.log(localStorage.getItem('session'))
        $('#img-qr').addClass('d-none')
        $('.subject-camera-div').addClass('d-none')
        $('.stop-camera-div').removeClass('d-none')
        scanner.start().then(() => {
            const camres = document.getElementById('qr-camera-result')
            camres.insertBefore(scanner.$canvas, camres.children[0]);
            scanner.$canvas.style.display = 'block'
            scanner.$canvas.style.height = '220px'
            scanner.$canvas.classList = 'canvas-qr border border-2 border-dark'
            scanner.setInversionMode('both');
            scanner.setCamera('environment');
        })
    }else{
        $('#session-text').html("<b>SESSION: </b>NONE")
    }

    if(runMonitor == ''){
        $('#attendance-monitor').empty()
        $('#attendance-monitor').append(`
            <thead class="h5 text-center mb-0 text-truncate" id="attendance-thead">
            <tr class="h6">
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Section</th>
                <th>Date/Time</th>
            </tr>
            </thead>
            <tbody class="h6 text-center mb-0 text-truncate" id="attendance-tbody">
                <tr class="h6">
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        `)
    }

    $('#select-subject').change(function(){

        const subject = $('select#select-subject option:selected').val();

        localStorage.setItem('subject', subject);

        if (subject == '') {
            $('#open-camera').prop('disabled', true);
        }else{
            $('#open-camera').prop('disabled', false);
        }
    })


    $('#open-camera').click(function(){

        console.log('open-camera')

        navigator.permissions.query({name: 'camera'}).then((permissionObj) => {
            if(permissionObj.state == 'granted'){

                $('#img-qr').addClass('d-none')
                $('.subject-camera-div').addClass('d-none')
                $('.stop-camera-div').removeClass('d-none')

                $('#close-camera').text('Stop Scan ['+localStorage.getItem('subject')+']')

                const randomBytes = window.crypto.getRandomValues(new Uint8Array(10));
                const hexString = Array.from(randomBytes).map(b => b.toString(16).padStart(2, "0")).join("");
                session = hexString;

                localStorage.setItem('session', hexString)
                $('#session-text').html("<b>SESSION: </b>" + localStorage.getItem('session'))

                scanner.start().then(() => {
                    const camres = document.getElementById('qr-camera-result')
                    camres.insertBefore(scanner.$canvas, camres.children[0]);
                    scanner.$canvas.style.display = 'block'
                    scanner.$canvas.style.height = '220px'
                    scanner.$canvas.classList = 'canvas-qr border border-2 border-dark'
                    scanner.setInversionMode('both');
                    scanner.setCamera('environment');
                })

                

                runMonitor = setInterval(loadMonitor, interval)
                console.log(runMonitor)
                
            }else{
                $('#open-camera').removeAttr('disabled', 'disabled')
                $('.canvas-qr').addClass('d-none')
                $('#img-qr').removeClass('d-none')
                $('#open-camera').removeClass('btn-danger')
                $('#open-camera').addClass('btn-success')
                $('#open-camera').text('Open Camera')
                Swal.fire('Camera Required!','Device permission is not set.','warning')
            }
        });

    })
    
    $('#close-camera').click(function(){



        $.ajax({
            url: '../controller/faculty/scan-qr-controller.php',
            method: 'post',
            // dataType: 'json',
            data: {
                session: localStorage.getItem('session'),
                action: 'close',
            },
            success: function(response){
                console.log(response)
                Swal.fire({
                    title: 'Attendance Closed',
                    text: 'You have successfully closed the attendance.',
                    icon: 'success',
                    footer: `<span class="text-danger h6">All of students that are not listed will be absent.</span>`,
                    showDenyButton: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                })
            }
        })



        $('#attendance-monitor').empty()
        $('#attendance-monitor').append(`
            <thead class="h5 text-center mb-0 text-truncate" id="attendance-thead">
            <tr class="h6">
                <th>Student ID</th>
                <th>Full Name</th>
                <th>Section</th>
                <th>Date/Time</th>
            </tr>
            </thead>
            <tbody class="h6 text-center mb-0 text-truncate" id="attendance-tbody">
                <tr class="h6">
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        `)
        clearInterval(runMonitor)
        localStorage.removeItem('scanned')
        localStorage.removeItem('session')
        localStorage.removeItem('subject')
        $('#session-text').html("<b>SESSION: </b>NONE")
        $('#select-subject').val('')
        $('#open-camera').prop('disabled', true)
        $('#img-qr').removeClass('d-none')
        $('#qr-camera-result canvas').addClass('d-none')
        $('#video-wrapper').addClass('d-none')
        $('.subject-camera-div').removeClass('d-none')
        $('.stop-camera-div').addClass('d-none')
        scanner.stop();
    })

})


var datalist = Array();

function setResult(result){

    if(result.data != 'No QR code found' && result.data != null){

        var scanned = String(localStorage.getItem('scanned')).split(',')

        const results = scanned.filter(element => {
            return element !== null;
        });

        if(!results.includes(result.data)){
            
            if(result.data !== null){
                scanned.push(result.data)
                localStorage.setItem('scanned', scanned)
            }
            
            Swal.close()

            if(result.data !== null){
                $.ajax({
                    url: '../controller/faculty/scan-qr-controller.php',
                    method: 'post',
                    dataType: 'json',
                    data: {
                        session: localStorage.getItem('session'),
                        subject: localStorage.getItem('subject'),
                        encoder: $('#account-id').val(),
                        qr: result.data,
                    },
                    success: function(response){
                        
                        console.log(response)

                        console.log(result.data)
                        Swal.fire({
                            title: response.title,
                            html: response.html,
                            
                            icon: response.icon,
                            showDenyButton: false,
                            showCancelButton: false,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        })
                    }
                })
            }

        }
        console.log(results)
    }

}

function loadMonitor(){

    if($('body').hasClass('dark')){
        var theme = 'dark'
    }else{
        var theme = 'light'
    }
    $.ajax({
        url: '../controller/faculty/attendance-monitor.php',
        method: 'post',
        dataType: 'html',
        data:{
            session: localStorage.getItem('session'),
            encoder: $('#account-id').val(),
            theme: theme,
        },
        success: function(response){
            // console.log(response)
            $('#attendance-monitor').html(response)
        },

    })

    

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
            $('.subject-list').empty()
            $('.subject-list').append(`<option disabled selected value="" class="dropdown-header">Subjects</option>`)
            for(i = 0; i < response.rowlimit; i++){
               $('.subject-list').append(`
                    <option value="${response.subcode[i]}">[${response.yearlevel[i]}] ${response.subname[i]}</option>
                `)
            }
            // GenerateQRInit()
        }
    })
}
