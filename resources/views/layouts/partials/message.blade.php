 @if (Session::has('success'))
     <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert">
             <i class="fa fa-times"></i>
         </button>
         <strong>Success !</strong> {{ session('success') }}
     </div>
 @endif
 @if ($errors->any())
     <div class="alert alert-danger alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert">
             <i class="fa fa-times"></i>
         </button>
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif
