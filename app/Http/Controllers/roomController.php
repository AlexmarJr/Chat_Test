<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use App\Comment;
use DB;
use App\Quotation;


class roomController extends Controller
{
    public function store(Request $request)
    {
        try{
            $id = $request->get('id', false);
            $att_room['name']=$request->room_name;
            $att_room['password']=$request->password;
            $att_room['description']=$request->description;
                
            Room::create($att_room);
            return redirect()->route('welcome')->withSuccess('Sala criada com Sucesso!');
        }
        catch (\Exception $e) {
            return redirect()->route('welcome')->withErrors($e->getMessage());
        }
    }

    public function storeComment(Request $request)
    {
        try{
            $id = $request->get('id', false);
            $id_channel = $request->channel;
            $att['user_name']=$request->user_name;
            $att['channel']=$request->channel;
            $att['comment']=$request->comment;
            
            Comment::create($att);
            return redirect()->route('chat_room2', ['id'=>$id_channel]);
        }
        catch (\Exception $e) {
            return redirect()->route('welcome')->withErrors($e->getMessage());
        }
    }

    public function delete(Request $request, $id){  //Deleta Mensagem
        try{
        $head = Comment::find($id);
        $head->delete();
        $id_channel = $request->session()->get('id_room');
        return redirect()->route('chat_room2',  ['id'=>$id_channel]);
        }
        catch (\Exception $e) {
            return redirect()->route('welcome');
        }
    }


    /*public function storeCommentReturn(Request $request) // Função redundante
    {
        $owner = $request->session()->get('owner');
        $name_room = $request->session()->get('name_room');

        $user_name = $request->session()->get('user_name');
        $head = DB::table('room')->where('name','=',$name_room)->get();
        return redirect()->route('chat_room2',['id'=>$head->id]);
        //return view('chat_room', compact('owner','head','user_name','name_room'));
    } */

    public function retuning_chat_room(Request $request){
        $owner = '';
        $is_null = '';
        $null_pass = '';

        $name = $request->get('name_room');
        $user_name = $request->get('username');
        $password = $request->get('password');
        $password_verify = DB::table('room')->where('name','=',$name)->get('password');
        $name_verify = DB::table('room')->where('name','=',$name)->first('name');
        $chats = DB::table('room')->where('name','=',$name)->get();

        //Verificar se o usuario digitou uma senha
        if ($request->get('password') == ''){
            $null_pass = 'true';
        }
        else{
            $null_pass = 'false';
        }

        //Verificar se o nome da sala existe
        if($name_verify == null){
            $wrong_name = 'true';
            return view('welcome', compact('wrong_name'));
        }
        
       
        //Verificar se o usuario é o dono da pagina ou não
            foreach ($password_verify as $value){
            
                if ($value->password == $password) {
                    $owner = 'true';
            }  
            else{
                $owner = 'false';
                if($null_pass == 'false'){
                    return view('welcome', compact('owner'));
                }
            } 
        }
            
        
       
        $request->session()->put('name_room',$name);
        $request->session()->put('owner',$owner);
        $request->session()->put('head',$chats);
        $request->session()->put('null_pass',$null_pass);
        $request->session()->put('user_name',$user_name);
        return view('chat_list', compact('user_name', 'chats'));
       
    }
    public function set_username(Request $request){
        $request->session()->put('owner','false');
        $user_name = $request->user_name;
        $request->session()->put('user_name',$user_name);
        return redirect()->route('chat_list');
    }
    public function chat_view(Request $request){
        $request->session()->put('owner','false');
        $owner = $request->session()->get('owner');
        $null_pass = $request->session()->get('null_pass');
        $head = $request->session()->get('head');
        $name_room = $request->session()->get('name_room');
        return view('chat_room', compact('owner', 'head', 'name_room','null_pass'));
    }

    public function chat_view2(Request $request, $id){
        $head = Room::find($id);
        $head_comment = DB::table('comment')->where('channel','=',$id)->get();
        $user_comment = DB::table('comment')->where('channel','=',$id)->get('user_name')->unique();
        $user_name = $request->session()->get('user_name');
        $owner = $request->session()->get('owner');
        $request->session()->put('id_room',$id);
        return view('chat_room', array_merge(['head' => $head]), compact('user_name','head_comment','user_comment','owner'));
    }

    public function welcome_view(){
        set_time_limit(300);
        return view('welcome');
        
    }

    public function chat_list(Request $request){
        $request->session()->put('owner','false');
        $user_name = $request->session()->get('user_name');
        $chats = Room::all();
        return view('chat_list', compact('chats','user_name'));
    }

}
