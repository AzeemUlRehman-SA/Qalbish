<script>

    $('#orderRating').modal('show');
    $('#orderRating').css('display', 'block');

    // 1. Visualizing things on Hover - See next part for action on click
    $('#stars li').on('mouseover', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        $(this).parent().children('li.star').each(function (e) {
            if (e < onStar) {
                $(this).addClass('hover');
            } else {
                $(this).removeClass('hover');
            }
        });

    }).on('mouseout', function () {
        $(this).parent().children('li.star').each(function (e) {
            $(this).removeClass('hover');
        });
    });


    // 2. Action to perform on click

    $('#stars li').on('click', function () {
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');

        for (i = 0; i < stars.length; i++) {
            $(stars[i]).removeClass('selected');
        }

        for (i = 0; i < onStar; i++) {
            $(stars[i]).addClass('selected');
        }

        // JUST RESPONSE (Not needed)
        var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
        var selectedRating = $('#stars li.selected').last().data('type');

        if (selectedRating === 'time') {
            $('#rate_star_1').val(ratingValue);
        } else if (selectedRating === 'profession') {
            $('#rate_star_2').val(ratingValue);
        } else {
            $('#rate_star_3').val(ratingValue);
        }


        if ((parseInt($('#rate_star_1').val()) > 1) && (parseInt($('#rate_star_2').val()) > 1) && (parseInt($('#rate_star_3').val()) > 1)) {
            $('#disable-btn').removeAttr('disabled');
        }

    });

    function submitRatingForm(){

        let form    = $("#rating-form-in-modal");
        var request = $(form).serialize();

        $.ajax({
            type: "POST",
            url: "{{ route('ajax.order.staff.rating') }}",
            data: request,
            dataType: "json",
            cache: true,
            success: function (response) {
                if (response.status == "success") {

                    toastr['success']("Thanks for Rating.We Will Improve ourselves.");
                    window.location.reload();
                }
            },
            error: function () {
                toastr['error']("Something Went Wrong.");
            }
        });
    }


</script>
