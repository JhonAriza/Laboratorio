@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1 type="button" class="btn btn-dark">ROOM-911</h1>
        </div>
    </div>

    <h4 class="text-center">administrador menu</h4>



    <!-- Button trigger modal -->
    <div class="container">



        <div class="container">
            <form class="form-inline" action="" method="GET">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <input name="id" class="form-control" placeholder="Buscar por id">

                    </div>
                    <div class="col-3">
                        <input name="first_name" class="form-control" placeholder="Buscar por first_name">
                    </div>
                    <div class="col-3">
                        <select class="form-select" name="department_id">
                            <option selected>buscar por Departamento</option>
                            <option value="1">department1</option>
                            <option value="2">department2</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-success mt-3 mb-2" type="submit">Buscar</button>
                </div>
            </form>

        </div>
        <div class="row">
            <div class="col-8"></div>
            <div class="col-2">
                <button type="button"action="{{ url('downloadPDF') }}"  class="btn btn-warning ">
                    DescargarPDF
                </button>
                
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary " class="" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    create employee
                </button>
                
            </div>
        </div>

        <!-- Modal crear-->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="container">
                        <div class="row">
                            <h1 type="button" class="btn btn-dark">EDITAR </h1>
                        </div>
                    </div>

                    <div class="modal-body">
                        <form action="store-user" method="POST">
                            @csrf

                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="exampleInputEmail1" class="form-label">employe_id</label>
                                    <div class="input-group">
                                        <span class="input-group-text"></span>
                                        <input type="text" placeholder="employe_id" name="employe_id"
                                            class="form-control " />
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <label for="exampleInputEmail1" class="form-label">first_name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"></span>
                                        <input type="text" placeholder="first_name" name="first_name"
                                            class="form-control " />
                                    </div>
                                </div>
                            </div>



                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">last_name</label>
                                <input class="form-control" placeholder="last_name" name="last_name">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input class="form-control" placeholder="email" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">password</label>
                                <input class="form-control" name="password" placeholder="password" type="password">
                            </div>

                            <div class="row row-sm">
                                <div class="col-lg">
                                    <label for="exampleInputEmail1" class="form-label">employe_id</label>
                                    <div class="input-group">
                                        <span class="input-group-text"></span>
                                        <select class="form-select" name="roles">
                                            <option selected disabled>Seleccione</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg">
                                    <label for="exampleInputEmail1" class="form-label">first_name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"></span>
                                        <select class="form-select" name="departments">
                                            <option selected disabled>Seleccione</option>
                                            @foreach ($departments as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>


                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">save</button>
                        </form>



                        <div class="modal-footer">

                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table  class="table table-striped table-hover card-table table-vcenter text-nowrap">
                        @if ($users->count())
                            <thead class="bg-gray-50">
                                <tr>
                                    <th>
                                        employeeId
                                    </th>

                                    <th>
                                        firstname
                                    </th>
                                    <th>
                                        lastname
                                    </th>
                                    <th>
                                        departamento
                                    </th>
                                    <th>
                                        total access
                                    </th>
                                    <th>
                                        actions
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($users as $item)
                                <tbody>
                                    <tr>
                                        <td>
                                            <div>{{ $item['employe_id'] }} </div>
                                        </td>

                                        <td>
                                            <div>{{ $item['first_name'] }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item['last_name'] }}</div>
                                        </td>
                                        <td> {{ $item['department_id'] }} </td>


                                        <td>


                                            <a data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                                                
                                                 {{ $item['total'][0]['total_acces']}} <br>

 {{--    fechas 
                                                  @foreach ($item['total'][0]['date'] as $item)
                                                
                                                     {{$item['total']}} <br>
                                               
                                                   
                                                 @endforeach --}}
                                                 </a> 
                                        </td> 



                            <td class="d-flex">
                                <a href="update-user/{{ $item['id'] }}">
                                    <button type="button" class="btn btn-primary">Editar</button>
                                </a>
                                <form action="delete-user" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item['id'] }}">
                                    <button type="submit" class="btn btn-danger">eliminar</button>
                                </form>
                            <td>
                                </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
