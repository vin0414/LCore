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

$(document).on('click','.newAssignment',function(){
    var confirmation = confirm("Do you want to assign this employee with new assignment?");
    if(confirmation)
    {
        $('#newAssignmentModal').css('display', 'flex');
        $('#employeeJobID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeJobModal() {
    $('#newAssignmentModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.jobTransfer',function(){
    var confirmation = confirm("Do you want to transfer this employee?");
    if(confirmation)
    {
        $('#jobTransferModal').css('display', 'flex');
        $('#employeeTransferID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeTransferModal() {
    $('#jobTransferModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.promote',function(){
    var confirmation = confirm("Do you want to promote this employee?");
    if(confirmation)
    {
        $('#promoteModal').css('display', 'flex');
        $('#employeePromoteID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closePromoteModal() {
    $('#promoteModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.salaryAdjusment',function()
{
    var confirmation = confirm("Would you like to apply salary adjustment with this employee?");
    if(confirmation)
    {
        $('#salaryModal').css('display', 'flex');
        $('#employeeSalaryID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeSalaryModal() {
    $('#salaryModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}

$(document).on('click','.demote',function(){
    var confirmation = confirm("Do you want to demote this employee?");
    if(confirmation)
    {
        $('#demoteModal').css('display', 'flex');
        $('#employeeDemoteID').attr("value",$(this).val());
        $('body').addClass('no-scroll');
    }
});

function closeDemoteModal() {
    $('#demoteModal').css('display', 'none');
    $('body').removeClass('no-scroll');  
}
