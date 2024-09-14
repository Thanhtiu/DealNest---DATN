@extends('layouts/client.app')
@section('content')
<style>
.category-section {
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    width: 80%;
    position: relative;
}

.category-wrapper {
    display: flex;
    overflow-x: hidden; 
    overflow-y: hidden; 
    white-space: nowrap; 
}

.category-slider {
    display: flex;
    flex-direction: column;
    gap: 15px; 
    flex-shrink: 0;
    width: 100%; 
    height: 320px; 
}

.category-list {
    display: flex;
    flex-wrap: wrap; 
    gap: 15px; 
    margin-left: 50px;
}

.category-item {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 120px;
    height: 150px;
    overflow: hidden;
}

.category-item img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.category-item span {
    font-size: 14px;
    color: #333;
    font-weight: 500;
    display: block;
    width: 100%;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.scroll-button {
    background-color: rgba(0, 0, 0, 0.2);
    color: #fff;
    border: none;
    border-radius: 0;
    width: 24px;
    height: 24px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 2;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.scroll-button.prev {
    left: -10px;
}

.scroll-button.next {
    right: -10px;
}

.scroll-button:hover {
    background-color: rgba(0, 0, 0, 0.4);
    transform: translateY(-50%) scale(1.2);
}


</style>
<section class="category-section">
    <h2>DANH MỤC</h2>
    <button class="scroll-button prev">&lt;</button>
    <div class="category-wrapper">
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="Category 1">
                    <span>Category 1</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/e4fbccba5e1189d1141b9d6188af79c0@resize_w320_nl.webp" alt="Category 2">
                    <span>Category 2</span>
                </div>

                <!-- Thêm các mục khác -->
            </div>
        </div>
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 3">
                    <span>Category 3</span>
                </div>
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp" alt="Category 4">
                    <span>Category 4</span>
                </div>
                <!-- Thêm các mục khác -->
            </div>
        </div>
        <!-- Thêm nhiều slider nếu cần -->
    </div>
    <button class="scroll-button next">&gt;</button>
</section>

   
    <div class="row product-container">
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 1k3</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 200+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dầdasdada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 912</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-3.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-2.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-5.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20Wđ</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-2.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 1k3</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryWrapper = document.querySelector('.category-wrapper');
    const prevButton = document.querySelector('.scroll-button.prev');
    const nextButton = document.querySelector('.scroll-button.next');
    
    let scrollAmount = 0;
    const sliderWidth = categoryWrapper.querySelector('.category-slider').offsetWidth;
    const scrollInterval = 3000; // 3s
    let autoScrollInterval;
    let scrollDirection = 'next'; 
    function updateScrollButtons() {
        const maxScroll = categoryWrapper.scrollWidth - categoryWrapper.clientWidth;
        prevButton.disabled = scrollAmount <= 0;
        nextButton.disabled = scrollAmount >= maxScroll;
    }

    function scrollCategory(direction) {
        const maxScroll = categoryWrapper.scrollWidth - categoryWrapper.clientWidth;
        if (direction === 'next') {
            if (scrollAmount < maxScroll) {
                scrollAmount += sliderWidth;
                categoryWrapper.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            } else {
                scrollAmount = 0; // Quay lại đầu
                categoryWrapper.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            }
        } else if (direction === 'prev') {
            if (scrollAmount > 0) {
                scrollAmount -= sliderWidth;
                categoryWrapper.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            } else {
                scrollAmount = maxScroll; // Quay lại cuối
                categoryWrapper.scrollTo({ left: scrollAmount, behavior: 'smooth' });
            }
        }
        updateScrollButtons();
    }

    function startAutoScroll() {
        autoScrollInterval = setInterval(function() {
            scrollCategory(scrollDirection);
            if (scrollDirection === 'next' && scrollAmount === categoryWrapper.scrollWidth - categoryWrapper.clientWidth) {
                scrollDirection = 'prev';
            } else if (scrollDirection === 'prev' && scrollAmount === 0) {
                scrollDirection = 'next';
            }
        }, scrollInterval);
    }

    function stopAutoScroll() {
        clearInterval(autoScrollInterval);
    }

    prevButton.addEventListener('click', function() {
        scrollCategory('prev');
        stopAutoScroll(); 
    });

    nextButton.addEventListener('click', function() {
        scrollCategory('next');
        stopAutoScroll(); 
    });

    categoryWrapper.addEventListener('mouseover', stopAutoScroll); 
    categoryWrapper.addEventListener('mouseout', startAutoScroll); 

    updateScrollButtons(); 
    startAutoScroll(); 
});

</script>


@endsection