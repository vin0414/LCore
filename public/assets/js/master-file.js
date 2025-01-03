$(document).on('click','.changeJobTitle',function(){
    var confirmation = confirm("Do you want to change his/her Job Title?");
    if(confirmation)
    {
        $('#changeJobTitleModal').css('display', 'flex');
        $('#employeeID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeModal() {
    $('#changeJobTitleModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.jobTransfer',function(){
    var confirmation = confirm("Do you want to transfer this employee?");
    if(confirmation)
    {
        $('#jobTransferModal').css('display', 'flex');
        $('#employeeJobID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeJobModal() {
    $('#jobTransferModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.changeSchedule',function(){
    var confirmation = confirm("Do you want to change the schedule of this employee?");
    if(confirmation)
    {
        $('#changeScheduleModal').css('display', 'flex');
        $('#employeeScheduleID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeScheduleModal() {
    $('#changeScheduleModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}