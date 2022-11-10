 @extends('layouts.app')
 @section('content')

 <div class="container">
    <div class="row">
        <h1 type="button" class="btn btn-dark">EDITAR </h1>
    </div>
</div>
     <div class="container">
         <div class="row">
          
             <div class="col-md-12">
                 <form method="POST" action="{{ url('actualizar-usuario/'.$user->id) }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">



                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">employe_id</label>
                         <div class="input-group">
                          <span class="input-group-text"></span>
                         <input type="employe_id" class="form-control" name="employe_id" value="{{ $user->employe_id }}">
                        </div>
                     </div>


                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">first_name</label>
                         <div class="input-group">
                            <span class="input-group-text"></span>
                         <input type="first_name" class="form-control" name="first_name" value="{{ $user->first_name }}">
                         </div>
                     </div>

                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">last_name</label>
                         <div class="input-group">
                            <span class="input-group-text"></span>
                         <input type="last_name" class="form-control" name="last_name" value="{{ $user->last_name }}">
                         </div>
                     </div>

                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">email</label>
                         <div class="input-group">
                            <span class="input-group-text"></span>
                         <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                         </div>
                     </div>


                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">roles </label>
                         <div class="input-group">
                            <span class="input-group-text"></span>

                         <select class="form-select" required name="roles">
                             <option disabled>seleccione</option>
                             @foreach ($roles as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                             @endforeach
                         </select>
                         </div>
                     </div>


                     <div class="mb-3">
                         <label for="exampleInputEmail1" class="form-label">depar tment_id</label>
                         <div class="input-group">
                            <span class="input-group-text"></span>
                         <select class="form-select" required  name="departments">
                             <option disabled>seleccione</option>
                             @foreach ($departments as $item)
                                 <option value="{{ $item->id }}">{{ $item->name }}</option>
                             @endforeach
                         </select>
                         </div>
                     </div>


                     <div class="mb-3">
                         <label for="exampleInputPassword1" class="form-label">Password</label>
                         <div class="input-group">
                            <span class="input-group-text"></span>
                         <input type="password" class="form-control" name="password" value="{{ $user->password }}">
                     </div>
                     </div>
                     <button type="submit" class="btn btn-primary">Actualizar</button>
                 </form>
             </div>
         </div>
     </div>
 @endsection
