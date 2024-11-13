@extends('layouts.sellers.app')
@section('content')


<div class="chat-container">
    <!-- Sidebar -->
    <div class="chat-sidebar">
        <div class="user">
            <img src="https://via.placeholder.com/40" alt="User 1">
            <div class="name">Người dùng 1</div>
        </div>
        <div class="user">
            <img src="https://via.placeholder.com/40" alt="User 2">
            <div class="name">Người dùng 2</div>
        </div>
        <div class="user">
            <img src="https://via.placeholder.com/40" alt="User 3">
            <div class="name">Người dùng 3</div>
        </div>
    </div>

    <!-- Chat Section -->
    <div class="chat-content">
        <div class="chat-header">
            Chat với Người dùng 1
        </div>
        <div class="chat-body">
            <div class="message received">
                <div class="text">Chào bạn! Tôi có thể giúp gì cho bạn?</div>
            </div>
            <div class="message sent">
                <div class="text">Mình muốn hỏi về các sản phẩm mới.</div>
            </div>
            <div class="message received">
                <div class="text">Tất nhiên! Chúng tôi có rất nhiều sản phẩm mới. Bạn cần tìm loại nào?</div>
            </div>
        </div>
        <div class="chat-footer">
            <input type="text" placeholder="Nhập tin nhắn...">
            <button><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
</div>
@endsection