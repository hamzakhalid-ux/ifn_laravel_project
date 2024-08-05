let menuEditor;
$( document ).ready(function() {
    // fade allert message

    $(".alert-dismissible").fadeTo(1000, 1).fadeOut(5000);

    tinymce.init({
        selector: 'textarea#myeditorinstance',
        plugins: 'code table lists image',
        toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table ',
        // images_upload_handler: function (blobInfo, success, failure) {
        //     // Implement client-side image upload logic when the form is submitted
        // },
        // paste_data_images: true // Allow pasting images directly into the editor
    });
      if($(".js-example-basic-multiple").length > 0)
      {
        $('.js-example-basic-multiple').select2();
      }

    // icon picker options
    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    if($("#myEditor").length > 0)
    {
        menuEditor = new MenuEditor('myEditor', {
            listOptions: {
                placeholderCss: {'background-color': "#cccccc"}
            },
             iconPicker: iconPickerOptions
            });


            edit_sorted_order = $("#sorted-order").val();
            console.log(edit_sorted_order)
            if(edit_sorted_order)
            {
                menuEditor.setData(edit_sorted_order);
            }

            menuEditor.setForm($('#frmEdit'));
            menuEditor.setUpdateButton($('#btnUpdate'));
    }



    $(document).on('click', ".addInMenuStructure", function(){
        let data_id = $(this).val();
        let data_title = $(this).attr('data-titel');
        let data_type = $(this).attr('data-type');
        if($(this).is(':checked')){
            $(this).prop('disabled',true);
            $("#text").val(data_title);
            $("#data_id").val(data_id);
            $("#data_type").val(data_type);
            $("#href").val('http://custom-url.com');
            $("#target").val('_blank');
            $("#title").val('Custom Tooltip');
            menuEditor.add();
            updateSortableInput()
        }
        else if(!($(this).is(':checked')))
        {
            //
        }
    });

});

function updateSortableInput() {

    let output = menuEditor.getString();
    $("#sorted-order").val(output);

}

$(document).on("click", ".deleteRecord", function () {
    let data_id = $(this).attr("data-id");
    let used_at = $(this).attr("used_at");
    let data_route = $(this).attr("data-route");

    if (data_id) {
      Swal.fire({
        title: "Are you sure? You want to delete this Record?",
        text: "Note: This condition will be deleted Record permanently.",
        icon: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
      }).then(function (result) {
        if (result.value) {
          $.ajax({
            url:  base_url + "/admin/" + data_route,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                data_id: data_id,
                used_at: used_at },
            success: function (result) {
              Swal.fire(result.title, result.message, result.icon).then(()=>{
                window.location.reload();
              });


            },
            error: function () {
              Swal.fire("Unable to Delete Record.");
            },
          });
        }
      });
    }
  });


  function storeMenuItems() {
        menuItems = menuEditor.getString();

        var form = document.getElementById('mainForm');
        form.reset();
        $("#sorted-order").val(menuItems);
        enableAllFields(form);

        menuItems = JSON.parse(menuItems);
        storeMenuItemsRes(menuItems);

    }
    function storeMenuItemsRes(menuItems)
    {
        if(menuItems != null && menuItems != undefined)
        {
            menuItems.forEach(item => {
                $("#"+item.data_id+item.data_type).prop('disabled' , true);
                $("#"+item.data_id+item.data_type).prop('checked', true);

                // Check if the current item has children
                if (item.children && Array.isArray(item.children)) {

                    storeMenuItemsRes(item.children);
                }
            });
        }
    }



function enableAllFields(form) {
    // Get all form elements
    var elements = form.elements;

    // Loop through the elements and enable them
    for (var i = 0; i < elements.length; i++) {
        elements[i].disabled = false;
        elements[i].checked = false;
    }
}

$(document).ready(function() {
    $('.thumbnail').on('click', function() {
        var imageUrl = $(this).find('img').attr('src');
        var images =JSON.parse($(this).find('img').attr('data-image-sizes'));
        $('#modalImage').attr('src', imageUrl);
        images.forEach(function (value, index) {
        $('#imageUrl_'+value['size_number']).text(value['image_name']);
        });
        // $('#imageModal').modal('show');
    });
});

$(document).ready(function() {
    $('#imageInput').on('change', function() {
        var files = $(this)[0].files;
        var fileNames = [];
        for (var i = 0; i < files.length; i++) {
            fileNames.push(files[i].name);
        }
        console.log("sss");
        $('#selectedImages').val(fileNames.join(', '));
    });
});


