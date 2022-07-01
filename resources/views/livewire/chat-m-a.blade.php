<div>
    <div wire:poll.5s id="scroll" class="scroll-content">
        @foreach($chat as $c)

        <div class="card d-inline-block mb-3 {{ Auth::user()->username == $c->id_pengirim ? 'float-right' : 'float-left' }} mr-2">
            <div class="position-absolute pt-1 pr-2 r-0"><span class="text-extra-small text-muted">{{ $c->created_at->format('H:i') }}
                </span>
                @if( Auth::user()->username == $c->id_pengirim ) <span title="hapus pesan" wire:click="delete({{$c->id}})" class="text-extra-small text-muted"><i class="simple-icon-close"></i>
                </span> @endif

            </div>
            <div class="card-body">
                <div class="d-flex flex-row pb-2"><a class="d-flex" href="#"><img alt="Profile Picture" @if(Auth::user()->username == $c->id_pengirim ) src="{{asset('image/fotomhs/')}}/{{'dosen.png'}}" @else src="{{asset('image/fotomhs/')}}/{{$mhs->foto ?? 'dosen.png'}}" @endif class="img-thumbnail border-0 rounded-circle mr-3 list-thumbnail align-self-center xsmall"></a>
                    <div class="d-flex flex-grow-1 min-width-zero">
                        <div class="m-2 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                            <div class="min-width-zero">
                                <p class="mb-0 truncate list-item-heading">{{ Auth::user()->username == $c->id_pengirim ? Auth::user()->name : $mhs->nama }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-text-left">
                    @if($c->meta == null)
                    <p class="mb-0 text-semi-muted">{{$c->pesan}}</p>
                    @else
                    <div class="btn-group " role="group" aria-label="Second group">
                        <a target="_blank" download="{{$c->pesan}}" href="{{asset('storage/file/'.$c->meta);}}" class="mb-0 btn btn-primary btn-sm default font-bold">{{$c->pesan}}</a>
                        <button type="button" class="btn btn-sm btn-outline-primary default"><i class="simple-icon-folder"></i></button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @endforeach

    </div>
    <div wire:loading>
        Mengirim Pesan...
    </div>
    @if($sc == 1)
    <script>
        data = document.getElementById("scroll");
        window.scrollTo(0, data.scrollHeight);

        justrun();
    </script>
    @endif
</div>