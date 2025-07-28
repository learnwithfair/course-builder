$(document).ready(function () {
    let moduleCount = 0;

    // Initialize Summernote
    $('#courseSummary').summernote({
        height: 200,
        placeholder: 'Write a detailed summary...',
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    // Add Module
    $('#addModule').click(function () {
        moduleCount++;
        let moduleHtml = `
        <div class="card module-block my-3 shadow-sm">
            <div class="card-header bg-light d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 text-primary fw-semibold">Module ${moduleCount}</h6>
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-outline-secondary toggle-module me-2" type="button" data-bs-toggle="collapse" data-bs-target="#moduleBody${moduleCount}" aria-expanded="true">
                        <i class="bi bi-chevron-up transition-transform"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-module" title="Remove Module">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            <div id="moduleBody${moduleCount}" class="collapse show card-body bg-white">
                <div class="mb-3">
                    <label class="form-label fw-medium">Module Title</label>
                    <input type="text" name="modules[${moduleCount}][title]" class="form-control" placeholder="Enter module title..." required>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="contents-wrapper mb-3">
                    <!-- Content items will be added here -->
                </div>
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary btn-sm addContent">
                        <i class="bi bi-plus-circle me-1"></i>Add Content
                    </button>
                </div>
            </div>
        </div>`;
        $('#modulesWrapper').append(moduleHtml);

        // Reinitialize collapse
        $('#modulesWrapper .collapse').each(function () {
            new bootstrap.Collapse(this, { toggle: false });
        });

        bindAddContentEvents();
    });

    // Remove Module
    $(document).on('click', '.remove-module', function () {
        if (confirm('Are you sure you want to remove this module? This action cannot be undone.')) {
            $(this).closest('.module-block').fadeOut(300, function () {
                $(this).remove();
                updateModuleNumbers();
            });
        }
    });

    // Update module numbers after removal
    function updateModuleNumbers() {
        $('.module-block').each(function (index) {
            let newModuleNumber = index + 1;
            $(this).find('.card-header h6').text(`Module ${newModuleNumber}`);
            // Update input names
            $(this).find('input, select, textarea').each(function () {
                let name = $(this).attr('name');
                if (name) {
                    let updatedName = name.replace(/modules\[\d+\]/, `modules[${newModuleNumber}]`);
                    $(this).attr('name', updatedName);
                }
            });
            // Update collapse targets
            let moduleBody = $(this).find('.collapse');
            let newId = `moduleBody${newModuleNumber}`;
            moduleBody.attr('id', newId);
            $(this).find('.toggle-module').attr('data-bs-target', `#${newId}`);
            // Update content collapse IDs
            $(this).find('.content-block').each(function (contentIndex) {
                let contentNumber = contentIndex + 1;
                let contentBody = $(this).find('.collapse');
                let newContentId = `contentBody${newModuleNumber}_${contentNumber}`;
                contentBody.attr('id', newContentId);
                $(this).find('.toggle-content').attr('data-bs-target', `#${newContentId}`);
                $(this).find('.card-header span').text(`Content ${contentNumber}`);
            });
        });
        moduleCount = $('.module-block').length;
    }

    // Add Content
    function bindAddContentEvents() {
        $('.addContent').off('click').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            let moduleBlock = $(this).closest('.module-block');
            let moduleNumber = moduleBlock.find('.card-header h6').text().match(/\d+/)[0];
            let contentsWrapper = moduleBlock.find('.contents-wrapper'); // FIXED

            let contentIndex = contentsWrapper.children('.content-block').length + 1;

            let contentHtml = `
            <div class="card my-2 content-block border-start border-primary border-3">
                <div class="card-header bg-light d-flex justify-content-between align-items-center py-2">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-play-circle text-primary me-2"></i>
                        <span class="fw-medium text-secondary">Content ${contentIndex}</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-secondary toggle-content me-2" type="button" data-bs-toggle="collapse" data-bs-target="#contentBody${moduleNumber}_${contentIndex}" aria-expanded="true">
                            <i class="bi bi-chevron-up transition-transform"></i>
                        </button>
                        <button type="button" class="btn btn-outline-danger btn-sm remove-content" title="Remove Content">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                <div id="contentBody${moduleNumber}_${contentIndex}" class="collapse show card-body bg-white">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Content Title</label>
                            <input type="text" name="modules[${moduleNumber}][contents][${contentIndex}][title]" class="form-control" placeholder="Enter content title..." required>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium">Video Source Type</label>
                            <select name="modules[${moduleNumber}][contents][${contentIndex}][video_source_type]" class="form-select">
                                <option value="">Select source type...</option>
                                <option value="youtube">YouTube</option>
                                <option value="vimeo">Vimeo</option>
                                <option value="upload">Upload</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-medium">Video URL</label>
                            <input type="url" name="modules[${moduleNumber}][contents][${contentIndex}][video_url]" class="form-control" placeholder="https://...">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-medium">Video Length</label>
                            <input type="text" name="modules[${moduleNumber}][contents][${contentIndex}][video_length]" class="form-control" placeholder="HH:MM:SS" pattern="^[0-9]{2}:[0-9]{2}:[0-9]{2}$">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>`;
            contentsWrapper.append(contentHtml);

            // Reinitialize collapse
            $('#modulesWrapper .collapse').each(function () {
                new bootstrap.Collapse(this, { toggle: false });
            });

            setTimeout(() => {
                $(`#contentBody${moduleNumber}_${contentIndex} input[name*="[title]"]`).focus();
            }, 100);
        });
    }

    // Remove Content
    $(document).on('click', '.remove-content', function () {
        if (confirm('Are you sure you want to remove this content?')) {
            let contentBlock = $(this).closest('.content-block');
            let moduleBlock = contentBlock.closest('.module-block');
            contentBlock.fadeOut(300, function () {
                $(this).remove();
                updateContentNumbers(moduleBlock);
            });
        }
    });

    // Update content numbers
    function updateContentNumbers(moduleBlock) {
        let moduleIndex = moduleBlock.index() + 1;
        moduleBlock.find('.content-block').each(function (index) {
            let newContentNumber = index + 1;
            $(this).find('.card-header span').text(`Content ${newContentNumber}`);
            $(this).find('input, select, textarea').each(function () {
                let name = $(this).attr('name');
                if (name) {
                    let updatedName = name.replace(/\[contents\]\[\d+\]/, `[contents][${newContentNumber}]`);
                    $(this).attr('name', updatedName);
                }
            });
            let contentBody = $(this).find('.collapse');
            let newId = `contentBody${moduleIndex}_${newContentNumber}`;
            contentBody.attr('id', newId);
            $(this).find('.toggle-content').attr('data-bs-target', `#${newId}`);
        });
    }

    // Icon toggle using Bootstrap events
    $(document).on('shown.bs.collapse hidden.bs.collapse', '.collapse', function () {
        let button = $(`[data-bs-target="#${this.id}"]`);
        let icon = button.find('i');
        if ($(this).hasClass('show')) {
            icon.removeClass('bi-chevron-down').addClass('bi-chevron-up');
        } else {
            icon.removeClass('bi-chevron-up').addClass('bi-chevron-down');
        }
    });

    // Collapse/Expand All
    $(document).on('click', '#collapseAll', function () {
        $('.module-block .collapse.show').collapse('hide');
    });
    $(document).on('click', '#expandAll', function () {
        $('.module-block .collapse:not(.show)').collapse('show');
    });

    // Initialize
    function initializeFirstModule() {
        if ($('.module-block').length === 0) {
            $('#addModule').trigger('click');
        }
    }



    // Enhanced AJAX Form Submit
    $('#courseForm').submit(function (e) {
        e.preventDefault();

        // Show loading state
        let submitBtn = $(this).find('button[type="submit"]');
        let originalText = submitBtn.text();
        submitBtn.prop('disabled', true).html('<i class="bi bi-hourglass-split me-1"></i>Saving...');

        let formData = new FormData(this);
        formData.set('summary', $('#courseSummary').summernote('code'));

        // Clear previous errors
        $('.invalid-feedback').text('');
        $('.form-control, .form-select').removeClass('is-invalid');

        $.ajax({
            url: storeCourseUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                Toast.fire({
                    icon: 'success',
                    title: res.message || 'Course saved successfully!',
                    timer: 3000
                });

                // Reset form
                $('#courseForm')[0].reset();
                $('#modulesWrapper').html('');
                $('#courseSummary').summernote('code', ''); // Properly clear Summernote
                moduleCount = 0;

                // Re-add first module after reset
                $('#addModule').trigger('click');
            },
            error: function (xhr) {
                if (xhr.status === 422 && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let firstError = ''; // will store the first error for the toast

                    Object.keys(errors).forEach(function (field, index) {
                        // Get the first error message
                        if (index === 0) firstError = errors[field][0];

                        // Handle nested field names (modules.1.contents.2.title)
                        let fieldName = field.replace(/\./g, '\\.').replace(/\[/g, '\\[').replace(/\]/g, '\\]');
                        let input = $(`[name="${fieldName}"]`);
                        if (input.length) {
                            input.addClass('is-invalid');
                            let feedback = input.siblings('.invalid-feedback');
                            if (feedback.length === 0) {
                                feedback = input.closest('div').find('.invalid-feedback');
                            }
                            feedback.text(errors[field][0]);
                        }
                    });

                    // Show first error in toast
                    Toast.fire({
                        icon: 'error',
                        title: firstError || 'Please fix the highlighted errors',
                        timer: 5000
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: xhr.responseJSON?.message || 'Something went wrong! Please try again.',
                        timer: 5000
                    });
                }
            },

            complete: function () {
                // Restore button state
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    initializeFirstModule();
    bindAddContentEvents();
});
