// Parts Finder - Custom JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('Parts Finder script loaded');
    
    // Initialize Choices.js for select elements
    initializeChoices();
    
    // Other JavaScript code for your website
    initializeOtherFeatures();
});

// Initialize Choices.js dropdowns
function initializeChoices() {
    console.log('Initializing Choices.js');
    
    // Check and initialize #make dropdown
    const makeElement = document.querySelector('#make');
    if (makeElement) {
        try {
            new Choices('#make', {
                removeItemButton: true,
                searchEnabled: true,
                placeholderValue: 'Select Make',
                searchPlaceholderValue: 'Search makes...',
                noChoicesText: 'No makes found',
                itemSelectText: 'Click to select'
            });
            console.log('#make Choices initialized');
        } catch (error) {
            console.error('Error initializing #make:', error);
        }
    } else {
        console.warn('#make element not found');
    }
    
    // Check and initialize #model dropdown
    const modelElement = document.querySelector('#model');
    if (modelElement) {
        try {
            new Choices('#model', {
                removeItemButton: true,
                searchEnabled: true,
                placeholderValue: 'Select Model',
                searchPlaceholderValue: 'Search models...',
                noChoicesText: 'No models found',
                itemSelectText: 'Click to select'
            });
            console.log('#model Choices initialized');
        } catch (error) {
            console.error('Error initializing #model:', error);
        }
    } else {
        console.warn('#model element not found');
    }
    
    // Check and initialize #year dropdown
    const yearElement = document.querySelector('#year');
    if (yearElement) {
        try {
            new Choices('#year', {
                removeItemButton: true,
                searchEnabled: true,
                placeholderValue: 'Select Year',
                searchPlaceholderValue: 'Search years...',
                noChoicesText: 'No years found',
                itemSelectText: 'Click to select'
            });
            console.log('#year Choices initialized');
        } catch (error) {
            console.error('Error initializing #year:', error);
        }
    } else {
        console.warn('#year element not found');
    }
    
    // Check and initialize #engine dropdown
    const engineElement = document.querySelector('#engine');
    if (engineElement) {
        try {
            new Choices('#engine', {
                removeItemButton: true,
                searchEnabled: true,
                placeholderValue: 'Select Engine',
                searchPlaceholderValue: 'Search engines...',
                noChoicesText: 'No engines found',
                itemSelectText: 'Click to select'
            });
            console.log('#engine Choices initialized');
        } catch (error) {
            console.error('Error initializing #engine:', error);
        }
    } else {
        console.warn('#engine element not found');
    }
}

// Other website features
function initializeOtherFeatures() {
    console.log('Initializing other website features');
    
    // You can add other JavaScript functionality here
    // For example:
    // - Form validation
    // - AJAX requests
    // - UI interactions
    // - etc.
    
    // Example: Form submission
    const searchForm = document.querySelector('#partsSearchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Search form submitted');
            // Add form submission logic here
        });
    }
}

// If elements are loaded dynamically (via AJAX)
function initializeDynamicElements() {
    // Re-initialize Choices for dynamically loaded elements
    initializeChoices();
}

// Export functions if needed (for module systems)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initializeChoices,
        initializeOtherFeatures,
        initializeDynamicElements
    };
}