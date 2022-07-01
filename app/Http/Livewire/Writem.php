<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\t_message;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Http\Controllers\NotifController;

class Writem extends Component
{
    use WithFileUploads;
    public $photo;
    public $message;
    public $statusc;
    public $idk;
    public $nipdosen;
    public $state = 0, $modal = 1;
    public function mount($idk, $statusc, $nipdosen)
    {
        $this->idk = $idk;
        $this->statusc = $statusc;
        $this->nipdosen = $nipdosen;
    }
    public function upload()
    {
        $dataValid = $this->validate([
            'photo' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $gmbr = $this->photo;

        $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
        $this->photo->storeAs('public/file/', $nama_file);
        $mes =   t_message::create([
            'id_konsul' => $this->idk,
            'id_pengirim' => Auth::user()->username,
            'id_penerima' => 1,
            'pesan' => $gmbr->getClientOriginalName(),
            'status' => 1,
            'meta' =>  $nama_file
        ]);
        dispatch(function () use ($mes) {
            $notif = new NotifController;
            $notif->konsulbaru($this->nipdosen, $mes->id_konsul, $mes->id, 1, Auth::user()->username);
        })->afterResponse();
        $this->resetInput();
        $this->modal = 0;
    }
    public function modalClean()
    {
        $this->modal = 1;
    }
    public function deletePhoto()
    {
        $this->photo = null;
    }
    public function store()
    {
        if ($this->message != '' && $this->statusc != 2) {
            $mes = t_message::create([
                'id_konsul' => $this->idk,
                'id_pengirim' => Auth::user()->username,
                'id_penerima' => 1,
                'pesan' => $this->message,
                'status' => 1,
                'meta' => null
            ]);
            dispatch(function () use ($mes) {
                $notif = new NotifController;
                $notif->konsulbaru($this->nipdosen, $mes->id_konsul, $mes->id, 1, Auth::user()->username);
            })->afterResponse();
            $this->resetInput();
        }
    }
    public function resetInput()
    {
        $this->message = '';
        $this->emit('reloadyok');
    }
    public function render()
    {
        if ($this->photo != null) {
            $this->state = 1;
        }
        return view('livewire.writem');
    }
}
