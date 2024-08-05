$(document).ready(function() {

    if($('#subscribe').length>0)
    {
        $('#subscribe').DataTable({
            "searching": false,
            "lengthChange": false,
            // "pageLength": 10 // Set the default page length
            "paging": false

        });
    }
    $("#loadmore-btn").click(function() {
        let template = $(this).attr("data-template");
        let cat_id = $(this).attr("data-cat-id");
        let curent_count = $(this).attr("current-count");
        let total_count = $(this).attr("total-count");
        let data_type = $(this).attr("data-type");
        let page = $('#loadmore-btn').attr("data-page");

        if (cat_id && curent_count != total_count) {
            $.ajax({
                url: base_url +"/addmore",
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    template: template,
                    cat_id: cat_id,
                    page: page,
                    data_type: data_type,
                },
                success: function(result) {
                    // console.log(result,result.page, result.current_total);  // Log the result to the console
                    $("#press_release").append(result.data);
                    $("#loadmore-btn").attr("data-page",result.page);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);  // Log the error to the console
                },
            });
        }
    });

    $('#searchImage').click(function () {
        // Check if the current URL includes '/tag/'
        var searchValue = $('#searchInput').val().trim();
        if( searchValue != '' )
        {
            url = base_url+ '/advancefilter/'+ searchValue;
            window.location.href = url;
        }
        else{
            url = base_url+ '/advancefilter/';
            window.location.href = url;
        }
    });

    // function constructAndRedirect(route) {
    //     var searchValue = $('#searchInput').val().trim();
    //     var remainingPath = window.location.pathname.split(route)[1];
    //     var url;

    //     if (remainingPath) {
    //         var segments = remainingPath.split('/');
    //         var filterValue = segments[0];

    //         if (segments.length > 1) {
    //             url = siteUrl.concat('/', route, filterValue, '/', searchValue || '');
    //         } else {
    //             url = siteUrl.concat('/', route, filterValue, searchValue ? '/' + searchValue : '');
    //         }
    //     }

    //     window.location.href = url;
    // }

});

$(document).on("click", ".addmorefund", function() {
    let fundindex = $("#fundindex").val();
    let company_id = $("#company_id").val();
    let fundIndexAsInteger = parseInt(fundindex, 10);

    if (fundindex) {
        $.ajax({
            url: base_url + "/addmorefund",
            type: "POST",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                fundindex: fundindex,
                company_id: company_id,
            },
            success: function(result) {
                console.log(result.data);  // Log the result to the console
                $("#all_fund_div").append(result.data);
                $("#fundindex").val( fundIndexAsInteger + 1);
                if($(".selectpicker").length) {
                    $('.selectpicker').select2({
                        minimumResultsForSearch: Infinity,
                        placeholder: function() {
                            return $(this).data('placeholder');
                        },
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);  // Log the error to the console
            },
        });
    }
});


$(document).on("change", "#to_date_month, #to_date_year", function() {
    if ($('#to_date_month').val() || $('#to_date_year').val()) {
        // If either field is selected, make the other field required
        $('#to_date_month').prop('required', true);
        $('#to_date_year').prop('required', true);
    } else {
        // If neither field is selected, remove the required attribute
        $('#to_date_month').prop('required', false);
        $('#to_date_year').prop('required', false);
    }
});

$(document).on("change", "#from_date_month, #from_date_year", function() {
    if ($('#from_date_month').val() || $('#from_date_year').val()) {
        // If either field is selected, make the other field required
        $('#from_date_month').prop('required', true);
        $('#from_date_year').prop('required', true);
    } else {
        // If neither field is selected, remove the required attribute
        $('#from_date_month').prop('required', false);
        $('#from_date_year').prop('required', false);
    }
});

$(document).on("click", ".planselected", function() {

    $("#package_price_id").val($(this).attr("data-value"));

});


$(document).on("click", ".notlogin", function() {
    $('#fund-submitted').modal();
});

$(document).on("click", ".notsubscriber", function() {
    $('#login-notsubscriber').modal();
});


$(document).on("click", ".togglePassword", function() {
    // var togglePasswordIcon = document.getElementById("togglePassword");
    index = $(this).attr('index');
    var passwordInput = document.getElementById("passwordInput".concat(index));
    console.log(index,passwordInput);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        // Change the eye icon to indicate that the password is visible
        $(this).innerHTML = '<img src="{{asset("assets/images/icons/Hide.png")}}" alt="Hide">';
    } else {
        passwordInput.type = "password";
        // Change the eye icon to indicate that the password is hidden
        $(this).innerHTML = '<img src="{{asset("assets/images/icons/Show.png")}}" alt="Show">';
    }
});


$(function(){
    $("#searchInput").on('keypress', function(event) {
        let keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13') {
          $("#searchImage").click();
        }
      });
});
$(document).on("change", ".fund_company_hide", function() {

    if($(this).val() != '')
    {
        $('.suggest_company').hide();
    }else{
        $('.suggest_company').show();
        $('#suggest_company').val('');
    }
});
