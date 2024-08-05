$(document).ready(function () {

    $('#reset_search_button').click(function(){
        $('form.funds-form input[type=text], form.funds-form select').val('');
        $('form.funds-form select').trigger('change');
    });

    $(".slider").each(function () {
        var slider = $(this);
        slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: slider.parent().find('.slick-prev'),
            nextArrow: slider.parent().find('.slick-next'),
            speed: 500,
            autoplay: true,
        });
    });

    if($("#barChart").length) {
        var barChart = {
            series: [
                {
                    name: 'Class A 141',
                    data: [
                        { x: 'Alternative Finance', y: 72 },
                        { x: 'Crowdfunding', y: 53 },
                        { x: 'Payment, Remittance & FX', y: 42 },
                        { x: 'Robo Advisors', y: 13 }
                    ]
                },
                {
                    name: 'Class B 180',
                    data: [
                        { x: 'Blockchain & Cryptocurrency', y: 42 },
                        { x: 'P2P', y: 35 },
                        { x: 'Trading & Investment', y: 64 }
                    ]
                }
            ],
            chart: {
                type: 'bar',
                height: '100%'
            },
            plotOptions: {
                bar: {
                    barHeight: '100%',
                    distributed: false,
                    horizontal: true,
                    barWidth: 20,
                }
            },
            colors: ['#FFD236', '#800000', '#231F20',
            ],
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#000']
                },
                formatter: function (val, opt) {
                    var series = opt.w.config.series[opt.seriesIndex];
                    var xValue = series.data[opt.dataPointIndex].x;
                    return xValue + " | " + val;
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            stroke: {
                width: 2,
                colors: ['#fff']
            },
            xaxis: {
                labels: {
                    show: true
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: true
                },
                y: {
                    title: {
                        formatter: function () {
                            return ''
                        }
                    }
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'center'
            }
        };
        var chart = new ApexCharts(document.querySelector("#barChart"), barChart);
        chart.render();
    }


    if($("#polarChart").length) {
        var polarChart = {
            series: result_reigon.series,
            chart: {
                width: '100%',
                type: 'pie'
            },
            labels: result_reigon.labels,
            fill: result_reigon.fill,
            stroke: result_reigon.stroke,
            yaxis: {
                show: false
            },
            legend: result_reigon.legend,
            dataLabels: {
                enabled: true,
                formatter: function (val, opts) {
                    return opts.w.globals.series[opts.seriesIndex];
                },
            },
            plotOptions: {
                polarArea: {
                    rings: {
                        strokeWidth: 0
                    },
                    spokes: {
                        strokeWidth: 0
                    }
                }
            },
            theme: {
                monochrome: {
                    enabled: true,
                    shadeTo: 'light',
                    shadeIntensity: 0.8
                }
            }
        };
        var chart = new ApexCharts(document.querySelector("#polarChart"), polarChart);
        chart.render();
    }

    $('.scroll-top').click(function(){
        $('html, body').animate({scrollTop:0}, 'slow');
    });

    var headerElm = $(".header-wrapper");
    var headerOffset = headerElm.height();
    function myFunction() {
        if ($(window).scrollTop() > headerOffset) {
            $(".scroll-top").show();
        } else {
            $(".scroll-top").hide();
        }
    }
    $(window).on("scroll", myFunction);

    if($(".selectpicker").length) {
        $('.selectpicker').select2({
            // minimumResultsForSearch: Infinity,
            placeholder: function() {
                return $(this).data('placeholder');
            },
        });
    }

    if($(".selectpicker-clear").length) {
        $('.selectpicker-clear').select2({
            minimumResultsForSearch: Infinity,
            allowClear: true
        });
    }

    $(".trigger-modal").on("click", function(e) {
        e.preventDefault();
        var targetElm = $(this).attr("data-targer");
        $("body").addClass("overflow-hidden")
        $(".modal-backdrop").addClass('show');
        $("body").find(targetElm).addClass('show');
    });
    $(".close-modal").on("click", function(e) {
        e.preventDefault();
        $("body").removeClass("overflow-hidden")
        $(".modal-backdrop").removeClass('show');
        $(this).parents().closest(".modal").removeClass('show');
    });

    if($("#dataTable").length) {
        let table = new DataTable('#dataTable', {
            lengthMenu: [[-1], ['All']], // Display all entries
        });
    }

    $(".custom-table-scroll").mCustomScrollbar({
        axis:"yx",
        theme:"3d",
        autoExpandScrollbar:true,
        advanced:{autoExpandHorizontalScroll:true}
    });
    $(".custom-scroll").mCustomScrollbar({
        axis:"y",
        theme:"3d",
        autoExpandScrollbar:true,
        advanced:{autoExpandHorizontalScroll:true}
    });

    $(".tabs > a").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("href");
        $(".tabs > a").removeClass("selected");
        $(this).addClass("selected");

        $(".tab-content .inner-content").removeClass("active");
        $(".tab-content").find(id).addClass("active");
    });

    $(".custom-select .head").on("click", function() {
        $(this).parent().toggleClass("open");
        $(this).parent().find(".body").slideToggle();
    });

    $(".accordion .head").on("click", function() {
        $(this).parent().toggleClass("open");
        $(this).parent().find(".body").slideToggle();
    });

    $(".custom-select .body li").on("click", function() {
        var data = $(this).html();
        $(".custom-select li").removeClass("selected");
        $(this).addClass("selected");
        $(this).parents(".custom-select").find(".head").html(data);
        $(this).parents(".custom-select").removeClass("open");
        $(this).parents(".custom-select").find(".body").slideUp();
    });

    var inputField = $('.qty-selector input');
    var minusButton = $('.qty-selector .minus-btn');
    var plusButton = $('.qty-selector .plus-btn');
    minusButton.click(function() {
      var currentValue = parseInt(inputField.val(), 10);
      if (currentValue > 0) {
        inputField.val(currentValue - 1);
      }
    });
    plusButton.click(function() {
      var currentValue = parseInt(inputField.val(), 10);
      inputField.val(currentValue + 1);
    });

    $(".account-dropdown .toggler").on("click", function() {
        $(this).parent().find(".dropdown").slideToggle();
    });

});
