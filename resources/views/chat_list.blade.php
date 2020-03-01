<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--INICIO dos links para API--> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--FIM dos links para API--> 
<title>Chat Room</title>
</head>
<body style="background-color:gray">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">E-Rural / Streaming e Chat | </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('welcome')}}">Inicio</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('chat_list')}}">Listas de Chats</a>
      </li>
    </ul>
  </div>
  <form action="{{route('set_username')}}" method="post" autocomplete="off" enctype="multipart/form-data">
  @csrf
  @if (isset($user_name))
                  Seu nome atual é:  &nbsp&nbsp<b> {{ $user_name}}</b> &nbsp&nbsp&nbsp| <button type="submit" class="btn btn-primary float-right">Mudar</button>
                   <input type="text"  style="width:40%" class="form-control float-right" placeholder="Mudar Nome" id="name" name="user_name">   
                  @else
                 <input type="text" class="form-control" placeholder="Entrar Como? " id="name" name="user_name" required>  <button type="submit" class="btn btn-primary float-right">Enviar </button>
                  
  @endif
</nav>

@if(isset($e))
<h4> {{$e}}</h4>
<h3 style="border: 5px solid red;border-style: solid; border-radius: 25px;width: 55%;margin-left: 25px">  ERROR: Entre com um nome no canto superior direito para comentar!</h3>
@endif

<div class="container float-left" style="background-color: white;margin-top: 20px;margin-left: 25px;border-radius: 2%">
            <table class="table">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Descrição</th>
                  
                </tr>
                @foreach($chats as $value)
                  <tr>
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>                                         
                    <td><a onclick="inputRequired()" href="{{ route('chat_room2', $value->id) }}" class="btn btn-success">Entrar</a></td>
                  </tr>
                @endforeach
              </table>
</form>
</body>
</html>
