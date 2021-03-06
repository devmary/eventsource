jQuery(document).ready(function () {
    $('.carousel-inner').each(function () {
        $('.item:first', this).addClass('active')
    });
    jQuery("#vendors-shortcuts li.featured:last").addClass("last");
    var isowlinit = false;
    var cars_count = 0;
    var owl_car_class = ".featured-vendors-carousel";

    var owl_car = [];
    if (window.innerWidth < 768) {
        owlInit();
    }
    jQuery(window).resize(function () {

        if (window.innerWidth < 768) {
            if (!isowlinit) {
                owlInit();
            }
        }
        else if (isowlinit) {
            jQuery(owl_car_class).each(function () {
                jQuery(this).data('owlCarousel').destroy();
                jQuery(this).removeClass('owl-carousel owl-loaded');
                jQuery(this).find('.owl-stage-outer').children().unwrap();
                jQuery(this).removeData();
            });
            isowlinit = false;
        }
    });

    jQuery(document).ajaxComplete(function () {
        $('.carousel-inner').each(function () {
            if ($('.item.active', this).length == 0) {
                $('.item:first', this).addClass('active');
            }
        });
        if (window.innerWidth < 768) {
            if (isowlinit) {
                owlInitAdd();
            }
        }
    })


    function owlInitAdd() {
        jQuery(owl_car_class).each(function () {
            if (!jQuery(this).hasClass('owl-loaded')) {
                jQuery(this).owlCarousel({
                        responsive: {
                            0: {
                                items: 1,
                                nav: true
                            },
                            530: {
                                items: 2,
                                nav: false
                            },
                            650: {
                                items: 3,
                                nav: true
                                //loop: false
                            }
                        },
                        loop: false,
                        dots: false,
                        nav: false
                    }
                );
            }
        });
    }

    function owlInit() {
        car = jQuery(owl_car_class).owlCarousel({
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    530: {
                        items: 2,
                        nav: false
                    },
                    650: {
                        items: 3,
                        nav: true
                        //loop: false
                    }
                },
                loop: false,
                dots: false,
                nav: false
            }
        );
        isowlinit = true;
    }

    jQuery('.articles .sim-posts,.articles .rec-posts').show();

    jQuery('.articles .sim-posts,.articles .rec-posts').owlCarousel({
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                530: {
                    items: 2,
                    nav: false
                },
                650: {
                    items: 3,
                    nav: true
                    //loop: false
                },
                1000: {
                    items: 4,
                    nav: true
                    //loop: false
                }
            },
            loop: false,
            dots: false,
            nav: true,
            navText: ["", ""]
        }
    );

    jQuery('.articles .sim-posts,.articles .rec-posts').each(function () {
        jQuery(this).css('display', "");
    });

    $(document).on('click', '.btn-vendor-contact', function () {
        var id = $(this).attr('data-id');
        if (id) {
            $.get('/ContactVendor.aspx', {id: id}, function(data) {
				$('#emailModal .modal-content').html(data);
				$('.modal-dialog').removeClass('similar-block');
				if ($('.contact-block').hasClass('similar-block')) {
					$('.modal-dialog').addClass('similar-block');
				}
				$('#emailModal').modal('show');
            });
        }
    });
});


