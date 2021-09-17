<div wire:poll.750ms>
    <div class="form-group mx-sm-1 mb-4">
        <form action="{{ route('coupons.check') }}" method="POST">
            @csrf
            <input type="text" name="code" class="form-control text-center" id="inputPassword2" placeholder="{{ __('cupon code') }}">
            <button {{--  wire:click="coupon_index()"  --}} name="confirm_code" class="btn btn-success col-md">{{ __('Confirm') }}</button>
        </form>
    </div>
</div>