$('.delete-icon').on('click', function(event) {
    event.preventDefault();
    event.stopPropagation();

    var imageToDelete = $(this).closest('a').data('image-name');
    var parentElement = $(this).parent('a');
    var attributeValue = parentElement.attr('data-image-name');
if (attributeValue) {
    Swal.fire({
        title: "Are you sure? You want to delete this Image?",
        text: "Note: This condition will be deleted Image permanently.",
        icon: "error",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false,
    }).then(function (result) {
        if (result.value) {
        $.ajax({
            url:  base_url + "/admin/media/delete-image" ,
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                image_name: attributeValue,
                },
            success: function (result) {
            Swal.fire(result.title, result.message, result.icon).then(()=>{
                window.location.reload();
                });
            },
            error: function () {
            Swal.fire("Unable to Delete Record.");
            },
        });
        }
    });
    }
    // Optionally, you can remove the thumbnail from the UI
});


$('.removepostimage').on('click', function() {
    var parent = $(this).parent();
    parent.remove();
    $("#oldPostImage").val('');
});


$(document).ready(function() {
    $('#imageInput').on('change', function(event) {
        var selectedFile = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
            $('#imagePreview').show();
            $('#selectedImages').val(selectedFile.name);
        };

        reader.readAsDataURL(selectedFile);
    });

    $('#resetButton').on('click', function() {
        $('#imageInput').val(''); // Clear the file input
        $('#imagePreview').hide(); // Hide the image preview
        $('#selectedImages').val(''); // Clear the selected image name
        $("#oldPostImage").val('');
    });
});


$('.saveFieldRecord').on('click', function() {

    field_label = $("#field_label").val();
    field_class = $("#field_class").val();
    field_name = $("#field_name").val();
    count_index =$("#count_index").val();
    field_required = $('input[name="required"]:checked').val();
    field_id = $("#exampleModalLabel").attr('field_id');
    field_type = $("#exampleModalLabel").attr('field_type');
    html = '<div class="form-group row" style="display: flex; align-items: center; margin: 10px">'
    + '<label for="label" class="col-sm-2">' + ((field_label === '') ? field_type.toUpperCase() : field_label.toUpperCase()) + ':</label>'
    + '<input type="' + field_type + '" disabled class="' + ((field_type === 'radio') ? 'col-sm-9' : ' form-control col-sm-10') + '" id="" name="'+ field_name +'" placeholder="' + field_type.toUpperCase() + ' Field:">'
    + '<input type="hidden" value="' + field_id + '" name="form_fields[' + count_index + '][field_id]">'
    + '<input type="hidden" value="' + field_type + '" name="form_fields[' + count_index + '][field_type]">'
    + '<input type="hidden" value="' + field_name + '" name="form_fields[' + count_index + '][field_name]">'
    + '<input type="hidden" value="' + field_label + '" name="form_fields[' + count_index + '][field_label]">'
    + '<input type="hidden" value="' + field_class + '" name="form_fields[' + count_index + '][field_class]">'
    + '<input type="hidden" value="' + field_required + '" name="form_fields[' + count_index + '][field_required]">'
    + '<button type="button" class="btn btn-danger btn-sm delete-field col-sm-1" style="margin-left: 15px" data-index="' + count_index + '" onclick="deleteField(this)"><i class="fa fa-times"></i></button>'
    + '</div>';



    $("#form_structure").append(html);
    $("#count_index").val(parseInt(count_index)+1);

});

$('.formmodel').on('click', function(){
    $("#field_label").val('');
    $("#field_class").val('');
    $("#exampleModalLabel").attr({
        "field_id" : $(this).attr('data-field_id'),
        "field_type" : $(this).attr('data-field_type')
    });
});

function deleteField(button) {
    $(button).closest('.form-group').remove();
}



$('.fund-status').on('change', function() {
    var fundId = $(this).data('id');
    var status = $(this).val();
    // Perform AJAX call
    $.ajax({
         url:  base_url + "/admin/fund/change-fund-status",
        type: 'POST',
        data: {
            id: fundId,
            status: status
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            Swal.fire(response.title, response.message, response.icon).then(()=>{
                // window.location.reload();
              });
        },
        error: function(error) {
            Swal.fire("Error","Unable to Change Status.",'error');
        }
    });
});

function addItem() {
    event.preventDefault();
    event.stopPropagation();
    var inputValue = document.getElementById('packageInput').value;

    if (inputValue.trim() !== '') {
        var packageList = document.getElementById('packageList');

        // Create list item with text and delete button
        var itemCount = packageList.getElementsByTagName('li').length;

        // Create list item with text and delete button at the end
        var listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `
            <span>${inputValue}</span>
            <button onclick="deleteItem(this)" class="btn btn-danger btn-sm" style="margin-left: 500px">Delete</button>
            <input type="hidden" name="package[defult_deal][${itemCount}][deal_name]" value="${inputValue}">
        `;

        // Append the list item to the list
        packageList.appendChild(listItem);

        // Clear the input field
        document.getElementById('packageInput').value = '';
    }
}

