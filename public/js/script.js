$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('ul.menu-content a').each()

    $("li.nav-item a").each(function(index) {
        // console.log(index + ": " + $(this).text());
        if (window.location.href === $(this).attr('href')) {
            $(this).parent().addClass('active hhhh');
        }
    });

    window.addEventListener("scroll", function(event) {
        if (this.scrollY > 10) {
            $('nav.navbar').addClass('nav-scroll-top')
        } else {
            $('nav.navbar').removeClass('nav-scroll-top')
        }
    }, false);

    $('.bootstrap-tagsinput input').on('keypress', function(e) {
        if (e.keyCode == 13) {
            e.keyCode = 188;
            e.preventDefault();
        };
    });

    $(document).on('click', '.icon-rotate-cw', function() {
        $(this).parents('.card').find('input').val('')
        $(this).parents('.card').find('select option[value=""]').prop('selected', true)

        var table = $('.data-list-view').DataTable();
        if (table) table.draw();

    })

    $('input[type="date"]').on("change", function() {
        this.setAttribute(
            "data-date",
            moment(this.value, "YYYY-MM-DD")
            .format(this.getAttribute("data-date-format"))
        )
    }).trigger("change")


    $(document).on('submit', '.ajaxForm', function(e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let data = $(this).serialize();
        let this_ = $(this);

        var btnHtml = this_.find('button[type="submit"]').html();

        $.ajax({
            url: url,
            type: type,
            url: url,
            data: data,
            beforeSend: function() {
                $('.help-block').text('');
                this_.find('button[type="submit"]').html('<i class="fas fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                console.info(response);

                if (response.status == 'success') {
                    this_.find('button[type="submit"]').html('<i class="fas fa-check"></i>');
                    this_.find('button[type="submit"]').addClass('btn-success');
                }

                if (response.status == 'error') {
                    this_.find('button[type="submit"]').html('<i class="fas fa-refresh"></i>');
                    this_.find('button[type="submit"]').addClass('btn-danger');
                }

                messageToast(response.title, response.message, response.status, 5000)

                if (response.autoRedirect && response.autoRedirect !== '') {
                    window.location.href = response.autoRedirect
                }

                if (response.dataLoad && response.dataLoad !== '' && $('#load-data-ajax').length > 0) {
                    $('#load-data-ajax').html(response.dataLoad)
                }

                if (response.dataLoad2 && response.dataLoad2 !== '' && $('#load-data-2-ajax').length > 0) {
                    $('#load-data-2-ajax').html(response.dataLoad2)
                }

                if (response.fullname && response.fullname !== '' && $('.load-fullname').length > 0) {
                    $('.load-fullname').html(response.fullname)
                }

                if (response.avatar && response.avatar !== '' && $('.load-avatar').length > 0) {
                    $('.load-avatar').attr('src', response.avatar)
                }

                var item = $('#item_id');
                if (item.length) {
                    var itemid = item.val();
                }


                var dataTable = $('table.data-list-view');
                if (dataTable.length > 0 && response.rowInsert) {
                    var dt = dataTable.DataTable();
                    dt.row.add(
                        response.rowInsert
                    ).draw(false);
                }

            },
            error: function(request, status, error) {
                // this_.find('button[type="submit"]').html(' <i class="fa fa-times"></i> تلاش دوباره');
                this_.find('button[type="submit"]').html('<i class="fas fa-refresh"></i>');
                json = $.parseJSON(request.responseText);

                $.each(json.errors, function(key, value) {
                    $('.error-' + key).text(value);
                });
                messageToast('', 'Fix the errors.', 'error', 5000)

            }



        })

        sleep(500).then(() => {
            // Do something after the sleep!
            this_.find('button[type="submit"]').html(btnHtml)
        });
    });

    $(document).on('submit', '.ajaxUpload', function(e) {
        e.preventDefault();


        var form_data = new FormData(this);

        if ($('.file-upload').length > 0) {

            var imageUrl = $('.file-upload').prop('files')[0];

            if (document.getElementsByClassName("file-upload").value != "") {
                form_data.append('imageUrl', imageUrl);
            }
        }


        let url = $(this).attr('action');
        let type = $(this).attr('method');
        let data = $(this).serialize();
        let this_ = $(this);

        $.ajax({
            type: type,
            url: url,
            data: form_data, //$(this).serialize(),
            processData: false,
            async: false,
            contentType: false,
            beforeSend: function() {
                $('.help-block').text('');
                this_.find('button[type="submit"] i').removeClass().addClass('fa fa-spinner fa-spin');
            },
            success: function(response) {
                //////
                if (response.status == 'success')
                    this_.find('button[type="submit"] i').removeClass().addClass('fa fa-check');

                if (response.status == 'error')
                    this_.find('button[type="submit"] i').removeClass().addClass('fa fa-refresh');

                messageToast(response.title, response.message, response.status, 5000)

                if (response.autoRedirect && response.autoRedirect !== '') {
                    window.location.href = response.autoRedirect
                }

                if (response.dataLoad && response.dataLoad !== '' && $('#load-data-ajax').length > 0) {
                    $('#load-data-ajax').html(response.dataLoad)
                }

                if (response.dataLoad2 && response.dataLoad2 !== '' && $('#load-data-2-ajax').length > 0) {
                    $('#load-data-2-ajax').html(response.dataLoad2)
                }

                if (response.fullname && response.fullname !== '' && $('.load-fullname').length > 0) {
                    $('.load-fullname').html(response.fullname)
                }

                if (response.avatar && response.avatar !== '' && $('.load-avatar').length > 0) {
                    $('.load-avatar').attr('src', response.avatar)
                }

                var item = $('#item_id');
                if (item.length) {
                    var itemid = item.val();
                }


                var dataTable = $('table.data-list-view');
                if (dataTable.length > 0 && response.rowInsert) {
                    var dt = dataTable.DataTable();
                    dt.row.add(
                        response.rowInsert
                    ).draw(false);
                }
            },
            error: function(request, status, error) {
                this_.find('button[type="submit"] i').removeClass().addClass('fa fa-refresh');
                json = $.parseJSON(request.responseText);

                $.each(json.errors, function(key, value) {
                    console.log(key + ": " + value);
                    $('.error-' + key).text(value);
                });

            }
        });

    });


})