$(function () {

    var offset_t = 600, // At what pixels show Back to Top Button
        scrollDuration = 500; // Duration of scrolling to top

    if ($('.link-box').length) {

        $('.link-box a').click(function (e) {

            e.preventDefault();
            $(this).toggleClass('active');


        });
    }


    // Sidebar button position
    function slide_btn_pos() {

        var win_w = $(window).outerWidth(),
            cnt_w = $('.sliding-content').outerWidth(),
            btn_pos = ( win_w - cnt_w ) / 2;

        $('.slide-sidebar').css('left', '-' + btn_pos + 'px');

    }

    slide_btn_pos();
    $(window).resize(slide_btn_pos);

    /* Custom Functions */
    var navMain = $("#main-menu"), menuTimeout, $this;

    var $window = $('html, body');
    $window.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function (e) {
        if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
            $window.stop().unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
        }
    });

    $(document).on('click', function (e) {
        navMain.collapse('hide');
        $("#main-menu").removeClass('ztest');
    });

    checkDesktopMenuLinks();
    resizeDetailsSidebar();
    $(window).resize(function () {
        checkDesktopMenuLinks();
        resizeDetailsSidebar(true);
        ReBindMenuEvents();
        //pollCarouselVisibility($('.modal-success-carousel'), modalCarousel);
    });

    function checkDesktopMenuLinks() {
        if (window.innerWidth >= 992) {
            $('.primary-nav > li.dropdown > a:not(:last)').addClass('disabled');
        } else {
            $('.primary-nav > li.dropdown > a:not(:last)').removeClass('disabled');
        }
    }

    function resizeDetailsSidebar(allow) {
        if ($('.details-sidebar-outer').length) {
            if ($(window).width() > 991) {
                $('.details-sidebar-outer').height($('.details-sidebar').height() + $('.details-sidebar-banners').height());
            } else {
                if (allow) {
                    $('.details-sidebar-outer').removeProp('style');
                }
            }
        }
    }

    ReBindMenuEvents();

    $('a.back2menu').on('click touchstart', function (e) {
        e.preventDefault();
        $(this).closest(".dropdown-menu").prev().dropdown("toggle");
        $('html, body').animate({
            scrollTop: "0"
        }, 750);
        $(".primary-nav").animate({
            scrollTop: "0"
        }, 750);
    });

    function ReBindMenuEvents() {
        if (window.innerWidth < 992) {
            $("#search-suggestions").hide();
            $('.primary-nav li.dropdown').unbind('mouseenter mouseleave hover');

            $(document).on('click', '.primary-nav .dropdown-toggle', function (e) {
                $('html, body, .dropdown-menu, .primary-nav, .yamm-content, .primary-nav').animate({
                    scrollTop: "0"
                }, 750);
            });
        }
        else {
            $('.primary-nav li.dropdown').hover(function () {
                if ($('.primary-nav li.dropdown.open') != this) {
                    $('.primary-nav li.dropdown').removeClass('open');
                    $(this).addClass('open').clearQueue();
                }

            }, function () {
                $(this).delay(500).queue(function () {
                    $(this).removeClass('open').clearQueue();
                });
            });


        }
    }

    // resize the right sidebar on the details page,
    // when the sidebar slides up and down the banners stay in place
    if ($('.details-sidebar-outer').length) {
        if ($(window).width() > 991) {
            $('.details-sidebar-outer').height($('.details-sidebar').height() + $('.details-sidebar-banners').height());
        }
    }


    /* Make Nav - yamm-carousel open on hover*/
    $('.categories-carousel li.dropdown').hover(function () {
        $(this).addClass('open');
    }, function () {
        $(this).removeClass('open');
    });


    /* Popover */
    $('.cc-link.default').popover({
        html: true,
        animation: false,
        trigger: "click",
        content: function () {
            $(this).data('bs.popover').tip().addClass('default-width');
            return $(this).next('.cc-dropdown').html();
        }
    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 0);
    }).mousedown(function () {
        isDragging = false;
        $(this).popover("hide");
    });
    /*.click(function(e){e.preventDefault()});*/


    $('.cc-link.full').popover({
        html: true,
        animation: false,
        trigger: "click",
        container: '#cc-area',
        content: function () {
            if ($(this).hasClass('full')) {
                $(this).data('bs.popover').tip().addClass('full-width'); // Add custom class to popover
                return $(this).next('.cc-dropdown').html();
            } else {
                return $(this).next('.cc-dropdown').html();
            }

        }
    }).on("mouseenter", function () {
        var _this = this;
        $(this).popover("show");
        $(".popover").on("mouseleave", function () {
            $(_this).popover('hide');
        });
    }).on("mouseleave", function () {
        var _this = this;
        setTimeout(function () {
            if (!$(".popover:hover").length) {
                $(_this).popover("hide");
            }
        }, 0);
    }).mousedown(function () {
        isDragging = false;
        $(this).popover("hide");
    });
    /*.click(function(e){e.preventDefault()});*/


    /* Fix Navigator Jump */

    $(".main-toggle").click(function (e) {
        $('#main-menu').toggleClass('ztest');
        if (!$(".search-toggle").hasClass("collapsed")) {
            $(".search-toggle").click();
        }
    });

    /* Fix Show/Hide Search/Mobile Nav */
    $(".search-toggle").click(function (e) {
        if (!$(".main-toggle").hasClass("collapsed")) {
            $(".main-toggle").click();
        }
    });


    /* Make Profile DropDown slide */
    // Add slideup & fadein animation to dropdown
    $('.user-profile').click(function (e) {
        var $dropdown = $(this).find('.dropdown-menu');
        $dropdown.slideToggle('fast');
    });


    /* Global Search */
    $('.search-link a').click(function (e) {
        e.preventDefault();
        $("#search-suggestions").toggle();
        $(".close-ss").click(function (e) {
            e.preventDefault();
            $("#search-suggestions").hide();
        });
    });

    /* Scroll to specific #ID */
    $(".scrollTo").click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $("#categories").offset().top
        }, 750);
    });


    $(".modal .form-control").bind('blur keyup change', function () {

        if ($(this).parents('form').find('.has-error').length) {

            $('.validation-top-error').css('display', 'block');

        } else {

            $('.validation-top-error').css('display', 'none');

        }

    });


    $(document).mouseup(function (e) {

        var container = $(".modal-dialog");

        if (!container.is(e.target) && container.has(e.target).length === 0 && (e.target != $('html').get(0))) {
            $('.modal').modal('hide');
        }

    });

    /* Avoid closing megamenu on click */
    $(document).on('click', '.yamm .dropdown-menu, .main-toggle, .search-toggle', function (e) {
        e.stopPropagation()
    });

    // Change caret icon
    if ($(".toggle-price-collapsible").length) {
        $('.toggle-price-collapsible').click(function (e) {
            e.preventDefault();
            $(this).toggleClass('caret-down caret-up');
        });
    }


    $('.details-section .nav li').on('click', function () {

        if ($(this).hasClass('active')) return false;

        if (resizeInd === true) {
            pollVisibility($(this).attr('id'));
            resizeInd = false;
        }
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > offset_t) {
            $('.to-top').addClass('show-top');
        } else {
            $('.to-top').removeClass('show-top');
        }
    });

    // Smooth animation when scrolling
    $('.to-top').click(function (e) {

        e.preventDefault();

        $('html, body').animate({
            scrollTop: 0
        }, scrollDuration);

    });

    $('body').ajaxComplete(function () {
        FB.XFBML.parse(document.body)
    });

    $('.articles .header > div').click(function () {
        $('.articles .header > div.active').removeClass('active');
        var _this = this;
        $('.articles .sim-posts.active,.articles .rec-posts.active').fadeOut(300, function () {
            $(this).removeClass('active');
            $('.' + $(_this).attr('data-slider')).fadeIn(300, function () {
                $(this).addClass('active')
            });
        });
        $(this).addClass('active');

    });
    jQuery('.really_simple_twitter_widget').owlCarousel({'items': 1});
    jQuery('.scroll-to-content').click(function (e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: jQuery('#content').offset().top
        }, 500);
    });
    jQuery('.comments a').on('click', function (e) {
        if (window.location.toString().split('#')[0] == this.href.split('#')[0]) {
            e.preventDefault();
            jQuery('body,html').animate({
                scrollTop: jQuery('#comments').offset().top
            }, 400, 'swing', function () {
                jQuery('body,html').animate({
                    scrollTop: jQuery('#comments').offset().top
                }, 100);
            }); //WP-comments.
        }
    });
});

