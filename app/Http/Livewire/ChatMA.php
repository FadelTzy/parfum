<?php

namespace App\Http\Livewire;

use App\Models\t_mahasiswa;
use App\Models\t_message;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\t_relasi;

class ChatMA extends Component
{
    protected $listeners = ['reloadyok' => 'refresher', 'scrollNull' => 'scrollNull'];

    public $idr, $idk;
    public $sc = null;
    public function scrollNull()
    {
        $this->sc = null;
    }
    public function refresher()
    {
        $this->sc = 1;
    }
    public function mount($idr, $idk)
    {
        $this->idr = $idr;
        $this->idk = $idk;
    }
    public function delete($id)
    {
        t_message::whereId($id)->delete();
        $this->emit('reloadyok');
    }
    public function render()
    {
        $datarel = t_relasi::where('id', $this->idr)->first();
        $idrel = t_mahasiswa::select('nama', 'nim', 'foto')->where('nim', $datarel->nim)->first();
        $chat = t_message::where('id_konsul', $this->idk)->get();

        return view('livewire.chat-m-a', ['chat' => $chat, 'mhs' => $idrel]);
    }
}
