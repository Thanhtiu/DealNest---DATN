@extends('layouts.client.app')
@section('content')
<style>

</style>
<section class="py-5">
    <div class="container">
        <form action="" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3">
                    @include('layouts.client.sidebar')
                </div>
                <!-- order Content -->
                {{-- code nội dung đó ở đây --}}


                
            </div>
        </form>
    </div>
</section>
@endsection