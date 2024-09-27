
    document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tabs a');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', function (event) {
            event.preventDefault();

            // Loại bỏ lớp 'active' khỏi tất cả các tab và nội dung
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            // Thêm lớp 'active' vào tab được nhấn
            tab.classList.add('active');

            // Hiển thị nội dung tương ứng với tab
            contents[index].classList.add('active');
        });
    });
});
