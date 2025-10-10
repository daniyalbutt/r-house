<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('front/js/script.js') }}?v={{ time() }}"></script>
<script src="{{ asset('admin/js/toastr.js') }}"></script>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script>
    $('.contactform').submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: "{{ csrf_token() }}",
            url: "{{ route('inquiry.submit') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                $('.contactform')[0].reset();
                if (response.status) {
                    toastrShow('Sumbitted', response.message)

                } else {
                    toastrShow('Cannot Submit', response.message)

                }
            }
        });
    })
</script>

<script>
    $('#newsletter-btn').click(function() {
        if ($('#newsletter_email').val().length > 0) {
            var requestData = {
                type: 'newsletter',
                email: $('#newsletter_email').val()
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('inquiry.submit') }}",
                type: "post",
                data: JSON.stringify(requestData),
                contentType: "application/json",
                dataType: "json",
                success: function(response) {

                    $('#newsletter_email').val('');
                    if (response.status == true) {
                        toastrShow('Sumbitted', response.message)

                    } else {
                        console.log(response.message);
                        toastrShow('Error', response.message, 'error')

                    }
                },
                error: function(response) {
                    console.log(response);

                    if (response.message) {
                        toastrShow('Error', response.message, 'error')
                    }
                }

            });
        } else {
            toastrShow('Error', 'Email should not be empty', 'error');
        }
    });
</script>

<script>
    @if (\Session::has('success'))
        $.toast({
            heading: 'Sumbitted',
            text: "{{ Session::get('success') }}",
            showHideTransition: 'slide',
            icon: 'success'
        })
    @endif
</script>
