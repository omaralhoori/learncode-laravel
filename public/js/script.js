$(function () {
    $('.videos .video a').on('click', function () {
        let link = $(this).attr('href')
        $('.modal div .modal-content .modal-body iframe').attr('src', link)

    })
})