var blurHash = new Array();
var clearOnce = function (elementid) {
    var searchBoxElement = jQuery('#' + elementid);
    if (searchBoxElement.hasClass("txtSearch") && searchBoxElement.val() == "Search EventSource.ca") {
        blurHash[elementid] = searchBoxElement.val();
        searchBoxElement.val("");
        searchBoxElement.css({color: 'black'});
    } else if (searchBoxElement.hasClass('grey_fields')) {
        blurHash[elementid] = searchBoxElement.val();
        searchBoxElement.val("");
        searchBoxElement.removeClass('grey_fields');
    }
};

var blurOnce = function (elementid) {

    var searchBoxElement = jQuery('#' + elementid);
    if (jQuery.trim(searchBoxElement.val()).length == 0) {
        if (searchBoxElement.hasClass("txtSearch")) {
            searchBoxElement.val(blurHash[elementid]);
            searchBoxElement.css({color: '#939393'});
        } else {
            searchBoxElement.val(blurHash[elementid]);
            searchBoxElement.addClass('grey_fields');
        }
    }
};

function htmlEncode(value) {
    return jQuery('<div/>').text(value).html();
}

function htmlDecode(value) {
    return jQuery('<div/>').html(value).text();
}

jQuery(document).ready(function () {
    jQuery.ui.autocomplete.prototype._renderItem = function (ul, item) {
        var r = new RegExp(this.term, "i");

        var m = item.label.match(r);

        var t = null;

        if (m != null && m.length > 0) {
            t = item.label.replace(m, "<span class='ui-autocomplete-term'>" + m + "</span>");
        } else {
            t = item.label;
        }

        return jQuery("<li>")
            .append(jQuery("<a>").html(t))
            .appendTo(ul);
    };

    txtSearch = jQuery('#txtSearch');
    txtSearch1 = jQuery('#txtSearch1');

    txtSearch.focus(function () {

    });
    txtSearch1.focus(function () {

    });

    var cache = {};
    var values;
    var type;
    if (txtSearch.length > 0) {
        txtSearch.autocomplete({
            source: function (request, response) {

                var param = {'keywords': request.term};
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                } else {
                    jQuery.ajax({
                        type: "POST",
                        url: "/SearchWebService.asmx/GetSearchResult",
                        data: JSON.stringify(param),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (data) {
                            var obj = jQuery.parseJSON(data.d);
                            if (obj) {
                                values = Array();
                                type = Array();
                                for (var i = 0; i < obj.length; i++) {
                                    values.push(htmlDecode(obj[i].Result));
                                    type.push(obj[i].Type);
                                }
                                cache[request.term] = values;
                                response(values);
                            } else
                                response('');
                        },
                        error: function (result) {
                            alert(result.status + ' ' + result.statusText);
                        }
                    });
                }
            },
            minLength: 2,
            select: function (event, ui) {
                var selectedObj = ui.item;

                txtSearch.val(selectedObj.label);
                jQuery('input[name="searchType"]').val(type[values.indexOf(selectedObj.value)]);
                jQuery('#btnSearch').trigger('click');
                return false;
            }
        });
    }
    if (txtSearch1.length > 0) {
        txtSearch1.autocomplete({
            source: function (request, response) {

                var param = {'keywords': request.term};
                if (request.term in cache) {
                    response(cache[request.term]);
                    return;
                } else {
                    jQuery.ajax({
                        type: "POST",
                        url: "/SearchWebService.asmx/GetSearchResult",
                        data: JSON.stringify(param),
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function (data) {
                            var obj = jQuery.parseJSON(data.d);
                            if (obj) {
                                values = Array();
                                type = Array();
                                for (var i = 0; i < obj.length; i++) {
                                    values.push(htmlDecode(obj[i].Result));
                                    type.push(obj[i].Type);
                                }
                                cache[request.term] = values;
                                response(values);
                            } else
                                response('');
                        },
                        error: function (result) {
                            alert(result.status + ' ' + result.statusText);
                        }
                    });
                }
            },
            minLength: 2,
            select: function (event, ui) {
                var selectedObj = ui.item;

                txtSearch1.val(selectedObj.label);
                jQuery('input[name="searchType"]').val(type[values.indexOf(selectedObj.value)]);
                jQuery('#btnSearch1').trigger('click');
                return false;
            }
        });
    }

    addthis.addEventListener('addthis.ready', setSocialSharePosition);

    jQuery(window).on("resize scroll", setSocialSharePosition);

});

