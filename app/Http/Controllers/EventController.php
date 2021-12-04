<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{

    public function create() {
        return view('eventos.create');
    }



    public function dashboard() {
        $user = auth()->user();

        $eventos = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('eventos.dashboard', [
                'eventos' => $eventos,
                'eventsAsParticipant' => $eventsAsParticipant,
            ]);
    }



    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');
    }



    public function edit($id){
        $user = auth()->user();

        $evento = Event::findOrFail($id);

        if($user->id != $evento->user_id){
            return redirect('dashboard');
        }

        return view('eventos.edit', ['evento' => $evento]);
    }



    public function index() {

        $search = request('search');

        if($search){
            $eventos = Event::where([
                ['titulo', 'like', '%'.$search.'%'],
            ])->get();
        } else {
            $eventos = Event::all();
        }


        return view('welcome', ['eventos' => $eventos, 'search' => $search]);
    }



    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $evento = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Sua presença está confirmada no evento: '.$evento->titulo);
    }


    
    public function leaveEvent($id) {
        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $evento = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg','Você saiu com sucesso do evento: '.$evento->titulo);
    }



    public function store(Request $request) {
        $evento = new Event;

        $evento->titulo    = $request->titulo;
        $evento->cidade    = $request->cidade;
        $evento->privado   = $request->privado;
        $evento->descricao = $request->descricao;
        $evento->items     = $request->items;
        $evento->date      = $request->date;

        //image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension    = $requestImage->extension();

            $imageName     = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/events'), $imageName);
            $evento->image = $imageName;
        }

        $user = auth()->user();
        $evento->user_id = $user->id;

        $evento->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }



    public function show($id) {
        $evento = Event::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user){
            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent){
                if($userEvent['id'] == $id){
                    $hasUserJoined = true;
                }
            }
        }

        $eventOwner = User::where('id', $evento->user_id)->first()->toArray();
        
        return view('eventos.show', [
            'evento' => $evento, 
            'eventOwner' => $eventOwner,
            'hasUserJoined' => $hasUserJoined,
        ]);
    }



    public function update(Request $request){

        $data = $request->all();

        //image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension    = $requestImage->extension();

            $imageName     = md5($requestImage->getClientOriginalName() . strtotime("now") . "." . $extension);
            $requestImage->move(public_path('img/events'), $imageName);
            $data['image']= $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }
}
