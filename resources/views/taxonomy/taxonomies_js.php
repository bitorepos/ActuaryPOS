<script type="text/javascript">
    $(document).ready( function() {

        function getTaxonomiesIndexPage () {
            var data = {category_type : $('#category_type').val()};
            $.ajax({
                method: "GET",
                dataType: "html",
                url: '/taxonomies-ajax-index-page',
                data: data,
                async: false,
                success: function(result){
                    $('.taxonomy_body').html(result);
                }
            });
        }

        var treeExpanded = true;

        function initializeTaxonomyDataTable() {
            //Category table
            if ($('#category_table').length) {
                var category_type = $('#category_type').val();
                category_table = $('#category_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: false,
                    pageLength: -1,
                    lengthChange: false,
                    scrollX: true,
                    "ajax": {
                        "url": '/taxonomies?type=' + category_type,
                        "data": function(d) {
                        d.show_deleted = $('#show_deleted').is(':checked');
                    }},
                    columns: [
                        { data: 'name', name: 'categories.name' },
                        <?php if($cat_code_enabled): ?>
                            { data: 'short_code', name: 'categories.short_code' },
                        <?php endif; ?>
                        { data: 'description', name: 'categories.description' },
                        <?php if(request()->get('type') == 'product'): ?>
                            { data: 'product_count', name: 'product_count', orderable: false, searchable: false },
                        <?php endif; ?>
                        { data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    drawCallback: function() {
                        // Hide toggle icon for categories with no children
                        var $table = $('#category_table');
                        $table.find('.tree-toggle').each(function() {
                            var $row = $(this).closest('tr');
                            var catId = $row.data('category-id');
                            var hasChildren = $table.find('tr[data-parent-id="' + catId + '"]').length > 0;
                            if (!hasChildren) {
                                $(this).css('visibility', 'hidden');
                            }
                        });
                        // Restore collapse state
                        if (!treeExpanded) {
                            $table.find('tr.category-child-row').addClass('tree-collapsed');
                            $table.find('.tree-toggle').addClass('collapsed');
                        }
                    }
                });
            }
        }

        <?php if(empty(request()->get('type'))): ?>
            getTaxonomiesIndexPage();
        <?php endif; ?>

        initializeTaxonomyDataTable();

        $('.category_modal').on('shown.bs.modal', function() {
        $('select#select_fbr_hs_code').select2({
            ajax: {
                url: '/hs-codes',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function(data) {
                    return {
                        results: data,
                    };
                },
            },
            templateResult: function (data) { 
                return data.text;
            },
            minimumInputLength: 1,
            dropdownParent: $('.category_modal'),
            language: {
                noResults: function() {
                    return '<p>Not Found</p>';
                },
            },
            escapeMarkup: function(markup) {
                return markup; // allows HTML in results
            },
        });

        $('#select_fbr_hs_code').on('select2:select', function(e) {
                var data = e.params.data;
                $('.category_modal').find('#short_code').val(data.hs_code);
                $('.category_modal').find('#description').val(data.desc);
                $('.category_modal').find('#current_short_code').remove();
            });            
        });

        $('.category_modal').on('hidden.bs.modal', function() {
            $('#select_fbr_hs_code').select2('destroy');
        });

    });
    
    $(document).on('submit', 'form#category_add_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function(xhr) {
                __disable_submit_button(form.find('button[type="submit"]'));
            },
            success: function(result) {
                if (result.success === true) {
                    $('div.category_modal').modal('hide');
                    toastr.success(result.msg);
                    if(typeof category_table !== 'undefined') {
                        category_table.ajax.reload();
                    }

                    var evt = new CustomEvent("categoryAdded", {detail: result.data});
                    window.dispatchEvent(evt);

                    //event can be listened as
                    //window.addEventListener("categoryAdded", function(evt) {}
                } else {
                    if (result.is_duplicate === true) {
                        toastr.warning(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                }
            },
        });
    });
    
    $(document).on('click', 'button.edit_category_button', function() {
        $('div.category_modal').load($(this).data('href'), function() {
            $(this).modal('show');

            $('form#category_edit_form').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var data = form.serialize();

                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    dataType: 'json',
                    data: data,
                    beforeSend: function(xhr) {
                        __disable_submit_button(form.find('button[type="submit"]'));
                    },
                    success: function(result) {
                        if (result.success === true) {
                            $('div.category_modal').modal('hide');
                            toastr.success(result.msg);
                            category_table.ajax.reload();
                        } else {
                            if (result.is_duplicate === true) {
                                toastr.warning(result.msg);
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    },
                });
            });
        });
    });

    $(document).on('click', 'button.delete_category_button', function() {
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            category_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', 'button.restore_category_button', function() {
        swal({
            title: LANG.sure,
            icon: 'info',
            buttons: true,
        }).then(willRestore => {
            if (willRestore) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'GET',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            toastr.success(result.msg);
                            category_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    $(document).on('change', 'input#show_deleted', function(e) {
        category_table.ajax.reload();
    });

    $(document).on('click', 'button.check_uom', function(e) {
        e.preventDefault();
        var loader = __fa_awesome();
        var btn = $(this);
        var btn_html = $(this).html();
        btn.html(loader);  
        $.ajax({
            method: 'GET',
            url: $(this).attr('data-href'),
            dataType: 'html',
            success: function(result) {
                $('div.view_modal').html(result).modal('show');
                btn.html(btn_html);
            },
        });
    });

    $(document).on('click', 'a.load_hscodes', function(e) {
        e.preventDefault();
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).attr('href');
                window.location.href = href;

            }
        });
    });

    // Tree view: toggle individual parent category (cascading for 3 levels)
    function hideDescendants($table, parentId) {
        var $children = $table.find('tr[data-parent-id="' + parentId + '"]');
        $children.addClass('tree-collapsed');
        $children.each(function() {
            $(this).find('.tree-toggle').addClass('collapsed');
            hideDescendants($table, $(this).data('category-id'));
        });
    }

    $(document).on('click', '.tree-toggle', function(e) {
        e.stopPropagation();
        var $parentRow = $(this).closest('tr');
        var catId = $parentRow.data('category-id');
        var $table = $('#category_table');
        var isCollapsing = !$(this).hasClass('collapsed');

        $(this).toggleClass('collapsed');

        if (isCollapsing) {
            hideDescendants($table, catId);
        } else {
            // Expand: show only direct children
            $table.find('tr[data-parent-id="' + catId + '"]').removeClass('tree-collapsed');
        }
    });

    // Tree view: expand/collapse all
    $(document).on('click', '#toggle_all_categories', function() {
        var $table = $('#category_table');
        if (treeExpanded) {
            $table.find('tr.category-child-row').addClass('tree-collapsed');
            $table.find('.tree-toggle').addClass('collapsed');
            $(this).html('<i class="fa fa-expand"></i> ' + LANG.expand_all);
            treeExpanded = false;
        } else {
            $table.find('tr.category-child-row').removeClass('tree-collapsed');
            $table.find('.tree-toggle').removeClass('collapsed');
            $(this).html('<i class="fa fa-compress"></i> ' + LANG.collapse_all);
            treeExpanded = true;
        }
    });
</script>
