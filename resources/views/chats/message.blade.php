@extends('layouts.app')

@section('content')
    <div id="particles-js" class="position-fixed w-100 h-100" style="right: 0; top: 0;z-index: -1"></div>

    <section class="container-fluid my-5">
        <div class="container  py-3">
            <h1 class="title">الدردشات</h1>

            <div class="shadow bg-white p-3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-wrapper">
                            <ul class="users list-group">

                            </ul>
                        </div>
                    </div>

                    <div class="col-md-8" id="messages">
                        <h3 class="d-flex justify-content-center h-50 align-items-end text-black-50">لا يوجد اي رسائل
                            حاليا</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="{{ asset('js/particles.js') }}"></script>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>


    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            Pusher.logToConsole = true;
            var pusher = new Pusher('61625ffa36d247df584b', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                if (my_id == data.message.from) {
                    $('#' + data.message.to).click();
                } else if (my_id == data.message.to) {
                    if (receiver_id == data.message.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.message.from).click();
                    } else {
                        $('#' + data.message.from).append('<span class="pending"></span>');
                    }
                }
            });

            $('.user').click(function () {
                $('.user').removeClass('active');
                $(this).addClass('active');
                $(this).find('.pending').remove();
                receiver_id = $(this).attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    },
                    error: function (data) {
                        alert(JSON.stringify(data));
                    }

                });
            });

            function getMessages(Salon) {
                var salonli = $('li[data-salon="salon' + Salon + '"]');
                salonli.addClass('active');
                salonli.find('.pending').remove();
                receiver_id = salonli.attr('id');
                $.ajax({
                    type: "get",
                    url: "message/" + receiver_id, // need to create this route
                    data: "",
                    cache: false,
                    success: function (data) {
                        $('#messages').html(data);
                        scrollToBottomFunc();
                    },

                });
            }

            @if(request()->has('salon'))
            getMessages({{request()->get('salon')}});
            @endif

            $(document).on('keyup', 'input[name="sendMassage"]', function (e) {
                var message = $(this).val();
                if (e.keyCode == 13 && message != '' && receiver_id != '') {
                    sendMassage(message);
                    $(this).val('');
                }
            });


            function sendMassage(message) {
                $(this).val(''); // while pressed enter text box will be empty
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                $.ajax({
                    type: "post",
                    url: "message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                })
            }
        });


        // make a function to scroll down auto
        function scrollToBottomFunc() {
            $('.message-wrapper').animate({
                scrollTop: $('.message-wrapper').get(0).scrollHeight
            }, 50);
        }
    </script>
@endpush
