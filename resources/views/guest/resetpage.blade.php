 @extends('layout.layout')
 @section('title', 'Reset Page')

 @section('content')

     <div class="row my-5">
         <div class="col-sm-4"></div>
         <div class="col-sm-4 text-center">
             <h4 class="my-3 text-secondary">Password Reset</h4>
             <form action="{{ route('reset.password', [$user_id, $token]) }}" method="post">
                 @csrf
                 <input type="password" name="password"
                     class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                     placeholder="@error('password') {{ $message }} @else Password @enderror">
                 <input type="password" name="password_confirmation"
                     class="form-control my-2 shadow-none @error('password') border-danger @enderror" id=""
                     placeholder="@error('password') {{ $message }} @else Confirm Password @enderror">


                 <input class="btn btn-primary btn-sm shadow-none" type="submit" value="Submit">
             </form>
             @if (session('msg-9'))
                 <p class="text-secondary text-center my-3">Check your email for a link to reset your password</p>
             @endif
             @if (session('msg-10'))
                 <p class="text-danger text-center my-3">User does not exist</p>
             @endif
         </div>

         <div class="col-sm-4"></div>
     </div>
 @endsection
