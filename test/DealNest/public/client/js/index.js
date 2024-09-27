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
