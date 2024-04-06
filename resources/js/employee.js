$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#employee_add_form').submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    $('#file-input-error').text('');

    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: formData,
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                $('#employee_add-modal').hide();
                $('#employee_add_form').trigger('reset');
                alert(response.message);
                window.requestTable = $('#employees-table').dataTable();
                window.requestTable.fnDraw();
            }
        },
        error: function (response) {
            $('#file-input-error').text(response.responseJSON.message);
        }
    });
});

$(document).on('click','.show_edit',function(){
    $('#employee_add_form').trigger('reset');
    $.ajax({
        type: 'get',
        url: $(this).attr('data-custom-action'),
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                $('#mode').val('edit');
                $('#id').val(response.employee.id);
                $('#edit_country_id').val(response.employee.country_id);
                $('#edit_state_id').val(response.employee.state_id);
                $('#employee_name').val(response.employee.name);
                $('#employee_email').val(response.employee.email);
                $('#display_existing_img').html('<img src="'+response.employee.image+'" width=50 height=50 >');
                getCountryData();
                getStateData(response.employee.country_id);
                $('#employee_add-modal').toggle();
            }
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
});
$(document).on('change','#employee_country',function(){
    getStateData($(this).val());
});

$(document).on('click','#employee_add_btn',function(){
    $('#employee_add_form').trigger('reset');
    getCountryData();
});

$(document).on('click','.show_delete',function(){
    confirm('Are you sure you want to delete this employee?');
    $.ajax({
        type: 'DELETE',
        url: $(this).attr('data-custom-action'),
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                alert(response.message);
                window.requestTable = $('#employees-table').dataTable();
                window.requestTable.fnDraw();
            }
        },
        error: function (response) {
            $('#file-input-error').text(response.responseJSON.message);
        }
    });
});

function getCountryData(){
    $.ajax({
        type: 'get',
        url: $('#employee_add_btn').attr('data-custom-action'),
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                $('#employee_country').find('option').not(':first').remove();
                $.each(response.countries, function(i, item) {
                    $('#employee_country')
                        .append($("<option></option>")
                        .attr("value", item.id)
                        .text(item.name)); 
                });
                if($('#mode').val() === 'edit'){
                    $('#employee_country option[value="'+$('#edit_country_id').val()+'"]').attr('selected','selected');
                }
            }
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
}

function getStateData(country_id){
    $.ajax({
        type: 'get',
        url: $('#employee_country').attr('data-custom-action')+'/'+country_id,
        contentType: false,
        processData: false,
        success: (response) => {
            if (response) {
                $('#employee_state').find('option').not(':first').remove();
                $.each(response.states, function(i, item) {
                    $('#employee_state')
                        .append($("<option></option>")
                        .attr("value", item.id)
                        .text(item.name)); 
                });
                if($('#mode').val() === 'edit'){
                    $('#employee_state').val($('#edit_state_id').val());
                }
            }
        },
        error: function (response) {
            alert(response.responseJSON.message);
        }
    });
}