function deleteItem(button) {
    var listItem = button.parentNode;
    var packageList = listItem.parentNode;

    // Remove the list item from the list
    packageList.removeChild(listItem);
}

function adddeals() {

    event.preventDefault();
    event.stopPropagation();

    var dealTitle = document.getElementById('deal_title').value;
    var dealDescription = document.getElementById('deal_description').value;

    if (dealTitle.trim() !== '') {
        var packageList = document.getElementById('packageList');

        // Create list item with text and delete button
        var listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `
            <span>${dealTitle} - ${dealDescription}</span>
            <button onclick="deleteItem(this)" class="btn btn-danger btn-sm" style="margin-left: 500px">Delete</button>
            <input type="hidden" name="deal[custom_deals][${dealTitle}][description]" value="${dealDescription}">
        `;

        // Append the list item to the list
        packageList.appendChild(listItem);

        // Clear the input fields
        document.getElementById('deal_title').value = '';
        document.getElementById('deal_description').value = '';
    }
}

function addCustomItem() {
    // Get values from the form
    var url = document.getElementById('url').value;
    var title = document.getElementById('custom_title').value;
    var customindex =document.getElementById('customindex').value;
    var convertedIndex = parseInt(customindex, 10);
        $("#text").val(title);
        $("#data_id").val(convertedIndex);
        $("#data_type").val('custom_links');
        $("#href").val(url);
        $("#target").val('_blank');
        $("#title").val('Custom Tooltip');
        menuEditor.add();
        // innerHTML = `<input type="hidden" name="menu[custom_item][${convertedIndex}][title]" value="${title}">
        //     <input type="hidden" name="menu[custom_item][${convertedIndex}][url]" value="${url}">`;
        // $("#custom_input_div").append(innerHTML);
        var newIndex = convertedIndex + 1;
        document.getElementById('customindex').value = newIndex;

        updateSortableInput()

    // Close the modal
    $('#customItemModal').modal('hide');
}

$('input[name="post[post_type]"]').change(function () {
    if ($(this).val() === 'podcast') {
        $('#podcastInput').toggle(this.checked);
        $('#videoInput').hide(); // Hide the video input
    } else if ($(this).val() === 'video') {
        $('#videoInput').toggle(this.checked);
        $('#podcastInput').hide(); // Hide the podcast input
    }
    else{
        $('#videoInput').hide(); // Hide the video input
        $('#podcastInput').hide(); // Hide the podcast input
    }
});

$('#passwordvalidate').on('keyup', function() {
    var password = $(this).val();
    var passwordValidationMessage = $('#passwordValidationMessage');
    // Define your password regex pattern
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (passwordRegex.test(password)) {
        passwordValidationMessage.text('Password is valid').removeClass('text-danger').addClass('text-success');
    } else {
        passwordValidationMessage.text('Password is not valid').removeClass('text-success').addClass('text-danger');
    }
});

$('.panel-heading h3').on('click', function () {
    // Find the panel body associated with the clicked h3
    var panelBody = $(this).closest('.panel').find('.panel-body');

    // Find all checkboxes within the panel body and toggle their checked state
    panelBody.find(':checkbox').prop('checked', function (index, oldValue) {
        return !oldValue;
    });
});



$('.payment-status').on('change', function() {
    var fundId = $(this).data('id');
    var user_id = $(this).data('user');
    var status = $(this).val();
    // Perform AJAX call
    $.ajax({
         url:  base_url + "/admin/subscriber/change-subscriber-payment-status",
        type: 'POST',
        data: {
            id: fundId,
            userid: user_id,
            status: status,
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function(response) {
            Swal.fire(response.title, response.message, response.icon).then(()=>{
                // window.location.reload();
              });
        },
        error: function(error) {
            Swal.fire("Error","Unable to Change Status.",'error');
        }
    });
});


$('.convertCurrency').on('click', function() {
    var local_currency = $("#local_currency").val();
    var local_amount = $("#local_amount").val();
    // Perform AJAX call
    if(local_currency != '' && local_amount != '')
    {
        $.ajax({
            url:  base_url + "/fund/convertCurrency",
            type: 'POST',
            data: {
                local_currency: local_currency,
                local_amount: local_amount,
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                if(response.success)
                {
                    $('#anum_usd').val(response.data);
                }
            },
            error: function(error) {
                Swal.fire("Error","Unable to Change Status.",'error');
            }
        });
    }else{
        Swal.fire("Error","Local Currency/Amount field Empty!.",'error');
    }
});

function reloadPage() {
    // Add any custom logic here if needed
    window.location.href = previousUrl;
}

$('.customcountry').on('change', function () {
    // Find the selected option and get the data-region attribute
    var selectedOption = $(this).find(':selected');
    var region = selectedOption.data('region');
    $('.custom-region').text(region);
});
