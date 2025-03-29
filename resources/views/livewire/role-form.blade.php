<div>
    <div class="modal fade @if($show === true) show @endif"
         id="myExampleModal"
         style="display: @if($show === true)
                 block
         @else
                 none
         @endif;"
         tabindex="-1"
         role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                    <button class="close"
                            type="button"
                            aria-label="Close"
                            wire:click.prevent="doClose()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Modal Content:
                    <br>
                    {{-- The Data From The $emit Will Show Up Here --}}
                    {{$data}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary"
                            type="button"
                            wire:click.prevent="doClose()">Cancel</button>

                    <button class="btn btn-secondary"
                            type="button"
                            wire:click.prevent="doSomething()">Do Something</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Let's also add the backdrop / overlay here -->
    <div class="modal-backdrop fade show"
         id="backdrop"
         style="display: @if($show === true)
                 block
         @else
                 none
         @endif;"></div>
</div>