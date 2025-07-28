// Toggle Sidebar
const toggleSidebar = () => {
    document.querySelector('.main-sidebar').classList.toggle('open');
};

// Attach event listeners to sidebar toggle buttons
document.querySelectorAll('#sidebar-toggle, #sidebar-close').forEach(button => {
    button.addEventListener('click', toggleSidebar);
});



//jquery
$(document).ready(function () {
    $('.select2').select2();

    //alert auto hide
    setTimeout(function () {
        $('.alert').alert('close');
    }, 3000);

    //delete modal
    $(document).on('click', '.delete', function (e) {

        const modal = $('#delete');

        modal.find('form').attr('action', $(this).data('href'));

        modal.modal('show');
    });


});