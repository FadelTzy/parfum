<div>
    <form wire:submit.prevent="store">
        <div class="chat-input-container d-flex justify-content-between align-items-center"><input class="form-control flex-grow-1" autocomplete="false" wire:model="message" name="message" type="text" {{$statusc == 2 ? 'disabled' : ''}} placeholder="{{$statusc == 2 ? 'Konsultasi Telah Berakhir, Buat Konsultasi Baru Untuk Memulai Percakapan' : 'Ketik Sesuatu...'}} ">
            <div><button type="button" wire:click="modalClean" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary icon-button large"><i class="simple-icon-paper-clip"></i></button> <button type="submit" class="btn btn-primary icon-button large"><i class="simple-icon-arrow-right"></i></button></div>
        </div>
    </form>
    <div class="modal fade" wire:ignore.self id="exampleModal" data-backdrop="static" tabindex="1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                    <h5 class="mb-4">Upload </h5>
                    <form wire:submit.prevent="upload" enctype="multipart/form-data">
                        @error('photo') <span class="error text-danger">{{ $message }}</span> @enderror

                        <input type="file" name="photo" class="form-control mb-5" wire:model="photo">
                        <div class="text-right">
                            <button type="button" id="closecot" wire:click="deletePhoto" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" id="btns" @if($state==0) disabled @endif class="btn btn-primary"> Kirim </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function display() {
            document.getElementById("closecot").click();
        }
    </script>
    @if($modal == 0)
    <script>
        display();
    </script>
    @endif
</div>