function setSocialSharePosition() {
    var share_block = jQuery('#at4-share');
    if (!share_block.hasClass('is-show') && jQuery(window).scrollTop() >= 590) {
        share_block.addClass('is-show');
        share_block.animate({right:"0",left:"0"})
    }
    else if(!share_block.hasClass('is-show')){
        share_block.css({right:"100%",left:"-100px"})
    }
    if (share_block.hasClass('is-show')) {
        var top_block = jQuery('.title-block');
        var footer_block = jQuery('.site-footer');
        var share_block_show = jQuery('#at4-soc');

        share_block.css({position: "", top: "20%", bottom: "auto"});
        share_block_show.css({position: "", top: "20%", bottom: "auto"});

        if (top_block.offset().top + top_block.height() + 130 > share_block.offset().top) {
            share_block.css({position: "absolute", top: (top_block.offset().top + top_block.height() + 130) + "px", bottom: "auto"});
        }
        else if (share_block.offset().top + share_block.height() + 30 > footer_block.offset().top) {
            share_block.css({position: "absolute", top: (footer_block.offset().top - 30 - share_block.height()) + "px", bottom: "auto"});
        }
        else {
            share_block.css({position: "", top: "20%", bottom: "auto"});
        }

        if (top_block.offset().top + top_block.height() + 130 > share_block_show.offset().top) {
            share_block_show.css({position: "absolute", top: (top_block.offset().top + top_block.height() + 130) + "px", bottom: "auto"});
        }
        else if (share_block_show.offset().top + share_block_show.height() + 30 > footer_block.offset().top) {
            share_block_show.css({position: "absolute", top: (footer_block.offset().top - 30 - share_block_show.height()) + "px", bottom: "auto"});
        }
        else {
            share_block_show.css({position: "", top: "20%", bottom: "auto"});
        }
    }
}

