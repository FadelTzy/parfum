<?php

namespace App\Http\Livewire;

use App\Models\t_dosen;
use App\Models\t_mahasiswa;
use App\Models\t_message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ChatPA extends Component
{
    protected $listeners = ['reloadyok' => 'refresher', 'scrollNull' => 'scrollNull'];
    public $sc = null;

    public $idk;
    public function refresher()
    {
        $this->sc = 1;
    }
    public function scrollNull()
    {
        $this->sc = null;
    }
    public function mount($idk)
    {
        $this->idk = $idk;
    }
    public function delete($id)
    {
        t_message::whereId($id)->delete();
        $this->emit('reloadyok');
    }
    public function render()
    {
        $idrel = t_mahasiswa::select('pa', 'foto')->where('nim', Auth::user()->username)->first();
        $dosen = t_dosen::select('nama', 'nip')->where('id_dosen', $idrel->pa)->first();
        $chat = t_message::where('id_konsul', $this->idk)->get();
        return view('livewire.chat-p-a', ['chat' => $chat, 'dosen' => $dosen, 'idrel' => $idrel]);
    }
}
