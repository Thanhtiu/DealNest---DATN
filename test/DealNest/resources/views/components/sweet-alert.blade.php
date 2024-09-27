<div>
    @if($message)
    <script>
        Swal.fire({
            title: '{{ $type === "error" ? "Lỗi!" : "Thành công!" }}',
            html: '{!! json_encode($message) !!}',
            icon: '{{ $type }}', 
            confirmButtonText: 'OK'
        });
    </script>
    @endif
</div>