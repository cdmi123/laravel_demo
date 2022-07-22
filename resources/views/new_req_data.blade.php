@foreach($user_data as $user_value)
<?php $follows_id = explode(',',$user_value->follow_id);?>
<div class="flex items-center justify-between py-3">
    <div class="flex flex-1 items-center space-x-4">
        <a href="profile.html">
            <img src="{{asset('assets/images/avatars/avatar-2.jpg')}}" class="bg-gray-200 rounded-full w-10 h-10">
        </a>
        <div class="flex flex-col">
            <span class="block capitalize font-semibold">{{$user_value->name}}</span>
            <span class="block capitalize text-sm"> Australia </span>
        </div>
    </div>
    <?php if(in_array(Session::get('user_id'), $follows_id)) { ?>
    <a href="javascript:void(0)" class="border border-gray-200 font-semibold px-4 py-1 rounded-full hover:text-white hover:border-pink-600 dark:border-gray-800 unfollow"style="background-color: pink; color: white;" data-id="{{$user_value->id}}"> Unfollow </a>

    <?php } else { ?>
    <a href="javascript:void(0)" class="border border-gray-200 font-semibold px-4 py-1 rounded-full hover:bg-pink-600 hover:text-white hover:border-pink-600 dark:border-gray-800 follow" data-id="{{$user_value->id}}"> Follow </a>
    <?php } ?>
</div>
@endforeach

<script type="text/javascript" src="{{url('js/jquery-3.6.0.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.follow').click(function(){

            var id = $(this).attr('data-id');

            $.ajax({
                type:'post',
                url:'/send_req',
                data: {
                         "_token": "{{ csrf_token() }}",
                         "id": id,
                },

                success:function(res)
                {
                    $('#follow_data').html(res);
                }

            })

        })
    });
     $(document).ready(function(){
        $('.unfollow').click(function(){

            var id = $(this).attr('data-id');

            $.ajax({
                type:'post',
                url:'/unfollow_req',
                data: {
                         "_token": "{{ csrf_token() }}",
                         "id": id,
                },

                success:function(res)
                {
                    $('#follow_data').html(res);
                }

            })

        })
    })
</script>