$(document).ready(function () {
    $('#reset_submit').click(function (event) {

        if(!$("#reset_form")[0].checkValidity()) {
            $('<input type="submit">').hide().appendTo("#reset_form").click().remove();
            return;
        }

        event.preventDefault();
        var oldUsername = $('#old_username').val();
        var oldPassword = $('#old_password').val();
        var newUsername = $('#new_username').val();
        var newPassword = $('#new_password').val();
        var newEmail = $('#new_email').val();
        var newMobile = $('#new_mobile').val();
        var confirmNewPassword = $('#confirm_new_password').val();

        if (newPassword !== confirmNewPassword) {
            showToastB( "aeToastE","Password Mismatch","your passwords do not match","10");
    
            return false;
        }

        // add 

            
        
        reset(oldUsername, oldPassword, newUsername, newPassword,newEmail,newMobile);
    
    });
});




function reset(oldUsername, oldPassword, newUsername,newPassword,newEmail,newMobile) {
    $.ajax({
      type: "post",
      data: {
        oldUsername: oldUsername,
        oldPassword: oldPassword,
        newUsername: newUsername,
        newPassword: newPassword,
        newEmail:newEmail,
        newMobile:newMobile,
      },
      cache: false,
      url: "reset.php",
      dataType: "text",
      success: function (data, status) {
        alert(data)
        if(data==1){
            showToast( "aeToastS","Success","Your password has been reset","10"); 
        }
        else{
            showToast( "aeToastE","Invalid Details","We Cannot reset","10"); 
        }
        
      },
      error: function (xhr, status, error) {
        // alert(error);
      },
    });

  } 
    