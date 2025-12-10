document.addEventListener('DOMContentLoaded', function() {
    // #make element کی موجودگی چیک کریں
    const makeElement = document.querySelector('#make');
    if (makeElement) {
        new Choices('#make', {
            removeItemButton: true,
            searchEnabled: true,
            // آپ کے دوسرے options
        });
    } else {
        console.warn('#make element not found on this page');
    }

    // دوسرے elements کے لیے بھی ایسا ہی کریں
    const modelElement = document.querySelector('#model');
    if (modelElement) {
        new Choices('#model', {
            removeItemButton: true,
            searchEnabled: true,
            // آپ کے دوسرے options
        });
    }

    // year element
    const yearElement = document.querySelector('#year');
    if (yearElement) {
        new Choices('#year', {
            removeItemButton: true,
            searchEnabled: true,
            // آپ کے دوسرے options
        });
    }
});