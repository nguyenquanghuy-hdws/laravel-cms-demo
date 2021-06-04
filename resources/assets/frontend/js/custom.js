$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
$('.crm_get-voucher-code').on('click', function(e) {
    e.preventDefault();
    url = $(this).data('url');
    target = $(this).data('target');
    $.ajax({
        type: "POST",
        url: url,
        data: { 'voucher': { target } },
    }).done(function(response) {
        tata.success(response.title, response.message);
        console.log(response);
    }).fail(function(xhr) {
        // console.log(xhr.responseJSON);
        console.log(xhr);
    })
})
