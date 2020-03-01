<!DOCTYPE html>
<html>
<head>
<!-- <meta http-equiv="refresh" content="5" > -->
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
</nav>
<form action="{{route('storeComment')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<input type="hidden" name="user_name" value="{{$user_name}}"> 
<input type="hidden" name="channel" value="{{$head->id}}">
<div class='row' style="max-height: 10px">
        <div class="col-sm" style="background-color: White; border: 5px solid black;border-style: solid; border-radius: 25px; padding:15px;margin-left:15px">
        <h2>Canal: {{$head->name}}</h2>
        <hr style="border: 1px solid black">
          <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY?playlist=tgbNymZ7vqY&loop=1" allowfullscreen></iframe>
          </div>
          <hr style="border: 1px solid black">
          <h3>Descrição do Canal</h3>
          <p>{{$head->description}}</p>
        </div>
        
        <div class="col-sm"  style=";max-height:90vh;background-color: White; border: 5px solid green;border-style: solid; border-radius: 25px;margin-left:15px;margin-right:15px;overflow:auto;">
          <div class="container float-left" id="commentScroll" style="border-radius: 25px;border: 1px solid black;height:80%;width:75%;overflow:auto;">
          @foreach($head_comment as $value)
                  <p style="word-wrap: break-word;border: 1px solid;
                            margin: 10px 0px;
                            padding:15px 20px 15px 55px;
                            width: 580px;	
                            font: bold 12px verdana;
                            -moz-box-shadow: 0 0 5px #888;
                            -webkit-box-shadow: 0 0 5px#888;
                            box-shadow: 0 0 5px #888;
                            text-shadow: 2px 2px 2px #ccc;
                            -webkit-border-radius: 15px;
                            -moz-border-radius: 15px;
                            border-radius: 15px;">{{$value->comment}} <b class="float-right">| {{$value->user_name}} | <br>Enviado {{ \Carbon\Carbon::createFromTimeStamp(strtotime($value->created_at)) }} UTC <br></b> </p> @if($owner == 'true') <td><a style="position: relative;
                                                                                                                                                                                                                                                                  bottom: 45px;
                                                                                                                                                                                                                                                                  left: 13px;
                                                                                                                                                                                                                                                                  color: red;
                                                                                                                                                                                                                                                                  border: 1px solid red" 
                                                                                                                                                                                                                                                                  href="{{ route('delete', $value->id) }}" title="Excluir">X</a> @endif
                            
                            
                           
                            
            @endforeach
          </div>
          
          <div class="container float-right" style="max-height:90vh;border-radius: 25px;border: 1px solid black;height:100%;width:24%;margin-left:5px;overflow:auto;">
          <p>Usuarios do Canal</p>
          <hr>
          @foreach($user_comment as $attr)
                  <p> <img style="width:20%"src="{{URL::asset('img/avatar.png')}}"> {{$attr->user_name}} </p>
          @endforeach
        
          </div>
          <textarea class="form-control" name="comment" rows="2" style="width:60%;border-radius: 25px;border: 1px solid black" required></textarea>
          <button type="submit" class="btn btn-primary float-right" style="position: relative;
                    top: -50px;
                    left: -50px;">Enviar</button>
          
        </div>
</div>
</form>

</body>
<script>
$("#commentScroll").scrollTop($("#commentScroll")[0].scrollHeight);
</script>
</html>