if ($('.dropify').length > 0) {


    $('.dropify').dropify({
        messages: {
            'default': 'کلیک کنید یا بکشید و رها کنید ',
            'replace': 'کلیک کنید یا بکشید و رها کنید',
            'remove': 'حذف فایل',
            'error': 'اوپس، خظاهای پیش آمده را رفع نمایید.'
        },
        error: {
            'fileSize': 'The file size is too big ({{ value }} max).',
            'minWidth': 'The image width is too small ({{ value }}}px min).',
            'maxWidth': 'The image width is too big ({{ value }}}px max).',
            'minHeight': 'The image height is too small ({{ value }}}px min).',
            'maxHeight': 'The image height is too big ({{ value }}px max).',
            'imageFormat': 'The image format is not allowed ({{ value }} only).'
        },
        tpl: {
            wrap: '<div class="dropify-wrapper"></div>',
            loader: '<div class="dropify-loader"></div>',
            message: '<div class="dropify-message"><span class="file-icon" /> <p>{{ default }}</p></div>',
            preview: '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
            filename: '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
            clearButton: '<button type="button" class="dropify-clear">{{ remove }}</button>',
            errorLine: '<p class="dropify-error">{{ error }}</p>',
            errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
        }
    });
}

function messageToast(title, message, status, timeOut = 5000) {
    if (status === 'success') {
        toastr.success(message, title, { "timeOut": timeOut, "closeButton": true, positionClass: 'toast-top-left' })
    } else if (status === 'warning') {
        toastr.warning(message, title, { "timeOut": timeOut, "closeButton": true, positionClass: 'toast-top-left' })
    } else if (status === 'error') {
        toastr.error(message, title, { "timeOut": timeOut, "closeButton": true, positionClass: 'toast-top-left' })
    } else if (status === 'info') {
        toastr.info(message, title, { "timeOut": timeOut, "closeButton": true, positionClass: 'toast-top-left' })
    }
}

function deleteRow(url, id) {
    $.ajax({
        url: url,
        method: 'post',
        method: 'DELETE',
        data: { ajax: 'true', _method: 'delete' },
        success: function(response) {
            console.log(response)
            $('tr[row="' + id + '"]').remove();

            if ($('#item-row-' + id).length > 0) {
                $('#item-row-' + id).css({ display: 'none' });
                $('#item-row-' + id).remove();
            }

            messageToast(response.title, response.message, response.status, 5000)
        },
        error: function(request, status, error) {
            console.log(request);
            // console.log(request.responseText);
        }
    })
    $(this).closest('td').parent('tr').fadeOut();
}

function changeStatus(url, this_) {
    $.ajax({
        url: url,
        method: 'post',
        method: 'post',
        data: { ajax: 'true', status: $(this_).is(':checked') },
        success: function(response) {
            console.log(response)
            messageToast(response.title, response.message, response.status, 5000)
        },
        error: function(request, status, error) {}
    })
}

function LoadCategories(url, col, name, _this_) {

    for (var i = col; i <= 5; i++) {
        $(".load-categories[col='" + i + "']").html('')
        $(".breadcrumb-categories [col='" + i + "']").text('')
    }
    if ($(_this_).is(':checked')) {

        $.ajax({
            url: url,
            method: 'get',
            data: { ajax: 'true' },
            success: function(response) {
                $(".load-categories[col='" + col + "']").html(response)
                $(".breadcrumb-categories [col='" + Number(col - 1) + "']").text(name);
            },
            error: function(request, status, error) {}
        })
    }
}

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}