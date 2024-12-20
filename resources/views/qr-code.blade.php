@extends('layouts.app')

@section('content')

    <div class="w-full max-w-[768px] min-w-[320px] bg-white p-6 rounded-md shadow-md">
        <div class="mb-4 flex flex-col gap-5 ">
            <label for="createPrice" class="block text-lg text-center  font-medium text-gray-700">Bar-code yoki Shtrix-code</label>
            <input type="text" name="qr-code" id="createprice" class="w-full border border-gray-300 rounded-md p-2">
        </div>
        <div class="flex flex-row gap-5 items-center justify-between">
            <img src="data:image/png;base64, {{ $barcode }}" alt="EAN13 Barcode">
            <img src="data:image/png;base64, {{ $qrcode }}" alt="Shtrix-code">
        </div>
    </div>

@endsection