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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!--FIM dos links para API--> 
<title>Welcome / Room Chats</title>
</head>
<body style=" background-image: url('img/back.jpeg');
              background-repeat: no-repeat;
              background-attachment: fixed;
              background-size: 100% 100%;">
<?php set_time_limit ( 0 ); ?>
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
@if (isset($wrong_name))
<input type="hidden" value="{{$wrong_name}}" id="null">
<script>if (document.getElementById('null').value == 'true'){
  Swal.fire({
  title: 'Sala Não Encontrada!',
  text: 'Verifique o nome da sala novamente',
  icon: 'error',
  confirmButtonText: 'Ok'
})
}</script>
@endif

@if (isset($owner))
<input type="hidden" value="{{$owner}}" id="owner">
<script>if (document.getElementById('owner').value == 'false'){
  Swal.fire({
  title: 'Senha Incorreta',
  text: 'Verifique a senha novamente',
  icon: 'error',
  confirmButtonText: 'Ok'
})
}</script>
@endif
<form action="{{route('store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<div class="conteiner" style="opacity: 0.8;margin-top: 15px;background-color: White;padding:25px">
        <div class='row'>
        <div class="col-sm" style="background-color: White; border: 5px solid red;border-style: solid; border-radius: 25px; padding:15px">
            <h1 style='text-align: center;'>Termos de Serviço</h1>
            <hr>
            <p>Não faça uso indevido de nossos Serviços. Por exemplo, não interfira com nossos Serviços nem tente acessá-los por um método diferente da interface
             e das instruções que fornecemos. Você pode usar nossos serviços somente conforme permitido por lei, inclusive leis e regulamentos de controle de
              exportação e reexportação. Podemos suspender ou deixar de fornecer nossos Serviços se você descumprir nossos termos ou políticas ou se estivermos
               investigando casos de suspeita de má conduta.<br><br>

            O uso de nossos Serviços não lhe confere a propriedade sobre direitos de propriedade intelectual sobre os nossos Serviços ou sobre o conteúdo que 
            você acessar. Você não pode usar conteúdos de nossos Serviços a menos que obtenha permissão do proprietário de tais conteúdos ou que o faça por algum
             meio permitido por lei. Estes termos não conferem a você o direito de usar quaisquer marcas ou logotipos utilizados em nossos Serviços. Não remova,
              oculte ou altere quaisquer avisos legais exibidos em ou junto a nossos Serviços.<br><br>
              Lendo isso você concorda com os nossos termos de serviços
              </p>
        </div>
        
        <div class="col-sm"  style="background-color: White; border: 5px solid green;border-style: solid; border-radius: 25px;margin-left:15px">
            <h1 style='text-align: center;'>Criar uma Sala</h1>
            <hr>
            <label>Nome da Sala</label>
            <input type="text" class="form-control" name="room_name" placeholder="Ex: TV-Animações" aria-label="Username" aria-describedby="basic-addon1" required>
            <label>Descrição</label>
            <input type="text" class="form-control" name="description"placeholder="Ex: Canal focado em streaming de animes" aria-label="Username" aria-describedby="basic-addon1" required>
            <br>
            <label>Senha</label>
            <input type="password" name="password" class="form-control" placeholder="Ex: Matheus" aria-label="Username" aria-describedby="basic-addon1" required>
            <p>PS: Use essa senha caso queira entrar para sua sala em "Entrar em uma Sala", NÃO SE ESQUEÇA DA SUA SENHA!</p>
<br>
            <button type="submit" class="btn btn-success float-right">Criar Sala</button>
        </div>
    </form>
    
        <div class="col-sm" style="background-color: White; border: 5px solid blue;border-style: solid; border-radius: 25px;margin-left:15px">
        <form action="{{route('chatting_room')}}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
            <h1 style='text-align: center;'>Entrar em uma Sala</h1>
            <hr>
            <label>Nome da Sala</label>
            <input type="text" name="name_room" class="form-control" placeholder="Ex: TV-Animações" aria-label="Username" aria-describedby="basic-addon1" required>
            <label>Seu nome</label>
            <input type="text" name="username" class="form-control" placeholder="Ex: Lucas" aria-label="Username" aria-describedby="basic-addon1" required> 
            <br>
            <label>Senha</label>
            <input type="password" name="password" class="form-control" placeholder="Senha" aria-label="password" aria-describedby="basic-addon1" >
            <p>PS: Caso a sala seja sua, use a sua senha!</p>
<br>
            <button type="submit" class="btn btn-primary float-right">Procurar</button>
        </form>
        </div>
        </div>
        </div> 
  
</div>
<footer id="sticky-footer" class="py-4 bg-dark text-white-50" style="flex-shrink: none;background: black">
    <div class="container text-center">
      <a href="https://github.com/AlexmarJr/Chat_Test" style="color: white">Git Hub Code</a>
    </div>
  </footer>
</body>

</html>