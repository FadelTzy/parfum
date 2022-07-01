<?php

namespace App\Http\Livewire;

use App\Models\t_konsultasi;
use Livewire\Component;
use App\Models\t_message;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Http\Controllers\NotifController;
use App\Models\t_relasi;

class Writed extends Component
{
    use WithFileUploads;
    public $photo;
    public $message;
    public $messagef;
    public $statusc;
    public $idk;
    public $idr;
    public $state = 0, $modal = 1, $idrel = null;
    public function mount($idk, $statusc, $idr)
    {
        $this->idk = $idk;
        $this->idr = $idr;
        $this->statusc = $statusc;
    }
    public function upload()
    {
        $dataValid = $this->validate([
            'photo' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $gmbr = $this->photo;

        $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
        $this->photo->storeAs('public/file/', $nama_file);
        $mes =  t_message::create([
            'id_konsul' => $this->idk,
            'id_pengirim' => Auth::user()->username,
            'id_penerima' => 1,
            'pesan' => $gmbr->getClientOriginalName(),
            'status' => 0,
            'meta' =>  $nama_file
        ]);
        if ($this->idrel != null) {
            $relasiid = $this->idrel;
        } else {
            $relasiid = t_relasi::select('nim')->whereId($this->idr)->first()->nim;
            $this->idrel = $relasiid;
        }

        dispatch(function () use ($relasiid, $mes) {
            $notif = new NotifController;
            $notif->konsulbaru($relasiid, $mes->id_konsul, $mes->id, 1, Auth::user()->username);
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
        if ($this->message != '') {
            $mes = t_message::create([
                'id_konsul' => $this->idk,
                'id_pengirim' => Auth::user()->username,
                'id_penerima' => 1,
                'pesan' => $this->message,
                'status' => 1,
                'meta' => null
            ]);
            t_konsultasi::where('id', $this->idk)->update(['status' => 1]);
            if ($this->idrel != null) {
                $relasiid = $this->idrel;
            } else {
                $relasiid = t_relasi::select('nim')->whereId($this->idr)->first()->nim;
                $this->idrel = $relasiid;
            }

            dispatch(function () use ($relasiid, $mes) {
                $notif = new NotifController;
                $notif->konsulbaru($relasiid, $mes->id_konsul, $mes->id, 1, Auth::user()->username);
            })->afterResponse();
        }


        $this->resetInput();
    }
    public function saran()
    {
        $mes = t_message::create([
            'id_konsul' => $this->idk,
            'id_pengirim' => Auth::user()->username,
            'id_penerima' => 1,
            'pesan' => $this->messagef,
            'status' => 1,
            'meta' => null
        ]);
        $kon = t_konsultasi::where('id', $this->idk)->update(['status' => '2', 'saran' => $this->messagef]);
        if ($this->idrel != null) {
            $relasiid = $this->idrel;
        } else {
            $relasiid = t_relasi::select('nim')->whereId($this->idr)->first()->nim;
        }

        dispatch(function () use ($relasiid, $mes) {
            $notif = new NotifController;
            $notif->konsulbaru($relasiid, $mes->id_konsul, $mes->id, 2, Auth::user()->username);
        })->afterResponse();

        $this->statusc = 2;
        $this->resetInput();
    }
    public function resetInput()
    {
        $this->message = '';
        $this->messagef = '';
        $this->emit('reloadyok');
    }

    public function render()
    {
        if ($this->photo != null) {
            $this->state = 1;
        }
        return view('livewire.writed');
    }
}
